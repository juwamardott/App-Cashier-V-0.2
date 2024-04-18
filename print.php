<?php

require './dompdf/autoload.inc.php';

// require './function.php';
// reference the Dompdf namespace
use Dompdf\Dompdf;

$dompdf = new Dompdf();

// Load HTML content (Termasuk HTML dan CSS)
ob_start();
require 'nota.php';
$nota = ob_get_clean();
ob_end_clean();

// Memuat konten CSS
$css_content = file_get_contents('./src/output.css');

// Menyisipkan CSS ke dalam dokumen HTML
$html_with_css = '<html><head><link rel="stylesheet" href="./src/output.css"><style>
    @page { margin: 0; }
    body { margin: 0; }
    h1 { text-align: center; }
    .judul {text-align: center;}
    .hero {padding:0 2rem;}
</style></head><body><div class="content">' . $nota . '</div></body></html>';
$dompdf->loadHtml($html_with_css);

// (Optional) Setup the paper size and orientation
$customPaper = array(0,0,163,460);
$dompdf->setPaper($customPaper);

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();