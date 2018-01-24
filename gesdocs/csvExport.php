<?php
$fechas=date('Y-m-dh:i');
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=reporte$fechas.xls");
header("Pragma: no-cache");
$x = $_POST['x'];
eval('$'.'buffer ='.'$'.'_POST["csvBuffer'.$x.'"];');

try{
    echo $buffer;
}catch(Exception $e){

}
?>
