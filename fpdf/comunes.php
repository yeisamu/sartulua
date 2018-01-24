<?php
class PDF extends FPDF
{
//Cabecera de página
function Header()
{

    //Logo
   //$this->Image('./logo/logo.jpg',15,8,70);
 $this->Image('./imagenes/transmariscal.JPG',0,0,215,250); 
  
  //  $this->Ln(4);	
	
	include ("../conexion.php"); 
   $consulta = "Select * from empresa";
   $resultado = mysql_query($consulta, $conexion);
   $lafila=mysql_fetch_array($resultado); 

   $filas=mysql_num_rows($resultado);
   if ($filas<>0)
     {   

    //Posición: a 1,5 cm del final
  //$this->SetY(21);
    //Arial italic 8
   // $this->SetFont('Arial','',7);
	$this->SetFont('Arial','B',12);
  // $this->Cell(1);

    //Número de página
/*	$numero=$lafila["codprovincia"];
	$consulta2="select * from provincias where codprovincia=$numero";
	$resultado2=mysql_query($consulta2,$conexion);
	$lafila2=mysql_fetch_array($resultado2);
	$provincia=$lafila2["denprovincia"];*/
	
   // $this->Cell(0,10,$lafila["nombre"],0,0,'C');
	 //   $this->Ln(2);	
	$this->SetFont('Arial','',7);
	//$this->Cell(5);
	//$this->Cell(250,4,"NIT.:  " . $lafila["nit"] ,0,0,'C');	
     //  $this->Ln(2);
    //$this->Cell(260,10,$lafila["direccion"] . "  Tlfno: " . $lafila["telefono"],0,0,'C');
   // $this->Ln(2);
	 
	 //$this->Cell(-100,15,$lafila["direccion"] . " -- " . $lafila["localidad"] . " -- " . $lafila["cp"] . " -- " . $provincia,0,0,'C');	
	//Posición: a 1,5 cm del final
   // $this->SetY(-18);
    //Arial italic 8
    //$this->SetFont('Arial','',7);
    //Número de página
    
	//$this->SetY(-15);
   // $this->Cell(265,15,$lafila["localidad"] . " -- " . $provincia,0,0,'C');		

    //Posición: a 1,5 cm del final
   // $this->SetY(-10);
    //Arial italic 8
    //$this->SetFont('Arial','',8);
    //Número de página
   // $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
      // $this->Ln(15);
	}
	/*else
	{
    //Posición: a 1,5 cm del final
    $this->SetY(-21);
    //Arial italic 8
    $this->SetFont('Arial','',7);
    //Número de página
    $this->Cell(0,10,'http://galopin.sinuh.org -- E-Mail: galopin@sinuh.org',0,0,'C');	
	
	//Posición: a 1,5 cm del final
    $this->SetY(-18);
    //Arial italic 8
    $this->SetFont('Arial','',7);
    //Número de página
    $this->Cell(0,10,'Proyecto Galopín Extremadura',0,0,'C');	
	

    //Posición: a 1,5 cm del final
    $this->SetY(-10);
    //Arial italic 8
    $this->SetFont('Arial','',8);
    //Número de página
    $this->Cell(0,10,'-- '.$this->PageNo().' --',0,0,'C');	
	}*/
	
}

//Pie de página
function Footer()
{

   include ("../conexion.php"); 
   $consulta = "Select * from empresa";
   $resultado = mysql_query($consulta, $conexion);
   $lafila=mysql_fetch_array($resultado); 

   $filas=mysql_num_rows($resultado);
   if ($filas<>0)
     {   

    //Posición: a 1,5 cm del final
   // $this->SetY(-21);
    //Arial italic 8
    $this->SetFont('Arial','',7);
    //Número de página
	/*$numero=$lafila["codprovincia"];
	$consulta2="select * from provincias where codprovincia=$numero";
	$resultado2=mysql_query($consulta2,$conexion);
	$lafila2=mysql_fetch_array($resultado2);*/
	//$provincia=$lafila2["denprovincia"];
	
    //$this->Cell(0,10,$lafila["nombre"] . " -- " .  $lafila["direccion"],0,0,'C');	
	
	//Posición: a 1,5 cm del final
    $this->SetY(-18);
    //Arial italic 8
    $this->SetFont('Arial','',7);
    //Número de página
  //  $this->Cell(0,10,"NIT.:  " . $lafila["nit"] . "  Tlfno: " . $lafila["telefono"],0,0,'C');	

	$this->SetY(-15);
   // $this->Cell(0,10,"Web.:  ",0,0,'C');		

    //Posición: a 1,5 cm del final
    $this->SetY(-10);
    //Arial italic 8
    $this->SetFont('Arial','',8);
    //Número de página
   // $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
	else
	{
    //Posición: a 1,5 cm del final
    $this->SetY(-21);
    //Arial italic 8
    $this->SetFont('Arial','',7);
    //Número de página
    $this->Cell(0,10,'http://.sinuh.org -- E-Mail: @sinuh.org',0,0,'C');	
	
	//Posición: a 1,5 cm del final
    $this->SetY(-18);
    //Arial italic 8
    $this->SetFont('Arial','',7);
    //Número de página
    $this->Cell(0,10,'Proyecto ',0,0,'C');	
	

    //Posición: a 1,5 cm del final
    $this->SetY(-10);
    //Arial italic 8
    $this->SetFont('Arial','',8);
    //Número de página
    $this->Cell(0,10,'-- '.$this->PageNo().' --',0,0,'C');	
	}
}
}
?>