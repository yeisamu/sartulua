<?php
 include('../inc/libreria.php');
 include('../inc/operaciones.php');
 $link=conectarse();
 $consulta="TRUNCATE TABLE `acc_permiso`";
 $sqlusu=mysql_query($consulta);
?>