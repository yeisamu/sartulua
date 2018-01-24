<?php
 include('../inc/libreria.php');
 include('../inc/operaciones.php');
 $link=conectarse();
 $consulta="select * from acc_usuario";
 $sqlusu=mysql_query($consulta);
 while($filausu=mysql_fetch_array($sqlusu)){
 $id_usr=$filausu['id_usr'];
$conopc="select * from acc_opcion";
 $sqlopc=mysql_query($conopc);
 while($filaop=mysql_fetch_array($sqlopc)){
  $id_opc=$filaop['id_opcion'];
 if(!deme_usr_op($id_usr,$id_opc)){
 $inser="insert into `acc_permiso` (`id_usr`, `id_opcion`, `permiso`) values ($id_usr,$id_opc,0)";
 $query=mysql_query($inser); 
 }///fin if
 
 }//fin while opcion 
 
 }//fin while usr
 
 if(!$query){
 echo "operacion no realizada";
 }else{
 echo "ok";
 }
 ?>