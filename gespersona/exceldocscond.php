<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=reporte_docs_condu.xls");
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexi�n a la db
include('../inc/operaciones.php');
$link=conectarse();
 $result = mysql_query("SELECT conductor.`id_conductor`,codigo,nombre1,nombre2,apellido1,apellido2,documento,fecha_vence FROM conductor inner join (con_doc inner join documento on con_doc.id_doc=documento.id_doc) ON conductor.`id_conductor` = con_doc.`id_conductor` WHERE fecha_vence < now() and documento.id_doc=20  order by fecha_vence desc")
?>


<table width="110%" border="1" align="center"  class="ui-corner-all">
   <tr >
      <td colspan="2" class="ui-corner-all " ><div align="center">TRANSPORTES ARGELIA Y CAIRO </div></td>
   </tr>
   <tr >
      <td colspan="2" class="ui-corner-all " ><div align="center">RELACI&Oacute;N DE DOCUMENTOS CONDUCTORES  </div></td>
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
    <td width="22%" class="ui-corner-all ui-widget-header"><div align="center">DOCUMENTO</div>      <div align="center"></div></td>
	<td width="11%" class="ui-corner-all ui-widget-header">FECHA VENCE</td>
  
  </tr>
  
  <?php
  $i=0;
  while($filamov=mysql_fetch_array($result)){

  ?>
  
  <tr>
    <td ><?php echo $filamov['codigo']?></td>
    <td ><?php echo  $filamov['nombre1'].' '.$filamov['nombre2'] ?></td>
    <td><?php echo $filamov['apellido1'].' '.$filamov['apellido2']?></td>
    <td ><?php echo $filamov['documento']?></td>
	<td ><?php echo $filamov['fecha_vence'] ?></td>
	
  </tr>

    <?php
	$i++;
	  
  }

  ?>
</table></td>
   </tr>
   <tr >
   
</table>
