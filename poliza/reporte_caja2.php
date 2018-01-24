<?php
session_start();
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
include('../inc/operaciones.php');
$link=conectarse();

$login=$_SESSION['login'];
$fechaini=$_REQUEST['fechainimov'];
$fechafinmov=$_REQUEST['fechafinmov'];

$selmov=mysql_query("select * from (movi_contra left join (vehiculo inner join (tipo_taxi inner join tipov on tipo_taxi.id_tipov=tipov.id_tipov) on tipo_taxi.id_movil=vehiculo.id_movil) on movi_contra.id_movil=vehiculo.id_movil) where fecha_mov BETWEEN  '$fechaini' AND '$fechafinmov' order by id_mov asc");

?>


<table width="100%" border="1" align="center"  class="ui-corner-all">
   <tr >
      <td class="ui-corner-all " ><div align="center">TRANSPORTES ARGELIA Y CAIRO &amp; CIA S.C.A Y TRANSPORTES MARISCAL ROBLEDO S.A </div></td>
   </tr>
   <tr >
      <td class="ui-corner-all " ><div align="center">CUADRE DE CAJA SEGUROS CONTRACTUAL Y EXTRACONTRACTUAL </div></td>
   </tr>
   <tr >
      <td class="ui-corner-all " ><table width="100%" border="1" class="ui-corner-all">
  <tr>
    <td colspan="8" class="ui-corner-all"><div align="center">DESDE : <?php echo $fechaini ?> HASTA : <?php echo $fechafinmov ?></div></td>
    </tr>
  <tr>
    <td width="10%" rowspan="2" class="ui-corner-all ui-widget-header "><div align="center">FECHA </div></td>
    <td width="8%" rowspan="2" class="ui-corner-all ui-widget-header"><div align="center">RECIBO</div></td>
    <td width="29%" rowspan="2" class="ui-corner-all ui-widget-header"><div align="center">CONCEPTO</div></td>
    <td width="9%" class="ui-corner-all ui-widget-header"><div align="center">TIPO  </div></td>
    <td width="7%" rowspan="2" class="ui-corner-all ui-widget-header"><div align="center">MOVIL</div></td>
    <td width="11%" rowspan="2" class="ui-corner-all ui-widget-header"><div align="center">INGRESOS</div></td>
    <td width="10%" rowspan="2" class="ui-corner-all ui-widget-header"><div align="center">EGRESOS</div></td>
    <td width="16%" rowspan="2" class="ui-corner-all ui-widget-header"><div align="center">SALDO</div></td>
  </tr>
  <tr>
    <td class="ui-corner-all ui-widget-header"><div align="center">VEHICULO</div></td>
  </tr>
  <?php
  $toting=0;
  $totegre=0;
  $saldo=0;
  $i=0;
  while($filamov=mysql_fetch_array($selmov)){
  $toting+=$filamov['ingreso'];
  $totegre+=$filamov['egreso'];
  if($i%2==0){
  $prop="ui-widget-content jqgrow ui-row-ltr";
  }else{
   $prop="ui-widget-content jqgrow ui-row-ltr"; 
  }
  ?>
  
  <tr>
    <td class="ui-corner-all <?php echo $prop ?> "><div align="center"><?php echo $filamov['fecha_mov'] ?></div></td>
    <td class="ui-corner-all <?php echo $prop ?>"><div align="center"><?php echo $filamov['n_recibo'] ?></div></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['concepto'] ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php if($filamov['tipov']==NULL){ echo "&nbsp;";}else{ echo $filamov['tipov']; }?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php if($filamov['id_movil']==NULL){ echo "&nbsp;";}else{ echo $filamov['id_movil']; }?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><div align="right">$ <?php echo number_format($filamov['ingreso'],0,",",".") ?></div></td>
    <td class="ui-corner-all <?php echo $prop ?>"><div align="right">$ <?php echo number_format($filamov['egreso'],0,",",".") ?></div></td>
    <td class="ui-corner-all <?php echo $prop ?>"><div align="right">$ <?php echo number_format($filamov['saldo'],0,",",".") ?></div></td>
  </tr>

    <?php
	$i++;
  }
  $saldo=$toting-$totegre;
  ?>
    <tr>
    <td colspan="5" class="ui-corner-all"><div align="right">TOTALES</div></td>
    <td class="ui-corner-all"><div align="right"><strong>$ <?php echo number_format($toting,0,",",".")?></strong></div></td>
    <td class="ui-corner-all"><div align="right"><strong>$ <?php echo number_format($totegre,0,",",".")?></strong></div></td>
    <td class="ui-corner-all"><div align="right"><strong>$ <?php echo number_format($saldo,0,",",".")?></strong></div></td>
  </tr>
</table>
</td>
   </tr>
   <tr >
      <td class="ui-corner-all " ><div align="center"><a id='des' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='movimiento_excel.php?fechaini=<?php echo $fechaini?>&fechafinmov=<?php echo $fechafinmov?>'>Exportar<span class='ui-icon ui-icon-circle-check'></span></a></div></td>
   </tr>
</table>

