<?php
session_start();
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
include('../inc/operaciones.php');
$link=conectarse();
$login=$_SESSION['login'];
$per=$_REQUEST['periodo'];
$fini=$_REQUEST['fini'];
$ffin=$_REQUEST['ffin'];
$vpoliza=$_REQUEST['vpoliza'];
$idmovi=$_REQUEST['idmovi'];


$concepto="MOVIL $idmovi ABONA POLIZA CONT Y EXT ".$per;
$sql = mysql_query("SELECT * FROM `compania_poliza`");
$filacom=mysql_fetch_array($sql);
$nump=$fila['npoliza'];

$ejecutain=mysql_query("insert into `contractual` (`id_movil`, `periodo`, `f_inclusion`, `f_fin`,`valorp`,saldo) values ('$idmovi','$per','$fini','$ffin',$vpoliza,$vpoliza)");

$actufecha=mysql_query("UPDATE `veh_doc` SET `fecha_ven`='$ffin',`numero`='$nump' WHERE `id_movil`='$idmovi' and `id_documento`='03' ");
$insertanov=mysql_query("INSERT INTO `novedad_diario`(`id_movil`, `fecha`, `pago_hasta_n`, `pago_hasta_a`, `novedad`, `control3`) VALUES ('$idmovi',now(),'$ffin','$fini','$concepto',1)");
		 		 
	if(!$ejecutain){
		echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Error al grabar los datos </div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');jQuery('#planillas').dialog( 'close' );	}}});</script>";

	}else{
	?>
	
<div class='ui-state-error' id='errorgraba' title='Grabar movil en periodo'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Poliza Registrada con exito al movil <?php echo $idmovi?></div><script language='javascript'>
	  		//jQuery('#crudtc').jqGrid('setCaption','Detalle de tarjetas de control') .trigger('reloadGrid');
	   //document.getElementById('grabaimp').disabled=true;
	  jQuery('#crud').trigger('reloadGrid');
//	   jQuery('#crudplan').trigger('reloadGrid');jQuery('#crudplancon').trigger('reloadGrid');jQuery('#planillas').dialog( 'close' );jQuery('#autoriza_planilla').dialog( 'close' );
jQuery('#cuota').dialog('close')
jQuery( this ).dialog('close')
	   jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');}}});</script>
	
	<?php
	}	
		?>	
