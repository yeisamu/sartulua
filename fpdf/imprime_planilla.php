<?php
session_start();
$login=$_SESSION['login'];
include ("../conexion.php");

$idtarjeta=$_REQUEST['id_tarj'];
$planilla=$_REQUEST['planilla'];
/*$idtarjeta=2557;
$planilla=1938;*/
 $selectarj = "SELECT * FROM (((tarjeta_control a inner join planilla on a.`id_tarjeta`=planilla.`id_tarjeta` )  inner join (vehiculo d inner join marca e on d.id_marca=e.id_marca) on a.id_movil=d.id_movil) inner join empresa c on a.id_empresa=c.id_empresa) inner join conductor b on a.id_conductor=b.id_conductor where planilla.id_tarjeta =$idtarjeta and id_planilla=$planilla";
$selectarj = mysql_query("SELECT * FROM (((tarjeta_control a inner join planilla on a.`id_tarjeta`=planilla.`id_tarjeta` )  inner join (vehiculo d inner join marca e on d.id_marca=e.id_marca) on a.id_movil=d.id_movil) inner join empresa c on a.id_empresa=c.id_empresa) inner join conductor b on a.id_conductor=b.id_conductor where planilla.id_tarjeta =$idtarjeta and id_planilla=$planilla");
$filaplan=mysql_fetch_array($selectarj);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>IMPRIMIR PLANILLA</title>
<style type="text/css">
<!--
#Layer1 {
	position:absolute;
	width:455px;
	height:21px;
	z-index:1;
	left: 48px;
	top: 115px;
	font-family:"Times New Roman", Times, serif;
	font-size:20px;
	font-weight:600
}
#Layer2 {
	position:absolute;
	width:25px;
	height:19px;
	z-index:2;
	left: 601px;
	top: 129px;
	font-family:"Times New Roman", Times, serif;
	font-size:20px;
	font-weight:600
}
#Layer3 {
	position:absolute;
	width:168px;
	height:20px;
	z-index:3;
	left: 768px;
	top: 129px;
	font-family:"Times New Roman", Times, serif;
font-size:20px;
	font-weight:600
}
#Layer4 {
	position:absolute;
	width:158px;
	height:19px;
	z-index:4;
	left: 87px;
	top: 172px;
	font-family:"Times New Roman", Times, serif;
font-size:20px;
	font-weight:600
}
#Layer5 {
	position:absolute;
	width:123px;
	height:20px;
	z-index:5;
	left: 374px;
	top: 173px;
	font-family:"Times New Roman", Times, serif;
font-size:20px;
	font-weight:600
}
#Layer6 {
	position:absolute;
	width:150px;
	height:20px;
	z-index:6;
	left: 606px;
	top: 176px;
	font-family:"Times New Roman", Times, serif;
font-size:20px;
	font-weight:600
}
#Layer7 {
	position:absolute;
	width:114px;
	height:18px;
	z-index:7;
	left: 856px;
	top: 179px;
	font-family:"Times New Roman", Times, serif;
font-size:20px;
	font-weight:600	
}
#Layer8 {
	position:absolute;
	width:346px;
	height:20px;
	z-index:8;
	left: 115px;
	top: 233px;
	font-family:"Times New Roman", Times, serif;
font-size:20px;
	font-weight:600
}
#Layer9 {
	position:absolute;
	width:157px;
	height:22px;
	z-index:9;
	left: 781px;
	top: 235px;
	font-family:"Times New Roman", Times, serif;
font-size:20px;
	font-weight:600
}
#Layer10 {
	position:absolute;
	width:23px;
	height:18px;
	z-index:10;
	left: 541px;
	top: 240px;
	font-family:"Times New Roman", Times, serif;
font-size:20px;
	font-weight:600
}
#Layer11 {
	position:absolute;
	width:23px;
	height:17px;
	z-index:11;
	left: 603px;
	top: 240px;
	font-family:"Times New Roman", Times, serif;
font-size:20px;
	font-weight:600
}
#Layer12 {
	position:absolute;
	width:360px;
	height:19px;
	z-index:12;
	left: 65px;
	top: 279px;
	font-family:"Times New Roman", Times, serif;
font-size:20px;
	font-weight:600
}
#Layer13 {
	position:absolute;
	width:108px;
	height:20px;
	z-index:13;
	left: 606px;
	top: 281px;
	font-family:"Times New Roman", Times, serif;
font-size:20px;
	font-weight:600
}
#Layer14 {
	position:absolute;
	width:89px;
	height:16px;
	z-index:14;
	left: 890px;
	top: 286px;
	font-family:"Times New Roman", Times, serif;
font-size:20px;
	font-weight:600
}
#Layer15 {
	position:absolute;
	width:128px;
	height:18px;
	z-index:15;
	left: 45px;
	top: 333px;
	font-family:"Times New Roman", Times, serif;
font-size:20px;
	font-weight:600
}
#Layer16 {
	position:absolute;
	width:116px;
	height:20px;
	z-index:16;
	left: 256px;
	top: 333px;
	font-family:"Times New Roman", Times, serif;
font-size:20px;
	font-weight:600
}
#Layer17 {
	position:absolute;
	width:150px;
	height:20px;
	z-index:17;
	left: 474px;
	top: 336px;
	font-family:"Times New Roman", Times, serif;
font-size:20px;
	font-weight:600
}
#Layer18 {
	position:absolute;
	width:157px;
	height:18px;
	z-index:18;
	left: 787px;
	top: 335px;
	font-family:"Times New Roman", Times, serif;
font-size:20px;
	font-weight:600
}
#Layer19 {
	position:absolute;
	width:125px;
	height:22px;
	z-index:19;
	left: 72px;
	top: 389px;
	font-family:"Times New Roman", Times, serif;

font-size:20px;
	font-weight:600
}
#Layer20 {
	position:absolute;
	width:191px;
	height:21px;
	z-index:20;
	left: 415px;
	top: 392px;
	font-family:"Times New Roman", Times, serif;
font-size:20px;
	font-weight:600
}
#Layer21 {
	position:absolute;
	width:129px;
	height:19px;
	z-index:21;
	left: 835px;
	top: 391px;
	font-family:"Times New Roman", Times, serif;
font-size:20px;
	font-weight:600
}
#Layer22 {
	position:absolute;
	width:248px;
	height:21px;
	z-index:22;
	left: 60px;
	top: 436px;
	font-family:"Times New Roman", Times, serif;
font-size:20px;
	font-weight:600
}
#Layer23 {
	position:absolute;
	width:111px;
	height:18px;
	z-index:23;
	left: 766px;
	top: 448px;
	font-family:"Times New Roman", Times, serif;
font-size:20px;
	font-weight:600
}
#Layer24 {
	position:absolute;
	width:113px;
	height:22px;
	z-index:24;
	left: 436px;
	top: 445px;
	font-family:"Times New Roman", Times, serif;
font-size:20px;
	font-weight:600
}
#Layer25 {
	position:absolute;
	width:42px;
	height:24px;
	z-index:25;
	left: 943px;
	top: 449px;
	font-family:"Times New Roman", Times, serif;
font-size:20px;
	font-weight:600
}
-->
</style>
<script language="javascript">
function imprimir() {
	window.print();
	//window.close();
}
</script>
</head>

<body onLoad="imprimir()" style="/*background-image:url(imagenes/planilla2.JPG);*/ background-attachment: fixed; background-repeat: no-repeat;">
<div id="Layer1"><?php echo $filaplan['nombre'];?></div>
<div id="Layer2"><strong>X</strong></div>
<div id="Layer3"><?php echo $filaplan['nit'];?></div>
<div id="Layer4"><?php echo strtoupper($filaplan['ciudad_o']);?></div>
<div id="Layer5"><?php  $fini=$filaplan['fecha_inicio'];  echo date('d/m/Y',strtotime($fini))?></div>
<div id="Layer6"><?php echo strtoupper($filaplan['ciudad_d']);?></div>
<div id="Layer7"><?php  $fin=$filaplan['fecha_retorno']; echo date('d/m/Y',strtotime($fin))?></div>
<div id="Layer8"><?php echo strtoupper($filaplan['contra']);?></div>
<div id="Layer9"><?php echo $filaplan['doc'];?></div>
<div id="Layer10"><?php  $tipodocscon=$filaplan['tipo_doc']; if($tipodocscon=='NIT'){ echo "X";} ?></div>
<div id="Layer11"><?php if($tipodocscon=='CC'){ echo "X";} ?></div>
<div id="Layer12"><?php echo strtoupper($filaplan['dircontra']);?></div>
<div id="Layer13"><?php echo "3174286273";//$filaplan['telcontra'];?></div>
<div id="Layer14"><?php echo strtoupper($filaplan['npasajero']);?></div>
<div id="Layer15"><?php echo $filaplan['placa'];?></div>
<div id="Layer16"><?php echo $filaplan['clase'];?></div>
<div id="Layer17"><?php echo $filaplan['marca'];?></div>
<div id="Layer18"><?php echo $filaplan['modelo'];?></div>
<div id="Layer19"><?php $movil=$filaplan['id_movil'];
		   $consoat= mysql_query("select * from veh_doc where id_movil=$movil and id_documento=1 ");
		   $filasoat=mysql_fetch_array($consoat);
		   echo $filasoat['numero'];
		  ?></div>
<div id="Layer22"><?php echo strtoupper($filaplan['nombre1'].' '.$filaplan['nombre2'].' '.$filaplan['apellido1'].' '.$filaplan['apellido2']);?></div>
<div id="Layer23"><?php $id_cond=$filaplan['id_conductor'];
	       $conlicencia= mysql_query("select * from con_doc where id_conductor=$id_cond and id_doc=20 ");
		   $filalicencia=mysql_fetch_array($conlicencia);
	  echo $filalicencia['numero'];?></div>
<div id="Layer20"><?php echo strtoupper($filaplan['compania']);?></div>
<div id="Layer21"><?php  //$movil=$filaplan['id_movil'];
		   $conoper= mysql_query("select * from veh_doc where id_movil=$movil and id_documento=2 ");
		   $filaoper=mysql_fetch_array($conoper);
		   echo $filaoper['numero']?></div>
<div id="Layer24"><?php echo $filaplan['codigo'];?></div>
<div id="Layer25"><?php echo $filalicencia['categoria'];?></div>
</body>
</html>
