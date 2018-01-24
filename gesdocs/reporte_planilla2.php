<?php
session_start();
 include('../inc/libreria.php');
 include('../inc/operaciones.php');
 
 if(!valida_usr(14)){
 
 echo "Acceso No Autorizado";
 return ;
 }
 


    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gestion de planillas de viaje ocasional</title>
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

     url:'gridreporteplan.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['Codigo','Nro Planilla','Fecha Elab','Movil','Destino','Fecha Sal','Fecha Ret','Fecha Entrega','Estado','Observacion','','','Operaciones']
	, colModel :[
	{name:'id_planilla'
		,index:'id_planilla'
		,width:40
		//,align:'right'
		,editable:false	
		,search:false
	},{
	name:'n_planilla'
		,index:'n_planilla'
		,width:70
		//,align:'right'
		,editable:false	
		
	},{
	name:'fecha_eleboracion'
		,index:'fecha_eleboracion'
		,width:100
		//,align:'right'
		,editable:false	
		,search:false
	},
	{
	
		name:'id_movil'
		,index:'id_movil'
		,width:35
		,editable:true
		,search:false
		,align:'center'
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
		name:'ciudad_d'
		,index:'ciudad_d'
		//,align:'center'
		, width:70
		,search:false
		/*,searchoptions:{dataInit:function(el){jQuery(el).autocomplete({
			source: "selecmovil.php",
			 select: function(event, ui) {
                  }
		});} }*/
	},{
	  name:'fecha_inicio'
		,index:'fecha_inicio'
		,width:65
		,search:false
		//,align:'center'
		//,hidden:true
	},{
	  name:'fecha_retorno'
		,index:'fecha_retorno'
		,width:65
		//,align:'center'
		//,hidden:true
		,search:false	
	},{
	  name:'fecha_plazo_e'
		,index:'fecha_plazo_e'
		,width:130
		,align:'center'
		,search:false
		,formatter:'date', formatoptions:{srcformat:"Y-m-d H:i",newformat:"d-M-Y h:i a"}
		//,hidden:true
		
	},{ name:'estado'
		,index:'estado'
		,width:65
		,align:'center'
		//,hidden:true
		,search:false
		
		},{ name:'servicio'
		,index:'servicio'
		,width:75
		,align:'center'
		//,hidden:true
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
		},{name:'accion',index:'accion',align:'center', width:80,sortable:false,search:false	
	
	}
	],
	   
	  // pager: jQuery('#pcrudoc'),
	   pager: jQuery('#pcrudnov'),
    rowNum:20,
    //rowList:[10,20,30],
	height:'auto',
	width:'auto',
    sortname: 'servicio',
    sortorder: "desc",
    viewrecords: true,
     caption: 'Planillas de Control',
	 
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		 
		 
		 
	loadComplete:function(){
	    
		setTimeout(function(){jQuery('#crudnov').trigger('reloadGrid')},30000)
		var ids = jQuery("#crudnov").getDataIDs();
		for(var i=0;i<ids.length;i++){
			var cl = ids[i];
			 var rowData = jQuery(this).getRowData(cl);
			  var id_planilla= rowData['id_planilla'];
			  var est_ant= rowData['est_ant'];
			  var est_now= rowData['est_new'];
			  var id_movi= rowData['id_movil'];
			  var estad= rowData['estado'];
			 
			 if(est_ant != est_now){ 
			  if (est_ant==0 && est_now==1){
			   
			 //  if (estad=="Devuelta"){
			  // jQuery("#crudnov").setRowData(rowData.id_planilla,{servicio:"<font color='green'>Permitido</font>"}) 
			 //  }
			  jQuery("#crudnov").setRowData(rowData.id_planilla,{servicio:"<font color='green'>Permitido</font>"}) 
			 }else{
			
			  jQuery("#crudnov").setRowData(rowData.id_planilla,{servicio:"<font color='red'>Suspendido</font>"}) 
			 }
			 }
			 //replace name with you 

if (estad=="Devuelta"){
			   jQuery("#crudnov").setRowData(rowData.id_planilla,{servicio:"<font color='green'>Permitido</font>"}) 
			  }
	btn = "<input style='height:22px;width:60px;' type='button' value='Revisado' onclick=actu_estado_pl("+id_planilla+","+est_now+","+i+"); />";
	ntarj= "<input  id='id_tarj"+i+"' type='hidden' value="+id_planilla+" />"; 
	id_movil= "<input  id='id_movil"+i+"' type='hidden' value="+id_movi+" />"; 
	//onclick=jQuery('#ntarjetao').dialog('open');
	//jQuery('#list10_d').jqGrid('setGridParam',{url:'subgrid.php?q=1&id=2',page:1}); jQuery('#list10_d').jqGrid('setCaption','Invoice Detail: 2') .trigger('reloadGrid')+"/>"; 
			
			
			//jQuery('#crud').editRow("+cl+"); />"; 
			//se = "<a href='#' id='trigger'>TRIGGER</a>"; 
			//ce = "<input style='height:22px;width:20px;' type='button' value='C' onclick=jQuery('#crud').restoreRow("+cl+"); />"; 
			jQuery("#crudnov").setRowData(ids[i],{accion:btn+id_movil})
			
		}	
	},
	    editurl: 'gridreporteplan.php?q=1'// this is dummy existing url 
		
		 });
		  jQuery("#crudnov").jqGrid('navGrid','#pcrudnov',{edit:false,add:false,del:false,searchtext:'Busqueda'},{height:400,reloadAfterSubmit:true,closeAfterEdit : true},{closeOnEscape:true},{closeOnEscape:true},{sopt:['cn','bw','eq','ne','lt','gt','ew','le','ge']});
		  
		   //jQuery("#crudnov").jqGrid('setGroupHeaders', { useColSpanStyle: true, groupHeaders:[ {startColumnName: 'nombre1', numberOfColumns: 2, titleText: '<em>Nombres</em>'}, {startColumnName: 'apellido1', numberOfColumns: 2, titleText: 'Apellidos'}, {startColumnName: 'tarj', numberOfColumns: 2, titleText: 'Tarjeta Ctrl'}	 ] });
	
	
	
	
	
	
	
	
	
	
//// detalle de tarjetas de control

jQuery("#crudtc").jqGrid({ 

     url:'gridreporte_planilla.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	   colNames:['Codigo','Nro Planilla','Fecha Elab','Movil','Destino','Fecha Sal','Fecha Ret','Fecha Entrega','Estado','Observacion','Operaciones','','']
	, colModel :[
	{name:'id_planilla'
		,index:'id_planilla'
		,width:40
		//,align:'right'
		,editable:false	
		,search:false
	},{
	name:'n_planilla'
		,index:'n_planilla'
		,width:70
		//,align:'right'
		,editable:false	
		
	},{
	name:'fecha_eleboracion'
		,index:'fecha_eleboracion'
		,width:100
		//,align:'right'
		,editable:false	
		,search:false
	},
	{
	
		name:'id_movil'
		,index:'id_movil'
		,width:35
		,editable:true
		,search:true
		,align:'center'
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
		name:'ciudad_d'
		,index:'ciudad_d'
		//,align:'center'
		, width:70
		,search:false
		/*,searchoptions:{dataInit:function(el){jQuery(el).autocomplete({
			source: "selecmovil.php",
			 select: function(event, ui) {
                  }
		});} }*/
	},{
	  name:'fecha_inicio'
		,index:'fecha_inicio'
		,width:65
		,search:false
		//,align:'center'
		//,hidden:true
	},{
	  name:'fecha_retorno'
		,index:'fecha_retorno'
		,width:65
		//,align:'center'
		//,hidden:true
		,search:false	
	},{
	  name:'fecha_plazo_e'
		,index:'fecha_plazo_e'
		,width:130
		,align:'center'
		,search:true
		,formatter:'date', formatoptions:{srcformat:"Y-m-d H:i",newformat:"d-M-Y h:i a"}
		//,hidden:true
		
	},{ name:'estado'
		,index:'estado'
		,width:65
		//,align:'center'
		//,hidden:true
		,search:false
		
		},{ name:'servicio'
		,index:'servicio'
		,width:75
		//,align:'center'
		//,hidden:true
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
		},{name:'funcion',index:'funcion',align:'center', width:50,sortable:false,search:false	
	
	}
	],
	   
	  // pager: jQuery('#pcrudoc'),
	  pager: jQuery('#pcrudtc'),
    rowNum:60,
    //rowList:[10,20,30],
	//scroll: true, 
	height:'auto',
	width:'auto',
    sortname: 'servicio',
    sortorder: "desc",
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
			 // var id_tarje= rowDatas['id_tarjeta'];
			  var est_ant= rowDatas['est_ant'];
			  var est_now= rowDatas['est_new'];
			  var estado= rowDatas['servicio'];
			   var esta= rowDatas['estado'];
			  //  var estact= rowDatas['estado'];
			   var id_plani= rowDatas['id_planilla'];
				 var n_plan= rowDatas['n_planilla'];
			 
			//  if(est_ant != est_now){ 
			  if (estado=="Suspendido"){
			 // jQuery("#crudtc").setRowData(rowDatas.id_planilla,{servicio:"<font color='green'>Normal</font>"}) 
			  jQuery("#crudtc").setRowData(rowDatas.id_planilla,{servicio:"<font color='red'>Suspendido</font>"})
			
			   
			 //}
			 }else {
			  jQuery("#crudtc").setRowData(rowDatas.id_planilla,{servicio:"<font color='green'>Permitido</font>"})
			 }
			 if (esta=='Devuelta'){
			  jQuery("#crudtc").setRowData(rowDatas.id_planilla,{estado:"<font color='blue'>Devuelta</font>"})
				  }
			 
			 if (esta!='Anulada'){var estadop="";
				  }else{
				estadop="disabled=disabled";
				  }
			 anu = "<input  type='button' value='Anular' "+estadop+" onclick=anula_planilla("+i+");jQuery('#anula_planilla').dialog('open'); />";
			  idplanilla = "<input  id='id_plan"+i+"' type='hidden' value="+id_plani+" />";
			numplani = "<input  id='n_plani"+i+"' type='hidden' value="+n_plan+" />"; 
			 //replace name with you 
/*	nta = "<input style='height:22px;width:60px;' type='button' value='Ver Tarj' onclick=jQuery('#vertc').dialog('open');ver_tarjeta("+id_tarje+"); />";
	
	ntarj= "<input  id='id_tarj"+i+"' type='hidden' value="+id_tarje+" />"; 
	id_movi= "<input  id='id_movil"+i+"' type='hidden' value="+id_mov+" />"; */
	//onclick=jQuery('#ntarjetao').dialog('open');
	//jQuery('#list10_d').jqGrid('setGridParam',{url:'subgrid.php?q=1&id=2',page:1}); jQuery('#list10_d').jqGrid('setCaption','Invoice Detail: 2') .trigger('reloadGrid')+"/>"; 
			
			
			//jQuery('#crud').editRow("+cl+"); />"; 
			//se = "<a href='#' id='trigger'>TRIGGER</a>"; 
			//ce = "<input style='height:22px;width:20px;' type='button' value='C' onclick=jQuery('#crud').restoreRow("+cl+"); />"; 
			jQuery("#crudtc").setRowData(ids[i],{funcion:anu+idplanilla+numplani})
			
		}	
	},
	    editurl: 'gridreporte_planilla.php?q=1'// this is dummy existing url 
		
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
jQuery('#anula_planilla').dialog({autoOpen: false, modal:true,width:400,height:270,}); 
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

<span class="Estilo1">Novedad de Planillas</span>
<table align="center" id="crudnov"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudnov" align="center"> </div>
  <p>&nbsp;</p>
  <span class="Estilo1">Planillas de Viaje Ocasional</span>
<table align="center" id="crudtc"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudtc" align="center"></div>
<div id="vertc"  "title="Tarjeta de Control"></div>
<div id="anula_planilla" title="Funci&oacute;n Especial"></div>
<form method="post" action="csvExport.php">
    <input type="hidden" name="csvBuffer" id="csvBuffer" value="" />
</form>

</body>
</html>
