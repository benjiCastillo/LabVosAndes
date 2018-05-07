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
                    <td><p><FONT style="color: rgb(150,0,0)">Dr.(a): </FONT>' . $prueba->medico->nombre . ' ' . $prueba->medico->apellidos . '</p></td>
                    <td><p><FONT style="color: rgb(150,0,0)">Fecha: </FONT>' . $prueba->fecha->format('d-m-Y H:i:s') . '</p></td>
                </tr>
            </table>';

$pdf->writeHTMLCell($w=180, $h=0, $x='40', $y='', $initData, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetFont('helvetica','',9);
$title = '<p><b>PARASITOLOGÍA</b></p>';
$pdf->writeHTML($title, true, false, true, false, 'C');
$pdf->Ln(1);

$tabla1 = '<table style="padding: 2px;">
                <tr>
                    <td colspan="3"><b>Coproparasitológico Simple</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="110">Consistencia: </td>
                    <td width="100">' . $prueba->parasitologia_pruebas[0]->consistencia . '</td>
                    <td style="color: rgb(58,137,159)">Semi líquido</td>
                </tr>
                <tr>
                    <td>Color: </td>
                    <td>' . $prueba->parasitologia_pruebas[0]->color . '</td>
                    <td style="color: rgb(58,137,159)">Pardo claro</td>
                </tr>
                <tr>
                    <td>Restos alimenticios: </td>
                    <td>' . $prueba->parasitologia_pruebas[0]->restos_alimenticios . '</td>
                    <td style="color: rgb(58,137,159)">Regular cantidad</td>
                </tr>
                <tr>
                    <br>
                    <td colspan="3"><b>Moco Fecal</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Leucocitos: </td>
                    <td>' . $prueba->parasitologia_pruebas[0]->leucocitos . '</td>
                    <td style="color: rgb(58,137,159)">8 - 10 pcm</td>
                </tr>
                <tr>
                    <td colspan="3">' . $prueba->parasitologia_pruebas[0]->comentario . '</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <br>
                    <td colspan="3"><b>Sangre Oculta: </b>' . $prueba->parasitologia_pruebas[0]->sangre_oculta . '</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <br>
                    <td colspan="3"><b>Examen Mocroscópico: </b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>' . $prueba->parasitologia_pruebas[0]->muestras . ' </td>
                    <td></td>
                    <td></td>
                </tr>
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
