<?php
require_once '../pdf.php';
$pdf = new pdf();
echo $pdf->getDossierPdf($_GET["id"]);
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>