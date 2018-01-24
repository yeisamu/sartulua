<?php
//Configuracion de la conexion a base de datos
$bd_host = "villadecespedestulua.com"; 
$bd_usuario = "villadec_sar"; 
$bd_password = "td72da"; 
$bd_base = "villadec_sar"; 
$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $con); 
$conexion=mysql_connect($bd_host,$bd_usuario,$bd_password) or die("Error: El servidor no puede conectar con la base de datos");

?>