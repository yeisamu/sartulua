<?php
// para utilizar la librería
define('FPDF_FONTPATH','font/');
require_once('fpdf.php');
require('mysql_table.php');
include("comunes.php");
include ("../conexion.php"); 
include ("../convertirfechas2.php");
$tarjeta=$_REQUEST['ntarjeta']; 
//$link=conectarse();
//Creación del objeto de la clase heredada
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$consulta = "SELECT * FROM (`tarjeta_control` a inner join (vehiculo d inner join marca e on d.id_marca=e.id_marca) on a.`id_movil`=d.`id_movil`) INNER JOIN conductor b  on a.`id_conductor`=b.`id_conductor` where `tarjeta`='$tarjeta'";
$resultado = mysql_query($consulta);
$lafila=mysql_fetch_array($resultado);
$id_cond=$lafila["id_conductor"];
$id_doc="licencia";
/////consulta licencia
$conli="select * from con_doc a inner join documento b on a.id_doc=b.id_doc where id_conductor=$id_cond and documento like '%$id_doc%'";
$res= mysql_query($conli);
$filali=mysql_fetch_array($res);
//Comenzamos a escribir el PDF:
//$pdf->SetFont('Arial','B',20); //<-- Tipo de letra arial, Bold, tamaño 20
  // <-- Cadena a escribir
	 $pdf->SetFont('Arial','',12);
	//$pdf->SetX(20);
	$pdf->Cell(77);
    $pdf->Cell(80,8,$tarjeta,0,0,1);
    $pdf->Ln(23);	
 $pdf->Cell(15);
    $pdf->Cell(80,85,$lafila["nombre1"].' '.$lafila["nombre2"],0,0,1);
    $pdf->Ln(4);		
	$pdf->Cell(15);
    $pdf->Cell(4,95,$lafila["apellido1"].' '.$lafila["apellido2"],0,0,1);
    $pdf->Ln(4);
	$pdf->Cell(15);
    $pdf->Cell(4,100,$lafila["codigo"],0,0,1);
  //  $pdf->Ln(6);
	$pdf->Cell(50);
    $pdf->Cell(10,102,$lafila["tipo_rh"],0,0,1);
    $pdf->Ln(4);
	$pdf->Cell(15);
    $pdf->Cell(4,110,$filali["numero"],0,0,1);
  //  $pdf->Ln(4);
	$pdf->Cell(40);
    $pdf->Cell(5,110,$filali["categoria"],0,0,1);
   // $pdf->Ln(2);
	$pdf->Cell(9);
    $pdf->Cell(5,110,$filali["fecha_vence"],0,0,1);
    $pdf->Ln(4);
	$pdf->Cell(3);
    $pdf->Cell(4,116,$lafila["direccion"],0,0,1);
   // $pdf->Ln(4);	
	$pdf->Cell(50);
    $pdf->Cell(4,116,$lafila["telefono"],0,0,1);
    $pdf->Ln(7);		
    $pdf->Cell(3);
    $pdf->Cell(7,135,$lafila["acudiente"],0,0,1);
  //  $pdf->Ln(1);
$pdf->Cell(28);
    $pdf->Cell(2,135,$lafila["telefonoa"],0,0,1);
   // $pdf->Ln(1);
	$pdf->Cell(20);
    $pdf->Cell(4,135,$lafila["celulara"],0,0,1);
   $pdf->Ln(50);
	 $pdf->Cell(15);
    $pdf->Cell(4,130,$lafila["marca"],0,0,1);
  //  $pdf->Ln(1);
	$pdf->Cell(51);
    $pdf->Cell(2,130,$lafila["modelo"],0,0,1);
    $pdf->Ln(2);
	$pdf->Cell(15);
    $pdf->Cell(2,140,$lafila["placa"],0,0,1);
//    $pdf->Ln(1);
	$pdf->Cell(53);
    $pdf->Cell(2,140,$lafila["id_movil"],0,0,1);
    $pdf->Ln(1);
//Terminamos el PDF y lo mandamos a la pantalla
$pdf->Output();
?>