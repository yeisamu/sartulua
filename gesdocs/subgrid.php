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
  $result = mysql_query("SELECT COUNT(*) AS count from (con_doc inner join conductor on con_doc.id_conductor=conductor.id_conductor) inner join documento on con_doc.id_doc=documento.id_doc WHERE con_doc.id_conductor=".$id);
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
   $SQL = 'SELECT con_doc.id,documento.id_doc as doc,codigo,documento,con_doc.id_conductor as condu,fecha_vence FROM (con_doc inner join conductor on con_doc.id_conductor=conductor.id_conductor) inner join documento on con_doc.id_doc=documento.id_doc WHERE con_doc.id_conductor='.$id; 
      $result = mysql_query( $SQL ) or die("Couldn?t execute query.".mysql_error());
    $responce->page = $page;
	$responce->total = $total_pages; 
	$responce->records = $count; $i=0; 
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
	$responce->rows[$i]['id']=$row[id]; 
	$responce->rows[$i]['cell']=array($row[codigo],$row[documento],$row[fecha_vence],$row[id],$row[condu],$row[doc]); $i++; }
	echo json_encode($responce); 
	break; } 
	?>