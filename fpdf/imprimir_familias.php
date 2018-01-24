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

$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',16);
$pdf->SetY(50);
$pdf->SetX(0);
$pdf->MultiCell(220,6,"Listado de Familias",0,C,0);

$pdf->Ln();
$pdf->Ln();

//Títulos de las columnas

$header=array('Familias','Subfamilias');

//Colores, ancho de línea y fuente en negrita
    $pdf->SetFillColor(200,200,200);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',10);
	
//Cabecera
    $w=array(90,90);
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',1);
    $pdf->Ln();
	
//Restauración de colores y fuentes

    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial','B',7);

//Buscamos y listamos las familias

$consulta = "select * from familia order by codigo, familia";
$query = mysql_query($consulta);

 
while ($row = mysql_fetch_array($query))
        {
		  //imprimo el nombre de la familia
		  $union=$row["codigo"] . "-" . $row["familia"];
		  $union = substr($union, 0, 75);
		  $pdf->Cell($w[0],5,$union,'LRTB',0,'L'); 
		  $pdf->Cell($w[0],5,"",'LRTB',0,'L');
		  $pdf->Ln();		
		  $fill=!$fill;
		  //ahora busco las subfamilias y las imprimo
		  
		  $idfamilia=$row["codigo"];
		  $consulta2="select * from subfamilia where idfamilia=$idfamilia";
		  $query2=mysql_query($consulta2);
		  

		     while ($row2 = mysql_fetch_array($query2))
			    {
				   //imprimo el nombre de la subfamilia
				  $union2=$row2["codigo"] . "-" . $row2["subfamilia"];
				  $union2 = substr($union2, 0, 75);
				  $pdf->Cell($w[0],5,"",'LRTB',0,'L');
                  $pdf->Cell($w[1],5,$union2,'LRTB',0,'L'); 
				  $pdf->Ln();		
				};
  
			
        };

$pdf->Cell(array_sum($w),0,'','T');	 			
$pdf->Output();
?> 
