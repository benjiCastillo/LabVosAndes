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
                    <td><p><FONT style="color: rgb(150,0,0)">Fecha: </FONT>' . $prueba->fecha->format('d-m-Y H:i:s') . '</p></td>
                </tr>
            </table>';

$pdf->writeHTMLCell($w=180, $h=0, $x='40', $y='', $initData, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetFont('helvetica','',9);
$title = '<p><b>CULTIVOS</b></p>';
$pdf->writeHTML($title, true, false, true, false, 'C');
$pdf->Ln(1);

if ($prueba->cultivos_pruebas[0]->leucocitos == '' && $prueba->cultivos_pruebas[0]->bacterias == '') {
    $tincion_gram_directa = '';
} else {
    $tincion_gram_directa = '<tr>
                                <td colspan="2"><b>Tinción de Gram Directa</b></td>
                                <td></td>
                            </tr>';
    if ($prueba->cultivos_pruebas[0]->leucocitos != '') {
        $tincion_gram_directa .= '<tr>
                                    <td>Leucocitos: </td>
                                    <td>' . $prueba->cultivos_pruebas[0]->leucocitos . '</td>
                                </tr>';
    }
    if ($prueba->cultivos_pruebas[0]->bacterias != '') {
        $tincion_gram_directa .= '<tr>
                                    <td>Bacterias: </td>
                                    <td>' . $prueba->cultivos_pruebas[0]->bacterias . '</td>
                                </tr>';
    }
    $tincion_gram_directa .= '<br>';
}

if ($prueba->cultivos_pruebas[0]->esputo_as == '' && $prueba->cultivos_pruebas[0]->esputo_microorganismo_identificado == '') {
    $cultivos_esputo = '';
} else {
    $cultivos_esputo = '<tr>
                            <td colspan="2"><b>Cultivo de Esputo</b></td>
                            <td></td>
                        </tr>';
    if ($prueba->cultivos_pruebas[0]->esputo_as != '') {
        $cultivos_esputo .= '<tr>
                                <td>AS: </td>
                                <td>' . $prueba->cultivos_pruebas[0]->esputo_as . '</td>
                            </tr>';
    }
    if ($prueba->cultivos_pruebas[0]->esputo_microorganismo_identificado != '') {
        $cultivos_esputo .= '<tr>
                                <td>Microorganismo identificado: </td>
                                <td>' . $prueba->cultivos_pruebas[0]->esputo_microorganismo_identificado . '</td>
                            </tr>';
    }
    $cultivos_esputo .= '<br>';
}

if ($prueba->cultivos_pruebas[0]->ampicilina_sulbactam == '' && $prueba->cultivos_pruebas[0]->eritromicina == ''
    && $prueba->cultivos_pruebas[0]->clindamicina == '' && $prueba->cultivos_pruebas[0]->tetraciclina == ''
    && $prueba->cultivos_pruebas[0]->vancomicina == '') {
    $antibiograma_esputo = '';
} else {
    $antibiograma_esputo = '<tr>
                                <td colspan="2"><b>Antibiograma</b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Antibióticos</td>
                                <td>Sensibilidad</td>
                            </tr>';
    if ($prueba->cultivos_pruebas[0]->ampicilina_sulbactam != '') {
        $antibiograma_esputo .= '<tr>
                                    <td>Ampicilina + sulbactam</td>
                                    <td>' . $prueba->cultivos_pruebas[0]->ampicilina_sulbactam . '</td>
                                </tr>';
    }
    if ($prueba->cultivos_pruebas[0]->eritromicina != '') {
        $antibiograma_esputo .= '<tr>
                                    <td>Eritromicina</td>
                                    <td>' . $prueba->cultivos_pruebas[0]->eritromicina . '</td>
                                </tr>';
    }
    if ($prueba->cultivos_pruebas[0]->clindamicina != '') {
        $antibiograma_esputo .= '<tr>
                                    <td>Clindamicina</td>
                                    <td>' . $prueba->cultivos_pruebas[0]->clindamicina . '</td>
                                </tr>';
    }
    if ($prueba->cultivos_pruebas[0]->tetraciclina != '') {
        $antibiograma_esputo .= '<tr>
                                    <td>Tetraciclina</td>
                                    <td>' . $prueba->cultivos_pruebas[0]->tetraciclina . '</td>
                                </tr>';
    }
    if ($prueba->cultivos_pruebas[0]->vancomicina != '') {
        $antibiograma_esputo .= '<tr>
                                    <td>Vancomicina</td>
                                    <td>' . $prueba->cultivos_pruebas[0]->vancomicina . '</td>
                                </tr>';
    }
    $antibiograma_esputo .= '<br>';
}

if ($prueba->cultivos_pruebas[0]->recuento_colonias == '' && $prueba->cultivos_pruebas[0]->agar_mac_conkey == ''
    && $prueba->cultivos_pruebas[0]->tincion_gram == '' && $prueba->cultivos_pruebas[0]->pruebas_bioquimicas == ''
    && $prueba->cultivos_pruebas[0]->urocultivo_microorganismo_identificado == '') {
    $urocultivo = '';
} else {
    $urocultivo = '<tr>
                        <td colspan="2"><b>Urocultivo</b></td>
                        <td></td>
                    </tr>';
    if ($prueba->cultivos_pruebas[0]->recuento_colonias != '') {
        $urocultivo .= '<tr>
                            <td>Recuento de colonias: </td>
                            <td>' . $prueba->cultivos_pruebas[0]->recuento_colonias . '</td>
                        </tr>';
    }
    if ($prueba->cultivos_pruebas[0]->agar_mac_conkey != '') {
        $urocultivo .= '<tr>
                            <td>Agar Mac Conkey: </td>
                            <td>' . $prueba->cultivos_pruebas[0]->agar_mac_conkey . '</td>
                        </tr>';
    }
    if ($prueba->cultivos_pruebas[0]->tincion_gram != '') {
        $urocultivo .= '<tr>
                            <td>Tinción de Gram: </td>
                            <td>' . $prueba->cultivos_pruebas[0]->tincion_gram . '</td>
                        </tr>';
    }
    if ($prueba->cultivos_pruebas[0]->pruebas_bioquimicas != '') {
        $urocultivo .= '<tr>
                            <td>Pruebas bioquímicas: </td>
                            <td>' . $prueba->cultivos_pruebas[0]->pruebas_bioquimicas . '</td>
                        </tr>';
    }
    if ($prueba->cultivos_pruebas[0]->urocultivo_microorganismo_identificado != '') {
        $urocultivo .= '<tr>
                            <td>Microorganismo identificado: </td>
                            <td>' . $prueba->cultivos_pruebas[0]->urocultivo_microorganismo_identificado . '</td>
                        </tr>';
    }
    $urocultivo .= '<br>';
}

if ($prueba->cultivos_pruebas[0]->amoxicilina_ac_clavulanico == '' && $prueba->cultivos_pruebas[0]->gentamicina == ''
    && $prueba->cultivos_pruebas[0]->ciprofloxacino == '' && $prueba->cultivos_pruebas[0]->cefixima == ''
    && $prueba->cultivos_pruebas[0]->cotrimoxazol == '' && $prueba->cultivos_pruebas[0]->nitrofurantoina == '') {
    $antibiograma_urocultivo = '';
} else {
    $antibiograma_urocultivo = '<tr>
                                    <td colspan="2"><b>Antibiograma</b></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Antibióticos</td>
                                    <td>Sensibilidad</td>
                                </tr>';
    if ($prueba->cultivos_pruebas[0]->amoxicilina_ac_clavulanico != '') {
        $antibiograma_urocultivo .= '<tr>
                                        <td>Amoxicilina + ac. clavulanico</td>
                                        <td>' . $prueba->cultivos_pruebas[0]->amoxicilina_ac_clavulanico . '</td>
                                    </tr>';
    }
    if ($prueba->cultivos_pruebas[0]->gentamicina != '') {
        $antibiograma_urocultivo .= '<tr>
                                        <td>Gentamicina</td>
                                        <td>' . $prueba->cultivos_pruebas[0]->gentamicina . '</td>
                                    </tr>';
    }
    if ($prueba->cultivos_pruebas[0]->ciprofloxacino != '') {
        $antibiograma_urocultivo .= '<tr>
                                        <td>Ciprofloxacino</td>
                                        <td>' . $prueba->cultivos_pruebas[0]->ciprofloxacino . '</td>
                                    </tr>';
    }
    if ($prueba->cultivos_pruebas[0]->cefixima != '') {
        $antibiograma_urocultivo .= '<tr>
                                        <td>Cefixima</td>
                                        <td>' . $prueba->cultivos_pruebas[0]->cefixima . '</td>
                                    </tr>';
    }
    if ($prueba->cultivos_pruebas[0]->cotrimoxazol != '') {
        $antibiograma_urocultivo .= '<tr>
                                        <td>Cotrimoxazol</td>
                                        <td>' . $prueba->cultivos_pruebas[0]->cotrimoxazol . '</td>
                                    </tr>';
    }
    if ($prueba->cultivos_pruebas[0]->nitrofurantoina != '') {
        $antibiograma_urocultivo .= '<tr>
                                        <td>Nitrofurantoina</td>
                                        <td>' . $prueba->cultivos_pruebas[0]->nitrofurantoina . '</td>
                                    </tr>';
    }
    $antibiograma_urocultivo .= '<br>';
}

if (($tincion_gram_directa == '' && $cultivos_esputo == '' && $antibiograma_esputo == '') ||
    ($urocultivo == '' && $antibiograma_urocultivo == '')) {
    $tabla = '';
    $tabla = '<table>' . $tincion_gram_directa . $cultivos_esputo . $antibiograma_esputo . $urocultivo .  $antibiograma_urocultivo . '</table>';
    $pdf->writeHTMLCell($w=130, $h=0, $x='75', $y='42', $tabla, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);
}
 else {
    $tabla1 = '';
    $tabla1 = '<table>' . $tincion_gram_directa .  $cultivos_esputo . $antibiograma_esputo . '</table>';
    $pdf->writeHTMLCell($w=125, $h=0, $x='30', $y='42', $tabla1, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

    $tabla2 = '';
    $tabla2 = '<table>' . $urocultivo . $antibiograma_urocultivo . '</table>';
    $pdf->writeHTMLCell($w=130, $h=0, $x='120', $y='42', $tabla2, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);
}

$pdf->SetFont('helvetica','',7);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA</b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='115', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$nombre = Text::slug(date('Y-m-d h-i-s') . '-' . 'cultivos-' .  $prueba->paciente->nombre . '-' .  $prueba->paciente->apellidos);
$pdf->Output($nombre . '.pdf', 'I');

?>
