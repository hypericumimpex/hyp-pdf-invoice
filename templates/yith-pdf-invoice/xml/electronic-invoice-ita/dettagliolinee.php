<?php
$order_items = $document->order->get_items();
$i=1;
foreach ( $order_items as $item_id => $item ): ?>
    <?php $product = $item->get_product();
    if( $item['line_total'] != 0 && $item['line_total'] != '' ):
         $tax_percentage = $item['line_tax']*100/$item['line_total'];
    else:
        $tax_percentage = '0'; ?>
    <?php endif; ?>
    <DettaglioLinee>
        <NumeroLinea><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', $i, 'NumeroLinea',$document )?></NumeroLinea>
        <Descrizione><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', $product->get_name() , 'Descrizione',$document );  ?></Descrizione>
        <Quantita><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', $item->get_quantity() , 'Quantita',$document ); ?></Quantita>
        <PrezzoUnitario><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', $product->get_price(), 'PrezzoUnitario',$document ); ?></PrezzoUnitario>
        <PrezzoTotale><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', $product->get_price() * $item->get_quantity(), 'PrezzoTotale',$document ); ?></PrezzoTotale>
        <AliquotaIVA><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', $tax_percentage , 'AliquotaIVA',$document ); ?></AliquotaIVA>
    </DettaglioLinee>
    <?php $i++ ;?>
<?php endforeach; ?>

