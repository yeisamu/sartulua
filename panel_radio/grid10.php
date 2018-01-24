<?php
session_start();
date_default_timezone_set('UTC');
 include('../inc/libreria.php');
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
    'id'=>'id_acc' 
	,'fecha'=>'fecha'
	,'id_movil'=>'id_movil'
	,'placa'=>'placa'
	,'id_tarjeta'=>'id_tarjeta'
	,'tarjeta'=>'tarjeta'
	,'codigo'=>'codigo'
	,'nombres'=>'nombres'

	,'fecha_inc'=>'fecha_inc'
	,'dir_inc'=>'dir_inc'
	,'id_tipo_a'=>'id_tipo_a'
	,'tipo_accidente'=>'tipo_accidente'
	,'info_otro'=>'info_otro'
	,'placa_otro'=>'placa_otro'

	,'ambulancia'=>'ambulancia'
	,'conduce_prop'=>'conduce_prop'
	,'reportado'=>'reportado'
	,'transito'=>'transito'

	
	
	,'lesionado'=>'lesionado'
	
	,'tras_lesionado'=>'tras_lesionado'
	,'entidad_lesionado'=>'entidad_lesionado'
	 ,'hora_asist'=>'hora_asist'
	,'danos_mat'=>'danos_mat'
	,'heridos'=>'heridos'
	,'conciliacion'=>'conciliacion'
	,'croquis'=>'croquis'
	,'juez_gtias'=>'juez_gtias'
	,'rep_aseg'=>'rep_aseg'
	,'observacion'=>'observacion'
	,'estado'=>'estado'
	,'usuario'=>'usuario'
	
	
);

/*$crudColumns1 =  array(
    'id'=>'id' 
	,'id_conductor'=>'con_doc.id_conductor'
	,'codigo'=>'codigo'
	,'documento'=>'documento'
	,'id_doc'=>'documento.id_doc'
	,'numero'=>'numero'
	,'categoria'=>'categoria'
	,'fecha_vence'=>'fecha_vence'
	
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
	
);*/
$crudTableName = 'accidente';
$postConfig['id'] = 'id_acc'; 

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
		$sql='select count('.$postConfig['id'].') as numRows from accidente where estado=1';
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
		$sql = 'select '.implode(',',$crudColumns).'  from accidente where estado=1';
		if($postConfig['search'] == 'true'){
			$sql .= ' WHERE  ' . $postConfig['searchField'] . ' ' . fnSearchCondition($_POST['searchOper'], $postConfig['searchStr']);
		}
		$sql .= ' ORDER BY ' . $postConfig['sortColumn'] . ' ' . $postConfig['sortOrder']; 
		 $sql .= ' LIMIT '.$intStart.','.$intLimit;
		
		//if($postConfig['search'] == true){ $sql .= ' where '.$searchCondition; }
		if($DEBUGMODE == 1){$firephp->info($sql,'query');}
		$result = mysql_query( $sql ) 
		or die($firephp->error('Couldn t execute query selec.'.mysql_error()));
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
		/* ----====|| ACTION = CREATE ||====----*/
		if($DEBUGMODE == 1){$firephp->info('CREATE','action');}
		/*basic start to the insert query*/
			$usuario=$_SESSION['login'];
			
			$f_inic=$_REQUEST['fecha'];
			$fecha_inc=date("Y-m-d H:i",strtotime($f_inic));
			$codigo=$_REQUEST['codigo'];
			$nombres=$_REQUEST['nombres'];
			$id_movil=$_REQUEST['id_movil'];
			$placa=$_REQUEST['placa'];
			$diracc=$_REQUEST['dir_acc'];
			$id_tipo_a=$_REQUEST['id_tipo_a'];
			$conacc=mysql_query("select * from tipo_accidente where id_tipo_a=$id_tipo_a");
$datoacc=mysql_fetch_array($conacc);
$tipo_acc=$datoacc['tipo_accidente'];
            $tarjeta=$_REQUEST['tarjeta'];
$contc=mysql_query("select * from tarjeta_control where tarjeta=$tarjeta");
$datotc=mysql_fetch_array($contc);
$id_tarjeta=$datotc['id_tarjeta'];
			$placa_otro=$_REQUEST['placa_otro'];
			$info_otro=$_REQUEST['info_otro'];
			$entidad=$_REQUEST['entidad'];
			$prop=$_REQUEST['prop'];
			$amb=$_REQUEST['amb'];
			$les=$_REQUEST['les'];
			$tras=$_REQUEST['tras'];
			$transito=$_REQUEST['transito'];
		    
			$f_asis=$_REQUEST['hora_asis'];
			$fecha_asis=date("Y-m-d H:i",strtotime($f_asis));
			$danos_mat=$_REQUEST['danos_mat'];
			$heridos=$_REQUEST['heridos'];
			$conciliacion=$_REQUEST['conciliacion'];
			$croquis=$_REQUEST['croquis'];
			$juez_gtia=$_REQUEST['juez_gtia'];
			$observacion=$_REQUEST['observacion'];
			$rep_aseg=$_REQUEST['rep_aseg'];
		
		$sql = 'insert into accidente (fecha,usuario,fecha_inc,dir_inc,id_tarjeta,tarjeta,codigo,nombres,id_movil,placa,id_tipo_a,tipo_accidente,reportado,placa_otro,info_otro,conduce_prop,ambulancia,lesionado,transito,tras_lesionado,entidad_lesionado,`accidente` `hora_asist`, `danos_mat`, `heridos`, `conciliacion`, `croquis`, `juez_gtias`, `rep_aseg`, `observacion`';
		/*add the list of columns */
		//$sql .= implode(',',$crudColumns);
		/*  !!! add any additional columns not defined in the column array here. */
		//tarjeta,codigo,nombres,id_movil,placa,id_tipo_a,tipo_accidente,placa_otro,info_otro,conduce_prop,ambulancia,lesionado,transito,tras_lesionado,entidad_lesionado
		$sql .= ")VALUES(now(),'$usuario','$fecha_inc','$diracc','$id_tarjeta','$tarjeta','$codigo','$nombres','$id_movil','$placa','$id_tipo_a','$tipo_acc','reportado','$placa_otro','$info_otro','$prop','$amb','$les','$transito','$tras','$entidad','$danos_mat','$heridos','$conciliacion','$croquis','$juez_gtia','$rep_aseg','$observacion')";
		/* add the values from POST vars */
		//$sql .= implode(',',$crudColumnValues);
		/*  !!! add any additional columns not defined in the column array here. */
	//$sql .= ')';
		if($DEBUGMODE == 1){$firephp->info($sql,'query');}
		mysql_query( $sql ) 
		or die($firephp->error('Couldn t execute que inserta. $sql '.mysql_error()));

	case $crudConfig['update']:
		/* ----====|| ACTION = UPDATE ||====----*/
		if($DEBUGMODE == 1){$firephp->info('UPDATE','action');}
		$usuario=$_SESSION['login'];
			
			$f_inic=$_REQUEST['fecha'];
			$fecha_inc=date("Y-m-d H:i",strtotime($f_inic));
			$codigo=$_REQUEST['codigo'];
			$nombres=$_REQUEST['nombres'];
			$id_movil=$_REQUEST['id_movil'];
			$placa=$_REQUEST['placa'];
			$diracc=$_REQUEST['dir_acc'];
			$id_tipo_a=$_REQUEST['id_tipo_a'];
			$conacc=mysql_query("select * from tipo_accidente where id_tipo_a=$id_tipo_a");
$datoacc=mysql_fetch_array($conacc);
$tipo_acc=$datoacc['tipo_accidente'];
            $tarjeta=$_REQUEST['tarjeta'];
$contc=mysql_query("select * from tarjeta_control where tarjeta=$tarjeta");
$datotc=mysql_fetch_array($contc);
$id_tarjeta=$datotc['id_tarjeta'];
			$placa_otro=$_REQUEST['placa_otro'];
			$info_otro=$_REQUEST['info_otro'];
			$entidad=$_REQUEST['entidad'];
			$reportado=$_REQUEST['reportado'];
			$prop=$_REQUEST['prop'];
			$amb=$_REQUEST['amb'];
			$les=$_REQUEST['les'];
			$tras=$_REQUEST['tras'];
			$transito=$_REQUEST['transito'];
			
			$f_asis=$_REQUEST['hora_asis'];
			$fecha_asis=date("Y-m-d H:i",strtotime($f_asis));
			$danos_mat=$_REQUEST['danos_mat'];
			$heridos=$_REQUEST['heridos'];
			$conciliacion=$_REQUEST['conciliacion'];
			$croquis=$_REQUEST['croquis'];
			$juez_gtia=$_REQUEST['juez_gtia'];
			$observacion=$_REQUEST['observacion'];
			$rep_aseg=$_REQUEST['rep_aseg'];
		
		$sql = 'update '.$crudTableName.' set ';
		/* create all of the update statements */
		//foreach($crudColumns as $key => $value){ $updateArray[$key] = $value.'='.$crudColumnValues[$key]; };
		//$sql .= implode(',',$updateArray);
		/* add any additonal update statements here */
	echo	$sql .= "fecha=now(),usuario='$usuario',fecha_inc='$fecha_inc',dir_inc='$diracc',id_tarjeta=$id_tarjeta,tarjeta='$tarjeta',codigo='$codigo',nombres='$nombres',id_movil='$id_movil',placa='$placa',id_tipo_a=$id_tipo_a,tipo_accidente='$tipo_acc',placa_otro='$placa_otro',info_otro='$info_otro',reportado='$reportado',conduce_prop='$prop',ambulancia='$amb',lesionado='$les',transito='$transito',tras_lesionado='$tras',entidad_lesionado='$entidad',`hora_asist`='$fecha_asis', `danos_mat`=$danos_mat, `heridos`=$heridos, `conciliacion`=$conciliacion, `croquis`=$croquis, `juez_gtias`=$juez_gtia, `rep_aseg`=$rep_aseg, `observacion`='$observacion', `estado`=1 where id_acc = ".$crudColumnValues['id'];
		if($DEBUGMODE == 1){$firephp->info($sql,'query');}
		mysql_query( $sql ) 
		or die($firephp->error('Couldn t execute queryactua.'.mysql_error()));
		break;
	case $crudConfig['delete']:
		/* ----====|| ACTION = DELETE ||====----*/
		if($DEBUGMODE == 1){$firephp->info('DELETE','action');}
		$sql = 'Delete from '.$crudTableName.' where id_acc = '.$crudColumnValues['id'];
		if($DEBUGMODE == 1){$firephp->info($sql,'query');}
		mysql_query( $sql ) 
		or die($firephp->error('Couldn t execute queryborra.'.mysql_error()));
		break;
	}

/* ----====|| SEND OUTPU		break;T ||====----*/
if($DEBUGMODE == 1){$firephp->info('End Of Script','status');}
print json_encode($o);

?>
