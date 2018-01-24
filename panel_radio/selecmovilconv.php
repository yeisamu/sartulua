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
$can_dias=deme_info("plazo_diarios") ; 
$select = mysql_query("SELECT vehiculo.id_movil,placa,grupo from vehiculo where id_movil in (select distinct  vehiculo.id_movil from vehiculo inner join veh_doc on vehiculo.id_movil=veh_doc.id_movil where  (DATE_FORMAT(concat(fecha_ven,' 11:59:59'),'%Y-%m-%d %H:%i') < DATE_FORMAT(now(),'%Y-%m-%d %H:%i') ) OR ADDDATE( DATE_FORMAT( concat( vehiculo.pago_hasta, ' 11:59:59' ) , '%Y-%m-%d %H:%i' ) , $can_dias ) < DATE_FORMAT( now( ) , '%Y-%m-%d %H:%i' )) and vehiculo.id_movil not in (select id_movil from convenio) and   vehiculo.id_movil like '%$cadena%' order by vehiculo.id_movil asc ");
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