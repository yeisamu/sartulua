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

$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',14);
$pdf->SetY(50);
$pdf->SetX(0);
$pdf->MultiCell(220,6,"Listado de Facturas",0,C,0);//

$pdf->Ln();    

//Títulos de las columnas
$header=array('Codigo','Cliente','Fecha','F. Cobro','Neto','Tipo IVA','IVA','Total');

//Colores, ancho de línea y fuente en negrita
    $pdf->SetFillColor(200,200,200);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',10);
	
//Cabecera
    $w=array(20,50,20,20,20,20,20,20);
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',1);
    $pdf->Ln();
	
//Restauración de colores y fuentes

    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial','B',7);

//Buscamos y listamos los clientes

    if ($fecha1=="") { $fecha1="01/01/1970"; }
    if ($fecha2=="") { $fecha2=date("d/m/Y"); }

    if ($fecha11=="") { $fecha11="01/01/1970"; }
    if ($fecha22=="") { $fecha22=date("31/12/Y"); }

     $consulta = "Select * from facturas";
	
     $consulta2 = "where codfactura<>'0'";
	
	 if ($estado<>"") $consulta2 = $consulta2 . " and estado=$estado";
	 
	 
	 include ("../convertirfechas.php");
	 $fecha11=conversion($fecha11);
     $fecha22=conversion($fecha22);
	 
	 if (($fecha11<>"") and ($fecha22<>"") and ($fecha11<>"--") and ($fecha22<>"--"))
	   {
	     $consulta2= $consulta2 . " and fechacobro >= '$fecha11' and fechacobro <= '$fecha22'";
	   };
	  
	 include ("../cascadafacturas.php");
	   
	 $consulta = $consulta . " order by 1 desc";
     $query = mysql_query($consulta, $conexion);
	 
		  
while ($row = mysql_fetch_array($query))
        {
         $pdf->Cell($w[0],5,$row[0],'LRTB',0,'C');  
		 
	     $consulta1 = "select nombre from clientes where codcliente = '$row[3]'";
         $resultado1 = mysql_query($consulta1, $conexion);
         $lafila1=mysql_fetch_array($resultado1);
		 
		 $acotado = substr($lafila1["nombre"], 0, 35);
		 $pdf->Cell($w[1],5,$acotado,'LRTB',0,'L');
		 
	     $fechaprueba=reconversion($row[1]);
	     $pdf->Cell($w[2],5,$fechaprueba,'LRTB',0,'C');
			  
	     $fechaprueba2=reconversion($row[8]);
	     $pdf->Cell($w[3],5,$fechaprueba2,'LRTB',0,'C');
			 	 
		 $codfactura=$row["codfactura"];
		 $consulta2 = "Select * from factulinea where codfactura='$codfactura' order by numlinea";
         $resultado2 = mysql_query($consulta2, $conexion);

         $importe=0;
         while ($lafila2=mysql_fetch_array($resultado2)) 
	        {   
               if (($familia=="a") and ($subfamilia=="a")) 
			      { 

                  } 
			  else 
			      { 
					   $importe=$importe + $lafila2["importe"]; 				   
                  }


             if (($familia=="a") and ($subfamilia=="a")) 
                 {
                    $consultap = "Select * from albalinea where codalbaran='$codigoarticulo'";
                    $resultadop = mysql_query($consultap, $conexion);
                    while ($lafilap=mysql_fetch_array($resultadop)) 
					  {
	                    $familia2=$lafilap["codfamilia"];
	                    $subfamilia2=$lafilap["codsubfamilia"];
	                    $codigoarticulo2=$lafilap["codigo"];
	                    if (($familia2=="p") and ($subfamilia2=="p")) 
					        {							  
		                      $consultap1 = "Select * from partelinea,articulos where codparte='$codigoarticulo2' and partelinea.codfamilia=articulos.codfamilia and
                              partelinea.codsubfamilia=articulos.codsubfamilia and partelinea.codigo=articulos.codigo";
		                      $resultadop1 = mysql_query($consultap1, $conexion);
		                      while ($lafilap1=mysql_fetch_array($resultadop1)) 
	                               {  
									  $importe=$importe + $lafilap1["importe"];
                                   }
	   
	                     } 
					 else 
						   { 

							$importe=$importe + $lafilap["importe"];
                           } 
		         }
				
    }
 
}				
 	 $importe2= number_format($importe,2,",","."); 
	 $pdf->Cell($w[4],5,$importe2,'LRTB',0,'R');
	 $pdf->Cell($w[5],5,$row["iva"] . " %",'LRTB',0,'C');
	 
	 $iva=($importe*$row["iva"])/100;
	 $iva2= number_format($iva,2,",",".");
     $pdf->Cell($w[6],5,$iva2,'LRTB',0,'R');
	 
	 $total=$importe+$iva;
	 $total=number_format($total,2,",",".");
	 
	 $pdf->Cell($w[7],5,$total . " €",'LRTB',0,'R');
	 $pdf->Ln(); 
		 	 
        };
		
$pdf->Cell(array_sum($w),0,'','T');	 
$pdf->Output();
?> 



 