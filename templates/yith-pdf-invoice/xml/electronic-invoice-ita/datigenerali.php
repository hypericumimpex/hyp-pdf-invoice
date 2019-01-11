<?php
?>

<DatiGenerali>
    <DatiGeneraliDocumento>
        <TipoDocumento><?php echo apply_filters( 'ywpi_electronic_invoice_field_value','TD01','TipoDocumento',$document ) ?></TipoDocumento>
        <Divisa><?php echo apply_filters( 'ywpi_electronic_invoice_field_value',$document->order->get_currency(),'Divisa',$document ) ?></Divisa>
        <Data><?php echo apply_filters( 'ywpi_electronic_invoice_field_value',$document->order->get_date_created() ,'Data', $document ) ?></Data>
        <Numero><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', $document->order->get_meta('ywpi_invoice_number'), 'Numero',$document )?></Numero> <!-- numero fattura -->
        <Causale><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', '', 'Causale', $document )?></Causale>
    </DatiGeneraliDocumento>
    <DatiOrdineAcquisto>
        <RiferimentoNumeroLinea><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', '', 'RiferimentoNumeroLinea', $document )?></RiferimentoNumeroLinea>
        <IdDocumento><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', $document->order->get_meta('ywpi_invoice_number'), 'IdDocumento', $document )?></IdDocumento>
        <NumItem><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', $document->order->get_meta('ywpi_invoice_number'), 'NumItem',$document )?></NumItem>
        <?php if( $document->is_pa_customer() ): ?>
            <CodiceCUP><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', '', 'CodiceCUP',$document )?></CodiceCUP>
            <CodiceCIG><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', '', 'CodiceCIG',$document )?></CodiceCIG>
        <?php endif; ?>
    </DatiOrdineAcquisto>

    <?php if( YITH_Electronic_Invoice()->include_tracking_info == 'yes' ): ?>
        <DatiTrasporto>
            <DatiAnagraficiVettore>
                <IdFiscaleIVA>
                    <IdPaese><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', '', 'IdPaese',$document )?></IdPaese>
                    <IdCodice><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', '', 'IdCodice',$document )?></IdCodice>
                </IdFiscaleIVA>
                <Anagrafica>
                    <Denominazione><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', '', 'Denominazione',$document )?></Denominazione>
                </Anagrafica>
            </DatiAnagraficiVettore>
            <DataOraConsegna><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', '', 'DataOraConsegna',$document )?></DataOraConsegna>
        </DatiTrasporto>
    <?php endif; ?>

    <?php if( $document->is_pa_customer() ): ?>
        <DatiContratto>
            <RiferimentoNumeroLinea></RiferimentoNumeroLinea>
            <IdDocumento></IdDocumento>
            <Data></Data>
            <NumItem></NumItem>
            <CodiceCUP></CodiceCUP>
            <CodiceCIG></CodiceCIG>
        </DatiContratto>
        <DatiConvenzione>
            <RiferimentoNumeroLinea></RiferimentoNumeroLinea>
            <IdDocumento></IdDocumento>
            <NumItem></NumItem>
            <CodiceCUP></CodiceCUP>
            <CodiceCIG></CodiceCIG>
        </DatiConvenzione>
        <DatiRicezione>
            <RiferimentoNumeroLinea></RiferimentoNumeroLinea>
            <IdDocumento></IdDocumento>
            <NumItem></NumItem>
            <CodiceCUP></CodiceCUP>
            <CodiceCIG></CodiceCIG>
        </DatiRicezione>
    <?php endif; ?>
</DatiGenerali>