<?php

use App\Utils\Pdf;
use Cake\Utility\Text;
use App\Utils\CompanyInfo;

set_time_limit(3600);

$title = 'Hormonas';
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
                    <td><p><FONT style="color: rgb(150,0,0)">Fecha: </FONT>' . $prueba->fecha . '</p></td>
                </tr>
            </table>';

$pdf->writeHTMLCell($w=180, $h=0, $x='40', $y='', $initData, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetFont('helvetica','',9);
$title = '<p><b>HORMONAS</b></p>';
$pdf->writeHTML($title, true, false, true, false, 'C');
$pdf->Ln(1);

$tabla1 = '<table style="padding: 2px;">
                <tr>
                    <td colspan="3"><b>Dosificación de hormonas tiroideas</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>TSH: </td>
                    <td>' . $prueba->parasitologia_pruebas[0]->consistencia . ' mlUI/l</td>
                    <td style="color: rgb(58,137,159)">Semi líquido</td>
                </tr>
                <tr>
                    <td>T4 Libre: </td>
                    <td>' . $prueba->parasitologia_pruebas[0]->color . ' ng/dl</td>
                    <td style="color: rgb(58,137,159)">0,8 - 2,0 ng/dl</td>
                </tr>
                <tr>
                    <td>T4 Total: </td>
                    <td>' . $prueba->parasitologia_pruebas[0]->restos_alimenticios . ' ng/dl</td>
                    <td style="color: rgb(58,137,159)">4,8 – 11,6 ng/dl</td>
                </tr>
                <tr>
                    <td>T3: </td>
                    <td>' . $prueba->parasitologia_pruebas[0]->restos_alimenticios . ' ng/ml</td>
                    <td style="color: rgb(58,137,159)">0,69 - 2,02 ng/ml</td>
                </tr>
                <tr>
                    <br>
                    <td colspan="3"><b>ELISA Cisticercosis</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Resultado: </td>
                    <td>' . $prueba->parasitologia_pruebas[0]->leucocitos . '</td>
                    <td style="color: rgb(58,137,159)">Reactivo: Mayor al Cut Off; No Reactivo: Menor  al Cut Off</td>
                </tr>
                <tr>
                    <td>Cut off: </td>
                    <td>' . $prueba->parasitologia_pruebas[0]->leucocitos . '</td>
                    <td style="color: rgb(58,137,159)">Dudoso: Igual al Cut Off</td>
                </tr>
                <tr>
                    <td>Comentario: </td>
                    <td colspan="2">' . $prueba->parasitologia_pruebas[0]->leucocitos . '</td>
                    <td></td>
                </tr>
                <tr>
                    <br>
                    <td colspan="3"><b>Marcadores Tumorales</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Antígeno carcinoembrionario: </td>
                    <td>' . $prueba->parasitologia_pruebas[0]->leucocitos . ' ng/dl</td>
                    <td style="color: rgb(58,137,159)">0 - 3,4 ng/dl</td>
                </tr>
                <tr>
                    <td>P S A Total: </td>
                    <td>' . $prueba->parasitologia_pruebas[0]->leucocitos . ' ng/ml</td>
                    <td style="color: rgb(58,137,159)">< = 4 ng/ml</td>
                </tr>
                <tr>
                    <td>P S A Libre: </td>
                    <td>' . $prueba->parasitologia_pruebas[0]->leucocitos . ' ng/ml</td>
                    <td style="color: rgb(58,137,159)">< = 1,3 ng/ml</td>
                </tr>
                <tr>
                    <td>Relación % PSA Libre / PSA Total: </td>
                    <td>' . $prueba->parasitologia_pruebas[0]->leucocitos . ' %</td>
                    <td style="color: rgb(58,137,159)">> = 19 %</td>
                </tr>
                <tr>
                    <br>
                    <td><b>Estadiol</b></td>
                    <td>' . $prueba->parasitologia_pruebas[0]->leucocitos . ' pg/ml</td>
                    <td style="color: rgb(58,137,159)">Fase folicular 30 - 120 pg/ml; Fase ovulatoria 130 - 370 pg/ml; Fase lútea 70 - 250 pg/ml; Fase menopáusica 15 - 60 pg/ml</td>
                </tr>
                <tr>
                    <td><b>Progesterona</b></td>
                    <td>' . $prueba->parasitologia_pruebas[0]->leucocitos . ' ng/ml</td>
                    <td style="color: rgb(58,137,159)">Fase Folicular 0,2 - 1,4 ng/ml; Fase lútea 4 - 25 ng/ml; Fase menopáusica 0,1 - 1 ng/ml</td>
                </tr>
                <tr>
                    <td><b>FSH</b></td>
                    <td>' . $prueba->parasitologia_pruebas[0]->leucocitos . ' mUI/ml</td>
                    <td style="color: rgb(58,137,159)">Mitad del ciclo 8,0 - 22 mUI/ml; Fase folicular 3,0 - 12,0  mUI/ml; Fase lútea 2 - 12  mUI/ml; Postmenopáusica 35 - 151 mUI/ml</td>
                </tr>
                <tr>
                    <td><b>LH</b></td>
                    <td>' . $prueba->parasitologia_pruebas[0]->leucocitos . ' mUI/ml</td>
                    <td style="color: rgb(58,137,159)">Fase folicular 0,8 - 10,5 UI/L; Mitad del ciclo 8,4 - 61,2 UI/L; Fase luteal 0,8 - 10,5 UI/L; Postmenopausica  8,2 - 40,8 UI/L</td>
                </tr>
                <tr>
                    <td><b>Estadiol</b></td>
                    <td>' . $prueba->parasitologia_pruebas[0]->leucocitos . ' pg/ml</td>
                    <td style="color: rgb(58,137,159)">Fase folicular 30 - 120 pg/ml; Fase ovulatoria 130 - 370 pg/ml; Fase lútea 70 - 250 pg/ml; Fase menopáusica 15 - 60 pg/ml</td>
                </tr>
                <tr>
                    <br>
                    <td><b>Prolactina</b></td>
                    <td>' . $prueba->parasitologia_pruebas[0]->leucocitos . ' mUI/L</td>
                    <td style="color: rgb(58,137,159)">1,8 - 17,0 mUI/L</td>
                </tr>
                <tr>
                    <br>
                    <td><b>Testosterona</b></td>
                    <td>' . $prueba->parasitologia_pruebas[0]->leucocitos . ' ngr/ml</td>
                    <td style="color: rgb(58,137,159)">2,4 - 12 ngr/ml</td>
                </tr>
                <tr>
                    <br>
                    <td>ANA: </td>
                    <td>' . $prueba->parasitologia_pruebas[0]->leucocitos . ' U/ml</td>
                    <td style="color: rgb(58,137,159)">Hasta 10 U/ml</td>
                </tr>
                <tr>
                    <td>Control positivo: </td>
                    <td>' . $prueba->parasitologia_pruebas[0]->leucocitos . ' U/ml</td>
                    <td style="color: rgb(58,137,159)"></td>
                </tr>
                <tr>
                    <td>Contro negativo: </td>
                    <td>' . $prueba->parasitologia_pruebas[0]->leucocitos . ' U/ml</td>
                    <td style="color: rgb(58,137,159)"></td>
                </tr>
                <tr>
                    <br>
                    <td>Células L E: </td>
                    <td>' . $prueba->parasitologia_pruebas[0]->leucocitos . ' U/ml</td>
                    <td style="color: rgb(58,137,159)">Hasta 10 U/ml</td>
                </tr>
                <tr>
                    <td>Control positivo: </td>
                    <td>' . $prueba->parasitologia_pruebas[0]->leucocitos . ' U/ml</td>
                    <td style="color: rgb(58,137,159)"></td>
                </tr>
                <tr>
                    <td>Contro negativo: </td>
                    <td>' . $prueba->parasitologia_pruebas[0]->leucocitos . ' U/ml</td>
                    <td style="color: rgb(58,137,159)"></td>
                </tr>
                <tr>
                    <br>
                    <td colspan="3"><b>Anticuerpos Anti- peptido ciclico de la Citrulina</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Resultado: </td>
                    <td>' . $prueba->parasitologia_pruebas[0]->leucocitos . '</td>
                    <td style="color: rgb(58,137,159)">Reactivo: Mayor al Cut Off; No Reactivo: Menor  al Cut Off</td>
                </tr>
                <tr>
                    <td>Cut off: </td>
                    <td>' . $prueba->parasitologia_pruebas[0]->leucocitos . '</td>
                    <td style="color: rgb(58,137,159)">Dudoso: Igual al Cut Off</td>
                </tr>
                <tr>
                    <td>Comentario: </td>
                    <td> colspan="2"' . $prueba->parasitologia_pruebas[0]->leucocitos . '</td>
                    <td></td>
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
