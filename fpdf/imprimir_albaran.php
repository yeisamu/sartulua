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
include ("../convertirfechas2.php"); 

$pdf=new PDF();
$pdf->Open();
$pdf->AddPage();

$pdf->Ln(10);


include ("../conectar.php");
  
$consulta = "Select * from albaranes,clientes where albaranes.codalbaran='$codalbaran' and albaranes.codcliente=clientes.codcliente";
$resultado = mysql_query($consulta, $conexion);
$lafila=mysql_fetch_array($resultado);
	
	$pdf->Cell(95);
    $pdf->Cell(80,4,"",'',0,'C');
    $pdf->Ln(4);
	
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',10);	
	
    $pdf->Cell(40,65,'ALBARÁN');
	$pdf->SetX(10);	

    $pdf->Cell(95);
    $pdf->Cell(80,4,"",'LRT',0,'L',1);
    $pdf->Ln(4);
	
    $pdf->Cell(95);
    $pdf->Cell(80,4,$lafila["nombre"],'LR',0,'L',1);
    $pdf->Ln(4);

    $pdf->Cell(95);
    $pdf->Cell(80,4,$lafila["direccion"],'LR',0,'L',1);
    $pdf->Ln(4);
	
	//Calculamos la provincia
	$codigoprovincia=$lafila["codprovincia"];
	$consulta="select * from provincias where codprovincia=$codigoprovincia";
	$query=mysql_query($consulta);
	$row=mysql_fetch_array($query);

	$pdf->Cell(95);
    $pdf->Cell(80,4,$lafila["cp"] . "  " . $lafila["localidad"] . "  (" . $row["denprovincia"] . ")",'LR',0,'L',1);
    $pdf->Ln(4);		
	
    $pdf->Cell(95);
    $pdf->Cell(80,4,"Tlfno: " . $lafila["telefono"] . "  " . "Fax: " . $lafila["fax"],'LR',0,'L',1);
    $pdf->Ln(4);
	
    $pdf->Cell(95);
    $pdf->Cell(80,4,"",'LRB',0,'L',1);
    $pdf->Ln(10);					

    $pdf->SetFillColor(200,200,200);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',10);
	
    $pdf->Cell(80);
    $pdf->Cell(30,4,"NIF",1,0,'C',1);
	$pdf->Cell(30,4,"Cod. Clien",1,0,'C',1);
	$pdf->Cell(30,4,"Fecha",1,0,'C',1);	
	$pdf->Cell(20,4,"Nº Alb.",1,0,'C',1);
	$pdf->Ln(4);
	
	$pdf->Cell(80);
	$pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',10);
	
	$fecha = reconversion($lafila["fecha"]);
	
    $pdf->Cell(30,4,$lafila["nif"],1,0,'C',1);
	$pdf->Cell(30,4,$lafila["codcliente"],1,0,'C',1);
	$pdf->Cell(30,4,$fecha,1,0,'C',1);	
	$pdf->Cell(20,4,$lafila["codalbaran"],1,0,'C',1);		
	
	
	//ahora mostramos las líneas del albarán
	$pdf->Ln(10);		
	$pdf->Cell(1);
	
	$pdf->SetFillColor(200,200,200);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',10);
	
    $pdf->Cell(15,4,"Codigo",1,0,'C',1);
	$pdf->Cell(105,4,"Descripción",1,0,'C',1);
	$pdf->Cell(20,4,"Cantidad",1,0,'C',1);	
	$pdf->Cell(15,4,"Precio",1,0,'C',1);
	$pdf->Cell(15,4,"% Desc.",1,0,'C',1);	
	$pdf->Cell(20,4,"Importe",1,0,'C',1);
	$pdf->Ln(4);
			
			
	$pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','',9);

	
	$consulta2 = "Select * from albalinea where codalbaran='$codalbaran' order by numlinea";
    $resultado2 = mysql_query($consulta2, $conexion);
    
	$contador=1;
	while ($row=mysql_fetch_array($resultado2))
	{
	  include("controlimpresionalb.php");
	  $pdf->Cell(1);
	  
    if (($row["codfamilia"]=='p') and ($row["codsubfamilia"]=='p')) 
	  { 
        $pdf->Cell(15,4,"Parte",'LR',0,'C');
	   } 
	else 
	  { 
	   $pdf->Cell(15,4,$row["codfamilia"] . $row["codsubfamilia"] . $row["codigo"],'LR',0,'C');
	  } 

	  //averiguamos los datos del artículo
	  $familia=$row["codfamilia"];
	  $subfamilia=$row["codsubfamilia"];
	  $codigoarticulo=$row["codigo"];
	  $consulta3="select * from articulos where codfamilia='$familia' and codsubfamilia='$subfamilia' and codigo='$codigoarticulo'";
	  $query3=mysql_query($consulta3);
	  $articulo=mysql_fetch_array($query3);
	  
	  
	  if (($row["codfamilia"]=='p') and ($row["codsubfamilia"]=='p')) 
	  { 
        $pdf->Cell(105,4,"Parte nº " . $codigoarticulo,'LR',0,'L');
		$pdf->Cell(20,4,"",'LR',0,'C');
		$pdf->Cell(15,4,"",'LR',0,'C');
		$pdf->Cell(15,4,"",'LR',0,'C');
		$pdf->Cell(20,4,"",'LR',0,'C');
	   } 
	else 
	  { 
	   $acotado = substr($articulo["descripcion"], 0, 55);	  
	   $pdf->Cell(105,4,$acotado,'LR',0,'L');
	   
	   $cantidad=number_format($row["cantidad"],2,",","."); 	   
	   $pdf->Cell(20,4,$cantidad,'LR',0,'R');
	   
       $precio2=number_format($row["precio"],2,",",".");	   
	   $pdf->Cell(15,4,$precio2,'LR',0,'R');
       if ($row["dcto"]==0) 
	       {
	        $pdf->Cell(15,4,"",'LR',0,'C');
	       } 
	   else 
	       { 
	       $pdf->Cell(15,4,$row["dcto"] . " %",'LR',0,'C');
	       }
       $importe2=number_format($row["importe"],2,",",".");			   
	   $pdf->Cell(20,4,$importe2,'LR',0,'R'); 
	   $importe=$importe + $row["importe"];  	   	
	  } 
	  

      $pdf->Ln(4);
	  
      if (($row["codfamilia"]=="p") and ($row["codsubfamilia"]=="p")) 
      {
       $consultap = "Select * from partelinea,articulos where codparte='$codigoarticulo' and partelinea.codfamilia=articulos.codfamilia and
       partelinea.codsubfamilia=articulos.codsubfamilia and partelinea.codigo=articulos.codigo";
       $resultadop = mysql_query($consultap, $conexion);
       while ($lafilap=mysql_fetch_array($resultadop)) 
	      {  
		    include("controlimpresionalb.php");
		    $pdf->Cell(1);
            $pdf->Cell(15,4,$lafilap["codfamilia"] . $lafilap["codsubfamilia"] . $lafilap["codigo"],'LR',0,'C');
		    $acotado = substr($lafilap["descripcion"], 0, 47);
	        $pdf->Cell(105,4,"        -" . $acotado,'LR',0,'L');
			
		    $cantidad2=number_format($lafilap["cantidad"],2,",",".");; 
			$pdf->Cell(20,4,$cantidad2,'LR',0,'R');	
			
            $precio3=number_format($lafilap["precio"],2,",",".");			
			$pdf->Cell(15,4,$precio3,'LR',0,'R');
		    if ($lafilap["dcto"]==0) 
	           {
	             $pdf->Cell(15,4,"",'LR',0,'C');
	           } 
	        else 
	           { 
	             $pdf->Cell(15,4,$lafilap["dcto"] . " %",'LR',0,'C');
	           }
            $importe3=number_format($lafilap["importe"],2,",",".");			   
			$pdf->Cell(20,4,$importe3,'LR',0,'R');	
			$importe=$importe + $lafilap["importe"]; 
			$pdf->Ln(4);	
			$contador=$contador + 1;
		   } 
		   
    }
//fin de lineas de partes	

	  $contador=$contador + 1;
	  
	};
	
	include("observacionesalb.php");
	
	while ($contador<35)
	{
	  $pdf->Cell(1);
      $pdf->Cell(15,4,"",'LR',0,'C');
      $pdf->Cell(105,4,"",'LR',0,'C');
	  $pdf->Cell(20,4,"",'LR',0,'C');	
	  $pdf->Cell(15,4,"",'LR',0,'C');
	  $pdf->Cell(15,4,"",'LR',0,'C');
	  $pdf->Cell(20,4,"",'LR',0,'C');
	  $pdf->Ln(4);	
	  $contador=$contador +1;
	}

	  $pdf->Cell(1);
      $pdf->Cell(15,4,"",'LRB',0,'C');
      $pdf->Cell(105,4,"",'LRB',0,'C');
	  $pdf->Cell(20,4,"",'LRB',0,'C');	
	  $pdf->Cell(15,4,"",'LRB',0,'C');
	  $pdf->Cell(15,4,"",'LRB',0,'C');
	  $pdf->Cell(20,4,"",'LRB',0,'C');
	  $pdf->Ln(4);	


	//ahora mostramos el final de la factura
	$pdf->Ln(10);		
	$pdf->Cell(66);
	
	$pdf->SetFillColor(200,200,200);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',10);
	
    $pdf->Cell(30,4,"NETO",1,0,'C',1);
	$pdf->Cell(30,4,"CUOTA IVA",1,0,'C',1);
	$pdf->Cell(30,4,"IVA",1,0,'C',1);	
	$pdf->Cell(35,4,"TOTAL",1,0,'C',1);
	$pdf->Ln(4);
	
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',10);
	
	$pdf->Cell(66);
    $importe4=number_format($importe,2,",",".");	
    $pdf->Cell(30,4,$importe4,1,0,'R',1);
	$pdf->Cell(30,4,$lafila["iva"] . "%",1,0,'C',1);
	
	$ivai=$lafila["iva"];
	$impo=$importe*($ivai/100);
	$impo=sprintf("%01.2f", $impo); 
	$total=$importe+$impo; 
	$total=sprintf("%01.2f", $total);

	$impo=number_format($impo,2,",",".");	
	$pdf->Cell(30,4,"$impo",1,0,'R',1);	
    $total=sprintf("%01.2f", $total);
	$total2= number_format($total,2,",",".");	
	$pdf->Cell(35,4,"$total2" . " €",1,0,'R',1);
	$pdf->Ln(4);


      @mysql_free_result($resultado); 
      @mysql_free_result($query);
	  @mysql_free_result($resultado2); 
	  @mysql_free_result($query3);

$pdf->Output();
?> 
