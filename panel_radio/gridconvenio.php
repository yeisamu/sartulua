<?php
 include('../inc/libreria.php');
 include('../inc/operaciones.php');
/*
*|	jqGrid PHP MYSQL AJAX CRUD Template
*|	by: Anthony Aragues
*|	http://suddendevelopment.com
*|	Resources:
*|	jqGrid:  http://www.trirand.com/blog/
*|	jquery:  http://jquery.com/
*|
*|	this page is intended to be accessed through an ajax application. Not directly by a user.
*/
//require_once('../inc/JSON.php'); //Adds JSON functions if you are missing them in your PHP install
/*----====|| CONFIG ||====----*/
/* each AJAX framework may have differeny keywords for these features. */
/* NOTE: If you are creating multiple copies of this file I highly recommend you abstract this out to a separate file and include it where needed. */

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
 
 //configuracion de la busqueda
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
                if($wd !=" ")
				$wd .= " and vehiculo.id_movil LIKE '%".$v."%'";
				
				break;
			case 'placa':
				$wd .= " and ".$k." LIKE '%".$v."%'";
				break;
		}
	}
}






$DEBUGMODE = 1;								/* Set to 1 if you want firephp output */
//$dbConfig['dbServer'] = 'localhost'; 		/* Server */
//$dbConfig['dbUser'] = 'sar'; 				/* Username */
//$dbConfig['dbPassword'] = 'td72da'; 				/* Password */
//$dbConfig['dbDatabase'] = 'sar'; 		/* Database */
					/* id column */
					
//$id = $_REQUEST['id_con']; 					
/* list the column names that are being sent to this script (Input variables)  the first one should be the primary key. */
/* columns array format:  $_POST['VARIABLE'] => 'DB column name' */
$crudColumns =  array(
    'id'=>'id_movil' 
	
//	,'fecha_nace'=>'fecha_nace'
//	,'est_civil'=>'est_civil'
//	,'tipo_rh'=>'tipo_rh'
//	,'acudiente'=>'acudiente'
//	,'telefonoa'=>'telefonoa'
//	,'celulara'=>'celulara'
	
);

$crudColumns1 =  array(
    'id'=>'vehiculo.id_movil' 
   ,'placa'=>'placa'
	,'grupo'=>'grupo'
	
//	,'apellido1'=>'apellido1'
//	,'apellido2'=>'apellido2'
	//,'direccion'=>'direccion'
//	,'telefono'=>'telefono'
//	,'fecha_nace'=>'fecha_nace'
//	,'est_civil'=>'est_civil'
//	,'tipo_rh'=>'tipo_rh'
//	,'acudiente'=>'acudiente'
//	,'telefonoa'=>'telefonoa'
//	,'celulara'=>'celulara'
	
);
$crudTableName = 'convenio';
$postConfig['id'] = 'id_movil'; 

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
	require_once('../inc/FirePHP.class.php'); // adds nice logging library
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
		 $sql="select count(vehiculo.id_movil) as numRows from convenio inner join vehiculo on convenio.id_movil=vehiculo.id_movil where 1 ";
	 $sql.=$wd;
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
		// $can_dias=deme_info("plazo_diarios") ; 
		 
		 ///********  Consulta para moviles con algun documento vencido o diarios vencidos 
		/* SELECT id_movil, grupo
FROM vehiculo
WHERE id_movil
IN (

SELECT DISTINCT vehiculo.id_movil
FROM vehiculo
INNER JOIN veh_doc ON vehiculo.id_movil = veh_doc.id_movil
WHERE DATE_FORMAT( concat( fecha_ven, ' 11:59:59' ) , '%Y/%m/%d %H:%i' ) < DATE_FORMAT( now( ) , '%Y/%m/%d %H:%i' )
)
OR ADDDATE( DATE_FORMAT( concat( vehiculo.pago_hasta, ' 11:59:59' ) , '%Y/%m/%d %H:%i' ) , 37 ) < DATE_FORMAT( now( ) , '%Y/%m/%d %H:%i' )*/
		 
		 
		 ///*****************
				$sql = 'select '.implode(',',$crudColumns1)."  from convenio inner join vehiculo on convenio.id_movil=vehiculo.id_movil  where 1";
				$sql.=$wd;
		
		$sql .= ' ORDER BY ' . $postConfig['sortColumn'] . ' ' . $postConfig['sortOrder']; 
	$sql .= ' LIMIT '.$intStart.','.$intLimit;
		
		//if($postConfig['search'] == true){ $sql .= ' where '.$searchCondition; }
		if($DEBUGMODE == 1){$firephp->info($sql,'query');}
		$result = mysql_query( $sql ) 
		or die($firephp->error('Couldn t execute query.'.mysql_error()));
		/*Create the output object*/
		$o->page = $intPage; 
		$o->total = $total_pages;
		$o->records = $count;
		$i=0;
		while($row = mysql_fetch_array($result,MYSQL_NUM)) { 
			/* 1st column needs to be the id, even if it's not named ID */
			$o->rows[$i]['id']=$row[0];
			/* assign the row contents to a row var. */
			$o->rows[$i][$crudConfig['row']]=$row;
			$i++; 
		}
		break;
	case $crudConfig['create']:
	$id_movil=$_REQUEST['id_movil'];
		/* ----====|| ACTION = CREATE ||====----*/
		if($DEBUGMODE == 1){$firephp->info('CREATE','action');}
		/*basic start to the insert query*/
		$sql = 'insert into '.$crudTableName.'(';
		/*add the list of columns */
		$sql .= implode(',',$crudColumns);
		/*  !!! add any additional columns not defined in the column array here. */
		 $sql .= ")VALUES('$id_movil')";
		/* add the values from POST vars */
		
	//	$sql .= implode(',',$crudColumnValues);
		/*  !!! add any additional columns not defined in the column array here. */
	//echo	$sql .= ')';
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
		$sql .= ' where id_movil = '.$crudColumnValues['id'];
		if($DEBUGMODE == 1){$firephp->info($sql,'query');}
		mysql_query( $sql ) 
		or die($firephp->error('Couldn t execute query.'.mysql_error()));
		break;
	case $crudConfig['delete']:
		/* ----====|| ACTION = DELETE ||====----*/
		if($DEBUGMODE == 1){$firephp->info('DELETE','action');}
		$sql = 'Delete from '.$crudTableName.' where id_movil = '.$crudColumnValues['id'];
		if($DEBUGMODE == 1){$firephp->info($sql,'query');}
		mysql_query( $sql ) 
		or die($firephp->error('Couldn t execute query.'.mysql_error()));
		break;
	}

/* ----====|| SEND OUTPUT ||====----*/
if($DEBUGMODE == 1){$firephp->info('End Of Script','status');}
print json_encode($o);

function Strip($value){
	if(get_magic_quotes_gpc() != 0){
    	if(is_array($value))  
			if ( array_is_associative($value) ){
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