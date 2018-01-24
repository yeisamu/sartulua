<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=pendiente_pago.xls");
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
include('../inc/operaciones.php');
$link=conectarse();
$consulta="select vehiculo.id_movil,placa,nombre,apellidos,vehiculo.id_prop,clase,sar.propietario.direccion,sar.propietario.telefono,fecha_nac ,modelo,motor,serie,referencia,tipo,color,grupo,tipov ";


   $seldetalle=mysql_query("SELECT distinct concat_ws('-',year(`fini`),year(`ffin`)) as periodo from valor_poliza order by year(`fini`) asc");
  while($filadeta = mysql_fetch_array($seldetalle,MYSQL_ASSOC)) { 
     $nper=$filadeta['periodo'];
	 $per1=$nper[0];
	 $per2=$nper[1];
	/*$consulta = $consulta.",(select saldo  from contractual where  concat_ws('-',year(`f_inclusion`),year(`f_fin`))='".$nper."' and id_movil=vehiculo.id_movil ) as '$nper',sum(saldo) as saldo"; 
}*/
$consulta = $consulta.",(select saldo  from contractual where  periodo='".$nper."' and id_movil=vehiculo.id_movil ) as '$nper'"; 
}
$consulta = $consulta.",sum(saldo) as saldo from (((vehiculo  inner join (sar.tipo_taxi inner join tipov on sar.tipo_taxi.id_tipov=tipov.id_tipov) on sar.tipo_taxi.id_movil=vehiculo.id_movil) inner join propietario on trim(vehiculo.id_prop)=trim(propietario.id_prop)) inner join contractual on vehiculo.id_movil=contractual.id_movil) where contractual.saldo>0  group by vehiculo.id_movil ORDER BY vehiculo.id_movil
 ";

/*$consulta = $consulta.",sum(saldo) as saldo from (((vehiculo  inner join (sar.tipo_taxi inner join tipov on sar.tipo_taxi.id_tipov=tipov.id_tipov) on sar.tipo_taxi.id_movil=vehiculo.id_movil)) inner join contractual on vehiculo.id_movil=contractual.id_movil) where contractual.saldo>0 group by vehiculo.id_movil ORDER BY vehiculo.id_movil ";*/



$selmov=mysql_query($consulta);
  $seldetalle1=mysql_query("SELECT distinct concat_ws('-',year(`fini`),year(`ffin`)) as periodo from valor_poliza order by year(`fini`) asc");
?>


<table width="110%" border="1" align="center"  class="ui-corner-all">
   <tr >
      <td colspan="2" class="ui-corner-all " ><div align="center">TRANSPORTES ARGELIA Y CAIRO &amp; CIA S.C.A Y TRANSPORTES MARISCAL ROBLEDO S.A </div></td>
   </tr>
   <tr >
      <td colspan="2" class="ui-corner-all " ><div align="center">RELACI&Oacute;N DE PAGOS DEL SEGURO  CONTRACTUAL Y EXTRACONTRACTUAL PENDIENTES PAGO </div></td>
   </tr>
   <tr >
      <td colspan="2" class="ui-corner-all " ><table width="100%" border="1" class="ui-corner-all">
 <!-- <tr>
    <td colspan="8" class="ui-corner-all"><div align="center">DESDE : <?php echo $fechaini ?> HASTA : <?php echo $fechafinmov ?></div></td>
    </tr> -->
  <tr>
    <td width="10%" class="ui-corner-all ui-widget-header "><div align="center">ITEM </div></td>
    <td width="8%" class="ui-corner-all ui-widget-header"><div align="center">MOVIL</div></td>
    <td width="10%" class="ui-corner-all ui-widget-header"><div align="center">PLACA</div></td>
    <td width="22%" class="ui-corner-all ui-widget-header"><div align="center">NOMBRE</div>      <div align="center"></div></td>
	<td width="11%" class="ui-corner-all ui-widget-header">APELLIDOS</td>
	<?php  while($filadeta = mysql_fetch_array($seldetalle1,MYSQL_ASSOC)) { ?>
    <td width="11%" class="ui-corner-all ui-widget-header"><div align="center"><?php echo $filadeta[periodo];?></div></td>
   <?php
   }
   ?>
    <td width="16%" class="ui-corner-all ui-widget-header"><div align="center">SALDO</div></td>
  </tr>
  
  <?php
  $toting=0;
  $totegre=0;
  $saldo=0;
  $i=0;
  while($filamov=mysql_fetch_array($selmov)){
  
  ?>
  
  <tr>
    <td ><div align="center"><?php echo $i+1 ?></div></td>
    <td ><div align="center">&nbsp;<?php echo $filamov['id_movil'] ?></div></td>
    <td><?php echo $filamov['placa'] ?></td>
    <td ><?php echo $filamov['nombre'] ?></td>
	<td ><?php echo $filamov['apellidos'] ?></td>
		<?php  
		
		    $seldetalle2=mysql_query("SELECT distinct concat_ws('-',year(`fini`),year(`ffin`)) as periodo from valor_poliza order by year(`fini`) asc");
  $w=0;
		while($filadeta2 = mysql_fetch_array($seldetalle2,MYSQL_ASSOC)) { 
		$perio=$filadeta2[periodo];
		$y[$w]+=$filamov[$perio];
		?>
    <td class="ui-corner-all <?php echo $prop ?>">$<?php echo $filamov[$perio] ?></td>
	   <?php
	   $w++;
   }
   ?>

    <td class="ui-corner-all <?php echo $prop ?>"><div align="right">$ <?php echo $filamov['saldo'] ?></div></td>
  </tr>

    <?php
	$i++;
	  $saldo+=$filamov['saldo'];
  }

  ?>
    <tr>
    <td colspan="5" class="ui-corner-all"><div align="right">TOTALES</div></td>
	   <?php  $seldetalle2=mysql_query("SELECT distinct concat_ws('-',year(`fini`),year(`ffin`)) as periodo from valor_poliza order by year(`fini`) asc");
  $b=0;
		while($filadeta2 = mysql_fetch_array($seldetalle2,MYSQL_ASSOC)) { 
		
		?>
    <td class="ui-corner-all"><div align="right"><strong>$ <?php echo $y[$b]?></strong></div></td>
        <?php
	$b++;
  }
  
  ?>
    <td width="6%" class="ui-corner-all"><div align="right"><strong>$ <?php echo $saldo?></strong></div></td>
  </tr>
</table></td>
   </tr>
   <tr >
   <td class="ui-corner-all "  colspan="2">
     <div align="left">Elaboro: ____________________________________________ &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      
     Revisa: ______________________________________________
      
     </div></td>
 </tr>
</table>
