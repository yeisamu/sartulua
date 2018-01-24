<?php 
session_start();
$login=$_SESSION['login'];
include('../inc/libreria.php');
$link=conectarse();
$id_movil =$_REQUEST['idmovil'];
$anio =$_REQUEST['anio'];
$consulta=mysql_query("select `n_planilla` , `fecha` , `destino` from reporte_planilla where id_movil='$id_movil' and year(fecha)='$anio'");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<table width="100%" border="1" align="center" class=" ui-corner-all  ">
  <tr>
    <td colspan="3"  class="titulos ui-corner-all">Planilla Elaboradas al Movil <?php echo $id_movil." En el año ".$anio?>  </td>
  </tr>
  <tr class="ui-widget-header" >
    <td width="21%"><div align="center">Planilla # </div></td>
    <td width="43%"> <div align="center">Fecha </div></td>
    <td width="36%"> <div align="center">Destino </div></td>
  </tr>
  <?php 
  $a=0;
  while($fila=mysql_fetch_array($consulta)){
  if($a%2==0){
$estilo="ui-widget-content";
  }else{
  
    $estilo="ui-state-hover";
  }
  ?>
  <tr>
    <td class="<?php echo $estilo?>"><?php echo $fila['n_planilla']?></td>
    <td class="<?php echo $estilo?>"><?php echo $fila['fecha']?></td>
	 <td class="<?php echo $estilo?>"><?php echo $fila['destino']?></td>
  </tr>
  <?php
  $a++;
  }
  ?>
  <tr>
    <td colspan="3">  <div align="center">
      <input type="button" name="cancelatc" value="Salir"  class="fm-button ui-state-default ui-corner-all fm-button-icon-left"onclick="javascript:jQuery('#pl').dialog( 'close' );" />
    </div></td>
  </tr>
</table>

</body>
</html>
