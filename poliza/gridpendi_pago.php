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
    'id'=>'vehiculo.id_movil'
	,'placa'=>'placa'
	,'id_prop'=>'vehiculo.id_prop'
	,'nombre'=>"nombre" 
	,'apellidos'=>'apellidos'
	
	 ,'clase'=>'clase' 
	,'direccion'=>'direccion'
	,'telefono'=>'telefono'
	 ,'fecha_nac '=>'fecha_nac '	
	,'modelo'=>'modelo'
	,'marca'=>'marca'
      ,'motor'=>'motor' 
	,'serie'=>'serie'
	 ,'referencia'=>'referencia' 
	,'tipo'=>'tipo'
	 ,'color'=>'color' 
	 ,'grupo'=>'grupo' 
	 // ,'f_inclusion'=>'f_inclusion' 
//	,'f_fin'=>'f_fin'
	 ,'color'=>'color' 
	//,'saldo'=>'saldo' 
//	  ,'id_contra'=>'id_contra' 
	
	
);

$crudColumns1 =  array(
	 'grupo'=>'grupo' 
	
	
);
$ani=$_REQUEST['anio'];
$crudTableName = 'vehiculo';
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

$wh = "";
$searchOn = Strip($_REQUEST['_search']);
if($searchOn=='true') {
	$sarr = Strip($_REQUEST);
	foreach( $sarr as $k=>$v) {
		switch ($k) {
			//case 'id_movil':
			case 'placa':
			case 'marca':
			case 'clase':
			case 'referencia':
			case 'tipo':
			case 'color':
			case 'modelo':
			case 'grupo':
			case 'nombre':
			case 'apellidos':
			 $wh .= " and ".$k." LIKE '%".$v."%'";
				break;
			/*case 'nombre':
			 $wh .= " and concat_ws(' ',nombre,apellidos) LIKE '%".$v."%'";
				break;	*/
			case 'id_prop':
			$wh .= " and vehiculo.id_prop = ".$v;
				break;
			case 'id_movil':
			$wh .= " and vehiculo.id_movil = ".$v;
				break;	
				
			
		}
	}
}








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

//$dbLink = mysql_connect($dbConfig['dbServer'], $dbConfig['dbUser'], $dbConfig['dbPassword']);
//if (!$dbLink) {die('Could not connect: ' . mysql_error());}
mysql_select_db($dbConfig['dbDatabase2'], $dbLink);
/*----====|| ACTION SWITCH ||====----*/

function consulta_pago($ani){
$meses = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'); 
$consulta="select vehiculo.id_movil,placa,vehiculo.id_prop,clase,modelo,motor,serie,referencia,tipo,color,grupo,tipov ";


   $seldetalle=mysql_query("SELECT distinct periodo from contractual where saldo > 0 order by periodo asc");
  while($filadeta = mysql_fetch_array($seldetalle,MYSQL_ASSOC)) { 
     $nper=$filadeta['periodo'];
	 $per1=$nper[0];
	 $per2=$nper[1];
	$consulta = $consulta.",(select saldo  from contractual where  periodo='".$nper."' and id_movil=vehiculo.id_movil ) as '$nper'"; 
}
$consulta = $consulta.",sum(saldo) as saldo from (((vehiculo  inner join (tipo_taxi inner join tipov on tipo_taxi.id_tipov=tipov.id_tipov) on tipo_taxi.id_movil=vehiculo.id_movil)) inner join contractual on vehiculo.id_movil=contractual.id_movil) where contractual.saldo>0 ";
return $consulta;
}

//(((vehiculo inner join (sar.tipo_taxi inner  join (tipov inner join sarmicro.tipo_taxi on sarmicro.tipo_taxi.id_tipov=tipov.id_tipov) on sar.tipo_taxi.id_tipov=tipov.id_tipov) on vehiculo.id_movil=sar.tipo_taxi.id_movil) inner JOIN contractual ON vehiculo.id_movil = contractual.id_movil)  inner join sarmicro.propietario on vehiculo.id_prop=sarmicro.propietario.codigo)  left join propietario on vehiculo.id_prop=propietario.id_prop where 1



if($DEBUGMODE == 1){$firephp->info($postConfig['action'],'action');}
switch($postConfig['action']){
	case $crudConfig['read']:
		/* ----====|| ACTION = READ ||====----*/
		if($DEBUGMODE == 1){$firephp->info('READ','action');}
		/*query to count rows*/
		$sql='select count(vehiculo.id_movil) as numRows from ((vehiculo inner join contractual on vehiculo.id_movil=contractual.id_movil) inner  join propietario on trim(vehiculo.id_prop)=trim(propietario.id_prop))  where contractual.saldo>0 '.$wh;
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
		/*Run the data query 'select '.implode(',',$crudColumns)."  from (vehiculo  inner join marca on vehiculo.id_marca=marca.id_marca) left join propietario on vehiculo.id_prop=propietario.id_prop "*/
		$sql =consulta_pago($ani).$wh;
	//	if($postConfig['search'] == 'true'){
		//	$sql .= ' WHERE  ' . $postConfig['searchField'] . ' ' . fnSearchCondition($_POST['searchOper'], $postConfig['searchStr']);
		//}
		$sql .= ' group by vehiculo.id_movil ORDER BY ' . $postConfig['sortColumn'] . ' ' . $postConfig['sortOrder']; 
		$sql .= ' LIMIT '.$intStart.','.$intLimit;
		
		$imp="";
     $imp="$"."o->rows["."$"."i]['cell']=array("."$"."row[tipov],"."$"."row[id_movil],"."$"."row[placa],"."$"."row[id_prop],utf8_encode(rtrim("."$"."filaprop[nombre])),utf8_encode(trim("."$"."filaprop['apellidos'])),";	
		 $seldetalle=mysql_query("SELECT distinct periodo from contractual where saldo > 0 order by periodo asc");
		  $seldetalle1=mysql_query("SELECT distinct periodo from contractual where saldo > 0 order by periodo asc");
		  $numsel1=mysql_num_rows($seldetalle1);
		  
	
		  $seldetalle2=mysql_query("SELECT distinct periodo from contractual where saldo > 0 order by periodo asc");
		    $numsel2=mysql_num_rows($seldetalle2);
		// $y=0;
		// $y=0;
  while($filadeta = mysql_fetch_array($seldetalle,MYSQL_ASSOC)) { 
    $perio=$filadeta[periodo];
     $imp=$imp."$"."row['$perio']".",";
	// $y++;
  }
		
		$imp=$imp."$"."row[saldo]);";
		//if($postConfig['search'] == true){ $sql .= ' where '.$searchCondition; }
		if($DEBUGMODE == 1){$firephp->info($sql,'query');}
		$result = mysql_query( $sql ) 
		or die($firephp->error('Couldn t execute query.'.mysql_error()));
		/*Create the output object*/
		$o->page = $intPage; 
		$o->total = $total_pages;
		$o->records = $count;
		$i=0;
		$total=0;
		//$y=0;
		$a=0;
			while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
			$mov=$row[id_movil];
			$total += $row[saldo];
//			echo $row['2009-2010'];
			  for($w=0;$w<$numsel1;$w++) { 
			  $perifil=mysql_result($seldetalle1,$w,periodo);
      			  //  $perio=$filadeta1['periodo'];
     				$y[$w]+=$row[$perifil];
					// $row[$perio];
					// $y[$a];
					//+
				//	echo $a;
					//$a++;
				  }
				  $consultaprop=mysql_query("select vehiculo.id_movil,placa,nombre,apellidos,vehiculo.id_prop,clase,propietario.direccion,propietario.telefono,fecha_nac from vehiculo inner join propietario on trim(vehiculo.id_prop)=trim(propietario.id_prop) where vehiculo.id_movil='$mov' "); 
			$filaprop=mysql_fetch_array($consultaprop);	  
				  
			$consu =mysql_query("select *  from vehiculo left join contractual on vehiculo.id_movil=contractual.id_movil where contractual.periodo='$ani' and contractual.id_movil='$mov'");
			$filacontra=mysql_fetch_array($consu);
			$fecha1=$filacontra[f_inclusion];
			$fecha2=$filacontra[f_fin];
			$dias=calcdia($fecha1,$fecha2);
			
			$o->rows[$i]['id']=$row[id_movil];
			/* assign the row contents to a row var. */
			
			
			
			//$o->rows[$i]['cell']=array($row[id_movil],$row[placa],utf8_encode("$row[nombre]"),utf8_encode("$row[apellidos]"),$row[id_prop],$row[clase],utf8_encode("$row[direccion]"),$row[telefono],$row[fecha_nac],$row[modelo],$row[marca],$row[motor],$row[serie],$row[referencia],$row[tipo],$row[color],$row[grupo],$filacontra[f_inclusion],$filacontra[f_fin],$dias,$filacontra[valorp],$filacontra[id_contra],$filacontra[saldo]);
			eval($imp);
			$i++; 
			$a++;
		}
		
	//	$o->userdata['amount'] = $amttot; 
		//$o->userdata['tax'] = $taxtot; 
		
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
		foreach($crudColumns1 as $key => $value){ $updateArray[$key] = $value.'='.$crudColumnValues[$key]; };
		$sql .= implode(',',$updateArray);
		/* add any additonal update statements here */
	echo	$sql .= ' where id_movil = '.$crudColumnValues['id'];
		if($DEBUGMODE == 1){$firephp->info($sql,'query');}
		mysql_query( $sql ) 
		or die($firephp->error('Couldn t execute query.'.mysql_error()));
		break;
	case $crudConfig['delete']:
		/* ----====|| ACTION = DELETE ||====----*/
		if($DEBUGMODE == 1){$firephp->info('DELETE','action');}
		$sql = 'Delete from '.$crudTableName.' where id_eps = '.$crudColumnValues['id'];
		if($DEBUGMODE == 1){$firephp->info($sql,'query');}
		mysql_query( $sql ) 
		or die($firephp->error('Couldn t execute query.'.mysql_error()));
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

/* ----====|| SEND OUTPUT ||====----*/
if($DEBUGMODE == 1){$firephp->info('End Of Script','status');}
   $b=0;
 			for($w=0;$w<$numsel2;$w++) {  
      			    $perifil2=mysql_result($seldetalle2,$w,periodo);
     				//$y.$b+=$row['$perio'];
					//echo $y[$b]; 
					$o->userdata[$perifil2] = $y[$b]; 
					$b++;
				  }
$o->userdata['saldo'] = $total; 
$o->userdata['apellidos'] = 'Totales:';
print json_encode($o);

?>
