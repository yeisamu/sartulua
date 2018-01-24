<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=reporte_docs_vehi.xls");
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
include('../inc/operaciones.php');
$link=conectarse();
 $result = mysql_query("SELECT propietario.`id_prop`, nombre,apellidos,descripcion,fecha_ven,vehiculo.id_movil,placa,grupo FROM (vehiculo inner join (veh_doc inner join documentos_v on veh_doc.id_documento=documentos_v.id_documento) on vehiculo.id_movil=veh_doc.id_movil) inner join propietario on vehiculo.id_prop=propietario.id_prop WHERE fecha_ven < now()   order by nombre,apellidos asc ,fecha_ven desc")
?>


<table width="110%" border="1" align="center"  class="ui-corner-all">
   <tr >
      <td colspan="2" class="ui-corner-all " ><div align="center">TRANSPORTES ARGELIA Y CAIRO </div></td>
   </tr>
   <tr >
      <td colspan="2" class="ui-corner-all " ><div align="center">RELACI&Oacute;N DE DOCUMENTOS DE VEHICULOS  </div></td>
   </tr>
   <tr >
      <td colspan="2" class="ui-corner-all " ><table width="100%" border="1" class="ui-corner-all">
 <!-- <tr>
    <td colspan="8" class="ui-corner-all"><div align="center">DESDE : <?php echo $fechaini ?> HASTA : <?php echo $fechafinmov ?></div></td>
    </tr> -->
  <tr>
    <td width="10%" class="ui-corner-all ui-widget-header "><div align="center">CEDULA </div></td>
    <td width="8%" class="ui-corner-all ui-widget-header"><div align="center">NOMBRES</div></td>
    <td width="10%" class="ui-corner-all ui-widget-header"><div align="center">APELLIDOS</div></td>
	    <td width="10%" class="ui-corner-all ui-widget-header "><div align="center">MOVIL </div></td>
    <td width="8%" class="ui-corner-all ui-widget-header"><div align="center">PLACA</div></td>
    <td width="10%" class="ui-corner-all ui-widget-header"><div align="center">GRUPO</div></td>
    <td width="22%" class="ui-corner-all ui-widget-header"><div align="center">DOCUMENTO</div></td>
	<td width="11%" class="ui-corner-all ui-widget-header">FECHA VENCE</td>
  
  </tr>
  
  <?php
  $i=0;
  while($filamov=mysql_fetch_array($result)){

  ?>
  
  <tr>
    <td ><?php echo $filamov['id_prop']?></td>
    <td ><?php echo  $filamov['nombre'] ?></td>
    <td><?php echo $filamov['apellidos']?></td>
	  <td  style="mso-number-format:'@'"  ><?php echo $filamov['id_movil']?></td>
    <td ><?php echo  $filamov['placa'] ?></td>
    <td><?php echo $filamov['apellidos']?></td>
    <td ><?php echo $filamov['descripcion']?></td>
	<td ><?php echo $filamov['fecha_ven'] ?></td>
	
  </tr>

    <?php
	$i++;
	  
  }

  ?>
</table></td>
   </tr>
   <tr >
   
</table>
