<?php
require_once '../pdfGracieuxProvisoire.php';
$pdf = new pdf();
echo $pdf->getDossierPdf($_GET["id"]);
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>