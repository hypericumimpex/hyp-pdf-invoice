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
            'name' => __('Impostazioni generali', 'yith-woocommerce-pdf-invoice'),
            'type' => 'title',
        ),
        'filename_format' => array(
            'name' => __('Nome file', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_filename_format',
            'desc' => __('Imposta il formato da utilizzare per il nome del file legato alla fatturazione elettronica. Usa [number], [prefix], [suffix], 
                      [year], [month], [day], [shop_ssn] come segnaposto.
 Ricorda che il nome del file deve rispettare il seguente formato <b>"IDCountryShopSSN_Invoice ID"</b> quindi un esemmpio possibile è <b>IT99999999999_00002.xml</b><br>
 Per informazioni aggiuntive ti invitiamo a controllare <a href="https://www.fatturapa.gov.it/export/fatturazione/it/c-11.htm" target="_blank">questa pagina', 'yith-woocommerce-pdf-invoice'),
            'default' => 'IT[shop_ssn]_[number]',
        ),
        array(
            'type' => 'sectionend',
        ),


        array(
            'name' => __('Impostazioni dettagli del soggetto o dell\'azienda trasmittente', 'yith-woocommerce-pdf-invoice'),
            'type' => 'title',
        ),
        /*
        'country_id' => array(
            'name' => __('ID del paese', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_country_id',
            'desc' => __('Inserisce la sigla del paese', 'yith-woocommerce-pdf-invoice'),
            'default' => 'IT',
        ),*/
        'transmitter_id' => array(
            'name' => __('Codice fiscale azienda', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_transmitter_id',
            'desc' => __('Inserisci il codice fiscale associato del soggetto o dell\'azienda che emette fattura. Il valore verrà usato come "Transmitter ID" nel file XML', 'yith-woocommerce-pdf-invoice'),
            'default' => '',
        ),
        'company_vat' => array(
            'name' => __('Partita IVA azienda', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_company_vat',
            'desc' => __('Inserisci la partita IVA del soggetto o dell\'azienda che emette fattura', 'yith-woocommerce-pdf-invoice'),
            'default' => '',
        ),
        /*
        'transmission_format' => array(
            'name' => __('Formato trasmissione', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_transmission_format',
            'desc' => __('Imposta il formato di trasmissione del documento XML', 'yith-woocommerce-pdf-invoice'),
            'default' => 'FPR12',
        ),*/
        'fiscal_regime' => array(
            'name' => __('Regime fiscale', 'yith-woocommerce-pdf-invoice'),
            'type' => 'select',
            'id' => 'ywpi_electronic_invoice_fiscal_regime',
            'desc' => __('Imposta il regime fiscale legato al soggetto o all\'azienda che emette fattura', 'yith-woocommerce-pdf-invoice'),
            'options' => array(
                'RF01'        => __( "Ordinario", 'yith-woocommerce-pdf-invoice' ),
                'RF02'        => __( "Contribuenti minimi (art.1, c.96-117, L. 244/07)", 'yith-woocommerce-pdf-invoice' ),
                'RF04'        => __( "Agricoltura e attività connesse e pesca (artt.34 e 34-bis, DPR 633/72)", 'yith-woocommerce-pdf-invoice' ),
                'RF05'        => __( "Vendita sali e tabacchi (art.74, c.1, DPR. 633/72)", 'yith-woocommerce-pdf-invoice' ),
                'RF06'        => __( "Commercio fiammiferi (art.74, c.1, DPR  633/72)", 'yith-woocommerce-pdf-invoice' ),
                'RF07'        => __( "Editoria (art.74, c.1, DPR  633/72)", 'yith-woocommerce-pdf-invoice' ),
                'RF08'        => __( "Gestione servizi telefonia pubblica (art.74, c.1, DPR 633/72)", 'yith-woocommerce-pdf-invoice' ),
                'RF09'        => __( "Rivendita documenti di trasporto pubblico e di sosta (art.74, c.1, DPR  633/72) ", 'yith-woocommerce-pdf-invoice' ),
                'RF10'        => __( "Intrattenimenti, giochi e altre attività di cui alla tariffa allegata al DPR 640/72 (art.74, c.6, DPR 633/72)", 'yith-woocommerce-pdf-invoice' ),
                'RF11'        => __( "Agenzie viaggi e turismo (art.74-ter, DPR 633/72)", 'yith-woocommerce-pdf-invoice' ),
                'RF12'        => __( "Agriturismo (art.5, c.2, L. 413/91)", 'yith-woocommerce-pdf-invoice' ),
                'RF13'        => __( "Vendite a domicilio (art.25-bis, c.6, DPR  600/73)", 'yith-woocommerce-pdf-invoice' ),
                'RF14'        => __( "Rivendita beni usati, oggetti d’arte, d’antiquariato o da collezione (art.36, DL 41/95) ", 'yith-woocommerce-pdf-invoice' ),
                'RF15'        => __( "Agenzie di vendite all’asta di oggetti d’arte, antiquariato o da collezione (art.40-bis, DL 41/95)", 'yith-woocommerce-pdf-invoice' ),
                'RF16'        => __( "IVA per cassa P.A. (art.6, c.5, DPR 633/72)", 'yith-woocommerce-pdf-invoice' ),
                'RF17'        => __( "IVA per cassa (art. 32-bis, DL 83/2012)", 'yith-woocommerce-pdf-invoice' ),
                'RF18'        => __( "Altro", 'yith-woocommerce-pdf-invoice' ),
                'RF19'        => __( "Regime forfettario (art.1, c.54-89, L. 190/2014)", 'yith-woocommerce-pdf-invoice' ),
            ),
            'default' => 'RF01',
        ),
        'chargeability_vat'                    => array(
            'name'    => __( 'Esigibilità IVA', 'yith-woocommerce-pdf-invoice' ),
            'type'    => 'select',
            'id'      => 'ywpi_electronic_invoice_chargeability_vat',
            'options' => array(
                'I'        => __( "IVA ad esigibilità immediata", 'yith-woocommerce-pdf-invoice' ),
                'D'        => __( "IVA ad esigibilità differita", 'yith-woocommerce-pdf-invoice' ),
                'S'        => __( "Scissione dei pagamenti", 'yith-woocommerce-pdf-invoice' ),
            ),
            'default' => 'I',
        ),
        'company_registered_name' => array(
            'name' => __('Nome registrato azienda', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_company_registered_name',
            'desc' => __('Inserisci il nome con cui l\'azienda è stata registrata', 'yith-woocommerce-pdf-invoice'),
            'default' => '',
        ),
        'company_address' => array(
            'name' => __('Indirizzo', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_company_address',
            'desc' => __('Imposta l\'indirizzo della tua azienda', 'yith-woocommerce-pdf-invoice'),
            'default' => '',
        ),
        'company_cap' => array(
            'name' => __('CAP', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_company_cap',
            'desc' => __('Imposta il CAP della tua azienda', 'yith-woocommerce-pdf-invoice'),
            'default' => '',
        ),
        'company_city' => array(
            'name' => __('Città dell\'azienda', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_company_city',
            'desc' => __('Imposta la città della tua azienda', 'yith-woocommerce-pdf-invoice'),
            'default' => '',
        ),
        'company_province' => array(
            'name' => __('Provincia azienda', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_company_province',
            'desc' => __('Imposta la provincia della tua azienda', 'yith-woocommerce-pdf-invoice'),
            'default' => '',
        ),

//        'company_state' => array(
//            'name' => __('Company state', 'yith-woocommerce-pdf-invoice'),
//            'type' => 'text',
//            'id' => 'ywpi_electronic_invoice_company_state',
//            'desc' => __('Set the state of your company', 'yith-woocommerce-pdf-invoice'),
//            'default' => '',
//        ),
//        'include-tracking-info' => array(
//            'name' => __('Include tracking info', 'yith-woocommerce-pdf-invoice'),
//            'type' => 'checkbox',
//            'id' => 'ywpi_electronic_invoice_include_tracking_info',
//            'desc' => __('Enable this field to include tracking fields inside the XML document. To fill these fields you\'ll have to custom code an integration of these data.', 'yith-woocommerce-pdf-invoice'),
//            'default' => 'no',
//        ),
        array(
            'type' => 'sectionend',
        ),



        array(
            'name' => __('Checkout settings', 'yith-woocommerce-pdf-invoice'),
            'type' => 'title',
        ),
//        'receiver-id' => array(
//            'name' => __('Show receiver ID', 'yith-woocommerce-pdf-invoice'),
//            'type' => 'checkbox',
//            'id' => 'ywpi_electronic_invoice_show_receiver_id',
//            'desc' => __('Check this option to enable the receiver ID (on Checkout and My Account page)', 'yith-woocommerce-pdf-invoice'),
//            'default' => 'yes',
//        ),
        'receiver-id-label' => array(
            'name' => __('Receiver ID label', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_receiver_id_label',
            'desc' => __('Set label for Receiver ID field', 'yith-woocommerce-pdf-invoice'),
            'default' => __( 'Receiver ID','yith-woocommerce-pdf-invoice' ),
        ),
//        'receiver-pec' => array(
//            'name' => __('Show receiver PEC (certified email address)', 'yith-woocommerce-pdf-invoice'),
//            'type' => 'checkbox',
//            'id' => 'ywpi_electronic_invoice_show_receiver_pec',
//            'desc' => __('Check this option to enable the receiver PEC field (on Checkout and My Account page)', 'yith-woocommerce-pdf-invoice'),
//            'default' => 'yes',
//        ),
        'receiver-pec-label' => array(
            'name' => __('Receiver PEC label', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_receiver_pec_label',
            'desc' => __('Set label for Receiver PEC field', 'yith-woocommerce-pdf-invoice'),
            'default' => __( 'Receiver PEC','yith-woocommerce-pdf-invoice' ),
        ),
//        'receiver-type' => array(
//            'name' => __('Show receiver\'s type', 'yith-woocommerce-pdf-invoice'),
//            'type' => 'checkbox',
//            'id' => 'ywpi_electronic_invoice_show_receiver_type',
//            'desc' => __('Check this option to allow your customer to specify if he/she is a private entity or public administration', 'yith-woocommerce-pdf-invoice'),
//            'default' => 'no',
//        ),
        'receiver-mandatory-id-pec-message' => array(
            'name' => __('Messaggio Codice Destianatario/PEC obbligatori', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_receiver_mandatory_id_pec_message',
            'desc' => __('Inserisci il messaggio di errore da mostrare quando Codice Destinatario e/o PEC dell\'utente non sono stati inseriti e diventano obbligatori', 'yith-woocommerce-pdf-invoice'),
            'default' => __('Inserisci almeno uno tra i campi Codice Destinatario e PEC','yith-woocommerce-pdf-invoice')
        ),
        'receiver-mandatory-vat-message' => array(
            'name' => __('Messaggio Partita IVA obbligatoria', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_receiver_mandatory_vat_message',
            'desc' => __('Inserisci il messaggio di errore da mostrare quando il campo Partita IVA diventa obligatorio', 'yith-woocommerce-pdf-invoice'),
            'default' => __( 'Partita IVA è un campo obbligatorio', 'yith-woocommerce-pdf-invoice' )
        ),
        'receiver-mandatory-ssn-message' => array(
            'name' => __('Messaggio Codice Fiscale obbligatorio', 'yith-woocommerce-pdf-invoice'),
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_receiver_mandatory_ssn_message',
            'desc' => __('Inserisci il messaggio di errore da mostrare quando il campo Codice Fiscale diventa obligatorio', 'yith-woocommerce-pdf-invoice'),
            'default' => __('Codice fiscale è un campo obbligatorio','yith-woocommerce-pdf-invoice')
        ),
        array(
            'type' => 'sectionend',
        ),
    ),
);


return apply_filters('ywpi_electronic_options', $general_options);
