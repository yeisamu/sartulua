<?php
session_start();
include('../inc/libreria.php');
include('../inc/operaciones.php');
$link=conectarse();
$per=$_REQUEST['periodo'];
$idmovil=$_REQUEST['movil'];
$ncontra=$_REQUEST['contra'];
$dato=explode('-',$per);
$ini=$dato[0];
$fin=$dato[1];
$ahora=mysql_query("select date_format(now(),'%Y-%m-%d') as hoy");
$fhoy=mysql_result($ahora,0,hoy);

$consultatipo=mysql_query("select * from (vehiculo inner join marca on vehiculo.id_marca=marca.id_marca) inner join (tipo_taxi inner join tipov on tipo_taxi.id_tipov=tipov.id_tipov) on vehiculo.id_movil=tipo_taxi.id_movil and vehiculo.id_movil='$idmovil'");

$filamov=mysql_fetch_array($consultatipo);

$tipo=$filamov['id_tipov'];
$id_mov=$filamov['id_movil'];
$consuvalor=mysql_query("select date_format(fini,'%Y-%m-%d') as fini,date_format(ffin,'%Y-%m-%d') as ffin,valorp,vini,vc1,vc2 from `valor_poliza` WHERE `id_tipov` = $tipo and year(fini)=$ini and year(ffin)=$fin ");
$valorpoli=mysql_result($consuvalor,0,valorp);
 $fini=mysql_result($consuvalor,0,fini);
 $ffin=mysql_result($consuvalor,0,ffin);
 $valorp=mysql_result($consuvalor,0,valorp);
$valorini=mysql_result($consuvalor,0,vini);
$vcuota1=mysql_result($consuvalor,0,vc1);
 $vcuota2=mysql_result($consuvalor,0,vc2);

$sele=mysql_query("select * from contractual where id_movil='$idmovil' and periodo='$per'");
$filacontra=mysql_fetch_array($sele);
 $valorpolizamovil=@mysql_result($sele,0,saldo);
$selmovil=mysql_query("select * from vehiculo  inner join empresa on vehiculo.grupo=empresa.grupo where id_movil='$idmovil'");
$row=mysql_fetch_array($selmovil);

if($fhoy >= $fini){
//echo "menor";
$fecha_ini=$fini;
$valorpoli=$valorp;
}else{
//echo "mayor";
$fecha_ini=$fhoy;
$dias=calcdia($fecha_ini,$ffin);
$valordia=$valorp/365;
$valorpoli=$valordia*$dias;
}

$selvige=mysql_query("select max(ncuota) as ncuota from `detalle_contra` where id_movil='$idmovil' and periodo = '$per'");
//echo $a="select max(ncuota) as ncuota from `detalle_contra` where id_movil='$idmovil' and periodo = '$per'";
//echo $tcuota=mysql_num_rows($selvige);
$filfecha=mysql_fetch_array($selvige);
$ncuotasya=$filfecha['ncuota'];
if($ncuotasya==NULL){
$fechainipol=$fini;
$fechafinpoli=aumenta_n_mes($fechainipol,1);
 if($valorini>$valorpolizamovil){
  $valcuota=$valorpolizamovil;
 }else{
  $valcuota=$valorini;
 }

$ncuota=1;
}else{

  $selcuota=mysql_query("select * from `detalle_contra` where id_movil='$idmovil' and periodo = '$per' and ncuota=$ncuotasya");
  $num_totcuota=mysql_num_rows($selcuota);
  //if($num_totcuota>0){
 $filcuota=mysql_fetch_array($selcuota);
// }
 
 if($filcuota['ncuota']==1){
 $fechainipol=$filcuota['fhasta'];
 $fechafinpoli=aumenta_n_mes($fechainipol,1);
  if($vcuota1>$valorpolizamovil){
  $valcuota=$valorpolizamovil;
 }else{
  $valcuota=$vcuota1;
 }

 $ncuota=2;
 }
 if($filfecha['ncuota']==2){

 $fechainipol=$filcuota['fhasta'];
 $fechafinpoli=aumenta_n_mes($fechainipol,1);
 if($vcuota2>$valorpolizamovil){
  $valcuota=$valorpolizamovil;
 }else{
 $valcuota=$vcuota2;
 }
 $ncuota=3;
 }

}


$nsaldo=$filacontra['saldo']-$valcuota;

?>
	<script  src="funpoli.js"></script>
 <script type="text/javascript">
     jQuery.noConflict();
	jQuery(document).ready(function(){ 
	var valor='<?php echo $per?>';
	 if(valor!= ""){
        jQuery.ajax({
            type: "POST",
            url: "valida_pagov.php",
            data: "periodo="+valor+"&movil=<?php echo $idmovil?>" ,
             success: function( respuesta ){
              if(respuesta == '0'){
                var st = "#t"+valor;
				if(jQuery(st).html() != null ) {
					maintab.tabs('select',st);
				} else {
			
					jQuery("#liquidac").show();
				}
		
             } else{
			 	jQuery("#registrarp").show();
				jQuery("#datoperio").html('Registrar Movil <?php echo $idmovil?> en el periodo  '+valor);
			
			}	
            }
        });
		}
	
	jQuery( "#graba_perind" ).dialog({
			resizable: false,
			autoOpen: false,
			height:160,
			modal: true,
			buttons: {
				"Aceptar": function() {
					jQuery( this ).dialog( "close" );
					//jQuery('#cuota').dialog('close')
					var idper=jQuery("#idperio").val();
					//alert(idper)
					grabar_contractual_mov('grabadorper',idper)
					
					
					return 1;
				},
				"Cancelar": function() {
					jQuery( this ).dialog( "close" );
					//jQuery('#cuota').dialog('close')
					return 0;
					//jQuery('#cerrar').dialog( 'close' );
				}
			}
		});	
		
	//	jQuery('#cuota').dialog({autoOpen: false, modal:true,width:550,height:300,});	


////////

jQuery( "#finclu" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,
			dateFormat:'yy-mm-dd',
		});
		jQuery( "#vigen" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,
			dateFormat:'yy-mm-dd',
		});
		
		jQuery( "#fecha_ini" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,
			dateFormat:'yy-mm-dd',
		});
		jQuery( "#fecha_fin" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,
			dateFormat:'yy-mm-dd',
		});
      
	   	jQuery( "#fecha_rc" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,
			dateFormat:'yy-mm-dd',
		});

/////
jQuery("#peripolic").change(function(event) {
	var valor=jQuery("#peripolic").val();
	 if(valor!= ""){
        jQuery.ajax({
            type: "POST",
           url: "valida_pagov.php",
            data: "periodo="+valor+"&movil=<?php echo $idmovil?>" ,
           // beforeSend: function(){
//             // $('#movil').html('verificando');
//            },
            success: function( respuesta ){
              if(respuesta == '0'){
              //	alert(valor)
				
					  var st = "#t"+valor;
				if(jQuery(st).html() != null ) {
					maintab.tabs('select',st);
				} else {
					//maintab.tabs('add',st, treedata.menu);
					//jQuery("#tabs").load("relacionpagos.php?anio="+valor);
					//jQuery("#registrarp").slideUp();
					
					alert('el movil ya esta registrado en este periodo')
					jQuery("#cuota").load("liquida_cuota.php?periodo="+valor+'&movil=<?php echo $idmovil?>&contra=<?php echo $ncontra?>');
				}
				// new Ajax.Updater('destino','graba_mov.php?id_movil='+idmovil+'&id_serv='+id_serv+'&direccion='+direc+'&deta='+deta+'&i='+i,{asynchronous: true, method: 'get',evalScripts:true});
             } else{
            			
				//alert("Movil No esta en Frecuencia")
				jQuery("#cuota").load("liquida_cuota.php?periodo="+valor+'&movil=<?php echo $idmovil?>');
					//jQuery("#registrarp").show();
				jQuery("#datoperio").html('Registrar Movil <?php echo $idmovil?> en el periodo  '+valor);
				//jQuery("#idperio").val(valor);
			//	}
				
			}	
            }
        });
		}else{
			
		alert('Indique un Periodo')	
			
		}
	
	
	

	});			 
 });
    </script>
	
<style>
#registrarp{

display: none;
}
#liquidac{

display: none; 
}
#graba_perind{
display: none;
}
.Estilo1 {
	font-size: 18px;
	color: #FF0000;
}
.Estilo4 {font-size: 24px; color: #CC0033; }
-->
    </style>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>

</head>

<body>
<select id="peripolic" name="peripolic" class="ui-corner-all" >
<option value="" >Registrar Periodo</option>
<?php 
$seleper=mysql_query("select distinct concat_ws('-',year(`fini`),year(`ffin`)) as periodo,year(`fini`) as perini from valor_poliza order by year(`fini`) desc ");
$anioac=date('Y');
while($filaper=mysql_fetch_array($seleper)){
$perio=$filaper['perini'];
 ?>


<option <?php echo $filaper['periodo']  ?> <?php  //if($perio==$anioac) {echo "selected='selected'";}?>><?php echo $filaper['periodo']  ?></option>
<?php
}
  ?>
</select>
<p>&nbsp;</p>


<div id="registrarp">
<table width="79%" border="1"  class="ui-corner-all">
  <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top ">
    <td colspan="2" style="font-size:14px" class="ui-corner-all " ><div id="datoperio"></div></td>
  </tr>
   <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top ">
    <td colspan="2" style="font-size:14px" class="ui-corner-all " ><table width="100%" border="1">
  <tr>
    <td width="34%">Fecha Inclucion </td>
    <td width="27%">Vigencia</td>
    <td width="39%">Valor Poliza </td>
  </tr>
  <tr>
    <td><input type="text" id="finclu" name="finclu" size="10" value="<?php echo $fecha_ini?>" onChange="calcdia(<?php echo $valorp?>)"/></td>
    <td><input type="text" id="vigen" name="vigen" size="10" value="<?php echo $ffin?>" onChange="calcdia(<?php echo $valorp?>)"  /></td>
    <td>$<input type="text" id="vpoliza" name="vpoliza" size="10" value="<?php echo round($valorpoli)?>" /><input type="hidden" id="idmovi" name="idmovi" size="10" value="<?php echo $idmovil?>" /><input type="hidden" id="idperio" name="idperio" size="10" value="<?php echo $per?>"  /><input type="hidden" id="v_poliza" name="v_poliza" size="10" value="<?php echo $valorp?>" /></td>
  </tr>
</table>
</td>
  </tr>
  <tr class="ui-corner-all ">
    <td class="ui-corner-all "><div align="center"><a id='des' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=jQuery('#graba_perind').dialog('open');>Grabar<span class='ui-icon ui-icon-circle-plus'></span></a></div></td>
    <td class="ui-corner-all "><div align="center"><a id='des' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=jQuery('#cuota').dialog('close');>Cancelar<span class='ui-icon ui-icon-cancel'></span></a></div></td>
  </tr>
</table>
<div id="graba_perind" title="Incluir Moviles En el Periodo">
<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta Segur@ de Incluir el movil <?php echo $idmovil?> para el periodo <?php echo $per?>?</p>
</div>

<div id="grabadorper"></div>

</div>


<div id="liquidac">

<?php if($filacontra['saldo']!=0){
?>

<table width="73%" border="1" align="left" class="ui-corner-all ">
  <tr class="ui-corner-all ">
   <td colspan="4">
  <table width="100%" border="0"  class="ui-corner-all ">
  <tr>
    <td width="17%"  class="ui-corner-all  Estilo1"><?php $prim=$filamov['tipov'];  $datosmov=explode(' ',$prim);
		
	 $letra1=substr($datosmov[0],0,1);$letra2=substr($datosmov[1],0,1);  echo $letra1.$letra2.$idmovil ?></td>
    <td width="17%"  class="ui-corner-all "><img src="imagenes/<?php echo $row['logo'] ?>" width="57" height="66" /> </td>
    <td width="66%"  class="ui-corner-all "><p align="left">Poliza de Responzabilidad Civil </p>
    <p align="left">RCC-RCE No 1000282 </p></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td colspan="4"><table width="100%" border="1" class="ui-corner-all">
      <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top ">
        <td colspan="6"><div align="center">Vigencia</div></td>
        </tr>
      <tr class="ui-corner-all " >
        <td width="15%" class="ui-widget-header" >Desde </td>
        <td width="14%"><input name="fecha_ini" type="text" class="ui-corner-all " id="fecha_ini" value="<?php echo $fechainipol?>"  size="10" maxlength="10"  /></td>
        <td width="10%" class="ui-widget-header" >Hasta</td>
        <td width="18%"><input type="text" id="fecha_fin" name="fecha_fin" value="<?php echo $fechafinpoli?>" class="ui-corner-all "   size="10" maxlength="10" /></td>
        <td width="28%" class="ui-widget-header" >Saldo Poliza </td>
        <td width="15%"><?php echo $filacontra['saldo']?><input type="hidden" id="saldo" name="saldo" value="<?php echo $filacontra['saldo']?>" /></td>
      </tr>
      <tr class="ui-corner-all " >
        <td class="ui-widget-header" >Total Cuota </td>
        <td><input type="text" id="vcuota" name="vcuota" class="ui-corner-all " value="<?php echo $valcuota?>"    size="8" maxlength="8" onChange="calculasaldo(<?php echo $valorpolizamovil?>)" /></td>
        <td class="ui-widget-header" ># Recibo </td>
        <td><input type="text" id="nrc" name="nrc" class="ui-corner-all "   size="8" maxlength="8" /></td>
        <td class="ui-widget-header" >Fecha Recibo </td>
        <td><input type="text" id="fecha_rc" name="fecha_rc" class="ui-corner-all "   size="10" maxlength="10" /><input type="hidden" id="ncontra" name="ncontra" value="<?php echo $ncontra?>" /><input type="hidden" id="idmovil" name="idmovil" value="<?php echo $idmovil?>" /><input type="hidden" id="period" name="period" value="<?php echo $per?>" /><input type="hidden" id="ncuo" name="ncuo" value="<?php echo $ncuota?>" /></td>
      </tr>
      <tr class="ui-corner-all " >
        <td colspan="3" class="ui-widget-header" >Nuevo Saldo</td>
        <td colspan="3" class="Estilo4" ><div align="right" id="nsaldo">$ <?php echo number_format($nsaldo,"0","",".")?></div></td>
        </tr>
    </table></td>
    </tr>
  <tr>
    <td colspan="4" >
	<table width="100%" border="1" class="ui-corner-all">
	<tr>
	<td colspan="4" class="ui-jqgrid-titlebar ui-widget-header " >
	<div align="center">Caracter&iacute;sticas del Veh&iacute;culo Asegurado </div></td>
    </tr>
  <tr class="ui-corner-all " >
    <td width="17%" class="ui-widget-header"  >Marca</td>
    <td width="25%" class="ui-corner-all ui-widget-content " ><?php echo $filamov['marca']?></td>
    <td width="19%" class="ui-widget-header" >Placa</td>
    <td width="39%" class="ui-corner-all " ><?php echo $filamov['placa']?></td>
    </tr>
  <tr class="ui-corner-all " >
    <td class="ui-widget-header">Clase</td>
    <td class="ui-corner-all " ><?php echo $filamov['clase']?></td>
    <td class="ui-widget-header" >Modelo</td>
    <td class="ui-corner-all " ><?php echo $filamov['modelo']?></td>
  </tr>
  <tr class="ui-corner-all " >
    <td class="ui-widget-header" >Motor</td>
    <td class="ui-corner-all " ><?php echo $filamov['motor']?></td>
    <td class="ui-widget-header">Servicio</td>
    <td class="ui-corner-all " ><?php echo $filamov['tipov']?></td>
  </tr>
  <tr class="ui-corner-all " >
    <td class="ui-widget-header">Empresa</td>
    <td colspan="3" class="ui-corner-all " ><?php echo $row['nombre']?></td>
    </tr>
	</table>	</td>
	</tr>
	<tr>
	<td colspan="4">
	<table width="100%" border="1">
  <tr>
    <td><a id='des' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick="grabar_cuota('grabacuota')">Grabar e Imprimir<span class='ui-icon ui-icon-disk'></span></a></td>
    <td><a id='des' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=jQuery('#id_servicio').val('<?php echo $filatar['id_ser'] ?>');jQuery('#cuota').dialog('close');>Cancelar<span class='ui-icon ui-icon-circle-close'></span></a></td>
  </tr>
</table>	</td>
	</tr>
</table>
<div id="grabacuota"></div>
<?php 
}else{
?>
<span class="Estilo4">El MOVIL YA REALIZO LOS PAGOS PARA ESTE PERIODO</span>
<?php 
}
?>
</div>

</body>
</html>