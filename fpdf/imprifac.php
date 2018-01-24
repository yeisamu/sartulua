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

$pdf->Ln(10);
  
$consulta01 = "Select * from facturas WHERE fecha BETWEEN  '2004-07-13' 	and '2009-07-13'";
$resultado01 = mysql_query($consulta01, $conexion);
$numregistros=mysql_num_rows($resultado01);

 $i=0;
 $acumTotal = 0;
 $ventotal= 0;
while ($i < $numregistros)
	 {
          // ciclo para presentar los movimientos 
	  $codfactura=mysql_result($resultado01,$i,codfactura); 
        //$consulta2="select * from factura where numfac='$numero_new'";
 
$consulta = "Select * from facturas,clientes where facturas.codfactura=$codfactura and facturas.codcliente=clientes.codcliente";
$resultado = mysql_query($consulta, $conexion);
$lafila=mysql_fetch_array($resultado);
	
	$pdf->Cell(95);
    $pdf->Cell(80,4,"",'',0,'C');
    $pdf->Ln(1);
	
	$pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','',10);
	
    //$pdf->Cell(40,65,'FACTURA DE VENTA');
	//$pdf->SetX(10);	

   // $pdf->Cell(1);
   $pdf->Ln(10);		
	$pdf->Cell(1);
    $pdf->Cell(15,4,"SEÑOR(ES):",0,0,'L');
    $pdf->Ln(4);
	
  // $pdf->Ln(10);		
	$pdf->Cell(1);
	$pdf->Cell(35,4,"CLIENTE :",0,0,'L');
    $pdf->Cell(35,4,$lafila["nombre"],0,0,'L');
    $pdf->Ln(4);

	$pdf->Cell(1);
	$pdf->Cell(35,4,"CODIGO:",0,0,'L');
    $pdf->Cell(35,4,$lafila["codcliente"],0,0,'L');
    $pdf->Ln(4);
	$pdf->Cell(1);
	$pdf->Cell(35,4,"IDENTIFICACION:",0,0,'L');
    $pdf->Cell(35,4,$lafila["nif"],0,0,'L');
    $pdf->Ln(4);


    $pdf->Cell(1);
	$pdf->Cell(35,4,"DIRECCION:",0,0,'L');
    $pdf->Cell(35,4,$lafila["direccion"],0,0,'L');
    $pdf->Ln(4);
	
	//Calculamos la provincia
	$codigoprovincia=$lafila["codprovincia"];
	$consulta="select * from provincias where codprovincia=$codigoprovincia";
	$query=mysql_query($consulta);
	$row=mysql_fetch_array($query);

	$pdf->Cell(1);
    $pdf->Cell(15,4,$lafila["cp"] . "  " . $lafila["localidad"] . "  (" . $row["denprovincia"] . ")",0,0,'L');
    $pdf->Ln(4);		
	
    $pdf->Cell(1);
    $pdf->Cell(80,4,"",0,0,'L');
    $pdf->Ln(4);
	
   $pdf->Cell(1);
   $pdf->Cell(80,4,"",0,0,'L');
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
	$pdf->Cell(30,4,$lafila["codcliente"],1,0,'C',1);
	$pdf->Cell(30,4,$fecha,1,0,'C',1);	
	$pdf->Cell(20,4,$lafila["codfactura"],1,0,'C',1);		
	
	
	//ahora mostramos las líneas de la factura
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


  
 
 
    $consulta2 = "Select * from factulinea where codfactura='$codfactura' order by numlinea";
    $resultado2 = mysql_query($consulta2, $conexion);

    $importe=0;
    $contador=1;
    while ($lafila2=mysql_fetch_array($resultado2)) 
	
	   { 
	   include("controlimpresionfact.php");
	   
	   $pdf->Cell(1);
         $familia=$lafila2["codfamilia"]; 
         $subfamilia=$lafila2["codsubfamilia"];
         $codigoarticulo=$lafila2["codigo"];
         $consulta3 = "Select * from articulos where codfamilia='$familia' and codsubfamilia='$subfamilia' and codigo='$codigoarticulo'";
         $resultado3 = mysql_query($consulta3, $conexion);
         $lafila3=mysql_fetch_array($resultado3);
         
		  $pdf->Cell(15,4,$familia . $subfamilia . $codigoarticulo,'LR',0,'C');
		 
		  $acotado = substr($lafila3["descripcion"], 0, 55);
				       $pdf->Cell(105,4,$acotado,'LR',0,'L');
					   
					   $cantidad=number_format($lafila2["cantidad"],2,",",".");
					   $pdf->Cell(20,4,$cantidad,'LR',0,'R');	
					   
					   $precio2= number_format($lafila2["precio"],2,",",".");
					   $pdf->Cell(15,4,$precio2,'LR',0,'R');
					           if ($lafila2["dcto"]==0) 
			              { 
				            $pdf->Cell(15,4,"",'LR',0,'C');
	                      } 
		               else 
			              { 
				            $pdf->Cell(15,4,$lafila2["dcto"] . " %",'LR',0,'C');  
                          } 	
                       $importe2= number_format($lafila2["importe"],2,",",".");						  
					   $pdf->Cell(20,4,$importe2,'LR',0,'R'); 
					   $contador++;
					   $importe=$importe + $lafila2["importe"];
					    	
		 $pdf->Ln(4);
              
	              } 
				 

  // include("observacionesfact.php");

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
	$importe5= number_format($importe,2,",",".");	
    $pdf->Cell(30,4,$importe5,1,0,'R',1);
	$pdf->Cell(30,4,$lafila["iva"] . "%",1,0,'C',1);
	
	$ivai=$lafila["iva"];
	$impo=$importe*($ivai/100);	
	$total=$importe+$impo; 

	$impo= number_format($impo,2,",",".");	
	$pdf->Cell(30,4,"$impo",1,0,'R',1);	
	
    $total=sprintf("%01.2f", $total);
	$total2= number_format($total,2,",",".");
	$pdf->Cell(35,4,"$total2" . " $",1,0,'R',1);
	$pdf->Ln(4);


      @mysql_free_result($resultado); 
      @mysql_free_result($query);
	  @mysql_free_result($resultado2); 
	  @mysql_free_result($query3);
	  
	   $i++;
 }

$pdf->Output();
?> 
