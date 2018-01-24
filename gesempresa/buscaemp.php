<?php
include('../inc/libreria.php');
$link=conectarse();
$q = strtolower($_REQUEST["id_emp"]);
if (!$q) return; //si no nos trae nada retornamos
//$items[] = array();//creamos un array llamado items
//$nombre[] = array();
$cadena = trim($q); //le asignamos a cadena $Q sin espacios
//conectamos con mysql y con la base de datos
/*$con_mysql=mysql_connect('localhost','root',''); //nos conectamos con la BD
// verificamos si la conexion con mysql ha sido exitosa
if (!$con_mysql) {echo 'No se ha podido encontrar el servidor de datos';exit;}
// si fue exitosa nos conectmos a la basse de datos empresa
mysql_select_db('sart',$con_mysql);*/
//consultamos los registros coincidentes, en este caso por apellido
$select = mysql_query("SELECT * FROM empresa where id_empresa='$cadena'");
//si no hay registros retornamos
if(mysql_num_rows($select) == 0)
{
//return false;
echo "<script>alert('no existe');</script>";
}
else// para el caso q si haya registro conincidentes
{
//montamos bucle para presentar los items de la lista
//$i=0; //creo una variable del tipo entero
/*while()
{
    $i++;*/ //incremento
 //insertamos en el array los datos
$fila=mysql_fetch_array($select);
?><table width="500" border="0" align="center" cellspacing="5">
 <tr class="ui-widget-header">
	   

 <td width="108"><div align="center" class="Estilo10">NIT.</div></td> 
		<td width="108"><div align="center" class="Estilo10">Sitio de Control</div></td> 
			   </tr>
  <tr>
	    <td width="108" class="ui-widget-content"><div align="center" class="Estilo10"><?php
 echo $fila["nit"];?></div></td> 
		<td width="108" class="ui-widget-content"><div align="center" class="Estilo10"><?php
 echo $fila["direccion"];?></div></td> 
	  
	   </tr>
	   </table>
	   <?php
 //echo $fila["nit"];
//"label"=>$fila["nit"],"value"=>$fila["nit"],"nombre" =>$fila["nombre"],"direccion" => $fila["direccion"]

//,"estado" => $fila["primer_nombre"]." ".$fila["segundo_nombre"]." ".$fila["primer_apellido"]." ".$fila["segundo_apellido"],"direccion" => $fila["direccion"]
//array_push($nombre,array("id"=>$i,"label"=>$fila["primer_nombre"],"value"=>$fila["primer_nombre"] ));
//}
}
//pasamos el array a formato JSON y lo imprimimos
//echo json_encode($items);
//echo json_encode($nombre);
?>