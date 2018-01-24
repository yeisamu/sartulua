<?php
include('inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db<a href="inc/libreria.php"></a>
		$link=conectarse();
		
$datos=mysql_query("SELECT *
FROM `comp_servicio`
WHERE (
`id_tran` >=17
AND `id_tran` <=17
)
AND (
`fecha` >= '2012-06-06 23:44:06'
AND `fecha` <= '2012-06-09 12:32:21'
)

");	
$i=8635;
while($fila=mysql_fetch_array($datos)){
$fecha=$fila['fecha'];
$id_movil=$fila['id_movil'];
$usr=$fila['usuario'];
$placa=$fila['placa'];
$id_tarjeta=$fila['id_tarjeta'];
$tarjeta=$fila['tarjeta'];
$id_conductor=$fila['id_conductor'];
$codigo=$fila['codigo'];
$nombres=$fila['nombres'];


$actualiza=mysql_query("update  `servicio_h` set  `fecha_reg`='$fecha',`id_movil`='$id_movil', `placa`='$placa', `fecha_asig`='$fecha', `id_tarjeta`=$id_tarjeta, `tarjeta`='$tarjeta', `id_conductor`='$id_conductor', `codigo`='$codigo', `nombres`='$nombres', `estado`=2,`usuario`='$usr' where  id_ser = $i");
$i++;
}
		
		
		?>