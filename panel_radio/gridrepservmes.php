<?php
session_start();
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
 $ano = $_GET['anio']; 
 $tmes = $_GET['mes']; 
 //configuracion de la busqueda
$wd = "";
$searchOn = Strip($_REQUEST['_search']);
if($searchOn=='true') {
	$sarr = Strip($_REQUEST);
	foreach( $sarr as $k=>$v) {
		switch ($k) {
			case 'grupo':
			case 'linea':
			case 'telefono':
				$wd .= " and ".$k." LIKE '%".$v."%'";
				break;
			
			//case 'tax':
			case 'id_movil':
			case 'id_movil2':
			case 'estado':
//			case 'fecha_plazo_a':
              /*  if($k=='sin asignar')
				$a=0;
				if($k=='asignados')
				$a=1;
				if($k== 2 then 'Descartados' when 3 then 'Apropiados' when 4 then 'Autorizados' end as estado*/
				$wd .= " AND ".$k." =".$v;
				break;
			case 'fecha_reg':
			   $newf=date('Y-m-d H:i',strtotime($v));
				$wd .= " and ".$k." >= '".$newf."'";
				break;
		}
	}
}




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
    'id'=>'id_ser' 
	,'linea'=>'linea'
	

	//,'descripcion'=>'descripcion'
//	,'telefonoa'=>'telefonoa'
//	,'celulara'=>'celulara'
	
);

$crudColumns1 =  array(
     'id'=>'id_ser' 
	
	,'telefono'=>'telefono'
	,'linea'=>'linea'
	,'direccion'=>'direccion'
	,'detalle_serv'=>'detalle_serv'
	,'fecha_reg'=>'fecha_reg'
	
	,'id_movil'=>'id_movil'
	,'id_movil2'=>'id_movil2'
	,'nombres'=>'nombres'
   ,'usuario'=>'usuario'
    ,'estado'=>"case estado when 0 then 'sin asignar' when 1 then 'Asignados' when 2 then 'Descartados' when 3 then 'Apropiados' when 4 then 'Autorizados' end as estado"
	 ,'observacion'=>'observacion'
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
$crudTableName = 'servicio_h';
$postConfig['id'] = 'id_ser'; 

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
		//$sqlc=mysql_query("select COUNT(*) from servicio where estado>=1 ".$wd);
		 $inicio=$ano.'-'.$tmes.'-01 05:59:59';
		  $dfin=date("d",(mktime(0,0,0,$tmes+1,1,$ano)-1));
		  $mesi=$tmes+1;
		  
		 $fin=$ano.'-'.$mesi.'-01 05:59:59';
		
	  $sql='select count('.$postConfig['id'].") as numRows from servicio_h where estado>=1 and  year(fecha_reg)= ".$ano." and  (fecha_reg > '$inicio')  and fecha_reg<'$fin'  ".$wd;
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
		 
		 ///*****************
		
	 	$sql = 'select '.implode(',',$crudColumns1)." from servicio_h where estado>=1 and year(fecha_reg)= ".$ano."  and  (fecha_reg > '$inicio')  and fecha_reg<'$fin' ";
		/*if($postConfig['search'] == 'true'){
			$sql .= ' and  ' . $postConfig['searchField'] . ' ' . fnSearchCondition($_POST['searchOper'], $postConfig['searchStr']);
		}*/
		
		   $sql .= $wd;
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
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
	$o->rows[$i]['id']=$row[id_ser]; 
	$o->rows[$i]['cell']=array($row[id_ser],$row[telefono],utf8_encode($row[linea]),utf8_encode($row[direccion]),utf8_encode($row[detalle_serv]),$row[fecha_reg],$row[id_movil],$row[id_movil2],utf8_encode($row[nombres]),utf8_encode($row[usuario]),$row[estado],utf8_encode($row[observacion])); $i++; }
		break;
	case $crudConfig['create']:
	
	$id_movil=$_REQUEST['id_movil'];
	$linea=$_REQUEST['linea'];
	$conpto=mysql_query("select *  from linea_atencion inner join tipo_linea on tipo_linea.id_tipo_linea=linea_atencion.id_tipo_linea where linea='$linea'");
	$filatipo=mysql_fetch_array($conpto);
	$id_tipo=$filatipo['id_tipo_linea'];
	if($id_tipo==3){
	$direccion=$linea;
	$tel="pto_radio";
	$recep=2;
	}else{
	
	$direccion=$_REQUEST['direccion'];
	$tel=$_REQUEST['telefono'];
	$recep=0;
	}
	if($id_tipo==2){
	$direccion=$_REQUEST['direccion'];
	$tel=$_REQUEST['telefono'];
	$recep=1;
	}
	
	$fecha_reg=date("Y-m-d H:i");
	$detalle=$_REQUEST['detalle_serv'];
	$estado=0;
	
	$usuario=$_SESSION['login'];
	
	
	
		/* ----====|| ACTION = CREATE ||====----*/
		if($DEBUGMODE == 1){$firephp->info('CREATE','action');}
		/*basic start to the insert query*/
		$sql = 'insert into '.$crudTableName.'(`fecha_reg`, `linea`, `telefono`, `direccion`, `detalle_serv`, `estado`, `usuario`, `recep_serv`';
		/*add the list of columns */
		//$sql .= implode(',',$crudColumns);
		/*  !!! add any additional columns not defined in the column array here. */
		 $sql .= ")VALUES(now(),'$linea','$tel','$direccion','$detalle',$estado,'$usuario',$recep";
		/* add the values from POST vars */
		
//	$sql .= implode(',',$crudColumnValues);
		/*  !!! add any additional columns not defined in the column array here. */
		$sql .= ')';
		if($DEBUGMODE == 1){$firephp->info($sql,'query');}
		mysql_query( $sql ) 
		or die($firephp->error('Couldn t execute query.'.mysql_error()));
		break;
	case $crudConfig['update']:
		/* ----====|| ACTION = UPDATE ||====----*/
	$id_movil=$_REQUEST['id_movil'];
	$id_movil2=$_REQUEST['id_movil2'];
	$conmovil=mysql_query("select vehiculo.placa,tarjeta_control.`id_tarjeta`,tarjeta_control.`tarjeta`,conductor.id_conductor,conductor.codigo,concat(nombre1,' ',nombre2,' ',apellido1,' ',apellido2) as nombres from frecuencia inner join ((tarjeta_control inner join vehiculo on tarjeta_control.id_movil=vehiculo.id_movil) inner join conductor on tarjeta_control.id_conductor=conductor.id_conductor) on frecuencia.id_tarjeta=tarjeta_control.id_tarjeta where frecuencia.id_movil=$id_movil2");
	$filamovil=mysql_fetch_array($conmovil);
	
	
	
	$placa=$filamovil['placa'];
	//$fecha_asig=date("Y-m-d H:i");
	
	//$ffin=date("Y-m-d H:i",strtotime($f_fin));
	$id_tarjeta=$filamovil['id_tarjeta'];
	$tarjeta=$filamovil['tarjeta'];
	$id_conductor=$filamovil['id_conductor'];
	$codigo=$filamovil['codigo'];
	$nombres=$filamovil['nombres'];
	$direccion=$_REQUEST['direccion'];
	$tel=$_REQUEST['telefono'];
	if(empty($id_movil)){
	
	$estado=0;
	}else{
	$estado=1;
	}
	
	$usuario=$_SESSION['login'];
		if($DEBUGMODE == 1){$firephp->info('UPDATE','action');}
		$sql = 'update '.$crudTableName." set  `id_movil`='$id_movil',id_movil2='$id_movil2' ";
		/* create all of the update statements */
		//foreach($crudColumns as $key => $value){ $updateArray[$key] = $value.'='.$crudColumnValues[$key]; };
		//$sql .= implode(',',$updateArray);
		/* add any additonal update statements here */
	echo $sql .= ' where id_ser = '.$crudColumnValues['id'];
		 
		 $comp=mysql_query(" insert into `comp_servicio` (`fecha`, `usuario`, `id_movil`, `placa`, `id_conductor`, `codigo`, `nombres`, `id_tarjeta`, `tarjeta`, `id_tran`,obs) values (now(),'$usuario','$id_movil2','$placa','$id_conductor','$codigo','$nombres',$id_tarjeta,'$tarjeta',18,'SE TRASLADO EL SERVICIO DEL MOVIL $id_movil')");
		 
		 
		if($DEBUGMODE == 1){$firephp->info($sql,'query');}
		mysql_query( $sql ) 
		or die($firephp->error('Couldn t execute query.'.mysql_error()));
		break;
	case $crudConfig['delete']:
		/* ----====|| ACTION = DELETE ||====----*/
		if($DEBUGMODE == 1){$firephp->info('DELETE','action');}
		$sql = 'Delete from '.$crudTableName.' where id_susp = '.$crudColumnValues['id'];
		if($DEBUGMODE == 1){$firephp->info($sql,'query');}
		mysql_query( $sql ) 
		or die($firephp->error('Couldn t execute query.'.mysql_error()));
		break;
	}
	
	

/* ----====|| SEND OUTPUT ||====----*/
if($DEBUGMODE == 1){$firephp->info('End Of Script','status');}
print json_encode($o);
//////////////////
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
/* cuando se toma un servicio nuevo
create trigger actualiza_dir after insert on servicio
for each row
 begin 
if(new.telefono<>' ' and new.direccion<>' ') then
insert into directorio (telefono,direccion) values (new.telefono,new.direccion) 
on duplicate key update direccion=new.direccion;
end if;
end

para cuando se actualiza el servicio

create trigger actualiza_dir2 after update on servicio
for each row
begin 
if(new.telefono<>' ' and new.direccion<>' ') then
insert into directorio (telefono,direccion) values (new.telefono,new.direccion) 
on duplicate key update direccion=new.direccion;
end if;
end;

*/

?>