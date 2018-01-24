<?php
session_start();
 include('../inc/libreria.php');
 
 if(!valida_usr(6)){
 
 echo "Acceso No Autorizado";
 return ;
 }
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gestion de opciones</title>
   
    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	
    <script src="../js/i18n/grid.locale-es.js" type="text/javascript"></script>
	<script src="../src/jqDnR.js" type="text/javascript"></script>
		<script src="../themes/development-bundle/ui/jquery.ui.autocomplete.js" type="text/javascript"></script>
	<script src="../src/jqModal.js" type="text/javascript"></script>
	 <script type="text/javascript">
	
  /*  $.jgrid.no_legacy_api = true;
    $.jgrid.useJSON = true;*/

	jQuery(document).ready(function(){ 
	jQuery("#crudopc").jqGrid({ url:'gridopcion.php',
	 datatype: "json", 
	  mtype: 'POST',
	  colNames:['Id','Opcion','Descripcion','Grupo','Grupo','Ruta','Visible','Visible']
	  , colModel :[
	 	  
	  {
	  name:'id_opcion'
		,index:'id_opcion'
		,width:40
		,align:'center'
		,editable:false
		},{
	  name:'opcion'
		,index:'opcion'
		,width:200
		//,align:'center'
		,editable:true
		
	},{
	name:'descripcion'
		,index:'descripcion'
		,width:200
		//,align:'right'
		,editable:true
	
		
	},{
	name:'id_grupo'
		,index:'id_grupo'
		,width:60
		//,align:'right'
		,editable:true
		,edittype:'select'
		,editoptions:{ dataUrl: '../inc/lista.php?tb=acc_grupo&cid=id_grupo&cd=grupo' }
		,hidden:true
		,editrules:{edithidden:true,required:true}	
	},{
	name:'grupo'
		,index:'grupo'
		,width:60
		//,align:'right'
		,editable:false
		//,edittype:'select'
		//,editoptions:{ dataUrl: '../inc/lista.php?tb=acc_grupo&cid=id_grupo&cd=grupo' }
		//,hidden:false
		//,editrules:{edithidden:false,required:true}	
	},{
		name:'path'
		,index:'path'
		,width:100
		//,align:'center'
		,editable:true
	},{
	name:'visible'
		,index:'visible'
		,width:55
		,align:'center'
		,editable:true	
		,hidden:true
		
		,editrules:{edithidden:true,required:true}
		,edittype:"select"
		,editoptions:{value:"0:NO;1:SI"}
		},{
	name:'visible2'
		,index:'visible2'
		,width:55
		,align:'center'
		,editable:false	
		//,hidden:false
		
		//,editrules:{edithidden:false,required:true}
		
	 // , edittype: 'file'
/*	 ,formatter:function() {
//	 var ids = jQuery("#crud").getDataIDs();
//  			
//			
//			//record=jQuery("#crudoc").jqGrid('getRowData',ids).codigo;
//		 // jQuery("#crudoc").jqGrid('getRowData',ids);	       
//		for(var i=0;i<ids.length;i++){
//		   //  var dato = record[i];
//			var cl = ids[i];
//			
//			 var rowData = jQuery(this).getRowData(cl); 
//                  var temp= rowData['logo'];//replace name with you 
//				//  alert(temp)
//                             be="<img src='logo/"+temp+".GIF'/>";
// 			 jQuery("#crud").setRowData(ids[i],{logo:be})
//}
//}	*/  
	}
	
	 
	],
	   
	   pager: jQuery('#pcrudopc'),
    rowNum:10,
    rowList:[10,20,30],
	height:200,
	width:'auto',
    sortname: 'id_opcion',
    sortorder: "asc",
   viewrecords: true,
     caption: 'Gestión de Opciones',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl+"); 
	
	
	    editurl: 'gridopcion.php'// this is dummy existing url 
		
		 });
		 
		 jQuery("#crudopc").jqGrid('navGrid','#pcrudopc',{edit:true,add:true,del:true},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true});


		 
		 
	
		 
		
		 function pickdates(id){
	  jQuery('#pcrudopc').datepicker({dateFormat:'yy-mm-dd'});
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
.Estilo2 {
	color: #333333;
	font-size: 18px;
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
<div align="right"><span class="Estilo2"><a href="../login/index2.php" class="ui-state-hover">Volver al Men&uacute </a></span></div>
<span class="Estilo1">Gesti&oacute;n de Opci&oacute;n</span>
<!--<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Usuario</a></li>
				<li><a href="#tabs-2">Conductor</a></li>
				<li><a href="#tabs-3">Asociado</a></li>
			</ul>
 -->			<table align="center" id="crudopc"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudopc" align="center"></div>



</body>
</html>
