<?php
// para utilizar la librería
define('FPDF_FONTPATH','font/');
require_once('fpdf.php');

//Creación del objeto de la clase heredada
$pdf=new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage();

//Comenzamos a escribir el PDF:
$pdf->SetFont('Arial','B',20); //<-- Tipo de letra arial, Bold, tamaño 20
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',14);
$pdf->SetY(50);
$pdf->SetX(0);
$pdf->MultiCell(120,6,"Listado de Facturas",0,C,0);
$header=array('Codigo','Cliente','Fecha','F. Cobro','Neto','Tipo IVA','IVA','Total');
 for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',1);
    $pdf->Ln();
$pdf->SetFillColor(200,200,200);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',10);
    $acotado="pdf";
$pdf->Cell($w[0],5,$acotado,'LRTB',0,'C');	
$pdf->write(8,"Hola");  // <-- Cadena a escribir

//Terminamos el PDF y lo mandamos a la pantalla
$pdf->Output();
?>


 