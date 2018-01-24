<?php
session_start();
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
include('../inc/operaciones.php');
$link=conectarse();
$login=$_SESSION['login'];
$per=$_REQUEST['periodo'];
$dato=explode('-',$per);
 $ini=$dato[0];
 $fin=$dato[1];
$deshacer = FALSE;
mysql_query("BEGIN");
$consultatipo=mysql_query("select * from vehiculo inner join tipo_taxi on vehiculo.id_movil=tipo_taxi.id_movil where estado=1 and poliza=1");

while($filamov=mysql_fetch_array($consultatipo)){

$tipo=$filamov['id_tipov'];
$id_mov=$filamov['id_movil'];
$grupo=$filamov['grupo'];
//$consuval="select * from `valor_poliza` WHERE `id_tipov` = $tipo and year(fini)=$ini and year(ffin)=$fin ";
//echo "select * from `valor_poliza` WHERE `id_tipov` = $tipo and year(fini)=$ini and year(ffin)=$fin  and grupo='$grupo'";

$consuvalor=mysql_query("select * from `valor_poliza` WHERE `id_tipov` = $tipo and year(fini)=$ini and year(ffin)=$fin  and grupo='$grupo'");
$valorpoli=mysql_result($consuvalor,0,valorp);
$fini=mysql_result($consuvalor,0,fini);
$ffin=mysql_result($consuvalor,0,ffin);
//echo $ejecut="insert into `contractual` (`id_movil`, `periodo`, `f_inclusion`, `f_fin`,`valorp`,saldo) values ('$id_mov','$per','$fini','$ffin',$valorpoli,$valorpoli)";

//echo "insert into `contractual` (`id_movil`, `periodo`, `f_inclusion`, `f_fin`,`valorp`,saldo) values ('$id_mov','$per','$fini','$ffin',$valorpoli,$valorpoli)";

$ejecutain=mysql_query("insert into `contractual` (`id_movil`, `periodo`, `f_inclusion`, `f_fin`,`valorp`,saldo) values ('$id_mov','$per','$fini','$ffin',$valorpoli,$valorpoli)");

if (!$ejecutain) {
	$deshacer = TRUE;
}	

}



	 
	if($deshacer){
	 	mysql_query("ROLLBACK");
		echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Ocurrió un error durante el registro. Vuelva a intentarlo</div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');jQuery('#planillas').dialog( 'close' );	}}});</script>";

	}else{
	mysql_query("COMMIT");
	?>
	
<div class='ui-state-error' id='errorgraba' title='Grabar Planilla'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Periodo Registrado con exito </div><script language='javascript'>
	   window.onload = detectarCarga();
	  		//jQuery('#crudtc').jqGrid('setCaption','Detalle de tarjetas de control') .trigger('reloadGrid');
	   //document.getElementById('grabaimp').disabled=true;
	  // jQuery('#crudtc').trigger('reloadGrid');
//	   jQuery('#crudplan').trigger('reloadGrid');jQuery('#crudplancon').trigger('reloadGrid');jQuery('#planillas').dialog( 'close' );jQuery('#autoriza_planilla').dialog( 'close' );
 // grabar_contractual('grabador',<?php echo $per ?>)
  jQuery("#tabs").load("relacionpagos.php?anio=<?php echo $per ?>");
	   jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');}}});</script>
	
	<?php
	}	
		?>	
