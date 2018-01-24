<?php
include('../inc/libreria.php');
$link=conectarse();
$fechact=date('Y-m-d');
$q = strtolower($_GET["term"]);
if (!$q) return; //si no nos trae nada retornamos
$items[] = array();//creamos un array llamado items
$cadena = trim($q); //le asignamos a cadena $Q sin espacios
//consultamos los registros coincidentes, en este caso por apellido
$select = mysql_query("SELECT * FROM conductor where codigo LIKE '%$cadena%'");
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

 
array_push($items,array("id"=>$i,"label"=>$fila["codigo"],"value"=>$fila["codigo"],"nombre" =>$fila["nombre1"].'  '.$fila["nombre2"],"apellidos" =>$fila["apellido1"].' '.$fila["apellido2"],"id_con"=>$fila["id_conductor"],"rh"=>$fila["tipo_rh"],"direccion" => $fila["direccion"],"tele" => $fila["telefono"],"acu" => $fila["acudiente"],"telea" => $fila["telefonoa"],"cel" => $fila["celulara"]));
}
}
//pasamos el array a formato JSON y lo imprimimos
echo json_encode($items);

?>