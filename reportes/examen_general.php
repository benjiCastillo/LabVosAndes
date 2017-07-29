<?php
$id='10';
$idp='28';
// $id=$_POST[''];
// $idp=$_POST[''];


header('Content-Type: text/html; charset=ISO-8859-1');
require_once('tcpdf/tcpdf.php');
require('conexion.php');

$con=Conectar();

$sqlp = 'SELECT p.nombre, p.apellidos, p.edad, m.nombre, m.apellidos, e.fecha FROM examen e INNER JOIN paciente p ON e.id_paciente=p.id INNER JOIN medico m ON e.id_medico=m.id WHERE p.id=?';
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
$pdf->SetTextColor(0,0,0);
$image_file = K_PATH_IMAGES.'logovosandes.jpg';

$pdf->Image($image_file, 30, 2, 20, '', 'JPG', '', 'T', false, 200, '', false, false, 0, false, false, false);
$pdf->Ln(3);

$titleP = '<p><b>LABORATORIO DE ANÁLISIS CLÍNICO</b> <b style="color: rgb(150,0,0)">"VOS ANDES"</b></p>';
$pdf->writeHTML($titleP, true, false, false, false, 'C');
$pdf->Ln(2);
$pdf->SetFont('helvetica', '', 11);
$pdf->Cell(0, 15, '                                  Dir.: Av. Camacho esq. Oruro Clínica 1º de mayo', 0, false, 'L', 0, '', 0, false, 'M', 'M');
$pdf->Ln(5);
$pdf->Cell(0, 15, '                                  Telf.: 62-23510        Cel.: 72414698        Emergencias las 24 horas.', 0, false, 'L', 0, '', 0, false, 'M', 'M');

$style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(31, 77, 120));
$pdf->Line(2, 22, 212, 22, $style);

// set alpha to semi-transparency
$pdf->SetAlpha(1);

// draw jpeg image
$pdf->Image(K_PATH_IMAGES.'fondo.jpg', 48, 25, 120, 80, '', '', '', true, 200);

$pdf->Ln(8);
foreach ($rowp as $rows1){
$initData = '<table>
                <tr>
                    <td>Nombre: '.$rows1[0].' '.$rows1[1].'</td>
                    <td>Edad: '.$rows1[2].'</td>
                </tr>
                <tr>
                    <td>Dr.(a): '.$rows1[3].' '.$rows1[4].'</td>
                    <td>Fecha: '.$rows1[5].'</td>
                </tr>
            </table>'; 
    $nombre = 'GeneralO_'.$rows1[0].'_'.$rows1[1]; 
}
$pdf->writeHTMLCell($w=180, $h=0, $x='40', $y='', $initData, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetFont('helvetica','',11);
$title = '<p><b>EXÁMEN GENERAL DE ORINA</b></p>';
$pdf->writeHTML($title, true, false, true, false, 'C');
$pdf->Ln(1);
foreach ($row as $rows){

$tabla1 = '<table>
                <tr>
                    <td><b>Exámen Físico</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Color: asdawdsdgfasdgzxcbzdcvsfdvasd</td>
                    <td>Ámbar</td>
                </tr>
                <tr>
                    <td>Cantidad: </td>
                    <td></td>
                </tr>
                <tr>
                    <td>Olor: </td>
                    <td>Suigéneris</td>
                </tr>
                <tr>
                    <td>Aspecto: asdasdasdasdasd</td>
                    <td>Límpido</td>
                </tr>
                <tr>
                    <td>Espuma: </td>
                    <td>Blanca Fugaz</td>
                </tr>
                <tr>
                    <td>Sedimento: </td>
                    <td>Escaso o/nulo</td>
                </tr>
                <tr>
                    <td>Densidad: </td>
                    <td>1012 - 1030</td>
                </tr>
                <tr>
                    <td>Reacción</td>
                    <td>Ácida</td>
                </tr>
</table>';

$tabla2 = '<table>
                <tr>
                    <td><b>Exámen Químico</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Proteínas: </td>
                    <td>No contiene</td>
                </tr>
                <tr>
                    <td>Glucosa: </td>
                    <td>No contiene</td>
                </tr>
                <tr>
                    <td>Cetona: </td>
                    <td>No contiene</td>
                </tr>
                <tr>
                    <td>Bilirrubina: </td>
                    <td>No contiene</td>
                </tr>
                <tr>
                    <td>Sangre: </td>
                    <td>No contiene</td>
                </tr>
                <tr>
                    <td>Nitritos: </td>
                    <td>No contiene</td>
                </tr>
                <tr>
                    <td>Urubilinogeno: </td>
                    <td>0,1 - 1 mg/dl</td>
                </tr>
</table>';

$tabla3 = '<table>
                <tr>
                    <td><b>Exámen Microscópico Sedimento</b></td>
                </tr>
                <tr>
                    <td>Eritrocitos: </td>
                </tr>
                <tr>
                    <td>Piocitos: </td>
                </tr>
                <tr>
                    <td>Leucocitos: </td>
                </tr>
                <tr>
                    <td>Cilindros: </td>
                </tr>
                <tr>
                    <td>Células</td>
                </tr>
                <tr>
                    <td>Cristales: </td>
                </tr>
                <tr>
                    <td>Otros: </td>
                </tr>

</table>';

$tabla4 = '<table>
        
        <tr>
            <td><b>Exámen Bacteriológico Sedimento</b></td>
        </tr>
        <tr>
            <td>'.$rows[23].'</td>
        </tr>
    </table>';

}
$pdf->writeHTMLCell($w=80, $h=0, $x='5', $y='42', $tabla1, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->writeHTMLCell($w=70, $h=0, $x='79', $y='42', $tabla2, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->writeHTMLCell($w=80, $h=0, $x='145', $y='42', $tabla3, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->writeHTMLCell($w=0, $h=0, $x='5', $y='92', $tabla4, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetFont('helvetica','',9);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA</b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='110', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$pdf->Output($nombre.'.pdf', 'I');
?>