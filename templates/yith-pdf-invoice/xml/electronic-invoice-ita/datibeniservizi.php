<DatiBeniServizi>

    <?php
    wc_get_template( 'yith-pdf-invoice/xml/'. $type .'/dettagliolinee.php',
    array( 'document' => $document, 'type' => $type),
    '',
    YITH_YWPI_TEMPLATE_DIR  );


    wc_get_template( 'yith-pdf-invoice/xml/'. $type .'/datiriepilogo.php',
        array( 'document' => $document, 'type' => $type),
        '',
        YITH_YWPI_TEMPLATE_DIR  );
    ?>

</DatiBeniServizi>