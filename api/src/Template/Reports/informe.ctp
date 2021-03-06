<?php

use App\Utils\Pdf;
use Cake\Utility\Text;
use App\Utils\CompanyInfo;

set_time_limit(3600);

$title = 'Examen General';
$company_info = new CompanyInfo;
$pdf = $company_info->createPDF($title);


$pdf->SetFont('helvetica', '', 9);
// set alpha to semi-transparency
$pdf->SetAlpha(1);

// draw jpeg image
$pdf->Image(WWW_ROOT . 'img' . DS . 'fondo.jpg', 48, 37, 120, 80, '', '', '', true, 200);

$pdf->Ln(8);
$initData = '<table>
                <tr>
                    <td><p><FONT style="color: rgb(150,0,0)">Paciente: </FONT>' . $prueba->paciente->nombre . ' ' . $prueba->paciente->apellidos . '</p></td>
                    <td><p><FONT style="color: rgb(150,0,0)">Edad: </FONT>'.  $prueba->paciente->edad. '</p></td>
                </tr>
                <tr>
                    <td><p><FONT style="color: rgb(150,0,0)">Dr.(a): </FONT>' . $prueba->medico->nombre . '</p></td>
                    <td><p><FONT style="color: rgb(150,0,0)">Fecha: </FONT>' . $prueba->fecha->format('d-m-Y') . '</p></td>
                </tr>
            </table>';

$pdf->writeHTMLCell($w=180, $h=0, $x='40', $y='', $initData, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetFont('helvetica','',10);
$title = '<p><b>EXÁMEN GENERAL</b></p>';
$pdf->writeHTML($title, true, false, true, false, 'C');
$pdf->Ln(1);

$informe = '';
$cont = 0;
if($prueba->informe_pruebas[0]->grupo_sanguineo != ''){
    $informe = '<p><b>Grupo Sanguineo: </b>' . nl2br($prueba->informe_pruebas[0]->grupo_sanguineo) . '</p>';
    $cont++;
}
if($prueba->informe_pruebas[0]->factor_rh != ''){
    $informe .= '<p><b>Factor Rh: </b>' . nl2br($prueba->informe_pruebas[0]->factor_rh) . '</p>';
    $cont++;
}
if ($prueba->informe_pruebas[0]->prueba_inmunologica_embarazo != '') {
    $informe .= '<p><b>Prueba inmunológica de embarazo en suero hGC: </b>' . nl2br($prueba->informe_pruebas[0]->prueba_inmunologica_embarazo) . '</p>';
    $cont++;
}
if ($prueba->informe_pruebas[0]->other != '') {
    $informe .= '<p>' . nl2br($prueba->informe_pruebas[0]->other) . '</p>';
    $cont++;
}

if($cont == 3 || $cont == 4){
    $y = "55";
} else {
    $y = "65";
}
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y, $informe, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=false);

$pdf->SetFont('helvetica','',7);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA<br>
            JEFE DE LABORATORIO
            </b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='115', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$nombre = Text::slug(date('Y-m-d h-i-s') . '-' . 'informe-' .  $prueba->paciente->nombre . '-' .  $prueba->paciente->apellidos);
$pdf->Output($nombre . '.pdf', 'I');

?>
