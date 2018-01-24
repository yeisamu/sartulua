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
			case 'n_parte':
			case 'grupo':
			case 'codigo':
			case 'cod_infraccion':
			case 'eps':
			case 'nombre1':
			case 'nombre2':
			case 'apellido1':
			case 'apellido2':
			
				$wd .= " and ".$k." LIKE '%".$v."%'";
				break;
			
			//case 'tax':
			
			case 'fecha_parte':
			case 'fecha_pago':
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
  $result = mysql_query("SELECT COUNT(*) AS count  FROM (`simit` left join conductor on simit.`id_conductor`=conductor.`id_conductor`) left join entidad_salud on simit.`id_eps`=entidad_salud.`id_eps`  ".$wh.$wd);
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
   $SQL = "SELECT conductor.id_conductor,id_simit,codigo,nombre1,nombre2,apellido1,apellido2,n_parte,`cod_infraccion`,eps,`valor`,`fecha_parte`,`fecha_pago`,case simit.`estado` WHEN 1 THEN 'Activa' WHEN 2 THEN 'Pago' WHEN 3 THEN 'Sin Multas' WHEN 4 THEN 'Multas Con Convenio' END as estado,convenio,observacion,grupo FROM (`simit` left join ((tarjeta_control left join vehiculo on tarjeta_control.id_movil=vehiculo.id_movil) left join conductor on tarjeta_control.id_conductor=conductor.id_conductor) on simit.`id_conductor`=conductor.`id_conductor`) left join entidad_salud on simit.`id_eps`=entidad_salud.`id_eps`".$wh.$wd." group by conductor.id_conductor ORDER BY ".$sidx." ". $sord." LIMIT ".$start." , ".$limit; 
      $result = mysql_query( $SQL ) or die("Couldn?t execute query.".mysql_error());
	
    $responce->page = $page;
	$responce->total = $total_pages; 
	$responce->records = $count; $i=0; 
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
	$id_cond=$row[id_conductor];
	 $consulta="select * from (tarjeta_control inner join vehiculo on tarjeta_control.id_movil=vehiculo.id_movil) inner join conductor on tarjeta_control.id_conductor=conductor.id_conductor where conductor.id_conductor=$id_cond ";
	 $resultado = mysql_query( $consulta ) or die("Couldn?t execute query.".mysql_error());
	 $rowmovil=mysql_fetch_array($resultado,MYSQL_ASSOC);
	$responce->rows[$i]['id']=$row[id_simit]; 
	$responce->rows[$i]['cell']=array($row[id_simit],$row[codigo],utf8_encode($row[nombre1]),utf8_encode($row[nombre2]),utf8_encode($row[apellido1]),utf8_encode($row[apellido2]),$row[n_parte],$row[cod_infraccion],$row[eps],$row[valor],$row[fecha_parte],$row[fecha_pago],$row[convenio],utf8_encode($row[observacion]),$row[estado],$row[grupo]); $i++; }
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
