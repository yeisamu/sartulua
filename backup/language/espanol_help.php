<?php
/*     
 +--------------------------------------------------------------------------+      
 | phpMyBackupPro                                                           |  
 +--------------------------------------------------------------------------+ 
 | Copyright (c) 2004-2007 by Dirk Randhahn                                 |                                                                                    
 | http://www.phpMyBackupPro.net                                            |
 | version information can be found in definitions.php.                     | 
 |                                                                          |   
 | This program is free software; you can redistribute it and/or            |   
 | modify it under the terms of the GNU General Public License              |  
 | as published by the Free Software Foundation; either version 2           | 
 | of the License, or (at your option) any later version.                   | 
 |                                                                          |  
 | This program is distributed in the hope that it will be useful,          |  
 | but WITHOUT ANY WARRANTY; without even the implied warranty of           | 
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            | 
 | GNU General Public License for more details.                             | 
 |                                                                          | 
 | You should have received a copy of the GNU General Public License        | 
 | along with this program; if not, write to the Free Software              |  
 | Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307,USA.|   
 +--------------------------------------------------------------------------+  
*/                                                                              
/*                                                                              
 +--------------------------------------------------------------------------+    
 | phpMyBackupPro Spanisch translation                                      |    
 +--------------------------------------------------------------------------+    
 | Spanish translation 2.1                                                  |    
 | July 2006 by Ruben Dario PICCATO, rpiccato@graficastuning.com.ar         |
 | September 2007 by Juan Jose Gonzalez, www.todo-mods.com                  |
 +--------------------------------------------------------------------------+   
*/

chdir("..");   
require_once("definitions.php");   
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\"     
   \"http://www.w3.org/TR/html4/loose.dtd\">

<html".ARABIC_HTML.">      
<head>   
<meta http-equiv=\"Content-Type\" content=\"text/html;charset=".BD_CHARSET_HTML."\">  
<link rel=\"stylesheet\" href=\"./../".PMBP_STYLESHEET_DIR.$CONF['stylesheet'].".css\" type=\"text/css\">   
<title>phpMyBackupPro - ".F_HELP."</title>  
</head>  
<body>   
<table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" width=\"100%\">\n   
<tr><th colspan=\"2\" class=\"active\">";    
echo PMBP_image_tag("../".PMBP_IMAGE_DIR."logo.png","phpMyBackupPro PMBP_WEBSITE",PMBP_WEBSITE);  
echo "</th></tr>\n";  


// choose help text   
switch(preg_replace("'^.*/'","",$_GET['script'])) { 
    case 'index.php': $filename=F_START;    
    $html="Haga click en este �cono en las diferentes p�ginas para recibir ayuda espec�fica para cada contenido.<br>  
    Puede hallar m�s informaci�n en: <a href=\"".PMBP_WEBSITE."\" target=\"_blank\">".PMBP_WEBSITE."</a><br> 
    Por favor reporte a esa web errores y sugerencias.";   
    break;    
    case 'config.php': $filename=F_CONFIG; 
    $html="Hay dos niveles de configuraci�n: b�sico y  extendido. Editar las variables de sistema en configuraci�n extendida es opcional.<br>  
	Los item marcados con * no pueden permanecer en blanco.<br><br>    
	Configuraciones b�sicas:<br>
	".C_SITENAME.": Otorgar un nombre al sitio ej.'production server'.<br>    
	".C_LANG.": Cambia el lenguaje de phpMyBackupPro. Puedes descargar gran cantidad de paquetes de lenguajes en el sitio del proyecto.<br> 
	".C_SQL_HOST.": Indica tu host MySQL  ej.: 'localhost'.<br>
	".C_SQL_USER.": Indica tu nombre de usuario MySQL.<br>    
	".C_SQL_PASSWD.": Indica tu contrase�a MySQL .<br>  
	".C_SQL_DB.": Si solo usas una base de datos en el servidor, puede ingresar el nombre de la base de datos aqu�.<br>
	".C_FTP_USE.": Marque si puede utilizar las funciones FTP para subir sus backups automaticamente en el servidor FTP.<br> 
	".C_FTP_BACKUP.": Marque si est� habilitado el directorio de backup para el servidor FTP.<br>  
	".C_FTP_REC.": Marque esto si necesitaque el directorio de backup incluya subdirectorios.<br>  
	".C_FTP_SERVER.": Indica la IP o URL de su servidor FTP.<br>   
	".C_FTP_USER.": Indica tu nombre de usuario de FTP.<br>  
	".C_FTP_PASSWD.": Indica tu contrase�a FTP.<br>    
	".C_FTP_PATH.": Indica la ruta al directorio en el servidor FTP donde deseas guardar los backups.<br>
	".C_FTP_PASV.": Marque esto para usar FTP pasivo.<br>  
	".C_FTP_PORT.": Indica el puerto para utilizar con el servidor FTP. Por defecto el puerto es 21.<br> 
	".C_FTP_DEL.": Marque esto para hacer que los archivos de backups en el servidor FTP automaticamente borrados cuando son borrados localmente.<br>
	".C_EMAIL_USE.": Marque para enviar automaticamente sus backups v�a Email.<br>  
	".C_EMAIL.": Indica la direcci�n de email para enviar para enviar los backups.<br><br>   
	Configuraciones extendidas:<br>   
	".C_STYLESHEET.": Seleccione la apariencia para phpMyBackupPro. Puedes descargar y enviar nuevas apariencias al sitio de phpMyBackupPro.<br>   
	".C_DATE.": Seleccione su formato favorito de fecha.<br>  
	".C_LOGIN.": Puedes cambiar tu HTTP authentication si lo necesitas.<br>   
	".C_DEL_TIME.": Especifica el n�mero de d�as de espera para borrar automaticamente los archivos de backup. Use 0 para desactivarla.<br>   
	".C_DEL_NUMBER.": Especifica el n�mero m�ximo de copias de backup para ser almacenadas por cada base de datos.<br>    
	".C_TIMELIMIT.": Incrementa el tiempo l�mite de PHP si tiene problemas al realizar  backups o importaciones. Puede que no surta efecto si est� activado el safe mode de PHP.<br> 
	".C_CONFIRM.": Seleccione que acciones de importaci�n requieren ser confirmadas.<br>  
	".C_IMPORT_ERROR.": Marcar esto para recibir una lista con los errores de importaci�n si ocurre alguno.<br>  
	".C_DIR_BACKUP.": Marcar esto para habilitar el directorio de backup. Datos v�lidos de FTP deben ser ingresados para usar esta caracter�stica.<br> 
	".C_DIR_REC.": Marque esto para directorios de backup recursivos (con todas las subcarpetas).<br>     
	".C_NO_LOGIN.": Marcar esto para deshabilitar la funci�n de identificaci�n. Esto no es recomendable porque cualquiera tendr�a acceso a sus bases de datos!<br><br>     
	Variables de Sistema:<br>    
	Desde aqui se cambian los valores de las variables internas de phpMyBackupPro. Modifique solo si est� seguro de lo que hace.
	Puede buscar informaci�n ampliada dentro del archivo de documentaci�n 'SYSTEM_VARIABLES.txt' .";
    break;   
    case 'import.php': $filename=F_IMPORT;   
    $html="Aqui puede ver todos los archivos locales de backup.<br>      
    Puede recibir m�s informaci�n clickeando en 'info'.<br>
    Al clickear 'ver', puede leer el archivo de backup.<br>  
    Para descargar el archivo de backup haga click 'en ".B_DOWNLOAD."'.<br>   
    Clickee en 'importar' para restaurar en la base de datos el archivo. Antes de esto debe vaciar la base de datos haciendo click en 'vaciar base de datos'.<br>
    Para borrar el archvio de backup use 'borrar'. Puede borrar todos los archivos de backup juntos de una base de datos usando 'borrar todos los backups'.<br><br>    
    Clickee 'vaciar TODAS la bases de datos' para vaciar todas las bases de datos disponibles, clickee'importar TODOS los backups' para importar los ultimos backups de cada base de datos,   
    clickee 'borrar TODOS los backups' para borrar todos los backups disponibles.";  
    break;    
    case 'backup.php': $filename=F_BACKUP;     
    $html="Aqui puede seleccionar cada base de datos a la que desee realizar backup.<br>   
    Los comentarios pueden guardarse con el archivo de backup.<br>    
    Puedes seleccionar si usar la estructura de la tabla, los datos o ambos podr�an ser archivados.<br>    
    Para a�adir 'drop table if exists ...' en la estructura de tablas seleccione 'a�adir drop table'<br>   
    Puede seleccionar el formato de compresi�n de los archivos de backups. En algunos sistemas, no todos los formatos son soportados. 
    El formato zip est� en desarrollo experimental. Confirme que el archivo zip funciona correctamente!<br><br>  
	Si tiene activada la funci�n de backup FTP, solo puedes hacer backups completos al directorio de su servidor FTP.<br> 
	Los directorios seleccionados i los archivos deber�an copiarse en '".C_FTP_PATH."' configurado en la p�dina de'".F_CONFIG."'.<br>   
	Esto no es posible con archivos comprimidos o por email. El listado de directorio se genera al ingresar solamente. Si necesita actualizar la lista, clickee en '".PMBP_EXS_UPDATE_DIRS."'.";    
    break; 
    case 'scheduled.php': $filename=F_SCHEDULE;
    $html="Para automatizar el backup, puedes generar un c�digo para incluir en alg�n script PHP existente.<br>  
    Cuando este script es cargado, el backup se inicia automaticamente. Puedes programar cuando quieres que se realice el backup.<br><br>   
    Luego, seleccione donde localizar el script. El directorio phpMyBackupPro.".PMBP_VERSION." no deber�a ser movido despu�s de este cambio! 
	(Si actualizas el c�digo PHP, puedes cambiar luego el directorio.)<br><br>  
	Al clickear en '".EXS_SHOW."' muestra el script que se usa para hacer funcionar el backup prgramado. Copie el c�digo e incluyalo en alg�n archivo PHP,
	o use '".C_SAVE."' para guardar el script automaticamente en un archivo nuevo. Esto podr�a sobreescribir alg�n archivo existente con el mismo nombre!<br>  
	Nota: El archivo debe estar en el directorio seleccionado en la anterior p�gina para trabajar correctamente.<br>  
    El backup podr�a solo ejecutarse, cuando el script es ejecutado. Puedes incluirlo dentro de otro archivo PHP existente o usar un  frame estableciendolo como frame invisible.<br><br>   
    Todas las opciones de configuraci�n pueden trabajar en este script!<br> Puedes buscar m�s informaci�n acerca del backup en la secci�n de 'backup' ayuda.";  
    break;  
    case 'db_info.php': $filename=F_DB_INFO; 
    $html="Aqu� puede ver un peque�o resumen de sus bases de datos.<br><br> 
    En la columna 'n�mero de registros' se encuentra el n�mero de registro de todas las tablas.<br>  
    Si la base de datos contiene tablas, al clickear en 'informaci�n de tablas' obtienes los nombres, n�mero de columnas, n�mero de registros y el tama�o de las tablas de la respectiva base de datos.<br>   
    El tama�o puede diferir con el archivo de backup porque son necesarios datos adicionales para el archivo de backup.";   
    break;   
    case 'sql_query.php': $filename=F_SQL_QUERY;  
    $html="Esta p�gina es para enviar consultas simples SQL a la base de datos.<br><br>   
    Puedes seleccionar la base de datos en la que quieres ejecutar la consulta.<br>    
    Puedes insertar una o m�s consultas SQL en el area de texto.<br>            
    Consultas como 'select ...' pueden retornar una tabla de resultado.<br>    
    Algunas consultas como 'delete ...' podr�an solo decir '".SQ_SUCCESS."'<br><br>
    Si sube un archivo para ejecutar podr�a recibir un mensaje de error por cada error que sucediera! (y podr�an ser muchos!)<br>  
    El �ltimo mensaje de error contiene una lista de todas las consultas, las cuales generaron el error. La 'F' anterior al n�mero de la consulta significa que esta consulta est� dentro de un archivo.<br><br> 
    Estas funciones est�n en desarrollo! No garantizamos que se efectuen correctamente las consultas!";  
    break;   
    default: $html="Disculpe, no hay ayuda relacionada a esta p�gina";
}  

echo "<tr>\n<td>\n";  
if ($filename) echo "<br><div class=\"bold_left\">Ayuda para ".$filename.":</div><br>\n";  
echo $html;  
echo "</td>\n</tr>\n</table>\n</body>\n</html>";

?>

