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
$header=array('Codigo','Artículo','PVP','Stock','Bajo Min.');

//Colores, ancho de línea y fuente en negrita
    $pdf->SetFillColor(200,200,200);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',10);
	
//Cabecera
    $w=array(15,105,20,20,20);
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',1);
    $pdf->Ln();
	
//Restauración de colores y fuentes

    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial','B',7);


if  (($codini=="") and ($codfin==""))
{	 
	 $consulta="Select * from articulos";
	 
	 if ($proveedor<>"")
	 {
	  $consulta = $consulta . ",artpro";
	 };
	 
	 
	 if (($codigo)<>"" or ($articulo<>"") or ($proveedor<>"") or ($codini<>"") or ($codfin<>""))
	 {
	 $consulta = $consulta . " where ";
	 };
	 
	 if ($codigo<>"")
	   { 
	 
	    $familia = substr($codigo,0,2);
        $subfamilia = substr($codigo,2,2);
        $codigoarticulo = substr($codigo,4,2);
	 
	    $consulta = $consulta . "codfamilia='$familia' and codsubfamilia='$subfamilia' and codigo='$codigoarticulo'";
	   };
	   
	 if ($articulo<>"")
	 { 
	  if ($codigo<>"") $consulta = $consulta . " and";
	  $consulta = $consulta . " descripcion like '%".$articulo."%'";
	 };	 
	 if ($proveedor<>"")
	 { 
	 
	  if (($codigo<>"") or ($articulo<>"")) $consulta = $consulta . " and";
	  $consulta = $consulta . " artpro.idproveedor=$proveedor and artpro.idarticulo=articulos.id";
	 };
    
	if (($codigo=="") and ($articulo=="") and ($proveedor=="") and ($familia<>""))
	   {
	    $consulta = $consulta . " where articulos.codfamilia=$familia";
		
		  if ($subfamilia<>"")
		    {
			  $consulta = $consulta . " and articulos.codsubfamilia=$subfamilia";
			}
 	   } 
	
	
    $consulta = $consulta . " order by codfamilia, codsubfamilia, codigo;";
	
   	 $query = mysql_query($consulta);
	 $total=mysql_num_rows($query);
	 
	 while ($row = mysql_fetch_array($query))
        {
		    $pdf->Cell($w[0],5,$row["codfamilia"] . $row["codsubfamilia"] . $row["codigo"],'LRTB',0,'C');
			$acotado = substr($row["descripcion"], 0, 75);
			$pdf->Cell($w[1],5,$acotado,'LRTB',0,'L');
			$pvp= number_format($row["pvp"],2,",",".");
			$pdf->Cell($w[2],5,$pvp,'LRTB',0,'R');
			$stock=number_format($row["stock"],2,",",".");						   
		    $pdf->Cell($w[3],5,$stock,'LRTB',0,'R');			
			$bajominimo=number_format($row["bajominimo"],2,",",".");						   			   
		    $pdf->Cell($w[4],5,$bajominimo,'LRTB',0,'R');			
			$pdf->Ln();		
        }
}
else
{

    $consulta = "select * from articulos order by codfamilia, codsubfamilia, codigo";
	$query = mysql_query($consulta);
	

	      $familiaini = substr($codini,0,2);
          $subfamiliaini = substr($codini,2,2);
          $codigoarticuloini = substr($codini,4,2);
		  
		  $familiafin = substr($codfin,0,2);
          $subfamiliafin = substr($codfin,2,2);
          $codigoarticulofin = substr($codfin,4,2);	
	
	while ($row=mysql_fetch_array($query))
	{
			   if (($row["codfamilia"]>=$familiaini) and ($row["codfamilia"]<=$familiafin))
		       {	
			      if (($row["codfamilia"]<$familiafin) or (($row["codsubfamilia"]>=$subfamiliaini) and ($row["codsubfamilia"]<=$subfamiliafin)))
			         {
			   	      	if ((($row["codfamilia"]<$familiafin) or ($row["codsubfamilia"]<$subfamiliafin)) or (($row["codigo"]>=$codigoarticuloini) and ($row["codigo"]<=$codigoarticulofin)))
			            {
			               $pdf->Cell($w[0],5,$row["codfamilia"] . $row["codsubfamilia"] . $row["codigo"],'LRTB',0,'C');
			               $acotado = substr($row["descripcion"], 0, 75);
						   $pdf->Cell($w[1],5,$acotado,'LRTB',0,'L');
						   $pvp=number_format($row["pvp"],2,",",".");
			               $pdf->Cell($w[2],5,$pvp,'LRTB',0,'R');
						   $stock=number_format($row["stock"],2,",",".");						   
						   $pdf->Cell($w[3],5,$stock,'LRTB',0,'R');			
						   $bajominimo=number_format($row["bajominimo"],2,",",".");						   			   
						   $pdf->Cell($w[4],5,$bajominimo,'LRTB',0,'R');
			               $pdf->Ln();
						}   		
					 }	   
			   }
	}

};
$pdf->Cell(array_sum($w),0,'','T');			
$pdf->Output();
?> 