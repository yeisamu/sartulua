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
$id_movil = $_GET['id_movil']; 

$wh = "";
$searchOn = Strip($_REQUEST['_search']);
if($searchOn=='true') {
	$fld = Strip($_REQUEST['searchField']);
	if( $fld=='id_planilla' || $fld =='n_planilla' || $fld=='fecha_eleboracion' || $fld=='id_movil' || $fld=='ciudad_d'|| $fld=='fecha_inicio' || $fld=='fecha_retorno' ) {
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


$wh1 = "";
$searchOn = Strip($_REQUEST['_search']);
if($searchOn=='true') {
	$sarr = Strip($_REQUEST);
	foreach( $sarr as $k=>$v) {
		switch ($k) {
			//case 'codigo':
//			case 'nombre1':
//			case 'nombre2':
			case 'n_planilla':
				$wh1 .= " and ".$k." LIKE '".$v."%'";
				break;
			//case 'apellido2':
			//case 'tax':
//			case 'total':
//				$wh .= " AND ".$k." = ".$v;
//				break;
		}
	}
}
if(!$sidx) $sidx =1; 
//connect to the database 
$db = mysql_connect($dbhost, $dbuser, $dbpassword) or die("Connection Error: " . mysql_error()); mysql_select_db($database) or die("Error conecting to db.");
///bussqueda

 switch ($examp) 
 { case 1:
 $mes=date('m');
  $result = mysql_query("SELECT COUNT(*) AS count from planilla inner join tarjeta_control on planilla.id_tarjeta=tarjeta_control.id_tarjeta where planilla.estado <= 3  and id_conductor=".$id." and id_movil not in (".$id_movil.")".$wh1);
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
   $SQL = "SELECT id_planilla, `n_planilla` ,fecha_elaboracion, `id_movil` , `ciudad_d` , fecha_inicio, fecha_retorno, fecha_plazo_e,
CASE planilla.`estado` when 1 then 'En Circulacion' when 2 then 'Devuelta' when 3 then 'Anulada' when 4 then 'Descartada' END AS estado, if(`fecha_retorno`<DATE_FORMAT(DATE_ADD(DATE_SUB(now(), INTERVAL 5 DAY),INTERVAL 8 HOUR),'%Y/%m/%d %H:%i')
AND planilla.estado =1, 'Retrazada', 'Normal' ) AS observacion
FROM planilla
INNER JOIN tarjeta_control ON planilla.id_tarjeta = tarjeta_control.id_tarjeta
WHERE planilla.estado <=3 and id_conductor=".$id." and id_movil not in (".$id_movil.")".$wh1.$wh." ORDER BY ".$sidx." ". $sord." LIMIT ".$start." , ".$limit; 
      $result = mysql_query( $SQL ) or die("Couldn?t execute query.".mysql_error());
	  
    $responce->page = $page;
	$responce->total = $total_pages; 
	$responce->records = $count; $i=0; 
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
	$responce->rows[$i]['id']=$row[id_planilla]; 
	$responce->rows[$i]['cell']=array($row[id_planilla],$row[n_planilla],$row[fecha_elaboracion],$row[id_movil],$row[ciudad_d],$row[fecha_inicio],$row[fecha_retorno],$row[fecha_plazo_e],$row[estado],$row[observacion]); $i++; }
	echo json_encode($responce); 
	break; } 
	
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
	?>
