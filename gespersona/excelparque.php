<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=parque_automotor.xls");
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
include('../inc/operaciones.php');
$link=conectarse();
 $result = mysql_query("SELECT vehiculo.id_movil,placa,clase,vehiculo.id_marca,marca,referencia,tipo,motor,serie,color,modelo,grupo,vehiculo.id_prop,concat_ws(' ',nombre,apellidos) as propietario,telefono,tipov,case estado when 1 then 'Vinculado' when 0 then 'Desvinculado' end as estado,case poliza when 1 then 'Incluido' when 0 then 'Excluido' end as poliza FROM ((vehiculo inner join propietario on vehiculo.id_prop=propietario.id_prop) inner join marca on vehiculo.id_marca=marca.id_marca) left join (tipo_taxi inner join tipov on tipo_taxi.id_tipov=tipov.id_tipov) on vehiculo.id_movil=tipo_taxi.id_movil where 1 order by estado desc,poliza desc")
?>


<table width="110%" border="1" align="center"  class="ui-corner-all">
   <tr >
      <td colspan="2" class="ui-corner-all " ><div align="center">TRANSPORTES ARGELIA Y CAIRO </div></td>
   </tr>
   <tr >
      <td colspan="2" class="ui-corner-all " ><div align="center">RELACI&Oacute;N DE PARQUE AUTOMOTOR VINCULADO</div></td>
   </tr>
   <tr >
      <td colspan="2" class="ui-corner-all " ><table width="100%" border="1" class="ui-corner-all">
 
  <tr>
    <td width="10%" class="ui-corner-all ui-widget-header "><div align="center">MOVIL </div></td>
    <td width="8%" class="ui-corner-all ui-widget-header"><div align="center">PLACA</div></td>
    <td width="10%" class="ui-corner-all ui-widget-header"><div align="center">TIPO VEHICULO</div></td>
    <td width="22%" class="ui-corner-all ui-widget-header"><div align="center">CLASE</div>      <div align="center"></div></td>
	<td width="11%" class="ui-corner-all ui-widget-header">MARCA</td>
    <td width="11%" class="ui-corner-all ui-widget-header"><div align="center">REFERENCIA</div></td>
    <td width="16%" class="ui-corner-all ui-widget-header"><div align="center">TIPO</div></td>
    <td width="16%" class="ui-corner-all ui-widget-header">MOTOR</td>
    <td width="16%" class="ui-corner-all ui-widget-header">SERIE</td>
    <td width="16%" class="ui-corner-all ui-widget-header">COLOR</td>
    <td width="16%" class="ui-corner-all ui-widget-header">DOCUMENTO</td>
    <td width="16%" class="ui-corner-all ui-widget-header">PROPIETARIO</td>
    <td width="16%" class="ui-corner-all ui-widget-header">TELEFONO</td>
    <td width="16%" class="ui-corner-all ui-widget-header">GRUPO</td>
	<td width="16%" class="ui-corner-all ui-widget-header">ESTADO</td>
    <td width="16%" class="ui-corner-all ui-widget-header">POLIZA</td>
  </tr>
  
  <?php
  $i=0;
  while($filamov=mysql_fetch_array($result)){
  
  ?>
  
  <tr>
    <td ><div align="center"><?php echo $filamov['id_movil']?></div></td>
    <td ><div align="center"><?php echo  $filamov['placa']?></div></td>
    <td><?php echo $filamov['tipov']?></td>
    <td ><?php echo $filamov['clase']?></td>
	<td ><?php echo $filamov['marca'] ?></td>
	<td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['referencia'] ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><div align="right"><?php echo $filamov['tipo'] ?></div></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['motor'] ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['serie'] ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['color'] ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['id_prop'] ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['propietario'] ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['telefono'] ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['grupo'] ?></td>
	 <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['estado'] ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['poliza'] ?></td>
  </tr>

    <?php
	$i++;
	  
  }

  ?>
</table></td>
   </tr>
   <tr >
   
</table>
