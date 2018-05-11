<?php

use App\Utils\Pdf;
use Cake\Utility\Text;
use App\Utils\CompanyInfo;

set_time_limit(3600);

$title = 'Líquido Sinovial';
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
$title = '<p><b>LÍQUIDO SINOVIAL</b></p>';
$pdf->writeHTML($title, true, false, true, false, 'C');
$pdf->Ln(1);

if ($prueba->liquido_sinovial_pruebas[0]->volumen == '' && $prueba->liquido_sinovial_pruebas[0]->proteinas_totales == ''
    && $prueba->liquido_sinovial_pruebas[0]->glucosa == '' && $prueba->liquido_sinovial_pruebas[0]->celulas == '') {
$examen_directo = '';
} else {
    $examen_directo = '<tr>
                        <td width="42%" colspan="2"><b>Examen Directo</b></td>
                        <td width="25%"><b>Valores de referencia</b></td>
                    </tr>';
    if ($prueba->liquido_sinovial_pruebas[0]->volumen != '') {
        $examen_directo .= '<tr>
                            <td width="21%">Volumen: </td>
                            <td width="21%">' . $prueba->liquido_sinovial_pruebas[0]->volumen . ' ml</td>
                            <td width="25%" style="color: rgb(58,137,159)">3,5 ml</td>
                        </tr>';
    }
    if ($prueba->liquido_sinovial_pruebas[0]->proteinas_totales != '') {
        $examen_directo .= '<tr>
                            <td width="21%">Proteínas Totales: </td>
                            <td width="21%">' . $prueba->liquido_sinovial_pruebas[0]->proteinas_totales . ' g/dl</td>
                            <td width="25%" style="color: rgb(58,137,159)">2,5 g/dl</td>
                        </tr>';
    }
    if ($prueba->liquido_sinovial_pruebas[0]->glucosa != '') {
        $examen_directo .= '<tr>
                            <td width="21%">Glucosa: </td>
                            <td width="21%">' . $prueba->liquido_sinovial_pruebas[0]->glucosa . '</td>
                            <td width="25%" style="color: rgb(58,137,159)">70 - 120 mg/dl</td>
                        </tr>';
    }
    if ($prueba->liquido_sinovial_pruebas[0]->celulas != '') {
        $examen_directo .= '<tr>
                            <td width="21%">Células: </td>
                            <td width="21%">' . $prueba->liquido_sinovial_pruebas[0]->celulas . '</td>
                            <td width="25%" style="color: rgb(58,137,159)">< 200 por mm3</td>
                        </tr>';
    }
    if ($prueba->liquido_sinovial_pruebas[0]->coagulo_fibrina != '') {
        $examen_directo .= '<tr>
                            <td width="21%">Coágulo de fibrina: </td>
                            <td width="21%">' . $prueba->liquido_sinovial_pruebas[0]->coagulo_fibrina . '</td>
                            <td width="25%"></td>
                        </tr>';
    }
    $examen_directo .= '<br>';
}

if ($prueba->liquido_sinovial_pruebas[0]->glicemia == '' && $prueba->liquido_sinovial_pruebas[0]->urea == ''
    && $prueba->liquido_sinovial_pruebas[0]->creatinina == '') {
$liquido = '';
} else {
    $liquido = '';
    if ($prueba->liquido_sinovial_pruebas[0]->glicemia != '') {
        $liquido .= '<tr>
                        <td width="21%">Glicemia: </td>
                        <td width="21%">' . $prueba->liquido_sinovial_pruebas[0]->glicemia . ' mg/dl</td>
                        <td width="25%" style="color: rgb(58,137,159)">70 - 110 mg/dl</td>
                    </tr>';
    }
    if ($prueba->liquido_sinovial_pruebas[0]->urea != '') {
        $liquido .= '<tr>
                        <td width="21%">Urea: </td>
                        <td width="21%">' . $prueba->liquido_sinovial_pruebas[0]->urea . ' mg/dl</td>
                        <td width="25%" style="color: rgb(58,137,159)">17 - 49 mg/dl</td>
                    </tr>';
    }
    if ($prueba->liquido_sinovial_pruebas[0]->creatinina != '') {
        $liquido .= '<tr>
                        <td width="21%">Creatinina: </td>
                        <td width="21%">' . $prueba->liquido_sinovial_pruebas[0]->creatinina . ' mg/dl</td>
                        <td width="25%" style="color: rgb(58,137,159)">0,6 - 1,2 mg/dl</td>
                    </tr>';
    }
}

$tabla1 = '<table>' . $examen_directo . $liquido . '
            </table>';

$pdf->writeHTMLCell($w=150, $h=0, $x='68', $y='42', $tabla1, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetFont('helvetica','',7);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA</b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='115', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$nombre = Text::slug(date('Y-m-d h-i-s') . '-' . 'parasitologia-' .  $prueba->paciente->nombre . '-' .  $prueba->paciente->apellidos);
$pdf->Output($nombre . '.pdf', 'I');

?>
