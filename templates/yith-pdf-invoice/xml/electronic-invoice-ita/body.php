<FatturaElettronicaBody>
    <?php
    wc_get_template( 'yith-pdf-invoice/xml/'. $type .'/datigenerali.php',
        array( 'document' => $document, 'type' => $type),
        '',
        YITH_YWPI_TEMPLATE_DIR  );

    wc_get_template( 'yith-pdf-invoice/xml/'. $type .'/datibeniservizi.php',
        array( 'document' => $document, 'type' => $type),
        '',
        YITH_YWPI_TEMPLATE_DIR  );

    wc_get_template( 'yith-pdf-invoice/xml/'. $type .'/datipagamento.php',
        array( 'document' => $document, 'type' => $type),
        '',
        YITH_YWPI_TEMPLATE_DIR  );
    ?>


</FatturaElettronicaBody>