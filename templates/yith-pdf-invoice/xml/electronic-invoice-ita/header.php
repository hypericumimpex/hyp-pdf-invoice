<?php
$billing_data = $document->order->get_data()['billing'];
?>

<FatturaElettronicaHeader>
    <DatiTrasmissione>
        <IdTrasmittente>
            <IdPaese><?php echo get_option( 'ywpi_electronic_invoice_country_id','IT' ); ?></IdPaese>
            <IdCodice><?php echo get_option( 'ywpi_electronic_invoice_transmitter_id' ); ?></IdCodice>
        </IdTrasmittente>
        <ProgressivoInvio><?php echo get_post_meta( $document->order->get_id(),'ywpi_invoice_number',true ); ?></ProgressivoInvio>
        <FormatoTrasmissione><?php echo get_option('ywpi_electronic_invoice_transmission_format'); ?></FormatoTrasmissione>
        <CodiceDestinatario><?php echo $document->order->get_meta('_billing_receiver_id')?></CodiceDestinatario>
        <PECDestinatario><?php echo $document->order->get_meta('_billing_receiver_pec')?></PECDestinatario>
    </DatiTrasmissione>
    <CedentePrestatore> <!-- admin -->
        <DatiAnagrafici>
            <IdFiscaleIVA>
                <IdPaese><?php echo get_option( 'ywpi_electronic_invoice_country_id','IT' ); ?></IdPaese>
                <IdCodice><?php echo get_option( 'ywpi_electronic_invoice_transmitter_id' ); ?></IdCodice>
            </IdFiscaleIVA>
            <Anagrafica>
                <Denominazione><?php echo get_option('ywpi_electronic_invoice_company_registered_name'); ?></Denominazione>
            </Anagrafica>
            <RegimeFiscale><?php echo get_option('ywpi_electronic_invoice_fiscal_regime'); ?></RegimeFiscale>
        </DatiAnagrafici>
        <Sede>
            <Indirizzo><?php echo get_option('ywpi_electronic_invoice_company_address'); ?></Indirizzo>
            <CAP><?php echo get_option('ywpi_electronic_invoice_company_cap'); ?></CAP>
            <Comune><?php echo get_option('ywpi_electronic_invoice_company_city'); ?></Comune>
            <Provincia><?php echo get_option('ywpi_electronic_invoice_company_province'); ?></Provincia>
            <Nazione>Italia</Nazione>
        </Sede>
    </CedentePrestatore>
    <CessionarioCommittente> <!-- cliente -->
        <DatiAnagrafici>
            <CodiceFiscale><?php echo $document->order->get_meta('_billing_vat_ssn'); ?></CodiceFiscale>
            <Anagrafica>
                <Denominazione><?php echo $billing_data['company']; ?></Denominazione>
            </Anagrafica>
        </DatiAnagrafici>
        <Sede>
            <Indirizzo><?php echo $billing_data['address_1']; ?></Indirizzo>
            <CAP><?php echo $billing_data['postcode']; ?></CAP>
            <Comune><?php echo $billing_data['city']; ?></Comune>
            <Provincia><?php echo $billing_data['state']; ?></Provincia>
            <Nazione><?php echo $billing_data['country']; ?></Nazione>
        </Sede>
    </CessionarioCommittente>
</FatturaElettronicaHeader>
