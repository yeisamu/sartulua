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
			
			case 'codigo':
			case 'documento':
			case 'nombre1':
			case 'nombre2':
			case 'apellido1':
			case 'apellido2':
				$wd .= " and ".$k." LIKE '%".$v."%'";
				break;
			case 'fecha_vence':
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
  $result = mysql_query("SELECT conductor.`id_conductor`,codigo,nombre1,nombre2,apellido1,apellido2,documento,fecha_vence FROM conductor inner join (con_doc inner join documento on con_doc.id_doc=documento.id_doc) ON conductor.`id_conductor` = con_doc.`id_conductor` WHERE fecha_vence < now() and documento.id_doc=20 ".$wh.$wd. "  order by fecha_vence asc");
//echo "SELECT b.`id_conductor`,codigo,nombre1,nombre2,apellido1,apellido2,documento,fecha_vence FROM conductor inner join (con_doc inner join documento on con_doc.id_doc=documento.id_doc) ON conductor.`id_conductor` = con_doc.`id_conductor` WHERE fecha_vence < now()  order by fecha_vence desc".$wh.$wd;
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
       $result2 = mysql_query("SELECT conductor.`id_conductor`,codigo,nombre1,nombre2,apellido1,apellido2,documento,fecha_vence FROM conductor inner join (con_doc inner join documento on con_doc.id_doc=documento.id_doc) ON conductor.`id_conductor` = con_doc.`id_conductor` WHERE fecha_vence < now() and documento.id_doc=20 ".$wh.$wd. "  order by fecha_vence asc LIMIT ".$start.",".$limit);
	while($row = mysql_fetch_array($result2,MYSQL_ASSOC)) { 
        
	$responce->rows[$i]['id']=$row[id_conductor]; 
	$responce->rows[$i]['cell']=array($row[id_conductor],$row[codigo],$row[nombre1],$row[nombre2],$row[apellido1],$row[apellido2],$row[documento],$row[fecha_vence]); $i++; }
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
