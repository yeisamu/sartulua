<?php
session_start();
 include('../inc/libreria.php');
 $link=conectarse();
 $linea=$_REQUEST['linea_at'];
 $detalle=$_REQUEST['detall'];
 $conpto=mysql_query("select id_tipo_linea  from linea_atencion  where linea='$linea'");
	$filatipo=mysql_fetch_array($conpto);
	$id_tipo=$filatipo['id_tipo_linea'];
	if($id_tipo==3){
	$direccion=$_REQUEST['direcci'];
	$tel="pto_radio";
	$recep=2;
	}else{
	
	$direccion=$_REQUEST['direcci'];
	//$direccion=htmlentities("$direccion");
	$tel=$_REQUEST['tele'];
	$recep=0;
	}
	if($id_tipo==2){
	$direccion=$_REQUEST['direcci'];
	//$direccion=htmlentities("$direccion");
	$tel=$_REQUEST['tele'];
	$recep=1;
	}
 
 $estado=0;
	
	$usuario=$_SESSION['login']."-". $_SESSION['loginaux'];
   //echo $eva="insert into servicio (`fecha_reg`, `linea`, `telefono`, `direccion`, `detalle_serv`, `estado`, `usuario`, `recep_serv`,`id_movil`,`id_movil2`,`placa`,`fecha_asig`,`id_tarjeta`,`tarjeta`,`id_conductor`, `codigo`, `nombres`,`observacion`)VALUES(now(),'$linea','$tel','$direccion','$detalle',$estado,'$usuario',$recep,'','','','0000-00-00',0,0,0,'','','')";
	   $consul=mysql_query("select estado from utilidades");
 	$sql = mysql_query("insert into servicio (`fecha_reg`, `linea`, `telefono`, `direccion`, `detalle_serv`, `estado`, `usuario`, `recep_serv`,`id_movil`,`id_movil2`,`placa`,`fecha_asig`,`id_tarjeta`,`tarjeta`,`id_conductor`, `codigo`, `nombres`,`observacion`)VALUES(now(),'$linea','$tel','$direccion','$detalle',$estado,'$usuario',$recep,'','','','0000-00-00',0,0,0,'','','')");
	   $consul=mysql_query("select estado from utilidades");
	   $filaut=mysql_fetch_array($consul);
	   if($filaut['estado']==1){
	   $est=0;
	   }else{
	   $est=1;
	   }
		$actualiza=mysql_query("update utilidades set estado=$est");
	//$num=rand();
if(!$sql || !$actualiza){
echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Error al grabar los datos  </div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');	}}});</script>";

}else{	
echo "<script language='javascript'>jQuery('#crudradio').trigger('reloadGrid');actualizatabla('Layer5')</script>";	

}
?> 
