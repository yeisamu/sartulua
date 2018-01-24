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
$id_movil=$_GET['id_movil'];
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
//$can_dias=deme_info("plazo_diarios") ; 
//echo $var="SELECT COUNT(*) AS count from vehiculo where id_movil in (select distinct  vehiculo.id_movil from vehiculo inner join veh_doc on vehiculo.id_movil=veh_doc.id_movil where  (DATE_FORMAT(concat(fecha_ven,' 11:59:59'),'%Y/%m/%d %H:%i') < DATE_FORMAT(now(),'%Y/%m/%d %H:%i') ) OR ADDDATE( DATE_FORMAT( concat( vehiculo.pago_hasta, ' 11:59:59' ) , '%Y/%m/%d %H:%i' ) , $can_dias ) < DATE_FORMAT( now( ) , '%Y/%m/%d %H:%i' )) and vehiculo.id_movil not in (select id_movil from convenio) ".$wd;
   $result = mysql_query("SELECT COUNT(*) AS count from frecuencia where 1 ");
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
 $SQL = "SELECT vehiculo.id_movil,grupo,tarjeta_control.id_tarjeta,tarjeta,conductor.id_conductor,codigo,concat(nombre1,' ',nombre2,' ',apellido1,' ',apellido2) as nombres,placa,tipo_rh,telefono,acudiente,concat(telefonoa,' ',celulara) as tel_acu from (frecuencia inner join (tarjeta_control inner join vehiculo on tarjeta_control.id_movil=vehiculo.id_movil) on frecuencia.id_tarjeta=tarjeta_control.id_tarjeta) inner join conductor on tarjeta_control.id_conductor=conductor.id_conductor where 1".$wh.$wd." ORDER BY ".$sidx." ". $sord." LIMIT ".$start." , ".$limit; 
      $result = mysql_query( $SQL ) or die("Couldn?t execute query.".mysql_error());
	 $responce->page = $page;
	$responce->total = $total_pages; 
	$responce->records = $count; $i=0; 
	
	$comprueba=mysql_query("SELECT vehiculo.id_movil,grupo,tarjeta_control.id_tarjeta,tarjeta,conductor.id_conductor,codigo,concat(nombre1,' ',nombre2,' ',apellido1,' ',apellido2) as nombres,placa,tipo_rh,telefono,acudiente,concat(telefonoa,' ',celulara) as tel_acu from (frecuencia inner join (tarjeta_control inner join vehiculo on tarjeta_control.id_movil=vehiculo.id_movil) on frecuencia.id_tarjeta=tarjeta_control.id_tarjeta) inner join conductor on tarjeta_control.id_conductor=conductor.id_conductor where 1");
	
	while($rows = mysql_fetch_array($comprueba,MYSQL_ASSOC)) { 
	$id_tarje=$rows[id_tarjeta];
	 
	 $bajafrec=mysql_query("select id_movil from tarjeta_control where id_tarjeta=$id_tarje and `fecha_plazo_a` < DATE_FORMAT( now( ) ,'%Y-%m-%d %H:%i' )  ");
	$cuenta=mysql_num_rows($bajafrec);
	if($cuenta>0){
	
	//$datomov=mysql_query("select id_movil from tarjeta_control where id_tarjeta=$id_tarje");
	$filamov=mysql_fetch_array($bajafrec);
	
	$id_mov=$filamov[id_movil];
	$bajafre=mysql_query("delete from `frecuencia` where id_movil='$id_mov'");
	$nov=mysql_query("insert into `novedad_servicio` (`id_movil`, `operacion`, `estado`) values('$id_mov','10-7 VENCIMIENTO DE TARJETA',1)");
	}	
	}
	
	
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
	$responce->rows[$i]['id']=$row[id_movil]; 
	$responce->rows[$i]['cell']=array($row[id_movil],$row[placa],$row[grupo],$row[tarjeta],$row[id_tarjeta],$row[id_conductor],$row[codigo],utf8_encode("$row[nombres]"),$row[telefono],$row[tipo_rh],$row[acudiente],$row[tel_acu]); $i++; }
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
