<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=reporte_tarjetas_suspendidas.xls");
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexi�n a la db
include('../inc/operaciones.php');
$link=conectarse();
 $result = mysql_query("SELECT b.`id_conductor` ,`id_tarjeta`,`tarjeta`, codigo,nombre1,nombre2,apellido1,apellido2,a.`id_movil` as id_movil, fecha_vigencia,fecha_plazo_a,if(`fecha_plazo_a`<DATE_FORMAT(now(),'%Y/%m/%d %H:%i'),'Suspendido','Permitido') as servicio ,est_ant,if(`fecha_plazo_a`<DATE_FORMAT(now(),'%Y/%m/%d %H:%i'),'0','1') as est_new,grupo,id_tarjeta  FROM (tarjeta_control a inner join vehiculo on a.id_movil=vehiculo.id_movil)
INNER JOIN conductor b ON a.`id_conductor` = b.`id_conductor` WHERE a.estado = 1 having servicio='Suspendido'   ORDER BY a.estado,fecha_plazo_a asc")
?>


<table width="110%" border="1" align="center"  class="ui-corner-all">
   <tr >
      <td colspan="2" class="ui-corner-all " ><div align="center">TRANSPORTES ARGELIA Y CAIRO </div></td>
   </tr>
   <tr >
      <td colspan="2" class="ui-corner-all " ><div align="center">RELACI&Oacute;N DE TRAJETAS SUSPENDIDAS</div></td>
   </tr>
   <tr >
      <td colspan="2" class="ui-corner-all " ><table width="100%" border="1" class="ui-corner-all">
 <!-- <tr>
    <td colspan="8" class="ui-corner-all"><div align="center">DESDE : <?php echo $fechaini ?> HASTA : <?php echo $fechafinmov ?></div></td>
    </tr> -->
  <tr>
    <td width="10%" class="ui-corner-all ui-widget-header "><div align="center">TARJETA </div></td>
   <td width="22%" class="ui-corner-all ui-widget-header"><div align="center">CEDULA</div></td>
    <td width="8%" class="ui-corner-all ui-widget-header"><div align="center">NOMBRES</div></td>
    <td width="10%" class="ui-corner-all ui-widget-header"><div align="center">APELLIDOS</div></td>
   
	<td width="11%" class="ui-corner-all ui-widget-header">MOVIL</td>
    <td width="11%" class="ui-corner-all ui-widget-header"><div align="center">VIGENCIA</div></td>
    <td width="16%" class="ui-corner-all ui-widget-header"><div align="center">FECHA CORTE </div></td>
    <td width="16%" class="ui-corner-all ui-widget-header">GRUPO</td>
    <td width="16%" class="ui-corner-all ui-widget-header">TOTAL PLANILLAS</td>
    <td width="16%" class="ui-corner-all ui-widget-header">DOC. GUIA</td>
   
  </tr>
  
  <?php
  $i=0;
  while($filamov=mysql_fetch_array($result)){
  $id_cond=$filamov[codigo];


$dia_movil=$filamov[id_movil];
	$totdiamovil=deme_cuenta_planillas($dia_movil);
 $idtarje=$filamov[id_tarjeta]; 
	 
	 $docguia =mysql_query("SELECT id_comp,observaciones FROM  `comprobante` WHERE comprobante.id_comprobante=$idtarje order by id_comp desc limit 0,1");

	$filaguia=mysql_fetch_array($docguia);
  ?>
  
  <tr>
    <td ><div align="center"><?php echo $filamov['tarjeta']?></div></td>
    <td ><div align="center"><?php echo $filamov['codigo']?></div></td>
    <td ><div align="center"><?php echo  $filamov['nombre1'].' '.$filamov['nombre2'] ?></div></td>
    <td><?php echo $filamov['apellido1'].' '.$filamov['apellido2']?></td>
    <td ><?php echo $filamov['id_movil']?></td>
	<td ><?php echo $filamov['fecha_vigencia'] ?></td>
	<td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['fecha_plazo_a'] ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><div align="right"><?php echo $filamov['grupo'] ?></div></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $totdiamovil  ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filaguia['observaciones'] ?></td>
   
  </tr>

    <?php
	$i++;
	  
  }

  ?>
</table></td>
   </tr>
   <tr >
   
</table>
