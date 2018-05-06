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

$tabla1 = '<table>
                <tr>
                    <td colspan="3"><b>Examen Directo</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="110">Volumen: </td>
                    <td width="110">' . $prueba->liquido_sinovial_pruebas[0]->volumen . '</td>
                    <td style="color: rgb(58,137,159)">3,5 ml</td>
                </tr>
                <tr>
                    <td>Proteínas Totales: </td>
                    <td>' . $prueba->liquido_sinovial_pruebas[0]->proteinas_totales . '</td>
                    <td style="color: rgb(58,137,159)">2,5 g/dl</td>
                </tr>
                <tr>
                    <td>Glucosa: </td>
                    <td>' . $prueba->liquido_sinovial_pruebas[0]->glucosa . '</td>
                    <td style="color: rgb(58,137,159)">70 - 120 mg/dl</td>
                </tr>
                <tr>
                    <td>Células: </td>
                    <td>' . $prueba->liquido_sinovial_pruebas[0]->celulas . '</td>
                    <td style="color: rgb(58,137,159)">< 200 por mm3</td>
                </tr>
                <tr>
                    <td>Coágulo de fibrina: </td>
                    <td>' . $prueba->liquido_sinovial_pruebas[0]->coagulo_fibrina . '</td>
                    <td style="color: rgb(58,137,159)">< 200 por mm3</td>
                </tr>
                <tr>
                    <br>
                    <td>Glicemia: </td>
                    <td>' . $prueba->liquido_sinovial_pruebas[0]->glicemia . ' mg/dl</td>
                    <td style="color: rgb(58,137,159)">70 - 110 mg/dl</td>
                </tr>
                <tr>
                    <td>Urea: </td>
                    <td>' . $prueba->liquido_sinovial_pruebas[0]->urea . ' mg/dl</td>
                    <td style="color: rgb(58,137,159)">17 - 49 mg/dl</td>
                </tr>
                <tr>
                    <td>Creatinina: </td>
                    <td>' . $prueba->liquido_sinovial_pruebas[0]->creatinina . ' mg/dl</td>
                    <td style="color: rgb(58,137,159)">0,6 - 1,2 mg/dl</td>
                </tr>
            </table>';

$pdf->writeHTMLCell($w=150, $h=0, $x='68', $y='42', $tabla1, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetFont('helvetica','',7);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA</b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='115', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$nombre = Text::slug('parasitologia-' .  $prueba->paciente->nombre . '-' .  $prueba->paciente->apellidos);
$pdf->Output($nombre . '.pdf', 'I');

?>
