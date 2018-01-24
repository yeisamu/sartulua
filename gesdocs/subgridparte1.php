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
$id = $_GET['id']; 


$wh = "";
$searchOn = Strip($_REQUEST['_search']);
if($searchOn=='true') {
	$fld = Strip($_REQUEST['searchField']);
	if( $fld=='id_conductor' || $fld =='codigo' || $fld=='n_parte' || $fld=='cod_infraccion' || $fld=='eps'|| $fld=='fecha_parte' || $fld=='estado'|| $fld=='convenio' ) {
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
			case 'tarjeta':
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
  $result = mysql_query("SELECT COUNT(*) AS count from simit WHERE id_conductor=".$id.$wh1);
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
   $SQL = "SELECT id_simit,conductor.id_conductor,codigo,n_parte,cod_infraccion,eps,valor,fecha_parte,fecha_pago,case `estado` WHEN 1 THEN 'Activa' WHEN 2 THEN 'Pago' WHEN 3 THEN 'Sin Multas' WHEN 4 THEN 'Multas Con Convenio' END as estado,convenio FROM (simit inner join conductor on simit.id_conductor=conductor.id_conductor) inner join entidad_salud on simit.id_eps=entidad_salud.id_eps WHERE simit.id_conductor=".$id.$wh.$wh1." ORDER BY ".$sidx." ". $sord." LIMIT ".$start." , ".$limit; 
      $result = mysql_query( $SQL ) or die("Couldn?t execute query.".mysql_error());
    $responce->page = $page;
	$responce->total = $total_pages; 
	$responce->records = $count; $i=0; 
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
	$responce->rows[$i]['id']=$row[id_simit]; 
	$responce->rows[$i]['cell']=array($row[id_simit],$row[id_conductor],$row[codigo],$row[n_parte],$row[cod_infraccion],$row[eps],$row[valor],$row[fecha_parte],$row[fecha_pago],$row[convenio],$row[estado]); $i++; }
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