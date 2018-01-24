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

include ("../conectar.php");
//$this->Image('./logo/dondo.jpg',0,0,200,300,'jpg'); 
$pdf->Ln(10);
  
$consulta = "Select * from facturasp,proveedores where facturasp.codfactura='$codfactura' and facturasp.codproveedor='$codcli' and facturasp.codproveedor=proveedores.codproveedor";
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
	
	$pdf->Cell(40,65,'FACTURA DE PROVEEDORES');
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
	$pdf->Cell(30,4,"Cod. Proveedor",1,0,'C',1);
	$pdf->Cell(30,4,"Fecha",1,0,'C',1);	
	$pdf->Cell(20,4,"Nº Fact.",1,0,'C',1);
	$pdf->Ln(4);
	
	$pdf->Cell(80);
	$pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',10);
	
	$fecha = reconversion($lafila["fecha"]);
	
    $pdf->Cell(30,4,$lafila["nif"],1,0,'C',1);
	$pdf->Cell(30,4,$lafila["codproveedor"],1,0,'C',1);
	$pdf->Cell(30,4,$fecha,1,0,'C',1);	
	$pdf->Cell(20,4,$lafila["codfactura"],1,0,'C',1);		
	
	
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
	
	$consulta2 = "Select * from factulineap where codfactura='$codfactura' and codproveedor='$codcli' order by numlinea";
    $resultado2 = mysql_query($consulta2, $conexion);
    
	$contador=1;
	while ($row=mysql_fetch_array($resultado2))	
	{
	  
	  include("controlimpresionfp.php");
	  $pdf->Cell(1);	
	  
	  if (($row["codfamilia"]=='a') and ($row["codsubfamilia"]=='a'))
	    {
		  $pdf->Cell(15,4,"Albarán",'LR',0,'C');
	    }
	 else
	    {
          $pdf->Cell(15,4,$row["codfamilia"] . $row["codsubfamilia"] . $row["codigo"],'LR',0,'C');
		}; 
		
			  
	  //averiguamos los datos del artículo
	  $familia=$row["codfamilia"];
	  $subfamilia=$row["codsubfamilia"];
	  $codigoarticulo=$row["codigo"];
	  $consulta3="select * from articulos where codfamilia='$familia' and codsubfamilia='$subfamilia' and codigo='$codigoarticulo'";
	  $query3=mysql_query($consulta3);
	  $articulo=mysql_fetch_array($query3);
	  
	 if (($row["codfamilia"]=='a') and ($row["codsubfamilia"]=='a')) 
	  { 
        $pdf->Cell(105,4,"Albarán nº " . $codigoarticulo,'LR',0,'L');
		$pdf->Cell(20,4,"",'LR',0,'C');	
		$pdf->Cell(15,4,"",'LR',0,'C');	
	   } 
	else 
	  { 
	   $acotado = substr($articulo["descripcion"], 0, 55);
	   $pdf->Cell(105,4,$acotado,'LR',0,'L');

	   
	   $cantidad=number_format($row["cantidad"],2,",",".");	   
	   $pdf->Cell(20,4,$cantidad,'LR',0,'R');	
	   	
	   $precio= number_format($row["precio"],2,",","."); 	   
	   $pdf->Cell(15,4,$precio,'LR',0,'R');
	  } 
	    
	  if ($row["dcto"]==0) 
	  {
	  $pdf->Cell(15,4,"",'LR',0,'C');
	  } 
	  else 
	   { 
	    $pdf->Cell(15,4,$row["dcto"] . " %",'LR',0,'C');
	   }
	   	  
	  
	  if (($row["codfamilia"]=="a") and ($row["codsubfamilia"]=="a")) 
	    {
   	      $pdf->Cell(20,4,"",'LR',0,'R');
		  $contador=$contador+1;
		}
	  else
	    {
        $importe3= number_format($row["importe"],2,",","."); 
		$pdf->Cell(20,4,$importe3,'LR',0,'R');
	    $importe=$importe + $row["importe"];
		$contador=$contador+1;
		}	  

      $pdf->Ln(4);
	  
      if (($row["codfamilia"]=="a") and ($row["codsubfamilia"]=="a")) 
      {
       $consultap = "Select * from albalineap,articulos where codproveedor='$codcli' and codalbaran='$codigoarticulo' and albalineap.codfamilia=articulos.codfamilia and
       albalineap.codsubfamilia=articulos.codsubfamilia and albalineap.codigo=articulos.codigo";
       $resultadop = mysql_query($consultap, $conexion);
       while ($lafilap=mysql_fetch_array($resultadop)) 
	      {  
		    include("controlimpresionfp.php");
		    $pdf->Cell(1);
            $pdf->Cell(15,4,$lafilap["codfamilia"] . $lafilap["codsubfamilia"] . $lafilap["codigo"],'LR',0,'C');
		    $acotado2 = substr($lafilap["descripcion"], 0, 47);
	        $pdf->Cell(105,4,"        *" . $acotado2,'LR',0,'L');
			
	        $cantidad2=number_format($lafilap["cantidad"],2,",",".");			
			$pdf->Cell(20,4,$cantidad2,'LR',0,'R');	
						
		    $precio2= number_format($lafilap["precio"],2,",",".");
						
			$pdf->Cell(15,4,$precio2,'LR',0,'R');
			
		    if ($lafilap["dcto"]==0) 
	           {
	             $pdf->Cell(15,4,"",'LR',0,'C');
	           } 
	        else 
	           { 
	             $pdf->Cell(15,4,$lafilap["dcto"] . " %",'LR',0,'C');
	           }   

             $importe2= number_format($lafilap["importe"],2,",",".");
			
			 $importe=$importe + $lafilap["importe"];
			   
			$pdf->Cell(20,4,$importe2,'LR',0,'R');	
			$pdf->Ln(4);	
			$contador=$contador+1;
		   } 
		   
    }
//fin de lineas de partes		  
	  
	  
	  
	};
	
	include("observacionesfp.php");
	
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
	  $pdf->Cell(15,4,"",'LRB ',0,'C');
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

    $importe4= number_format($importe,2,",","."); 	
	
    $pdf->Cell(30,4,$importe4,1,0,'R',1);
	$pdf->Cell(30,4,$lafila["iva"] . "%",1,0,'C',1);
	
	$ivai=$lafila["iva"];
	$impo=$importe*($ivai/100);
	$impo=sprintf("%01.2f", $impo); 
	$total=$importe+$impo; 
	$total=sprintf("%01.2f", $total);

    $impo= number_format($impo,2,",",".");
	
    $total=sprintf("%01.2f", $total);
	$total2= number_format($total,2,",",".");	
	
	$pdf->Cell(30,4,"$impo",1,0,'R',1);	
	$pdf->Cell(35,4,"$total2" . " €",1,0,'R',1);
	$pdf->Ln(4);


      @mysql_free_result($resultado); 
      @mysql_free_result($query);
	  @mysql_free_result($resultado2); 
	  @mysql_free_result($query3);

$pdf->Output();
?>
