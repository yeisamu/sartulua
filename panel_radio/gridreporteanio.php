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
$id = $_GET['id']; 

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
			case 'grupo':
				$wd .= " and ".$k." LIKE '%".$v."%'";
				break;
			
			//case 'tax':
			case 'id_movil':
			//case 'fecha_vigencia':
//			case 'fecha_plazo_a':
				$wd .= " AND vehiculo.id_movil LIKE '%".$v."%'";
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
   $result = mysql_query("SELECT COUNT(*) AS count from servicio_h".$wh.$wd);
   $row = mysql_fetch_array($result,MYSQL_ASSOC);
 $count = $row['count'];
		if( $count >0 ) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}
        if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit; // do not put $limit*($page - 1)
        if ($start<0) $start = 0;
 $SQL = "SELECT distinct(year(`fecha_reg`)) as anio FROM `servicio_h`  ORDER BY ".$sidx." ". $sord." LIMIT ".$start." , ".$limit; 
      $result = mysql_query( $SQL ) or die("Couldn?t execute query.".mysql_error());
	   $responce->page = $page;
	$responce->total = $total_pages; 
	$responce->records = $count; $i=0; 
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
	$url="reposervicio.php";
	$responce->rows[$i]['id']=$row[anio]; 
	$responce->rows[$i]['cell']=array($row[anio],$url); $i++; }
	//echo $SQL;
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