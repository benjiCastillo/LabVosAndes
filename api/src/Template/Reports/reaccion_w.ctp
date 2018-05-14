<?php

use App\Utils\Pdf;
use Cake\Utility\Text;
use App\Utils\CompanyInfo;

set_time_limit(3600);

$title = 'Reacción de Widal';
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
                    <td><p><FONT style="color: rgb(150,0,0)">Dr.(a): </FONT>' . $prueba->medico->nombre . ' ' . $prueba->medico->apellidos . '</p></td>
                    <td><p><FONT style="color: rgb(150,0,0)">Fecha: </FONT>' . $prueba->fecha->format('d-m-Y H:i:s') . '</p></td>
                </tr>
            </table>';

$pdf->writeHTMLCell($w=180, $h=0, $x='40', $y='', $initData, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);


$pdf->SetFont('helvetica','',9);
$title = '<p><b>REACCIÓN DE WIDAL</b></p>';
$pdf->writeHTML($title, true, false, true, false, 'C');
$pdf->Ln(1);

$biometria = '<table style="padding: 4px;">
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
            <td>' . $prueba->reaccion_w_pruebas[0]->paraA1 . '</td>
            <td>' . $prueba->reaccion_w_pruebas[0]->paraA2 . '</td>
            <td>' . $prueba->reaccion_w_pruebas[0]->paraA3 . '</td>
            <td>' . $prueba->reaccion_w_pruebas[0]->paraA4 . '</td>
            <td>' . $prueba->reaccion_w_pruebas[0]->paraA5 . '</td>
            <td>' . $prueba->reaccion_w_pruebas[0]->paraA6 . '</td>
        </tr>
        <tr>
            <td><b>Paratyphi "B"</b></td>
            <td>' . $prueba->reaccion_w_pruebas[0]->paraB1 . '</td>
            <td>' . $prueba->reaccion_w_pruebas[0]->paraB2 . '</td>
            <td>' . $prueba->reaccion_w_pruebas[0]->paraB3 . '</td>
            <td>' . $prueba->reaccion_w_pruebas[0]->paraB4 . '</td>
            <td>' . $prueba->reaccion_w_pruebas[0]->paraB5 . '</td>
            <td>' . $prueba->reaccion_w_pruebas[0]->paraB6 . '</td>
        </tr>
        <tr>
            <td><b>Somático "O"</b></td>
            <td>' . $prueba->reaccion_w_pruebas[0]->somaticoO1 . '</td>
            <td>' . $prueba->reaccion_w_pruebas[0]->somaticoO2 . '</td>
            <td>' . $prueba->reaccion_w_pruebas[0]->somaticoO3 . '</td>
            <td>' . $prueba->reaccion_w_pruebas[0]->somaticoO4 . '</td>
            <td>' . $prueba->reaccion_w_pruebas[0]->somaticoO5 . '</td>
            <td>' . $prueba->reaccion_w_pruebas[0]->somaticoO6 . '</td>
        </tr>
        <tr>
            <td><b>Flagelar "H"</b></td>
            <td>' . $prueba->reaccion_w_pruebas[0]->flagelarH1 . '</td>
            <td>' . $prueba->reaccion_w_pruebas[0]->flagelarH2 . '</td>
            <td>' . $prueba->reaccion_w_pruebas[0]->flagelarH3 . '</td>
            <td>' . $prueba->reaccion_w_pruebas[0]->flagelarH4 . '</td>
            <td>' . $prueba->reaccion_w_pruebas[0]->flagelarH5 . '</td>
            <td>' . $prueba->reaccion_w_pruebas[0]->flagelarH6 . '</td>
        </tr>
    </table>';
$pdf->writeHTMLCell($w=180, $h=0, $x='15', $y='', $biometria, $border=0, $ln=1, $fill=0, $reseth=true, $align='R', $autopadding=true);

$pdf->Ln(4);
$comentario = '<div><b>Comentario: </b>' . nl2br($prueba->reaccion_w_pruebas[0]->comentario) . '</div>';
if ($comentario != ''){
    $pdf->writeHTMLCell($w=180, $h=0, $x='19', $y='', $comentario, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);
}

$pdf->SetFont('helvetica','',7);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA</b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='110', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$nombre = Text::slug(date('Y-m-d h-i-s') . '-' . 'reaccion-widal-' .  $prueba->paciente->nombre . '-' .  $prueba->paciente->apellidos);
$pdf->Output($nombre . '.pdf', 'I');

?>
