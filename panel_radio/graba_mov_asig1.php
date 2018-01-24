<?php
session_start();
 include('../inc/libreria.php');
 $link=conectarse();
 
 	$id_movil=$_REQUEST['id_movil'];

	$i=$_REQUEST['i'];
	$id_serv=$_REQUEST['id_serv'];
	$conmovil=mysql_query("select vehiculo.placa,tarjeta_control.`id_tarjeta`,tarjeta_control.`tarjeta`,conductor.id_conductor,conductor.codigo,concat(nombre1,' ',nombre2,' ',apellido1,' ',apellido2) as nombres from frecuencia inner join ((tarjeta_control inner join vehiculo on tarjeta_control.id_movil=vehiculo.id_movil) inner join conductor on tarjeta_control.id_conductor=conductor.id_conductor) on frecuencia.id_tarjeta=tarjeta_control.id_tarjeta where frecuencia.id_movil=$id_movil");
	$filamovil=mysql_fetch_array($conmovil);
	
	
	
	$placa=$filamovil['placa'];
	//$fecha_asig=date("Y-m-d H:i");
	
	//$ffin=date("Y-m-d H:i",strtotime($f_fin));
	$id_tarjeta=$filamovil['id_tarjeta'];
	$tarjeta=$filamovil['tarjeta'];
	$id_conductor=$filamovil['id_conductor'];
	$codigo=$filamovil['codigo'];
	$nombres=$filamovil['nombres'];
	$direccion=$_REQUEST['direccion'];
	$deta=$_REQUEST['deta'];
/*	if(empty($id_movil)){
	
	$estado=0;
	}else{
	$estado=1;
	}
	*/
	$usuario=$_SESSION['login'];
	$sql =mysql_query("update servicio set  `direccion`='$direccion',detalle_serv='$deta', id_movil2='$id_movil', placa='$placa', `fecha_asig`=now(), `id_tarjeta`='$id_tarjeta', `tarjeta`='$tarjeta', `id_conductor`='$id_conductor', `codigo`='$codigo', `nombres`='$nombres' where id_ser = $id_serv");
	
	echo $sql2 ="update servicio set  `direccion`='$direccion',detalle_serv='$deta', id_movil2='$id_movil', placa='$placa', `fecha_asig`=now(), `id_tarjeta`='$id_tarjeta', `tarjeta`='$tarjeta', `id_conductor`='$id_conductor', `codigo`='$codigo', `nombres`='$nombres' where id_ser = $id_serv";
		/* create all of the update statements */
		//foreach($crudColumns as $key => $value){ $updateArray[$key] = $value.'='.$crudColumnValues[$key]; };
		//$sql .= implode(',',$updateArray);
		/* add any additonal update statements here */
	
		 
		 $comp=mysql_query(" insert into `comp_servicio` (`fecha`, `usuario`, `id_movil`, `placa`, `id_conductor`, `codigo`, `nombres`, `id_tarjeta`, `tarjeta`, `id_tran`) values (now(),'$usuario','$id_movil','$placa','$id_conductor','$codigo','$nombres',$id_tarjeta,'$tarjeta',16)");
		 
 
echo "<script language='javascript'>
 ser_asig('Layer6');$('direcci').focus();</script>";
						
						//jQuery('#crudsasig').trigger('reloadGrid');	actualizatabla('Layer5');
 
 ?>
