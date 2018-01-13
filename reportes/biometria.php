<?php
// $id=$_GET["idExamen"];
// $idp=$_GET["idPaciente"];
$id=17;
$idp=28;
require_once('tcpdf/tcpdf.php');
require('conexion.php');
require('createPDF.php');

header('Content-Type: text/html; charset=ISO-8859-1');

$con=Conectar();

$sqlp = 'SELECT p.nombre, p.apellidos, p.edad, m.nombre, m.apellidos, DATE_FORMAT(e.fecha, "%d-%m-%Y") FROM examen e INNER JOIN paciente p ON e.id_paciente=p.id INNER JOIN medico m ON e.id_medico=m.id WHERE p.id=?';
$stmtp = $con->prepare($sqlp);
$resultsp = $stmtp->execute(array($idp));
$rowp = $stmtp->fetchAll();

$sql = 'SELECT * FROM biometria WHERE id=?';
$stmt = $con->prepare($sql);
$results = $stmt->execute(array($id));
$row = $stmt->fetchAll();

$pdf = createPDF();
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


$pdf->SetFont('helvetica', '', 9);
// set alpha to semi-transparency
$pdf->SetAlpha(1);

// draw jpeg image
$pdf->Image(K_PATH_IMAGES.'fondo.jpg', 48, 37, 120, 80, '', '', '', true, 200);

$pdf->Ln(8);
foreach ($rowp as $rows1){
$initData = '<table>
                <tr>
                    <td><p><FONT style="color: rgb(150,0,0)">Paciente: </FONT>'.$rows1[0].' '.$rows1[1].'</p></td>
                    <td><p><FONT style="color: rgb(150,0,0)">Edad: </FONT>'.$rows1[2].'</p></td>
                </tr>
                <tr>
                    <td><p><FONT style="color: rgb(150,0,0)">Dr.(a): </FONT>'.$rows1[3].' '.$rows1[4].'</p></td>
                    <td><p><FONT style="color: rgb(150,0,0)">Fecha: </FONT>'.$rows1[5].'</p></td>
                </tr>
            </table>';
    $nombre = 'GeneralO_'.$rows1[0].'_'.$rows1[1];
}
$pdf->writeHTMLCell($w=180, $h=0, $x='40', $y='', $initData, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetFont('helvetica','',9);
$title = '<p><b>BIOMETRÍA HEMÁTICA</b></p>';
$pdf->writeHTML($title, true, false, true, false, 'C');
$pdf->Ln(1);
foreach ($row as $rows){
$tabla1 = '<table>
                <tr>
                    <td colspan="3"><b>Hematimetría 3600 m.s.n.m.</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Hematíes: </td>
                    <td>'.$rows[1].' mm3</td>
                    <td width="165" style="color: rgb(58,137,159)">H: 5`2 - 5`6; M: 5`2 - 5`4</td>
                </tr>
                <tr>
                    <td>Hematocrito: </td>
                    <td>'.$rows[2].' %</td>
                    <td style="color: rgb(58,137,159)">H: 49 - 53; M: 47 - 51 </td>
                </tr>
                <tr>
                    <td>Hemoglobina: </td>
                    <td>'.$rows[3].' gr/dl</td>
                    <td style="color: rgb(58,137,159)">H: 16 +/- 1,5; M: 15 +/- 0,5</td>
                </tr>
                <tr>
                    <td>Leucocito: </td>
                    <td>'.$rows[4].' mm3</td>
                    <td style="color: rgb(58,137,159)">5,000 - 8,000 </td>
                </tr>
                <tr>
                    <td>V. S. G.: </td>
                    <td>'.$rows[5].' mm/hra</td>
                    <td style="color: rgb(58,137,159)">1 - 10</td>
                </tr>
                <tr>
                    <br>
                    <td colspan="3"><b>Índices Hematimétricos</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>V. C. M.: </td>
                    <td>'.$rows[6].' fl.</td>
                    <td style="color: rgb(58,137,159)">90 +/- 8</td>
                </tr>
                <tr>
                    <td>Hb. C. M.: </td>
                    <td>'.$rows[7].' pg.</td>
                    <td style="color: rgb(58,137,159)">30 +/- 3</td>
                </tr>
                <tr>
                    <td>C. Hb. C. M.: </td>
                    <td>'.$rows[8].' %</td>
                    <td style="color: rgb(58,137,159)">34 +/- 2</td>
                </tr>
</table><br>';

if($rows[9] != '' ){
    $comentariohema = '<table>
    <tr>
        <td><b>Comentario</b></td>
    </tr>
    <tr>
        <td><p>'.nl2br($rows[9]).'</p></td>
    </tr>
</table>';
}
else{
    $comentariohema = '';
}

$tabla2 = '<table>
                <tr>
                    <td colspan="3"><b>Leucograma</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="110">Cayados: </td>
                    <td width="80">'.$rows[10].'</td>
                    <td width="50" style="color: rgb(58,137,159)">1 - 5 %</td>
                </tr>
                <tr>
                    <td>Neutrófilos: </td>
                    <td>'.$rows[11].'</td>
                    <td style="color: rgb(58,137,159)">50 - 70 %</td>
                </tr>
                <tr>
                    <td>Basófilo: </td>
                    <td>'.$rows[12].'</td>
                    <td style="color: rgb(58,137,159)">0 - 1 %</td>
                </tr>
                <tr>
                    <td>Eosinófilo: </td>
                    <td>'.$rows[13].'</td>
                    <td style="color: rgb(58,137,159)">1 - 3 %</td>
                </tr>
                <tr>
                    <td>Linfocito: </td>
                    <td>'.$rows[14].'</td>
                    <td style="color: rgb(58,137,159)">25 - 35 %</td>
                </tr>
                <tr>
                    <td>Monocito: </td>
                    <td>'.$rows[15].'</td>
                    <td style="color: rgb(58,137,159)">4 - 8 %</td>
                </tr>
                <tr>
                    <td>Pro linfocito: </td>
                    <td>'.$rows[16].'</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Cel. Inmaduras: </td>
                    <td>'.$rows[17].'</td>
                    <td></td>
                </tr>
</table><br>';

if($rows[18] != ''){
    $comentarileuco = '<table>
    <tr>
        <td><b>Comentario</b></td>
    </tr>
    <tr>
        <td><p>'.nl2br($rows[18]).'</p></td>
    </tr>
</table>';
}
else{
    $comentarileuco = '';
    }
}
$pdf->writeHTMLCell($w=150, $h=0, $x='12', $y='42', $tabla1, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

if($comentariohema != ''){
    $pdf->writeHTMLCell($w=0, $h=0, $x='12', $y='', $comentariohema, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);    
}

$pdf->writeHTMLCell($w=150, $h=0, $x='120', $y='42', $tabla2, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

if($comentarileuco != ''){
    $pdf->writeHTMLCell($w=85, $h=0, $x='120', $y='', $comentarileuco, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);    
}

$pdf->SetFont('helvetica','',7);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA</b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='122', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);
$pdf->Output($nombre.'.pdf', 'I');

?>