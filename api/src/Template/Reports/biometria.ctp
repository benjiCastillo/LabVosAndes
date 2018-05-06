<?php

use App\Utils\Pdf;
use Cake\Utility\Text;
use App\Utils\CompanyInfo;

set_time_limit(3600);

$title = 'Exámen Biometría Hemática';
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
$title = '<p><b>BIOMETRÍA HEMÁTICA</b></p>';
$pdf->writeHTML($title, true, false, true, false, 'C');
$pdf->Ln(1);

$tabla1 = '<table>
                <tr>
                    <td colspan="3"><b>Hematimetría 3600 m.s.n.m.</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Hematíes: </td>
                    <td>' . $prueba->biometria_pruebas[0]->hematies . '</td>
                    <td width="165" style="color: rgb(58,137,159)">H: 5`2 - 5`6; M: 5`2 - 5`4</td>
                </tr>
                <tr>
                    <td>Hematocrito: </td>
                    <td>' . $prueba->biometria_pruebas[0]->hematocrito . '</td>
                    <td style="color: rgb(58,137,159)">H: 49 - 53; M: 47 - 51 </td>
                </tr>
                <tr>
                    <td>Hemoglobina: </td>
                    <td>' . $prueba->biometria_pruebas[0]->hemoglobina . '</td>
                    <td style="color: rgb(58,137,159)">H: 16 +/- 1,5; M: 15 +/- 0,5</td>
                </tr>
                <tr>
                    <td>Leucocito: </td>
                    <td>' . $prueba->biometria_pruebas[0]->leucocitos . '</td>
                    <td style="color: rgb(58,137,159)">5,000 - 8,000 </td>
                </tr>
                <tr>
                    <td>V. S. G.: </td>
                    <td>' . $prueba->biometria_pruebas[0]->vsg . '</td>
                    <td style="color: rgb(58,137,159)">1 - 10</td>
                </tr>
                <tr>
                    <br>
                    <td colspan="3"><b>Índices Hematimétricos</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>V. C. M.: </td>
                    <td>' . $prueba->biometria_pruebas[0]->vcm . '</td>
                    <td style="color: rgb(58,137,159)">90 +/- 8</td>
                </tr>
                <tr>
                    <td>Hb. C. M.: </td>
                    <td>'. $prueba->biometria_pruebas[0]->hbcm . '</td>
                    <td style="color: rgb(58,137,159)">30 +/- 3</td>
                </tr>
                <tr>
                    <td>C. Hb. C. M.: </td>
                    <td>'. $prueba->biometria_pruebas[0]->chbcm . '</td>
                    <td style="color: rgb(58,137,159)">34 +/- 2</td>
                </tr>
</table><br>';

if( $prueba->biometria_pruebas[0]->comentario_hema != '' ){
    $comentario_hema = '<table>
    <tr>
        <td><b>Comentario</b></td>
    </tr>
    <tr>
        <td><p>' . $prueba->biometria_pruebas[0]->comentario_hema . '</p></td>
    </tr>
</table>';
}
else{
    $comentario_hema = '';
}

$tabla2 = '<table>
                <tr>
                    <td colspan="3"><b>Leucograma</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="110">Cayados: </td>
                    <td width="110">' . $prueba->biometria_pruebas[0]->cayados . '</td>
                    <td width="50" style="color: rgb(58,137,159)">1 - 5 %</td>
                </tr>
                <tr>
                    <td>Neutrófilos: </td>
                    <td>' . $prueba->biometria_pruebas[0]->neutrofilos . '</td>
                    <td style="color: rgb(58,137,159)">50 - 70 %</td>
                </tr>
                <tr>
                    <td>Basófilo: </td>
                    <td>' . $prueba->biometria_pruebas[0]->basofilo .'</td>
                    <td style="color: rgb(58,137,159)">0 - 1 %</td>
                </tr>
                <tr>
                    <td>Eosinófilo: </td>
                    <td>' . $prueba->biometria_pruebas[0]->eosinofilo . '</td>
                    <td style="color: rgb(58,137,159)">1 - 3 %</td>
                </tr>
                <tr>
                    <td>Linfocito: </td>
                    <td>' . $prueba->biometria_pruebas[0]->linfocito . '</td>
                    <td style="color: rgb(58,137,159)">25 - 35 %</td>
                </tr>
                <tr>
                    <td>Monocito: </td>
                    <td>' . $prueba->biometria_pruebas[0]->monocito . '</td>
                    <td style="color: rgb(58,137,159)">4 - 8 %</td>
                </tr>
                <tr>
                    <td>Pro linfocito: </td>
                    <td>' . $prueba->biometria_pruebas[0]->prolinfocito . '</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Cel. Inmaduras: </td>
                    <td>' . $prueba->biometria_pruebas[0]->cel_inmaduras . '</td>
                    <td></td>
                </tr>
</table><br>';

if( $prueba->biometria_pruebas[0]->comentario_leuco != ''){
    $comentario_leuco = '<table>
    <tr>
        <td><b>Comentario</b></td>
    </tr>
    <tr>
        <td><p>' . $prueba->biometria_pruebas[0]->comentario_leuco . '</p></td>
    </tr>
</table>';
} else {
    $comentario_leuco = '';
}

$pdf->writeHTMLCell($w=150, $h=0, $x='12', $y='42', $tabla1, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

if($comentario_hema != ''){
    $pdf->writeHTMLCell($w=100, $h=0, $x='12', $y='', $comentario_hema, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);
}

$pdf->writeHTMLCell($w=150, $h=0, $x='120', $y='42', $tabla2, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

if($comentario_leuco != ''){
    $pdf->writeHTMLCell($w=85, $h=0, $x='120', $y='', $comentario_leuco, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);
}

$pdf->SetFont('helvetica','',7);
$firm = '<div style="line-height: 12px;"><b>Dra. María Luz Nina Colque<br>
            BIOQUÍMICA - FARMACÉUTICA</b>
        </div>';
$pdf->writeHTMLCell($w=0, $h=0, $x='145', $y='122', $firm, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);

$nombre = Text::slug('biometria-' .  $prueba->paciente->nombre . '-' .  $prueba->paciente->apellidos);
$pdf->Output($nombre . '.pdf', 'I');

?>
