<?php
session_start();
 include('../inc/libreria.php');
 
 if(!valida_usr(27)){
 
 echo "Acceso No Autorizado";
 return ;
 }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gestion valores de las polizas</title>
   
    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	
    <script src="../js/i18n/grid.locale-es.js" type="text/javascript"></script>
	<script src="../src/jqDnR.js" type="text/javascript"></script>
		<script src="../themes/development-bundle/ui/jquery.ui.autocomplete.js" type="text/javascript"></script>
	<script src="../src/jqModal.js" type="text/javascript"></script>
	 <script src="../themes/ejemplo/ui/i18n/jquery.ui.datepicker-es.js"></script>
	 <script type="text/javascript">
	
  /*  $.jgrid.no_legacy_api = true;
    $.jgrid.useJSON = true;*/

	jQuery(document).ready(function(){ 
	jQuery("#crud").jqGrid({ url:'gridvalor.php',
	 datatype: "json", 
	  mtype: 'POST',
	  colNames:['Id','Tipo Vehiculo','Tipo Vehiculo','Valor Poliza','Inicial','Valor Cuota 1 ','Valor Cuota 2 ','Fecha Inicio','Fecha Fin','Grupo']
	  , colModel :[
	 	  
	  {
	  name:'id_valorp'
		,index:'id_valorp'
		,width:55
		,align:'center'
		,editable:false
		,hidden:true
		
	},{
	  name:'id_tipov'
		,index:'id_tipov'
		,width:230
		//,align:'center'
		,editable:true
		,hidden:true
		,editrules:{edithidden:true,required:true}
		,edittype:'select'
		,editoptions:{ dataUrl: '../inc/lista.php?tb=tipov&cid=id_tipov&cd=tipov' }
		},{
	  name:'tipov'
		,index:'tipov'
		,width:230
		//,align:'center'
		,editable:false
		
	},{
	name:'valorp'
		,index:'valorp'
		,width:80
		,align:'right'
		,editable:true	
		,formatter:'currency'
		,formatoptions:{decimalSeparator:".",thousandsSeparator:",",decimalPlaces:0,prefix:"$"}
	},{
	name:'vini'
		,index:'vini'
		,width:80
		,align:'right'
		,editable:true	
		,formatter:'currency'
        ,editrules:{required:true,number:true}
		,formatoptions:{decimalSeparator:".",thousandsSeparator:",",decimalPlaces:0,prefix:"$"}
	},{
		name:'vc1'
		,index:'vc1'
		,width:80
		,align:'right'
		,editable:true
	   ,formatter:'currency'
	   ,editrules:{required:true,number:true}
	   ,formatoptions:{decimalSeparator:".",thousandsSeparator:",",decimalPlaces:0,prefix:"$"}
		},{
	name:'vc2'
		,index:'vc2'
		,width:80
		,align:'right'
		,editable:true	
		,formatter:'currency'
		,editrules:{required:true,number:true}
		,formatoptions:{decimalSeparator:".",thousandsSeparator:",",decimalPlaces:0,prefix:"$"}
		},{
	name:'fini'
		,index:'fini'
		,width:100
		//,align:'right'
		,editable:true	
		,formatoptions:{srcformat:"Y-m-d H:i:s",newformat:"Y-m-d"}
    	,formatter:"date"
		,editoptions:{
		dataInit:
		function(elm){setTimeout(function(){
                  jQuery(elm).datepicker({dateFormat:'yy-mm-dd',changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,});
                    jQuery('.ui-datepicker').css({'font-size':'100%'});
                },200);}
				}
		
		},{
	name:'ffin'
		,index:'ffin'
		,width:100
		//,align:'right'
		,editable:true	
		,formatoptions:{srcformat:"Y-m-d H:i:s",newformat:"Y-m-d"}
    	,formatter:"date"
		,editoptions:{
		dataInit:
		function(elm){setTimeout(function(){
                  jQuery(elm).datepicker({dateFormat:'yy-mm-dd',changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,});
                    jQuery('.ui-datepicker').css({'font-size':'100%'});
                },200);}
				}	
		},{
	name:'grupo'
		,index:'grupo'
		,width:50
		,align:'right'
		,editable:true	
	,edittype:'select'
	  ,editoptions:{ dataUrl: '../inc/lista.php?tb=empresa&cid=grupo&cd=grupo' }
		
		}
	
	 
	],
	   
	   pager: jQuery('#pcrud'),
    rowNum:20,
    rowList:[10,20,30],
	height:'auto',
	width:'auto',
    sortname: 'fini',
    sortorder: "desc",
    viewrecords: true,
     caption: 'Gestion de Volores de Poliza',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl+"); 
	
	
	    editurl: 'gridvalor.php'// this is dummy existing url 
		
		 });
		 
		 jQuery("#crud").jqGrid('navGrid','#pcrud',{edit:true,add:true,del:true},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeAfterAdd : false,closeOnEscape:true},{closeOnEscape:true});

jQuery("#crud").jqGrid('setGroupHeaders', { useColSpanStyle: true, groupHeaders:[ {startColumnName: 'inicio_p', numberOfColumns: 2, titleText: '<em>Planillas</em>'}	 ] });
		 



///////grid para compa�ia poliza
	jQuery("#crudcomp").jqGrid({ url:'gridcomp.php',
	 datatype: "json", 
	  mtype: 'POST',
	  colNames:['Id','Compa�ia','NIT','Nro Poliza','Gasto Papeleria','Grupo']
	  , colModel :[
	 	  
	  {
	  name:'id_compoliza'
		,index:'id_compoliza'
		,width:55
		,align:'center'
		,editable:false
		,hidden:true
		
	
		},{
	  name:'nomcompa'
		,index:'nomcompa'
		,width:230
		//,align:'center'
		,editable:true
		
	},{
	name:'nitcompa'
		,index:'nitcompa'
		,width:80
		//,align:'right'
		,editable:true	
	//	,formatter:'currency'
		//,formatoptions:{decimalSeparator:".",thousandsSeparator:",",decimalPlaces:0,prefix:"$"}
	},{
	name:'npoliza'
		,index:'npoliza'
		,width:80
		//,align:'right'
		,editable:true	
	//	,formatter:'currency'
      //  ,editrules:{required:true,number:true}
	//	,formatoptions:{decimalSeparator:".",thousandsSeparator:",",decimalPlaces:0,prefix:"$"}
	},{
		name:'v_exclusion'
		,index:'v_exclusion'
		,width:80
		,align:'right'
		,editable:true
	   ,formatter:'currency'
	   ,editrules:{required:true,number:true}
	   ,formatoptions:{decimalSeparator:".",thousandsSeparator:",",decimalPlaces:0,prefix:"$"}
},{
	name:'grupo'
		,index:'grupo'
		,width:50
		,align:'right'
		,editable:true	
	,edittype:'select'
	  ,editoptions:{ dataUrl: '../inc/lista.php?tb=empresa&cid=grupo&cd=grupo' }	
}
	
	 
	],
	   
	   pager: jQuery('#pcrudcomp'),
    rowNum:20,
    rowList:[10,20,30],
	height:'auto',
	width:'auto',
    sortname: 'id_compoliza',
    sortorder: "asc",
    viewrecords: true,
     caption: 'Gestion de Compa�ia de Poliza',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl+"); 
	
	
	    editurl: 'gridcomp.php'// this is dummy existing url 
		
		 });
		 
		 jQuery("#crudcomp").jqGrid('navGrid','#pcrudcomp',{edit:true,add:true,del:true},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeAfterAdd : false,closeOnEscape:true},{closeOnEscape:true});


		 
	
		 
		
		 function pickdates(id){
	  jQuery('#pcrud').datepicker({dateFormat:'yy-mm-dd'});
}
	/*	 jQuery( "#tabs" ).tabs({
						//event: "mouseover"


					});*/

jQuery("#compa a").click(function(event) {
event.preventDefault();
//jQuery("#box").slideUp();
});
					
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
#compa{

display: none;
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

<span class="Estilo1">Valores de Polizas de Seguro Contractual </span>
<!--<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Usuario</a></li>
				<li><a href="#tabs-2">Conductor</a></li>
				<li><a href="#tabs-3">Asociado</a></li>
			</ul>
 -->			<table align="center" id="crud"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrud" align="center"></div>
<p>&nbsp;</p>
<a href="#" class="ui-state-hover Estilo1" onClick="jQuery('#compa').slideToggle();" >Compa�ia de poliza</a>
<p>&nbsp;</p>
<div id="compa">
<table align="center" id="crudcomp">
	<tr><td>&nbsp;</td></tr>
</table>
<div id="pcrudcomp" align="center"></div>

</div>



</body>
</html>
