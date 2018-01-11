<?php
function createPDF() {
    $pdf = new TCPDF('P', PDF_UNIT, 'LETTER', true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Dra. María Luz Nina Colque');
    $pdf->SetTitle('Exámen Biometría Hemática');
    $pdf->SetSubject('Vos Andes');
    $pdf->SetKeywords('Reporte, Vos Andes, Biometria Hemática');
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetAutoPageBreak(TRUE, '0');
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    if (@file_exists(dirname(__FILE__).'/tcpdf/example/lang/spa.php')) {
        require_once(dirname(__FILE__).'/tcpdf/example/lang/spa.php');
        $pdf->setLanguageArray($l);
    }
    return $pdf;
}

?>