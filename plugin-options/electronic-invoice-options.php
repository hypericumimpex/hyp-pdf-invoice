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
            'name' => 'Impostazioni generali', 
            'type' => 'title',
        ),
        'filename_format' => array(
            'name' => 'Nome file', 
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_filename_format',
            'desc' => 'Imposta il formato da utilizzare per il nome del file legato alla fatturazione elettronica. Usa [number], [prefix], [suffix], 
                      [year], [month], [day], [shop_ssn] come segnaposto.
 Ricorda che il nome del file deve rispettare il seguente formato <b>"IDCountryShopSSN_Invoice ID"</b> quindi un esemmpio possibile è <b>IT99999999999_00002.xml</b><br>
 Per informazioni aggiuntive ti invitiamo a controllare <a href="https://www.fatturapa.gov.it/export/fatturazione/it/c-11.htm" target="_blank">questa pagina', 
            'default' => 'IT[shop_ssn]_[number]',
        ),
        array(
            'type' => 'sectionend',
        ),


        array(
            'name' => 'Impostazioni dettagli del soggetto o dell\'azienda trasmittente', 
            'type' => 'title',
        ),
        /*
        'country_id' => array(
            'name' => 'ID del paese', 
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_country_id',
            'desc' => 'Inserisce la sigla del paese', 
            'default' => 'IT',
        ),*/
        'transmitter_id' => array(
            'name' => 'Codice fiscale azienda', 
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_transmitter_id',
            'desc' => 'Inserisci il codice fiscale associato del soggetto o dell\'azienda che emette fattura. Il valore verrà usato come "Transmitter ID" nel file XML', 
            'default' => '',
        ),
        'company_vat' => array(
            'name' => 'Partita IVA azienda', 
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_company_vat',
            'desc' => 'Inserisci la partita IVA del soggetto o dell\'azienda che emette fattura', 
            'default' => '',
        ),
        /*
        'transmission_format' => array(
            'name' => 'Formato trasmissione', 
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_transmission_format',
            'desc' => 'Imposta il formato di trasmissione del documento XML', 
            'default' => 'FPR12',
        ),*/
        'fiscal_regime' => array(
            'name' => 'Regime fiscale', 
            'type' => 'select',
            'id' => 'ywpi_electronic_invoice_fiscal_regime',
            'desc' => 'Imposta il regime fiscale legato al soggetto o all\'azienda che emette fattura', 
            'options' => array(
                'RF01'        =>  "Ordinario",
                'RF02'        =>  "Contribuenti minimi (art.1, c.96-117, L. 244/07)",
                'RF04'        =>  "Agricoltura e attività connesse e pesca (artt.34 e 34-bis, DPR 633/72)",
                'RF05'        =>  "Vendita sali e tabacchi (art.74, c.1, DPR. 633/72)",
                'RF06'        =>  "Commercio fiammiferi (art.74, c.1, DPR  633/72)",
                'RF07'        =>  "Editoria (art.74, c.1, DPR  633/72)",
                'RF08'        =>  "Gestione servizi telefonia pubblica (art.74, c.1, DPR 633/72)",
                'RF09'        =>  "Rivendita documenti di trasporto pubblico e di sosta (art.74, c.1, DPR  633/72) ",
                'RF10'        =>  "Intrattenimenti, giochi e altre attività di cui alla tariffa allegata al DPR 640/72 (art.74, c.6, DPR 633/72)",
                'RF11'        =>  "Agenzie viaggi e turismo (art.74-ter, DPR 633/72)",
                'RF12'        =>  "Agriturismo (art.5, c.2, L. 413/91)",
                'RF13'        =>  "Vendite a domicilio (art.25-bis, c.6, DPR  600/73)",
                'RF14'        =>  "Rivendita beni usati, oggetti d’arte, d’antiquariato o da collezione (art.36, DL 41/95) ",
                'RF15'        =>  "Agenzie di vendite all’asta di oggetti d’arte, antiquariato o da collezione (art.40-bis, DL 41/95)",
                'RF16'        =>  "IVA per cassa P.A. (art.6, c.5, DPR 633/72)",
                'RF17'        =>  "IVA per cassa (art. 32-bis, DL 83/2012)",
                'RF18'        =>  "Altro",
                'RF19'        =>  "Regime forfettario (art.1, c.54-89, L. 190/2014)",
            ),
            'default' => 'RF01',
        ),
        'chargeability_vat'                    => array(
            'name'    =>  'Esigibilità IVA',
            'type'    => 'select',
            'id'      => 'ywpi_electronic_invoice_chargeability_vat',
            'options' => array(
                'I'        =>  "IVA ad esigibilità immediata",
                'D'        =>  "IVA ad esigibilità differita",
                'S'        =>  "Scissione dei pagamenti",
            ),
            'default' => 'I',
        ),
        'company_registered_name' => array(
            'name' => 'Nome registrato azienda', 
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_company_registered_name',
            'desc' => 'Inserisci il nome con cui l\'azienda è stata registrata', 
            'default' => '',
        ),
        'company_address' => array(
            'name' => 'Indirizzo', 
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_company_address',
            'desc' => 'Imposta l\'indirizzo della tua azienda', 
            'default' => '',
        ),
        'company_cap' => array(
            'name' => 'CAP', 
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_company_cap',
            'desc' => 'Imposta il CAP della tua azienda', 
            'default' => '',
        ),
        'company_city' => array(
            'name' => 'Città dell\'azienda', 
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_company_city',
            'desc' => 'Imposta la città della tua azienda', 
            'default' => '',
        ),
        'company_province' => array(
            'name' => 'Provincia azienda', 
            'type' => 'select',
            'id' => 'ywpi_electronic_invoice_company_province',
            'desc' => 'Inserisci la provincia della tua azienda',
            'options'   =>  wc()->countries->get_states( 'IT' ),
            'default' => '',
        ),

//        'company_state' => array(
//            'name' => 'Company state', 
//            'type' => 'text',
//            'id' => 'ywpi_electronic_invoice_company_state',
//            'desc' => 'Set the state of your company', 
//            'default' => '',
//        ),
//        'include-tracking-info' => array(
//            'name' => 'Include tracking info', 
//            'type' => 'checkbox',
//            'id' => 'ywpi_electronic_invoice_include_tracking_info',
//            'desc' => 'Enable this field to include tracking fields inside the XML document. To fill these fields you\'ll have to custom code an integration of these data.', 
//            'default' => 'no',
//        ),
        array(
            'type' => 'sectionend',
        ),



        array(
            'name' => 'Impostazioni Checkout', 
            'type' => 'title',
        ),
//        'receiver-id' => array(
//            'name' => 'Show receiver ID', 
//            'type' => 'checkbox',
//            'id' => 'ywpi_electronic_invoice_show_receiver_id',
//            'desc' => 'Check this option to enable the receiver ID (on Checkout and My Account page)', 
//            'default' => 'yes',
//        ),
        'receiver-id-label' => array(
            'name' => 'Etichetta Codice Destinatario', 
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_receiver_id_label',
            'desc' => 'Seleziona l\'etichetta da mostrare per il campo Codice Destinatario', 
            'default' =>  'Receiver ID',
        ),
//        'receiver-pec' => array(
//            'name' => 'Show receiver PEC (certified email address)', 
//            'type' => 'checkbox',
//            'id' => 'ywpi_electronic_invoice_show_receiver_pec',
//            'desc' => 'Check this option to enable the receiver PEC field (on Checkout and My Account page)', 
//            'default' => 'yes',
//        ),
        'receiver-pec-label' => array(
            'name' => 'Etichetta PEC Destinatario', 
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_receiver_pec_label',
            'desc' => 'Seleziona l\'etichetta da mostrare per il campo PEC Destinatario', 
            'default' =>  'PEC Destiantario',
        ),
//        'receiver-type' => array(
//            'name' => 'Show receiver\'s type', 
//            'type' => 'checkbox',
//            'id' => 'ywpi_electronic_invoice_show_receiver_type',
//            'desc' => 'Check this option to allow your customer to specify if he/she is a private entity or public administration', 
//            'default' => 'no',
//        ),
        'receiver-mandatory-id-pec-message' => array(
            'name' => 'Messaggio Codice Destianatario/PEC obbligatori', 
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_receiver_mandatory_id_pec_message',
            'desc' => 'Inserisci il messaggio di errore da mostrare quando Codice Destinatario e/o PEC dell\'utente non sono stati inseriti e diventano obbligatori', 
            'default' => 'Inserisci almeno uno tra i campi Codice Destinatario e PEC',
        ),
        'receiver-mandatory-vat-message' => array(
            'name' => 'Messaggio Partita IVA obbligatoria', 
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_receiver_mandatory_vat_message',
            'desc' => 'Inserisci il messaggio di errore da mostrare quando il campo Partita IVA diventa obligatorio', 
            'default' =>  'Partita IVA è un campo obbligatorio'
        ),
        'receiver-mandatory-ssn-message' => array(
            'name' => 'Messaggio Codice Fiscale obbligatorio', 
            'type' => 'text',
            'id' => 'ywpi_electronic_invoice_receiver_mandatory_ssn_message',
            'desc' => 'Inserisci il messaggio di errore da mostrare quando il campo Codice Fiscale diventa obligatorio', 
            'default' => 'Codice fiscale è un campo obbligatorio',
        ),
        array(
            'type' => 'sectionend',
        ),
    ),
);


return apply_filters('ywpi_electronic_options', $general_options);
