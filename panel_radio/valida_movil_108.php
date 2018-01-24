<?php
include('../inc/libreria.php');
include('../inc/operaciones.php');
$link=conectarse();
$q = strtolower($_GET["term"]);
if (!$q) return; //si no nos trae nada retornamos
$items[] = array();//creamos un array llamado items
//$nombre[] = array();
$cadena = trim($q); //le asignamos a cadena $Q sin espacios
//conectamos con mysq
/*$con_mysql=mysql_connect('localhost','root',''); //nos conectamos con la BD
// verificamos si la conexion con mysql ha sido exitosa
if (!$con_mysql) {echo 'No se ha podido encontrar el servidor de datos';exit;}
// si fue exitosa nos conectmos a la basse de datos empresa
mysql_select_db('sar',$con_mysql);*/
//consultamos los registros coincidentes, en este caso por apellido
//echo $ccon="select * from vehiculo where id_movil like '%$cadena%'";
$i=0; 
$msg="";
// Validar si el movil existe
//echo $consu="SELECT HIGH_PRIORITY distinct(vehiculo.id_movil) from vehiculo inner join tarjeta_control on vehiculo.id_movil = tarjeta_control.id_movil where  DATE_FORMAT(tarjeta_control.fecha_plazo_a , '%Y-%m-%d %H:%i' )  > DATE_FORMAT(now(),'%Y-%m-%d %H:%i') and tarjeta_control.estado=1  and vehiculo.id_movil not in(SELECT id_movil
//FROM (
//(
//
//SELECT id_movil
//FROM veh_doc
//WHERE DATE_FORMAT( concat( veh_doc.fecha_ven, ' 11:59:59' ) , '%Y-%m-%d %H:%i' ) < DATE_FORMAT( now( ) , '%Y-%m-%d %H:%i' )
//)
//UNION (
//
//SELECT suspension.id_movil
//FROM suspension
//WHERE DATE_FORMAT( now( ) , '%Y-%m-%d %H:%i' ) > DATE_FORMAT( suspension.f_inicio, '%Y/%m/%d %H:%i' ) and DATE_FORMAT( now( ) , '%Y-%m-%d %H:%i' ) <= DATE_FORMAT( suspension.f_fin, '%Y/%m/%d %H:%i' )
//)
//UNION (
//
//SELECT frecuencia.id_movil
//FROM frecuencia
//)
//)r)  and vehiculo.id_movil like '%$cadena%'";
$result=mysql_query("SELECT HIGH_PRIORITY distinct(vehiculo.id_movil) from vehiculo inner join tarjeta_control on vehiculo.id_movil = tarjeta_control.id_movil where  DATE_FORMAT(tarjeta_control.fecha_plazo_a , '%Y-%m-%d %H:%i' )  > DATE_FORMAT(now(),'%Y-%m-%d %H:%i') and tarjeta_control.estado=1  and vehiculo.id_movil not in(SELECT id_movil
FROM (
(

SELECT id_movil
FROM veh_doc
WHERE DATE_FORMAT(  DATE_ADD(concat( veh_doc.fecha_ven, ' 06:59:59' ),INTERVAL 1 DAY)  , '%Y-%m-%d %H:%i' ) < DATE_FORMAT( now( ) , '%Y-%m-%d %H:%i' )
)
UNION (

SELECT suspension.id_movil
FROM suspension
WHERE DATE_FORMAT( now( ) , '%Y-%m-%d %H:%i' ) > DATE_FORMAT( suspension.f_inicio, '%Y-%m-%d %H:%i' ) and DATE_FORMAT( now( ) , '%Y-%m-%d %H:%i' ) <= DATE_FORMAT( suspension.f_fin, '%Y-%m-%d %H:%i' )
)
UNION (

SELECT frecuencia.id_movil
FROM frecuencia
)
)r)  and vehiculo.id_movil like '%$cadena%'");

if(mysql_num_rows($result) > 0)
{
//montamos bucle para presentar los items de la lista
$a=0; //creo una variable del tipo entero
while($filab=mysql_fetch_array($result))
{
    $a++; //incremento
 //insertamos en el array los datos

array_push($items,array("id"=>$a,"label"=>$filab["id_movil"],"value"=>$filab["id_movil"] ));

//,"estado" => $fila["primer_nombre"]." ".$fila["segundo_nombre"]." ".$fila["primer_apellido"]." ".$fila["segundo_apellido"],"direccion" => $fila["direccion"]
//array_push($nombre,array("id"=>$i,"label"=>$fila["primer_nombre"],"value"=>$fila["primer_nombre"] ));
}
echo json_encode($items);
}


else{

// Validar si el movil existe
//echo $con="SELECT id_movil FROM vehiculo where  id_movil like '%$cadena%'";
$select = mysql_query("SELECT id_movil FROM vehiculo where  id_movil = '$cadena'");

if(mysql_num_rows($select) == 0)
{
$msg=$msg."--No Existe";
$fila=array("msg"=>$msg,"lab"=>$msg);
} else {
//Validar si el movil esta suspendido
//echo $con="SELECT suspension.id_movil FROM suspension WHERE DATE_FORMAT( now( ) , '%Y-%m-%d %H:%i' ) > DATE_FORMAT( suspension.f_inicio, '%Y/%m/%d %H:%i' ) and DATE_FORMAT( now( ) , '%Y-%m-%d %H:%i' ) <= DATE_FORMAT( suspension.f_fin, '%Y/%m/%d %H:%i' ) and suspension.id_movil like '%$cadena%'";
$select = mysql_query("SELECT suspension.id_movil FROM suspension WHERE DATE_FORMAT( now( ) , '%Y-%m-%d %H:%i' ) > DATE_FORMAT( suspension.f_inicio, '%Y-%m-%d %H:%i' ) and DATE_FORMAT( now( ) , '%Y-%m-%d %H:%i' ) <= DATE_FORMAT( suspension.f_fin, '%Y-%m-%d %H:%i' ) and suspension.id_movil= '$cadena'");
if(mysql_num_rows($select) > 0)
{
$msg=$msg."--Suspendido 10-7";
$fila=array("msg"=>$msg,"lab"=>$msg);



}
// Validar si el movil ya esta en frecuencia

$select = mysql_query("SELECT frecuencia.id_movil
FROM frecuencia where  frecuencia.id_movil='$cadena'");

if(mysql_num_rows($select) > 0)
{
$msg=$msg."--Esta 10-8";
$fila=array("msg"=>$msg,"lab"=>$msg);

}




// Validar si el movil tiene algun documento vencido
 
$select = mysql_query("SELECT id_movil FROM veh_doc WHERE DATE_FORMAT( concat( veh_doc.fecha_ven, ' 11:59:59' ) , '%Y-%m-%d %H:%i' ) < DATE_FORMAT( now( ) , '%Y-%m-%d %H:%i' ) and veh_doc.id_movil ='$cadena'");
if(mysql_num_rows($select) > 0)
{
$msg=$msg."--Documento Vencido";
$fila=array("msg"=>$msg,"lab"=>$msg);

}
//Validar si el movil tiene tarjetas activas

$select = mysql_query("SELECT id_movil FROM tarjeta_control where  DATE_FORMAT(tarjeta_control.fecha_plazo_a , '%Y-%m-%d %H:%i' )  > DATE_FORMAT(now(),'%Y-%m-%d %H:%i') and tarjeta_control.estado=1  and tarjeta_control.id_movil = '$cadena'" );
if(mysql_num_rows($select) == 0)
{
$msg=$msg."--Sin Tarjetas Activas";
$fila=array("msg"=>$msg,"lab"=>$msg);


}
}
array_push($items,array("id"=>$i,"id_movil"=>$fila["msg"],"value"=>$fila["lab"]));
//presentacion de los mensajes
echo json_encode($items);
}

?>