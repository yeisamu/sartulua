<?php
session_start();
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexi�n a la db
include('../inc/operaciones.php');
$link=conectarse();

$ahora=mysql_query("select date_format(now(),'%Y-%m-%d') as hoy");
$fhoy=mysql_result($ahora,0,hoy);
 
$login=$_SESSION['login'];
$per=$_REQUEST['periodo'];
$fini=$_REQUEST['fini'];
$ffin=$_REQUEST['ffin'];
$vcuota=$_REQUEST['vcuota'];
$idmovi=$_REQUEST['idmovil'];
$fecha_rcaja=$_REQUEST['frc'];
$nrecibo=$_REQUEST['nrecibo'];
$ncontra=$_REQUEST['ncontra'];
$ncuota=$_REQUEST['ncuota'];
$saldo=$_REQUEST['saldo'];
$v_poliza=$_REQUEST['v_poliza'];

$consultatipo=mysql_query("select * from (vehiculo inner join marca on vehiculo.id_marca=marca.id_marca) inner join (tipo_taxi inner join tipov on tipo_taxi.id_tipov=tipov.id_tipov) on vehiculo.id_movil=tipo_taxi.id_movil and vehiculo.id_movil='$idmovi'");

$filamov=mysql_fetch_array($consultatipo);

$prim=$filamov['tipov'];  $datosmov=explode(' ',$prim);
$letra1=substr($datosmov[0],0,1);$letra2=substr($datosmov[1],0,1);  
$tipovehi=$letra1.$letra2.$idmovi; 



if($vcuota==$saldo){
$concepto="$prim $tipovehi CANCELA POLIZA CONT Y EXT ".$per;
}else{
$concepto="$prim $tipovehi ABONO POLIZA CONT Y EXT ".$per;
}



$deshacer = FALSE;
$saldoactu=$saldo-$vcuota;
if($ncuota==1){
$numeroc="Cuota Inicial";
}
if($ncuota==2){
$numeroc="Primera Cuota";
}
if($ncuota==3){
$numeroc="Segunda Cuota";
}
mysql_query("BEGIN");

$sql = mysql_query("SELECT * FROM `compania_poliza`");
$filacom=mysql_fetch_array($sql);
$nump=$fila['npoliza'];

$ejecutain=mysql_query("insert into `detalle_contra` (`id_contra`, `id_movil`, `periodo`, `vrecibo`, `nrecibo`, `frecibo`, `fdesde`, `fhasta`, `ncuota`) values ($ncontra,'$idmovi','$per',$vcuota,'$nrecibo','$fecha_rcaja','$fini','$ffin',$ncuota)");
$actusaldo=mysql_query("update contractual set saldo=$saldoactu where id_contra=$ncontra");
$seledeta=mysql_query("select last_insert_id() as id_contra");
$id_detalle=mysql_result($seledeta,0,'id_contra');
$selsaldo=mysql_query("SELECT saldo FROM sarmicro.`movi_contra` ORDER BY sarmicro.`movi_contra`.`id_mov` DESC
LIMIT 0 , 1");
$saldomov=mysql_result($selsaldo,0,saldo);

$insertmov=mysql_query("insert into sarmicro.`movi_contra` (`fecha_mov`, `n_recibo`, `concepto`, `id_movil`, `ingreso`,usuario) values ('$fecha_rcaja','$nrecibo','$concepto','$idmovi',$vcuota,'$login')");

$actusaldos=mysql_query("update sarmicro.movi_contra set saldo=$saldomov+$vcuota where id_mov=last_insert_id()");

$actufecha=mysql_query("UPDATE `veh_doc` SET `fecha_ven`='$ffin',`numero`='$nump' WHERE `id_movil`='$idmovi' and `id_documento`='03' ");
$insertanov=mysql_query("INSERT INTO `novedad_diario`(`id_movil`, `fecha`, `pago_hasta_n`, `pago_hasta_a`, `novedad`, `control`,control3) VALUES ('$idmovi',now(),'$ffin','$fini','$concepto',1,1)");


if (!$ejecutain || !$actusaldo || !$insertmov || !$actusaldos || !$actufecha) {
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
	  Se Registro la <?php echo $numeroc?>  con exito al movil <?php echo $idmovi?></div><script language='javascript'>
	  		 function imprimir() {
	    var peri='<?php echo $per ?>';
		var idmovi='<?php echo $idmovi ?>';
		var deta=<?php echo $id_detalle ?>;
		window.open('imprime_poliza.php?periodo='+peri+'&movil='+idmovi+'&deta='+deta,'miwin','width=600,height=500,scrollbars=yes');
		}
	  jQuery("#tabs").load("relacionpagos.php?anio=<?php echo $per ?>");
//	   jQuery('#crudplan').trigger('reloadGrid');jQuery('#crudplancon').trigger('reloadGrid');jQuery('#planillas').dialog( 'close' );jQuery('#autoriza_planilla').dialog( 'close' );
jQuery('#cuota').dialog('close')
jQuery( this ).dialog('close')
	   jQuery('#errorgrabare').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');imprimir()}}});</script>
	
	<?php
		mysql_query("COMMIT");
	}	
		?>	
