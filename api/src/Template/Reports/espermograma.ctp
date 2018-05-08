<?php

use App\Utils\Pdf;
use Cake\Utility\Text;
use App\Utils\CompanyInfo;

set_time_limit(3600);

$title = 'Espermograma';
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
                    <td><p><FONT style="color: rgb(150,0,0)">Fecha: </FONT>' . $prueba->fecha->format('d-m-Y') . '</p></td>
                </tr>
            </table>';

$pdf->writeHTMLCell($w=180, $h=0, $x='40', $y='', $initData, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetFont('helvetica','',9);
$title = '<p><b>ESPERMOGRAMA</b></p>';
$pdf->writeHTML($title, true, false, true, false, 'C');
$pdf->Ln(1);

$datos_hora = '<tr>
                    <td width="220"><b>Hora de recolección: </b> ' . $prueba->espermograma_pruebas[0]->hora_recoleccion->format('d-m-Y H:i:s') . '</td>
                    <td width="220"><b>Hora de recepción: </b> ' . $prueba->espermograma_pruebas[0]->hora_recepcion->format('d-m-Y H:i:s') . '</td>
                    <td width="210"><b>Duración de la abstinencia: </b> ' . $prueba->espermograma_pruebas[0]->duracion_abstinencia . '</td>
                </tr><br>';

if ($prueba->espermograma_pruebas[0]->aspecto == '' && $prueba->espermograma_pruebas[0]->color == ''
    && $prueba->espermograma_pruebas[0]->volumen == '' && $prueba->espermograma_pruebas[0]->viscosidad == ''
    && $prueba->espermograma_pruebas[0]->ph == '') {
    $examen_fisico = '';
} else {
    $examen_fisico = '<tr>
                            <td colspan="3"><b>Examen Físico</b></td>
                            <td></td>
                            <td></td>
                        </tr>';
    if ($prueba->espermograma_pruebas[0]->aspecto != '') {
        $examen_fisico .= '<tr>
                                <td width="130">Aspecto: </td>
                                <td width="100">' . $prueba->espermograma_pruebas[0]->aspecto . '</td>
                                <td width="100" style="color: rgb(58,137,159)">Opaco Homogéneo</td>
                            </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->color != '') {
        $examen_fisico .= '<tr>
                                <td width="130">Color: </td>
                                <td width="100">' . $prueba->espermograma_pruebas[0]->color . '</td>
                                <td width="100" style="color: rgb(58,137,159)">Blanco amarillento</td>
                            </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->volumen != '') {
        $examen_fisico .= '<tr>
                                <td width="130">Volumen: </td>
                                <td width="100">' . $prueba->espermograma_pruebas[0]->volumen . ' ml</td>
                                <td width="100" style="color: rgb(58,137,159)">1.5 – 6 ml</td>
                            </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->viscosidad != '') {
        $examen_fisico .= '<tr>
                                <td width="130">Viscosidad: </td>
                                <td width="100">' . $prueba->espermograma_pruebas[0]->viscosidad . ' mm</td>
                                <td width="100" style="color: rgb(58,137,159)">5 – 10 mm</td>
                            </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->ph != '') {
        $examen_fisico .= '<tr>
                                <td width="130">Ph: </td>
                                <td width="100">' . $prueba->espermograma_pruebas[0]->ph . '</td>
                                <td width="100" style="color: rgb(58,137,159)">7.8 – 8.2</td>
                            </tr>';
    }
    $examen_fisico .= '<br>';
}

if ($prueba->espermograma_pruebas[0]->concentracion_espermatica == '' && $prueba->espermograma_pruebas[0]->caracteristicas_morfologicas == ''
    && $prueba->espermograma_pruebas[0]->espermatozoides_normales == '' && $prueba->espermograma_pruebas[0]->cabeza == ''
    && $prueba->espermograma_pruebas[0]->pieza_intermedia == '' && $prueba->espermograma_pruebas[0]->cola == ''
    && $prueba->espermograma_pruebas[0]->otras_celulas == '') {
    $examen_microscopico = '';
} else {
    $examen_microscopico = '<tr>
                                <td colspan="3"><b>Examen Microscópico</b></td>
                                <td></td>
                                <td></td>
                            </tr>';
    if ($prueba->espermograma_pruebas[0]->concentracion_espermatica != '') {
        $examen_microscopico .= '<tr>
                                    <td width="152">Concentración espermática: </td>
                                    <td width="100">' . $prueba->espermograma_pruebas[0]->concentracion_espermatica . ' mm3</td>
                                    <td width="100" style="color: rgb(58,137,159)">60`000.000 – 150`000.000 mm3</td>
                                </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->caracteristicas_morfologicas != '') {
        $examen_microscopico .= '<tr>
                                    <td width="152">Características morfológicas: </td>
                                    <td width="200" colspan="2">' . $prueba->espermograma_pruebas[0]->caracteristicas_morfologicas . '</td>
                                    <td></td>
                                </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->espermatozoides_normales != '') {
        $examen_microscopico .= '<tr>
                                    <td width="152">Espermatozoides normales: </td>
                                    <td width="200" colspan="2">' . $prueba->espermograma_pruebas[0]->espermatozoides_normales . '</td>
                                                              </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->cabeza != '') {
        $examen_microscopico .= '<tr>
                                    <td width="152">Cabeza: </td>
                                    <td width="200" colspan="2">' . $prueba->espermograma_pruebas[0]->cabeza . '</td>
                                    <td></td>
                                </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->pieza_intermedia != '') {
        $examen_microscopico .= '<tr>
                                    <td width="152">Pieza intermedia: </td>
                                    <td width="200" colspan="2">' . $prueba->espermograma_pruebas[0]->pieza_intermedia . '</td>
                                    <td></td>
                                </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->cola != '') {
        $examen_microscopico .= '<tr>
                                    <td width="152">Cola: </td>
                                    <td width="200" colspan="2">' . $prueba->espermograma_pruebas[0]->cola . '</td>
                                    <td></td>
                                </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->otras_celulas != '') {
        $examen_microscopico .= ' <tr>
                                    <td width="152">Otras células: </td>
                                    <td width="200" colspan="2">' . $prueba->espermograma_pruebas[0]->otras_celulas . '</td>
                                    <td></td>
                                </tr>';
    }
    $examen_microscopico .= '<br>';
}


if ($prueba->espermograma_pruebas[0]->aglutinacion == '' && $prueba->espermograma_pruebas[0]->progresion_lineal_rapida == ''
&& $prueba->espermograma_pruebas[0]->progresion_lineal_lenta == '' && $prueba->espermograma_pruebas[0]->motilidad_no_progresiva == ''
&& $prueba->espermograma_pruebas[0]->inmoviles == '') {
$examen_directo = '';
} else {
    $examen_directo = '<tr>
                            <td colspan="3"><b>Examen Directo</b></td>
                            <td></td>
                            <td></td>
                        </tr>';
    if ($prueba->espermograma_pruebas[0]->aglutinacion != '') {
        $examen_directo .= '<tr>
                                <td width="130">Aglutinación: </td>
                                <td width="200" colspan="2">' . $prueba->espermograma_pruebas[0]->aglutinacion . '</td>
                                <td></td>
                            </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->progresion_lineal_rapida != '') {
        $examen_directo .= '<tr>
                                <td width="130">Progresión lineal rápida: </td>
                                <td width="200" colspan="2">' . $prueba->espermograma_pruebas[0]->progresion_lineal_rapida . '</td>
                                <td></td>
                            </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->progresion_lineal_lenta != '') {
        $examen_directo .= '<tr>
                                <td width="130">Progresión lineal lenta: </td>
                                <td width="200" colspan="2">' . $prueba->espermograma_pruebas[0]->progresion_lineal_lenta . '</td>
                                <td></td>
                            </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->motilidad_no_progresiva != '') {
        $examen_directo .= '<tr>
                                <td width="130">Motilidad no progresiva: </td>
                                <td width="200" colspan="2">' . $prueba->espermograma_pruebas[0]->motilidad_no_progresiva . '</td>
                                <td></td>
                            </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->inmoviles != '') {
        $examen_directo .= '<tr>
                                <td width="130">Inmóviles: </td>
                                <td width="200" colspan="2">' . $prueba->espermograma_pruebas[0]->inmoviles . '</td>
                                <td></td>
                            </tr>';
    }
    $examen_directo .= '<br>';
}

if ($prueba->espermograma_pruebas[0]->primera_hora_moviles == '' && $prueba->espermograma_pruebas[0]->primera_hora_inmoviles == ''
    && $prueba->espermograma_pruebas[0]->segunda_hora_moviles == '' && $prueba->espermograma_pruebas[0]->segunda_hora_inmoviles == ''
    && $prueba->espermograma_pruebas[0]->tercera_hora_moviles == '' && $prueba->espermograma_pruebas[0]->tercera_hora_inmoviles == '') {
    $viavilidad = '';
} else {
    $viavilidad = '<tr>
                        <td colspan="3"><b>Viavilidad</b></td>
                        <td></td>
                        <td></td>
                    </tr>';
    if ($prueba->espermograma_pruebas[0]->primera_hora_moviles != '' && $prueba->espermograma_pruebas[0]->primera_hora_inmoviles != '') {
        $viavilidad .= '<tr>
                            <td width="60">1º hora: </td>
                            <td width="110">' . $prueba->espermograma_pruebas[0]->primera_hora_moviles . '% móviles</td>
                            <td width="110">' . $prueba->espermograma_pruebas[0]->primera_hora_inmoviles . '% inmóviles</td>
                        </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->segunda_hora_moviles != '' && $prueba->espermograma_pruebas[0]->segunda_hora_inmoviles != '') {
        $viavilidad .= '<tr>
                            <td width="60">2º hora: </td>
                            <td width="110">' . $prueba->espermograma_pruebas[0]->segunda_hora_moviles . '% móviles</td>
                            <td width="110">' . $prueba->espermograma_pruebas[0]->segunda_hora_moviles . '% inmóviles</td>
                        </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->tercera_hora_moviles != '' && $prueba->espermograma_pruebas[0]->tercera_hora_inmoviles != '') {
        $viavilidad .= '<tr>
                            <td width="60">3º hora: </td>
                            <td width="110">' . $prueba->espermograma_pruebas[0]->tercera_hora_moviles . '% móviles</td>
                            <td width="110">' . $prueba->espermograma_pruebas[0]->tercera_hora_moviles . '% inmóviles</td>
                        </tr>';
    }

    $viavilidad .= '<br>';
}

$tabla_hora = '';
$tabla_hora = '<table>' . $datos_hora . '</table>';
$pdf->writeHTMLCell($w=125, $h=0, $x='15', $y='40', $tabla_hora, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

if (($examen_fisico == '' && $examen_directo == '') ||
($examen_microscopico == '' && $viavilidad == '')) {

    $tabla = '';
    $tabla = '<table>' . $examen_fisico . $examen_directo . $examen_microscopico .  $viavilidad . '</table>';
    $pdf->writeHTMLCell($w=150, $h=0, $x='75', $y='47', $tabla, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);
}
else {
    $tabla1 = '';
    $tabla1 = '<table>' . $examen_fisico . $examen_directo . '</table>';
    $pdf->writeHTMLCell($w=150, $h=0, $x='12', $y='47', $tabla1, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

    $tabla2 = '';
    $tabla2 = '<table>' . $examen_microscopico . $viavilidad . '</table>';
    $pdf->writeHTMLCell($w=150, $h=0, $x='110', $y='47', $tabla2, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);
}

$pdf->SetFont('helvetica','',7);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA</b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='115', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$nombre = Text::slug(date('Y-m-d h-i-s') . '-' . 'examen-general-' .  $prueba->paciente->nombre . '-' .  $prueba->paciente->apellidos);
$pdf->Output($nombre . '.pdf', 'I');

?>
