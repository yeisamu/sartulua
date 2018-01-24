<?php 
include('../inc/libreria.php');
include('../inc/operaciones.php');
$link=conectarse();

$q = strtolower($_REQUEST["movil"]);
$cadena = trim($q); //le asignamos a cadena $Q sin espacios
$select = mysql_query("select * from frecuencia where id_movil = '$cadena'");
$resu=mysql_num_rows($select) ;
//echo $selec ="select * from frecuencia where id_movil = '$cadena'";
if( $resu> 0)
        echo 0;
    else
        echo 1;
 ?>