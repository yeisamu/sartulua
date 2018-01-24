<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=relacion_pago.xls");
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
include('../inc/operaciones.php');
$ani=$_REQUEST['ani'];
$link=conectarse();


$consulta="select vehiculo.id_movil,placa,nombre,apellidos,vehiculo.id_prop,clase,direccion,telefono,tipov,modelo,marca,motor,serie,referencia,tipo,color,grupo ";


    $seldetalle=mysql_query("SELECT distinct `ncuota` FROM `detalle_contra` WHERE `periodo`= '$ani'");
  while($filadeta = mysql_fetch_array($seldetalle,MYSQL_ASSOC)) { 
     $ncuo=$filadeta['ncuota'];
			 $consulta = $consulta.",(select nrecibo from detalle_contra where id_movil=vehiculo.id_movil and periodo='$ani' and ncuota=$ncuo) as rc$ncuo,(select `vrecibo` from detalle_contra where id_movil=vehiculo.id_movil and periodo='$ani' and ncuota=$ncuo) as cuota$ncuo"; 
}
 $consulta = $consulta." from ((vehiculo inner join (tipo_taxi inner join tipov on tipo_taxi.id_tipov=tipov.id_tipov) on vehiculo.id_movil=tipo_taxi.id_movil)  inner join marca on vehiculo.id_marca=marca.id_marca) left join propietario on vehiculo.id_prop=propietario.id_prop  where 1 group by vehiculo.id_movil  order by vehiculo.estado desc ";


//echo $consulta;

$selmov=mysql_query($consulta);
  $seldetalle=mysql_query("SELECT distinct `ncuota` FROM `detalle_contra` WHERE `periodo`= '$ani'");
?>


<table width="186%" border="1" align="center"  class="ui-corner-all">
   <tr >
      <td colspan="2" class="ui-corner-all " ><div align="center">TRANSPORTES ARGELIA Y CAIRO &amp; CIA S.C.A Y TRANSPORTES MARISCAL ROBLEDO S.A </div></td>
   </tr>
   <tr >
      <td colspan="2" class="ui-corner-all " ><div align="center">RELACI&Oacute;N DE PAGOS DEL SEGURO  CONTRACTUAL Y EXTRACONTRACTUAL PARA EL PERIODO <?php echo $ani ?>  </div></td>
   </tr>
   <tr >
      <td colspan="2" class="ui-corner-all " ><table width="100%" border="1" class="ui-corner-all">
        <!-- <tr>
    <td colspan="8" class="ui-corner-all"><div align="center">DESDE : <?php echo $fechaini ?> HASTA : <?php echo $fechafinmov ?></div></td>
    </tr> -->
        <tr>
          <td width="3%" class="ui-corner-all ui-widget-header "><div align="center">ITEM </div></td>
          <td width="3%" class="ui-corner-all ui-widget-header"><div align="center">MOVIL</div></td>
          <td width="3%" class="ui-corner-all ui-widget-header"><div align="center">PLACA</div></td>
          <td width="6%" class="ui-corner-all ui-widget-header"><div align="center">NOMBRE</div>
              <div align="center"></div></td>
          <td width="5%" class="ui-corner-all ui-widget-header">APELLIDOS</td>
          <td width="4%" class="ui-corner-all ui-widget-header "><div align="center">CEDULA </div></td>
          <td width="3%" class="ui-corner-all ui-widget-header"><div align="center">CLASE</div></td>
          <td width="5%" class="ui-corner-all ui-widget-header"><div align="center">DIRECCION</div></td>
          <td width="6%" class="ui-corner-all ui-widget-header"><div align="center">TELEFONO</div></td>
          <td width="4%" class="ui-corner-all ui-widget-header"><div align="center">SERVICIO</div></td>
          <td width="4%" class="ui-corner-all ui-widget-header "><div align="center">MODELO </div></td>
          <td width="4%" class="ui-corner-all ui-widget-header"><div align="center">MARCA</div></td>
          <td width="4%" class="ui-corner-all ui-widget-header"><div align="center">MOTOR</div></td>
          <td width="6%" class="ui-corner-all ui-widget-header"><div align="center">CHASIS</div></td>
          <td width="3%" class="ui-corner-all ui-widget-header">LINEA</td>
          <td width="2%" class="ui-corner-all ui-widget-header">TIPO</td>
          <td width="4%" class="ui-corner-all ui-widget-header "><div align="center">COLOR </div></td>
          <td width="4%" class="ui-corner-all ui-widget-header "><div align="center">GRUPO </div></td>
          <td width="6%" class="ui-corner-all ui-widget-header"><div align="center">F.INCLUSION</div></td>
          <td width="5%" class="ui-corner-all ui-widget-header"><div align="center">VIGENCIA</div></td>
          <td width="3%" class="ui-corner-all ui-widget-header"><div align="center">DIAS</div></td>
          <td width="3%" class="ui-corner-all ui-widget-header">V/R RCC </td>
          <?php 
	$z=1;
	while($filadeta = mysql_fetch_array($seldetalle,MYSQL_ASSOC)) {if($z==1){$cuota="Inicial";}else{ $indi=($z-1);$cuota="Cuota ".$indi;} ?>
          <td width="3%" class="ui-corner-all ui-widget-header"><div align="center"><?php echo "# R.C";?></div></td>
          <td width="3%" class="ui-corner-all ui-widget-header"><div align="center"><?php echo $cuota;?></div></td>
          <?php
   $z++;
   }
   ?>
          <td width="4%" class="ui-corner-all ui-widget-header"><div align="center">SALDO</div></td>
        </tr>
        <?php
  $toting=0;
  $totegre=0;
  $saldo=0;
  $i=0;
  while($filamov=mysql_fetch_array($selmov)){
  	$mov=$filamov[id_movil];
//$consu1 ="select *  from vehiculo left join contractual on vehiculo.id_movil=contractual.id_movil where contractual.periodo='$ani' and contractual.id_movil='$mov'";
$consu =mysql_query("select *  from vehiculo left join contractual on vehiculo.id_movil=contractual.id_movil where contractual.periodo='$ani' and contractual.id_movil='$mov'");
	$filacontra=mysql_fetch_array($consu);
			$fecha1=$filacontra[f_inclusion];
			$fecha2=$filacontra[f_fin];
			$dias=calcdia($fecha1,$fecha2);
			
			$movcontra=$filacontra[id_movil];
			
			if(trim($mov)==trim($movcontra)){
			$saldonow=$filacontra[saldo];
			}else{
			$saldonow="Excluido";
			}
  ?>
        <tr>
          <td ><div align="center"><?php echo $i+1 ?></div></td>
          <td ><div align="center">&nbsp;<?php echo $filamov['id_movil'] ?></div></td>
          <td><?php echo $filamov['placa'] ?></td>
          <td ><?php echo $filamov['nombre'] ?></td>
          <td ><?php echo $filamov['apellidos'] ?></td>
          <td ><div align="left"><?php echo $filamov['id_prop'] ?></div></td>
          <td><?php echo $filamov['clase'] ?></td>
          <td ><div align="left"><?php echo $filamov['direccion'] ?></div></td>
          <td ><div align="left"><?php echo $filamov['telefono'] ?></div></td>
          <td ><div align="left"><?php echo $filamov['tipov'] ?></div></td>
          <td><div align="center"><?php echo $filamov['modelo'] ?></div></td>
          <td ><?php echo $filamov['marca'] ?></td>
          <td ><?php echo $filamov['motor'] ?></td>
          <td ><div align="left"><?php echo $filamov['serie'] ?></div></td>
          <td><?php echo $filamov['referencia'] ?></td>
          <td ><?php echo $filamov['tipo'] ?></td>
          <td ><?php echo $filamov['color'] ?></td>
          <td ><div align="center"><?php echo $filamov['grupo'] ?></div></td>
          <td style="mso-number-format:'d-mmm-yy';"><?php echo $filacontra['f_inclusion'] ?></td>
          <td style="mso-number-format:'d-mmm-yy';"><?php echo $filacontra['f_fin'] ?></td>
          <td ><?php echo $dias ?></td>
          <td ><?php echo $filacontra['valorp']; ?></td>
          <?php  
		
		    $seldetalle2=mysql_query("SELECT distinct `ncuota` FROM `detalle_contra` WHERE `periodo`= '$ani'");
  $w=1;
    $a=0;
		while($filadeta2 = mysql_fetch_array($seldetalle2,MYSQL_ASSOC)) { 
		//$perio=$filadeta2[periodo];
		$cuotas[$a]+=$filamov['cuota'.$w];
		?>
          <td class="ui-corner-all <?php echo $prop ?>"><?php if($filamov['rc'.$w]==NULL){echo "&nbsp;";}else{ echo $filamov['rc'.$w] ;}?></td>
          <td class="ui-corner-all <?php echo $prop ?>"><div align="right">$<?php echo $filamov['cuota'.$w]; ?></div></td>
          <?php
	   $w++;
	   $a++;
   }
   ?>
          <td class="ui-corner-all <?php echo $prop ?>"><div align="right"> <?php echo $saldonow ?></div></td>
        </tr>
        <?php
	$i++;
	  $saldo+=$filacontra['saldo'];
  }

  ?>
        <tr>
          <td colspan="22" class="ui-corner-all"><div align="right">TOTALES</div></td>
          <?php $seldetalle3=mysql_query("SELECT distinct `ncuota` FROM `detalle_contra` WHERE `periodo`= '$ani'");
		 $s=0;
  while($filadeta = mysql_fetch_array($seldetalle3,MYSQL_ASSOC)) { 
    // $imp=$imp."$"."row[rc$y]".","."$"."row[cuota$y]".",";
	// $y++;
  //}
		
		?>
    <td class="ui-corner-all">&nbsp;</td>    
    <td class="ui-corner-all"><div align="right"><strong>$ <?php echo $cuotas[$s] ?></strong></div></td>       
		  <?php
	$s++;
  }
  
  ?>
          <td width="4%" class="ui-corner-all"><div align="right"><strong>$ <?php echo $saldo ?></strong></div></td>
        </tr>
      </table></td>
   </tr>
   <tr >
   <td class="ui-corner-all "  colspan="2">
     <div align="left">Elaboro: ____________________________________________ &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      
     Revisa: ______________________________________________     </div></td>
 </tr>
</table>
