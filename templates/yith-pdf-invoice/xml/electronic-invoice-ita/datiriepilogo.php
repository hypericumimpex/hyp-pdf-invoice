<?php
$order_items = $document->order->get_items();
$tax_percentage = 0;
foreach ( $order_items as $item_id => $item ):
    $product = $item->get_product();
    if( $item['line_total'] != 0 && $item['line_total'] != '' ):
        $tax_percentage = $item['line_tax']*100/$item['line_total'];
        break;
    else:
        $tax_percentage = '0';
    endif;
endforeach;

$order_taxes = $document->order->get_tax_totals();

$order_taxes_total = 0.00;
foreach ( $order_taxes as $code => $tax ) {
    $order_taxes_total += $tax->amount;
}

?>

<DatiRiepilogo>
    <AliquotaIVA><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', $tax_percentage, 'AliquotaIVA',$document )?></AliquotaIVA>
    <ImponibileImporto><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', $document->order->get_subtotal() , 'ImponibileImporto',$document )?></ImponibileImporto>
    <Imposta><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', $order_taxes_total , 'Imposta',$document )?></Imposta>
    <EsigibilitaIVA>D</EsigibilitaIVA>
</DatiRiepilogo>