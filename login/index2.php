<?php
session_start();
 include('../inc/libreria.php');
$login=$_SESSION['id_usr'] ;
//echo $login;
 if(!valida_usr(1)){
 
 echo "Acceso No Autorizado Introdusca un Usuario Valido";
 echo " <a href='logout.php' class='ui-state-hover'>Entrar</a>";
 return ;
 } 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Men&uacute; Principal</title>
    <script  src="../inc/prototype.js"></script>
	<script  src="../inc/funciones.js"></script>
    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	
    <script src="../js/i18n/grid.locale-es.js" type="text/javascript"></script>
	<script src="../src/jqDnR.js" type="text/javascript"></script>
	
	<script src="../src/jqModal.js" type="text/javascript"></script>

	
	    <script type="text/javascript">
     jQuery.noConflict();

	jQuery(document).ready(function(){ 
	
    var idusr=<?php echo $login; ?>;
	jQuery("#crud").jqGrid({ url:'gridmenu.php?id_usr='+idusr,
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['Opcion','','Grupo','']
	  , colModel :[
	 	  
	  {
		name:'opcion'
		,index:'opcion'
		,width:350
		//,align:'center'
		},{
		name:'id_grupo'
		,index:'id_grupo'
		,width:100
		,editable:false
		,hidden:true
	},{
		name:'grupo'
		,index:'grupo'
		,width:100
		,editable:true
	},{
		name:'path'
		,index:'path'
		,width:80
		,editable:true
		,hidden:true

},
	],
	   
	//   pager: jQuery('#pcrud'),
    rowNum:35,
    rowList:[10,20,30],
	height:'auto',
	width:'auto',
    sortname: 'id_grupo',
    sortorder: "asc",
    viewrecords: true,
     caption: 'M�dulos Autorizados ',
	 onSelectRow:function(ids) {
	 	 var rowData = jQuery(this).getRowData(ids); 
		 var path= rowData['path'];
	 
	// alert(path)
	 window.location ="../"+path;
	 //abre_path()
	 
	 },
     postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
	
	    editurl: 'gridmenu.php?id_usr='+idusr// this is dummy existing url 
		
		 });
		 
		 jQuery("#crud").jqGrid('navGrid','#pcrud',{edit:false,add:false,del:false,searchtext:'Busqueda'},{height:400,reloadAfterSubmit:true,closeAfterEdit : true});

//	 
		 function pickdates(id){
	  jQuery('#pcrud').datepicker({dateFormat:'yy-mm-dd'});
}

 });
    </script>

    <script src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>
	
    <script src="../themes/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	 <link rel="stylesheet" type="text/css" href="../themes/css/custom-theme/jquery-ui-1.8.16.custom.css">
	<link rel="stylesheet" type="text/css" href="../css/ui.jqgrid.css">
   <link rel="stylesheet" type="text/css" href="../plugins/ui.multiselect.css">

    <style type="text/css">
<!--
.Estilo1 {
	color: #333333;
	font-size: 36px;
	font-weight: bold;
	font-style: italic;
}
-->
    </style>
	<style type="text/css">
	#box {
display: none;
}
#tc {
display: none;
}
			/*demo page css*/
			body{ font: 62.5% "Trebuchet MS", sans-serif; margin: 50px;}
			.demoHeaders { margin-top: 2em; }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
		#actualiza1 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:1;
	left: 666px;
	top: 91px;
}

    </style>	
</head>

<body>
<div  id="login1">
  <p>login: [ <?php echo $_SESSION['login'];  ?>]</p>
  
  <a href="logout.php" class="ui-state-hover">Cerrar Sesi&oacute;n</a>
</div>
<!--<div id="Layer1"></div> -->


<span class="Estilo1">Men&uacute; Principal </span>
<table align="center" id="crud"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrud" align="center"></div>

<?php
$_POST['db']=array("sar","sarmicro",);
$_POST['tables']="on";
$_POST['data']="on";
$_POST['drop']="on";
$period=((3600*24)/24)*2;
$security_key="b0adeb28351329cae27acc0c9d48636f";
// switch to the phpMyBackupPro v.2.2 directory
@chdir("/var/www/html/sar/backup");
@include("backup.php");
@chdir("/var/www/html/sar/backup/");
?>
</body>
</html>
