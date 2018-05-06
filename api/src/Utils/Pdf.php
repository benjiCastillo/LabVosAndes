<?php

namespace App\Utils;

use TCPDF;

// require_once(ROOT . DS . 'vendor' . DS . 'tecnickcom' . DS . 'tcpdf' . DS . 'tcpdf.php');

/**
 * Constants
 * @author Lucio Marcelo Quispe Ortega <marceloquispeortega@gmail.com>
 */
class Pdf extends TCPDF
{
    private $subtitle;
    private $username;

    public function __construct($title, $subtitle = '', $username = '', $orientation = 'P', $print_header = false, $print_footer = false, $format = array(215, 279))
    {
        parent::__construct($orientation, 'mm', $format, true, 'utf-8', false);

        $this->SetTitle($title);
        $this->subtitle = $subtitle;
        $this->username = $username;
        $this->SetCreator(PDF_CREATOR);
        $this->SetAuthor('RootCode');
        $this->SetKeywords('Affiliations');

        $this->SetPrintHeader($print_header);
        $this->SetPrintFooter($print_footer);

        //cambiar margenes
        $this->SetMargins(10, 10, 10, 10);

        //set auto page breaks
        $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $this->startPageGroup();

        //set image scale factor
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $this->setJPEGQuality(100);
    }

    public function Header()
    {
        if ($this->getPage() == 1 || $this->getGroupPageNo() == 1) {
            $this->SetFillColor(230, 230, 230);
            $this->RoundedRect(10, 6, $this->getPageWidth() - 20, 30, 2.50, '1111');

            $this->Image(WWW_ROOT . 'img/logo.png', 26, 7, 16);
            $this->SetY(28);
            $this->SetFont('dejavusans', 'B', 7);
            $this->MultiCell(50, 8, 'COLEGIO DE INGENIEROS CIVILES DE CHUQUISACA', '', 'C', 0, 1, '', '', 1, '', '', '', 8, 'M');

            $this->SetY(14);
            $this->SetFont('dejavusans', 'B', 13);
            $this->MultiCell('', 8, $this->title, 0, 'C', 0, 1, '', '', 1, '', '', '', 9, 'M');
            $this->SetFont('dejavusans', 'B', 10);
            $this->MultiCell('', 5, $this->subtitle, 0, 'C', 0, 1, '', '', 1, '', '', '', 5, 'M');

            $this->SetY(13);
            $this->SetFont('dejavusans', 'B', 7);
            $this->MultiCell(30, 4, 'Usuario', 0, 'C', 0, 1, $this->getPageWidth() - 45, '', 1, '', '', '', 4, 'M');
            $this->SetFont('dejavusans', '', 7);
            $this->MultiCell(30, 4, $this->username, 0, 'C', 0, 1, $this->getPageWidth() - 45, '', 1, '', '', '', 4, 'M');
            $this->SetFont('dejavusans', 'B', 7);
            $this->SetY($this->GetY() + 1);
            $this->MultiCell(30, 4, 'Fecha de Emisión', 0, 'C', '', 1, $this->getPageWidth() - 45, '', 1, '', '', '', 4, 'M');
            $this->SetFont('dejavusans', '', 7);
            $this->MultiCell(30, 4, date('d/m/Y H:i:s'), 0, 'C', '', '', $this->getPageWidth() - 45, '', 1, '', '', '', 4, 'M');
        } else {
            $this->SetY(5);
            $this->SetFont('dejavusans', '', 8);
            $this->MultiCell(100, 4, $this->title, 'B', 'L', '', '', '', '', 1, '', '', '', 4, 'M');
            $this->SetFont('dejavusans', '', 7);
            $this->MultiCell('', 4, $this->subtitle, 'B', 'R', '', 1, '', '', 1, '', '', '', 4, 'M');
        }
    }

    public function Footer()
    {
        $this->SetY(-10);
        $this->SetFont('dejavusans', 'B', 7);
        $this->MultiCell(130, 4, 'Colegio de Ingenierios Civiles de Chuquisaca', 'T', 'L', '', '', '', '', 1, '', '', '', 4, 'M');
        $this->MultiCell('', 4, 'Página ' . $this->getGroupPageNo() . ' de ' . $this->getPageGroupAlias(), 'T', 'R', '', 1, '', '', 1, '', '', '', 4, 'M');
    }

}
