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
                    <td><p><FONT style="color: rgb(150,0,0)">Dr.(a): </FONT>' . $prueba->medico->nombre . '</p></td>
                    <td><p><FONT style="color: rgb(150,0,0)">Fecha: </FONT>' . $prueba->fecha->format('d-m-Y') . '</p></td>
                </tr>
            </table>';

$pdf->writeHTMLCell($w=180, $h=0, $x='40', $y='', $initData, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$pdf->SetFont('helvetica','',9);
$title = '<p><b>HORMONAS</b></p>';
$pdf->writeHTML($title, true, false, true, false, 'C');
$pdf->Ln(1);

$columns = array();
$contSub = 0;
if ($prueba->hormonas_pruebas[0]->tsh == '' && $prueba->hormonas_pruebas[0]->t4_libre == ''
    && $prueba->hormonas_pruebas[0]->t4_total == '' && $prueba->hormonas_pruebas[0]->t3 == '') {
    $dosificacion = '';
} else {
    $dosificacion = '<tr>
                        <td width="50%" colspan="2"><b>Dosificación de hormonas tiroideas</b></td>
                        <td width="35%"><b>Valores de Referencia</b></td>
                    </tr>';
    if ($prueba->hormonas_pruebas[0]->tsh != '') {
        $dosificacion .= '<tr>
                            <td width="25%">TSH: </td>
                            <td width="25%">' . $prueba->hormonas_pruebas[0]->tsh . ' mlUI/l</td>
                            <td width="35%"style="color: rgb(58,137,159)">Semi líquido</td>
                        </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->t4_libre != '') {
        $dosificacion .= '<tr>
                            <td width="25%">T4 Libre: </td>
                            <td width="25%">' . $prueba->hormonas_pruebas[0]->t4_libre . ' ng/dl</td>
                            <td width="35%" style="color: rgb(58,137,159)">0,8 - 2,0 ng/dl</td>
                        </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->t4_total != '') {
        $dosificacion .= '<tr>
                            <td width="25%">T4 Total: </td>
                            <td width="25%">' . $prueba->hormonas_pruebas[0]->t4_total . ' ng/dl</td>
                            <td width="35%" style="color: rgb(58,137,159)">4,8 - 11,6 ng/dl</td>
                        </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->t3 != '') {
        $dosificacion .= '<tr>
                            <td width="25%">T3: </td>
                            <td width="25%">' . $prueba->hormonas_pruebas[0]->t3 . ' ng/ml</td>
                            <td width="35%" style="color: rgb(58,137,159)">0,69 - 2,02 ng/ml</td>
                        </tr>';
    }
    $dosificacion .= '<br>';
    array_push($columns, $dosificacion);
    $contSub++;
}

if ($prueba->hormonas_pruebas[0]->cisticercosis_resultado == '' && $prueba->hormonas_pruebas[0]->cisticercosis_cut_off == ''
    && $prueba->hormonas_pruebas[0]->comentario_cisticercosis == '') {
    $elisa = '';
} else {
    $elisa = '<tr>
                    <td width="50%" colspan="2"><b>ELISA Cisticercosis</b></td>
                    <td width="35%"><b>Valores de Referencia</b></td>
                </tr>';
    if ($prueba->hormonas_pruebas[0]->cisticercosis_resultado != '') {
        $elisa .= '<tr>
                    <td width="25%">Resultado: </td>
                    <td width="25%">' . $prueba->hormonas_pruebas[0]->cisticercosis_resultado . '</td>
                    <td width="35%" style="color: rgb(58,137,159)">Reactivo: Mayor al Cut Off</td>
                </tr>
                <tr>
                    <td width="25%"></td>
                    <td width="25%"></td>
                    <td width="35%" style="color: rgb(58,137,159)">No Reactivo: Menor  al Cut Off</td>
                </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->cisticercosis_cut_off != '') {
        $elisa .= '<tr>
                    <td width="25%">Cut off: </td>
                    <td width="25%">' . $prueba->hormonas_pruebas[0]->cisticercosis_cut_off . '</td>
                    <td width="35%" style="color: rgb(58,137,159)">Dudoso: Igual al Cut Off</td>
                </tr><br>';
    }
    if ($prueba->hormonas_pruebas[0]->comentario_cisticercosis != '') {
        $elisa .= '<tr>
                    <td width="20%">Comentario: </td>
                    <td width="70%" colspan="2">' . nl2br($prueba->hormonas_pruebas[0]->comentario_cisticercosis) . '</td>
                </tr>';
    }
    $elisa .= '<br>';
    array_push($columns, $elisa);
    $contSub++;
}

if ($prueba->hormonas_pruebas[0]->antigeno_carcino == '' && $prueba->hormonas_pruebas[0]->psa_total == ''
&& $prueba->hormonas_pruebas[0]->psa_libre == '' && $prueba->hormonas_pruebas[0]->relacion_psa_libre_total == '') {
$marcadores = '';
} else {
    $marcadores = '<tr>
                        <td width="65%" colspan="2"><b>Marcadores Tumorales</b></td>
                        <td width="35%"><b>Valores de Referencia</b></td>
                    </tr>';
    if ($prueba->hormonas_pruebas[0]->antigeno_carcino != '') {
        $marcadores .= '<tr>
                            <td width="40%">Antígeno carcinoembrionario: </td>
                            <td width="25%">' . $prueba->hormonas_pruebas[0]->antigeno_carcino . ' ng/dl</td>
                            <td width="30%" style="color: rgb(58,137,159)">0 - 3,4 ng/dl</td>
                        </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->psa_total != '') {
        $marcadores .= '<tr>
                            <td width="40%">P S A Total: </td>
                            <td width="25%">' . $prueba->hormonas_pruebas[0]->psa_total . ' ng/ml</td>
                            <td width="30%" style="color: rgb(58,137,159)">< = 4 ng/ml</td>
                        </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->psa_libre != '') {
        $marcadores .= '<tr>
                            <td width="40%">P S A Libre: </td>
                            <td width="25%">' . $prueba->hormonas_pruebas[0]->psa_libre . ' ng/ml</td>
                            <td width="30%" style="color: rgb(58,137,159)">< = 1,3 ng/ml</td>
                        </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->relacion_psa_libre_total != '') {
        $marcadores .= '<tr>
                            <td width="40%">Relación % PSA Libre / PSA Total: </td>
                            <td width="25%">' . $prueba->hormonas_pruebas[0]->relacion_psa_libre_total . ' %</td>
                            <td width="30%" style="color: rgb(58,137,159)">> = 19 %</td>
                        </tr>';
    }
    $marcadores .= '<br>';
    array_push($columns, $marcadores);
    $contSub++;
}

if ($prueba->hormonas_pruebas[0]->estradiol == '' && $prueba->hormonas_pruebas[0]->progesterona == ''
    && $prueba->hormonas_pruebas[0]->fsh == '' && $prueba->hormonas_pruebas[0]->lh == ''
    && $prueba->hormonas_pruebas[0]->prolactina == '' && $prueba->hormonas_pruebas[0]->testosterona == '') {
    $hormonas = '';
} else {
    $hormonas = '<tr>
                    <td width="25%"></td>
                    <td width="30%"></td>
                    <td><b>Valores de Referencia</b></td>
                </tr>';
    if ($prueba->hormonas_pruebas[0]->estradiol != '') {
        $hormonas .= '<tr>
                        <td width="25%"><b>Estadiol</b></td>
                        <td width="30%">' . $prueba->hormonas_pruebas[0]->estradiol . ' pg/ml</td>
                        <td width="40%" style="color: rgb(58,137,159)">Fase folicular 30 - 120 pg/ml</td>
                    </tr>
                    <tr>
                        <td width="25%"></td>
                        <td width="30%"></td>
                        <td width="40%" style="color: rgb(58,137,159)">Fase ovulatoria 130 - 370 pg/ml</td>
                    </tr>
                    <tr>
                        <td width="25%"></td>
                        <td width="30%"></td>
                        <td width="40%" style="color: rgb(58,137,159)">Fase lútea 70 - 250 pg/ml</td>
                    </tr>
                    <tr>
                        <td width="25%"></td>
                        <td width="30%"></td>
                        <td width="40%" style="color: rgb(58,137,159)">Fase menopáusica 15 - 60 pg/ml</td>
                    </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->progesterona != '') {
        $hormonas .= '<tr>
                        <td width="25%"><b>Progesterona</b></td>
                        <td width="30%">' . $prueba->hormonas_pruebas[0]->progesterona . ' ng/ml</td>
                        <td width="40%" style="color: rgb(58,137,159)">Fase Folicular 0,2 - 1,4 ng/ml</td>
                    </tr>
                    <tr>
                        <td width="25%"></td>
                        <td width="30%"></td>
                        <td width="40%" style="color: rgb(58,137,159)">Fase lútea 4 - 25 ng/ml</td>
                    </tr>
                    <tr>
                        <td width="25%"></td>
                        <td width="30%"></td>
                        <td width="40%" style="color: rgb(58,137,159)">Fase menopáusica 0,1 - 1 ng/ml</td>
                    </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->fsh != '') {
        $hormonas .= '<tr>
                        <td width="25%"><b>FSH</b></td>
                        <td width="30%">' . $prueba->hormonas_pruebas[0]->fsh . ' mUI/ml</td>
                        <td width="40%" style="color: rgb(58,137,159)">Mitad del ciclo 8,0 - 22 mUI/ml; Fase folicular 3,0 - 12,0  mUI/ml; Fase lútea 2 - 12  mUI/ml; Postmenopáusica 35 - 151 mUI/ml</td>
                    </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->lh != '') {
        $hormonas .= '<tr>
                        <td width="25%"><b>LH</b></td>
                        <td width="30%">' . $prueba->hormonas_pruebas[0]->lh . ' UI/ml</td>
                        <td width="40%" style="color: rgb(58,137,159)">Fase folicular 0,8 - 10,5 UI/L</td>
                    </tr>
                    <tr>
                        <td width="25%"></td>
                        <td width="30%"></td>
                        <td width="40%" style="color: rgb(58,137,159)">Mitad del ciclo 8,4 - 61,2 UI/L</td>
                    </tr>
                    <tr>
                        <td width="25%"></td>
                        <td width="30%"></td>
                        <td width="40%" style="color: rgb(58,137,159)">Fase luteal 0,8 - 10,5 UI/L</td>
                    </tr>
                    <tr>
                        <td width="25%"></td>
                        <td width="30%"></td>
                        <td width="40%" style="color: rgb(58,137,159)">Postmenopausica  8,2 - 40,8 UI/L</td>
                    </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->prolactina != '') {
        $hormonas .= '<tr>
                        <td width="25%"><b>Prolactina</b></td>
                        <td width="30%">' . $prueba->hormonas_pruebas[0]->prolactina . ' mUI/L</td>
                        <td width="40%" style="color: rgb(58,137,159)">1,8 - 17,0 mUI/L</td>
                    </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->testosterona != '') {
        $hormonas .= '<tr>
                        <td width="25%"><b>Testosterona</b></td>
                        <td width="30%">' . $prueba->hormonas_pruebas[0]->testosterona . ' ngr/ml</td>
                        <td width="40%" style="color: rgb(58,137,159)">2,4 - 12 ngr/ml</td>
                    </tr>';
    }
    $hormonas .= '<br>';
    array_push($columns, $hormonas);
    $contSub++;
}

if ($prueba->hormonas_pruebas[0]->ana == '' && $prueba->hormonas_pruebas[0]->testosterona_control_positivo == ''
    && $prueba->hormonas_pruebas[0]->testosterona_control_negativo == '' && $prueba->hormonas_pruebas[0]->celulas_le == ''
    && $prueba->hormonas_pruebas[0]->celulas_le_control_positivo == '' && $prueba->hormonas_pruebas[0]->celulas_le_control_negativo == '') {
    $ana = '';
} else {
    $ana = '<tr>
                <td width="25%"></td>
                <td width="30%"></td>
                <td width="40%"><b>Valores de Referencia</b></td>
            </tr>';
    if ($prueba->hormonas_pruebas[0]->ana != '') {
        $ana .= '<tr>
                    <td width="25%"><b>ANA: </b></td>
                    <td width="30%">' . $prueba->hormonas_pruebas[0]->ana . ' U/ml</td>
                    <td width="40%" style="color: rgb(58,137,159)">Hasta 10 U/ml</td>
                </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->ana_control_positivo != '') {
        $ana .= '<tr>
                    <td width="25%">Control positivo: </td>
                    <td width="30%">' . $prueba->hormonas_pruebas[0]->ana_control_positivo . ' U/ml</td>
                    <td width="40%" style="color: rgb(58,137,159)"></td>
                </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->ana_control_negativo != '') {
        $ana .= '<tr>
                    <td width="25%">Control negativo: </td>
                    <td width="30%">' . $prueba->hormonas_pruebas[0]->ana_control_negativo . ' U/ml</td>
                    <td width="40%" style="color: rgb(58,137,159)"></td>
                </tr><br>';
    }
    if ($prueba->hormonas_pruebas[0]->celulas_le != '') {
        $ana .= '<tr>
                        <td width="25%"><b>Células L E: </b></td>
                        <td width="30%">' . $prueba->hormonas_pruebas[0]->celulas_le . ' U/ml</td>
                        <td width="40%" style="color: rgb(58,137,159)">Hasta 10 U/ml</td>
                    </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->celulas_le_control_positivo != '') {
        $ana .= '<tr>
                    <td width="25%">Control positivo: </td>
                    <td width="30%">' . $prueba->hormonas_pruebas[0]->celulas_le_control_positivo . ' U/ml</td>
                    <td width="40%" style="color: rgb(58,137,159)"></td>
                </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->celulas_le_control_negativo != '') {
        $ana .= '<tr>
                    <td width="25%">Contro negativo: </td>
                    <td width="30%">' . $prueba->hormonas_pruebas[0]->celulas_le_control_negativo . ' U/ml</td>
                    <td width="40%" style="color: rgb(58,137,159)"></td>
                </tr>';
    }
    $ana .= '<br>';
    array_push($columns, $ana);
    $contSub++;
}

if ($prueba->hormonas_pruebas[0]->anticuerpos_resultado == '' && $prueba->hormonas_pruebas[0]->anticuerpos_cut_off == ''
    && $prueba->hormonas_pruebas[0]->comentario_anticuerpos == '' && $prueba->hormonas_pruebas[0]->toxoplasmosis_lgm == ''
    && $prueba->hormonas_pruebas[0]->toxoplasmosis_lgg == '' && $prueba->hormonas_pruebas[0]->b_hcg_cuantitativo == '') {
    $aapcc = '';
} else {
    $aapcc = '<tr>
                <td width="62%" colspan="3"><b>Anticuerpos Anti-peptido ciclico de la Citrulina</b></td>
                <td width="40%"><b>Valores de referencia</b></td>
            </tr>';
    if ($prueba->hormonas_pruebas[0]->anticuerpos_resultado != '') {
        $aapcc .= '<tr>
                    <td width="30%">Resultado: </td>
                    <td width="32%">' . $prueba->hormonas_pruebas[0]->anticuerpos_resultado . '</td>
                    <td width="40%" style="color: rgb(58,137,159)">Reactivo: Mayor al Cut Off</td>
                </tr>
                <tr>
                    <td width="30%"></td>
                    <td width="32%"></td>
                    <td width="40%" style="color: rgb(58,137,159)">No Reactivo: Menor  al Cut Off</td>
                </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->anticuerpos_cut_off != '') {
        $aapcc .= '<tr>
                    <td width="30%">Cut off: </td>
                    <td width="32%">' . $prueba->hormonas_pruebas[0]->anticuerpos_cut_off . '</td>
                    <td width="40%" style="color: rgb(58,137,159)">Dudoso: Igual al Cut Off</td>
                </tr><br>';
    }
    if ($prueba->hormonas_pruebas[0]->comentario_anticuerpos != '') {
        $aapcc .= '<tr>
                    <td width="20%">Comentario: </td>
                    <td width="72%" colspan="2">' . nl2br($prueba->hormonas_pruebas[0]->comentario_anticuerpos) . '</td>
                    <td></td>
                </tr><br>';
    }
    if ($prueba->hormonas_pruebas[0]->toxoplasmosis_lgm != '') {
        $aapcc .= '<tr>
                    <td width="30%">Toxoplasmosis Ig M: </td>
                    <td width="32%">' . $prueba->hormonas_pruebas[0]->toxoplasmosis_lgm . ' mlUI/l</td>
                    <td width="40%" style="color: rgb(58,137,159)">< = 1,1</td>
                </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->toxoplasmosis_lgg != '') {
        $aapcc .= '<tr>
                    <td width="30%">Toxoplasmosis Ig G: </td>
                    <td width="32%">' . $prueba->hormonas_pruebas[0]->toxoplasmosis_lgg . ' UI/ml</td>
                    <td width="40%" style="color: rgb(58,137,159)">< = 50 UI/ml</td>
                </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->b_hcg_cuantitativo != '') {
        $aapcc .= '<tr>
                    <br>
                    <td width="30%">B- HCG Cuantitativo: </td>
                    <td width="32%">' . $prueba->hormonas_pruebas[0]->b_hcg_cuantitativo . ' mUI/ml</td>
                    <td width="40%" style="color: rgb(58,137,159)">1ra. Semana 10 - 30 mUI/ml</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="color: rgb(58,137,159)">2da. Semana 30 - 100 mUI/ml</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="color: rgb(58,137,159)">3ra. Semana 48 - 346 mUI/ml</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="color: rgb(58,137,159)">4ra. Semana 268 - 1.073 mUI/mll</td>
                </tr>';
    }
    $aapcc .= '<br>';
    array_push($columns, $aapcc);
    $contSub++;
}

if ($prueba->hormonas_pruebas[0]->anti_nucleares == '' && $prueba->hormonas_pruebas[0]->anticuerpos_control_positivo == ''
    && $prueba->hormonas_pruebas[0]->anticuerpos_control_negativo == '' && $prueba->hormonas_pruebas[0]->celulas_hep == ''
    && $prueba->hormonas_pruebas[0]->control_positivo == '' && $prueba->hormonas_pruebas[0]->control_negativo == ''
    && $prueba->hormonas_pruebas[0]->conclusion == '' && $prueba->hormonas_pruebas[0]->comentario_general == '') {
    $anach2 = '';
} else {
    $anach2 = '<tr>
                    <td width="62%" colspan="2"><b>Anticuerpos Anti-Nucleares. ANA (Celulas Hep- 2)</b></td>
                    <td width="40%"><b>Valores de Referencia</b></td>
                </tr>';
    if ($prueba->hormonas_pruebas[0]->anti_nucleares != '') {
        $anach2 .= '<tr>
                        <td width="35%">Anticuerpos Anti-Nucleares: </td>
                        <td width="27%">' . $prueba->hormonas_pruebas[0]->anti_nucleares . ' U/ml</td>
                        <td width="40%" style="color: rgb(58,137,159)">Reactivo: Mayor a 10 U/ml</td>
                    </tr>
                    <tr>
                        <td width="35%"></td>
                        <td width="27%"></td>
                        <td width="40%" style="color: rgb(58,137,159)">No Reactivo: Menor a 10 U/ml</td>
                    </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->anticuerpos_control_positivo != '') {
        $anach2 .= '<tr>
                        <td width="35%">Control positivo: </td>
                        <td width="27%">' . $prueba->hormonas_pruebas[0]->anticuerpos_control_positivo . ' U/ml</td>
                        <td width="40%"></td>
                    </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->anticuerpos_control_negativo != '') {
        $anach2 .= '<tr>
                        <td width="35%">Control negativo: </td>
                        <td width="27%">' . $prueba->hormonas_pruebas[0]->anticuerpos_control_negativo . ' U/ml</td>
                        <td width="40%"></td>
                    </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->celulas_hep != '') {
        $anach2 .= '<br><tr>
                        <td width="35%">Células Hep - 2: </td>
                        <td width="27%">' . $prueba->hormonas_pruebas[0]->celulas_hep . ' U/ml</td>
                        <td width="40%"></td>
                    </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->control_positivo != '') {
        $anach2 .= '<tr>
                        <td width="35%">Control positivo: </td>
                        <td width="27%">' . $prueba->hormonas_pruebas[0]->control_positivo . ' U/ml</td>
                        <td width="40%"></td>
                    </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->control_negativo != '') {
        $anach2 .= '<tr>
                        <td width="35%">Control negativo: </td>
                        <td width="27%">' . $prueba->hormonas_pruebas[0]->control_negativo . ' U/ml</td>
                        <td width="40%"></td>
                    </tr>';
    }
    if ($prueba->hormonas_pruebas[0]->conclusion != '') {
        $anach2 .= '<br><tr>
                    <td width="20%">Conclusión: </td>
                    <td width="72%" colspan="2">' . nl2br($prueba->hormonas_pruebas[0]->conclusion) . '</td>
                </tr><br>';
    }
    if ($prueba->hormonas_pruebas[0]->comentario_general != '') {
        $anach2 .= '<tr>
                        <td width="20%">Comentario: </td>
                        <td width="72%" colspan="2">' . nl2br($prueba->hormonas_pruebas[0]->comentario_general) . '</td>
                    </tr>';
    }
    $anach2 .= '<br>';
    array_push($columns, $anach2);
    $contSub++;
}

if ($contSub == 1) {
    $tabla_elemento = '';
    $tabla_elemento = '<table>' . $dosificacion . $elisa . $marcadores . $hormonas . $ana . $aapcc . $anach2 . '</table>';
    $pdf->writeHTMLCell($w=130, $h=0, $x='57', $y='40', $tabla_elemento, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

    $laboratorio = '';
    $laboratorio = '<br><p style="color: rgb(58,137,159)">' . $prueba->hormonas_pruebas[0]->laboratorio . '</p>';
    $pdf->writeHTMLCell($w=185, $h=0, $x='', $y='', $laboratorio, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);
    
}

$pdf->SetFont('helvetica','',7);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA</b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='115', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$nombre = Text::slug(date('Y-m-d h-i-s') . '-' . 'hormonas-' .  $prueba->paciente->nombre . '-' .  $prueba->paciente->apellidos);
$pdf->Output($nombre . '.pdf', 'I');

?>
