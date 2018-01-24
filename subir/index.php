<?php
session_start();
date_default_timezone_set('America/Bogota');  
 include('../inc/libreria.php');
 include('../inc/operaciones.php');
 
 if(!valida_usr(32)){
 
 echo "Acceso No Autorizado";
 return ;
 }
 


    
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Subir fotos de conductores</title>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/themes/base/jquery-ui.css"
        id="theme">
    <link rel="stylesheet" href="js/jquery.fileupload-ui.css">
	    
	 <link rel="stylesheet" type="text/css" href="../themes/css/custom-theme/jquery-ui-1.8.16.custom.css">
	<link rel="stylesheet" type="text/css" href="../css/ui.jqgrid.css">

   <link rel="stylesheet" type="text/css" href="../plugins/ui.multiselect.css">

   <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.min.js"></script> -->
	<script  src="../themes/js/jquery-1.6.2.min.js"></script> 
	<script  src="../themes/js/jquery-ui-1.8.16.custom.min.js"></script> 
	
    <script src="js/jquery.fileupload.js"></script>
    <script src="js/jquery.fileupload-ui.js"></script>
    <style>
        body
        {
            font-family: Verdana, Arial, sans-serif;
            font-size: 13px;
            margin: 0;
            padding: 20px;
        }
    .Estilo3 {font-size: 24px}
    #Layer1 {
	position:absolute;
	width:600px;
	height:107px;
	z-index:2;
	left: 476px;
	top: 61px;
}
    #Layer2 {
	position:absolute;
	width:598px;
	height:115px;
	z-index:3;
	left: 476px;
	top: 224px;
}
    </style>
</head>
<body>

<div  id="login1">login: [ <?php echo $_SESSION['login'];  ?>]</div>
<div align="right">
  <div id="Layer1" class="Estilo3">  
  <p align="justify">Adjunte las fotos de los conductores, el nombre del archivo debe ser el n&uacute;mero de cedula y debe estar en formato .jpg, puede adjuntar una o varias al mismo tiempo</p></div>
<span class="Estilo2"><a href="../login/index2.php" class="ui-state-hover">Volver al Men&uacute </a></span></div>

 
        <div id="Layer2">
          <form id="file_upload" action="upload.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file" multiple>
    <button>
        Upload</button>
    <div>
        <img src="img/upload.png" alt="Subir imagen">
	    <br>
   Subir imagen</div>
</form>
<table id="files" align="center">
        <tr valign="baseline">
            <td colspan="2">
            </td>
        </tr>
</table>
</div>
       
    <script>
        /*global $ */
        $(function () {
            $('#file_upload').fileUploadUI({
                uploadTable: $('#files'),
                downloadTable: $('#files'),
                buildUploadRow: function (files, index) {
                    return $('<tr><td>' + files[index].name + '<\/td>' +
                    '<td class="file_upload_progress"><div><\/div><\/td>' +
                    '<td class="file_upload_cancel">' +
                    '<button class="ui-state-default ui-corner-all" title="Cancel">' +
                    '<span class="ui-icon ui-icon-cancel">Cancel<\/span>' +
                    '<\/button><\/td><\/tr>');
                },
                buildDownloadRow: function (file) {
                    return $('<tr><td nowrap align="right" class="texto" style="padding-top: 10px;"><b>Archivo Subido:</b><\/td>' +
                                            '<td>' + file.name + '</td>' +
                                            '<\/tr></table>');
                }
            });
        });
</script>


   
</body>
</html>
