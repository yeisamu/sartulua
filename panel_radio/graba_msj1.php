<?php
session_start();
 include('../inc/libreria.php');
 $link=conectarse();
 $msj=$_REQUEST['msj'];
 $id_movil=$_REQUEST['id_movil'];
 $usuario=$_SESSION['login'];
 $vari="insert into `mensaje105` (`id_movil`, `msj`, `fecha_reg`, `usr`, `estado`)VALUES('$id_movil','$msj',now(),'$usuario',0) -- insert into `comp_servicio` (`fecha`, `usuario`, `id_movil`,`id_tran`) VALUES(now(),'$usuario','$id_movil',19";
 $sql = mysql_query("insert into `mensaje105` (`id_movil`, `msj`, `fecha_reg`, `usr`, `estado`)VALUES('$id_movil','$msj',now(),'$usuario',0)");


$query = mysql_query("insert into `comp_servicio` (`fecha`, `usuario`, `id_movil`,`id_tran`) VALUES(now(),'$usuario','$id_movil',19)");	
if(!$sql || !$query){
echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Error al grabar los datos  </div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');	}}});</script>";

}else{	
echo "<script language='javascript'>jQuery('#crud105').trigger('reloadGrid');jQuery('#id_movil105').val('');jQuery('#msj105').val('');</script>";	

}
?> 
