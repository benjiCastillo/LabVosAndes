<?php

use App\Utils\Pdf;
use Cake\Utility\Inflector;
use App\Utils\Constants;

$months = [
    1 => 'Enero',
    2 => 'Febrero',
    3 => 'Marzo',
    4 => 'Abril',
    5 => 'Mayo',
    6 => 'Junio',
    7 => 'Julio',
    8 => 'Agosto',
    9 => 'Septiembre',
    10 => 'Octubre',
    11 => 'Noviembre',
    12 => 'Diciembre'
];

$styleQR = array(
    'border' => 1,
    'vpadding' => 2,
    'hpadding' => 2,
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => false,
    'module_width' => 1,
    'module_height' => 1
);
$text_qr = $movement->receipt_number . '|'
    . $movement->payment_document . '|'
    . $movement->payment_sender . '|'
    . $movement->execution_date->format('d/m/Y H:i') . '|'
    . mb_strtoupper(Constants::getPaymentMethods()[$movement->method_payment]) . '|'
    . $movement->activity->account->name . '|'
    . $movement->activity->name . '|'
    . $movement->amount;

set_time_limit(3600);

$pdf = new Pdf('Recibo: ' . $movement->activity->name . ' Nº' . $movement->receipt_number);

$pdf->setAutoPageBreak(false);
$pdf->SetFillColor(230, 230, 230);

$pdf->AddPage();

// $pdf->SetAlpha(0.25);
// $pdf->Image(WWW_ROOT . 'img/logo.png', 50, 65, 114);
// $pdf->SetAlpha(1);

// $pdf->Image(WWW_ROOT . 'img/logo_25anios.png', 19, 7, 33);
// $pdf->SetY(35);
// $pdf->SetFont('dejavusans', 'B', 7);
// $pdf->MultiCell(50, 8, 'COLEGIO DE INGENIEROS CIVILES DE CHUQUISACA', 0, 'C', 0, 1, '', '', 1, '', '', '', 8, 'M');

$pdf->SetY(20);
$pdf->SetFont('dejavusans', 'B', 13);
$pdf->MultiCell('', 8, 'RECIBO DE INGRESO', 0, 'C', 0, 1, '', '', 1, '', '', '', 9, 'M');
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->MultiCell('', 5, 'Cuenta ' . $movement->activity->account->code_name, 0, 'C', 0, 1, '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell('', 5, 'Actividad ' . $movement->activity->code_name, 0, 'C', 0, 1, '', '', 1, '', '', '', 5, 'M');

$pdf->SetY(22);
$pdf->SetFont('dejavusans', 'B', 12);
$pdf->MultiCell('', 8, 'Nº ' . str_pad($movement->receipt_number, 6, '0', STR_PAD_LEFT), 0, 'C', 0, 1, 173, '', 1, '', '', '', 9, 'M');
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->MultiCell('', 4, 'ORIGINAL', 1, 'C', 1, 1, 173, '', 1, '', '', '', 4, 'M');
$pdf->SetFont('dejavusans', 'B', 8);

$pdf->SetY(45);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->MultiCell(20, 5, 'RCIC-CH', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(20, 5, 'RNI', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(85, 5, 'NOMBRE DE AFILIADA/AFILIADO', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(35, 5, 'FORMA DE PAGO', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(35, 5, 'FECHA DE PAGO', 1, 'C', 1, 1, '', '', 1, '', '', '', 5, 'M');
$pdf->SetFont('dejavusans', '', 9);
$pdf->MultiCell(20, 6, $movement->dues[0]->member->rcic_ch, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(20, 6, $movement->dues[0]->member->rni, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(85, 6, $movement->dues[0]->member->fullname, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(35, 6, Constants::getPaymentMethods()[$movement->method_payment], 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(35, 6, $movement->execution_date->format('d/m/Y H:i'), 1, 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');

$pdf->SetY(60);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->MultiCell(125, 5, 'DETALLE', 1, 'L', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(35, 5, 'PERIODO', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(35, 5, 'IMPORTE', 1, 'C', 1, 1, '', '', 1, '', '', '', 5, 'M');
$pdf->SetFont('dejavusans', '', 9);
$pdf->MultiCell(125, 20, '', 1, 'L', 0, '', '', '', 1, '', '', '', 20, 'T');

$pdf->SetY(65);
$pdf->MultiCell(125, 20, $movement->detail, 1, 'L', 0, '', '', '', 1, '', '', '', 20, 'T');
$pdf->MultiCell(35, 20, "Del " . $movement->dues[0]->paid_from . "\nal " . $movement->dues[0]->paid_to, 1, 'C', 0, '', '', '', 1, '', '', '', 20, 'T');
$total_amount = number_format($movement->amount + $movement->discount, 2, ',', '.');
if (!empty($movement->discount)) {
     $total_amount .= "\n-" . number_format($movement->discount, 2, ',', '.');
}
$pdf->MultiCell(35, 20, $total_amount, 1, 'R', 0, 1, '', '', 1, '', '', '', 20, 'T');

$pdf->SetY(80);
$pdf->SetFont('dejavusans', '', 7);
if (!empty($movement->observation)) {
    $pdf->MultiCell(125, 10, "- Observación: " . $movement->observation, 0, 'L', 0, 1, '', '', 1, '', '', '', 10, 'T');
} else {
    $pdf->SetY(85);
}
$pdf->SetFont('dejavusans', 'B', 9);
$pdf->MultiCell(160, 6, 'Son: ' . $this->NumberToLetter->to_word(floor($movement->amount)) . 'con ' . str_pad(number_format(($movement->amount - intval($movement->amount)) * 100, 0), 2, '0', STR_PAD_LEFT) . '/100 Bolivianos', 1, 'L', 0, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(35, 6, number_format($movement->amount, 2, ',', '.'), 1, 'R', 0, 1, '', '', 1, '', '', '', 6, 'M');

$pdf->SetY(115);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->MultiCell(50, 4, 'RECIBÍ CONFORME', 'T', 'C', 0, '', 30, '', 1, '', '', '', 4, 'M');
$pdf->MultiCell(50, 4, 'ENTREGUÉ CONFORME', 'T', 'C', 0, 1, 105, '', 1, '', '', '', 4, 'M');
$pdf->MultiCell(70, 4, $this->request->session()->read('Auth.User.name'), '', 'C', 0, 0, 20, '', 1, '', '', '', 4, 'M');
$pdf->MultiCell(70, 4, $movement->payment_sender, '', 'C', 0, 1, 95, '', 1, '', '', '', 4, 'M');
$pdf->MultiCell(50, 4, 'CI: ' . $this->request->session()->read('Auth.User.document'), '', 'C', 0, '', 30, '', 1, '', '', '', 4, 'M');
$pdf->MultiCell(50, 4, 'CI: ' . $movement->payment_document, '', 'C', 0, 1, 105, '', 1, '', '', '', 4, 'M');

$pdf->write2DBarcode($text_qr, 'QRCODE,M', 177, 98, 28, 28, $styleQR, 'N');

// $pdf->SetY(130);
// $pdf->SetFont('dejavusans', 'B', 7);
// $pdf->MultiCell('', 4, 'Calle Destacamento 111 Nº192 | Telf. (4) 6425620 | info@cicchuquisaca.org | http://www.cicchuquisaca.org | Sucre - Bolivia', 'T', 'C', 0, 1, '', '', 1, '', '', '', 4, 'M');

// Copia
// $pdf->SetAlpha(0.25);
// $pdf->Image(WWW_ROOT . 'img/logo.png', 82, 175, 50);
// $pdf->SetAlpha(1);
// $pdf->SetY(140);
// $pdf->MultiCell('', 4, '', 'T', 1);
// $pdf->Image(WWW_ROOT . 'img/logo.png', 24, 147, 22);
// $pdf->Image(WWW_ROOT . 'img/logo_25anios.png', 19, 147, 33);
// $pdf->SetY(175);
// $pdf->SetFont('dejavusans', 'B', 7);
// $pdf->MultiCell(50, 8, 'COLEGIO DE INGENIEROS CIVILES DE CHUQUISACA', 0, 'C', 0, 1, '', '', 1, '', '', '', 8, 'M');

$pdf->SetY(160);
$pdf->SetFont('dejavusans', 'B', 13);
$pdf->MultiCell('', 8, 'RECIBO DE INGRESO', 0, 'C', 0, 1, '', '', 1, '', '', '', 9, 'M');
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->MultiCell('', 5, 'Cuenta ' . $movement->activity->account->code_name, 0, 'C', 0, 1, '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell('', 5, 'Actividad ' . $movement->activity->code_name, 0, 'C', 0, 1, '', '', 1, '', '', '', 5, 'M');

$pdf->SetY(162);
$pdf->SetFont('dejavusans', 'B', 12);
$pdf->MultiCell('', 8, 'Nº ' . str_pad($movement->receipt_number, 6, '0', STR_PAD_LEFT), 0, 'C', 0, 1, 173, '', 1, '', '', '', 9, 'M');
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->MultiCell('', 4, 'COPIA', 1, 'C', 1, 1, 173, '', 1, '', '', '', 4, 'M');
$pdf->SetFont('dejavusans', 'B', 8);

$pdf->SetY(185);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->MultiCell(20, 5, 'RCIC-CH', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(20, 5, 'RNI', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(85, 5, 'NOMBRE DE AFILIADA/AFILIADO', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(35, 5, 'FORMA DE PAGO', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(35, 5, 'FECHA DE PAGO', 1, 'C', 1, 1, '', '', 1, '', '', '', 5, 'M');
$pdf->SetFont('dejavusans', '', 9);
$pdf->MultiCell(20, 6, $movement->dues[0]->member->rcic_ch, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(20, 6, $movement->dues[0]->member->rni, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(85, 6, $movement->dues[0]->member->fullname, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(35, 6, Constants::getPaymentMethods()[$movement->method_payment], 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(35, 6, $movement->execution_date->format('d/m/Y H:i'), 1, 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');

$pdf->SetY(200);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->MultiCell(125, 5, 'DETALLE', 1, 'L', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(35, 5, 'PERIODO', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(35, 5, 'IMPORTE', 1, 'C', 1, 1, '', '', 1, '', '', '', 5, 'M');
$pdf->SetFont('dejavusans', '', 9);
$pdf->MultiCell(125, 20, '', 1, 'L', 0, '', '', '', 1, '', '', '', 20, 'T');

$pdf->SetY(205);
$pdf->MultiCell(125, 20, $movement->detail, 1, 'L', 0, '', '', '', 1, '', '', '', 20, 'T');
$pdf->MultiCell(35, 20, "Del " . $movement->dues[0]->paid_from . "\nal " . $movement->dues[0]->paid_to, 1, 'C', 0, '', '', '', 1, '', '', '', 20, 'T');
$total_amount = number_format($movement->amount + $movement->discount, 2, ',', '.');
if (!empty($movement->discount)) {
     $total_amount .= "\n-" . number_format($movement->discount, 2, ',', '.');
}
$pdf->MultiCell(35, 20, $total_amount, 1, 'R', 0, 1, '', '', 1, '', '', '', 20, 'T');

$pdf->SetY(220);
$pdf->SetFont('dejavusans', '', 7);
if (!empty($movement->observation)) {
    $pdf->MultiCell(125, 10, "- Observación: " . $movement->observation, 0, 'L', 0, 1, '', '', 1, '', '', '', 10, 'T');
} else {
    $pdf->SetY(225);
}
$pdf->SetFont('dejavusans', 'B', 9);
$pdf->MultiCell(160, 6, 'Son: ' . $this->NumberToLetter->to_word(floor($movement->amount)) . 'con ' . str_pad(number_format(($movement->amount - intval($movement->amount)) * 100, 0), 2, '0', STR_PAD_LEFT) . '/100 Bolivianos', 1, 'L', 0, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(35, 6, number_format($movement->amount, 2, ',', '.'), 1, 'R', 0, 1, '', '', 1, '', '', '', 6, 'M');

$pdf->SetY(255);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->MultiCell(50, 4, 'RECIBÍ CONFORME', 'T', 'C', 0, '', 30, '', 1, '', '', '', 4, 'M');
$pdf->MultiCell(50, 4, 'ENTREGUÉ CONFORME', 'T', 'C', 0, 1, 105, '', 1, '', '', '', 4, 'M');
$pdf->MultiCell(70, 4, $this->request->session()->read('Auth.User.name'), '', 'C', 0, 0, 20, '', 1, '', '', '', 4, 'M');
$pdf->MultiCell(70, 4, $movement->payment_sender, '', 'C', 0, 1, 95, '', 1, '', '', '', 4, 'M');
$pdf->MultiCell(50, 4, 'CI: ' . $this->request->session()->read('Auth.User.document'), '', 'C', 0, '', 30, '', 1, '', '', '', 4, 'M');
$pdf->MultiCell(50, 4, 'CI: ' . $movement->payment_document, '', 'C', 0, 1, 105, '', 1, '', '', '', 4, 'M');

$pdf->write2DBarcode($text_qr, 'QRCODE,M', 177, 238, 28, 28, $styleQR, 'N');

if($print == 'Y') {
    $script = "print();";
    $pdf->IncludeJS($script);
}
$pdf->Output('recibo-' .  Inflector::slug(mb_strtolower($movement->activity->name)) . '_' . $movement->receipt_number . '.pdf', 'I');
