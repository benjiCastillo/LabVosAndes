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

$tabla1 = '<table style="padding: 0.2px;">
                <tr>
                    <td colspan="3"><b>Examen de Secreción Vaginal</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <br>
                    <td colspan="3"><b> Examen en Fresco</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="165">        Células del epitelio vaginal: </td>
                    <td width="110">' . $prueba->microbiologia_pruebas[0]->celulas_epitelio_vaginal . '</td>
                    <td width="100"></td>
                </tr>
                <tr>
                    <td>        Leucocitos: </td>
                    <td>' . $prueba->microbiologia_pruebas[0]->leucocitos . '</td>
                    <td></td>
                </tr>
                <tr>
                    <td>        Piocitos: </td>
                    <td>' . $prueba->microbiologia_pruebas[0]->piocitos . '</td>
                    <td></td>
                </tr>
                <tr>
                    <td>        Células clave: </td>
                    <td>' . $prueba->microbiologia_pruebas[0]->celulas_clave . '</td>
                    <td></td>
                </tr>
                 <tr>
                    <td>        Tricomona vaginalis: </td>
                    <td>' . $prueba->microbiologia_pruebas[0]->tricomona_vaginalis . '</td>
                    <td></td>
                </tr>
                 <tr>
                    <td>        Flora bacteriana: </td>
                    <td>' . $prueba->microbiologia_pruebas[0]->flora_bacteriana . '</td>
                    <td></td>
                </tr>
                <tr>
                    <td>        Hifas micóticas: </td>
                    <td>' . $prueba->microbiologia_pruebas[0]->hifas_micoticas . '</td>
                    <td></td>
                </tr>
                <tr>
                    <br>
                    <td><b> Prueba KOH: </b></td>
                    <td>' . $prueba->microbiologia_pruebas[0]->prueba_koh . '</td>
                    <td></td>
                </tr>
                <tr>
                    <br>
                    <td><b> Tinción de Gram</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>        Coco-bacilos Gram positivos: </td>
                    <td>' . $prueba->microbiologia_pruebas[0]->coco_bacilos_gram_positivos . '</td>
                    <td></td>
                </tr>
                <tr>
                    <td>        Cocos Gram positivos: </td>
                    <td>' . $prueba->microbiologia_pruebas[0]->cocos_gram_positivos . '</td>
                    <td></td>
                </tr>
                <tr>
                    <td>        Bacilos Gram positivos: </td>
                    <td>' . $prueba->microbiologia_pruebas[0]->bacilos_gram_positivos . '</td>
                    <td></td>
                </tr>
                <tr>
                    <td>        Bacilos Gram negativos: </td>
                    <td>' . $prueba->microbiologia_pruebas[0]->bacilos_gram_negativos . '</td>
                    <td></td>
                </tr>
                <tr>
                    <td>        Hifas y esporas micóticas: </td>
                    <td>' . $prueba->microbiologia_pruebas[0]->hifas_esporas_micoticas . '</td>
                    <td></td>
                </tr>
            </table>';

$pdf->writeHTMLCell($w=150, $h=0, $x='75', $y='42', $tabla1, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetFont('helvetica','',7);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA</b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='115', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$nombre = Text::slug('microbiologia-' .  $prueba->paciente->nombre . '-' .  $prueba->paciente->apellidos);
$pdf->Output($nombre . '.pdf', 'I');

?>
