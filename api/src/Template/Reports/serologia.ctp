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
                    <td><p><FONT style="color: rgb(150,0,0)">Fecha: </FONT>' . $prueba->fecha->format('d-m-Y H:i:s') . '</p></td>
                </tr>
            </table>';

$pdf->writeHTMLCell($w=180, $h=0, $x='40', $y='', $initData, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetFont('helvetica','',9);
$title = '<p><b>SEROLOGÍA</b></p>';
$pdf->writeHTML($title, true, false, true, false, 'C');
$pdf->Ln(1);

if ($prueba->serologia_pruebas[0]->factor_reumatoide == '' && $prueba->serologia_pruebas[0]->pcr == ''
    && $prueba->serologia_pruebas[0]->asto == '' && $prueba->serologia_pruebas[0]->aso == '') {
$serologia = '';
} else {
    $serologia = '<tr>
                        <td width="110">Factor Reumatoide: </td>
                        <td width="110"> ' . $prueba->serologia_pruebas[0]->factor_reumatoide . ' UI/ml</td>
                        <td width="120" style="color: rgb(58,137,159)">a partir de 30 UI/ml</td>
                    </tr>';
    if ($prueba->serologia_pruebas[0]->factor_reumatoide != '') {
        $serologia .= '<tr>
                        <td width="110">Factor Reumatoide: </td>
                        <td width="110"> ' . $prueba->serologia_pruebas[0]->factor_reumatoide . ' UI/ml</td>
                        <td width="120" style="color: rgb(58,137,159)">a partir de 30 UI/ml</td>
                    </tr>';
    }
    if ($prueba->serologia_pruebas[0]->pcr != '') {
        $serologia .= '<tr>
                        <td width="110">PCR: </td>
                        <td width="110"> ' . $prueba->serologia_pruebas[0]->pcr . ' mg/L</td>
                        <td width="120" style="color: rgb(58,137,159)">a partir de 6 mg/L</td>
                    </tr>';
    }
    if ($prueba->serologia_pruebas[0]->asto != '') {
        $serologia .= '<tr>
                        <td width="110">ASTO: </td>
                        <td width="110"> ' . $prueba->serologia_pruebas[0]->asto . ' U TODD</td>
                        <td width="120" style="color: rgb(58,137,159)">hasta 166 U TODD</td>
                    </tr>';
    }
    if ($prueba->serologia_pruebas[0]->aso != '') {
        $serologia .= '<tr>
                    <td width="110">ASO: </td>
                    <td width="110"> ' . $prueba->serologia_pruebas[0]->aso . ' UI/ml</td>
                    <td width="120" style="color: rgb(58,137,159)">a partir de 200 UI/ml</td>
                </tr>';
    }
    $serologia .= '<br>';
}

if ($prueba->serologia_pruebas[0]->k_plus == '' && $prueba->serologia_pruebas[0]->na_plus == ''
    && $prueba->serologia_pruebas[0]->cl_minus == '' && $prueba->serologia_pruebas[0]->ca == ''
    && $prueba->serologia_pruebas[0]->p == '') {
$ionograma = '';
} else {
    $ionograma = '<tr>
                    <td colspan="3"><b>Ionograma</b></td>
                    <td></td>
                    <td></td>
                </tr>';
    if ($prueba->serologia_pruebas[0]->k_plus != '') {
        $ionograma .= '<tr>
                        <td width="110">K+: </td>
                        <td width="110">' . $prueba->serologia_pruebas[0]->k_plus . ' mEq/L</td>
                        <td width="120" style="color: rgb(58,137,159)">3,4 - 5,3 mEq/L</td>
                    </tr>';
    }
    if ($prueba->serologia_pruebas[0]->na_plus != '') {
        $ionograma .= '<tr>
                        <td width="110">Na+: </td>
                        <td width="110">' . $prueba->serologia_pruebas[0]->na_plus . ' mEq/L</td>
                        <td width="120" style="color: rgb(58,137,159)">135 - 155 mEq/L</td>
                    </tr>';
    }
    if ($prueba->serologia_pruebas[0]->cl_minus != '') {
        $ionograma .= '<tr>
                        <td width="110">Cl-: </td>
                        <td width="110">' . $prueba->serologia_pruebas[0]->cl_minus . ' mEq/L</td>
                        <td width="120" style="color: rgb(58,137,159)">98 - 106 mEq/L</td>
                    </tr>';
    }
    if ($prueba->serologia_pruebas[0]->ca != '') {
        $ionograma .= '<tr>
                        <td width="110">Ca: </td>
                        <td width="110">' . $prueba->serologia_pruebas[0]->ca . ' mg/dl</td>
                        <td width="120" style="color: rgb(58,137,159)">9,2 - 11,0 mg/dl</td>
                    </tr>';
    }
    if ($prueba->serologia_pruebas[0]->p != '') {
        $ionograma .= '<tr>
                        <td width="110">P: </td>
                        <td width="110">' . $prueba->serologia_pruebas[0]->p . ' mg/dl</td>
                        <td width="120" style="color: rgb(58,137,159)">2,5 - 4,8 mg/dl</td>
                    </tr>';
    }
    $ionograma .= '<br>';
}


if ($prueba->serologia_pruebas[0]->chagas == '' && $prueba->serologia_pruebas[0]->toxoplasmosis == ''
) {
    $hai = '';
} else {
    $hai = '';
    if ($prueba->serologia_pruebas[0]->chagas != '') {
    $hai .= '<tr>
                    <br>
                    <td width="110"><b>HAI Chagas</b></td>
                    <td width="110">' . $prueba->serologia_pruebas[0]->chagas . '</td>
                    <td width="120" style="color: rgb(58,137,159)">a partir de 1/16</td>
                </tr>';
    }
    if ($prueba->serologia_pruebas[0]->toxoplasmosis != '') {
        $hai .= '<tr>
                        <br>
                        <td width="110"><b>HAI Toxoplasmosis</b></td>
                        <td width="110">' . $prueba->serologia_pruebas[0]->toxoplasmosis . '</td>
                        <td width="120" style="color: rgb(58,137,159)">a partir de 1/16</td>
                    </tr>';
    }
    $hai .= '<br>';
}

if ($prueba->serologia_pruebas[0]->chagas_resultado == '' && $prueba->serologia_pruebas[0]->chagas_elisa_cut_off == ''
    && $prueba->serologia_pruebas[0]->chagas_comentario == '') {
    $elisa = '';
} else {
    $elisa = '<tr>
                <td colspan="3"><b>ElISA Chagas</b></td>
                <td></td>
                <td></td>
            </tr>';
    if ($prueba->serologia_pruebas[0]->chagas_resultado != '') {
        $elisa .= '<tr>
                    <td width="80">Resultado: </td>
                    <td width="80">' . $prueba->serologia_pruebas[0]->chagas_resultado . '</td>
                    <td width="160"style="color: rgb(58,137,159)">Reactivo: Mayor al Cut Off</td>
                </tr>
                <tr>
                    <td width="80"></td>
                    <td width="80"></td>
                    <td width="160" style="color: rgb(58,137,159)">No Reactivo: Menor al Cut Off</td>
                </tr>';
    }
    if ($prueba->serologia_pruebas[0]->chagas_elisa_cut_off != '') {
        $elisa .= '<tr>
                    <td width="80">Cut Off: </td>
                    <td width="80">'. $prueba->serologia_pruebas[0]->chagas_elisa_cut_off . '</td>
                    <td width="160" style="color: rgb(58,137,159)">Dudoso: Igual al Cut Off</td>
                </tr>';
    }
    if ($prueba->serologia_pruebas[0]->chagas_comentario != '') {
        $elisa .= '<tr>
                    <td>Comentario: </td>
                    <td width="230" colspan="2">'. $prueba->serologia_pruebas[0]->chagas_comentario . '</td>
                    <td></td>
                </tr>';
    }
    $elisa .= '<br>';
}

if ($prueba->serologia_pruebas[0]->tiempo_sangria == '' && $prueba->serologia_pruebas[0]->tiempo_coagulacion == ''
    && $prueba->serologia_pruebas[0]->tiempo_protrombina == '' && $prueba->serologia_pruebas[0]->actividad_protrombina == ''
    && $prueba->serologia_pruebas[0]->grupo_sanguineo == '' && $prueba->serologia_pruebas[0]->factor_rh == ''
    && $prueba->serologia_pruebas[0]->recuento_plaquetas == '' && $prueba->serologia_pruebas[0]->agr_dis_plaquetaria == '') {
$coagulograma = '';
} else {
    $coagulograma = '<tr>
                    <td colspan="3"><b>Coagulograma</b></td>
                    <td></td>
                    <td></td>
                </tr>';
    if ($prueba->serologia_pruebas[0]->tiempo_sangria != '') {
        $coagulograma .= '<tr>
                            <td width="130">Tiempo de sangría: </td>
                            <td width="100">'. $prueba->serologia_pruebas[0]->tiempo_sangria . '</td>
                            <td width="100" style="color: rgb(58,137,159)">2 – 5 min</td>
                        </tr>';
    }
    if ($prueba->serologia_pruebas[0]->tiempo_coagulacion != '') {
        $coagulograma .= '<tr>
                            <td>Tiempo de coagulación: </td>
                            <td>'. $prueba->serologia_pruebas[0]->tiempo_coagulacion . '</td>
                            <td style="color: rgb(58,137,159)">5 – 7,5 min</td>
                        </tr>';
    }
    if ($prueba->serologia_pruebas[0]->tiempo_protrombina != '') {
        $coagulograma .= '<tr>
                            <td>Tiempo de Protrombina: </td>
                            <td>'. $prueba->serologia_pruebas[0]->tiempo_protrombina . '</td>
                            <td style="color: rgb(58,137,159)">11 – 13 seg</td>
                        </tr>';
    }
    if ($prueba->serologia_pruebas[0]->actividad_protrombina != '') {
        $coagulograma .= '<tr>
                            <td>Actividad Protrombina: </td>
                            <td>'. $prueba->serologia_pruebas[0]->actividad_protrombina . '</td>
                            <td style="color: rgb(58,137,159)"></td>
                        </tr>';
    }
    if ($prueba->serologia_pruebas[0]->grupo_sanguineo != '') {
        $coagulograma .= '<tr>
                            <td>Grupo sanguineo: </td>
                            <td>'. $prueba->serologia_pruebas[0]->grupo_sanguineo . '</td>
                            <td style="color: rgb(58,137,159)"></td>
                        </tr>';
    }
    if ($prueba->serologia_pruebas[0]->factor_rh != '') {
        $coagulograma .= '<tr>
                            <td>Factor Rh: </td>
                            <td>'. $prueba->serologia_pruebas[0]->factor_rh . '</td>
                            <td style="color: rgb(58,137,159)"></td>
                        </tr>';
    }
    if ($prueba->serologia_pruebas[0]->recuento_plaquetas != '') {
        $coagulograma .= '<tr>
                            <td>Recuento de plaquetas: </td>
                            <td>'. $prueba->serologia_pruebas[0]->recuento_plaquetas . '</td>
                            <td style="color: rgb(58,137,159)">150.000 - 450.000 X mm3 de sangre</td>
                        </tr>';
    }
    if ($prueba->serologia_pruebas[0]->agr_dis_plaquetaria != '') {
        $coagulograma .= '<tr>
                    <td width="150">Agregación y distribución plaquetaria: </td>
                    <td width="150" colspan="2">'. $prueba->serologia_pruebas[0]->agr_dis_plaquetaria . '</td>
                    <td></td>
                </tr>';
    }
    $coagulograma .= '<br>';
}

if (($serologia == '' && $ionograma == '' && $hai == '') ||
    ($elisa == '' && $coagulograma == '')) {
    $tabla = '';
    $tabla = '<table>' . $serologia . $ionograma . $hai . $elisa . $coagulograma . '</table>';
    $pdf->writeHTMLCell($w=130, $h=0, $x='64', $y='42', $tabla, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);
}
else {
    $tabla1 = '';
    $tabla1 = '<table>' . $serologia .  $ionograma . $hai . '</table>';
    $pdf->writeHTMLCell($w=125, $h=0, $x='15', $y='42', $tabla1, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

    $tabla2 = '';
    $tabla2 = '<table>' . $elisa . $coagulograma . '</table>';
    $pdf->writeHTMLCell($w=130, $h=0, $x='115', $y='42', $tabla2, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);
}

$pdf->SetFont('helvetica','',7);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA</b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='115', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$nombre = Text::slug(date('Y-m-d h-i-s') . '-' . 'serologia-' .  $prueba->paciente->nombre . '-' .  $prueba->paciente->apellidos);
$pdf->Output($nombre . '.pdf', 'I');

?>
