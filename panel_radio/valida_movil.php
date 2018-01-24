<?php 
include('../inc/libreria.php');
include('../inc/operaciones.php');
$link=conectarse();
$o=null;
$items[] = array();
$q = strtolower($_REQUEST["id_movil"]);
$cadena = trim($q); //le asignamos a cadena $Q sin espacios
$select = mysql_query("select * from frecuencia where id_movil like '%$cadena%'");
if(mysql_num_rows($select) == 0)
{
$fila=array("msg"=>"Movil no esta en frecuencia","lab"=>"Movil no esta en frecuencia");
$i=0; 
$msg="Movil no esta en frecuencia";
array_push($items,array("id_movil"=>$fila["msg"]));
echo json_encode($items);
}




//echo json_encode($output);


 ?>