<?php
function conectarse()
{
   if (!($link=mysql_connect("localhost","root","")))
   {
      echo "Error conectando al servidor .";
      exit();
   }
   if (!mysql_select_db("sar",$link))
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
$dbConfig['dbServer'] = 'localhost';    /* Server */
$dbConfig['dbUser'] = 'root';         /* Username */
$dbConfig['dbPassword'] = '';         /* Password */
$dbConfig['dbDatabase'] = 'sar';   
$dbhost='villadecespedestulua.com'; 
$dbuser= 'root'; 
$dbpassword= ''; 
$database= 'sar';
 // $link=conectarse();
?>
