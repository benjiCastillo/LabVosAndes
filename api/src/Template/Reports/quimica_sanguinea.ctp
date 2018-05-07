<?php

use App\Utils\Pdf;
use Cake\Utility\Text;
use App\Utils\CompanyInfo;

set_time_limit(3600);

$title = 'Química Sanguínea';
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
$title = '<p><b>QUÍMICA SANGUÍNEA</b></p>';
$pdf->writeHTML($title, true, false, true, false, 'C');
$pdf->Ln(1);

if ($prueba->quimica_sanguinea_pruebas[0]->glucemia == '' && $prueba->quimica_sanguinea_pruebas[0]->urea == ''
&& $prueba->quimica_sanguinea_pruebas[0]->creatinina == '' && $prueba->quimica_sanguinea_pruebas[0]->acido_urico == ''
&& $prueba->quimica_sanguinea_pruebas[0]->colesterol_total == '' && $prueba->quimica_sanguinea_pruebas[0]->hdl_colesterol == ''
&& $prueba->quimica_sanguinea_pruebas[0]->ldl_colesterol == '' && $prueba->quimica_sanguinea_pruebas[0]->trigliceridos
&& $prueba->quimica_sanguinea_pruebas[0]->gamaglutamil_transpeptidasa= '' && $prueba->quimica_sanguinea_pruebas[0]->prueba_inmunologica_embarazo = '') {
$col1 = '';
} else {
    $col1 = '';
    if ($prueba->quimica_sanguinea_pruebas[0]->glucemia != '') {
        $col1 .= '<tr>
                    <td width="135">Glucemia:</td>
                    <td width="120">' . $prueba->quimica_sanguinea_pruebas[0]->glucemia . '  mg/dl</td>
                    <td width="100" style="color: rgb(58,137,159)">70 - 110 mg/dl</td>
                </tr>';
    }
    if ($prueba->quimica_sanguinea_pruebas[0]->urea != '') {
        $col1 .= '<tr>
                    <td>Urea: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->urea . '  mg/dl</td>
                    <td style="color: rgb(58,137,159)">17 - 49 mg/dl</td>
                </tr>';
    }
    if ($prueba->quimica_sanguinea_pruebas[0]->creatinina != '') {
        $col1 .= '<tr>
                    <td>Creatinina: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->creatinina . '  mg/dl</td>
                    <td style="color: rgb(58,137,159)">H: 0,6 - 1,2 mg/dl; M: 0,8 - 1,4 mg/dl</td>
                </tr>';
    }
    if ($prueba->quimica_sanguinea_pruebas[0]->acido_urico != '') {
        $col1 .= '<tr>
                    <td>Acido úrico: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->acido_urico . '  mg/dl</td>
                    <td style="color: rgb(58,137,159)">H: 3,7 - 8,0 mg/dl; M: 2,3 - 6,1 mg/dl</td>
                </tr>';
    }
    if ($prueba->quimica_sanguinea_pruebas[0]->colesterol_total != '') {
        $col1 .= '<tr>
                    <td>Colesterol total: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->colesterol_total . '  mg/dl</td>
                    <td style="color: rgb(58,137,159)">140 - 200 mg/dl</td>
                </tr>';
    }
    if ($prueba->quimica_sanguinea_pruebas[0]->hdl_colesterol != '') {
        $col1 .= '<tr>
                    <td>HDL colesterol: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->hdl_colesterol . '  mg/dl</td>
                    <td style="color: rgb(58,137,159)">30 - 70 mg/dl</td>
                </tr>';
    }
    if ($prueba->quimica_sanguinea_pruebas[0]->ldl_colesterol != '') {
        $col1 .= '<tr>
                    <td>LDL colesterol: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->ldl_colesterol . '  mg/dl</td>
                    <td style="color: rgb(58,137,159)">< 100 mg/dl</td>
                </tr>';
    }
    if ($prueba->quimica_sanguinea_pruebas[0]->trigliceridos != '') {
        $col1 .= '<tr>
                    <td>Triglicéridos: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->trigliceridos . '  mg/dl</td>
                    <td style="color: rgb(58,137,159)">30 - 150 mg/dl</td>
                </tr>';
    }
    if ($prueba->quimica_sanguinea_pruebas[0]->gamaglutamil_transpeptidasa != '') {
        $col1 .= '<tr>
                    <td width="190">Gamaglutamil transpeptidasa GGT: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->gamaglutamil_transpeptidasa . ' U/L</td>
                    <td style="color: rgb(58,137,159)">9 - 39 U/L</td>
                </tr>';
    }
    if ($prueba->quimica_sanguinea_pruebas[0]->prueba_inmunologica_embarazo != '') {
        $col1 .= '<tr>
                    <td>Prueba inmunológica de embarazo en suero hGC:: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->prueba_inmunologica_embarazo . '  mg/dl</td>
                    <td style="color: rgb(58,137,159)">30 - 70 mg/dl</td>
                </tr>';
    }
    $col1 .= '<br>';
}

$tabla1 = '<table style="padding: 2px;">
                <tr>
                    <td width="135">Glucemia:</td>
                    <td width="120">' . $prueba->quimica_sanguinea_pruebas[0]->glucemia . '  mg/dl</td>
                    <td width="100" style="color: rgb(58,137,159)">70 - 110 mg/dl</td>
                </tr>
                <tr>
                    <td>Urea: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->urea . '  mg/dl</td>
                    <td style="color: rgb(58,137,159)">17 - 49 mg/dl</td>
                </tr>
                <tr>
                    <td>Creatinina: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->creatinina . '  mg/dl</td>
                    <td style="color: rgb(58,137,159)">H: 0,6 - 1,2 mg/dl; M: 0,8 - 1,4 mg/dl</td>
                </tr>
                <tr>
                    <td>Acido úrico: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->acido_urico . '  mg/dl</td>
                    <td style="color: rgb(58,137,159)">H: 3,7 - 8,0 mg/dl; M: 2,3 - 6,1 mg/dl</td>
                </tr>
                <tr>
                    <td>Colesterol total: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->colesterol_total . '  mg/dl</td>
                    <td style="color: rgb(58,137,159)">140 - 200 mg/dl</td>
                </tr>
                <tr>
                    <td>HDL colesterol: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->hdl_colesterol . '  mg/dl</td>
                    <td style="color: rgb(58,137,159)">30 - 70 mg/dl</td>
                </tr>
                <tr>
                    <td>LDL colesterol: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->ldl_colesterol . '  mg/dl</td>
                    <td style="color: rgb(58,137,159)">< 100 mg/dl</td>
                </tr>
                <tr>
                    <td>Triglicéridos: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->trigliceridos . '  mg/dl</td>
                    <td style="color: rgb(58,137,159)">30 - 150 mg/dl</td>
                </tr>
                <tr>
                    <br>
                    <td>F. Alcalina: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->f_alcalina . ' UI/L</td>
                    <td style="color: rgb(58,137,159)">68 - 240 UI/L</td>
                </tr>
                <tr>
                    <td>Transaminasa GOT: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->transaminasa_got . ' U/L</td>
                    <td style="color: rgb(58,137,159)">0 – 40 U/L</td>
                </tr>
                <tr>
                    <td>Transaminasa GPT: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->transaminasa_gpt . ' U/L</td>
                    <td style="color: rgb(58,137,159)">0 – 38 U/L</td>
                </tr>
                <tr>
                    <td>Bilirrubina total: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->bilirrubina_total . ' mg/dl</td>
                    <td style="color: rgb(58,137,159)">hasta 1,0 mg/dl</td>
                </tr>
                <tr>
                    <td>Bilirrubina directa: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->bilirrubina_directa . ' mg/dl</td>
                    <td style="color: rgb(58,137,159)">hasta 0,2 mg/dl</td>
                </tr>
                <tr>
                    <td>Bilirrubina indirecta: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->bilirrubina_indirecta . ' mg/dl</td>
                    <td style="color: rgb(58,137,159)">8 - 10 pcm</td>
                </tr>
                <tr>
                    <td>Amilasa: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->amilasa . ' U/L</td>
                    <td style="color: rgb(58,137,159)">53 - 123 U/L</td>
                </tr>
                <tr>
                    <td>Proteínas Totales: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->proteinas_totales . ' g/dl</td>
                    <td style="color: rgb(58,137,159)">6,4 – 8,6 g/dl</td>
                </tr>
                <tr>
                    <td>Albumina: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->albumina . ' g/dl</td>
                    <td style="color: rgb(58,137,159)">3,8 - 5,1 g/dl</td>
                </tr>
                <tr>
                    <td>Calcio: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->calcio . ' mg/dl</td>
                    <td style="color: rgb(58,137,159)">9,2 - 11,0 mg/dl</td>
                </tr>
                <tr>
                    <td>CPK: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->cpk . ' U/L</td>
                    <td style="color: rgb(58,137,159)">25 - 174 U/L</td>
                </tr>
                <tr>
                    <td>CPK MB: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->cpk_mb . ' U/L</td>
                    <td style="color: rgb(58,137,159)">mayor a 24 U/L</td>
                </tr>
                <tr>
                    <br>
                    <td width="190">Gamaglutamil transpeptidasa GGT: </td>
                    <td>' . $prueba->quimica_sanguinea_pruebas[0]->gamaglutamil_transpeptidasa . ' U/L</td>
                    <td style="color: rgb(58,137,159)">9 - 39 U/L</td>
                </tr>
            </table><br>';

$pdf->writeHTMLCell($w=150, $h=0, $x='60', $y='42', $tabla1, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$gamaglu_trans = '<p>Prueba inmunológica de embarazo en suero hGC: ' . $prueba->quimica_sanguinea_pruebas[0]->prueba_inmunologica_embarazo . '</p>';

$pdf->writeHTMLCell($w=180, $h=0, $x='55', $y='', $gamaglu_trans, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetFont('helvetica','',7);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA</b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='115', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$nombre = Text::slug(date('Y-m-d h-i-s') . '-' . 'quimica-sanguinea-' .  $prueba->paciente->nombre . '-' .  $prueba->paciente->apellidos);
$pdf->Output($nombre . '.pdf', 'I');

?>
