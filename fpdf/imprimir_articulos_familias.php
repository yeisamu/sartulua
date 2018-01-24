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
	
	*/

define('FPDF_FONTPATH','font/');
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
$pdf->MultiCell(220,6,"Listado de Articulos",0,C,0);//

$pdf->Ln();    

//Títulos de las columnas
$header=array('Codigo','Artículo','Proveedores','Stock','PCosto','PVP');

//Colores, ancho de línea y fuente en negrita
    $pdf->SetFillColor(200,200,200);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',10);
	
//Cabecera
    $w=array(20,60,40,20,20,20);
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',1);
    $pdf->Ln();
	
//Restauración de colores y fuentes

    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial','B',7);


//Buscamos y listamos las familias

$consulta = "select * from articulos,artpro,proveedores where articulos.id=artpro.idarticulo and artpro.idproveedor=proveedores.codproveedor order by codfamilia,codsubfamilia,codigo";
$query = mysql_query($consulta);
   
while ($row = mysql_fetch_array($query))
        {
		
		  //imprimo el articulo
		  
		    $union3 = $row["codfamilia"] . $row["codsubfamilia"] . $row["codigo"];
		    $pdf->Cell($w[0],5,$union3,'LRTB',0,'C');
			
			$acotado = substr($row["descripcion"], 0, 40);
			$pdf->Cell($w[1],5,$acotado,'LRTB',0,'L');

			$acotado = substr($row["nombre"], 0, 28);
			$pdf->Cell($w[2],5,$acotado,'LRTB',0,'L');
			
		    $stock = $row["stock"] . " ";
			$pdf->Cell($w[3],5,$stock,'LRTB',0,'R');
			
			
			//muestro el precio de costo del proveedor
			$preciocosto = $row["precio"] . " €";
			$preciocosto=number_format($preciocosto,2,",",".");
			$pdf->Cell($w[4],5,$preciocosto,'LRTB',0,'R');
			
			$precioventa = $row["pvp"] . " €";
			$precioventa=number_format($precioventa,2,",",".");
			$pdf->Cell($w[4],5,$precioventa,'LRTB',0,'R');
			$pdf->Ln();			  
  
        };

$pdf->Cell(array_sum($w),0,'','T');			
$pdf->Output();
?> 
