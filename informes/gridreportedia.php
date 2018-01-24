 <?php
//include("dbconfig.php");
include('../inc/libreria.php');
include('../inc/operaciones.php');
$examp = $_GET["q"]; 
//query number 
$page = $_GET['page']; 
// get the requested page 
$limit = $_GET['rows']; 
// get how many rows we want to have into the grid 
$sidx = $_GET['sidx']; 
// get index row - i.e. user click to sort 
$sord = $_GET['sord']; 
// get the direction 
$anio = $_GET['anio']; 

$tmes = $_GET['mes']; 
function consulta_ano($ano){
$meses = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'); 
$consulta="select servicio_h.linea";
for($mes=1; $mes<=12;$mes++){
   
    $consulta = $consulta.", sum(if(month(fecha_reg)=".$mes.",1,0)) as '".$meses[$mes - 1]."'"; 
}
$consulta = $consulta.", count(fecha_reg) as total,estado,case estado when 0 then 'Pendiente' when 1 then 'Asignado' when 2 then 'Descartado' end as est from servicio_h inner join linea_atencion on servicio_h.linea=linea_atencion.linea where year(fecha_reg)= ".$ano;
return $consulta;
}



function consulta_mes($mes, $ano){
$dias=date("d",(mktime(0,0,0,$mes+1,1,$ano)-1));
$consulta="select servicio_h.linea ";
for($dia=1; $dia<=$dias;$dia++){
    //$consulta = $consulta.", sum(if(day(fecha_reg)=".$dia.",1,0)) as '".$dia."'"; 
	   $inic=$ano.'-'.$mes.'-01 05:59:59';
	  $inicio=$ano.'-'.$mes.'-'.$dia.' 05:59:59';
	  if($dia==$dias){
	   $mesi=$mes+1;
	   $fin=$ano.'-'.$mesi.'-01 05:59:59';
	  }else{
	  $dia2=$dia+1;
	  $fin=$ano.'-'.$mes.'-'.$dia2.' 05:59:59';
	  }
	  
		 
        
	 $consulta = $consulta." , sum(if(fecha_reg > '$inicio' and  fecha_reg<'$fin' ,1,0))
	 as '".$dia."'"; 
	 //sum(if(if(time(fecha_reg)<'23:59:59' and time(fecha_reg)>'05:59:59',day(fecha_reg),day(DATE_SUB(fecha_reg,INTERVAL 1 day)))=".$dia.",1,0)) as '".$dia."'"; 
}
$consulta = $consulta.", count(fecha_reg) as total,servicio_h.estado,case servicio_h.estado when 0 then 'Pendiente' when 1 then 'Asignado' when 2 then 'Descartado' end as est from servicio_h inner join linea_atencion on servicio_h.linea=linea_atencion.linea  where fecha_reg > '$inic'  and fecha_reg<'$fin' and year(fecha_reg)= ".$ano;
return $consulta;
}

$wh = "";
$searchOn = Strip($_REQUEST['_search']);
if($searchOn=='true') {
	$fld = Strip($_REQUEST['searchField']);
	if( $fld=='id_movil' || $fld =='tarjeta' || $fld=='codigo'|| $fld=='nombre1'|| $fld=='nombre2'|| $fld=='apellido1'|| $fld=='apellido2' || $fld=='a.id_movil' || $fld=='fecha_vigencia'|| $fld=='fecha_elab' || $fld=='estado'|| $fld=='fecha_corte'|| $fld=='grupo' ) {
		$fldata = Strip($_REQUEST['searchString']);
		$foper = Strip($_REQUEST['searchOper']);
		// costruct where
		$wh .= " AND ".$fld;
		switch ($foper) {
			case "bw":
				$fldata .= "%";
				$wh .= " LIKE '".$fldata."'";
				break;
			case "eq":
				if(is_numeric($fldata)) {
					$wh .= " = ".$fldata;
				} else {
					$wh .= " = '".$fldata."'";
				}
				break;
			case "ne":
				if(is_numeric($fldata)) {
					$wh .= " <> ".$fldata;
				} else {
					$wh .= " <> '".$fldata."'";
				}
				break;
			case "lt":
				if(is_numeric($fldata)) {
					$wh .= " < ".$fldata;
				} else {
					$wh .= " < '".$fldata."'";
				}
				break;
			case "le":
				if(is_numeric($fldata)) {
					$wh .= " <= ".$fldata;
				} else {
					$wh .= " <= '".$fldata."'";
				}
				break;
			case "gt":
				if(is_numeric($fldata)) {
					$wh .= " > ".$fldata;
				} else {
					$wh .= " > '".$fldata."'";
				}
				break;
			case "ge":
				if(is_numeric($fldata)) {
					$wh .= " >= ".$fldata;
				} else {
					$wh .= " >= '".$fldata."'";
				}
				break;
			case "ew":
				$wh .= " LIKE '%".$fldata."'";
				break;
			case "cn":
				$wh .= " LIKE '%".$fldata."%'";
				break;
			default :
				$wh = "";
		}
	}
}

$wd = "";
$searchOn = Strip($_REQUEST['_search']);
if($searchOn=='true') {
	$sarr = Strip($_REQUEST);
	foreach( $sarr as $k=>$v) {
		switch ($k) {
			case 'estado':
				$wd .= " and ".$k." =".$v;
				break;
			
			//case 'tax':
			case 'linea':
			//case 'fecha_vigencia':
//			case 'fecha_plazo_a':
				$wd .= " AND linea LIKE '%".$v."%'";
				break;
			case 'placa':
				$wd .= " and ".$k." LIKE '%".$v."%'";
				break;
		}
	}
}


if(!$sidx) $sidx =1; 
//connect to the database 
$db = mysql_connect($dbhost, $dbuser, $dbpassword) or die("Connection Error: " . mysql_error()); mysql_select_db($database) or die("Error conecting to db.");
///bussqueda

 switch ($examp) 
 { case 1:

//echo $var="SELECT COUNT(*) AS count from vehiculo where id_movil in (select distinct  vehiculo.id_movil from vehiculo inner join veh_doc on vehiculo.id_movil=veh_doc.id_movil where  (DATE_FORMAT(concat(fecha_ven,' 11:59:59'),'%Y/%m/%d %H:%i') < DATE_FORMAT(now(),'%Y/%m/%d %H:%i') ) OR ADDDATE( DATE_FORMAT( concat( vehiculo.pago_hasta, ' 11:59:59' ) , '%Y/%m/%d %H:%i' ) , $can_dias ) < DATE_FORMAT( now( ) , '%Y/%m/%d %H:%i' )) and vehiculo.id_movil not in (select id_movil from convenio) ".$wd;
// $var="SELECT COUNT(*) AS count from servicio where 1 ".$wh.$wd;
   $result = mysql_query("SELECT COUNT(*) AS count from servicio_h where 1 ".$wh.$wd);
   $row = mysql_fetch_array($result,MYSQL_ASSOC);
 $count =1; 
 //$row['count'];
		if( $count >0 ) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}
        if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit; // do not put $limit*($page - 1)
        if ($start<0) $start = 0;
		
		 $SQL = consulta_mes($tmes,$anio).$wd." group by servicio_h.linea order by ".$sidx." ". $sord;
 // "SELECT distinct(year(`fecha_reg`)) as anio FROM `servicio`  ORDER BY ".$sidx." ". $sord." LIMIT ".$start." , ".$limit; 
      $result = mysql_query( $SQL ) or die("Couldn?t execute query.".mysql_error());
	   $responce->page = $page;
	$responce->total = $total_pages; 
	$responce->records = $count; $i=0; 
		 $meses=array(1=>'ENERO',2=>'FEBRERO',3=>'MARZO',4=>'ABRIL',5=>'MAYO',6=>'JUNIO',7=>'JULIO',8=>'AGOSTO',9=>'SEPTIEMBRE',10=>'OCTUBRE',11=>'NOVIEMBRE',12=>'DICIEMBRE');
$vmes=$meses[$tmes];
	$imp="";
		 $dias=date("d",(mktime(0,0,0,$tmes+1,1,$anio)-1));
	$imp="$"."responce->rows["."$"."i]['cell']=array("."utf8_encode($"."row[linea]),"."$"."vmes,";	 
	for($dia=1; $dia<=$dias;$dia++){ 
	 // $tot=$tot+$row[$dia];
      $imp=$imp."$"."row[$dia]".",";
	
	  
	 }
	$imp=$imp."$"."row[total],"."$"."row[est]);";
	 //echo  $impi;
	 
	 

	 
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
	//$url="reporteanio.php";
		$responce->rows[$i]['id']=$row[linea]; 
	
	  //$impi=eval($imp);

	 // colNames: ["Linea",'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE','Estado'],

	 
	 
	
	//$responce->rows[$i]['cell']=array($row[linea],$tmes,$impi,$row[total],$row[est]); $i++; }
	//$responce->rows[$i]['cell']=array($row[linea],$tmes,$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10],$row[11],$row[12],$row[13],$row[14],$row[15],$row[16],$row[17],$row[18],$row[19],$row[20],$row[21],$row[22],$row[23],$row[24],$row[25],$row[26],$row[27],$row[28],$row[29],$row[total],$row[est]);
	//echo $SQL;
	eval($imp);
	//$responce->rows[$i]['cell']=array($row[linea],$tmes,$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10],$row[11],$row[12],$row[13],$row[14],$row[15],$row[16],$row[17],$row[18],$row[19],$row[20],$row[21],$row[22],$row[23],$row[24],$row[25],$row[26],$row[27],$row[28],$row[29],$row[30],$row[total],$row[est]);
	$i++; }
	echo json_encode($responce); 
	//echo $json->encode($responce); 
	break; 
	
	case 2:
		/* ----====|| ACTION = DELETE ||====----*/
		//if($DEBUGMODE == 1){$firephp->info('DELETE','action');}
		$id=$_REQUEST['id'];
		$sqls = 'Delete from novedad_servicio where id_nov_serv='.$id;
		 $result = mysql_query( $sqls ) or die("Couldn?t execute query.".mysql_error());
		 echo json_encode($responce); 
		break;
	} 
	
	function Strip($value)
{
	if(get_magic_quotes_gpc() != 0)
  	{
    	if(is_array($value))  
			if ( array_is_associative($value) )
			{
				foreach( $value as $k=>$v)
					$tmp_val[$k] = stripslashes($v);
				$value = $tmp_val; 
			}				
			else  
				for($j = 0; $j < sizeof($value); $j++)
        			$value[$j] = stripslashes($value[$j]);
		else
			$value = stripslashes($value);
	}
	return $value;
}
function array_is_associative ($array)
{
    if ( is_array($array) && ! empty($array) )
    {
        for ( $iterator = count($array) - 1; $iterator; $iterator-- )
        {
            if ( ! array_key_exists($iterator, $array) ) { return true; }
        }
        return ! array_key_exists(0, $array);
    }
    return false;
}
?>