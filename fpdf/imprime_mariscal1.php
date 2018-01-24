<?php
include ("../conexion.php"); 
 $tarjeta=$_REQUEST['ntarjeta']; 
 $consulta = "SELECT * FROM (`tarjeta_control` a inner join (vehiculo d inner join marca e on d.id_marca=e.id_marca) on a.`id_movil`=d.`id_movil`) INNER JOIN conductor b  on a.`id_conductor`=b.`id_conductor` where `id_tarjeta`=$tarjeta";
$resultado = mysql_query($consulta);
$lafila=mysql_fetch_array($resultado);
$id_cond=$lafila["id_conductor"];
$id_doc="licencia";
/////consulta licencia
$conli="select * from con_doc a inner join documento b on a.id_doc=b.id_doc where id_conductor=$id_cond and documento like '%$id_doc%'";
$res= mysql_query($conli);
$filali=mysql_fetch_array($res);
$id_movil=$lafila["id_movil"];


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<script language="javascript">
function imprimir() {
	window.print();
	//window.close();
}
</script>
<style type="text/css">
<!--
#Layer1 {
	position:absolute;
	width:224px;
	height:25px;
	z-index:1;
	left: 110px;
	top: 273px;
	font-family:"Times New Roman", Times, serif;
}
#Layer2 {
	position:absolute;
	width:220px;
	height:22px;
	z-index:2;
	left: 110px;
	top: 303px;
	font-family:"Times New Roman", Times, serif;
}
#Layer3 {
	position:absolute;
	width:153px;
	height:23px;
	z-index:3;
	left: 95px;
	top: 333px;
	font-family:"Times New Roman", Times, serif;
}
#Layer4 {
	position:absolute;
	width:72px;
	height:27px;
	z-index:4;
	left: 362px;
	top: 328px;
	font-family:"Times New Roman", Times, serif;
}
#Layer5 {
	position:absolute;
	width:154px;
	height:21px;
	z-index:5;
	left: 77px;
	top: 359px;
	font-family:"Times New Roman", Times, serif;
}
#Layer6 {
	position:absolute;
	width:43px;
	height:21px;
	z-index:6;
	left: 265px;
	top: 361px;
	font-family:"Times New Roman", Times, serif;
}
#Layer7 {
	position:absolute;
	width:104px;
	height:22px;
	z-index:7;
	left: 324px;
	top: 361px;
	font-family:"Times New Roman", Times, serif;
}
#Layer8 {
	position:absolute;
	width:174px;
	height:22px;
	z-index:8;
	left: 74px;
	top: 385px;
	font-family:"Times New Roman", Times, serif;
}
#Layer9 {
	position:absolute;
	width:114px;
	height:22px;
	z-index:1;
	left: 298px;
	top: 385px;
	font-family:"Times New Roman", Times, serif;
}
#Layer10 {
	position:absolute;
	width:142px;
	height:22px;
	z-index:9;
	left: 71px;
	top: 448px;
	font-family:"Times New Roman", Times, serif;
}
#Layer11 {
	position:absolute;
	width:96px;
	height:22px;
	z-index:10;
	left: 221px;
	top: 448px;
	font-family:"Times New Roman", Times, serif;
}
#Layer12 {
	position:absolute;
	width:135px;
	height:22px;
	z-index:11;
	left: 323px;
	top: 447px;
	font-family:"Times New Roman", Times, serif;
}
#Layer13 {
	position:absolute;
	width:112px;
	height:22px;
	z-index:12;
	left: 109px;
	top: 622px;
	font-family:"Times New Roman", Times, serif;
}
#Layer14 {
	position:absolute;
	width:76px;
	height:22px;
	z-index:13;
	left: 349px;
	top: 620px;
	font-family:"Times New Roman", Times, serif;
}
#Layer15 {
	position:absolute;
	width:85px;
	height:22px;
	z-index:14;
	left: 110px;
	top: 649px;
	font-family:"Times New Roman", Times, serif;
}
#Layer16 {
	position:absolute;
	width:76px;
	height:22px;
	z-index:15;
	left: 348px;
	top: 649px;
	font-family:"Times New Roman", Times, serif;
}
#Layer17 {
	position:absolute;
	width:136px;
	height:22px;
	z-index:16;
	left: 92px;
	top: 705px;
	font-family:"Times New Roman", Times, serif;
}
#Layer18 {
	position:absolute;
	width:104px;
	height:22px;
	z-index:17;
	left: 315px;
	top: 701px;
	font-family:"Times New Roman", Times, serif;
}
#Layer19 {
	position:absolute;
	width:103px;
	height:22px;
	z-index:18;
	left: 181px;
	top: 733px;
	font-family:"Times New Roman", Times, serif;
}
#Layer20 {
	position:absolute;
	width:107px;
	height:22px;
	z-index:19;
	left: 315px;
	top: 733px;
	font-family:"Times New Roman", Times, serif;
}
#Layer21 {
	position:absolute;
	width:95px;
	height:22px;
	z-index:20;
	left: 178px;
	top: 762px;
	font-family:"Times New Roman", Times, serif;
}
#Layer22 {
	position:absolute;
	width:108px;
	height:22px;
	z-index:21;
	left: 315px;
	top: 762px;
	font-family:"Times New Roman", Times, serif;
}
#Layer23 {
	position:absolute;
	width:83px;
	height:22px;
	z-index:22;
	left: 181px;
	top: 790px;
	font-family:"Times New Roman", Times, serif;
}
#Layer24 {
	position:absolute;
	width:105px;
	height:22px;
	z-index:23;
	left: 315px;
	top: 791px;
	font-family:"Times New Roman", Times, serif;
}
#Layer25 {
	position:absolute;
	width:98px;
	height:22px;
	z-index:24;
	left: 181px;
	top: 678px;
	font-family:"Times New Roman", Times, serif;
}
#Layer26 {
	position:absolute;
	width:104px;
	height:22px;
	z-index:25;
	left: 315px;
	top: 675px;
	font-family:"Times New Roman", Times, serif;
}
#Layer27 {
	position:absolute;
	width:100px;
	height:31px;
	z-index:26;
	font-family:"Times New Roman", Times, serif;
}
-->
</style>
</head>
<!-- background="imagenes/transmariscal.JPG" -->
<body onLoad="imprimir()" background="imagenes/transmariscal.JPG" >
<div id="Layer1"><?php echo $lafila["nombre1"].' '.$lafila["nombre2"] ?></div>
<div id="Layer2"><?php echo $lafila["apellido1"].' '.$lafila["apellido2"]?></div>
<div id="Layer3"><?php echo $lafila["codigo"]?></div>
<div id="Layer4"><?php echo $lafila["tipo_rh"]?></div>
<div id="Layer5"><?php echo $filali["numero"]?></div>
<div id="Layer6"><?php echo $filali["categoria"]?></div>
<div id="Layer7"><?php echo $filali["fecha_vigencia"]?></div>
<div id="Layer8"><?php echo $lafila["direccion"]?></div>
  <div id="Layer9"><?php echo $lafila["telefono"]?></div>

<div id="Layer10"><?php echo $lafila["acudiente"]?></div>
<div id="Layer11"><?php echo $lafila["telefonoa"]?></div>




<div id="Layer12"><?php echo $lafila["celulara"]?></div>
<div id="Layer13"><?php echo $lafila["marca"]?></div>
<div id="Layer14"><?php echo $lafila["modelo"]?></div>
<div id="Layer15"><?php echo $lafila["placa"]?></div>
<div id="Layer16"><?php echo $lafila["id_movil"]?></div>
<?php 
$consoat="select * from veh_doc a inner join documentos_v b on a.id_documento=b.id_documento where id_movil='$id_movil' and descripcion LIKE '%SOAT%' ";
$resoat= mysql_query($consoat);
$filasoat=mysql_fetch_array($resoat)

?>


<div id="Layer17"><?php echo $filasoat['numero']?></div>
<div id="Layer18"><?php echo $filasoat['fecha_ven']?></div>
<div id="Layer19"><?php $conoper="select * from veh_doc a inner join documentos_v b on a.id_documento=b.id_documento where id_movil='$id_movil' and descripcion LIKE '%CONTRACTUAL%' ";
$resoper= mysql_query($conoper);
$filaoper=mysql_fetch_array($resoper);echo $filaoper['numero']?></div>
<div id="Layer20"><?php echo $filaoper['fecha_ven']?></div>
<div id="Layer21"><?php $concontra="select * from veh_doc a inner join documentos_v b on a.id_documento=b.id_documento where id_movil='$id_movil' and descripcion LIKE '%OPERACION%' ";
$rescontra= mysql_query($concontra);
$filacontra=mysql_fetch_array($rescontra);echo $filacontra['numero']?></div>
<div id="Layer22"><?php echo $filacontra['fecha_ven']?></div>
<div id="Layer23"><?php $conmovi="select * from veh_doc a inner join documentos_v b on a.id_documento=b.id_documento where id_movil='$id_movil' and descripcion LIKE '%MOVILIZACION%' ";
$resmovi= mysql_query($conmovi);
$filamovi=mysql_fetch_array($resmovi);echo $filamovi['numero']?></div>
<div id="Layer24"><?php echo $filamovi['fecha_ven']?></div>
<div id="Layer25"><?php $conamb="select * from veh_doc a inner join documentos_v b on a.id_documento=b.id_documento where id_movil='$id_movil' and descripcion LIKE '%AMBIENTE%' ";
$resamb= mysql_query($conamb);
$filamb=mysql_fetch_array($resamb);echo $filamb['numero']?></div>
<div id="Layer26"><?php echo $filamb['fecha_ven']?></div>
</body>
</html>
