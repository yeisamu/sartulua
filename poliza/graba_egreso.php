<?php
session_start();
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
include('../inc/operaciones.php');
$link=conectarse();

$login=$_SESSION['login'];
$fechaegre=$_REQUEST['fechaegre'];
$valoregre=$_REQUEST['valoregre'];
$concegre=$_REQUEST['concegre'];
$negreso=$_REQUEST['negreso'];
$pagadoa=$_REQUEST['pagadoa'];
$deshacer = FALSE;

mysql_query("BEGIN");
//$ejecuta="insert into `comp_egresos` (`concepto`, `fecha_com`, `valor_egreso`, `usuario`) values ('$concegre','$fechaegre',$valoregre,'$login')";
$ejecutain=mysql_query("insert into `comp_egresos` (`concepto`,pagado_a, `fecha_com`, `valor_egreso`, `usuario`) values ('$concegre','$pagadoa','$fechaegre',$valoregre,'$login')");

$selsaldo=mysql_query("SELECT saldo FROM `movi_contra` ORDER BY `movi_contra`.`id_mov` DESC
LIMIT 0 , 1");
$saldomov=mysql_result($selsaldo,0,saldo);

$insertmov=mysql_query("insert into `movi_contra` (`fecha_mov`, `n_recibo`, `concepto`, `id_movil`, `egreso`,usuario) values ('$fechaegre','$negreso','$concegre','',$valoregre,'$login')");

$actusaldos=mysql_query("update movi_contra set saldo=$saldomov-$valoregre where id_mov=last_insert_id()");

$seledeta=mysql_query("select id_egreso from  comp_egresos order by id_egreso DESC limit 0,1");
$id_egreso=mysql_result($seledeta,0,'id_egreso');

if (!$ejecutain || !$selsaldo || !$insertmov || !$actusaldos) {
	$deshacer = TRUE;
}	
		 
	if($deshacer){
	mysql_query("ROLLBACK");
		echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Error al grabar los datos $ejecuta </div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');	}}});</script>";

	}else{
	
	
	
	?>
	
<div class='ui-state-error' id='errorgraba' title='Grabar Planilla'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	  Se Registro El comprobande de EGRESO Con Exito !!!</div><script language='javascript'>
	  function imprimir() {
	   document.forms[0].method='POST';
            document.forms[0].action='imprime_egreso.php';  // send it to server which will open this contents in excel file
            document.forms[0].target='_blank';
            document.forms[0].submit();
		}	
	 // jQuery("#tabs").load("relacionpagos.php?anio=");
//	   jQuery('#crudplan').trigger('reloadGrid');jQuery('#crudplancon').trigger('reloadGrid');jQuery('#planillas').dialog( 'close' );jQuery('#autoriza_planilla').dialog( 'close' );

//jQuery( this ).dialog('close')
	   jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');jQuery('#egreso').dialog('close');imprimir()}}});</script>
	
	<form method="post" action="imprime_egreso.php">
    <input type="hidden" name="idegre" id="idegre" value="<?php echo $id_egreso;?>" />
</form>
	<?php
		mysql_query("COMMIT");
	}	
		?>	
