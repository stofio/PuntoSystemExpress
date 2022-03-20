<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/vendor/autoload.php';

class MY2PDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = $_SERVER['DOCUMENT_ROOT'] . '/media/logo.png';
        $this->Image($image_file, 11, 5, 42, '', 'PNG', '', 'T', false, 400, '', false, false, 0, false, false, false);
        // Set font
        $montserrat = TCPDF_FONTS::addTTFfont($_SERVER['DOCUMENT_ROOT'] . '/fonts/Montserrat-VariableFont_wght.ttf', 'TrueTypeUnicode', '', 96);
        $this->SetFont($montserrat, '', 11);
        
        // Title
       // $header_title = "Punto System Express";
        //$this->writeHTMLCell(0, 0, 60, 11, $header_title, 0, 1, 0, true, 'C', true);
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $montserrat = TCPDF_FONTS::addTTFfont($_SERVER['DOCUMENT_ROOT'] . '/fonts/Montserrat-VariableFont_wght.ttf', 'TrueTypeUnicode', '', 96);
        // Page number
        $this->Cell(0, 10, 'Copyrights © Punto System All Rights Reserved', 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf1 = new MY2PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


// set document information
$pdf1->SetCreator('Dejan');
$pdf1->SetAuthor('Nicholas');
$pdf1->SetTitle('Shipping Recap');
$pdf1->SetSubject('Punto System Express');


// set default header data
$pdf1->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));


// set header and footer fonts
$montserrat = TCPDF_FONTS::addTTFfont($_SERVER['DOCUMENT_ROOT'] . '/fonts/Montserrat-VariableFont_wght.ttf', 'TrueTypeUnicode', '', 96);
$pdf1->setHeaderFont(Array($montserrat, '', '11'));

// set default monospaced font
$pdf1->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf1->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf1->SetHeaderMargin(PDF_MARGIN_HEADER);

// set auto page breaks
$pdf1->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf1->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------

// set default font subsetting mode
$pdf1->setFontSubsetting(true);



//============================================================+
// PAGE 1
//============================================================+

// Add a page
$pdf1->AddPage();



// Set some content to print
$page1 = <<<EOD
<style>
p {
    line-height: 5px;
}
</style>

<br>
<h3 style="text-align:center"><b>ORDER CONFIRMATION FOR SHIPPING ID #{$array_termin['id']}</b></h3>

</br>
<h4><b>REQUEST</b></h4>
</br>
<p><b>From</b> {$array_termin['from_place']}, {$array_termin['loading_point']}</p>
<p><b>To</b> {$array_termin['to_place']}, {$array_termin['discharge_point']}</p>
<p><b>Available</b> {$array_termin['from_time']}</p>
<p><b>Delivered</b> {$array_termin['to_time']}</p>

</br>
</br>
<h4><b>OFFER</b></h4>
</br>
<p><b>Goods Collection</b> {$array_termin['collect_time']}</p>
<p><b>Goods Delivery</b> {$array_termin['deliver_time']}</p>
<p><b>Offer</b> {$array_termin['price']} €</p>
<p><b>Offer (Mark-up)</b> {$priceCommission} €</p>


EOD;
// Print text using writeHTMLCell()
$pdf1->writeHTMLCell(0, 0, '', '', $page1, 0, 1, 0, true, '', true);




// Close and output PDF document

$PdfName = "admin-" . $array_termin['id'] . "-pdf.pdf";

//$pdf1->Output('', 'I');
$pdf1->Output($_SERVER['DOCUMENT_ROOT'] . '/pdfSaved/'. $PdfName, 'F');


//============================================================+
// END OF FILE
//============================================================+
?>