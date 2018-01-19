<?php
$id=$_GET["idExamen"];

require_once('tcpdf/tcpdf.php');
require('conexion.php');
require('createPDF.php');

$con=Conectar();

$sqle = 'SELECT p.nombre, p.apellidos, p.edad, m.nombre, m.apellidos, DATE_FORMAT(e.fecha, "%d-%m-%Y") FROM examen e INNER JOIN paciente p ON e.id_paciente=p.id INNER JOIN medico m ON e.id_medico=m.id WHERE e.id=?';
$stmtp = $con->prepare($sqle);
$resultsp = $stmtp->execute(array($id));
$rowp = $stmtp->fetchAll();

$sql = 'SELECT * FROM examen_general WHERE id_examen=?';
$stmt = $con->prepare($sql);
$results = $stmt->execute(array($id));
$row = $stmt->fetchAll();

$con = null;

$title = 'Exámen General';
$pdf = createPDF($title);

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
/*aca*/


$pdf->SetFont('helvetica','',9);
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
                    <td width="65">Color: </td>
                    <td width="90">'.$rows[1].'</td>
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
</table><br>';

$tabla2 = '<table>
                <tr>
                    <td colspan="3"><b>Exámen Químico</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td td width="85">Proteínas: </td>
                    <td td width="90">'.$rows[9].'</td>
                    <td width="70" style="color: rgb(58,137,159)">No contiene</td>
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
                    <td td width="70">Eritrocitos: </td>
                    <td td width="140">'.$rows[16].'</td>
                </tr>
                <tr>
                    <td>Piocitos: </td>
                    <td>'.$rows[17].'</td>
                </tr>
                <tr>
                    <td>Leucocitos: </td>
                    <td>'.$rows[18].'</td>
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
                    <td>'.$rows[21].'</td>
                </tr>
                <tr>
                    <td>Otros: </td>
                    <td>'.nl2br($rows[22]).'</td>
                </tr>
</table>';

$tabla4 = '<table>
                <tr>
                    <td><b>Exámen Bacteriológico Sedimento</b></td>
                </tr>
                <tr>
                    <td>'.nl2br($rows[23]).'</td>
                </tr>
            </table>';
}
$pdf->writeHTMLCell($w=0, $h=0, $x='7', $y='42', $tabla1, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->writeHTMLCell($w=0, $h=0, $x='7', $y='', $tabla4, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->writeHTMLCell($w=0, $h=0, $x='77', $y='42', $tabla2, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->writeHTMLCell($w=200, $h=0, $x='151', $y='42', $tabla3, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetTextColor(0,0,0);
$pdf->SetFont('helvetica','',7);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA</b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='122', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$pdf->Output($nombre.'.pdf', 'I');
?>