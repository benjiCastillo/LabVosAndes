<?php
$id='10';
$idp='28';


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
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
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

$style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
$pdf->Line(10, 40, 200, 40, $style);

// set alpha to semi-transparency
$pdf->SetAlpha(0.1);

// draw jpeg image
$pdf->Image(K_PATH_IMAGES.'logo.jpg', 50, 90, 120, 120, '', '', '', true, 72);

// restore full opacity
$pdf->SetAlpha(1);

$pdf->Ln(10);
$pdf->SetFont('helvetica','',10);
// $pdf->Cell(0, 4, '                          Paciente: Erwin Méndez Mejía                                            Edad: 21', 0,0);
// $pdf->Ln(4);
// $pdf->Cell(0, 4, '                          Dr(a): Harold Castillo                                                           Fecha: 08-07-2017', 0, 0);
// $pdf->Ln(4);
foreach ($rowp as $rows1){
$initData = '<table>
                <tr>
                    <td>Paciente: '.$rows1[0].' '.$rows1[1].'</td>
                    <td>Edad: '.$rows1[2].'</td>
                </tr>
                <tr>
                    <td>Dr(a): '.$rows1[3].' '.$rows1[4].'</td>
                    <td>Fecha: '.$rows1[5].'</td>
                </tr>
            </table>';
}

$pdf->writeHTML(utf8_encode($initData), true, false, false, false, 'L');

$title = '<b><h1>Biometría</h1></b>';
$pdf->writeHTML($title, true, false, false, false, 'C');
foreach ($row as $rows){
$fisico = '<table>
        <tr>
            <th><h3><b>Nombre exámen</b></h3></th>
            <th><h3><b>Resultado</b></h3></th>
            <th><h3><b>Valor de referencia</b></h3></th>
        </tr>
        <br>
        <tr>
            <td><b>Hemati metria - 3,600 m.s.n.m.</b></td>
        </tr>
        <tr>
            <td>Hematies</td>
            <td>'.$rows[1].'</td>
            <td>Ambar</td>
        </tr>
        <tr>
            <td>Hematocrito</td>
            <td>'.$rows[2].'</td>
            <td>-</td>
        </tr>
        <tr>
            <td>Hemoglobina</td>
            <td>'.$rows[3].'</td>
            <td>Suigéneris</td>
        </tr>
        <tr>
            <td>Leucocitos</td>
            <td>'.$rows[4].'</td>
            <td>Límpido</td>
        </tr>
        <tr>
            <td>V.S.G</td>
            <td>'.$rows[5].'</td>
            <td>Blanca Fugaz</td>
        </tr>
        <br>
        <tr>
            <td><b>Índices Hematimétricos</b></td>
        </tr>
        <tr>
            <td>V. CM.</td>
            <td>'.$rows[9].'</td>
            <td>No contiene</td>
        </tr>
        <tr>
            <td>Hb. C.M.</td>
            <td>'.$rows[10].'</td>
            <td>No contiene</td>
        </tr>
        <tr>
            <td>C. Hb. C.M.</td>
            <td>'.$rows[11].'</td>
            <td>No contiene</td>
        </tr>
        <br>
        <tr>
            <td><b>Comentario</b></td>
        </tr>
        <tr>
            <td><b>Leucograma</b></td>
        </tr>
        <tr>
            <td>Cayados</td>
            <td>'.$rows[16].'</td>
        </tr>
        <tr>
            <td>Neutrofilos</td>
            <td>'.$rows[17].'</td>
        </tr>
        <tr>
            <td>Basofilo</td>
            <td>'.$rows[18].'</td>
        </tr>
        <tr>
            <td>Eosonofilo</td>
            <td>'.$rows[19].'</td>
        </tr>
        <tr>
            <td>Linfocito</td>
            <td>'.$rows[20].'</td>
        </tr>
        <tr>
            <td>Monocito</td>
            <td>'.$rows[21].'</td>
        </tr>
        <tr>
            <td>Prolinfocito</td>
            <td>'.$rows[22].'</td>
        </tr>
        <tr>
            <td>Cel. Inmaduras</td>
            <td>'.$rows[22].'</td>
        </tr>
        <br>
        <tr>
            <td><b>Comentario</b></td>
        </tr>
        <tr>
            <td>'.$rows[23].'</td>
        </tr>
    </table>';
}
$pdf->writeHTML($fisico, true, false, false, false, 'L');

$firm = '<br><br><br><div style="line-height: 20px;">Dra. Teresa Huanca C. <br>
            BIOQUÍMICA-FARMACEUTICA <br>
            JEFE DE LABORATORIO 
        </div>';
$pdf->writeHTML($firm, true, false, false, false, 'C');

$pdf->Output('reporte.pdf', 'I');
?>