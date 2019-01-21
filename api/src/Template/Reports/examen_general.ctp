<?php

use App\Utils\Pdf;
use Cake\Utility\Text;
use App\Utils\CompanyInfo;

set_time_limit(3600);

$title = 'Examen General de Orina';
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
$title = '<p><b>EXAMEN GENERAL DE ORINA</b></p>';
$pdf->writeHTML($title, true, false, true, false, 'C');
$pdf->Ln(1);

$examen_fisico = '<table>
                <tr>
                    <td width="23%" colspan="2"><b>Exámen Físico</b></td>
                    <td width="10%"><b>Valores de referencia</b></td>
                </tr>
                <tr>
                    <td width="9%">Color: </td>
                    <td width="14%">' . $prueba->examen_general_pruebas[0]->color . '</td>
                    <td width="15%" style="color: rgb(58,137,159)">Ámbar</td>
                </tr>
                <tr>
                    <td>Cantidad: </td>
                    <td>' . $prueba->examen_general_pruebas[0]->cantidad . '</td>
                    <td style="color: rgb(58,137,159)"></td>
                </tr>
                <tr>
                    <td>Olor: </td>
                    <td>' . $prueba->examen_general_pruebas[0]->olor . '</td>
                    <td style="color: rgb(58,137,159)">Suigéneris</td>
                </tr>
                <tr>
                    <td>Aspecto: </td>
                    <td>' . $prueba->examen_general_pruebas[0]->aspecto . '</td>
                    <td style="color: rgb(58,137,159)">Límpido</td>
                </tr>
                <tr>
                    <td>Espuma: </td>
                    <td>' . $prueba->examen_general_pruebas[0]->espuma . '</td>
                    <td style="color: rgb(58,137,159)">Blanca Fugaz</td>
                </tr>
                <tr>
                    <td>Sedimento: </td>
                    <td>' . $prueba->examen_general_pruebas[0]->sedimento . '</td>
                    <td style="color: rgb(58,137,159)">Escaso o/nulo</td>
                </tr>
                <tr>
                    <td>Densidad: </td>
                    <td>' . $prueba->examen_general_pruebas[0]->densidad . '</td>
                    <td style="color: rgb(58,137,159)">1012 - 1030</td>
                </tr>
                <tr>
                    <td>Reacción: </td>
                    <td>' . $prueba->examen_general_pruebas[0]->reaccion . '</td>
                    <td style="color: rgb(58,137,159)">Ácida</td>
                </tr>
</table><br>';

$examen_quimico = '<table>
                <tr>
                    <td width="40%" colspan="2"><b>Exámen Químico</b></td>
                    <td width="15%"><b>Valores de referencia</b></td>
                </tr>
                <tr>
                    <td width="18%">Proteínas: </td>
                    <td width="22%">' . $prueba->examen_general_pruebas[0]->proteinas . '</td>
                    <td width="15%" style="color: rgb(58,137,159)">No contiene</td>
                </tr>
                <tr>
                    <td>Glucosa: </td>
                    <td>' . $prueba->examen_general_pruebas[0]->glucosa . '</td>
                    <td style="color: rgb(58,137,159)">No contiene</td>
                </tr>
                <tr>
                    <td>Cetona: </td>
                    <td>' . $prueba->examen_general_pruebas[0]->cetona . '</td>
                    <td style="color: rgb(58,137,159)">No contiene</td>
                </tr>
                <tr>
                    <td>Bilirrubina: </td>
                    <td>' . $prueba->examen_general_pruebas[0]->bilirrubina . '</td>
                    <td style="color: rgb(58,137,159)">No contiene</td>
                </tr>
                <tr>
                    <td>Sangre: </td>
                    <td>' . $prueba->examen_general_pruebas[0]->sangre . '</td>
                    <td style="color: rgb(58,137,159)">No contiene</td>
                </tr>
                <tr>
                    <td>Nitritos: </td>
                    <td>' . $prueba->examen_general_pruebas[0]->nitritos . '</td>
                    <td style="color: rgb(58,137,159)">No contiene</td>
                </tr>
                <tr>
                    <td>Urubilinogeno: </td>
                    <td>' . $prueba->examen_general_pruebas[0]->urubilinogeno . '</td>
                    <td style="color: rgb(58,137,159)">0,1 - 1 mg/dl</td>
                </tr>
</table>';

$examen_microscopico = '<table>
                <tr>
                    <td colspan="2"><b>Exámen Microscópico Sedimento</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td td width="70">Eritrocitos: </td>
                    <td td width="140">' . $prueba->examen_general_pruebas[0]->eritrocitos . '</td>
                </tr>
                <tr>
                    <td>Piocitos: </td>
                    <td>' . $prueba->examen_general_pruebas[0]->piocitos . '</td>
                </tr>
                <tr>
                    <td>Leucocitos: </td>
                    <td>' . $prueba->examen_general_pruebas[0]->leucocitos . '</td>
                </tr>
                <tr>
                    <td>Cilindros: </td>
                    <td>' . $prueba->examen_general_pruebas[0]->cilindros . '</td>
                </tr>
                <tr>
                    <td>Células: </td>
                    <td>' . $prueba->examen_general_pruebas[0]->celulas . '</td>
                </tr>
                <tr>
                    <td>Cristales: </td>
                    <td>' . $prueba->examen_general_pruebas[0]->cristales . '</td>
                </tr>
                <tr>
                    <td>Otros: </td>
                    <td>' . nl2br($prueba->examen_general_pruebas[0]->otros) . '</td>
                </tr>
</table>';

$examen_bacteriologico = '<table>
                <tr>
                    <td><b>Exámen Bacteriológico Sedimento</b></td>
                </tr>
                <tr>
                    <td>' . nl2br($prueba->examen_general_pruebas[0]->exa_bac_sed) . '</td>
                </tr>
            </table>';

$pdf->writeHTMLCell($w=0, $h=0, $x='7', $y='42', $examen_fisico, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->writeHTMLCell($w=70, $h=0, $x='7', $y='', $examen_bacteriologico, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->writeHTMLCell($w=0, $h=0, $x='77', $y='42', $examen_quimico, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->writeHTMLCell($w=100, $h=0, $x='151', $y='42', $examen_microscopico, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetTextColor(0,0,0);
$pdf->SetFont('helvetica','',7);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA<br>
            JEFE DE LABORATORIO
            </b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='122', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$nombre = Text::slug(date('Y-m-d h-i-s') . '-' . 'general-orina-' .  $prueba->paciente->nombre . '-' .  $prueba->paciente->apellidos);
$pdf->Output($nombre . '.pdf', 'I');

?>
