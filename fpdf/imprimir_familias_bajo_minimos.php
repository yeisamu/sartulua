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
$pdf->MultiCell(220,6,"Listado de Articulos bajo m�nimos",0,C,0);

$pdf->SetFillColor(255,0,0);
$pdf->SetFont('Arial','B',8);
$pdf->SetY(60);
$pdf->SetX(0);

$consulta="select * from familia where codigo=$familia";
$query= mysql_query($consulta);
$lafamilia=mysql_fetch_array($query);

$consulta2="select * from subfamilia where idfamilia=$familia and codigo=$subfamilia";
$query2=mysql_query($consulta2);
$lasubfamilia=mysql_fetch_array($query2);

$pdf->MultiCell(220,6,"Familia: " . $lafamilia["familia"] . "   SubFamilia: " . $lasubfamilia["subfamilia"],0,L,0);

$pdf->Ln();    

//T�tulos de las columnas
$header=array('Codigo','Art�culo','Proveedores','PCosto','PVP','Stock');

//Colores, ancho de l�nea y fuente en negrita
    $pdf->SetFillColor(200,200,200);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',10);
	
//Cabecera
    $w=array(20,50,50,20,20,20);
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',1);
    $pdf->Ln();
	
//Restauraci�n de colores y fuentes

    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial','B',7);


//Buscamos y listamos las familias

$consulta = "select * from articulos,artpro,proveedores where articulos.codfamilia='$familia' and articulos.codsubfamilia='$subfamilia' and articulos.id=artpro.idarticulo and artpro.idproveedor=proveedores.codproveedor and articulos.stock<=articulos.bajominimo order by codfamilia,codsubfamilia,codigo";
$query = mysql_query($consulta);
   
while ($row = mysql_fetch_array($query))
        {

		  //imprimo el articulo
		  
		    $union3 = $row["codfamilia"] . $row["codsubfamilia"] . $row["codigo"];
		    $pdf->Cell($w[0],5,$union3,'LRTB',0,'C');
			$acotado = substr($row["descripcion"], 0, 35);
			$pdf->Cell($w[1],5,$acotado,'LRTB',0,'L');

			$acotado = substr($row["nombre"], 0, 35);
			$pdf->Cell($w[2],5,$acotado,'LRTB',0,'L');
			
			//muestro el precio de costo del proveedor
			$preciocosto= number_format($row["precio"],2,",",".");
			$pdf->Cell($w[3],5,$preciocosto,'LRTB',0,'R');
			
			$precioventa= number_format($row["pvp"],2,",",".");
			$pdf->Cell($w[4],5,$precioventa,'LRTB',0,'R');
			
			//stock
			$st=number_format($row["stock"],2,",",".");
			$pdf->Cell($w[4],5,$st,'LRTB',0,'R');
			
			$pdf->Ln();			  
  
        };

$pdf->Cell(array_sum($w),0,'','T');			
$pdf->Output();
?> 
