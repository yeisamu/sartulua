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
 $grupo = $_GET['grupo']; 
$wh = "";
$searchOn = Strip($_REQUEST['_search']);
if($searchOn=='true') {
	$fld = Strip($_REQUEST['searchField']);
	if( $fld=='id_planilla' || $fld =='n_planilla' || $fld=='fecha' || $fld=='id_movil' || $fld=='destino'|| $fld=='nombre_con' || $fld=='elab'|| $fld=='recibido'  ) {
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
			case 'id_movil':
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
// echo $mes="SELECT COUNT( * ) AS countFROM reporte_planilla where grupo='$grupo'";
  $result = mysql_query("SELECT COUNT( * ) AS count
FROM reporte_planilla where  liquidado=0   ");
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
    $SQL = "SELECT fecha,id_planilla, `n_planilla` , `id_movil` ,nombre_con, `destino` , elab, recibido,observaciones,
CASE reporte_planilla.`estado` when 1 then 'En Circulacion' when 2 then 'Devuelta' when 3 then 'Anulada' when 4 then 'Descartada' END AS estado,CASE reporte_planilla.`liquidado` when 0 then '' when 1 then 'Liquidada' end as liquidado,nombre,reporte_planilla.grupo FROM reporte_planilla left join empresa on reporte_planilla.grupo=empresa.grupo where liquidado=0 ".$wh.$wh1." ORDER BY ".$sidx." ". $sord." LIMIT ".$start." , ".$limit; 
      $result = mysql_query( $SQL ) or die("Couldn?t execute query.".mysql_error());
	  
    $responce->page = $page;
	$responce->total = $total_pages; 
	$responce->records = $count; $i=0; 
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
	 $dia_movil=$row[id_movil];
	if($dia_movil!=""){
	 $totdiamovil=deme_cuenta_planillas($dia_movil);
	 }else{
	 $totdiamovil=0;
	 }
	$responce->rows[$i]['id']=$row[n_planilla]; 
	$responce->rows[$i]['cell']=array($row[nombre],$row[fecha],$row[id_planilla],$row[n_planilla],$row[id_movil],utf8_encode($row[nombre_con]),$totdiamovil,$row[destino],$row[elab],$row[recibido],$row[estado],$row[observaciones],$row[liquidado],$row[grupo]); $i++; }
	echo json_encode($responce); 


	break;

case 2:
echo $grup=$_REQUEST['grupo'];
echo $idp=$_REQUEST['id'];
echo "update reporte_planilla set grupo='$grup' where n_planilla=$id";
$actu=mysql_query("update reporte_planilla set grupo='$grup' where n_planilla=$idp");

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
	?>
