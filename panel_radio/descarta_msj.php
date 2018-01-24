<?php
session_start();
 include('../inc/libreria.php');
 $link=conectarse();
 $id_msj=$_REQUEST['idmsj'];
$query = mysql_query("update `mensaje105` set estado=2 where id_msj=$id_msj");	
if(!$query){
echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Error al grabar los datos  </div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');	}}});</script>";

}else{	
echo "<script language='javascript'>jQuery('#crud105').trigger('reloadGrid');</script>";	

}
?> 
