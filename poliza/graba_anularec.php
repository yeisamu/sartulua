<?php
session_start();
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexi�n a la db
include('../inc/operaciones.php');
$link=conectarse();
$login=$_SESSION['login'];
$id_deta=$_REQUEST['id_deta'];
$ahora=mysql_query("select date_format(now(),'%Y-%m-%d') as hoy");
$fhoy=mysql_result($ahora,0,hoy);
 


$deshacer = FALSE;

mysql_query("BEGIN");
$condato=mysql_query("select * from detalle_contra inner join contractual on detalle_contra.id_contra=contractual.id_contra where id_deta_contra = $id_deta");
$row=mysql_fetch_array($condato);
$vrecibo=$row['vrecibo'];
$nrecibo=$row['nrecibo'];
$vsaldoact=$row['saldo'];
$idmovi=$row['id_movil'];
$idcontra=$row['id_contra'];
$saldonew=$vrecibo+$vsaldoact;
$concepto="ANULACION DEL RECIBO # ".$nrecibo;
$deleterec=mysql_query("DELETE FROM `sarmicro`.`movi_contra` WHERE `movi_contra`.n_recibo=$nrecibo");
$conanula=mysql_query("Delete from  `detalle_contra` where id_deta_contra =$id_deta");

$actucontra=mysql_query("update contractual set saldo=$saldonew where id_contra=$idcontra");

$selsaldo=mysql_query("SELECT saldo FROM `movi_contra` ORDER BY `movi_contra`.`id_mov` DESC
LIMIT 0 , 1");
$saldomov=mysql_result($selsaldo,0,saldo);
$ejecutain=mysql_query("insert into `comp_egresos` (`concepto`, `fecha_com`, `valor_egreso`, `usuario`) values ('$concepto','$fhoy',$vrecibo,'$login')");

$selegre=mysql_query("SELECT id_egreso FROM `comp_egresos` ORDER BY `comp_egresos`.`id_egreso` DESC
LIMIT 0 , 1");
$id_egre=mysql_result($selegre,0,id_egreso);
$cegre='CE-'.$id_egre;

$insertmov=mysql_query("insert into `movi_contra` (`fecha_mov`, `n_recibo`, `concepto`, `id_movil`, `egreso`,usuario) values ('$fhoy','$cegre','$concepto','$idmovi',$vrecibo,'$login')");

$actusaldos=mysql_query("update movi_contra set saldo=$saldomov-$vrecibo where id_mov=last_insert_id()");

//}

if (!$conanula || !$actucontra || !$selsaldo || !$insertmov || !$actusaldos || !$ejecutain) {
	$deshacer = TRUE;
}	

	 
	if($deshacer){
	 	mysql_query("ROLLBACK");
		echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Ocurri� un error durante el registro. Vuelva a intentarlo</div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');jQuery('#planillas').dialog( 'close' );	}}});</script>";

	}else{
	mysql_query("COMMIT");
	?>
	
<div class='ui-state-error' id='errorgraba' title='Grabar Planilla'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Registro Anulado con exito <?php echo $conanulamov ?> </div><script language='javascript'>
	  // window.onload = detectarCarga();
	  		//jQuery('#crudtc').jqGrid('setCaption','Detalle de tarjetas de control') .trigger('reloadGrid');
	   //document.getElementById('grabaimp').disabled=true;
	   jQuery('#crud').trigger('reloadGrid');
	   jQuery('#imprime').dialog('close');
//	   jQuery('#crudplan').trigger('reloadGrid');jQuery('#crudplancon').trigger('reloadGrid');jQuery('#planillas').dialog( 'close' );jQuery('#autoriza_planilla').dialog( 'close' );
 // grabar_contractual('grabador',<?php echo $per ?>)
//  jQuery("crud").load("relacionpagos.php?anio=<?php echo $per ?>");
	   jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');}}});</script>
	
	<?php
	}	
		?>	
