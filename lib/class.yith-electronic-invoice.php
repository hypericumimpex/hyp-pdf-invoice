<?php
if ( ! defined ( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists ( 'YITH_Electronic_Invoice' ) ) {

    /**
     * Enable Module Eletronic Invoice for Italian Customers
     *
     * @class   YITH_Eletronic_Invoice
     * @package Yithemes
     * @since   1.9.0
     * @author  YITH
     */
    class YITH_Electronic_Invoice {

                /**
         * Single instance of the class
         *
         * @since 1.9.0
         */
        protected static $instance;


        /**
         * Returns single instance of the class
         *
         * @since 1.9.0
         */
        public static function get_instance() {
            if ( is_null ( self::$instance ) ) {
                self::$instance = new self();
            }
            return self::$instance;
        }


        public function __construct() {

            if( $this->enable == 'yes' ){
                $this->initialize();
            }

        }


        /**
         * Initialize all functions of the module
         */
        private function initialize(){

            /**
             * Enqueue scripts for checkout process
             */
            add_action( 'wp_enqueue_scripts',array($this,'enqueue_scripts') );

            /**
             * Customize checkout and order detail page fields
             */
            add_filter( 'woocommerce_default_address_fields', array( $this,'customize_billing_fields' ) );
            add_filter( 'woocommerce_admin_billing_fields', array( $this,'customize_billing_fields' ) );

            /* Syncronize numeration of invoice and xml */
            add_filter( 'yith_ywpi_current_invoice_number', array( $this,'set_invoice_number_for_xml_documents' ),10,3 );

            /* Set different content type for XML documents */
            add_filter( 'ywpi_file_content_type', array( $this,'set_content_type_to_open_file' ),10,2 );

            /* Print metabox Electronic Invoice in order detail page */
            add_action( 'ywpi_print_additional_sections', array($this,'print_electronic_invoice_metabox') );

            /* Create automatically XML documents */
            add_action( 'ywpi_create_automatic_invoice', array( $this,'create_automatically_document' ) );


            add_action( 'woocommerce_after_checkout_validation', array( $this,'validate_checkout_fields' ),10,2 );
        }


        /**
         * Magic method to recover module options
         * @param $key
         * @return mixed
         */
        public function __get( $key ){

            return get_option( 'ywpi_electronic_invoice_' . $key );

        }


        public function enqueue_scripts(){

            wp_enqueue_script( 'ywpi_checkout',YITH_YWPI_ASSETS_URL . '/js/yith-wc-pdf-invoice-checkout.js', array(
                'jquery',
            ), YITH_YWPI_VERSION, true );

        }


        /**
         * Add Receiver ID and PEC fields to WooCommerce default fields
         * @param $fields
         * @return mixed
         */
        public function customize_billing_fields( $fields ){

            if( YITH_Electronic_Invoice()->show_receiver_id == 'yes' || apply_filters( 'ywpi_show_receiver_id_field',false ) ){
                $fields['receiver_id'] =  array(
                    'label'        => YITH_Electronic_Invoice()->receiver_id_label,
                    'required'     => false,
                    'class'        => array( 'form-row-wide' ),
                    'autocomplete' => 'given-name',
                    'priority'     => 90,
                );
            }

            if( YITH_Electronic_Invoice()->show_receiver_pec == 'yes' || apply_filters( 'ywpi_show_receiver_pec_field',false ) ){
                $fields['receiver_pec'] =  array(
                    'label'        => YITH_Electronic_Invoice()->receiver_pec_label,
                    'required'     => false,
                    'class'        => array( 'form-row-wide' ),
                    'autocomplete' => 'given-name',
                    'priority'     => 100,
                    'validate'     => array( 'email' ),
                    'type'         => 'email'
                );
            }

            if( YITH_Electronic_Invoice()->show_receiver_type == 'yes' ){
                $fields['receiver_type'] =  array(
                    'label'        => apply_filters( 'ywpi_receiver_type_field_label',__( 'Receiver type', 'yith-woocommerce-pdf-invoice' )),
                    'required'     => false,
                    'class'        => array( 'form-row-wide' ),
                    'autocomplete' => 'given-name',
                    'priority'     => 100,
                    'type'         => 'radio',
                    'options'      => array(
                        'private'   =>  apply_filters( 'ywpi_receiver_type_field_private_label',__( 'Private','yith-woocommerce-pdf-invoice' )),
                        'pa'        =>  apply_filters( 'ywpi_receiver_type_field_pa_label',__( 'Public administration','yith-woocommerce-pdf-invoice' ))
                    ),
                    'default'       =>  'private'
                );
            }



            return $fields;
        }


        /**
         * Retrieve the invoice document number
         * @param $current_invoice_number
         * @param $order
         * @param $document
         * @return mixed|string
         */
        public function set_invoice_number_for_xml_documents( $current_invoice_number, $order, $document ){
            if( $document instanceof YITH_XML){
                $invoice = ywpi_get_invoice( yit_get_prop( $order, 'id' ) );
                if( $invoice->number != null ){
                    $current_invoice_number = $invoice->number;
                }
            }elseif( $document instanceof YITH_Invoice ){
                $invoice_number = get_post_meta( $document->order->get_id(),'ywpi_invoice_number',true);
                if( $invoice_number ){
                    $current_invoice_number = $invoice_number;
                }
            }
            return $current_invoice_number;
        }


        /**
         * Print metabox for electronic invoices
         * @param $post
         */
        public function print_electronic_invoice_metabox( $post ){
            if ( YITH_PDF_Invoice()->preview_mode  ) {

                return;
            }

            $order = wc_get_order( $post->ID );
            if ( ! apply_filters( 'yith_ywpi_show_xml_button_order_page', true, $order ) ) {
                return;
            }

            $order   = wc_get_order( $post );
            $invoice = ywpi_get_invoice( yit_get_prop( $order, 'id' ),'xml' );

            ?>

            <div class="ywpi-document-section">
				<span class="ywpi-section-title">
					<?php _e( 'XML status', 'yith-woocommerce-pdf-invoice' ); ?>
				</span>

                <div class="ywpi-section-row">
                    <?php if ( $invoice->generated() ) :  ?>

                        <div class="ywpi-section-row">
                            <span class="ywpi-left-label"><?php echo apply_filters('ywpi_invoice_number_label_edit_order_page',__( 'Invoice number: ', 'yith-woocommerce-pdf-invoice' ),$order,$invoice); ?></span>
                            <span class="ywpi-right-value"><?php echo $invoice->get_formatted_document_number(); ?></span>
                        </div>

                        <a <?php if ( 'open' == ywpi_get_option( 'ywpi_pdf_invoice_behaviour' ) ) {
                            echo 'target="_blank"';
                        } ?> class="button tips ywpi_view_xml"
                             data-tip="<?php _e( "View XML", 'yith-woocommerce-pdf-invoice' ); ?>"
                             href=" <?php echo YITH_PDF_Invoice()->get_action_url( 'view', 'xml', yit_get_prop( $order, 'id' ) ); ?>">
                            <?php _e( "View", 'yith-woocommerce-pdf-invoice' ); ?>
                        </a>
                        <a class="button tips ywpi-regenerate-xml"
                           data-tip="<?php _e( "Regenerate XML", 'yith-woocommerce-pdf-invoice' ); ?>"
                           href="<?php echo YITH_PDF_Invoice()->get_action_url( 'regenerate', 'xml', yit_get_prop( $order, 'id' ) ); ?>">
                            <?php _ex( "Regenerate", 'Button text to regenerate a document', 'yith-woocommerce-pdf-invoice' ); ?>
                        </a>
                    <?php elseif ( apply_filters( 'yith_ywpi_can_create_document', true, yit_get_prop( $order, 'id' ), 'xml' ) ) : ?>
                        <div class="ywpi-section-row">
                            <span><?php _e( 'The XML file has been created for this order', 'yith-woocommerce-pdf-invoice' ); ?></span>
                        </div>
                        <a class="button tips ywpi_create_xml"
                           data-tip="<?php _e( "Create XML", 'yith-woocommerce-pdf-invoice' ); ?>"
                           href="<?php echo YITH_PDF_Invoice()->get_action_url( 'create', 'xml', yit_get_prop( $order, 'id' ) ); ?>">
                            <?php _e( "Create", 'yith-woocommerce-pdf-invoice' ); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <?php
        }


        /**
         * Set content type to open correctly xml file
         * @param $content_type
         * @param $document
         * @return string
         */
        public function set_content_type_to_open_file( $content_type, $resource ){
            $pathinfo = pathinfo($resource);
            if( $pathinfo['extension'] == 'xml' ){
                $content_type = 'Content-type: text/xml';
            }
            return $content_type;
        }


        /**
         * Create automatically document
         * @param $order_id
         */
        public function create_automatically_document( $order_id ){

            YITH_PDF_Invoice()->create_document( $order_id, 'xml' );

        }


        /**
         * Validate checkout fields ( Billing Receiver ID and Billing Receiver PEC )
         * @param $data
         * @param $errors
         */
        public function validate_checkout_fields( $data, $errors ){

            if( $data['billing_company'] != '' ){
                if( YITH_Electronic_Invoice()->show_receiver_id == 'yes' && $data['billing_receiver_id'] == '' ){
                    $field_label = YITH_Electronic_Invoice()->receiver_id_label;
                    $message = apply_filters( 'ywpi_checkout_error_billing_receiver_id', sprintf( __( 'Company name is set, so %s is a required field.', 'yith-woocommerce-pdf-invoice' ), '<strong>' . esc_html( $field_label ) . '</strong>' ),$field_label);
                    $errors->add( 'validation', $message );
                }
                if( YITH_Electronic_Invoice()->show_receiver_pec == 'yes' && $data['billing_receiver_pec'] == '' ){
                    $field_label = YITH_Electronic_Invoice()->receiver_pec_label;
                    $message = apply_filters( 'ywpi_checkout_error_billing_receiver_oec', sprintf( __( 'Company name is set, so %s is a required field.', 'yith-woocommerce-pdf-invoice' ), '<strong>' . esc_html( $field_label ) . '</strong>' ),$field_label);
                    $errors->add( 'validation', $message );;
                }
            }

        }


    }
}

function YITH_Electronic_Invoice(){
    return YITH_Electronic_Invoice::get_instance();
}
