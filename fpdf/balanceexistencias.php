<?php
    /*  
  
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
	
		
	Autores: Pedro Obreg�n Mej�as
			 Rub�n D. Mancera Mor�n
	Versi�n: 1.0
	Fecha Liberaci�n del c�digo: 13/07/2004
	Galop�n para gnuLinEx 2004 -- Extremadura
	
	*/

define('FPDF_FONTPATH','font/');
require_once('fpdf.php');
require('mysql_table.php');
include("comunes.php");
include ("../conectar.php"); 

$pdf=new PDF();
$pdf->Open();
$pdf->AddPage();


//Nombre del Listado
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',16);
$pdf->SetY(50);
$pdf->SetX(0);
$pdf->MultiCell(220,6,"Balance de Existencias",0,C,0);

$pdf->Ln();    

//T�tulos de las columnas
$header=array('Codigo','Art�culo','PCosto medio','Stock','Total');

//Colores, ancho de l�nea y fuente en negrita
    $pdf->SetFillColor(200,200,200);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',10);
	
//Cabecera
    $w=array(25,80,25,25,25);
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',1);
    $pdf->Ln();
	
//Restauraci�n de colores y fuentes

    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial','B',7);
    $impor=0;

//Buscamos y listamos las familias

$consulta = "select distinct articulos.id,articulos.codfamilia,articulos.codsubfamilia,articulos.codigo,articulos.descripcion,avg(artpro.precio) as media,articulos.stock
 from articulos,artpro where articulos.id=artpro.idarticulo and artpro.precio>0
 group by articulos.id order by codfamilia,codsubfamilia,codigo";
$query = mysql_query($consulta);
 	  
while ($row = mysql_fetch_array($query))
        {

		  //imprimo el articulo
		  
		    $union3 = $row["codfamilia"] . $row["codsubfamilia"] . $row["codigo"];
		    $pdf->Cell($w[0],5,$union3,'LRTB',0,'C');
			$acotado = substr($row["descripcion"], 0, 35);
			$pdf->Cell($w[1],5,$acotado,'LRTB',0,'L');
			
			//muestro el precio de costo medio del proveedor
			$preciocosto=number_format($row["media"],2,",",".");
			$pdf->Cell($w[2],5,$preciocosto,'LRTB',0,'R');
			
			
			//stock
			$st=number_format($row["stock"],2,",",".");
			$pdf->Cell($w[3],5,$st,'LRTB',0,'R');
			
			//total
			$tot=$row["media"]*$row["stock"];
			$impor=$impor+$tot;
			$tot=number_format($tot,2,",",".");
			$pdf->Cell($w[4],5,$tot,'LRTB',0,'R');
			
			
			$pdf->Ln();			  

        };

$pdf->Cell(array_sum($w),0,'','T');

	$pdf->Ln(10);		
	$pdf->Cell(66);
	
	$pdf->SetFillColor(200,200,200);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',10);
	
    $pdf->Cell(50,4,"IMPORTE EN ALMAC�N",1,0,'C',1);
	$pdf->Ln(4);
	
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',10);
	
	$pdf->Cell(66);
	
    $impor= number_format($impor,2,",",".");	
	
    $pdf->Cell(50,4,"$impor" . " �",1,0,'R',1);

	$pdf->Ln(4);
			
$pdf->Output();
?> 
