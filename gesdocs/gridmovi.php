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

$crudColumns1 =  array(
    'id'=>'id' 
	,'id_doc'=>'documento.id_doc'
	,'codigo'=>'codigo'
	,'documento'=>'documento'
	,'id_conductor'=>'con_doc.id_conductor'
	//,'fecha_vence'=>'fecha_vence'
	
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



if(!$sidx) $sidx =1; 
//connect to the database 
$db = mysql_connect($dbhost, $dbuser, $dbpassword) or die("Connection Error: " . mysql_error()); mysql_select_db($database) or die("Error conecting to db.");
///bussqueda

 switch ($examp) 
 { case 1:
  $result = mysql_query("SELECT COUNT(*) AS count from `comprobante`
INNER JOIN transaccion ON comprobante.`id_tran` = transaccion.`id_tran` WHERE comprobante.id_comprobante=".$id);
   $row = mysql_fetch_array($result,MYSQL_ASSOC);
  $count = $row['count'];
   if( $count >0 )
    { $total_pages = ceil($count/$limit); }
	 else { $total_pages = 0; } 
	 if ($page > $total_pages)
	  $page=$total_pages; 
	  $start = $limit*$page - $limit; 
	  // do not put $limit*($page - 1)
   if ($start<0) $start = 0; 
   $SQL = 'SELECT `id_comp` , `fecha_ante` , `fecha_nu` , `fecha_alavo` ,`observaciones`, detalle_tran,usuario
FROM  `comprobante` 
INNER JOIN transaccion ON comprobante.`id_tran` = transaccion.`id_tran` WHERE comprobante.id_comprobante='.$id.' ORDER BY '.$sidx; 
      $result = mysql_query( $SQL ) or die("Couldn?t execute query.".mysql_error());
    $responce->page = $page;
	$responce->total = $total_pages; 
	$responce->records = $count; $i=0; 
	//$sele=mysql_query("select * from tarjeta_control inner join v_documentos on tarjeta_control.id_doc_ref=v_documentos.id_doc where id_tarjeta=$id");
	//$filatar=mysql_fetch_array($sele);
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
	//$id_doc=$filatar['documento'];
	$responce->rows[$i]['id']=$row[id_comp]; 
	$responce->rows[$i]['cell']=array($row[id_comp],$row[fecha_alavo],$row[fecha_ante],$row[fecha_nu],$row[observaciones],$row[detalle_tran],$row[usuario]); $i++; }
	echo json_encode($responce); 
	break; } 
	?>