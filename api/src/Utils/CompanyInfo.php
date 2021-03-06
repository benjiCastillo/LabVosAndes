<?php

namespace App\Utils;

use TCPDF;

/**
 * Constants
 * @author Erwin Méndez Mejía <erwinXYZ1@gmail.com>
 */
class CompanyInfo {

    public function createPDF($title = 'Vos Andes') {
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
        $pdf->SetFont('helvetica', '', 12);
        $pdf->SetLeftMargin(15);
        $pdf->AddPage();

        $pdf->SetTextColor(37,65,98);

        $image_file = WWW_ROOT . 'img' . DS . 'logovosandes.jpg';
        $pdf->Image($image_file, 17, 2, 20, '', 'JPG', '', 'T', false, 200, '', false, false, 0, false, false, false);
        $pdf->Ln(3);

        $titleP = '<p><b>LABORATORIO DE ANÁLISIS CLÍNICO</b> <b style="color: rgb(150,0,0)">"VOS ANDES"</b></p>';
        $pdf->writeHTMLCell($w=120, $h=0, $x='35', $y='', $titleP, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);
        $pdf->Ln(3);
        $pdf->SetFont('helvetica', '', 11);
        $pdf->Cell(0, 15, '                       Dir.: Av. Camacho esq. Oruro Clínica 1º de mayo        Telf.: 62-23510', 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $pdf->Ln(5);
        $pdf->Cell(0, 15, '                       Cel.: 72414698 - 69643269    E-mail: labvosandes@gmail.com    Emergencias las 24 horas.', 0, false, 'L', 0, '', 0, false, 'M', 'M');

        $style = array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(31, 77, 120));
        $pdf->Line(152.5, 20.5, 199, 20.5, $style);
        $style1 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(31, 77, 120));
        $pdf->Line(2, 22, 212, 22, $style1);

        return $pdf;
    }

    public function seal($pos_x = 0, $pos_y = 0) {

    }
}
?>
