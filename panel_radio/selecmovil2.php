<?php
include('../inc/libreria.php');
include('../inc/operaciones.php');
$link=conectarse();
$q = strtolower($_GET["term"]);
if (!$q) return; //si no nos trae nada retornamos
$items[] = array();//creamos un array llamado items
//$nombre[] = array();
$cadena = trim($q); //le asignamos a cadena $Q sin espacios
//conectamos con mysql y con la base de datos
/*$con_mysql=mysql_connect('localhost','root',''); //nos conectamos con la BD
// verificamos si la conexion con mysql ha sido exitosa
if (!$con_mysql) {echo 'No se ha podido encontrar el servidor de datos';exit;}
// si fue exitosa nos conectmos a la basse de datos empresa
mysql_select_db('sar',$con_mysql);*/
//consultamos los registros coincidentes, en este caso por apellido
//echo $ccon="select * from vehiculo where id_movil like '%$cadena%'";
$select = mysql_query("select * from frecuencia where id_movil like '%$cadena%'");
//si no hay registros retornamos
if(mysql_num_rows($select) == 0)
{
//return false;
echo "<script>alert('no existe');</script>";
}
else// para el caso q si haya registro conincidentes
{
//montamos bucle para presentar los items de la lista
$i=0; //creo una variable del tipo entero
while($fila=mysql_fetch_array($select))
{
    $i++; //incremento
 //insertamos en el array los datos
 $can_dias=deme_info("plazo_diarios") ; 
// $dias= (int) $can_dias; 	
 $fecha_vigencia=$fila["pago_hasta"]; 

 
 $fechaComparacion = strtotime($fecha_vigencia);
 $calculo= strtotime("$can_dias days", $fechaComparacion);
 $fecha_ok=date("Y-m-d", $calculo);

  
array_push($items,array("id"=>$i,"label"=>$fila["id_movil"],"value"=>$fila["id_movil"] ));

//,"estado" => $fila["primer_nombre"]." ".$fila["segundo_nombre"]." ".$fila["primer_apellido"]." ".$fila["segundo_apellido"],"direccion" => $fila["direccion"]
//array_push($nombre,array("id"=>$i,"label"=>$fila["primer_nombre"],"value"=>$fila["primer_nombre"] ));
}
}
//pasamos el array a formato JSON y lo imprimimos
echo json_encode($items);
//echo json_encode($nombre);
?>