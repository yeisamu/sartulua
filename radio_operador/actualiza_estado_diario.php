<?php
include('../inc/libreria.php');
$link=conectarse();
 $id_nov=$_REQUEST['id_nov'];
  $id_movil=$_REQUEST['movil'];
   $plazo=$_REQUEST['plazo'];
 $consulta="update novedad_diario set control2=0 where id_nov='$id_nov'";
 $query=mysql_query($consulta);
 if(!$query){
echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Error al grabar los datos </div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');	}}});</script>";
 }else{
 

  $icon='ui-icon-circle-check';

 
	echo $modal="
<div class='' id='errorgraba' title='pago de Diarios'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 30px 0;'></span>
	    <span style='font-size:24px' >$id_movil Pago Hasta $plazo</span>  </div><script language='javascript'>
	    jQuery('#crudnov').trigger('reloadGrid');
		jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');}}});</script>";
 }
?>
