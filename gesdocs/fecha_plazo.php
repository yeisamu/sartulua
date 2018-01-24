<?php
include('../inc/libreria.php');
include('../inc/operaciones.php');
$link=conectarse();
//funcion para actualizacion de campo fecha_plazo_a (fecha de corte)
//tomar la fecha de vigencia de la tarjeta
$select="select id_tarjeta,id_movil,fecha_vigencia from tarjeta_control ";
$sql=mysql_query($select);


while($fila=mysql_fetch_array($sql)){
$fecha_vence=$fila['fecha_vigencia'];
$id_tarj=$fila['id_tarjeta'];
 $fecha_corte=aumenta_dias($fecha_vence,1);
 $fila['fecha_vigencia'].' '.$fila['id_movil'].' '.$fecha_corte."<br>";
$actualiza="update tarjeta_control set fecha_plazo_a='$fecha_corte' where id_tarjeta=$id_tarj";
$query=mysql_query($actualiza);

} 



$select1="select id_tarjeta,fecha_plazo_a,if(`fecha_plazo_a`<DATE_FORMAT(now(),'%Y/%m/%d %h:%i'),'0','1') as est_new from tarjeta_control ";
$sql1=mysql_query($select1);
while($fila1=mysql_fetch_array($sql1)){
$id_tarj1=$fila1['id_tarjeta'];
$new_fecha=$fila1['est_new'];
 $fila1['fecha_plazo_a'].' '.$fila1['est_new']."<br>";
$actualiza="update tarjeta_control set est_ant=$new_fecha where id_tarjeta=$id_tarj1";
$query1=mysql_query($actualiza);
}

if(!$query || !$query1){
echo "error";

}else{
echo "ok";
}

?>