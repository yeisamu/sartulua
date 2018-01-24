<?php
session_start();
 include('../inc/libreria.php');
 
 if(!valida_usr(8)){
 
 echo "Acceso No Autorizado";
 return ;
 }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gestion usuarios</title>
   
    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	
    <script src="../js/i18n/grid.locale-es.js" type="text/javascript"></script>
	<script src="../src/jqDnR.js" type="text/javascript"></script>
		<script src="../themes/development-bundle/ui/jquery.ui.autocomplete.js" type="text/javascript"></script>
	<script src="../src/jqModal.js" type="text/javascript"></script>
	 <script type="text/javascript">
	
  /*  $.jgrid.no_legacy_api = true;
    $.jgrid.useJSON = true;*/

	jQuery(document).ready(function(){ 
	jQuery("#crud").jqGrid({ url:'gridemp.php',
	 datatype: "json", 
	  mtype: 'POST',
	  colNames:['Id','Nombre','Nit','Direccion','Telefono','Logo','Grupo','Inicio','Fin']
	  , colModel :[
	 	  
	  {
	  name:'id_empresa'
		,index:'id_empresa'
		,width:55
		,align:'center'
		,editable:false
		},{
	  name:'nombre'
		,index:'nombre'
		,width:230
		//,align:'center'
		,editable:true
		
	},{
	name:'nit'
		,index:'nit'
		,width:100
		//,align:'right'
		,editable:true	
	},{
	name:'direccion'
		,index:'direccion'
		,width:160
		//,align:'right'
		,editable:true	
	},{
		name:'telefono'
		,index:'telefono'
		,width:140
		,align:'center'
		,editable:true
	
		},{
	name:'logo'
		,index:'logo'
		,width:70
		//,align:'right'
		,editable:true	
		},{
	name:'grupo'
		,index:'grupo'
		,width:50
		//,align:'right'
		,editable:true	
		},{
	name:'inicio_p'
		,index:'inicio_p'
		,width:50
		//,align:'right'
		,editable:true	
		},{
	name:'fin_p'
		,index:'fin_p'
		,width:50
		//,align:'right'
		,editable:true	
	 // , edittype: 'file'
/*	 ,formatter:function() {
	 var ids = jQuery("#crud").getDataIDs();
  			
			
			//record=jQuery("#crudoc").jqGrid('getRowData',ids).codigo;
		 // jQuery("#crudoc").jqGrid('getRowData',ids);	       
		for(var i=0;i<ids.length;i++){
		   //  var dato = record[i];
			var cl = ids[i];
			
			 var rowData = jQuery(this).getRowData(cl); 
                  var temp= rowData['logo'];//replace name with you 
				//  alert(temp)
                             be="<img src='logo/"+temp+".GIF'/>";
 			 jQuery("#crud").setRowData(ids[i],{logo:be})
}
}	  
*/	}
	
	 
	],
	   
	   pager: jQuery('#pcrud'),
    rowNum:10,
    rowList:[10,20,30],
	height:200,
	width:'auto',
    sortname: 'id_empresa',
    sortorder: "asc",
    viewrecords: true,
     caption: 'Gestion de Empresa',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl+"); 
	
	
	    editurl: 'gridemp.php'// this is dummy existing url 
		
		 });
		 
		 jQuery("#crud").jqGrid('navGrid','#pcrud',{edit:true,add:true,del:true},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true});

jQuery("#crud").jqGrid('setGroupHeaders', { useColSpanStyle: true, groupHeaders:[ {startColumnName: 'inicio_p', numberOfColumns: 2, titleText: '<em>Planillas</em>'}	 ] });
		 
		 
	
		 
		
		 function pickdates(id){
	  jQuery('#pcrud').datepicker({dateFormat:'yy-mm-dd'});
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

<span class="Estilo1">Gesti&oacute;n de Empresa </span>
<!--<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Usuario</a></li>
				<li><a href="#tabs-2">Conductor</a></li>
				<li><a href="#tabs-3">Asociado</a></li>
			</ul>
 -->			<table align="center" id="crud"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrud" align="center"></div>



</body>
</html>
