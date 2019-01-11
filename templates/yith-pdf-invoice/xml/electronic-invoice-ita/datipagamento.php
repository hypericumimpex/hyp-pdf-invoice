<DatiPagamento>
    <CondizioniPagamento><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', 'TP01', 'CondizioniPagamento',$document )?></CondizioniPagamento>
    <DettaglioPagamento>
        <ModalitaPagamento><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', 'MP01', 'ModalitaPagamento',$document )?></ModalitaPagamento>
        <DataScadenzaPagamento><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', '', 'DataScadenzaPagamento',$document )?></DataScadenzaPagamento>
        <ImportoPagamento><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', $document->order->get_total(), 'ImportoPagamento',$document )?></ImportoPagamento>
    </DettaglioPagamento>
</DatiPagamento>