<?php
$id=$_GET["idExamen"];
$idp=$_GET["idPaciente"];

header('Content-Type: text/html; charset=ISO-8859-1');
require_once('tcpdf/tcpdf.php');
require('conexion.php');

$con=Conectar();

$sqlp = 'SELECT p.nombre, p.apellidos, p.edad, m.nombre, m.apellidos, DATE_FORMAT(e.fecha, "%d-%m-%Y") FROM examen e INNER JOIN paciente p ON e.id_paciente=p.id INNER JOIN medico m ON e.id_medico=m.id WHERE p.id=?';
$stmtp = $con->prepare($sqlp);
$resultsp = $stmtp->execute(array($idp));
$rowp = $stmtp->fetchAll();

$sql = 'SELECT * FROM informes_g WHERE id=?';
$stmt = $con->prepare($sql);
$results = $stmt->execute(array($id));
$row = $stmt->fetchAll();

$pdf = new TCPDF('P', PDF_UNIT, 'LETTER', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Dra. María Luz Nina Colque');
$pdf->SetTitle('Análisis General de Orina');
$pdf->SetSubject('Vos Andes');
$pdf->SetKeywords('Reporte, Vos Andes, Análisis, General, Orina');
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

$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
$pdf->SetFillColor(59,78,20);
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

$style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(31, 77, 120));
$pdf->Line(152.5, 19.5, 199, 19.5, $style);
$pdf->Line(2, 22, 212, 22, $style);

// set alpha to semi-transparency
$pdf->SetAlpha(1);

// draw jpeg image
$pdf->Image(K_PATH_IMAGES.'fondo.jpg', 48, 25, 120, 80, '', '', '', true, 200);

$pdf->Ln(8);
foreach ($rowp as $rows1){
$initData = '<table>
                <tr>
                    <td><p><FONT style="color: rgb(150,0,0)">Nombre: </FONT>'.$rows1[0].' '.$rows1[1].'</p></td>
                    <td><p><FONT style="color: rgb(150,0,0)">Edad: </FONT>'.$rows1[2].'</p></td>
                </tr>
                <tr>
                    <td><p><FONT style="color: rgb(150,0,0)">Dr.(a): </FONT>'.$rows1[3].' '.$rows1[4].'</p></td>
                    <td><p><FONT style="color: rgb(150,0,0)">Fecha: </FONT>'.$rows1[5].'</p></td>
                </tr>
            </table>'; 
    $nombre = 'GeneralO_'.$rows1[0].'_'.$rows1[1]; 
}
$pdf->writeHTMLCell($w=180, $h=0, $x='40', $y='', utf8_encode($initData), $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetFont('helvetica','',11);
$title = '<p><b>ANÁLISIS GENERAL</b></p>';
$pdf->writeHTML($title, true, false, true, false, 'C');
$pdf->Ln(1);
foreach ($row as $rows){
$general = '<table>
                <tr>
                    <td>'.$rows[2].'</td>
                </tr>
            </table>';
}
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='70', utf8_encode($general), $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$pdf->SetFont('helvetica','',9);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA</b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='110', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$pdf->Output($nombre.'.pdf', 'I');
?>