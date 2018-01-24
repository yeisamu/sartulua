<?php
function reconversion($fecha)
{
$tok = strtok ($fecha,"-");
$i=0;
while ($tok) {
    $fecha10[$i]=$tok;
    $tok = strtok ("-");
	$i++;
}
$a=$fecha10[0];
$m=$fecha10[1];
$d=$fecha10[2];
$fecha=$d."/".$m."/".$a;
return $fecha;
}
?>