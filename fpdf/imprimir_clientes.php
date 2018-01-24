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
$pdf->SetFont('Arial','B',14);
$pdf->SetY(50);
$pdf->SetX(0);
$pdf->MultiCell(220,6,"Listado de Clientes",0,C,0);//

$pdf->Ln();    

//T�tulos de las columnas
$header=array('Cod.','Nombre y apellidos','Ciudad','Provincia','Telf.','M�vil');

//Colores, ancho de l�nea y fuente en negrita
    $pdf->SetFillColor(200,200,200);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',10);
	
//Cabecera
    $w=array(10,60,40,30,20,20);
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',1);
    $pdf->Ln();
	
//Restauraci�n de colores y fuentes

    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial','B',7);

//Buscamos y listamos los clientes

$consulta = "select * from clientes order by localidad, nombre";
$query = mysql_query($consulta);
		  
while ($row = mysql_fetch_array($query))
        {
		
		 //posicion celda, alto,contenido,bordes que mostramos(left,right top botton),0, alineacion izquierda
		 //imprimo nombre, apellidos y localidad
		 $pdf->Cell($w[0],5,$row["codcliente"],'LRTB',0,'C'); 
		 $acotado = substr($row["nombre"], 0, 40);
         $pdf->Cell($w[1],5,$acotado,'LRTB',0,'L'); 
		   //averiguo la ciudad
		 $ciudad=$row["localidad"];
		 $consultas2="select * from ciudad where codciudad=$ciudad";
		 $querys2=mysql_query($consultas2);
		 $laciudad=mysql_fetch_array($querys2);
		 $pdf->Cell($w[2],5,$laciudad["desciudad"],'LRTB',0,'L');
		 
		 
		 //averiguo la provincia
		 $provincia=$row["codprovincia"];
		 $consulta2="select * from provincias where codprovincia=$provincia";
		 $query2=mysql_query($consulta2);
		 $laprovincia=mysql_fetch_array($query2);
		 //imprimo la provincia
         $pdf->Cell($w[3],5,$laprovincia["denprovincia"],'LRTB',0,'L');
		 
		 //imprimo telefono y movil
         $pdf->Cell($w[4],5,$row["telefono"],'LRTB',0,'R');
	     $pdf->Cell($w[5],5,$row["movil"],'LRTB',0,'R');
         $pdf->Ln();		 
        };
		
$pdf->Cell(array_sum($w),0,'','T');	 
$pdf->Output();
?> 
