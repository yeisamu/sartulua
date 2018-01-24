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
$can_dias=deme_info("plazo_diarios") ; 
//echo $var="SELECT COUNT(*) AS count from vehiculo where id_movil in (select distinct  vehiculo.id_movil from vehiculo inner join veh_doc on vehiculo.id_movil=veh_doc.id_movil where  (DATE_FORMAT(concat(fecha_ven,' 11:59:59'),'%Y/%m/%d %H:%i') < DATE_FORMAT(now(),'%Y/%m/%d %H:%i') ) OR ADDDATE( DATE_FORMAT( concat( vehiculo.pago_hasta, ' 11:59:59' ) , '%Y/%m/%d %H:%i' ) , $can_dias ) < DATE_FORMAT( now( ) , '%Y/%m/%d %H:%i' )) and vehiculo.id_movil not in (select id_movil from convenio) ".$wd;
  // $result = mysql_query("SELECT COUNT(*) AS count from vehiculo where id_movil not in(select distinct  id_movil from veh_doc  where DATE_FORMAT(concat(fecha_ven,'11:59:59'),'%Y-%m-%d %H:%i') < DATE_FORMAT(now(),'%Y-%m-%d %H:%i')) and id_movil in(select id_movil from tarjeta_control  where  DATE_FORMAT(tarjeta_control.fecha_plazo_a , '%Y-%m-%d %H:%i' )  > DATE_FORMAT(now(),'%Y-%m-%d %H:%i') and estado=1) and id_movil not in(select id_movil  from suspension where DATE_FORMAT(now(),'%Y-%m-%d %H:%i' ) > DATE_FORMAT( f_inicio, '%Y/%m/%d %H:%i')) and id_movil not in (select id_movil from frecuencia) ".$wh.$wd);
   if(!isset($start)){
     $start=0;   
  }
   $result=mysql_query("SELECT HIGH_PRIORITY distinct(vehiculo.id_movil),vehiculo.placa,vehiculo.grupo from vehiculo inner join tarjeta_control on vehiculo.id_movil = tarjeta_control.id_movil where  DATE_FORMAT(tarjeta_control.fecha_plazo_a , '%Y-%m-%d %H:%i' )  > DATE_FORMAT(now(),'%Y-%m-%d %H:%i') and tarjeta_control.estado=1  and vehiculo.id_movil not in(SELECT id_movil
FROM (
(

SELECT id_movil
FROM veh_doc
WHERE DATE_FORMAT(  DATE_ADD(concat( veh_doc.fecha_ven, ' 06:59:59' ),INTERVAL 1 DAY) , '%Y-%m-%d %H:%i' ) < DATE_FORMAT( now() , '%Y-%m-%d %H:%i' )
)

UNION (

SELECT frecuencia.id_movil
FROM frecuencia
)
)r) ".$wh.$wd." ORDER BY ".$sidx." ". $sord." LIMIT ".$start." , ".$limit);
  
  
  //validar si el movil existe:
  
  
  
  //UNION (

//SELECT suspension.id_movil
//FROM suspension
//WHERE DATE_FORMAT( now( ) , '%Y-%m-%d %H:%i' ) > DATE_FORMAT( suspension.f_inicio, '%Y-%m-%d %H:%i' ) and DATE_FORMAT( now( ) , '%Y-%m-%d %H:%i' ) <= DATE_FORMAT( suspension.f_fin, '%Y-%m-%d %H:%i' )
//)
  
  
  
   //$row = mysql_fetch_array($result,MYSQL_ASSOC);
       
 //$count = $row['count']; 
        $count = mysql_num_rows($result);
		if( $count >0 ) {
			$total_pages = ceil($count/$limit);
		
        if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit; // do not put $limit*($page - 1)
        if ($start<0) $start = 0;
		
		
//SELECT vehiculo.id_movil,placa,grupo from vehiculo where not ( id_movil in (select distinct  vehiculo.id_movil from vehiculo inner join veh_doc on vehiculo.id_movil=veh_doc.id_movil where  (DATE_FORMAT(concat(fecha_ven,' 11:59:59'),'%Y/%m/%d %H:%i') < DATE_FORMAT(now(),'%Y/%m/%d %H:%i') ) OR ADDDATE( DATE_FORMAT( concat( vehiculo.pago_hasta, ' 11:59:59' ) , '%Y/%m/%d %H:%i' ) , $can_dias ) < DATE_FORMAT( now( ) , '%Y/%m/%d %H:%i' )) and vehiculo.id_movil not in (select id_movil from convenio)) and vehiculo.id_movil not in (select vehiculo.id_movil  from suspension inner join vehiculo on suspension.id_movil=vehiculo.id_movil where DATE_FORMAT( now( ) , '%Y/%m/%d %H:%i' ) > DATE_FORMAT( f_inicio, '%Y/%m/%d %H:%i' ) and  DATE_FORMAT( now( ) , '%Y/%m/%d %H:%i' ) < DATE_FORMAT( f_fin, '%Y/%m/%d %H:%i' )) and id_movil not in (select id_movil from frecuencia)	

/*SELECT vehiculo.id_movil,placa,grupo from vehiculo where not ( id_movil in (SELECT distinct  vehiculo.id_movil FROM vehiculo
INNER JOIN veh_doc ON vehiculo.id_movil = veh_doc.id_movil
WHERE  if(ADDDATE( DATE_FORMAT( concat( vehiculo.pago_hasta, ' 11:59:59' ) , '%Y/%m/%d %H:%i' ) ,$can_dias) < DATE_FORMAT( now( ) , '%Y-%m-%d %H:%i' ),1,0)=1 or if(DATE_FORMAT( concat( fecha_ven, ' 11:59:59' ) , '%Y/%m/%d %H:%i' ) < DATE_FORMAT( now( ) , '%Y-%m-%d %H:%i' ),1,0)=1 )and vehiculo.id_movil not in (select id_movil from convenio)) and vehiculo.id_movil not in (select vehiculo.id_movil  from suspension inner join vehiculo on suspension.id_movil=vehiculo.id_movil where DATE_FORMAT( now( ) , '%Y/%m/%d %H:%i' ) > DATE_FORMAT( f_inicio, '%Y/%m/%d %H:%i' ) and  DATE_FORMAT( now( ) , '%Y/%m/%d %H:%i' ) < DATE_FORMAT( f_fin, '%Y/%m/%d %H:%i' )) and id_movil not in (select id_movil from frecuencia)*/
	  //$SQL = $resulta." ORDER BY ".$sidx." ". $sord." LIMIT ".$start." , ".$limit;
	  //"SELECT vehiculo.id_movil,placa,grupo from vehiculo where id_movil not in(select distinct  id_movil from veh_doc  where DATE_FORMAT(concat(fecha_ven,'11:59:59'),'%Y-%m-%d %H:%i') < DATE_FORMAT(now(),'%Y-%m-%d %H:%i')) and id_movil in(select id_movil from tarjeta_control  where  DATE_FORMAT(tarjeta_control.fecha_plazo_a , '%Y-%m-%d %H:%i' )  > DATE_FORMAT(now(),'%Y-%m-%d %H:%i') and estado=1) and id_movil not in(select id_movil  from suspension where DATE_FORMAT(now(),'%Y-%m-%d %H:%i' ) > DATE_FORMAT( f_inicio, '%Y/%m/%d %H:%i')) and id_movil not in (select id_movil from frecuencia) 	
// ".$wh.$wd." ORDER BY ".$sidx." ". $sord." LIMIT ".$start." , ".$limit; 
     // $result = mysql_query( $SQL ) or die("Couldn?t execute query.".mysql_error());
	   $consu="select planillas_mes from info_sistema";
	 $resultado = mysql_query( $consu ) or die("Couldn?t execute query.".mysql_error());
	 $fila = mysql_fetch_array($resultado,MYSQL_ASSOC) ; 
    $responce->page = $page;
	$responce->total = $total_pages; 
	$responce->records = $count; $i=0; 
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
	$dia_movil=$row[id_movil];
	 $totdiamovil=deme_cuenta_planillas($dia_movil);
	$responce->rows[$i]['id']=$row[id_movil]; 
	$responce->rows[$i]['cell']=array($row[id_movil],$row[placa],$row[grupo]); $i++; }
	//echo $SQL;
	echo json_encode($responce); 
	}// else {
//			/*$total_pages = 0;
//			$responce->page = 1;
//            $responce->total = 1; 
//            $responce->records = 1;*/
//			
//			//include ("valida_movil_108.php"); 
//			$responce->page = 1;
//            $responce->total = 1; 
//            $responce->records = 1;
//			$fila=array("msg"=>"Movil Sin Tarjetas Activas","lab"=>"Movil Sin Tarjetas Activas");
//			$msg="Movil Sin Tarjetas Activas";  
//			$responce->rows[0]['id']=$id_movil;
//$responce->rows[0]['cell']=array($fila["msg"],$id_movil,$id_movil);
//echo json_encode($responce);
//}
//presentacion de los mensajes

			
			 
		
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


///SELECT vehiculo.id_movil,placa,grupo from vehiculo where not ( id_movil in (SELECT distinct  vehiculo.id_movil FROM vehiculo
//INNER JOIN veh_doc ON vehiculo.id_movil = veh_doc.id_movil
//WHERE  if(ADDDATE( DATE_FORMAT( concat( vehiculo.pago_hasta, ' 11:59:59' ) , '%Y/%m/%d %H:%i' ) , 37 ) < DATE_FORMAT( now( ) , '%Y-%m-%d %H:%i' ),1,0)=1 or if(DATE_FORMAT( concat( fecha_ven, ' 11:59:59' ) , '%Y/%m/%d %H:%i' ) < DATE_FORMAT( now( ) , '%Y-%m-%d %H:%i' ),1,0)=1 )and vehiculo.id_movil not in (select id_movil from convenio)) 

?>