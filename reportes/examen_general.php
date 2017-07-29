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

$sql = 'SELECT * FROM examen_general WHERE id=?';
$stmt = $con->prepare($sql);
$results = $stmt->execute(array($id));
$row = $stmt->fetchAll();

$pdf = new TCPDF('P', PDF_UNIT, 'LETTER', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Dra. María Luz Nina Colque');
$pdf->SetTitle('Exámen General de Orina');
$pdf->SetSubject('Vos Andes');
$pdf->SetKeywords('Reporte, Vos Andes, General, Orina');
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


/*aca*/
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
/*aca*/


$pdf->SetFont('helvetica','',11);
$title = '<p><b>EXÁMEN GENERAL DE ORINA</b></p>';
$pdf->writeHTML($title, true, false, true, false, 'C');
$pdf->Ln(1);
foreach ($row as $rows){

$tabla1 = '<table>
                <tr>
                    <td colspan="3"><b>Exámen Físico</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="75">Color: </td>
                    <td width="60">'.$rows[1].'</td>
                    <td width="90" style="color: rgb(58,137,159)">Ámbar</td>
                </tr>
                <tr>
                    <td>Cantidad: </td>
                    <td>'.$rows[2].'</td>
                    <td style="color: rgb(58,137,159)"></td>
                </tr>
                <tr>
                    <td>Olor: </td>
                    <td>'.$rows[3].'</td>
                    <td style="color: rgb(58,137,159)">Suigéneris</td>
                </tr>
                <tr>
                    <td>Aspecto: </td>
                    <td>'.$rows[4].'</td>
                    <td style="color: rgb(58,137,159)">Límpido</td>
                </tr>
                <tr>
                    <td>Espuma: </td>
                    <td>'.$rows[5].'</td>
                    <td style="color: rgb(58,137,159)">Blanca Fugaz</td>
                </tr>
                <tr>
                    <td>Sedimento: </td>
                    <td>'.$rows[6].'</td>
                    <td style="color: rgb(58,137,159)">Escaso o/nulo</td>
                </tr>
                <tr>
                    <td>Densidad: </td>
                    <td>'.$rows[7].'</td>
                    <td style="color: rgb(58,137,159)">1012 - 1030</td>
                </tr>
                <tr>
                    <td>Reacción: </td>
                    <td>'.$rows[8].'</td>
                    <td style="color: rgb(58,137,159)">Ácida</td>
                </tr>
</table>';

$tabla2 = '<table>
                <tr>
                    <td colspan="3"><b>Exámen Químico</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td td width="95">Proteínas: </td>
                    <td td width="60">'.$rows[9].'</td>
                    <td width="90" style="color: rgb(58,137,159)">No contiene</td>
                </tr>
                <tr>
                    <td>Glucosa: </td>
                    <td>'.$rows[10].'</td>
                    <td style="color: rgb(58,137,159)">No contiene</td>
                </tr>
                <tr>
                    <td>Cetona: </td>
                    <td>'.$rows[11].'</td>
                    <td style="color: rgb(58,137,159)">No contiene</td>
                </tr>
                <tr>
                    <td>Bilirrubina: </td>
                    <td>'.$rows[12].'</td>
                    <td style="color: rgb(58,137,159)">No contiene</td>
                </tr>
                <tr>
                    <td>Sangre: </td>
                    <td>'.$rows[13].'</td>
                    <td style="color: rgb(58,137,159)">No contiene</td>
                </tr>
                <tr>
                    <td>Nitritos: </td>
                    <td>'.$rows[14].'</td>
                    <td style="color: rgb(58,137,159)">No contiene</td>
                </tr>
                <tr>
                    <td>Urubilinogeno: </td>
                    <td>'.$rows[15].'</td>
                    <td style="color: rgb(58,137,159)">0,1 - 1 mg/dl</td>
                </tr>
</table>';

$tabla3 = '<table>
                <tr>
                    <td colspan="2"><b>Exámen Microscópico Sedimento</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td td width="75">Eritrocitos: </td>
                    <td td width="60">'.$rows[16].'</td>
                </tr>
                <tr>
                    <td>Piocitos: </td>
                    <td>'.$rows[17].'</td>
                </tr>
                <tr>
                    <td>Leucocitos: </td>
                    <td>'.$rows[18].' pcm</td>
                </tr>
                <tr>
                    <td>Cilindros: </td>
                    <td>'.$rows[19].'</td>
                </tr>
                <tr>
                    <td>Células: </td>
                    <td>'.$rows[20].'</td>
                </tr>
                <tr>
                    <td>Cristales: </td>
                    <td>'.$rows[21].' pcm</td>
                </tr>
</table>';

$otros = '<p>Otros: '.$rows[22].'</p>';

$tabla4 = '<p><b>Exámen Bacteriológico Sedimento</b></p>';

$bact = '<p>'.$rows[23].'</p>';
}
$pdf->writeHTMLCell($w=0, $h=0, $x='5', $y='42', $tabla1, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->writeHTMLCell($w=0, $h=0, $x='73', $y='42', $tabla2, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->writeHTMLCell($w=110, $h=0, $x='145', $y='42', $tabla3, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='', utf8_encode($otros), $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);


$pdf->Ln(1);
$pdf->writeHTMLCell($w=0, $h=0, $x='5', $y='', $tabla4, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->writeHTMLCell($w=0, $h=0, $x='5', $y='', utf8_encode($bact), $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetTextColor(0,0,0);
$pdf->SetFont('helvetica','',9);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA</b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='110', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$pdf->Output($nombre.'.pdf', 'I');
?>