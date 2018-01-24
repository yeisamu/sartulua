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

$crudColumns1 =  array(
    'id'=>'id_tarjeta' 
	,'tarjeta'=>'tarjeta'
	,'codigo'=>'codigo'
	,'id_movil'=>'id_movil'
	,'fecha_vigencia'=>'fecha_vigencia'
	,'fecha_elab'=>'fecha_elab'
	,'estado'=>'estado'
	,'id_conductor'=>'id_conductor'
	
	
	//,'id_conductor'=>'con_doc.id_conductor'
	//
	
//	,'apellido1'=>'apellido1'
//	,'apellido2'=>'apellido2'
	//,'direccion'=>'direccion'
//	,'telefono'=>'telefono'
//	
//	,'est_civil'=>'est_civil'
//	,'tipo_rh'=>'tipo_rh'
//	,'acudiente'=>'acudiente'
//	,'telefonoa'=>'telefonoa'
//	,'celulara'=>'celulara'
	
);

$wh = "";
$searchOn = Strip($_REQUEST['_search']);
if($searchOn=='true') {
	$fld = Strip($_REQUEST['searchField']);
	if( $fld=='id_tarjeta' || $fld =='tarjeta' || $fld=='codigo' || $fld=='id_movil' || $fld=='fecha_vigencia'|| $fld=='fecha_elab' || $fld=='estado' ) {
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
  $result = mysql_query("SELECT COUNT(*) AS count from `tarjeta_control` a
INNER JOIN conductor b ON a.`id_conductor` = b.`id_conductor` WHERE estado= 1 and b.id_conductor=".$id.$wh1);
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
   $SQL = "SELECT b.`id_conductor` ,`id_tarjeta`,`tarjeta`, codigo,`id_movil`, `fecha_vigencia`, fecha_elab,case estado when 1 then 'Abierta' else 'Cerrada' end as estado,fecha_plazo_a,if(`fecha_plazo_a`<DATE_FORMAT(now(),'%Y/%m/%d'),'Vencido','Vigente') as est_vig  FROM tarjeta_control a
INNER JOIN conductor b ON a.`id_conductor` = b.`id_conductor` WHERE estado= 1 and b.id_conductor=".$id.$wh.$wh1." ORDER BY ".$sidx." ". $sord." LIMIT ".$start." , ".$limit; 
      $result = mysql_query( $SQL ) or die("Couldn?t execute query.".mysql_error());
	  
	  $consu="select planillas_mes from info_sistema";
	 $resultado = mysql_query( $consu ) or die("Couldn?t execute query.".mysql_error());
	 $fila = mysql_fetch_array($resultado,MYSQL_ASSOC) ; 
	 
    $responce->page = $page;
	$responce->total = $total_pages; 
	$responce->records = $count; $i=0; 
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
	$dia_movil=$row[id_movil];
	 $totdiamovil=deme_cuenta_planillas($dia_movil);
	$responce->rows[$i]['id']=$row[id_tarjeta]; 
	$responce->rows[$i]['cell']=array($row[id_conductor],$row[id_tarjeta],$row[tarjeta],$row[codigo],$row[id_movil],$row[fecha_vigencia],$row[fecha_elab],$row[estado],$row[id_conductor],$row[fecha_plazo_a],$row[est_vig],$fila[planillas_mes],$totdiamovil); $i++; }
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