<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=relacion_vehiculo_propietario.xls");
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
include('../inc/operaciones.php');
$link=conectarse();
 $result = mysql_query("select *  from (vehiculo inner join marca on vehiculo.id_marca=marca.id_marca) left join propietario on vehiculo.id_prop=propietario.id_prop")
?>


<table width="110%" border="1" align="center"  class="ui-corner-all">
   <tr >
      <td colspan="2" class="ui-corner-all " ><div align="center">TRANSPORTES ARGELIA Y CAIRO </div></td>
   </tr>
   <tr >
      <td colspan="2" class="ui-corner-all " ><div align="center">RELACI&Oacute;N DE VEHICULOS Y PROPIETARIOS</div></td>
   </tr>
   <tr >
      <td colspan="2" class="ui-corner-all " ><table width="100%" border="1" class="ui-corner-all">
 <!-- <tr>
    <td colspan="8" class="ui-corner-all"><div align="center">DESDE : <?php echo $fechaini ?> HASTA : <?php echo $fechafinmov ?></div></td>
    </tr> -->
  <tr>
<td width="11%" class="ui-corner-all ui-widget-header">MOVIL</td>
     <td width="22%" class="ui-corner-all ui-widget-header"><div align="center">CEDULA</div></td>
    <td width="8%" class="ui-corner-all ui-widget-header"><div align="center">NOMBRES</div></td>
    <td width="10%" class="ui-corner-all ui-widget-header"><div align="center">APELLIDOS</div></td>
   <td width="10%" class="ui-corner-all ui-widget-header "><div align="center">DIRECCION </div></td>
	
    <td width="11%" class="ui-corner-all ui-widget-header"><div align="center">TELEFONO</div></td>
    <td width="16%" class="ui-corner-all ui-widget-header"><div align="center">FECHA</div></td>
    <td width="16%" class="ui-corner-all ui-widget-header">PLACA</td>
    <td width="16%" class="ui-corner-all ui-widget-header">CLASE</td>
    <td width="16%" class="ui-corner-all ui-widget-header">MARCA</td>

  <td width="10%" class="ui-corner-all ui-widget-header"><div align="center">REFERENCIA</div></td>
   <td width="10%" class="ui-corner-all ui-widget-header "><div align="center">TIPO </div></td>
	
    <td width="11%" class="ui-corner-all ui-widget-header"><div align="center">MOTOR</div></td>
    <td width="16%" class="ui-corner-all ui-widget-header"><div align="center">SERIE</div></td>
    <td width="16%" class="ui-corner-all ui-widget-header">COLOR</td>
    <td width="16%" class="ui-corner-all ui-widget-header">MODELO</td>
    <td width="16%" class="ui-corner-all ui-widget-header">GRUPO</td>
   
  </tr>
  
  <?php
  $i=0;
  while($filamov=mysql_fetch_array($result)){
  
  ?>
  
  <tr>
    <td ><div align="center"><?php echo $filamov['id_movil']?></div></td>
    <td ><div align="center"><?php echo $filamov['id_prop']?></div></td>
    <td ><div align="center"><?php echo  $filamov['nombre']?></div></td>
    <td><?php echo $filamov['apellidos']?></td>
    <td ><?php echo $filamov['direccion']?></td>
	<td ><?php echo $filamov['telefono'] ?></td>
	<td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['fecha_nac'] ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><div align="right"><?php echo $filamov['placa'] ?></div></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['clase']  ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['marca'] ?></td>
   <td><?php echo $filamov['referencia']?></td>
    <td ><?php echo $filamov['tipo']?></td>
	<td ><?php echo $filamov['motor'] ?></td>
	<td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['serie'] ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><div align="right"><?php echo $filamov['color'] ?></div></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['modelo']  ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['grupo'] ?></td>
   
  </tr>

    <?php
	$i++;
	  
  }

  ?>
</table></td>
   </tr>
   <tr >
   
</table>
