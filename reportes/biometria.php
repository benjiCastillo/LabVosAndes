<?php
$id='1';
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

$sql = 'SELECT * FROM biometria WHERE id=?';
$stmt = $con->prepare($sql);
$results = $stmt->execute(array($id));
$row = $stmt->fetchAll();

// $custom_layout = array('215.9', '107.9');
$pdf = new TCPDF('P', PDF_UNIT, 'LETTER', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Dra. María Luz Nina Colque');
$pdf->SetTitle('Exámen Biometría Hemática');
$pdf->SetSubject('Vos Andes');
$pdf->SetKeywords('Reporte, Vos Andes, Biometria Hemática');
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
// $pdf->SetFont('helvetica', 'B', 9);
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
$pdf->SetFillColor(59,78,20);
$pdf->SetTextColor(0,0,0);
$image_file = K_PATH_IMAGES.'logovosandes.jpg';

$pdf->Image($image_file, 30, 2, 20, '', 'JPG', '', 'T', false, 200, '', false, false, 0, false, false, false);
$pdf->Ln(3);
// $pdf->Cell(0, 15, '                         LABORATORIO DE ANÁLISIS CLÍNICO "VOS ANDES"', 0, false, 'L', 0, '', 0, false, 'M', 'M');
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
    $nombre = 'Biometria_'.$rows1[0].'_'.$rows1[1]; 
}
$pdf->writeHTMLCell($w=180, $h=0, $x='40', $y='', $initData, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);


$pdf->SetFont('helvetica','',11);
$title = '<p><b>BIOMETRÍA HEMÁTICA</b></p>';
$pdf->writeHTML($title, true, false, true, false, 'C');
$pdf->Ln(1);
foreach ($row as $rows){
$biometria = '<table>
        <tr>
            <td><b>Hematimetría 3600 m.s.n.m.</b></td>
            <td></td>
            <td><b>Leucograma</b></td>
            <td></td>
        </tr>
        <tr>
            <td>Hematíes: '.$rows[1].' mm3</td>
            <td>H: 5`2 - 5`6; M: 5`2 - 5`4</td>
            <td>Cayados: '.$rows[10].'</td>
            <td>1 - 5 %</td>
        </tr>
        <tr>
            <td>Hematocrito: '.$rows[2].' %</td>
            <td>H: 49 - 53; M: 47 - 51</td>
            <td>Neutrófilos: '.$rows[11].'</td>
            <td>50 - 70 %</td>
        </tr>
        <tr>
            <td>Hemoglobina: '.$rows[3].' gr/dl</td>
            <td>H: 16 +/- 1,5;M: 15 +/- 0,5</td>
            <td>Basófilo: '.$rows[12].'</td>
            <td>0 - 1 %</td>
        </tr>
        <tr>
            <td>Leucocito: '.$rows[4].'mm3</td>
            <td>5,000 - 8,000</td>
            <td>Eosinofilo: '.$rows[13].'</td>
            <td>1 - 3 %</td>
        </tr>
        <tr>
            <td>V. S. G.: '.$rows[5].' mm/hra</td>
            <td>1 - 10</td>
            <td>Linfocito: '.$rows[14].'</td>
            <td>25 - 35 %</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Monocito: '.$rows[15].'</td>
            <td>4 - 8 %</td>
        </tr>
        <tr>
            <td><b>Índices Hematimétricos</b></td>
            <td></td>
            <td>Pro linfocito: '.$rows[16].'</td>
            <td></td>
        </tr>
        <tr>
            <td>V. C. M.: '.$rows[6].' fl.</td>
            <td>90 +/- 8</td>
            <td>Cel. Inmaduras: '.$rows[17].'</td>
            <td></td>
        </tr>
        <tr>
            <td>Hb. C. M.: '.$rows[7].' pg.</td>
            <td>30 +/- 3</td>
            <td rowspan="3">Comentario: '.$rows[18].'</td>
        </tr>
        <tr>
            <td>C. Hb. C. M.: '.$rows[8].' %</td>
            <td>34 +/- 2</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Comentario: '.$rows[9].'</td>
            <td></td>
        </tr>
    </table>';
}
$pdf->writeHTMLCell($w=210, $h=0, $x='21', $y='', $biometria, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);
// $pdf->writeHTML($biometria, true, false, true, false, 'L');

$pdf->SetFont('helvetica','',9);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA</b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='110', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$pdf->Output($nombre.'.pdf', 'I');
?>