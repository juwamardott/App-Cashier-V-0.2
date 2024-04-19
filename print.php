<?php

require './dompdf/autoload.inc.php';


use Dompdf\Dompdf;

$dompdf = new Dompdf();


ob_start();
require 'nota.php';
$nota = ob_get_clean();
ob_end_clean();

$html_with_css = '<html><head><link rel="stylesheet" href="./src/output.css"><style>
    @page { margin: 0; }
    body { margin: 0; }
    h1 { text-align: center; }
    .judul {text-align: center;}
    .hero {padding:0 2rem;}
    .content{ height : auto }
</style></head><body><div class="content">' . $nota . '</div></body></html>';
$dompdf->loadHtml($html_with_css);


$dompdf->setPaper(array(0, 0, 263, 10000), 'portrait');


$dompdf->render();


$dompdf->stream();