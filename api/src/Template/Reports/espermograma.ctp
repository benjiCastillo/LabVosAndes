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
                    <td><p><FONT style="color: rgb(150,0,0)">Fecha: </FONT>' . $prueba->fecha->format('d-m-Y H:i:s') . '</p></td>
                </tr>
            </table>';

$pdf->writeHTMLCell($w=180, $h=0, $x='40', $y='', $initData, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetFont('helvetica','',9);
$title = '<p><b>ESPERMOGRAMA</b></p>';
$pdf->writeHTML($title, true, false, true, false, 'C');
$pdf->Ln(1);

$datos_hora = '<tr>
                    <td width="220"><b>Hora de recolección: </b> ' . $prueba->espermograma_pruebas[0]->hora_recoleccion . '</td>
                    <td width="220"><b>Hora de recepción: </b> ' . $prueba->espermograma_pruebas[0]->hora_recepcion . '</td>
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
                                <td>Aspecto: </td>
                                <td>' . $prueba->espermograma_pruebas[0]->aspecto . '</td>
                                <td style="color: rgb(58,137,159)">Opaco Homogéneo</td>
                            </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->color != '') {
        $examen_fisico .= '<tr>
                                <td>Color: </td>
                                <td>' . $prueba->espermograma_pruebas[0]->color . '</td>
                                <td style="color: rgb(58,137,159)">Blanco amarillento</td>
                            </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->volumen != '') {
        $examen_fisico .= '<tr>
                                <td>Volumen: </td>
                                <td>' . $prueba->espermograma_pruebas[0]->volumen . '</td>
                                <td style="color: rgb(58,137,159)">1.5 – 6 ml</td>
                            </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->viscosidad != '') {
        $examen_fisico .= '<tr>
                                <td>Viscosidad: </td>
                                <td>' . $prueba->espermograma_pruebas[0]->viscosidad . '</td>
                                <td style="color: rgb(58,137,159)">5 – 10 mm</td>
                            </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->ph != '') {
        $examen_fisico .= '<tr>
                                <td>Ph: </td>
                                <td>' . $prueba->espermograma_pruebas[0]->ph . '</td>
                                <td style="color: rgb(58,137,159)">7.8 – 8.2</td>
                            </tr>';
    }
    $examen_fisico .= '<br>';
}

if ($prueba->espermograma_pruebas[0]->concentracion_espermatica == '' && $prueba->espermograma_pruebas[0]->caracteristicas_morfologicas == ''
    && $prueba->espermograma_pruebas[0]->espermatozoides_normales == '' && $prueba->espermograma_pruebas[0]->cabeza == ''
    && $prueba->espermograma_pruebas[0]->pieza_intermedia == '' && $prueba->espermograma_pruebas[0]->cola == '') {
    $examen_microscopico = '';
} else {
    $examen_microscopico = '<tr>
                                <td colspan="3"><b>Examen Microscópico</b></td>
                                <td></td>
                                <td></td>
                            </tr>';
    if ($prueba->espermograma_pruebas[0]->concentracion_espermatica != '') {
        $examen_microscopico .= '<tr>
                                    <td>Concentración espermática: </td>
                                    <td>' . $prueba->espermograma_pruebas[0]->concentracion_espermatica . '</td>
                                    <td style="color: rgb(58,137,159)">60`000.000 – 150`000.000 mm3</td>
                                </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->caracteristicas_morfologicas != '') {
        $examen_microscopico .= '<tr>
                                    <td>Características morfológicas: </td>
                                    <td>' . $prueba->espermograma_pruebas[0]->caracteristicas_morfologicas . '</td>
                                    <td style="color: rgb(58,137,159)"></td>
                                </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->espermatozoides_normales != '') {
        $examen_microscopico .= '<tr>
                                    <td>Espermatozoides normales: </td>
                                    <td>' . $prueba->espermograma_pruebas[0]->espermatozoides_normales . '</td>
                                    <td style="color: rgb(58,137,159)"></td>
                                </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->cabeza != '') {
        $examen_microscopico .= '<tr>
                                    <td>Cabeza: </td>
                                    <td>' . $prueba->espermograma_pruebas[0]->cabeza . '</td>
                                    <td style="color: rgb(58,137,159)"></td>
                                </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->pieza_intermedia != '') {
        $examen_microscopico .= '<tr>
                                    <td>Pieza intermedia: </td>
                                    <td>' . $prueba->espermograma_pruebas[0]->pieza_intermedia . '</td>
                                    <td style="color: rgb(58,137,159)"></td>
                                </tr>';
    }
    if ($prueba->espermograma_pruebas[0]->cola != '') {
        $examen_microscopico .= '<tr>
                                    <td>Cola: </td>
                                    <td>' . $prueba->espermograma_pruebas[0]->cola . '</td>
                                    <td style="color: rgb(58,137,159)"></td>
                                </tr>';
    }
    $examen_microscopico .= '<br>';
}

$tabla1 = '<table>
                <tr>
                    <td>Otras células: </td>
                    <td>' . $prueba->espermograma_pruebas[0]->leucocitos . '</td>
                    <td style="color: rgb(58,137,159)"></td>
                </tr>
                <tr>
                    <br>
                    <td colspan="3"><b>Examen Directo</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Aglutinación: </td>
                    <td>' . $prueba->espermograma_pruebas[0]->aglutinacion . '</td>
                    <td style="color: rgb(58,137,159)"></td>
                </tr>
                <tr>
                    <td>Progresión lineal rápida: </td>
                    <td>' . $prueba->espermograma_pruebas[0]->progresion_lineal_rapida . '</td>
                    <td style="color: rgb(58,137,159)"></td>
                </tr>
                <tr>
                    <td>Progresión lineal lenta: </td>
                    <td>' . $prueba->espermograma_pruebas[0]->progresion_lineal_lenta . '</td>
                    <td style="color: rgb(58,137,159)"></td>
                </tr>
                <tr>
                    <td>Motilidad no progresiva: </td>
                    <td>' . $prueba->espermograma_pruebas[0]->motilidad_no_progresiva . '</td>
                    <td style="color: rgb(58,137,159)"></td>
                </tr>
                <tr>
                    <td>Inmóviles: </td>
                    <td>' . $prueba->espermograma_pruebas[0]->inmoviles . '</td>
                    <td style="color: rgb(58,137,159)"></td>
                </tr>
                <tr>
                    <br>
                    <td colspan="3"><b>Viavilidad</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>1º hora: </td>
                    <td>' . $prueba->espermograma_pruebas[0]->celulas_germinales . '</td>
                    <td style="color: rgb(58,137,159)"></td>
                </tr>
                <tr>
                    <td>2º hora:: </td>
                    <td>' . $prueba->espermograma_pruebas[0]->celulas_germinales . '</td>
                    <td style="color: rgb(58,137,159)"></td>
                </tr>
                <tr>
                    <td>3º hora: </td>
                    <td>' . $prueba->espermograma_pruebas[0]->celulas_germinales . '</td>
                    <td style="color: rgb(58,137,159)"></td>
                </tr>
            </table><br>';

$pdf->writeHTMLCell($w=130, $h=0, $x='12', $y='42', $tabla1, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetFont('helvetica','',7);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA</b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='115', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$nombre = Text::slug('examen-general-' .  $prueba->paciente->nombre . '-' .  $prueba->paciente->apellidos);
$pdf->Output($nombre . '.pdf', 'I');

?>
