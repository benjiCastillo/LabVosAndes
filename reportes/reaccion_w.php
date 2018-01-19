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

$sql = 'SELECT * FROM reaccion_w WHERE id_examen=?';
$stmt = $con->prepare($sql);
$results = $stmt->execute(array($id));
$row = $stmt->fetchAll();

$con = null;

$title = 'Reacción de Widal';
$pdf = createPDF($title);

$pdf->SetFont('helvetica', '', 9);
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
$pdf->writeHTMLCell($w=180, $h=0, $x='40', $y='', $initData, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);


$pdf->SetFont('helvetica','',9);
$title = '<p><b>REACCIÓN DE WIDAL</b></p>';
$pdf->writeHTML($title, true, false, true, false, 'C');
$pdf->Ln(1);
foreach ($row as $rows){
$biometria = '<table>
        <tr>
            <td><b>Dilución</b></td>
            <td><b>1/20</b></td>
            <td><b>1/40</b></td>
            <td><b>1/80</b></td>
            <td><b>1/160</b></td>
            <td><b>1/320</b></td>
            <td><b>1/400</b></td>
        </tr>
        <tr>
            <td><b>Paratyphi "A"</b></td>
            <td>'.$rows[1].'</td>
            <td>'.$rows[2].'</td>
            <td>'.$rows[3].'</td>
            <td>'.$rows[4].'</td>
            <td>'.$rows[5].'</td>
            <td>'.$rows[6].'</td>
        </tr>
        <tr>
            <td><b>Paratyphi "B"</b></td>
            <td>'.$rows[7].'</td>
            <td>'.$rows[8].'</td>
            <td>'.$rows[9].'</td>
            <td>'.$rows[10].'</td>
            <td>'.$rows[11].'</td>
            <td>'.$rows[12].'</td>
        </tr>
        <tr>
            <td><b>Somático "O"</b></td>
            <td>'.$rows[13].'</td>
            <td>'.$rows[14].'</td>
            <td>'.$rows[15].'</td>
            <td>'.$rows[16].'</td>
            <td>'.$rows[17].'</td>
            <td>'.$rows[18].'</td>
        </tr>
        <tr>
            <td><b>Flagelar "H"</b></td>
            <td>'.$rows[19].'</td>
            <td>'.$rows[20].'</td>
            <td>'.$rows[21].'</td>
            <td>'.$rows[22].'</td>
            <td>'.$rows[23].'</td>
            <td>'.$rows[24].'</td>
        </tr>
    </table>';
    $com = $rows[25];
}
$pdf->writeHTMLCell($w=180, $h=0, $x='18', $y='', $biometria, $border=0, $ln=1, $fill=0, $reseth=true, $align='R', $autopadding=true);

$pdf->Ln(4);
$comentario = '<div>Comentario: '.$com.'</div>';
$pdf->writeHTMLCell($w=180, $h=0, $x='18', $y='', $comentario, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetFont('helvetica','',7);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA</b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='122', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$pdf->Output($nombre.'.pdf', 'I');
?>