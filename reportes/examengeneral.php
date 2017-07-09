<?php
// $ide='4';

require_once('tcpdf/tcpdf.php');
require('conexion.php');
// $con=Conectar();
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Dr. Méndez Mejía Erwin');
$pdf->SetTitle('Reporte Exámen General');
$pdf->SetSubject('Vos Andes');
$pdf->SetKeywords('Reporte, persona, Andes');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
if (@file_exists(dirname(__FILE__).'/tcpdf/example/lang/spa.php')) {
    require_once(dirname(__FILE__).'/tcpdf/example/lang/spa.php');
    $pdf->setLanguageArray($l);
}
$pdf->SetFont('helvetica', 'BI', 12);
$pdf->SetLeftMargin(15);
$pdf->AddPage();
$pdf->SetFont('helvetica', 'B', 9);
$pdf->SetFillColor(59,78,20);
$pdf->SetTextColor(0,0,0);
$image_file = K_PATH_IMAGES.'logo.jpg';

$pdf->Image($image_file, 10, 10, 25, '', 'JPG', '', 'T', false, 200, '', false, false, 0, false, false, false);
$pdf->Ln(6);
$pdf->Cell(0, 15, '                         Laboratorio de análisis clínico "Vosandes"', 0, false, 'L', 0, '', 0, false, 'M', 'M');
$pdf->Ln(4);
$pdf->Cell(0, 15, '                         Av. Camacho esquina Oruro (Clínica 1ro de mayo)', 0, false, 'L', 0, '', 0, false, 'M', 'M');
$pdf->Ln(4);
$pdf->Cell(0, 15, '                         Teléfono laboratorio: 622-3510', 0, false, 'L', 0, '', 0, false, 'M', 'M');
$pdf->Ln(4);
$pdf->Cell(0, 15, '                         Teléfono domicilio: 624-2942', 0, false, 'L', 0, '', 0, false, 'M', 'M');
$pdf->Ln(4);
$pdf->Cell(0, 15, '                         Celular: 72416189', 0, false, 'L', 0, '', 0, false, 'M', 'M');
$pdf->Ln(4);
$pdf->Cell(0, 15, '                         Emergencias las 24 Horas.', 0, false, 'L', 0, '', 0, false, 'M', 'M');
$pdf->SetLeftMargin(10);
$pdf->Ln(12);
$pdf->SetFont('helvetica','',10);
// $pdf->Cell(0, 4, '                          Paciente: Erwin Méndez Mejía                                            Edad: 21', 0,0);
// $pdf->Ln(4);
// $pdf->Cell(0, 4, '                          Dr(a): Harold Castillo                                                           Fecha: 08-07-2017', 0, 0);
// $pdf->Ln(4);
$initData = '<table>
                <tr>
                    <td>Paciente: Erwin Méndez Mejía</td>
                    <td>Edad: 21</td>
                </tr>
                <tr>
                    <td>Dr(a): Harold Castillo</td>
                    <td>Fecha: 08/09/2017</td>
                </tr>
            </table>';
$pdf->writeHTML($initData, true, false, false, false, 'L');
$title = '<b><h1>Exámen General</h1></b>';
$pdf->writeHTML($title, true, false, false, false, 'C');
$pdf->Cell(0, 15, 'Nombre exámen    Resutado    Valor de referencia', 0, false, 'L', 0, '', 0, false, 'M', 'M');
$pdf->Output('reporte.pdf', 'I');
?>