<?php
function conectarse()
{
   if (!($link=mysql_connect("villadecespedestulua.com","villadec_sar","td72da")))
   {
      echo "Error conectando al servidor .";
      exit();
   }
   if (!mysql_select_db("villadec_sar",$link))
   {
      echo "Error seleccionando la base de datos.";
      exit();
   }
   return $link;
}

function valida_usr($id_opcion){
        $link=conectarse();
        $login = $_SESSION['login'];
        $clave = $_SESSION['pass'];
    $comando = "select * from acc_usuario inner join acc_permiso on acc_usuario.id_usr = acc_permiso.id_usr where login like '%$login%' and clave = '$clave' and id_opcion = $id_opcion and permiso = 1";
    //echo $comando;
    $resultado = mysql_query($comando);
    $nregistros = mysql_num_rows($resultado);
    if ($nregistros == 0){
        return 0;
    }
    return 1;
}
$dbConfig['dbServer'] = 'villadecespedestulua.com';    /* Server */
$dbConfig['dbUser'] = 'villadec_sar';         /* Username */
$dbConfig['dbPassword'] = 'td72da';         /* Password */
$dbConfig['dbDatabase'] = 'villadec_sar';   
$dbhost='villadecespedestulua.com'; 
$dbuser= 'villadec_sar'; 
$dbpassword= 'td72da'; 
$database= 'villadec_sar';
 // $link=conectarse();
?>
