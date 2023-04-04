<?php
require_once '../pdfGracieux.php';
$pdf = new pdf();
echo $pdf->getDossierPdf($_GET["id"]);
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>