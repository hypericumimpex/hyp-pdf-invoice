<?php
$billing_data = $document->order->get_data()['billing'];
$billing_country = $document->order->get_billing_country();
$billing_company = $document->order->get_billing_company();
$billing_receiver_id = YITH_Electronic_Invoice()->get_billing_receiver_id( $document );
$billing_vat_number = YITH_Electronic_Invoice()->get_billing_vat_number( $document );
$billing_vat_ssn = YITH_Electronic_Invoice()->get_billing_vat_ssn( $document );
?>

<FatturaElettronicaHeader>
    <DatiTrasmissione>
        <IdTrasmittente>
            <IdPaese><?php echo get_option( 'ywpi_electronic_invoice_country_id','IT' ); ?></IdPaese>
            <IdCodice><?php echo get_option( 'ywpi_electronic_invoice_transmitter_id' ); ?></IdCodice>
        </IdTrasmittente>
        <ProgressivoInvio><?php echo $document->formatted_number; ?></ProgressivoInvio>
        <FormatoTrasmissione><?php echo get_option('ywpi_electronic_invoice_transmission_format','FPR12'); ?></FormatoTrasmissione>
        <CodiceDestinatario><?php echo $billing_receiver_id; ?></CodiceDestinatario>
        <?php if( $billing_receiver_id == '0000000' && $document->order->get_meta('_billing_receiver_pec') != '' ) : ?>
            <PECDestinatario><?php echo $document->order->get_meta('_billing_receiver_pec')?></PECDestinatario>
        <?php endif; ?>
    </DatiTrasmissione>
    <CedentePrestatore>
        <DatiAnagrafici>
            <IdFiscaleIVA>
                <IdPaese><?php echo get_option( 'ywpi_electronic_invoice_country_id','IT' ); ?></IdPaese>
                <IdCodice><?php echo get_option( 'ywpi_electronic_invoice_company_vat' ); ?></IdCodice>
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
            <Nazione>IT</Nazione>
        </Sede>
    </CedentePrestatore>
    <CessionarioCommittente>
        <DatiAnagrafici>
            <?php if( $billing_company != '' ): ?>
                <IdFiscaleIVA>
                    <IdPaese><?php echo $billing_country ?></IdPaese>
                    <IdCodice><?php echo $billing_vat_number ?></IdCodice>
                </IdFiscaleIVA>
            <?php endif; ?>
            <?php if( $billing_vat_ssn != '' ): ?>
                <CodiceFiscale><?php echo strtoupper($billing_vat_ssn) ?></CodiceFiscale>
            <?php endif; ?>
            <Anagrafica>
                <?php if( $billing_data['company'] != '' ): ?>
                    <Denominazione><?php echo $billing_data['company']; ?></Denominazione>
                <?php else: ?>
                    <Nome><?php echo $billing_data['first_name']; ?></Nome>
                    <Cognome><?php echo $billing_data['last_name']; ?></Cognome>
                <?php endif; ?>
            </Anagrafica>

        </DatiAnagrafici>
        <Sede>
            <Indirizzo><?php echo $billing_data['address_1']; ?></Indirizzo>
            <CAP><?php echo $billing_data['postcode']; ?></CAP>
            <Comune><?php echo $billing_data['city']; ?></Comune>
            <?php if( $billing_data['country'] == 'IT' ): ?>
                <Provincia><?php echo $billing_data['state']; ?></Provincia>
            <?php endif; ?>
            <Nazione><?php echo $billing_data['country']; ?></Nazione>
        </Sede>
    </CessionarioCommittente>
</FatturaElettronicaHeader>
