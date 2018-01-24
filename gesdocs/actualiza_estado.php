<?php
include('../inc/libreria.php');
$link=conectarse();
 $id_tarj=$_REQUEST['idtarj'];
 $est_nvo=$_REQUEST['est_new'];
 $id_movil=$_REQUEST['id_movil'];
 $consulta="update tarjeta_control set est_ant='$est_nvo' where id_tarjeta='$id_tarj'";
 $query=mysql_query($consulta);
 if(!$query){
echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Error al grabar los datos </div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');	}}});</script>";
 }else{
 
 if($est_nvo==0){
 $msje="Suspender Radio al movil ";
 $class='ui-state-error';
 $icon='ui-icon-circle-close';
 }else{
 $msje="Activar Radio al movil ";
  $class='';
  $icon='ui-icon-circle-check';
 }
 
	echo $modal="
<div class='$class' id='errorgraba' title='Servicio de Radio'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 30px 0;'></span>
	   $msje <span style='font-size:24px' >$id_movil</span>  </div><script language='javascript'>
	    jQuery('#crudtc').jqGrid('setCaption','Planillas de Control') .trigger('reloadGrid');
		jQuery('#crudnov').jqGrid('setCaption','Planillas de Control') .trigger('reloadGrid');
	   jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');}}});</script>";
 }
?>
