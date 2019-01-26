<?php
if ( ! defined ( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists ( 'YITH_XML' ) ) {

    /**
     * Implements features related to a PDF document
     *
     * @class   YITH_XML
     * @package Yithemes
     * @since   1.9.0
     * @author  YITH
     */
    class YITH_XML extends YITH_Document {


        /**
         * @var string date of creation for the current invoice
         */
        public $date;

        /**
         * @var string the document number
         */
        public $number;

        /**
         * @var string the document prefix
         */
        public $prefix;

        /**
         * @var string the document suffix
         */
        public $suffix;

        /**
         * @var string the document formatted number
         */
        public $formatted_number = '';

        /**
         * Initialize plugin and registers actions and filters to be used
         *
         * @param int $order_id the order for which the document is generated
         *
         * @since   1.9.0
         * @author Alessio Torrisi
         * @access public
         */
        public function __construct( $order_id = 0 ) {

            /**
             * Call base class constructor
             */
            parent::__construct ( $order_id );

            /**
             *  Fill invoice information from a previous invoice is exists or from general plugin options plus order related data
             * */
            $this->init_document();
        }

        /**
         * Check if the document is associated to a valid order
         *
         * @return bool
         * @author Alessio Torrisi
         * @since  1.9.0
         */
        public function is_valid() {

            return $this->order && $this->order instanceof WC_Order;
        }

        /**
         * Check if this document has been generated
         *
         * @return bool
         * @author Alessio Torrisi
         * @since  1.9.0
         */
        public function generated() {
            // Force to generate always the xml
            return $this->is_valid () && yit_get_prop ( $this->order, '_ywpi_has_xml', true );
        }

        /*
         * Check if an invoice exist for current order and load related data
         */

        private function init_document() {
            if ( ! $this->is_valid () ) {
                return;
            }

            if ( $this->generated () ) {

                $this->save_path   = yit_get_prop ( $this->order, '_ywpi_xml_path', true );
                $this->save_folder = yit_get_prop ( $this->order, '_ywpi_xml_folder', true );
                $this->number           = yit_get_prop ( $this->order, '_ywpi_invoice_number', true );
                $this->prefix           = yit_get_prop ( $this->order, '_ywpi_invoice_prefix', true );
                $this->suffix           = yit_get_prop ( $this->order, '_ywpi_invoice_suffix', true );
                $this->formatted_number = yit_get_prop ( $this->order, '_ywpi_invoice_formatted_number', true );
                $this->date             = yit_get_prop ( $this->order, '_ywpi_invoice_date', true );
            }
        }


        /**
         *  Cancel reference to pro-forma options for the current order
         */
        public function reset() {
            yit_delete_prop ( $this->order, '_ywpi_has_xml' );
            yit_delete_prop ( $this->order, '_ywpi_xml_path' );
            yit_delete_prop ( $this->order, '_ywpi_invoice_number' );
            yit_delete_prop ( $this->order, '_ywpi_invoice_prefix' );
            yit_delete_prop ( $this->order, '_ywpi_invoice_suffix' );
            yit_delete_prop ( $this->order, '_ywpi_invoice_formatted_number' );
            yit_delete_prop ( $this->order, '_ywpi_invoice_path' );
            yit_delete_prop ( $this->order, '_ywpi_invoice_folder' );
            yit_delete_prop ( $this->order, '_ywpi_invoice_date' );
        }

        /**
         * Set invoice data for current order, picking the invoice number from the related general option
         */
        public function save() {

            yit_save_prop ( $this->order,
                array(
                    '_ywpi_has_xml'    => true,
                    '_ywpi_xml_path'   => $this->save_path,
                    '_ywpi_xml_folder' => $this->save_folder,
                    '_ywpi_invoice_prefix'           => $this->prefix,
                    '_ywpi_invoice_suffix'           => $this->suffix,
                    '_ywpi_invoice_number'           => $this->number,
                    '_ywpi_invoice_formatted_number' => $this->formatted_number,
                    '_ywpi_invoice_date'             => $this->date,
                ) );
        }


        public function is_pa_customer(){
            return $this->order->get_meta('_billing_receiver_type') == 'pa' ? true : false;
        }


        /**
         * Retrieve the formatted document number
         *
         * @return mixed|string|void
         * @author Lorenzo Giuffrida
         * @since  1.0.0
         */
        public function get_formatted_document_number() {
            return $this->formatted_number;
        }


    }
}