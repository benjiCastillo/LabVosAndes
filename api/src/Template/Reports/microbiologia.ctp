<?php

use App\Utils\Pdf;
use Cake\Utility\Text;
use App\Utils\CompanyInfo;

set_time_limit(3600);

$title = 'Microbiología';
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
$title = '<p><b>MICROBIOLOGÍA</b></p>';
$pdf->writeHTML($title, true, false, true, false, 'C');
$pdf->Ln(1);

$micro = '<tr>
                <td colspan="3"><b>Examen de Secreción Vaginal</b></td>
                <td></td>
            </tr>';
if ($prueba->microbiologia_pruebas[0]->celulas_epitelio_vaginal == '' && $prueba->microbiologia_pruebas[0]->leucocitos == ''
    && $prueba->microbiologia_pruebas[0]->piocitos == '' && $prueba->microbiologia_pruebas[0]->celulas_clave == ''
    && $prueba->microbiologia_pruebas[0]->tricomona_vaginalis == '' && $prueba->microbiologia_pruebas[0]->flora_bacteriana == ''
    && $prueba->microbiologia_pruebas[0]->hifas_micoticas == '' && $prueba->microbiologia_pruebas[0]->prueba_koh == ''
    && $prueba->microbiologia_pruebas[0]->coco_bacilos_gram_positivos == '' && $prueba->microbiologia_pruebas[0]->cocos_gram_positivos == ''
    && $prueba->microbiologia_pruebas[0]->bacilos_gram_positivos == '' && $prueba->microbiologia_pruebas[0]->bacilos_gram_negativos == ''
    && $prueba->microbiologia_pruebas[0]->hifas_esporas_micoticas == '') {
$fresco = '';
} else {
    $fresco = '<tr>
                <br>
                <td colspan="3"><b> Examen en Fresco</b></td>
                <td></td>
            </tr>';
    if ($prueba->microbiologia_pruebas[0]->celulas_epitelio_vaginal != '') {
        $fresco .= '<tr>
                    <td width="165">        Células del epitelio vaginal: </td>
                    <td width="110">' . $prueba->microbiologia_pruebas[0]->celulas_epitelio_vaginal . '</td>
                </tr>';
    }
    if ($prueba->microbiologia_pruebas[0]->leucocitos != '') {
        $fresco .= '<tr>
                    <td width="165">        Leucocitos: </td>
                    <td width="110">' . $prueba->microbiologia_pruebas[0]->leucocitos . '</td>
                </tr>';
    }
    if ($prueba->microbiologia_pruebas[0]->piocitos != '') {
        $fresco .= '<tr>
                    <td width="165">        Piocitos: </td>
                    <td width="110">' . $prueba->microbiologia_pruebas[0]->piocitos . '</td>
                </tr>';
    }
    if ($prueba->microbiologia_pruebas[0]->celulas_clave != '') {
        $fresco .= '<tr>
                    <td width="165">        Células clave: </td>
                    <td width="110">' . $prueba->microbiologia_pruebas[0]->celulas_clave . '</td>
                </tr>';
    }
    if ($prueba->microbiologia_pruebas[0]->tricomona_vaginalis != '') {
        $fresco .= '<tr>
                    <td width="165">        Tricomona vaginalis: </td>
                    <td width="110">' . $prueba->microbiologia_pruebas[0]->tricomona_vaginalis . '</td>
                </tr>';
    }
    if ($prueba->microbiologia_pruebas[0]->flora_bacteriana != '') {
        $fresco .= '<tr>
                    <td width="165">        Flora bacteriana: </td>
                    <td width="110">' . $prueba->microbiologia_pruebas[0]->flora_bacteriana . '</td>
                </tr>';
    }
    if ($prueba->microbiologia_pruebas[0]->hifas_micoticas != '') {
        $fresco .= '<tr>
                    <td width="165">        Hifas micóticas: </td>
                    <td width="110">' . $prueba->microbiologia_pruebas[0]->hifas_micoticas . '</td>
                </tr>';
    }
    $fresco .= '<br>';
}

if ($prueba->microbiologia_pruebas[0]->prueba_koh == '') {
$koh = '';
} else {
    $koh = '';
    if ($prueba->microbiologia_pruebas[0]->prueba_koh != '') {
        $koh .= '<tr>
                    <td width="165"><b> Prueba KOH: </b></td>
                    <td width="110">' . $prueba->microbiologia_pruebas[0]->prueba_koh . '</td>
                </tr>';
    }
    $koh .= '<br>';
}

if ($prueba->microbiologia_pruebas[0]->coco_bacilos_gram_positivos == '' && $prueba->microbiologia_pruebas[0]->cocos_gram_positivos == ''
    && $prueba->microbiologia_pruebas[0]->bacilos_gram_positivos == '' && $prueba->microbiologia_pruebas[0]->bacilos_gram_negativos == ''
    && $prueba->microbiologia_pruebas[0]->hifas_esporas_micoticas == '') {
    $gram = '';
} else {
    $gram = '<tr>
                <td colspan="3"><b> Examen en gram</b></td>
                <td></td>
            </tr>';
    if ($prueba->microbiologia_pruebas[0]->coco_bacilos_gram_positivos != '') {
        $gram .= '<tr>
                    <td width="165">        Coco-bacilos Gram positivos: </td>
                    <td width="110">' . $prueba->microbiologia_pruebas[0]->coco_bacilos_gram_positivos . '</td>
                </tr>';
    }
    if ($prueba->microbiologia_pruebas[0]->cocos_gram_positivos != '') {
        $gram .= '<tr>
                    <td width="165">        Cocos Gram positivos: </td>
                    <td width="110">' . $prueba->microbiologia_pruebas[0]->cocos_gram_positivos . '</td>
                </tr>';
    }
    if ($prueba->microbiologia_pruebas[0]->bacilos_gram_positivos != '') {
        $gram .= '<tr>
                    <td width="165">        Bacilos Gram positivos: </td>
                    <td width="110">' . $prueba->microbiologia_pruebas[0]->bacilos_gram_positivos . '</td>
                </tr>';
    }
    if ($prueba->microbiologia_pruebas[0]->bacilos_gram_negativos != '') {
        $gram .= '<tr>
                    <td width="165">        Bacilos Gram negativos: </td>
                    <td width="110">' . $prueba->microbiologia_pruebas[0]->bacilos_gram_negativos . '</td>
                </tr>';
    }
    if ($prueba->microbiologia_pruebas[0]->hifas_esporas_micoticas != '') {
        $gram .= '<tr>
                    <td width="165">        Hifas y esporas micóticas: </td>
                    <td width="110">' . $prueba->microbiologia_pruebas[0]->hifas_esporas_micoticas . '</td>
                </tr>';
    }
}

$tabla1 = '<table>' . $micro . $fresco . $koh . $gram .
            '</table>';

$pdf->writeHTMLCell($w=150, $h=80, $x='75', $y='40', $tabla1, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetFont('helvetica','',7);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA</b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='120', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$nombre = Text::slug(date('Y-m-d h-i-s') . '-' . 'microbiologia-' .  $prueba->paciente->nombre . '-' .  $prueba->paciente->apellidos);
$pdf->Output($nombre . '.pdf', 'I');

?>
