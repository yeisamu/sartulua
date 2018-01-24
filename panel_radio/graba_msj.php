<?php
session_start();
 include('../inc/libreria.php');
 $link=conectarse();
 $msj=$_REQUEST['msj'];
 $id_movil=$_REQUEST['id_movil'];
 $usuario=$_SESSION['login']."-". $_SESSION['loginaux'];
 $vari="insert into `mensaje105` (`id_movil`, `msj`, `fecha_reg`, `usr`, `estado`)VALUES('$id_movil','$msj',now(),'$usuario',0) -- insert into `comp_servicio` (`fecha`, `usuario`, `id_movil`,`id_tran`) VALUES(now(),'$usuario','$id_movil',19";
 $sql = mysql_query("insert into `mensaje105` (`id_movil`, `msj`, `fecha_reg`, `usr`, `estado`)VALUES('$id_movil','$msj',now(),'$usuario',0)");

$in105=mysql_query(" INSERT INTO `servicio_h` ( `fecha_reg` , `linea` , `id_movil` ,detalle_serv,`fecha_asig` , `estado` , `usuario` ) values (now(),'FIJOS','$id_movil','$msj',now(),1,'$usuario')");
echo "insert into `comp_servicio` (`fecha`, `usuario`, `id_movil`,`id_tran`,`placa`, `id_conductor`, `codigo`, `nombres`, `id_tarjeta`, `tarjeta`, `obs`) VALUES(now(),'$usuario','$id_movil',19,'','','','','','','')";	
$query = mysql_query("insert into `comp_servicio` (`fecha`, `usuario`, `id_movil`,`id_tran`,`placa`, `id_conductor`, `codigo`, `nombres`, `id_tarjeta`, `tarjeta`, `obs`) VALUES(now(),'$usuario','$id_movil',19,'',0,'','',0,'','')");	
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
