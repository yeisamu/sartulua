<?php 

//include("dbconfig.php");
include('../inc/libreria.php');

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
//$id = $_GET['id']; 


$wh = "";
$searchOn = Strip($_REQUEST['_search']);
if($searchOn=='true') {
	$fld = Strip($_REQUEST['searchField']);
	if( $fld=='id_simit' || $fld=='codigo'|| $fld=='nombre1'|| $fld=='nombre2'|| $fld=='apellido1'|| $fld=='apellido2' || $fld=='n_parte'|| $fld=='cod_infraccion' || $fld=='eps'|| $fld=='valor'|| $fld=='fecha_parte'|| $fld=='fecha_pago'|| $fld=='estado' ) {
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
			
	
			case 'nombre':
			case 'placa':
			case 'apellidos':
			case 'grupo':
			case 'descripcion':
			
				$wd .= " and  ".$k." LIKE '%".$v."%'";
				break;
			case 'id_prop':
			
				$wd .= " and  propietario.id_prop LIKE '%".$v."%'";
				break;	
			case 'id_movil':
			
				$wd .= " and  vehiculo.id_movil LIKE '%".$v."%'";
				break;		
			case 'fecha_ven':
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
  $result = mysql_query("SELECT propietario.`id_prop`, nombre,apellidos,descripcion,fecha_ven,vehiculo.id_movil,placa,grupo FROM (vehiculo left join (veh_doc left join documentos_v on veh_doc.id_documento=documentos_v.id_documento) on vehiculo.id_movil=veh_doc.id_movil) left join propietario on vehiculo.id_prop=propietario.id_prop WHERE fecha_ven < now() and vehiculo.estado=1 ".$wh.$wd. "  order by nombre,apellidos asc ,fecha_ven desc");
//echo "SELECT propietario.`id_prop`, nombre,apellidos,descripcion,fecha_ven,vehiculo.id_movil,placa,grupo FROM (vehiculo inner join (veh_doc inner join documentos_v on veh_doc.id_documento=documentos_v.id_documento) on vehiculo.id_movil=veh_doc.id_movil) inner join propietario on vehiculo.id_prop=propietario.id_prop WHERE fecha_ven < now() ".$wh.$wd. "  order by nombre,apellidos asc ,fecha_ven desc";
 $row = mysql_num_rows($result);
  $count =$row;
		if( $count >0 ) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}
        if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit; // do not put $limit*($page - 1)
        if ($start<0) $start = 0;
	
    $responce->page = $page;
	$responce->total = $total_pages; 
	$responce->records = $count; $i=0; 
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
        
	$responce->rows[$i]['id']=$i; 
	$responce->rows[$i]['cell']=array($i,$row[id_prop],utf8_encode($row[nombre]),utf8_encode($row[apellidos]),$row[id_movil],$row[placa],$row[grupo],utf8_encode($row[descripcion]),$row[fecha_ven]); $i++; }
	//echo $SQL;
	echo json_encode($responce); 
	//echo $json->encode($responce); 
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
