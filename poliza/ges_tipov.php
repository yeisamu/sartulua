<?php
session_start();
 include('../inc/libreria.php');
 
 if(!valida_usr(28)){
 
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
	jQuery("#crudgrup").jqGrid({ url:'gridtipov.php',
	 datatype: "json", 
	  mtype: 'POST',
	  colNames:['Id','Tipo de Vehiculo']
	  , colModel :[
	 	  
	  {
	  name:'id_tipov'
		,index:'id_tipov'
		,width:30
		,align:'center'
		,editable:false
		},{
	  name:'tipov'
		,index:'tipov'
		,width:100
		//,align:'center'
		,editable:true
		,editrules:{required:true}
	}
	
	 
	],
	   
	   pager: jQuery('#pcrudgrup'),
    rowNum:10,
    rowList:[10,20,30],
	height:200,
	width:400,
    sortname: 'id_tipov',
    sortorder: "ASC",
   //viewrecords: true,
     caption: 'Gestión de Tipos de Vehiculo ',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl+"); 
	
	
	    editurl: 'gridtipov.php'// this is dummy existing url 
		
		 });
		 
		 jQuery("#crudgrup").jqGrid('navGrid','#pcrudgrup',{edit:true,add:true,del:true},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true});
		 
		 
jQuery("#crudve").jqGrid({ url:'grid_movil_tipov.php',
	 datatype: "json", 
	  mtype: 'POST',
	  colNames:['Movil','Tipo de Vehiculo','Tipo de Vehiculo']
	  , colModel :[
	 	  
	  {
	  name:'id_movil'
		,index:'id_movil'
		,width:30
		,align:'center'
		,editable:true
		},{
	  name:'id_tipov'
		,index:'id_tipov'
		,width:230
		,align:'center'
		,editable:true
		,hidden:true
		,editrules:{edithidden:true,required:true}
		,edittype:'select'
		,editoptions:{ dataUrl: '../inc/lista.php?tb=tipov&cid=id_tipov&cd=tipov' }
		},{
		
	  name:'tipov'
		,index:'tipov'
		,width:100
		,align:'center'
		,editable:false
		//,editrules:{required:true}
	}
	
	 
	],
	   
	   pager: jQuery('#pcrudve'),
    rowNum:10,
    rowList:[10,20,30],
	height:200,
	width:400,
    sortname: 'id_movil',
    sortorder: "ASC",
   //viewrecords: true,
     caption: 'Gestión de Tipos de Vehiculo ',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl+"); 
	
	
	    editurl: 'grid_movil_tipov.php'// this is dummy existing url 
		
		 });
		 
		 jQuery("#crudve").jqGrid('navGrid','#pcrudve',{edit:true,add:true,del:true},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true});		 

	 jQuery("#crudve").jqGrid('filterToolbar'); 
		 
	
		 
		 
	
		 
		
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
		#Layer1 {
	position:absolute;
	width:487px;
	height:115px;
	z-index:2;
	left: 33px;
	top: 74px;
}
    #Layer3 {
	position:absolute;
	width:433px;
	height:115px;
	z-index:3;
	left: 787px;
	top: 73px;
}
    #Layer4 {
	position:absolute;
	width:453px;
	height:115px;
	z-index:2;
	left: 574px;
	top: 73px;
}
    </style>	
</head>

<body>

<div  id="login1">login: [ <?php echo $_SESSION['login'];  ?>]</div>

<div align="right"><span class="Estilo2"><a href="../login/index2.php" class="ui-state-hover">Volver al Men&uacute </a></span></div>
<div id="Layer1">
<span class="Estilo1">	Tipos de Vehiculos</span>
		
		<table align="center" id="crudgrup"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudgrup" align="center"></div>


</div>
</div>
<div id="Layer4">
<span class="Estilo1">  Gesti&oacute;n de Vehiculos</span>
		
		<table align="center" id="crudve"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudve" align="center"></div>

</div>
</body>
</html>
