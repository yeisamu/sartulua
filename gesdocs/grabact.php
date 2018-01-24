<?php
session_start();
include('../inc/libreria.php');
include('../inc/operaciones.php');
 //incluimos el config.php que contiene los datos de la conexión a la db
		$link=conectarse();
		$fechact=deme_now();
		//date("Y-m-d h:i:s");
		$usuario=$_SESSION['login'];
		$nrecib=$_REQUEST['nrecib'];
		$cat=$_REQUEST['cat'];
		$fant=$_REQUEST['fant'];
		$fnew=$_REQUEST['fnew'];
		$eps=$_REQUEST['eps'];
		$id_cond=$_REQUEST['id_cond'];
		$id_doc=$_REQUEST['id_doc'];
		$id_condoc=$_REQUEST['id_condoc'];
	   $consulta = "INSERT INTO `sar`.`actual_doc` (`fecha_ant`, `fecha_new`, `id_eps`, `id_conductor`, `usuario`, `fecha_elav`, `id_doc`) VALUES('$fant','$fnew','$eps','$id_cond','$usuario','$fechact','$id_doc') ";
        $resultado=mysql_query($consulta);
        $otra="UPDATE `con_doc` SET numero='$nrecib',categoria='$cat',`fecha_ant` = '$fant',`fecha_vence` = '$fnew',id_eps=$eps WHERE `con_doc`.`id` =$id_condoc";
	    $res=mysql_query($otra);
	  
	  if(!$resultado || !$res){
	  
	  echo "error al grabar";
	  }else{
	    ?>
<style type="text/css">
<!--
.mensaje {color: #C40000;
font-size: 24px;
	font-weight: bold;
	font-style: italic;}

-->
</style>
<script language='javascript'>
	    jQuery('#crudoc').jqGrid('setCaption','Documentos del Conductor') .trigger('reloadGrid');
</script>

	   <p class="mensaje">Actualizacion Realizada con exito!!!!	   
         <?php

	 	  }
        ?>
       </p>