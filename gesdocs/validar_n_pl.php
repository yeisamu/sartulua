<?php
session_start();
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
include('../inc/operaciones.php');
		$link=conectarse();
		
 $n_plan=$_REQUEST['nplanilla'];
 $id_grupo=$_REQUEST['idgrupo'];		
		if(!nro_pl_disp($n_plan,$id_grupo)){
		//echo "<script type='text/javascript'>alert('Numero de planilla no valido');document.getElementById('guardapl').disabled=true;
		echo $modal="
<div class='ui-state-error' id='errorgraba' title='Numero de planillas no valido'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	 Numero de Planilla no  Permitido </div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');document.getElementById('guardapl').disabled=true;document.getElementById('nplanilla').focus();	}}});</script>";
		}else{
		echo "<script type='text/javascript'>document.getElementById('guardapl').disabled=false;</script>";
		}
?>	