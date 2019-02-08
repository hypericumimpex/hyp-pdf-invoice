<?php
$order_items = $document->order->get_items();
$i=1;
foreach ( $order_items as $item_id => $item ):

    if( $item['line_total'] != 0 && $item['line_total'] != '' ):
         $tax_percentage = $item['line_tax']*100/$item['line_total'];
    else:
        $tax_percentage = '0';
    ?>
    <?php endif; ?>
    <?php $quantity = number_format( $item->get_quantity(), 2, '.', ''); ?>
    <?php $price =  number_format( $item['subtotal'] / $item->get_quantity(), 2, '.', ''); ?>
    <?php $tax_percentage = number_format( $tax_percentage, 2, '.', ''); ?>
    <?php $discount = YITH_Electronic_Invoice()->get_discount_increment( $item )  ?>
    <?php $total_price = number_format( $item['total'] - $discount, 2, '.', '') ?>

    <DettaglioLinee>
        <NumeroLinea><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', $i, 'NumeroLinea',$document )?></NumeroLinea>
        <Descrizione><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', $item['name'] , 'Descrizione',$document );  ?></Descrizione>
        <Quantita><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', $quantity , 'Quantita',$document ); ?></Quantita>
        <PrezzoUnitario><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', $price , 'PrezzoUnitario',$document ); ?></PrezzoUnitario>
        <?php if( $discount > 0 ): ?>
            <ScontoMaggiorazione>
                <Tipo>SC</Tipo>
                <Importo><?php echo YITH_Electronic_Invoice()->get_discount_increment( $item, true ); ?></Importo>
            </ScontoMaggiorazione>
        <?php endif; ?>


        <PrezzoTotale><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', $total_price, 'PrezzoTotale',$document ); ?></PrezzoTotale>
        <AliquotaIVA><?php echo apply_filters( 'ywpi_electronic_invoice_field_value', $tax_percentage , 'AliquotaIVA',$document ); ?></AliquotaIVA>
        <?php if( $tax_percentage == '0.00' ): ?>
            <Natura>N4</Natura>
        <?php endif; ?>
    </DettaglioLinee>
    <?php $i++ ;?>
<?php endforeach; ?>
