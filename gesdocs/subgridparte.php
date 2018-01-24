<?php 
/*include("dbconfig.php");
include('../inc/libreria.php');

$examp = $_GET["q"]; 
query number 
$page = $_GET['page']; 
 get the requested page 
$limit = $_GET['rows']; 
 get how many rows we want to have into the grid 
$sidx = $_GET['sidx']; 
 get index row - i.e. user click to sort 
$sord = $_GET['sord']; 
 get the direction 
$id = $_GET['id']; 


$wh = "";
$searchOn = Strip($_REQUEST['_search']);
if($searchOn=='true') {
	$fld = Strip($_REQUEST['searchField']);
	if( $fld=='id_conductor' || $fld =='codigo' || $fld=='n_parte' || $fld=='cod_infraccion' || $fld=='eps'|| $fld=='fecha_parte' || $fld=='estado'|| $fld=='convenio' ) {
		$fldata = Strip($_REQUEST['searchString']);
		$foper = Strip($_REQUEST['searchOper']);
		 costruct where
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
			case 'codigo':
			case 'nombre1':
			case 'nombre2':
			case 'tarjeta':
				$wh1 .= " and ".$k." LIKE '".$v."%'";
				break;
			case 'apellido2':
			case 'tax':
			case 'total':
				$wh .= " AND ".$k." = ".$v;
				break;
		}
	}
}
if(!$sidx) $sidx =1; 
connect to the database 
$db = mysql_connect($dbhost, $dbuser, $dbpassword) or die("Connection Error: " . mysql_error()); mysql_select_db($database) or die("Error conecting to db.");
/bussqueda

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
}*/
////////////////////////

include('../inc/libreria.php'); 
$DEBUGMODE = 1;		
$crudColumns =  array(
	'id'=>'id_simit'
	,'n_parte'=>'n_parte'
	,'cod_infraccion'=>'cod_infraccion'
	,'valor'=>'valor'
	,'fecha_parte'=>'fecha_parte'
	,'fecha_pago'=>'fecha_pago'
	//,'idagente'=>'idagente'
	
	/*,'fecha_recibo'=>'fecha_recibo'
	,'n_recibo'=>'n_recibo'
	,'valor_recibo'=>'valor_recibo'
	,'obs'=>'obs' 	*/
	
);
$crudColumns1 =  array(
	'id'=>'id_mensaje'
	,'idremitente'=>'idremitente'
	,'remitente'=>"concat(nombre,' ',apellido) as remitente"
	,'iddestinatario'=>'iddestinatario'
	,'idagente'=>'idagente'
	,'codigo'=>'codigo'
	,'observaciones'=>'observaciones'
	,'fecha'=>"concat(fecha,' ',hora) as fecha"
	,'fecharec'=>'fecharec'
	
	
	/*
	,'n_recibo'=>'n_recibo'
	,'valor_recibo'=>'valor_recibo'
	,'obs'=>'obs' 	*/
	
);
$crudTableName = 'simit';
$postConfig['id'] = 'id_simit'; 
$id =$_GET['id']; 
/*----====|| end CONFIG ||====----*/
/* jqGrid specifi settings, don;t need to be modified if using jqgrid  */
$postConfig['search'] = '_search'; 			/* search */
$postConfig['searchField'] = 'searchField'; /* searchField */
$postConfig['searchOper'] = 'searchOper'; 	/* searchOper */
$postConfig['searchStr'] = 'searchString'; 	/* searchString */
$postConfig['action'] = 'oper'; 			/* action variable */
$postConfig['sortColumn'] = 'sidx'; 		/* sort column */
$postConfig['sortOrder'] = 'sord'; 			/* sort order */
$postConfig['page'] = 'page'; 				/* current requested page */
$postConfig['limit'] = 'rows';				/* restrict number of rows to return */
$crudConfig['row'] = 'cell'; 				/* row data identifier */
$crudConfig['read'] = 'oper'; 				/* action READ keyword *//* set to be the same as action keyword for default */
$crudConfig['create'] = 'add';				/* action CREATE keyword */
$crudConfig['update'] = 'edit';				/* action UPDATE keyword */
$crudConfig['delete'] = 'del';				/* action DELETE keyword */
$crudConfig['totalPages'] = 'total';		/* total pages */
$crudConfig['totalRecords'] = 'records';	/* total records */
$crudConfig['responseSuccess'] = 'success';	/* total records */
$crudConfig['responseFailure'] = 'fail';	/* total records */
/* end of jqgrid specific settings */
$o=null;
/*----====|| SETUP firePHP ||====----*/
/*  http://www.firephp.org/  */
if($DEBUGMODE == 1){
	require_once('../inc/FirePHP.class.php'); // adds nice logging library<a href="sar/inc/FirePHP.class.php">FirePHP.class.php</a>
	ob_start();
	$firephp = FirePHP::getInstance(true);
}
/*----====|| SETUP SEARCH CONDITION ||====----*/
function fnSearchCondition($searchOperation, $searchString){
	switch($searchOperation){
		case 'eq': $searchCondition = '= "'.$searchString.'"'; break;
		case 'ne': $searchCondition = '!= "'.$searchString.'"'; break;
		case 'bw': $searchCondition = 'LIKE "'.$searchString.'%"'; break;
		case 'ew': $searchCondition = 'LIKE "%'.$searchString.'"'; break;
		case 'cn': $searchCondition = 'LIKE "%'.$searchString.'%"'; break;
		case 'lt': $searchCondition = '< "'.$searchString.'"'; break;
		case 'gt': $searchCondition = '> "'.$searchString.'"'; break;
		case 'le': $searchCondition = '<= "'.$searchString.'"'; break;
		case 'ge': $searchCondition = '>= "'.$searchString.'"'; break;
		
	}
	return $searchCondition;
}
/*----====|| INPUT VARIABLE CLEAN FUNCTION||====----*/
/* you can replace this with a call to a clean function you prfer, or leave it as is.*/
function fnCleanInputVar($string){
	//$string = mysql_real_escape_string($string);
	return $string;
}
/*----====|| GET and CLEAN THE POST VARIABLES ||====----*/
foreach ($postConfig as $key => $value){ 
	if(isset($_REQUEST[$value])){
		$postConfig[$key] = fnCleanInputVar($_REQUEST[$value]); 
	}
}
foreach ($crudColumns as $key => $value){ 
	if(isset($_REQUEST[$key])){
		$crudColumnValues[$key] = '"'.fnCleanInputVar($_REQUEST[$key]).'"';
	}
}
/*----====|| INPUT VARIABLES ARE CLEAN AND CAN BE USED IN QUERIES||====----*/
/*----====|| CONNECT TO THE DB ||====----*/
$dbLink = mysql_connect($dbConfig['dbServer'], $dbConfig['dbUser'], $dbConfig['dbPassword']);
if (!$dbLink) {die('Could not connect: ' . mysql_error());}
mysql_select_db($dbConfig['dbDatabase'], $dbLink);
/*----====|| ACTION SWITCH ||====----*/
if($DEBUGMODE == 1){$firephp->info($postConfig['action'],'action');}
switch($postConfig['action']){
	case $crudConfig['read']:
		/* ----====|| ACTION = READ ||====----*/
		if($DEBUGMODE == 1){$firephp->info('READ','action');}
		/*query to count rows*/
		$sql='select count('.$postConfig['id'].') as numRows from simit WHERE id_conductor='.$id;
		if($DEBUGMODE == 1){$firephp->info($sql,'query');}
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result,MYSQL_NUM);
		$count = $row[0];
		if($DEBUGMODE == 1){$firephp->info($count,'rows');}
		$intLimit = $postConfig['limit'];
		/*set the page count*/
		if( $count > 0 && $intLimit > 0) { $total_pages = ceil($count/$intLimit); } 
		else { $total_pages = 1; } 
		if($DEBUGMODE == 1){$firephp->info($total_pages,'total_pages');}
		$intPage = $postConfig['page'];
		if ($intPage > $total_pages){$intPage=$total_pages;}
		$intStart = (($intPage-1) * $intLimit);
		/*Run the data query*/
		$sql = "select id_simit,conductor.id_conductor,codigo,n_parte,cod_infraccion,con_doc.eps,valor,fecha_parte,fecha_pago,case `estado` WHEN 1 THEN 'Activa' WHEN 2 THEN 'Pago' WHEN 3 THEN 'Sin Multas' WHEN 4 THEN 'Multas Con Convenio' END as estado,convenio FROM (simit inner join conductor on simit.id_conductor=conductor.id_conductor) inner join entidad_salud on simit.id_eps=entidad_salud.id_eps WHERE simit.id_conductor=".$id;
		if($postConfig['search'] == 'true'){
			$sql .= ' where ' . $postConfig['searchField'] . ' ' . fnSearchCondition($_REQUEST['searchOper'], $postConfig['searchStr']);
		}
		$sql .= ' ORDER BY ' . $postConfig['sortColumn'] . ' ' . $postConfig['sortOrder']; 
		 $sql .= ' LIMIT '.$intStart.','.$intLimit;
		
		//if($postConfig['search'] == true){ $sql .= ' where '.$searchCondition; }
		if($DEBUGMODE == 1){$firephp->info($sql,'query');}
		$result = mysql_query( $sql ) 
		or die($firephp->error('Couldn t execute query.'.mysql_error()));
		/*Create the output object*/
		$o->page = $intPage; 
		$o->total = $total_pages;
		//$o->records = $count; $i=0; 
//		$i=0;
//		while($row = mysql_fetch_array($result,MYSQL_NUM)) { 
//			/* 1st column needs to be the id, even if it's not named ID */
//			$o->rows[$i]['id']=$row[0];
//			/* assign the row contents to a row var. */
//			$o->rows[$i][$crudConfig['row']]=$row;
//			$i++; 
//		}

		$o->records = $count; $i=0; 
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
	$o->rows[$i]['id']=$row[id_simit]; 
	$o->rows[$i]['cell']=array($row[id_simit],$row[id_conductor],$row[codigo],$row[n_parte],$row[cod_infraccion],$row[eps],$row[valor],$row[fecha_parte],$row[fecha_pago],$row[convenio],$row[estado]); $i++; }
		break;
	case $crudConfig['create']:
		/* ----====|| ACTION = CREATE ||====----*/
		if($DEBUGMODE == 1){$firephp->info('CREATE','action');}
		/*basic start to the insert query*/
		$sql = 'insert into '.$crudTableName.'(';
		/*add the list of columns */
		$sql .= implode(',',$crudColumns);
		/*  !!! add any additional columns not defined in the column array here. */
		$sql .= ')VALUES(';
		/* add the values from POST vars */
		$sql .= implode(',',$crudColumnValues);
		/*  !!! add any additional columns not defined in the column array here. */
		$sql .= ')';
		if($DEBUGMODE == 1){$firephp->info($sql,'query');}
		mysql_query( $sql ) 
		or die($firephp->error('Couldn t execute query.'.mysql_error()));
		break;
	case $crudConfig['update']:
		/* ----====|| ACTION = UPDATE ||====----*/
		if($DEBUGMODE == 1){$firephp->info('UPDATE','action');}
		$sql = 'update '.$crudTableName.' set ';
		/* create all of the update statements */
		foreach($crudColumns as $key => $value){ $updateArray[$key] = $value.'='.$crudColumnValues[$key]; };
		$sql .= implode(',',$updateArray);
		/* add any additonal update statements here */
	echo	$sql .= ' where id_simit = '.$crudColumnValues['id'];
		if($DEBUGMODE == 1){$firephp->info($sql,'query');}
		mysql_query( $sql ) 
		or die($firephp->error('Couldn t execute query.'.mysql_error()));
		break;
	case $crudConfig['delete']:
		/* ----====|| ACTION = DELETE ||====----*/
		if($DEBUGMODE == 1){$firephp->info('DELETE','action');}
		$sql = 'Delete from '.$crudTableName.' where id_simit = '.$crudColumnValues['id'];
		if($DEBUGMODE == 1){$firephp->info($sql,'query');}
		mysql_query( $sql ) 
		or die($firephp->error('Couldn t execute query.'.mysql_error()));
		break;
	}

/* ----====|| SEND OUTPUT ||====----*/
if($DEBUGMODE == 1){$firephp->info('End Of Script','status');}
print json_encode($o);




	?>
