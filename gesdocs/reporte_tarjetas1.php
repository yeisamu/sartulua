<?php
session_start();
 include('../inc/libreria.php');
 include('../inc/operaciones.php');
 
 if(!valida_usr(11)){
 
 echo "Acceso No Autorizado";
 return ;
 }
 


    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gestion de tarjetas de control</title>
    <script  src="../inc/prototype.js"></script>
	<script  src="../inc/funciones.js"></script>
    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	
    <script src="../js/i18n/grid.locale-es.js" type="text/javascript"></script>
	<script src="../src/jqDnR.js" type="text/javascript"></script>
	
	<script src="../src/jqModal.js" type="text/javascript"></script>
		<!--<script src="../themes/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../themes/development-bundle/ui/jquery.ui.widget.js"></script>--> 
	<script src="../themes/ejemplo/ui/jquery.ui.datepicker.js"></script> 
	<script src="../themes/ejemplo/ui/jquery.ui.dialog.js"></script> 
	<script src="../themes/ejemplo/ui/i18n/jquery.ui.datepicker-es.js"></script>
	
	    <script type="text/javascript">
  /*  $.jgrid.no_legacy_api = true;
    $.jgrid.useJSON = true;*/
     jQuery.noConflict();

	jQuery(document).ready(function(){ 
	
	/////tarjetas de control con novedad
	jQuery("#crudnov").jqGrid({ 

     url:'gridtarjetasnov.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['Codigo','Tarjeta','Conductor','','','','','Movil','','Fecha Corte','Servicio','','','Acciones']
	  , colModel :[
	{name:'id_tarjeta'
		,index:'id_tarjeta'
		,width:55
		//,align:'right'
		,editable:false	
	},{
	name:'tarjeta'
		,index:'tarjeta'
		,width:50
		//,align:'right'
		,editable:false	
	},{
	
		name:'codigo'
		,index:'codigo'
		,width:80
		,editable:true
		/*,editrules:{required:true}
		,formatoptions:{srcformat:"Y-m-d H:i:s",newformat:"Y-m-d"}
    	,formatter:"date"
		,editoptions:{
		dataInit:
		function(elm){setTimeout(function(){
                  jQuery(elm).datepicker({dateFormat:'yy-mm-dd',changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,});
                    jQuery('.ui-datepicker').css({'font-size':'75%'});
                },200);}
				}
		*/
	},{
		name:'nombre1'
		,index:'nombre1'
		,width:60
		//,align:'right'
		,editable:true
		//,edittype:'select'
		//,editoptions:{value:"1:Si;0:No"}  Name:Value;Name:Value 
	},{
	name:'nombre2'
		,index:'nombre2'
		,width:60
		//,align:'right'
		,editable:true
		//,edittype:'select'
		//,editoptions:{value:"1:Si;0:No"}  Name:Value;Name:Value 
	},{
		name:'apellido1'
		,index:'apellido1'
		,width:60
		//,align:'right'
		,editable:true
	},{
	name:'apellido2'
		,index:'apellido2'
		,width:60
		//,align:'right'
		,editable:true
	},{
		name:'id_movil'
		,index:'id_movil'
		,align:'center'
		, width:40
/*	},{
	  name:'fecha_vigencia'
		,index:'fecha_vigencia'
		,width:70
		//,align:'center'
		//,hidden:true
	},{
	  name:'fecha_elab'
		,index:'fecha_elab'
		,width:70
		//,align:'center'
		//,hidden:true	
	},{
	  name:'estado'
		,index:'estado'
		,width:50
		,align:'center'*/
		//,hidden:true
		
	},{ name:'id_conductor'
		,index:'id_conductor'
		,width:40
		,align:'center'
		,hidden:true
		},{ name:'fecha_plazo_a'
		,index:'fecha_plazo_a'
		,width:135
		,formatter:'date', formatoptions:{srcformat:"Y-m-d H:i",newformat:"d-M-Y h:i a"}
		
	},{
	  name:'servicio'
		,index:'servicio'
		,width:70
		,align:'center'	
		},{
	  name:'est_ant'
		,index:'est_ant'
		,width:10
		,align:'center'	
		,hidden:true	
		},{
	  name:'est_new'
		,index:'est_new'
		,width:10
		,align:'center'	
		,hidden:true	
	},{name:'act',index:'act',align:'center', width:120,sortable:false,search:false}
	],
	   
	  // pager: jQuery('#pcrudoc'),
	  pager: jQuery('#pcrudnov'),
    rowNum:50,
    //rowList:[10,20,30],
	rownumbers: true,
	height:'auto',
	width:'auto',
    sortname: 'concat(est_ant,est_new),fecha_plazo_a',
    sortorder: "desc",
    viewrecords: true,
     caption: 'Planillas de Control',

	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		
	},
	
		 
		 
		 
	loadComplete:function(){
	    
		setTimeout(function(){jQuery('#crudnov').jqGrid('setCaption','Planillas de Control') .trigger('reloadGrid')},30000)
		var ids = jQuery("#crudnov").getDataIDs();
		for(var i=0;i<ids.length;i++){
			var cl = ids[i];
			 var rowData = jQuery(this).getRowData(cl);
			  var id_tarjeta= rowData['id_tarjeta'];
			  var est_ant= rowData['est_ant'];
			  var est_now= rowData['est_new'];
			  var id_mov= rowData['id_movil'];
			 
			 
			 if(est_ant != est_now){ 
			  if (est_ant==0 && est_now==1){
			  jQuery("#crudnov").setRowData(rowData.id_tarjeta,{servicio:"<font color='green'>Permitido</font>"}) 
			 }else{
			   jQuery("#crudnov").setRowData(rowData.id_tarjeta,{servicio:"<font color='red'>Suspendido</font>"}) 
			 }
			 }
			 //replace name with you 
	nta = "<input style='height:22px;width:60px;' type='button' value='Ver Tarj' onclick=jQuery('#vertc').dialog('open');ver_tarjeta("+i+"); />";
	btn = "<input style='height:22px;width:60px;' type='button' value='Revisado' onclick=actu_estadon("+id_tarjeta+","+est_now+","+i+"); />";
	ntarj= "<input  id='id_tarj"+i+"' type='hidden' value="+id_tarjeta+" />"; 
	id_movi= "<input  id='id_movil"+i+"' type='hidden' value="+id_mov+" />"; 
	//onclick=jQuery('#ntarjetao').dialog('open');
	//jQuery('#list10_d').jqGrid('setGridParam',{url:'subgrid.php?q=1&id=2',page:1}); jQuery('#list10_d').jqGrid('setCaption','Invoice Detail: 2') .trigger('reloadGrid')+"/>"; 
			
			
			//jQuery('#crud').editRow("+cl+"); />"; 
			//se = "<a href='#' id='trigger'>TRIGGER</a>"; 
			//ce = "<input style='height:22px;width:20px;' type='button' value='C' onclick=jQuery('#crud').restoreRow("+cl+"); />"; 
			jQuery("#crudnov").setRowData(ids[i],{act:ntarj+btn+id_movi})
			
		}	
	},
	    editurl: 'gridtarjetasnov.php?q=1'// this is dummy existing url 
		
		 });
		  jQuery("#crudnov").jqGrid('navGrid','#pcrudnov',{edit:false,add:false,del:false,searchtext:'Busqueda'},{height:400,reloadAfterSubmit:true,closeAfterEdit : true},{closeOnEscape:true},{closeOnEscape:true},{sopt:['cn','bw','eq','ne','lt','gt','ew','le','ge']});
		  
		   jQuery("#crudnov").jqGrid('setGroupHeaders', { useColSpanStyle: true, groupHeaders:[ {startColumnName: 'nombre1', numberOfColumns: 2, titleText: '<em>Nombres</em>'}, {startColumnName: 'apellido1', numberOfColumns: 2, titleText: 'Apellidos'}, {startColumnName: 'tarj', numberOfColumns: 2, titleText: 'Tarjeta Ctrl'}	 ] });
	
	
	
	
	
	
	
	
	
	
//// detalle de tarjetas de control

jQuery("#crudtc").jqGrid({ 

     url:'gridtarjetas.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['Codigo','Tarjeta','Conductor','','','','','Movil','Vigencia','','Fecha Corte','Servicio','','','Grup','','Total P','Acciones']
	  , colModel :[
	{name:'id_tarjeta'
		,index:'id_tarjeta'
		,width:55
		//,align:'right'
		,editable:false	
		,search:false
	},{
	name:'tarjeta'
		,index:'tarjeta'
		,width:50
		//,align:'right'
		,editable:false	
	},{
	
		name:'codigo'
		,index:'codigo'
		,width:80
		,editable:true
		,searchoptions:{dataInit:function(el){jQuery(el).autocomplete({
			source: "busca_condu.php",
			 select: function(event, ui) {
                  }
		});} }
		/*,editrules:{required:true}
		,formatoptions:{srcformat:"Y-m-d H:i:s",newformat:"Y-m-d"}
    	,formatter:"date"
		,editoptions:{
		dataInit:
		function(elm){setTimeout(function(){
                  jQuery(elm).datepicker({dateFormat:'yy-mm-dd',changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,});
                    jQuery('.ui-datepicker').css({'font-size':'75%'});
                },200);}
				}
		*/
	},{
		name:'nombre1'
		,index:'nombre1'
		,width:60
		//,align:'right'
		,editable:true
		,searchoptions:{dataInit:function(el){jQuery(el).autocomplete({
			source: "busca_condu_n1.php",
			 select: function(event, ui) {
                  }
		});} }
		//,edittype:'select'
		//,editoptions:{value:"1:Si;0:No"}  Name:Value;Name:Value 
	},{
	name:'nombre2'
		,index:'nombre2'
		,width:60
		//,align:'right'
		,editable:true
		//,edittype:'select'
		//,editoptions:{value:"1:Si;0:No"}  Name:Value;Name:Value 
	},{
		name:'apellido1'
		,index:'apellido1'
		,width:60
		//,align:'right'
		,editable:true
		,searchoptions:{dataInit:function(el){jQuery(el).autocomplete({
			source: "busca_condu_ap1.php",
			 select: function(event, ui) {
                  }
		});} }
	},{
	name:'apellido2'
		,index:'apellido2'
		,width:60
		//,align:'right'
		,editable:true
		,searchoptions:{dataInit:function(el){jQuery(el).autocomplete({
			source: "busca_condu_ap2.php",
			 select: function(event, ui) {
                  }
		});} }
	},{
		name:'id_movil'
		,index:'id_movil'
		,align:'center'
		, width:40
	},{
	  name:'fecha_vigencia'
		,index:'fecha_vigencia'
		,width:70
		//,align:'center'
		//,hidden:true
/*	},{
	  name:'fecha_elab'
		,index:'fecha_elab'
		,width:70
		//,align:'center'
		//,hidden:true	
	},{
	  name:'estado'
		,index:'estado'
		,width:50
		,align:'center'*/
		//,hidden:true
		
	},{ name:'id_conductor'
		,index:'id_conductor'
		,width:40
		,align:'center'
		,hidden:true
		},{ name:'fecha_plazo_a'
		,index:'fecha_plazo_a'
		,width:140
		,formatter:'date', formatoptions:{srcformat:"Y-m-d H:i",newformat:"d-M-Y h:i a"}
		
	},{
	  name:'servicio'
		,index:'servicio'
		,width:70
		,align:'center'	
		,search:false
		},{
	  name:'est_ant'
		,index:'est_ant'
		,width:10
		,align:'center'	
		,hidden:true
		},{
	  name:'est_new'
		,index:'est_new'
		,width:10
		,align:'center'	
		,hidden:true
		},{
	  name:'grupo'
		,index:'grupo'
		,width:35
		,search:true
		//,align:'center'	
		//,hidden:true
		},{name:'planillas_mes',index:'planillas_mes',align:'center',hidden:true
		},{name:'total',index:'total',align:'center',hidden:false,width:50,search:false
	},{name:'act',index:'act',align:'center', width:120,sortable:false,search:false}
	],
	   
	  // pager: jQuery('#pcrudoc'),
	  pager: jQuery('#pcrudtc'),
    rowNum:500,
    //rowList:[10,20,30],
	//scroll: true, 
	height:'auto',
	width:'auto',
    sortname: 'estado,fecha_plazo_a',
    sortorder: "asc",
    viewrecords: true,
     caption: 'Planillas de Control',
/*   jsonReader: {
		repeatitems : true,
		cell:"",
		id: "0"
	},*/
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		
	},
	
		 
		 
		 
	loadComplete:function(){
	    
		//setTimeout(function(){jQuery('#crudtc').jqGrid('setCaption','Detalle de tarjetas de control') .trigger('reloadGrid')},15000)
		var ids = jQuery("#crudtc").getDataIDs();
		for(var i=0;i<ids.length;i++){
			var cl = ids[i];
			 var rowDatas = jQuery(this).getRowData(cl);
			  var id_tarje= rowDatas['id_tarjeta'];
			  var est_ant= rowDatas['est_ant'];
			  var est_now= rowDatas['est_new'];
			  var id_mov= rowDatas['id_movil'];
			  var grup= rowDatas['grupo'];
			   var fecha_vig= rowDatas['fecha_vigencia'];
			    var estact= rowDatas['servicio'];
				var nplanilla= rowDatas['planillas_mes'];
				 var tot= rowDatas['total'];
				   if (tot>=nplanilla){
				   	var control_p=1;		   
				   }else {
				    var control_p=0;	
				   }
			  var  fhoy = new Date();
			  anyo = fhoy.getFullYear(); 
			  aniof = fecha_vig.substring(0,4);	
			  if(aniof<anyo){
			    if(estact=='Permitido'){
				
			   jQuery("#crudtc").setRowData(rowDatas.id_tarjeta,{servicio:"<font color='blue'>Permitido</font>"}) 
			   }else{
			   var estado="disabled=disabled";
			   jQuery("#crudtc").setRowData(rowDatas.id_tarjeta,{servicio:"<font color='orange'>suspendido</font>"}) 
			   }
			//  }else{
//			   jQuery("#crudtc").setRowData(rowDatas.id_tarjeta,{servicio:"<font color='green'>Permitido</font>"}) 
			  }
			 
			 if(est_ant != est_now){ 
			  if (est_ant==0 && est_now==1){
			  var estado="disabled=false";
			  jQuery("#crudtc").setRowData(rowDatas.id_tarjeta,{servicio:"<font color='green'>Permitido</font>"}) 
			 }else{
			 var estado="disabled=disabled";
			   jQuery("#crudtc").setRowData(rowDatas.id_tarjeta,{servicio:"<font color='red'>Suspendido</font>"}) 
			 }
			
			 }
			  //if(est_ant==1 and est_now==1){
		   //jQuery("#crudtc").setRowData(rowDatas.id_tarjeta,{servicio:"<font color='blue'>Permitido</font>"}) 
			 // }
			 if (estact=='Permitido'){var estado="";
				  }else{
				estado="disabled=disabled";
				  }
				  
				   if (est_ant==1 && est_now==1){
			  jQuery("#crudtc").setRowData(rowDatas.id_tarjeta,{servicio:"<font color='blue'>Permitido</font>"}) 
			 }
			 //replace name with you 
	nta = "<input style='height:22px;width:60px;' type='button' value='Ver Tarj' onclick=jQuery('#vertc').dialog('open');ver_tarjeta("+id_tarje+"); />";
	
	ntarj= "<input  id='id_tarj"+i+"' type='hidden' value="+id_tarje+" />"; 
	id_movi= "<input  id='id_movil"+i+"' type='hidden' value="+id_mov+" />"; 
	plani = "<input  type='button' value='Planilla' "+estado+" onclick=abre_planilla("+i+","+control_p+");jQuery('#planillas').slideToggle();jQuery('#planillas').dialog('open') />";
	co = "<input  id='idtarj"+i+"' type='hidden' value="+id_tarje+" />"; 
	g = "<input  id='id_grupo"+i+"' type='hidden' value="+grup+" />"; 
	//onclick=jQuery('#ntarjetao').dialog('open');
	//jQuery('#list10_d').jqGrid('setGridParam',{url:'subgrid.php?q=1&id=2',page:1}); jQuery('#list10_d').jqGrid('setCaption','Invoice Detail: 2') .trigger('reloadGrid')+"/>"; 
			
			
			//jQuery('#crud').editRow("+cl+"); />"; 
			//se = "<a href='#' id='trigger'>TRIGGER</a>"; 
			//ce = "<input style='height:22px;width:20px;' type='button' value='C' onclick=jQuery('#crud').restoreRow("+cl+"); />"; 
			jQuery("#crudtc").setRowData(ids[i],{act:nta+ntarj+id_movi+plani+co+g})
			
		}	
	},
	    editurl: 'gridtarjetas.php?q=1'// this is dummy existing url 
		
		 });
		  jQuery("#crudtc").jqGrid('navGrid','#pcrudtc',{edit:false,add:false,del:false,searchtext:'Busqueda', excel:true},{height:400,reloadAfterSubmit:true,closeAfterEdit : true},{closeOnEscape:true},{closeOnEscape:true},{sopt:['cn','bw','eq','ne','lt','gt','ew','le','ge']}).navButtonAdd('#pcrudtc',{
                                caption:"Exportar", 
                                buttonicon:"ui-icon-calculator", 
                                onClickButton: function(){ 
                                  exportExcel();
                                }, 
                                position:"last"
                            });
							
							
function exportExcel()
        {
            var mya=new Array();
            mya=jQuery("#crudtc").getDataIDs();  // Get All IDs
            var data=jQuery("#crudtc").getRowData(mya[0]);     // Get First row to get the labels
            var colNames=new Array(); 
            var ii=0;
            for (var i in data){colNames[ii++]=i;}    // capture col names
            var html="";
            for(i=0;i<mya.length;i++)
                {
                data=jQuery("#crudtc").getRowData(mya[i]); // get each row
                for(j=0;j<colNames.length;j++)
                    {
                    html=html+data[colNames[j]]+"\t"; // output each column as tab delimited
                    }
                html=html+"\n";  // output each row with end of line

                }
            html=html+"\n";  // end of line at the end
            document.forms[0].csvBuffer.value=html;
            document.forms[0].method='POST';
            document.forms[0].action='csvExport.php';  // send it to server which will open this contents in excel file
            document.forms[0].target='_blank';
            document.forms[0].submit();
        }							
	  
		   jQuery("#crudtc").jqGrid('setGroupHeaders', { useColSpanStyle: true, groupHeaders:[ {startColumnName: 'nombre1', numberOfColumns: 2, titleText: '<em>Nombres</em>'}, {startColumnName: 'apellido1', numberOfColumns: 2, titleText: 'Apellidos'}, {startColumnName: 'tarj', numberOfColumns: 2, titleText: 'Tarjeta Ctrl'}	 ] });
//	 
  jQuery("#crudtc").jqGrid('filterToolbar');
/////////////////////funcion para el calendario		 
		 
	jQuery( "#date1" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,
		});	
		
////alertas modales 											
jQuery('#vertc').dialog({autoOpen: false, modal:true,width:650,height:900,}); 
jQuery('#planillas').dialog({autoOpen: false, modal:true,width:700,height:800,}); 
//jQuery('#cerrar').dialog({autoOpen: false, modal:true,width:400,height:200,}); 
//jQuery('#actualizatc').dialog({autoOpen: false, modal:true,width:600,height:800,});
//jQuery('#veractualizatc').dialog({autoOpen: false, modal:true,width:800,height:800,});
//jQuery('#ntarjetao').dialog({autoOpen: false, modal:true,width:600,height:800,}); 

 });
    </script>

    <script src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>
	
    <script src="../themes/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	 <link rel="stylesheet" type="text/css" href="../themes/css/custom-theme/jquery-ui-1.8.16.custom.css">
	<link rel="stylesheet" type="text/css" href="../css/ui.jqgrid.css">
	
   <!-- <link rel="stylesheet" type="text/css" media="screen" href="../themes/ui.multiselect.css" /> -->
   	<!--<link rel="stylesheet" type="text/css" href="../themes/development-bundle/themes/custom-theme/jquery.ui.all.css"> -->
    <!--<link rel="stylesheet" type="text/css" media="screen" href="../themes/ui.multiselect.css" /> -->
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
.Estilo4 {
	font-size: 24%;
	font-weight: bold;
}
    </style>	
</head>

<body>
<div  id="login1">login: [ <?php echo $_SESSION['login'];  ?>]</div>
<div id="Layer1"></div>
<div align="right"><span class="Estilo2"><a href="../login/index2.php" class="ui-state-hover">Volver al Men&uacute </a></span></div>

<span class="Estilo1">Servicio de Radio</span>
<table align="center" id="crudnov"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudnov" align="center"> </div>
  <p>&nbsp;</p>
  <span class="Estilo1">Tarjetas de Control </span>
<table align="center" id="crudtc"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudtc" align="center"></div>
<div id="vertc"  "title="Tarjeta de Control"></div>
<div id="planillas" title="Planillas de Viaje"></div>
<div id="grabaplanilla" ></div>
<form method="post" action="csvExport.php">
    <input type="hidden" name="csvBuffer" id="csvBuffer" value="" />
</form>

</body>
</html>
