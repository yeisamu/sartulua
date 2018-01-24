<?php
session_start();
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
include('../inc/operaciones.php');
		$link=conectarse();
		
 $login=$_SESSION['login'];
 $fechact=date("Y-m-d h:i:s");
 
 $id_cond=$_REQUEST['id_conductor'];
 $ncomparendo=$_REQUEST['comparendo'];
 $cod_infraccion=$_REQUEST['cod_infraccion'];
 $id_eps=$_REQUEST['id_eps'];	
 $valorparte=$_REQUEST['valorparte'];	
  $obs=$_REQUEST['obs'];
 $fecha=$_REQUEST['fecha'];
 $est=$_REQUEST['est'];
 $conv=$_REQUEST['conv'];
 $id_tran=7;
 $consimit=mysql_query("insert into `simit` (`id_conductor`, `n_parte`, `cod_infraccion`, `id_eps`, `valor`, `fecha_parte`, `convenio`,`observacion`, `estado`) values('$id_cond','$ncomparendo','$cod_infraccion',$id_eps,'$valorparte','$fecha','$conv','$obs','$est') ");
 
 $insertcomp="insert into `comprobante` (`fecha_ante`, `id_conductor`, `usuario`, `fecha_alavo`, `id_comprobante`, `id_tran`,`observaciones`) values ('$fecha','$id_cond','$login','$fechact',LAST_INSERT_ID(),'$id_tran','$obs') ";
	$sqlcomp=mysql_query($insertcomp);
	
	if(!$consimit || !$sqlcomp ){
		echo "insert into `simit` (`id_conductor`, `n_parte`, `cod_infraccion`, `id_eps`, `valor`, `fecha_parte`, `convenio`,`observacion`, `estado`) values('$id_cond','$ncomparendo','$cod_infraccion',$id_eps,'$valorparte','$fecha','$conv','$obs','$est') ";
		echo "insert into `comprobante` (`fecha_ante`, `id_conductor`, `usuario`, `fecha_alavo`, `id_comprobante`, `id_tran`,`observaciones`) values ('$fecha','$id_cond','$login','$fechact',LAST_INSERT_ID(),'$id_tran','$obs') ";
	echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Error al grabar los datos </div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');jQuery('#grabasimit').dialog( 'close' );}}});</script>";

	}else{
?>	
<div class='ui-state-error' id='errorgraba' title='Registrar Comparendo'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Registro Grabado con exito </div><script language='javascript'>
	  
		jQuery('#crudsim').jqGrid('setCaption','Detalle de Comparendo') .trigger('reloadGrid');
	   jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');jQuery('#regsimit').dialog( 'close' );}}});</script>
	
	<?php
	}	
		?>		

