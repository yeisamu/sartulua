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
	if( $fld=='id_tarjeta' || $fld =='tarjeta' || $fld=='codigo'|| $fld=='nombre1'|| $fld=='nombre2'|| $fld=='apellido1'|| $fld=='apellido2' || $fld=='a.id_movil' || $fld=='fecha_vigencia'|| $fld=='fecha_elab' || $fld=='estado'|| $fld=='fecha_corte'|| $fld=='grupo' ) {
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
			case 'codigo':
			case 'nombre1':
			case 'nombre2':
			case 'apellido1':
			case 'apellido2':
				$wd .= " and ".$k." LIKE '%".$v."%'";
				break;
			
			//case 'tax':
			case 'id_movil':
			//case 'fecha_vigencia':
//			case 'fecha_plazo_a':
				$wd .= " AND a.id_movil LIKE '%".$v."%'";
				break;
			case 'fecha_vigencia':
			case 'fecha_plazo_a':
				$wd .= " AND ".$k." >= '".$v."'";
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
  $result = mysql_query("SELECT COUNT(*) AS count from (tarjeta_control a inner join vehiculo on a.id_movil=vehiculo.id_movil)
INNER JOIN conductor b ON a.`id_conductor` = b.`id_conductor` WHERE a.estado = 1  and `fecha_plazo_a` >DATE_FORMAT(now(),'%Y/%m/%d %H:%i') ".$wh.$wd);
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
   $SQL = "SELECT b.`id_conductor` ,`id_tarjeta`,`tarjeta`, codigo,nombre1,nombre2,apellido1,apellido2,a.`id_movil` as id_movil, fecha_vigencia,fecha_plazo_a,if(`fecha_plazo_a`<DATE_FORMAT(now(),'%Y/%m/%d %H:%i'),'Suspendido','Permitido') as servicio ,est_ant,if(`fecha_plazo_a`<DATE_FORMAT(now(),'%Y/%m/%d %H:%i'),'0','1') as est_new,grupo,id_tarjeta FROM (tarjeta_control a inner join vehiculo on a.id_movil=vehiculo.id_movil)
INNER JOIN conductor b ON a.`id_conductor` = b.`id_conductor` WHERE a.estado = 1 having servicio='Permitido'  ".$wh.$wd." ORDER BY ".$sidx." ". $sord." LIMIT ".$start." , ".$limit; 
      $result = mysql_query( $SQL ) or die("Couldn?t execute query.".mysql_error());
	   $consu="select planillas_mes from info_sistema";
	 $resultado = mysql_query( $consu ) or die("Couldn?t execute query.".mysql_error());
	 $fila = mysql_fetch_array($resultado,MYSQL_ASSOC) ; 
    $responce->page = $page;
	$responce->total = $total_pages; 
	$responce->records = $count; $i=0; 
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
	$dia_movil=$row[id_movil];
	$idtarje=$row[id_tarjeta]; 
	 $totdiamovil=deme_cuenta_planillas($dia_movil);
        $docguia =mysql_query("SELECT id_comp,observaciones FROM  `comprobante` WHERE comprobante.id_comprobante=$idtarje order by id_comp desc limit 0,1");
	$filaguia=mysql_fetch_array($docguia);
	$responce->rows[$i]['id']=$row[id_tarjeta]; 
	$responce->rows[$i]['cell']=array($row[id_tarjeta],$row[tarjeta],$row[codigo],utf8_encode($row[nombre1]),utf8_encode($row[nombre2]),utf8_encode($row[apellido1]),utf8_encode($row[apellido2]),$row[id_movil],$row[fecha_vigencia],$row[id_conductor],$row[fecha_plazo_a],$row[servicio],$row[est_ant],$row[est_new],$row[grupo],$fila[planillas_mes],$totdiamovil,'',utf8_encode($filaguia[observaciones])); $i++; }
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
