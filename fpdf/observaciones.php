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
	
	Autores: Pedro Obreg�n Mej�as
			 Rub�n D. Mancera Mor�n
	Versi�n: 1.0
	Fecha Liberaci�n del c�digo: 13/07/2004
	Galop�n para gnuLinEx 2004 -- Extremadura		 
	
	*/
	
function observaciones()
{
 if ($lafila[5]<>"")	
   {
	  //dejamos un espacio en blanco de separacion
	  $pdf->Cell(1);
   $pdf->Cell(15,4,"",'LR',0,'C');
   $pdf->Cell(105,4,"",'LR',0,'L');
	  $pdf->Cell(20,4,"",'LR',0,'C');	
	  $pdf->Cell(15,4,"",'LR',0,'C');
	  $pdf->Cell(15,4,"",'LR',0,'C');
	  $pdf->Cell(20,4,"",'LR',0,'C');
	  $pdf->Ln(4);	
	  $contador=$contador +1;	
	  	 
	  $longitud=strlen($lafila[5]);	
	  
	  //escribimos observaciones
	  $pdf->SetFont('Arial','B',9);
	  $pdf->Cell(1);
      $pdf->Cell(15,4,"",'LR',0,'C');
      $pdf->Cell(105,4,"Observaciones: ",'LR',0,'');
	  $pdf->Cell(20,4,"",'LR',0,'C');	
	  $pdf->Cell(15,4,"",'LR',0,'C');
	  $pdf->Cell(15,4,"",'LR',0,'C');
	  $pdf->Cell(20,4,"",'LR',0,'C');
	  $pdf->Ln(4);		
	   
	  //escribimos la primera l�nea  
	  $pdf->SetFont('Arial','',9);
	  $pdf->Cell(1);
      $pdf->Cell(15,4,"",'LR',0,'C');
	  $primeravez=substr($lafila[5],0,60);
      $pdf->Cell(105,4,$primeravez,'LR',0,'');
	  $pdf->Cell(20,4,"",'LR',0,'C');	
	  $pdf->Cell(15,4,"",'LR',0,'C');
	  $pdf->Cell(15,4,"",'LR',0,'C');
	  $pdf->Cell(20,4,"",'LR',0,'C');
	  $pdf->Ln(4);	
	  $contador=$contador+1;	
      $longitud=$longitud-60;
	  $indice=60;		
	  while ($longitud>60)
	  {
	    include("controlimpresion.php");
	    //escribimos las dem�s l�neas de observaciones en diferentes l�neas
	    $pdf->Cell(1);
        $pdf->Cell(15,4,"",'LR',0,'C');
		$segundavez=substr($lafila[5],$indice,60);
        $pdf->Cell(105,4,$segundavez,'LR',0,'');
	    $pdf->Cell(20,4,"",'LR',0,'C');	
	    $pdf->Cell(15,4,"",'LR',0,'C');
	    $pdf->Cell(15,4,"",'LR',0,'C');
	    $pdf->Cell(20,4,"",'LR',0,'C');
	    $pdf->Ln(4);	
	    $contador=$contador+1;	
		$longitud=$longitud-60;
		$indice=$indice+60;
	  }	
	  
	    //imprimimos la �ltima l�nea de observaciones
	    $pdf->Cell(1);
        $pdf->Cell(15,4,"",'LR',0,'C');
		$segundavez=substr($lafila[5],$indice,60);
        $pdf->Cell(105,4,$segundavez,'LR',0,'');
	    $pdf->Cell(20,4,"",'LR',0,'C');	
	    $pdf->Cell(15,4,"",'LR',0,'C');
	    $pdf->Cell(15,4,"",'LR',0,'C');
	    $pdf->Cell(20,4,"",'LR',0,'C');
	    $pdf->Ln(4);	
	    $contador=$contador+1;	
	} 
}
?>