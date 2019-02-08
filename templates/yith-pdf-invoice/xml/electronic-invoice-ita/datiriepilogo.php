<?php
$taxes = array();
$order_items = $document->order->get_items();
foreach ( $order_items as $item_id => $item ): 
    $tax_percentage = null;

    if( $item['line_total'] != 0 && $item['line_total'] != '' ):
        $tax_percentage = round($item['line_tax']*100/$item['line_total'],1, PHP_ROUND_HALF_UP );
    else:
        $tax_percentage = 0;
    endif;

    $taxes[$tax_percentage] = array(
        'total' => $taxes[$tax_percentage]['total'] + $item['total'],
        'total_tax'   => $taxes[$tax_percentage]['total_tax'] + $item['total_tax']
    );
endforeach;

?>

<?php foreach ( $taxes as $key => $tax ): ?>

    <?php $tax_percentage = number_format( $key, 2, '.', ''); ?>

    <?php $total = number_format( $tax['total'], 2, '.', ''); ?>

    <?php $total_tax = number_format( $tax['total_tax'], 2, '.', ''); ?>

    <DatiRiepilogo>
        <AliquotaIVA><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', $tax_percentage, 'AliquotaIVA',$document )?></AliquotaIVA>
        <?php if( $tax_percentage == '0.00' ): ?>
            <Natura>N4</Natura>
        <?php endif; ?>
        <ImponibileImporto><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', $total , 'ImponibileImporto',$document )?></ImponibileImporto>
        <Imposta><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', $total_tax , 'Imposta',$document )?></Imposta>
        <EsigibilitaIVA>D</EsigibilitaIVA>
    </DatiRiepilogo>
<?php endforeach; ?>

