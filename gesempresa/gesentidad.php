<?php
session_start();
 include('../inc/libreria.php');
 
 if(!valida_usr(13)){
 
 echo "Acceso No Autorizado";
 return ;
 }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gestion de Grupos</title>
   
    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	
    <script src="../js/i18n/grid.locale-es.js" type="text/javascript"></script>
	<script src="../src/jqDnR.js" type="text/javascript"></script>
		<script src="../themes/development-bundle/ui/jquery.ui.autocomplete.js" type="text/javascript"></script>
	<script src="../src/jqModal.js" type="text/javascript"></script>
	 <script type="text/javascript">
	
  /*  $.jgrid.no_legacy_api = true;
    $.jgrid.useJSON = true;*/

	jQuery(document).ready(function(){ 
	jQuery("#crudgrup").jqGrid({ url:'gridentidad.php',
	 datatype: "json", 
	  mtype: 'POST',
	  colNames:['Id','Entidad']
	  , colModel :[
	 	  
	  {
	  name:'id_eps'
		,index:'id_eps'
		,width:35
		,align:'center'
		,editable:false
		},{
	  name:'eps'
		,index:'eps'
		,width:90
		//,align:'center'
		,editable:true
		
	}
	
	 
	],
	   
	   pager: jQuery('#pcrudgrup'),
    rowNum:10,
    rowList:[10,20,30],
	height:200,
	width:400,
    sortname: 'id_eps',
    sortorder: "asc",
   //viewrecords: true,
     caption: 'Gestión de Entidades',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl+"); 
	
	
	    editurl: 'gridentidad.php'// this is dummy existing url 
		
		 });
		 
		 jQuery("#crudgrup").jqGrid('navGrid','#pcrudgrup',{edit:true,add:true,del:true},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true});


		 
		 
	
		 
		
		 function pickdates(id){
	  jQuery('#pcrudgrup').datepicker({dateFormat:'yy-mm-dd'});
}
	/*	 jQuery( "#tabs" ).tabs({
						//event: "mouseover"
					});*/
					
});					
					

	//	 });
    </script>
    <script src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>
	
    <script src="../themes/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	 <link rel="stylesheet" type="text/css" href="../themes/css/custom-theme/jquery-ui-1.8.16.custom.css">
	<link rel="stylesheet" type="text/css" href="../css/ui.jqgrid.css">
	
    <link rel="stylesheet" type="text/css" media="screen" href="../themes/ui.multiselect.css" />
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
			/*demo page css*/
			body{ font: 62.5% "Trebuchet MS", sans-serif; margin: 50px;}
			.demoHeaders { margin-top: 2em; }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
		</style>	
</head>

<body>

<div  id="login1">login: [ <?php echo $_SESSION['login'];  ?>]</div>
<div id="Layer1"></div>
<div align="right"><span class="Estilo2"><a href="../login/index2.php" class="ui-state-hover">Volver al Men&uacute </a></span></div>
<span class="Estilo1">Gesti&oacute;n de Entidades</span>
		<table align="center" id="crudgrup"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudgrup" align="center"></div>



</body>
</html>
