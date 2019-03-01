<?php

use App\Utils\Pdf;
use Cake\Utility\Text;
use App\Utils\CompanyInfo;

set_time_limit(3600);

$title = 'Parasitología';
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

$pdf->SetFont('helvetica','',9);
$title = '<p><b>PARASITOLOGÍA</b></p>';
$pdf->writeHTML($title, true, false, true, false, 'C');
$pdf->Ln(1);

if ($prueba->parasitologia_pruebas[0]->consistencia == '' && $prueba->parasitologia_pruebas[0]->color == ''
    && $prueba->parasitologia_pruebas[0]->restos_alimenticios == '') {
$copro = '';
} else {
    $copro = '<tr>
                    <td width="40%" colspan="2"><b>' . $prueba->parasitologia_pruebas[0]->subtitulo . '</b></td>
                    <td width="30%"><b>Valores de referencia</b></td>
                </tr>';
    if ($prueba->parasitologia_pruebas[0]->consistencia != '') {
        $copro .= '<tr>
                    <td width="25%">Consistencia: </td>
                    <td width="15%">' . $prueba->parasitologia_pruebas[0]->consistencia . '</td>
                    <td width="30%" style="color: rgb(58,137,159)">Semi líquido</td>
                </tr>';
    }
    if ($prueba->parasitologia_pruebas[0]->color != '') {
        $copro .= '<tr>
                    <td width="25%">Color: </td>
                    <td width="15%">' . $prueba->parasitologia_pruebas[0]->color . '</td>
                    <td width="30%" style="color: rgb(58,137,159)">Pardo claro</td>
                </tr>';
    }
    if ($prueba->parasitologia_pruebas[0]->restos_alimenticios != '') {
        $copro .= '<tr>
                    <td width="25%">Restos alimenticios: </td>
                    <td width="15%">' . $prueba->parasitologia_pruebas[0]->restos_alimenticios . '</td>
                    <td width="30%" style="color: rgb(58,137,159)">Regular cantidad</td>
                </tr>';
    }
    $copro .= '<br>';
}

if ($prueba->parasitologia_pruebas[0]->leucocitos == '' && $prueba->parasitologia_pruebas[0]->comentario == ''
    && $prueba->parasitologia_pruebas[0]->sangre_oculta == '') {
    $moco = '';
} else {
    $moco = '<tr>
                    <td width="40%" colspan="3"><b>Moco Fecal</b></td>
                    <td width="30%"><b>Valores de referencia</b></td>
                </tr>';
    if ($prueba->parasitologia_pruebas[0]->leucocitos != '') {
        $moco .= '<tr>
                    <td width="25%">Leucocitos: </td>
                    <td width="15%">' . $prueba->parasitologia_pruebas[0]->leucocitos . '</td>
                    <td width="30%" style="color: rgb(58,137,159)">8 - 10 pcm</td>
                </tr>';
    }
    if ($prueba->parasitologia_pruebas[0]->comentario != '') {
        $moco .= '<tr>
                    <td width="65%" colspan="3">' . nl2br($prueba->parasitologia_pruebas[0]->comentario) . '</td>
                    <td></td>
                    <td></td>
                </tr>';
    }
    $moco .= '<br>';
}

if ($prueba->parasitologia_pruebas[0]->sangre_oculta != '') {
    $sangre = '';
    $sangre .= '<tr>
                    <td width="55%" colspan="3"><b>Sangre Oculta: </b>' . $prueba->parasitologia_pruebas[0]->sangre_oculta . '</td>
                    <td></td>
                    <td></td>
                </tr><br>';
}

if ($prueba->parasitologia_pruebas[0]->muestra1 == '' && $prueba->parasitologia_pruebas[0]->muestra2 == ''
    && $prueba->parasitologia_pruebas[0]->muestra3 == '') {
    $microscopico = '';
} else {
    $microscopico = '<tr>
                        <td colspan="3"><b>Examen Mocroscópico: </b></td>
                        <td></td>
                        <td></td>
                    </tr>';
    if ($prueba->parasitologia_pruebas[0]->muestra1 != '') {
        $microscopico .= '<tr>
                            <td width="15%"><b>Muestra 1: </b></td>
                            <td width="35%">' . $prueba->parasitologia_pruebas[0]->muestra1 . '</td>

                        </tr>';
    }
    if ($prueba->parasitologia_pruebas[0]->muestra2 != '') {
        $microscopico .= '<tr>
                            <td width="15%"><b>Muestra 2: </b></td>
                            <td width="35%">' . $prueba->parasitologia_pruebas[0]->muestra2 . '</td>
                        </tr>';
    }
    if ($prueba->parasitologia_pruebas[0]->muestra3 != '') {
        $microscopico .= '<tr>
                            <td width="15%"><b>Muestra 3: </b></td>
                            <td width="35%">' . $prueba->parasitologia_pruebas[0]->muestra3 . '</td>
                        </tr>';
    }
    $microscopico .= '<br>';
}

if (($copro == '' && $moco == '') ||
    ($sangre == '' && $microscopico == '')) {
    $tabla = '';
    $tabla = '<table>' . $copro . $moco . $sangre . $microscopico . '</table>';
    $pdf->writeHTMLCell($w=150, $h=0, $x='68', $y='42', $tabla, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);
}
else {
    $tabla1 = '';
    $tabla1 = '<table>' . $copro .  $moco . '</table>';
    $pdf->writeHTMLCell($w=125, $h=0, $x='35', $y='42', $tabla1, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

    $tabla2 = '';
    $tabla2 = '<table>' . $sangre . $microscopico . '</table>';
    $pdf->writeHTMLCell($w=130, $h=0, $x='125', $y='42', $tabla2, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);
}


$pdf->SetFont('helvetica','',7);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA<br>
            JEFE DE LABORATORIO
            </b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='115', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$nombre = Text::slug(date('Y-m-d h-i-s') . '-' . 'parasitologia-' .  $prueba->paciente->nombre . '-' .  $prueba->paciente->apellidos);
$pdf->Output($nombre . '.pdf', 'I');

?>
