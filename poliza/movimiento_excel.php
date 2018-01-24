<?php
header("Content-Type: application/vnd.ms-excel");header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=cuadrecaja.xls");
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
include('../inc/operaciones.php');
$link=conectarse();
$fechaini=$_REQUEST['fechaini'];
$fechafinmov=$_REQUEST['fechafinmov'];

$selmov=mysql_query("select * from (movi_contra left join (vehiculo inner join (tipo_taxi inner join tipov on tipo_taxi.id_tipov=tipov.id_tipov) on tipo_taxi.id_movil=vehiculo.id_movil) on movi_contra.id_movil=vehiculo.id_movil) where fecha_mov BETWEEN  '$fechaini' AND '$fechafinmov' order by id_mov asc");

?>


<table width="110%" border="1" align="center"  class="ui-corner-all">
   <tr >
      <td colspan="2" class="ui-corner-all " ><div align="center">TRANSPORTES ARGELIA Y CAIRO &amp; CIA S.C.A Y TRANSPORTES MARISCAL ROBLEDO S.A </div></td>
   </tr>
   <tr >
      <td colspan="2" class="ui-corner-all " ><div align="center">CUADRE DE CAJA SEGUROS CONTRACTUAL Y EXTRACONTRACTUAL </div></td>
   </tr>
   <tr >
      <td colspan="2" class="ui-corner-all " ><table width="100%" border="1" class="ui-corner-all">
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
   $prop="ui-widget-content jqgrow ui-row-ltr ui-state-hover"; 
  }
  ?>
  
  <tr>
    <td style="mso-number-format:'d-mmm-yy';" class="ui-corner-all <?php echo $prop ?> "><div align="center"><?php echo $filamov['fecha_mov'] ?></div></td>
    <td class="ui-corner-all <?php echo $prop ?>"><div align="center"><?php echo $filamov['n_recibo'] ?></div></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['concepto'] ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><?php echo $filamov['tipov'] ?></td>
    <td class="ui-corner-all <?php echo $prop ?>">&nbsp;<?php echo $filamov[id_movil] ?></td>
    <td class="ui-corner-all <?php echo $prop ?>"><div align="right"> <?php echo $filamov['ingreso'] ?></div></td>
    <td class="ui-corner-all <?php echo $prop ?>"><div align="right"> <?php echo $filamov['egreso'] ?></div></td>
    <td class="ui-corner-all <?php echo $prop ?>"><div align="right">$ <?php echo $filamov['saldo'] ?></div></td>
  </tr>

    <?php
	$i++;
  }
  $saldo=$toting-$totegre;
  ?>
    <tr>
    <td colspan="5" class="ui-corner-all"><div align="right">TOTALES</div></td>
    <td class="ui-corner-all"><div align="right"><strong>$ <?php echo $toting?></strong></div></td>
    <td class="ui-corner-all"><div align="right"><strong>$ <?php echo $totegre?></strong></div></td>
    <td class="ui-corner-all"><div align="right"><strong>$ <?php echo $saldo?></strong></div></td>
  </tr>
 <tr>
    <td colspan="8"><div align="center">RESUMEN DE CAJA </div></td>
    </tr>
  <tr>
    <td width="78%" colspan="5">TOTAL INGRESOS </td>
    <td width="22%" colspan="3"><div align="right"><strong>$ <?php echo $toting?></strong>
          </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="5">MAS SALDO ANTERIOR </td>
    <td colspan="3"><div align="right"><strong>$
      <?php   $fsaldo=aumenta_n_dia($fechaini,-1); $selsaldo=@mysql_query("SELECT `saldo` FROM `movi_contra` WHERE `fecha_mov` <='$fsaldo' order by `id_mov` desc limit 0,1"); $saldoant=@mysql_result($selsaldo,0,saldo); if($saldoant==0){ echo $saldoant=0;}else{	echo  $saldoant;}?>
    </strong></div></td>
  </tr>
  <tr>
    <td colspan="5">TOTAL</td>
    <td colspan="3"><div align="right"><strong>$ <?php echo  $totent=$toting+$saldoant?></strong></div></td>
  </tr>
  <tr>
    <td colspan="5">MENOS SALIDAS DE CAJA </td>
    <td colspan="3"><div align="right"><strong>$ <?php echo $totegre?></strong></div></td>
  </tr>
  <tr>
    <td colspan="5">SALDO EN CAJA A LA FECHA <?php echo $fechafinmov ?></td>
    <td colspan="3"><div align="right"><strong>$<?php echo  $totent-$totegre ?></strong></div></td>
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
