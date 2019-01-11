<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

$current_date = getdate();

$general_options = array(

    'electronic-invoice' => array(
        array(
            'name' => __('Transmitter/Company details settings', 'yith-woocommerce-pdf-invoice'),
            'type' => 'title',
        ),
        'country_id' => array(
            'name' => __('Country ID', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_country_id',
            'desc' => __('Set the country ID to show in the XML document', 'yith-woocommerce-pdf-invoice'),
            'default' => 'IT',
        ),
        'transmitter_id' => array(
            'name' => __('Transmitter ID', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_transmitter_id',
            'desc' => __('Set your transmitter ID to show in the XML document', 'yith-woocommerce-pdf-invoice'),
            'default' => '',
        ),
        'transmission_format' => array(
            'name' => __('Transmission format', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_transmission_format',
            'desc' => __('Set the transmission format for the XML document', 'yith-woocommerce-pdf-invoice'),
            'default' => 'FPR12',
        ),
        'fiscal_regime' => array(
            'name' => __('Fiscal regime', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_fiscal_regime',
            'desc' => __('Fiscal regime you show in the XML document', 'yith-woocommerce-pdf-invoice'),
            'default' => 'RF19',
        ),
        'company_registered_name' => array(
            'name' => __('Registered name', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_company_registered_name',
            'desc' => __('Set the registered name of your company', 'yith-woocommerce-pdf-invoice'),
            'default' => '',
        ),
        'company_address' => array(
            'name' => __('Address', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_company_address',
            'desc' => __('Set the address of your company', 'yith-woocommerce-pdf-invoice'),
            'default' => '',
        ),
        'company_cap' => array(
            'name' => __('CAP', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_company_cap',
            'desc' => __('Set the CAP (postal code) of your company', 'yith-woocommerce-pdf-invoice'),
            'default' => '',
        ),
        'company_city' => array(
            'name' => __('Company city', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_company_city',
            'desc' => __('Set the city of your company', 'yith-woocommerce-pdf-invoice'),
            'default' => '',
        ),
        'company_province' => array(
            'name' => __('Company province', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_company_province',
            'desc' => __('Set the province of your company', 'yith-woocommerce-pdf-invoice'),
            'default' => '',
        ),
//        'company_state' => array(
//            'name' => __('Company state', 'yith-woocommerce-pdf-invoice'),
//            'type' => 'text',
//            'id' => 'ywpi_electronic_invoice_company_state',
//            'desc' => __('Set the state of your company', 'yith-woocommerce-pdf-invoice'),
//            'default' => '',
//        ),
        'include-tracking-info' => array(
            'name' => __('Include tracking info', 'yith-woocommerce-pdf-invoice'),
            'type' => 'checkbox',
            'id' => 'ywpi_electronic_invoice_include_tracking_info',
            'desc' => __('Enable this field to include tracking fields inside the XML document. To fill these fields you\'ll have to custom code an integration of these data.', 'yith-woocommerce-pdf-invoice'),
            'default' => 'no',
        ),
        array(
            'type' => 'sectionend',
        ),



        array(
            'name' => __('Checkout settings', 'yith-woocommerce-pdf-invoice'),
            'type' => 'title',
        ),
        'receiver-id' => array(
            'name' => __('Show receiver ID', 'yith-woocommerce-pdf-invoice'),
            'type' => 'checkbox',
            'id' => 'ywpi_electronic_invoice_show_receiver_id',
            'desc' => __('Check this option to enable the receiver ID (on Checkout and My Account page)', 'yith-woocommerce-pdf-invoice'),
            'default' => 'yes',
        ),
        'receiver-id-label' => array(
            'name' => __('Receiver ID label', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_receiver_id_label',
            'desc' => __('Set label for Receiver ID field', 'yith-woocommerce-pdf-invoice'),
            'default' => __( 'Receiver ID','yith-woocommerce-pdf-invoice' ),
        ),
        'receiver-pec' => array(
            'name' => __('Show receiver PEC (certified email address)', 'yith-woocommerce-pdf-invoice'),
            'type' => 'checkbox',
            'id' => 'ywpi_electronic_invoice_show_receiver_pec',
            'desc' => __('Check this option to enable the receiver PEC field (on Checkout and My Account page)', 'yith-woocommerce-pdf-invoice'),
            'default' => 'yes',
        ),
        'receiver-pec-label' => array(
            'name' => __('Receiver PEC label', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_receiver_pec_label',
            'desc' => __('Set label for Receiver PEC field', 'yith-woocommerce-pdf-invoice'),
            'default' => __( 'Receiver PEC','yith-woocommerce-pdf-invoice' ),
        ),
        'receiver-type' => array(
            'name' => __('Show receiver\'s type', 'yith-woocommerce-pdf-invoice'),
            'type' => 'checkbox',
            'id' => 'ywpi_electronic_invoice_show_receiver_type',
            'desc' => __('Check this option to allow your customer to specify if he/she is a private entity or public administration', 'yith-woocommerce-pdf-invoice'),
            'default' => 'no',
        ),

        array(
            'type' => 'sectionend',
        ),
    ),
);


return apply_filters('ywpi_electronic_options', $general_options);
