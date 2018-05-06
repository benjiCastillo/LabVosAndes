<?php

use App\Utils\Pdf;
use Cake\Utility\Text;
use App\Utils\CompanyInfo;

set_time_limit(3600);

$title = 'Cultivos';
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
$title = '<p><b>CULTIVOS</b></p>';
$pdf->writeHTML($title, true, false, true, false, 'C');
$pdf->Ln(1);

$tabla1 = '<table>
                <tr>
                    <td colspan="2"><b>Tinción de Gram Directa</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="160">Leucocitos: </td>
                    <td width="100">' . $prueba->cultivos_pruebas[0]->leucocitos . '</td>
                </tr>
                <tr>
                    <td>Bacterias: </td>
                    <td>' . $prueba->cultivos_pruebas[0]->bacterias . '</td>
                </tr>
                <tr>
                    <br>
                    <td colspan="2"><b>Cultivo de Esputo</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td>AS: </td>
                    <td width="100">' . $prueba->cultivos_pruebas[0]->esputo_as . '</td>
                </tr>
                <tr>
                    <td>Microorganismo identificado: </td>
                    <td width="100">' . $prueba->cultivos_pruebas[0]->esputo_microorganismo_identificado . '</td>
                </tr>
                <tr>
                    <br>
                    <td colspan="2"><b>Antibiograma</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td>AntiBióticos</td>
                    <td>Sensibilidad</td>
                </tr>
                <tr>
                    <td>Ampicilina + sulbactam</td>
                    <td width="100">' . $prueba->cultivos_pruebas[0]->ampicilina_sulbactam . '</td>
                </tr>
                <tr>
                    <td>Eritromicina</td>
                    <td width="100">' . $prueba->cultivos_pruebas[0]->eritromicina . '</td>
                </tr>
                <tr>
                    <td>Clindamicina</td>
                    <td width="100">' . $prueba->cultivos_pruebas[0]->clindamicina . '</td>
                </tr>
                <tr>
                    <td>Tetraciclina</td>
                    <td width="100">' . $prueba->cultivos_pruebas[0]->tetraciclina . '</td>
                </tr>
                <tr>
                    <td>Vancomicina</td>
                    <td width="100">' . $prueba->cultivos_pruebas[0]->vancomicina . '</td>
                </tr>
                <tr>
                    <br>
                    <td colspan="2"><b>Urocultivo</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Recuento de colonias: </td>
                    <td width="100">' . $prueba->cultivos_pruebas[0]->recuento_colonias . '</td>
                </tr>
                <tr>
                    <td>Agar Mac Conkey: </td>
                    <td width="100">' . $prueba->cultivos_pruebas[0]->agar_mac_conkey . '</td>
                </tr>
                <tr>
                    <td>Tinción de Gram: </td>
                    <td width="100">' . $prueba->cultivos_pruebas[0]->tincion_gram . '</td>
                </tr>
                <tr>
                    <td>Pruebas bioquímicas: </td>
                    <td width="100">' . $prueba->cultivos_pruebas[0]->pruebas_bioquimicas . '</td>
                </tr>
                <tr>
                    <td>Microorganismo identificado: </td>
                    <td width="100">' . $prueba->cultivos_pruebas[0]->urocultivo_microorganismo_identificado . '</td>
                </tr>
                <tr>
                    <br>
                    <td colspan="2"><b>Antibiograma</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td>AntiBióticos</td>
                    <td>Sensibilidad</td>
                </tr>
                <tr>
                    <td>Amoxicilina + ac. clavulanico</td>
                    <td width="100">' . $prueba->cultivos_pruebas[0]->amoxicilina_ac_clavulanico . '</td>
                </tr>
                <tr>
                    <td>Gentamicina</td>
                    <td width="100">' . $prueba->cultivos_pruebas[0]->gentamicina . '</td>
                </tr>
                <tr>
                    <td>Ciprofloxacino</td>
                    <td width="100">' . $prueba->cultivos_pruebas[0]->ciprofloxacino . '</td>
                </tr>
                <tr>
                    <td>Cefixima</td>
                    <td width="100">' . $prueba->cultivos_pruebas[0]->cefixima . '</td>
                </tr>
                <tr>
                    <td>Cotrimoxazol</td>
                    <td width="100">' . $prueba->cultivos_pruebas[0]->cotrimoxazol . '</td>
                </tr>
                <tr>
                    <td>Nitrofurantoina</td>
                    <td width="100">' . $prueba->cultivos_pruebas[0]->nitrofurantoina . '</td>
                </tr>
            </table>';

$pdf->writeHTMLCell($w=150, $h=0, $x='73', $y='42', $tabla1, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetFont('helvetica','',7);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA</b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='115', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$nombre = Text::slug('cultivos-' .  $prueba->paciente->nombre . '-' .  $prueba->paciente->apellidos);
$pdf->Output($nombre . '.pdf', 'I');

?>
