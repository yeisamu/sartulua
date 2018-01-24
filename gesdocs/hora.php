<?php
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
include('../inc/operaciones.php');
		$link=conectarse();
		
$fecha="2012-01-23 03:00 PM";
echo $f_new=date('Y-m-d H:i',strtotime($fecha));		
		
?>		