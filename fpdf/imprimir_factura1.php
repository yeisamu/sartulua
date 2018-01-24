<?php
define('FPDF_FONTPATH','font/');
require('mysql_table.php');
include("comunes.php");
include ("../conexion.php"); 
include ("../convertirfechas2.php"); 
$pdf=new PDF();
$pdf->Open();
$pdf->AddPage();
$pdf->Ln(10);
  
/*$consulta = "Select * from facturas,clientes where facturas.codfactura=$codfactura and facturas.codcliente=clientes.codcliente";
$resultado = mysql_query($consulta, $conexion);
$lafila=mysql_fetch_array($resultado);*/
	

$pdf->Cell(95);
    $pdf->Cell(30,4,"",'',0,'C');
	//$pdf->Cell(10,4,"FV",0,0,'C',1);
    $pdf->Ln(2);
	
	$pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',10);
	
   $pdf->Cell(40,65,"");
	 $pdf->SetFont('Arial','',9);
	$pdf->SetX(10);	


	//$fecha = reconversion($lafila["fecha"]);
	
    $pdf->Cell(1);
    $pdf->Cell(80,4,"CLIENTE:                 ",0,0,'L',1);
	 $pdf->Cell(30,4,"",'',0,'C');
	 $pdf->SetFont('Arial','B',10);
	 $pdf->Cell(30,4,"Fecha",0,0,'C',1);
	 $pdf->Cell(10,4,"",'',0,'C');
	 $pdf->Cell(20,4,"Nº Fact.",0,0,'C',1);
    $pdf->Ln(4);
	
    $pdf->Cell(1);
	$pdf->SetFont('Arial','',9);
    $pdf->Cell(80,4,"IDENTIFICACIÓN:   ",0,0,'L',1);
	$pdf->Cell(30,4,"",'',0,'C');
	 $pdf->SetFont('Arial','B',10);
	// $pdf->Cell(30,4,"Nº Fact.",0,0,'C',1);
	$pdf->Cell(30,4,$fecha,0,0,'C',1);	
	$pdf->Cell(10,4,"",'',0,'C');
	$pdf->Cell(20,4,"FV   ",0,0,'C',1);		
    $pdf->Ln(4);

    $pdf->Cell(1);
	$pdf->SetFont('Arial','',9);
    $pdf->Cell(80,4,"CÓDIGO CLIENTE:  ",0,0,'L',1);
    $pdf->Ln(4);
	
	//Calculamos la provincia
	/*$codigoprovincia=$lafila["codprovincia"];
	$consulta="select * from provincias where codprovincia=$codigoprovincia";
	$query=mysql_query($consulta);
	$row=mysql_fetch_array($query);
	
	$codcity=$lafila["localidad"];
	$consultas="select * from ciudad where codciudad=$codcity";
	$querys=mysql_query($consultas);
	$rows=mysql_fetch_array($querys);
*/

	$pdf->Cell(1);
    $pdf->Cell(80,4,"DIRECCIÓN:            ",0,0,'L',1);
    $pdf->Ln(4);		
	
    $pdf->Cell(1);
    $pdf->Cell(80,4,"BARRIO:                   " ,0,0,'L',1);
    $pdf->Ln(4);
	
    $pdf->Cell(1);
    $pdf->Cell(80,4,"CIUDAD:                   " ,0,0,'L',1);
    $pdf->Ln(10);					
	
	/*$pdf->SetFillColor(200,200,200);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',10);
	
    $pdf->Cell(83);
    $pdf->Cell(30,4,"NIF",1,0,'C',1);
	$pdf->Cell(30,4,"Cod. Clien",1,0,'C',1);
	$pdf->Cell(30,4,"Fecha",1,0,'C',1);	
	$pdf->Cell(20,4,"Nº Fact.",1,0,'C',1);
	$pdf->Ln(4);
	
	$pdf->Cell(83);
	$pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',10);
	
	$fecha = reconversion($lafila["fecha"]);
	
    $pdf->Cell(30,4,$lafila["nif"],1,0,'C',1);
	$pdf->Cell(30,4,$lafila["codcliente"],1,0,'C',1);
	$pdf->Cell(30,4,$fecha,1,0,'C',1);	
	$pdf->Cell(20,4,$lafila["codfactura"],1,0,'C',1);	*/	
	
		
	
	
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

  /*  $consulta2 = "Select * from factulinea where codfactura='$codfactura' order by numlinea";
    $resultado2 = mysql_query($consulta2, $conexion);

    $importe=0;
    $contador=1;
    while ($lafila2=mysql_fetch_array($resultado2)) 
	   { 
         $familia=$lafila2["codfamilia"]; 
         $subfamilia=$lafila2["codsubfamilia"];
         $codigoarticulo=$lafila2["codigo"];
         $consulta3 = "Select * from articulos where codfamilia='$familia' and codsubfamilia='$subfamilia' and codigo='$codigoarticulo'";
         $resultado3 = mysql_query($consulta3, $conexion);
         $lafila3=mysql_fetch_array($resultado3);
         
		 include("controlimpresionfact.php");	
	     $pdf->Cell(1);
               if (($familia=="a") and ($subfamilia=="a")) 
			      { 
                        $pdf->Cell(15,4,"Albarán",'LR',0,'C');
	              } 
				  else 
				  { 
				        $pdf->Cell(15,4,$familia . $subfamilia . $codigoarticulo,'LR',0,'C');
                  } 
				  
               if (($familia=="a") and ($subfamilia=="a")) 
			      { 
				       $pdf->Cell(105,4,"Albarán nº " . $codigoarticulo,'LR',0,'L');
					   $pdf->Cell(20,4,"",'LR',0,'C');
					   $pdf->Cell(15,4,"",'LR',0,'C');
					   $pdf->Cell(15,4,"",'LR',0,'C');
					   $pdf->Cell(20,4,"",'LR',0,'C'); 
					   $contador++;
                  } 
			  else 
			      { 
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
                  }
			    
			 	  
             $pdf->Ln(4);

             if (($familia=="a") and ($subfamilia=="a")) 
                 {
                    $consultap = "Select * from albalinea where codalbaran='$codigoarticulo'";
                    $resultadop = mysql_query($consultap, $conexion);
                    while ($lafilap=mysql_fetch_array($resultadop)) 
					  {
					    include("controlimpresionfact.php");					    
	                    $familia2=$lafilap["codfamilia"];
	                    $subfamilia2=$lafilap["codsubfamilia"];
	                    $codigoarticulo2=$lafilap["codigo"];
	                    if (($familia2=="p") and ($subfamilia2=="p")) 
					        {
	                          $consultap0="select * from partes where codparte='$codigoarticulo2'";
		                      $resultadop0 = mysql_query($consultap0, $conexion);
                    		  $lafilap1=mysql_fetch_array($resultadop0);
							  $pdf->Cell(1);
	                          $pdf->Cell(15,4,"Parte",'LR',0,'C');	
	                          $pdf->Cell(105,4,"     *Parte nº " . $codigoarticulo2,'LR',0,'L');	
                              $pdf->Cell(20,4,"",'LR',0,'C');	
							  $pdf->Cell(15,4,"",'LR',0,'C');	
							  $pdf->Cell(15,4,"",'LR',0,'C');
							  $pdf->Cell(20,4,"",'LR',0,'C');
							  $pdf->Ln(4);
							  $contador++;
							  
		                      $consultap1 = "Select * from partelinea,articulos where codparte='$codigoarticulo2' and partelinea.codfamilia=articulos.codfamilia and
                              partelinea.codsubfamilia=articulos.codsubfamilia and partelinea.codigo=articulos.codigo";
		                      $resultadop1 = mysql_query($consultap1, $conexion);
		                      while ($lafilap1=mysql_fetch_array($resultadop1)) 
	                               {  								      								      
									  include("controlimpresionfact.php");
	                                  $pdf->Cell(1);
									  $pdf->Cell(15,4,$lafilap1[2] . $lafilap1[3] . $lafilap1[4],'LR',0,'C');
									  $acotado = substr($lafilap1["descripcion"], 0, 45);
									  $pdf->Cell(105,4,"          -" . $acotado,'LR',0,'L');
									  
                                      $cantidad2=number_format($lafilap1["cantidad"],2,",","."); 
									  $pdf->Cell(20,4,$cantidad2,'LR',0,'R');
									  
					                  $precio3= number_format($lafilap1["precio"],2,",",".");									  
                                      $pdf->Cell(15,4,$precio3,'LR',0,'R');
									  
									  if ($lafilap1["dcto"]==0)  
			                               { 
                 				            $pdf->Cell(15,4,"",'LR',0,'C');
	                                       } 
		                              else 
			                              { 
				                            $pdf->Cell(15,4,$lafilap1["dcto"] . " %",'LR',0,'C');  
                                           } 	

									  $importe3= number_format($lafilap1["importe"],2,",",".");	
									  $pdf->Cell(20,4,$importe3,'LR',0,'R');
									  $importe=$importe + $lafilap1["importe"];
									  $pdf->Ln(4);
									  $contador++;
                                   }
	   
	                     } 
					 else 
						   { 
	                        $consultap2 = "Select * from articulos where articulos.codfamilia='$familia2' and
                            articulos.codsubfamilia='$subfamilia2' and codigo='$codigoarticulo2'";
		                    $resultadop2 = mysql_query($consultap2, $conexion); 
		                    $lafilap2=mysql_fetch_array($resultadop2); 							
                            $pdf->Cell(1);
						    $pdf->Cell(15,4,$lafilap[2] . $lafilap[3] . $lafilap[4],'LR',0,'C');
							$acotado = substr($lafilap2["descripcion"], 0, 50);
							$pdf->Cell(105,4,"     *" . $acotado,'LR',0,'L');
							
                            $cantidad3=number_format($lafilap["cantidad"],2,",",".");
							$pdf->Cell(20,4,$cantidad3,'LR',0,'R');
							
					        $precio4= number_format($lafilap["precio"],2,",",".");							
                            $pdf->Cell(15,4,$precio4,'LR',0,'R');

									  if ($lafilap["dcto"]==0)  
			                               { 
                 				            $pdf->Cell(15,4,"",'LR',0,'C');
	                                       } 
		                              else 
			                              { 
				                            $pdf->Cell(15,4,$lafilap["dcto"] . " %",'LR',0,'C');  
                                           } 	
							$importe4= number_format($lafilap["importe"],2,",",".");	
							$pdf->Cell(20,4,$importe4,'LR',0,'R');							
							$importe=$importe + $lafilap["importe"];
							$pdf->Ln(4);
							$contador++;
                   } 
		 }
    }
  } */

    include("observacionesfact.php");

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
	$pdf->Cell(30,4,"FLETE",1,0,'C',1);
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
	$pdf->Cell(30,4,"$ ",1,0,'C',1);
	
	/*$flete=$lafila["flete"];
	$ivai=$lafila["iva"];*/
	$impo=$importe*($ivai/100);	
	$total=$importe+$impo+$flete;
	
	/*$flete=$lafila["flete"];
	$flete=$importe+$flete;	
	$total=$flete; */
 

	$impo= number_format($impo,2,",",".");	
	$pdf->Cell(30,4,"$impo",1,0,'R',1);	
	
    $total=sprintf("%01.2f", $total);
	$total2= number_format($total,2,",",".");
	$pdf->Cell(35,4,"$ "."$total2",1,0,'R',1);
	$pdf->Ln(4);


    /*  @mysql_free_result($resultado); 
      @mysql_free_result($query);
	  @mysql_free_result($resultado2); 
	  @mysql_free_result($query3);
*/
$pdf->Output();
?> 
