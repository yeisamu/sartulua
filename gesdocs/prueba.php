<?php 
include('../inc/libreria.php');
include('../inc/operaciones.php');
$link=conectarse();
$fecha="2011-01-15";

echo sig_dia_habil($fecha);
 $nfecha=aumenta_dias($fecha , 1);
?>