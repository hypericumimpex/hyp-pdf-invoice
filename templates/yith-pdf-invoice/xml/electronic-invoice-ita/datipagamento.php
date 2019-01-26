<DatiPagamento>
    <CondizioniPagamento><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', 'TP02', 'CondizioniPagamento',$document )?></CondizioniPagamento>
    <DettaglioPagamento>
        <ModalitaPagamento><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', YITH_Electronic_Invoice()->get_payment_method( $document ), 'ModalitaPagamento',$document )?></ModalitaPagamento>
        <ImportoPagamento><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', $document->order->get_total(), 'ImportoPagamento',$document )?></ImportoPagamento>
    </DettaglioPagamento>
</DatiPagamento>