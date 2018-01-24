<?	
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
	
	Autores: Pedro Obregón Mejías
			 Rubén D. Mancera Morán
	Versión: 1.0
	Fecha Liberación del código: 13/07/2004
	Galopín para gnuLinEx 2004 -- Extremadura		 
	
	*/
	
	if ($contador>35)
	{
    $pdf->Cell(1);
    $pdf->Cell(15,4,"",'LRB',0,'C');
    $pdf->Cell(105,4,"",'LRB',0,'C');
	$pdf->Cell(20,4,"",'LRB',0,'C');	
	$pdf->Cell(15,4,"",'LRB ',0,'C');
	$pdf->Cell(15,4,"",'LRB',0,'C');
	$pdf->Cell(20,4,"",'LRB',0,'C');
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
	$row2=mysql_fetch_array($query);

	$pdf->Cell(95);
    $pdf->Cell(80,4,$lafila["cp"] . "  " . $lafila["localidad"] . "  (" . $row2["denprovincia"] . ")",'LR',0,'L',1);
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
	$contador=1;	
	}
?>