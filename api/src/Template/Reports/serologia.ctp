<?php

use App\Utils\Pdf;
use Cake\Utility\Text;
use App\Utils\CompanyInfo;

set_time_limit(3600);

$title = 'Serología';
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
$title = '<p><b>SEROLOGÍA</b></p>';
$pdf->writeHTML($title, true, false, true, false, 'C');
$pdf->Ln(1);

$tabla1 = '<table>
                <tr>
                    <td>Factor Reumatoide: </td>
                    <td width="100"> ' . $prueba->serologia_pruebas[0]->factor_reumatoide . ' UI/ml</td>
                    <td width="140" style="color: rgb(58,137,159)">a partir de 30 UI/ml</td>
                </tr>
                <tr>
                    <td>PCR: </td>
                    <td> ' . $prueba->serologia_pruebas[0]->pcr . ' mg/L</td>
                    <td style="color: rgb(58,137,159)">a partir de 6 mg/L</td>
                </tr>
                <tr>
                    <td>ASTO: </td>
                    <td> ' . $prueba->serologia_pruebas[0]->asto . ' unidades TODD</td>
                    <td style="color: rgb(58,137,159)">hasta 166 unidades TODD</td>
                </tr>
                <tr>
                    <td>ASO: </td>
                    <td> ' . $prueba->serologia_pruebas[0]->aso . ' UI/ml</td>
                    <td style="color: rgb(58,137,159)">a partir de 200 UI/ml</td>
                </tr>
                <tr>
                    <br>
                    <td colspan="3"><b>Ionograma</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>K+: </td>
                    <td>' . $prueba->serologia_pruebas[0]->k_plus . ' mEq/L</td>
                    <td style="color: rgb(58,137,159)">3,4 - 5,3 mEq/L</td>
                </tr>
                <tr>
                    <td>Na+: </td>
                    <td>' . $prueba->serologia_pruebas[0]->na_plus . ' mEq/L</td>
                    <td style="color: rgb(58,137,159)">135 - 155 mEq/L</td>
                </tr>
                <tr>
                    <td>Cl-: </td>
                    <td>' . $prueba->serologia_pruebas[0]->cl_minus . ' mEq/L</td>
                    <td style="color: rgb(58,137,159)">98 - 106 mEq/L</td>
                </tr>
                <tr>
                    <td>Ca: </td>
                    <td>' . $prueba->serologia_pruebas[0]->ca . ' mg/dl</td>
                    <td style="color: rgb(58,137,159)">9,2 - 11,0 mg/dl</td>
                </tr>
                <tr>
                    <td>P: </td>
                    <td>' . $prueba->serologia_pruebas[0]->p . ' mg/dl</td>
                    <td style="color: rgb(58,137,159)">2,5 - 4,8 mg/dl</td>
                </tr>
                <tr>
                    <br>
                    <td><b>HAI Chagas</b></td>
                    <td>' . $prueba->serologia_pruebas[0]->chagas . '</td>
                    <td style="color: rgb(58,137,159)">a partir de 1/16</td>
                </tr>
                <tr>
                    <br>
                    <td><b>HAI Toxoplasmosis</b></td>
                    <td>' . $prueba->serologia_pruebas[0]->toxoplasmosis . '</td>
                    <td style="color: rgb(58,137,159)">a partir de 1/16</td>
                </tr>
                <tr>
                    <br>
                    <td colspan="3"><b>ESLISA Chagas</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Resultado: </td>
                    <td>' . $prueba->serologia_pruebas[0]->chagas_resultado . '</td>
                    <td style="color: rgb(58,137,159)">Reactivo: Mayor al Cut Off; No Reactivo: Menor al Cut Off</td>
                </tr>
                <tr>
                    <td>Cut Off: </td>
                    <td>'. $prueba->serologia_pruebas[0]->chagas_elisa_cut_off . '</td>
                    <td style="color: rgb(58,137,159)">Dudoso: Igual al Cut Off</td>
                </tr>
                <tr>
                    <td>Comentario: </td>
                    <td colspan="2">'. $prueba->serologia_pruebas[0]->chagas_comentario . '</td>
                    <td></td>
                </tr>
                <tr>
                    <br>
                    <td colspan="3"><b>Coagulograma</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Tiempo de sangría: </td>
                    <td>'. $prueba->serologia_pruebas[0]->tiempo_sangria . '</td>
                    <td style="color: rgb(58,137,159)">2 – 5 min</td>
                </tr>
                <tr>
                    <td>Tiempo de coagulación: </td>
                    <td>'. $prueba->serologia_pruebas[0]->tiempo_coagulacion . '</td>
                    <td style="color: rgb(58,137,159)">5 – 7,5 min</td>
                </tr>
                <tr>
                    <td>Tiempo de Protrombina: </td>
                    <td>'. $prueba->serologia_pruebas[0]->tiempo_protrombina . '</td>
                    <td style="color: rgb(58,137,159)">11 – 13 seg</td>
                </tr>
                <tr>
                    <td>Actividad Protrombina: </td>
                    <td>'. $prueba->serologia_pruebas[0]->actividad_protrombina . '</td>
                    <td style="color: rgb(58,137,159)"></td>
                </tr>
                <tr>
                    <td>Grupo sanguineo: </td>
                    <td>'. $prueba->serologia_pruebas[0]->grupo_sanguineo . '</td>
                    <td style="color: rgb(58,137,159)"></td>
                </tr>
                <tr>
                    <td>Factor Rh: </td>
                    <td>'. $prueba->serologia_pruebas[0]->factor_rh . '</td>
                    <td style="color: rgb(58,137,159)"></td>
                </tr>
                <tr>
                    <br>
                    <td>Recuento de plaquetas: </td>
                    <td>'. $prueba->serologia_pruebas[0]->recuento_plaquetas . '</td>
                    <td style="color: rgb(58,137,159)">150.000 - 450.000 X mm3 de sangre</td>
                </tr>
                <tr>
                    <td>Agregación y distribución plaquetaria: </td>
                    <td>'. $prueba->serologia_pruebas[0]->agr_dis_plaquetaria . '</td>
                    <td style="color: rgb(58,137,159)"></td>
                </tr>
            </table>';

$pdf->writeHTMLCell($w=110, $h=0, $x='12', $y='42', $tabla1, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetFont('helvetica','',7);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA</b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='115', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$nombre = Text::slug('serologia-' .  $prueba->paciente->nombre . '-' .  $prueba->paciente->apellidos);
$pdf->Output($nombre . '.pdf', 'I');

?>
