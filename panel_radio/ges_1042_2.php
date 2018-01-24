<?php
session_start();
 include('../inc/libreria.php');
 
 if(!valida_usr(8)){
 
 echo "Acceso No Autorizado";
 return ;
 }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
     <script  src="../inc/prototype.js"></script>
	<script  src="../inc/funciones.js"></script>

	<script  src="../themes/js/jquery-1.6.2.min.js"></script> 
	<script  src="../themes/js/jquery-ui-1.8.16.custom.min.js"></script> 
<script  src="../js/jquery-ui-timepicker-addon.js"></script>
<script  src="../themes/ejemplo/ui/jquery.ui.slider.js"></script>
<script  src="../js/timepicker_slider_access.js"></script>
    <script src="../js/i18n/grid.locale-es.js" type="text/javascript"></script>
	<script src="../src/jqDnR.js" type="text/javascript"></script>
	
	<script src="../src/jqModal.js" type="text/javascript"></script>
	
	<script src="../themes/ejemplo/ui/i18n/jquery.ui.datepicker-es.js"></script>
	    <script src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>
  <script type="text/javascript">
  /*  $.jgrid.no_legacy_api = true;
    $.jgrid.useJSON = true;*/
     jQuery.noConflict();

	jQuery(document).ready(function(){ 
	
//////grid tarjetas


	jQuery("#crud1042").jqGrid({ url:'grid1042.php',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['','Registrado','Usuario','Fecha Acc','Direccion Accidente','','Tarjeta Control','Documento','Conductor','Movil','Placa','Tipo Acc','Tipo Acc','Placa Otro','Informacion','Propietario','Ambulancia','Lesionados','Transito','Tras. Lesionado','Entidad']
	  , colModel :[
	 	  
	  {
	  name:'id_acc'
		,index:'id_acc'
		,width:55
		,align:'center'
		,editable:false
		,search:false
		,hidden:true
		},{
		 name:'fecha'
		,index:'fecha'
		,width:80
		//,align:'center'
	,editable:true
		
		,search:true
		,hidden:false
		,formatoptions:{srcformat:"Y-m-d H:i:s",newformat:"Y-m-d H:i"}
		,formatter:"date"
		,editoptions:{
		dataInit:
		function(elm){setTimeout(function(){
            jQuery(elm).datetimepicker({
			ampm:true,
	        dateFormat:'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			showWeek: true,
			});
                    jQuery('.ui-datepicker').css({'font-size':'75%'});
                },200);}
				}
		},{
	  name:'usuario'
		,index:'usuario'
		,width:40
		//,align:'center'
	,editable:false 
		,search:true
		,hidden:false
		,editrules:{edithidden:true,required:true}
	},{
		name:'fecha_inc'
		,index:'fecha_inc'
		,width:80
	//	,align:'center'
		,search:true
		,hidden:false
	    ,editable:true
		,formatoptions:{srcformat:"Y-m-d H:i:s",newformat:"Y-m-d H:i"}
		,formatter:"date"
		,editoptions:{
		dataInit:
		function(elm){setTimeout(function(){
            jQuery(elm).datetimepicker({
			ampm:true,
	        dateFormat:'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			showWeek: true,
			});
                    jQuery('.ui-datepicker').css({'font-size':'75%'});
                },200);}
				} 
		},{
		name:'dir_acc'
		,index:'dir_acc'
		,width:55
		,align:'center'
		,editable:true
		,search:false
		,hidden:true
		,editrules:{edithidden:true,required:true}
		},{
		 name:'id_tarjeta'
		,index:'id_tarjeta'
		,width:80
		//,align:'center'
		,editable:false
		,editrules:{edithidden:true,required:true}
		,search:true
		,hidden:true
		},{
		 name:'tarjeta'
		,index:'tarjeta'
		,width:80
		//,align:'center'
		,editable:true
		,editrules:{edithidden:true,required:true}
		,search:true
		,hidden:true
		},{
		name:'codigo'
		,index:'codigo'
		,width:80
		,editable:true
		//,editrules:{required:true}
		//,align:'center'
		,searchoptions:{dataInit:function(el){jQuery(el).autocomplete({
			source: "busca_condu.php",
			 select: function(event, ui) {
                  }
		});} }

	,editoptions:{
		dataInit:function(el){jQuery(el).autocomplete({
			source: "busca_condu.php",
			 select: function(event, ui) {
                  }
		});} 
				} 	
		
		
	},{
		name:'nombres'
		,index:'nombres'
		,width:180
		//,align:'right'
		,editable:true
		//,edittype:'select'
		//,editoptions:{value:"1:Si;0:No"}  Name:Value;Name:Value 
		,searchoptions:{dataInit:function(el){jQuery(el).autocomplete({
			source: "busca_condu_nc.php",
			 select: function(event, ui) {
                  }
		});} }
		
		,editoptions:{
		dataInit:function(el){jQuery(el).autocomplete({
			source: "busca_condu_nc.php",
			 select: function(event, ui) {
                  }
		});} 
				} 	
	},{
	  name:'id_movil'
		,index:'id_movil'
		,width:40
		//,align:'center'
		,editable:true
		,search:true
		//,hidden:true
		},{
		 name:'placa'
		,index:'placa'
		,width:55
		,align:'center'
		,editable:false
		,search:true
		,hidden:true
		,editrules:{edithidden:true,required:true}
		},{
	   name:'id_tipo_a'
		,index:'id_tipo_a'
		,width:55
		///,align:'center'
		,editable:true	
		,hidden:true
		,editrules:{edithidden:true,required:true}
		,search:true
		,edittype:'select'
		,editoptions:{ dataUrl: '../inc/lista.php?tb=tipo_accidente&cid=id_tipo_a&cd=tipo_accidente' }
		},{
		 name:'tipo_accidente'
		,index:'tipo_accidente'
		,width:80
		,align:'center'
		,editable:false
		,search:true
		,hidden:false
		
		},{
	  name:'placa_otro'
		,index:'placa_otro'
		,width:50
		//,align:'center'
		,editable:true
		//,search:true
		,hidden:true
		,editrules:{edithidden:true,required:true}
	
		},{
	  name:'info_otro'
		,index:'info_otro'
		,width:50
		//,align:'center'
		,editable:true
		//,search:true
		,hidden:true
		,editrules:{edithidden:true,required:true}
	},{
		name:'conduce_prop'
		,index:'conduce_prop'
		,width:60
		,align:'center'
		,editable:true
		//,search:true
		,editrules:{edithidden:true,required:true}
		,edittype:'select', editoptions:{value:"1:SI;0:No"}
		,hidden:true
		,formatter:sino
	},{
	 name:'ambulancia'
		,index:'ambulancia'
		,width:55
		,align:'center'
		,editable:true
		,editrules:{edithidden:true,required:true}
		//,search:true
		,hidden:true
		,edittype:'select', editoptions:{value:"1:SI;0:No"}
		,formatter:sino
		},{
	   name:'lesionado'
		,index:'lesionado'
		,width:55
		,align:'center'
	    ,editable:true	
		,hidden:true
		,formatter:sino
		,edittype:'select', editoptions:{value:"1:SI;0:No"}
		,editrules:{edithidden:true,required:true}
		},{
		 name:'transito'
		,index:'transito'
		,width:55
		,align:'center'
		,editable:true
		//,search:true
		,hidden:true
		,editrules:{edithidden:true,required:true}
		,edittype:'select', editoptions:{value:"1:SI;0:No"}
		,formatter:sino
		},{
	  name:'tras_lesionado'
		,index:'tras_lesionado'
		,width:50
		//,align:'center'
		,editable:true
		//,search:true
		,hidden:true
		,formatter:sino
		,edittype:'select', editoptions:{value:"1:SI;0:No"}
		,editrules:{edithidden:true,required:true}
	
		},{
	  name:'entidad_lesionado'
		,index:'entidad_lesionado'
		,width:50
		//,align:'center'
		,editable:true
		//,search:true
		,hidden:true

		,edittype:'select', editoptions:{value:"1:SI;0:No"}
		,editrules:{edithidden:true,required:true}
		,formatter:sino
	}
	 
	],
	   
	   pager: jQuery('#pcrud1042'),
    rowNum:5,
   rowList:[10,20,30],
	height:'auto',
	width:'auto',
    sortname: 'id_acc',
    sortorder: "desc",
   viewrecords: true,
     caption: 'Gestion de Moviles Reportados  en 10-42',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		editurl: 'grid1042.php'// this is dummy existing url 
		
		 });
		 
		 jQuery("#crud1042").jqGrid('navGrid','#pcrud1042',{search:false,edit:true,add:true,del:true,view:true},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true});


		 
		 
jQuery("#crud1042").jqGrid('filterToolbar');	

function sino (cellvalue, options, rowObject)
{
   if(cellvalue==1)
   return "Si";
   
   return "No";
}


});					
					

	//	 });
    </script>
	<style type="text/css">
	#confirmar_cierre{
display: none;
}
	</style>
	 <link rel="stylesheet" type="text/css" href="../themes/css/custom-theme/jquery-ui-1.8.16.custom.css">
	<link rel="stylesheet" type="text/css" href="../css/ui.jqgrid.css">
   <link rel="stylesheet" type="text/css" href="../plugins/ui.multiselect.css">
</head>

<body>
<table align="center" id="crud1042"  >
<tr><td>&nbsp;</td></tr></table>
<div id="pcrud1042" align="center"></div>


</body>
</html>
