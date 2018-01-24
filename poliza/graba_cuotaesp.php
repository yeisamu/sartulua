<?php
session_start();
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
include('../inc/operaciones.php');
$link=conectarse();

$ahora=mysql_query("select date_format(now(),'%Y-%m-%d') as hoy");
$fhoy=mysql_result($ahora,0,hoy);
 
$login=$_SESSION['login'];

$fini=$_REQUEST['fini'];
$ffin=$_REQUEST['ffin'];
$per=$_REQUEST['periodo'];
$idmovi=$_REQUEST['movil'];

$deshacer = FALSE;

mysql_query("BEGIN");

$selcomp=mysql_query("select * from compania_poliza ");
$rowcom=mysql_fetch_array($selcomp);
$npol=$rowcom['npoliza'];
$actusaldos=mysql_query("update veh_doc set fecha_ven='$ffin',numero='$npol' where id_movil='$idmovi' and id_documento=03");
if (!$actusaldos) {
	$deshacer = TRUE;
}	
		 
	if($deshacer){
	mysql_query("ROLLBACK");
		echo $modal="
<div class='ui-state-error' id='errorgrabare' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Error al grabar los datos </div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');	}}});</script>";

	}else{
	
	
	
	?>
	
<div class='ui-state-error' id='errorgrabare' title='Grabar Recibo de Pago'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	  Se Registro la fecha de vigencia con exito al movil <?php echo $idmovi ?></div><script language='javascript'>
	  		 function imprimir() {
	    var peri='<?php echo $per ?>';
		var idmovi='<?php echo $idmovi ?>';
		var ffin='<?php echo $fini ?>';
		var fhasta='<?php echo $ffin ?>';
		window.open('imprime_polizaesp.php?movil='+idmovi+'&peri='+peri+'&fecha='+ffin+'&fhas='+fhasta,'miwin','width=600,height=500,scrollbars=yes');
		}
	 jQuery("#tabs").load("relacionpagos.php?anio=<?php echo $per ?>");
//	   jQuery('#crudplan').trigger('reloadGrid');jQuery('#crudplancon').trigger('reloadGrid');jQuery('#planillas').dialog( 'close' );jQuery('#autoriza_planilla').dialog( 'close' );
jQuery('#imprime').dialog('close')
jQuery( this ).dialog('close')
	   jQuery('#errorgrabare').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');imprimir()}}});</script>
	
	<?php
		mysql_query("COMMIT");
	}	
		?>	
