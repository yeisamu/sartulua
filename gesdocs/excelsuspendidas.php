<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=reporte_simit_suspendidas.xls");
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
include('../inc/operaciones.php');
$link=conectarse();
 $result = mysql_query("SELECT b.`id_conductor`,id_simit,codigo,nombre1,nombre2,apellido1,apellido2,n_parte,`cod_infraccion`,eps,`valor`,`fecha_parte`,`fecha_pago`,case simit.`estado` WHEN 1 THEN 'Activa' WHEN 2 THEN 'Pago' WHEN 3 THEN 'Sin Multas' WHEN 4 THEN 'Multas Con Convenio' END as  estado,convenio,observacion ,`id_tarjeta`,`tarjeta`,a.`id_movil` as id_movil, fecha_vigencia,fecha_plazo_a,if(`fecha_plazo_a`<DATE_FORMAT(now(),'%Y/%m/%d %H:%i'),'Suspendido','Permitido') as servicio ,est_ant,if(`fecha_plazo_a`<DATE_FORMAT(now(),'%Y/%m/%d %H:%i'),'0','1') as est_new,grupo,placa FROM ((tarjeta_control a inner join (simit  inner join entidad_salud on simit.`id_eps`=entidad_salud.`id_eps`) on a.id_conductor=simit.id_conductor)  inner join vehiculo on a.id_movil=vehiculo.id_movil)
INNER JOIN conductor b ON a.`id_conductor` = b.`id_conductor` WHERE a.estado = 1 group by id_simit having servicio='Suspendido'order by estado,a.id_conductor,grupo")
?>


<table width="110%" border="1" align="center"  class="ui-corner-all">
   <tr >
      <td colspan="2" class="ui-corner-all " ><div align="center">TRANSPORTES ARGELIA Y CAIRO </div></td>
   </tr>
   <tr >
      <td colspan="2" class="ui-corner-all " ><div align="center">RELACI&Oacute;N DE CONDUCTORES REPORTADOS EN EL SIMIT </div></td>
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
    <td width="22%" class="ui-corner-all ui-widget-header"><div align="center">CODIGO</div>      <div align="center"></div></td>
	<td width="11%" class="ui-corner-all ui-widget-header">ENTIDAD</td>
    <td width="11%" class="ui-corner-all ui-widget-header"><div align="center">VALOR</div></td>
    <td width="16%" class="ui-corner-all ui-widget-header"><div align="center">FECHA MULTA </div></td>
    <td width="16%" class="ui-corner-all ui-widget-header">FECHA PAGO </td>
    <td width="16%" class="ui-corner-all ui-widget-header">CONVENIO</td>
    <td width="16%" class="ui-corner-all ui-widget-header">OBSERVACION</td>
    <td width="16%" class="ui-corner-all ui-widget-header">ESTADO</td>
    <td width="16%" class="ui-corner-all ui-widget-header">MOVIL</td>
    <td width="16%" class="ui-corner-all ui-widget-header">PLACA</td>
    <td width="16%" class="ui-corner-all ui-widget-header">GRUPO</td>
  </tr>
  
  <?php
  $i=0;
  while($filamov=mysql_fetch_array($result)){
  
  ?>
  
  <tr>
    <td ><div align="center"><?php echo $filamov['codigo']?></div></td>
    <td ><div align="center"><?php echo  $filamov['nombre1'].' '.$filamov['nombre2'] ?></div></td>
    <td><?php echo $filamov['apellido1'].' '.$filamov['apellido2']?></td>
    <td ><?php echo $filamov['cod_infraccion']?></td>
	<td ><?php echo $filamov['eps'] ?></td>
	<td class="ui-corner-all <?php echo $prop ?>">$<?php echo $filamov['valor'] ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><div align="right"><?php echo $filamov['fecha_parte'] ?></div></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['fecha_pago'] ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['convenio'] ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['observacion'] ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['estado'] ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['id_movil'] ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['placa'] ?></td>
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
