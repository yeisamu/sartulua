<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=parque_automotor.xls");
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexi�n a la db
include('../inc/operaciones.php');
$link=conectarse();
 $result = mysql_query("SELECT veh_dias_mora.id_movil,placa,clase,id_marca,marca,referencia,tipo,motor,serie,color,modelo,pago_hasta,dias_mora,grupo,tipov FROM veh_dias_mora left join (tipo_taxi inner join tipov on tipo_taxi.id_tipov=tipov.id_tipov) on veh_dias_mora.id_movil=tipo_taxi.id_movil order by tipov")
?>


<table width="110%" border="1" align="center"  class="ui-corner-all">
   <tr >
      <td colspan="2" class="ui-corner-all " ><div align="center">TRANSPORTES ARGELIA Y CAIRO </div></td>
   </tr>
   <tr >
      <td colspan="2" class="ui-corner-all " ><div align="center">RELACI&Oacute;N DE PARQUE AUTOMOTOR</div></td>
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
    <td width="16%" class="ui-corner-all ui-widget-header">MODELO</td>
    <td width="16%" class="ui-corner-all ui-widget-header">PAGO HASTA</td>
    <td width="16%" class="ui-corner-all ui-widget-header">DIAS MORA</td>
    <td width="16%" class="ui-corner-all ui-widget-header">GRUPO</td>
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
<td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['modelo'] ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['pago_hasta'] ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['dias_mora'] ?></td>
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
