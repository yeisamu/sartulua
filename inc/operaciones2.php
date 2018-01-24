<?php

function calcdia($fech,$f2){
	 $date1=$f2;
 	 $date2=$fech;
	 $s = strtotime($date1)-strtotime($date2);
	 $d = intval($s/86400);
	 $s -= $d*86400;
	 $h = intval($s/3600);
	 $s -= $h*3600;
	 $m = intval($s/60);
	 $s -= $m*60;
	 $dif= (($d*24)+$h).hrs." ".$m."min";
	 $dif2= $d;
	 $dif2=$dif2;
	 return $dif2;
}	


function deme_f_detalle($id_tarjeta,$id_doc){
 $consultadeta = "SELECT fecha_vence FROM `detalle_tarjeta` WHERE `id_tarjeta` ='$id_tarjeta' and tipo_doc='V' and id_doc=$id_doc";
 $resuldeta=mysql_query($consultadeta);  
	$detalle=mysql_fetch_array($resuldeta);
	$fecha_vendoc=$detalle['fecha_vence'];	  
	return 	$fecha_vendoc;
}


function deme_f_detallecon($id_tarjeta,$id_doc){
 $consultadeta = "SELECT fecha_vence FROM `detalle_tarjeta` WHERE `id_tarjeta` ='$id_tarjeta' and tipo_doc='C' and id_doc=$id_doc";
 $resuldeta=mysql_query($consultadeta);  
	$detalle=mysql_fetch_array($resuldeta);
	$fecha_vendoc=$detalle['fecha_vence'];	  
	return 	$fecha_vendoc;
}

function deme_usr_op($id_usuario,$id_opcion){
 $conusr="select * from acc_permiso where id_usr=$id_usuario and id_opcion=$id_opcion";
$sql=mysql_query($conusr);
$nfila=mysql_num_rows($sql);

if($nfila==0){

return false;
}
return true;


}

function deme_info($campo){
$consulta="select  $campo from info_sistema";
$sql=mysql_query($consulta);
$fila=mysql_fetch_array($sql);

$valor=mysql_result($sql,0,eval('$campo;'));
//echo $var="$"."fila['".$campo."'];";
//$valor=eval("echo $"."fila['".$campo."'];");

return $valor;
}

function sig_dia_habil($fecha){

$dif2=0;
$ndias = 0;
$dias_planilla=deme_plazo_planilla();
 $nfecha=aumenta_n_dia($fecha,$dias_planilla);
 while(es_festivo($nfecha)){
      $nfecha=aumenta_n_dia($nfecha,1);
	   
	   }
	    $fechaCom = strtotime($nfecha);

 //$calculo1= strtotime("7 hours", $calculo);
	   $nfechas= strtotime("7 hours", $fechaCom);
	  return date("Y-m-d h:i",$nfechas); 
}

function es_festivo($fecha){
$newfe=date("N-m-Y",strtotime($fecha));
 $consul="select * from festivos where fecha ='$fecha'";
 $query=mysql_query($consul);
 $num=mysql_num_rows($query);
  if($num > 0 || $newfe==7 ){
  
  return true;
  }
  return false;
}

function aumenta_dias($fecha,$can_dias){
 $fechaComparacion = strtotime($fecha);
 $calculo= strtotime("$can_dias days", $fechaComparacion);
 $calculo1= strtotime("7 hours", $calculo);
 $fecha_ok=date("Y-m-d h:i", $calculo1);
 return $fecha_ok;
} 
function aumenta_n_dia($fecha,$can_dias){
 $fechaComparacion = strtotime($fecha,$can_dias);
 //$can_dias=1;
 $calculo1= strtotime("$can_dias day", $fechaComparacion);
 //$calculo1= strtotime("7 hours", $calculo);
 $fecha_ok=date("Y-m-d", $calculo1);
 return $fecha_ok;
} 



function en_rango_planilla($n_planilla,$grupo){
 
 $consultarango=mysql_query("select * from empresa where inicio_p <= $n_planilla and fin_p >= $n_planilla and grupo='$grupo'");
$numr=mysql_num_rows($consultarango);
if($numr > 0){
return true;
}
return false;
}

function en_rango_pl($n_planilla,$grupo){
 
 $consultarango=mysql_query("SELECT * FROM `reporte_planilla` WHERE `n_planilla`=$n_planilla and `grupo`='$grupo'");
$numr=mysql_num_rows($consultarango);
if($numr > 0){
return true;
}
return false;
}

function existe_pl($n_planilla){
$selec=mysql_query("select * from planilla where n_planilla=$n_planilla");
$numrow=mysql_num_rows($selec);
if($numrow > 0){
return true;
}
return false;

} 

function nro_pl_disp($n_planilla,$grupo){

if(!en_rango_pl($n_planilla,$grupo) ||  existe_pl($n_planilla) ){

return false;
}
return true;

}

function deme_plazo_planilla(){
$consul=mysql_query("select plazo_planilla from info_sistema ");
$ndias=mysql_result($consul,0,'plazo_planilla');
return $ndias;
}

function deme_cuenta_planillas($id_movil){
$mes=date('m');
$consulta=mysql_query("select count(id_planilla) as total from planilla inner join tarjeta_control on planilla.id_tarjeta=tarjeta_control.id_tarjeta where planilla.estado <= 2 and substr(`fecha_inicio`,6,2)= $mes and id_movil=$id_movil ");
$totdias=mysql_result($consulta,0,'total');
return $totdias;

}

function inicio_planilla($grupo){
//echo $con="select inicio_p from empresa where grupo=$grupo";
$selec=mysql_query("select inicio_p from empresa where grupo='$grupo'");
$ini=mysql_fetch_array($selec);
$inicio_p=$ini['inicio_p'];
return $inicio_p;
}
function inicio_planilla2($grupo){
//echo $con="select inicio_p from empresa where grupo=$grupo";
$selec=mysql_query("select ini_2 from empresa where grupo='$grupo'");
$ini=mysql_fetch_array($selec);
$inicio_p=$ini['ini_2'];
return $inicio_p;
}
function fin_planilla($grupo){
$selec=mysql_query("select fin_p from empresa where grupo='$grupo'");
$ini=mysql_fetch_array($selec);
$fin_p=$ini['fin_p'];
return $fin_p;
}
function fin_planilla2($grupo){
$selec=mysql_query("select fin_2 from empresa where grupo='$grupo'");
$ini=mysql_fetch_array($selec);
$fin_p=$ini['fin_2'];
return $fin_p;
}

function datos_p($n_planilla){
$veri=mysql_query("select * from planilla where n_planilla=$n_planilla");
$ini=mysql_fetch_array($veri);
$fin_p=$ini['id_planilla'];
return $fin_p;
}
