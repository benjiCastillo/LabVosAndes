<?php
function createPDF($title) {
    $pdf = new TCPDF('P', PDF_UNIT, 'LETTER', true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Dra. María Luz Nina Colque');
    $pdf->SetTitle($title);
    $pdf->SetSubject('Vos Andes');
    $pdf->SetKeywords('Reporte, Vos Andes');
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

    $pdf->SetFont('helvetica', '', 12);
    $pdf->SetLeftMargin(15);
    $pdf->AddPage();

    $pdf->SetTextColor(37,65,98);

    $image_file = K_PATH_IMAGES.'logovosandes.jpg';
    $pdf->Image($image_file, 30, 2, 20, '', 'JPG', '', 'T', false, 200, '', false, false, 0, false, false, false);
    $pdf->Ln(3);

    $titleP = '<p><b>LABORATORIO DE ANÁLISIS CLÍNICO</b> <b style="color: rgb(150,0,0)">"VOS ANDES"</b></p>';
    $pdf->writeHTML($titleP, true, false, false, false, 'C');
    $pdf->Ln(2);
    $pdf->SetFont('helvetica', '', 11);
    $pdf->Cell(0, 15, '                                  Dir.: Av. Camacho esq. Oruro Clínica 1º de mayo        Telf.: 62-23510', 0, false, 'L', 0, '', 0, false, 'M', 'M');
    $pdf->Ln(5);
    $pdf->Cell(0, 15, '                                  Cel.: 72414698        E-mail: labvosandes@gmail.com        Emergencias las 24 horas.', 0, false, 'L', 0, '', 0, false, 'M', 'M');

    $style = array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(31, 77, 120));
    $pdf->Line(152.5, 19.5, 199, 19.5, $style);
    $style1 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(31, 77, 120));
    $pdf->Line(2, 22, 212, 22, $style1);

    return $pdf;
}

?>