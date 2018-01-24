<?php
session_start();
 include('../inc/libreria.php');
 $link=conectarse();
 $id_movil=$_REQUEST['id_movil'];
 $idserv=$_REQUEST['idserv'];
  $detalle=$_REQUEST['obs'];
 $usuario=$_SESSION['login']."-". $_SESSION['loginaux'];
    $query=mysql_query("update servicio set id_movil='$id_movil',estado=4,observacion='$detalle',fecha_asig=now() where id_ser=$idserv"); 
 	$sql = mysql_query("insert into `comp_servicio` (`fecha`, `usuario`, `id_movil`, `id_tran`, `obs`)VALUES(now(),'$usuario','$id_movil',20,'Movil fuera de frecuencia Autorizado')");
	
if(!$sql || !$query){
echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Error al grabar los datos </div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');	}}});</script>";

}else{	
echo "<script language='javascript'>ser_asig('Layer6');actualizatabla('Layer5');jQuery('#servauto').dialog('close');</script>";	

}
?> 
