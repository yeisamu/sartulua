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
<title>Panel de Radio Control</title>
	<script  src="../inc/prototype.js"></script> 
	<script  src="../inc/funciones.js"></script>
	<script  src="../themes/js/jquery-1.6.2.min.js"></script>
<script  src="../themes/js/jquery-ui-1.8.16.custom.min.js"></script> 
<script  src="../js/jquery-ui-timepicker-addon.js"></script>
<script  src="../js/timepicker_slider_access.js"></script>
<script  src="../themes/ejemplo/ui/jquery.ui.slider.js"></script>
<script  src="../themes/ejemplo/ui/i18n/jquery.ui.datepicker-es.js"></script>


<script type="text/javascript">
/*	function trim(myString)
{
return myString.replace(/^\s+/g,'').replace(/\s+$/g,'')
}
*/
  /*  $.jgrid.no_legacy_api = true;
    $.jgrid.useJSON = true;*/
   jQuery.noConflict();
	jQuery(document).ready(function(){ 
	jQuery("#crud").jqGrid({ url:'gridpinactivo.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['Movil','Placa','Grupo']
	  , colModel :[
	 	  
	  {
	  name:'id_movil'
		,index:'id_movil'
		,width:55
		,align:'center'
		,editable:false
		,search:true
		},{
		 name:'placa'
		,index:'placa'
		,width:55
		,align:'center'
		,editable:false
		,search:true
		},{
	  name:'grupo'
		,index:'grupo'
		,width:50
		//,align:'center'
		,editable:true
		,search:true
	}
	
	 
	],
	   
	   pager: jQuery('#pcrud'),
    rowNum:10,
   rowList:[10,20,30],
	height:200,
	width:250,
    sortname: 'vehiculo.id_movil',
    sortorder: "asc",
   viewrecords: true,
     caption: 'Moviles Inhabilitados',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		loadComplete: function(){
				setTimeout(function(){jQuery('#crud').trigger('reloadGrid')},40000)
				}
		
		//jQuery('#crud').editRow("+cl+"); 
	
	
	    ,editurl: 'gridpinactivo.php?q=1'// this is dummy existing url 
		
		 });
		 
		 jQuery("#crud").jqGrid('navGrid','#pcrud',{search:false,edit:false,add:false,del:false},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true});


		 
		 
jQuery("#crud").jqGrid('filterToolbar');	


//////panel de activos

jQuery("#crudac").jqGrid({ url:'gridpactivo.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['Movil','Placa','Grupo','Acciones']
	  , colModel :[
	 	  
	  {
	  name:'id_movil'
		,index:'id_movil'
		,width:55
		,align:'center'
		,editable:false
		,search:true
		},{
		 name:'placa'
		,index:'placa'
		,width:55
		,align:'center'
		,editable:false
		,search:true
		},{
	  name:'grupo'
		,index:'grupo'
		,width:50
		//,align:'center'
		,editable:true
		,search:true
	},{name:'act',index:'act',align:'center', width:90,sortable:false,search:false}
	
	 
	],
	   
	   pager: jQuery('#pcrudac'),
    rowNum:10,
   rowList:[10,20,30],
	height:200,
	width:250,
    sortname: 'vehiculo.id_movil',
    sortorder: "asc",
   viewrecords: true,
     caption: 'Moviles Habilitados',
	postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl+"); 
			loadComplete: function(){
				setTimeout(function(){jQuery('#crudac').trigger('reloadGrid')},40000)
		var ids = jQuery("#crudac").getDataIDs();
		for(var i=0;i<ids.length;i++){
			var cl = ids[i];
			 var rowData = jQuery(this).getRowData(cl); 
                  var id_movil= rowData['id_movil'];//replace name with you 
				  
				  movil=trim(id_movil);
	be = "<a id='inas' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=abrefrec('"+movil+"');jQuery('#frecuencia').dialog('open');><span class='ui-icon ui-icon ui-icon-circle-check'></span>10-8</a>";
	
    co = "<input  id='idmovil"+i+"' type='hidden' value="+id_movil+" />"; 
			jQuery("#crudac").setRowData(ids[i],{act:be+co})
			
		}	
	}
	
	   , editurl: 'gridpactivo.php?q=1'// this is dummy existing url 
		
		 });
		 
		 jQuery("#crudac").jqGrid('navGrid','#pcrudac',{search:false,edit:false,add:false,del:false},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true});


		 
		 
jQuery("#crudac").jqGrid('filterToolbar');	
//////////	moviles en convenio

jQuery("#crudcon").jqGrid({ url:'gridconvenio.php',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['Movil','Placa','Grupo']
	  , colModel :[
	 	  
	  {
	  name:'id_movil'
		,index:'id_movil'
		,width:55
		,align:'center'
		,editable:true
		,editoptions:{
		dataInit:function(el){jQuery(el).autocomplete({
			source: "selecmovilconv.php",
			 select: function(event, ui) {
                  }
		});} }
		
		},{
		 name:'placa'
		,index:'placa'
		,width:55
		,align:'center'
		,editable:false
		},{
	  name:'grupo'
		,index:'grupo'
		,width:50
		//,align:'center'
		,editable:false
		
	}
	
	 
	],
	   
	   pager: jQuery('#pcrudcon'),
    rowNum:10,
   // rowList:[10,20,30],
	height:200,
	width:250,
    sortname: 'id_movil',
    sortorder: "asc",
   // viewrecords: true,
     caption: 'Moviles En Convenio',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl+"); 
	
	
	    editurl: 'gridconvenio.php'// this is dummy existing url 
		
		 });
		 
		 jQuery("#crudcon").jqGrid('navGrid','#pcrudcon',{search:false,edit:true,add:true,del:true},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true});
		  jQuery("#crudcon").jqGrid('filterToolbar');
	 		 
//////////	moviles suspendidos en 10-7

jQuery("#crudsus").jqGrid({ url:'gridsusp.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['','Movil','Placa','Grupo','Inicio','Fin','Motivo']
	  , colModel :[
	 	  
	  {
	   name:'id_susp'
		,index:'id_susp'
		//,width:55
		,align:'center'
		,editable:false
		,hidden:true
		
		},{
	  name:'id_movil'
		,index:'id_movil'
		,width:40
		,align:'center'
		,editable:true
		,search:true
		,editoptions:{
		dataInit:function(el){jQuery(el).autocomplete({
			source: "selecmovil.php",
			 select: function(event, ui) {
                  }
		});} }
		
		},{
		 name:'placa'
		,index:'placa'
		//,width:80
		,align:'center'
		,editable:false
		,search:true
		,hidden:true
		},{
	  name:'grupo'
		,index:'grupo'
		//,width:60
		//,align:'center'
		,search:true
		,editable:false
		,hidden:true
		},{
		 name:'f_inicio'
		,index:'f_inicio'
		,search:true
		,width:70
		,editable:true
		,formatoptions:{srcformat:"Y-m-d H:i:s",newformat:"Y-m-d h:i A"}
		,formoptions:{label: "Inicio (aa/mm/dd)"}
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
                   // jQuery('.ui-datepicker').css({'font-size':'85%'});
                },200);}
				}
		//,align:'center'
			},{
		 name:'f_fin'
		,index:'f_fin'
		,search:true
		,width:70
		//,align:'center'
		,editable:true
		,formoptions:{label: "Fin (aa/mm/dd)"}
		,formatoptions:{srcformat:"Y-m-d H:i:s",newformat:"Y-m-d h:i A"}
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
                   // jQuery('.ui-datepicker').css({'font-size':'85%'});
                },200);}
				}
		},{
		 name:'descripcion'
		,index:'descripcion'
		,width:40
		//,align:'center'
		,editable:true
		
		
	}
	
	 
	],
	   
	   pager: jQuery('#pcrudsus'),
    rowNum:10,
   // rowList:[10,20,30],
	height:200,
	width:250,
    sortname: 'id_susp',
    sortorder: "asc",
  //  viewrecords: true,
     caption: 'Moviles En Suspension 10-7',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		loadComplete: function(){
				setTimeout(function(){jQuery('#crudsus').trigger('reloadGrid')},40000)
				},
		//jQuery('#crud').editRow("+cl+"); 
	
	
	    editurl: 'gridsusp.php'// this is dummy existing url 
		
		 });
		 
		 
		 jQuery("#crudsus").jqGrid('navGrid','#pcrudsus',{search:false,edit:false,add:false,del:false,view:true,reload:false},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true,height:200,width:250},{closeOnEscape:true,height:200,width:450});
		 jQuery("#crudsus").jqGrid('filterToolbar');
		 
		 
///////////moviles en frecuencia

//////////	moviles en convenio

jQuery("#crudfre").jqGrid({ url:'gridfrec.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['Movil','Placa','Grupo','Tarjeta','','id','Documento','Conductor','Telefono','Rh','Acudiente','Telefono Acu','Accion']
	  , colModel :[
	 	  
	  {
	  name:'id_movil'
		,index:'id_movil'
		,width:35
		,align:'center'
		,editable:true
		,editoptions:{
		dataInit:function(el){jQuery(el).autocomplete({
			source: "selecmovil.php",
			 select: function(event, ui) {
                  }
		});} }
		
		},{
		 name:'placa'
		,index:'placa'
		,width:55
		,align:'center'
		,editable:false
		},{
	  name:'grupo'
		,index:'grupo'
		,width:40
		//,align:'center'
		,editable:false
		},{
	  name:'tarjeta'
		,index:'tarjeta'
		,width:50
		
	},{
	 name:'id_tarjeta'
		,index:'id_tarjeta'
		,width:50
		,hidden:true
	},{
		name:'id_conductor'
		,index:'id_conductor'
		,width:55
		,align:'center'
		,search:false
		,hidden:true
		//,editrules:{edithidden:true,required:true}
	},{
		name:'codigo'
		,index:'codigo'
		,width:75
		,editable:true
		,editrules:{required:true}
		//,align:'center'
		,searchoptions:{dataInit:function(el){jQuery(el).autocomplete({
			source: "busca_condu.php",
			 select: function(event, ui) {
                  }
		});} }
	   //  ,searchoptions : {
    //        sopt : [ 'cn' ],
//            dataInit : function(el) {
//              			$(el).autocomplete({
//			source: "gesdocs/buscacondu.php",
//			 select: function(event, ui) {
//                  }
//		});
//           }
//        }	
	//	formatter:'number',
	//	formatoptions:{sorttype:"number"},
//		editrules:required:true}
		
		
	},{
		name:'nombres'
		,index:'nombres'
		,width:150
		//,align:'right'
		,editable:true
		//,edittype:'select'
		//,editoptions:{value:"1:Si;0:No"}  Name:Value;Name:Value 
		,searchoptions:{dataInit:function(el){jQuery(el).autocomplete({
			source: "busca_condu_n1.php",
			 select: function(event, ui) {
                  }
		});} }
	},{
		 name:'telefono'
		,index:'telefono'
		,width:55
		,align:'center'
		,hidden:true
		,editrules:{edithidden:true,required:true}
		},{
	  name:'tipo_rh'
		,index:'tipo_rh'
		,width:50
		//,align:'center'
		,hidden:true
		,editrules:{edithidden:true,required:true}
		},{
	  name:'acudiente'
		,index:'acudiente'
		,width:50
		,hidden:true
		,editrules:{edithidden:true,required:true}
	},{	
	 name:'tel_acu'
		,index:'tel_acu'
		,width:50
		,hidden:true
		,editrules:{edithidden:true,required:true}
		
	},{	
	 name:'boton'
		,index:'boton'
		,width:140
		,search:false
		,editable:false
		//,hidden:true
		//,editrules:{edithidden:true,required:true}	
	} 
	],
	   
	   pager: jQuery('#pcrudfre'),
    rowNum:10,
   // rowList:[10,20,30],
	height:200,
	width:'auto',
    sortname: 'id_movil',
    sortorder: "asc",
   // viewrecords: true,
     caption: 'Moviles En Frecuencia',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl+"); 
	loadComplete: function(){
		var ids = jQuery("#crudfre").getDataIDs();
		for(var i=0;i<ids.length;i++){
			var cl = ids[i];
			 var rowData = jQuery(this).getRowData(cl); 
                  var id_movil= rowData['id_tarjeta'];//replace name with you 
				  
				  movil=trim(id_movil);
	be = "<a id='baja' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=jQuery('#confirmar_baja').dialog('open');jQuery('#id_mov').val('"+movil+"');><span class='ui-icon ui-icon ui-icon-circle-close' ></span>B</a>";
	susp = "<a id='10-7' class='fm-button ui-state-default ui-corner-all'  href='#' onClick=jQuery('#confirm_susp').dialog('open');jQuery('#id_mov').val('"+movil+"');>10-7</a>";
	acci = "<a id='10-42' class='fm-button ui-state-default ui-corner-all'  href='#' onClick=jQuery('#confirm_1015').dialog('open');jQuery('#id_mov').val('"+movil+"');>10-42</a>";
	
    co = "<input  id='idmovi"+i+"' type='hidden' value="+id_movil+" />"; 
			jQuery("#crudfre").setRowData(ids[i],{boton:be+co+susp+acci})
			
		}	
	}
	
	   ,
	
	    editurl: 'gridfrec.php?q=1'// this is dummy existing url 
		
		 });
		 
		 jQuery("#crudfre").jqGrid('navGrid','#pcrudfre',{search:false,edit:true,add:true,del:true,view:true},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true});
		  jQuery("#crudfre").jqGrid('filterToolbar');

 
////////////	

//////////grilla servicio asignado
var lastSel;
jQuery("#crudsasig").jqGrid({ url:'gridserv_asig.php',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['','Telefono','Direccion','Movil','Usuario','Accion']
	  , colModel :[
	 	  
	  {
	   name:'id_ser'
		,index:'id_ser'
		//,width:55
		,align:'center'
		,editable:false
		,hidden:true
		
		
	},{	
		name:'telefono'
		,index:'telefono'
		,width:93
		,hidden:false
		,editrules:{edithidden:true,required:false}
		,editable:false
		,search:true
		
		
	},{	
	
	
		 name:'direccion'
		,index:'direccion'
		,width:200
		//,align:'center'
		,editable:true
		,search:true
		
	
	},{	
	  name:'id_movil'
		,index:'id_movil'
		,width:50
		,align:'center'
		,editable:true
		,search:true
		,hidedlg:true
		,editoptions:{
		 
		dataInit:function(el){jQuery(el).autocomplete({
			source: "selecmovil.php",
			 select: function(event, ui) {
                  }
		});} }
		
},{	
	 name:'usuario'
		,index:'usuario'
		,width:80
		//,align:'center'
		,hidden:false
		
 },{	
	 name:'acc'
		,index:'acc'
		,width:80
		//,align:'center'
	}
	
	 
	],
	   
	   pager: jQuery('#pcrudsasig'),
    rowNum:15,
    rowList:[10,20,30],
	height:380,
	width:580,
    sortname: 'id_ser',
    sortorder: "desc",
   // viewrecords: true,
     caption: 'Servicios Asignados',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl+"); 
	loadComplete:function(){
	    
		setTimeout(function(){jQuery('#crudsasig').trigger('reloadGrid')},40000)
		
		//////configurar los colores de la celda dependiendo el tiempo transcurido de la toma del pedido
		var ids = jQuery("#crudsasig").getDataIDs();
		for(var i=0;i<ids.length;i++){
			var cl = ids[i];
		var rowData = jQuery(this).getRowData(cl);
			//  var color= rowData['color'];
		      var id_servi= rowData['id_ser'];
		
		/* if(color ==1){ 
			  jQuery("#crudsasig").setRowData(rowData.id_ser,{color:"<font color='green'>Baja</font>"}) 
			 }
		 if(color ==2){ 
			  jQuery("#crudsasig").setRowData(rowData.id_ser,{color:"<font color='blue'>Media</font>"}) 
			 }
			 
			 if(color ==3){ 
			   jQuery("#crudsasig").setRowData(rowData.id_ser,{color:"<font color='red'>Alta</font>"}) 
			 }*/
			 	des = "<a id='des' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=jQuery('#id_servicio').val('"+id_servi+"');jQuery('#descarte_serv').dialog('open');>Descarte<span class='ui-icon ui-icon-trash'></span></a>";
	
   			jQuery("#crudsasig").setRowData(ids[i],{acc:des})
			
	
			 
			 }
			 
	},
	   editurl: 'gridserv_asig.php'// this is dummy existing url 
		
		 });
		 
		 
		 jQuery("#crudsasig").jqGrid('navGrid','#pcrudsasig',{edit:false,add:false,del:false,view:true,search:false,reload:false},{reloadAfterSubmit:true,closeAfterEdit :true,closeOnEscape:true},{reloadAfterSubmit:true,closeOnEscape:true,closeAfterAdd : true},{closeOnEscape:true});
		 jQuery("#crudsasig").jqGrid('filterToolbar');

////	 
//////////grilla servicio radio
var lastSel;
jQuery("#crudradio").jqGrid({ url:'gridpto_radio.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['','Linea','Telefono','Direccion','Detalle Servicio','Fecha','Movil','Prioridad','Accion']
	  , colModel :[
	 	  
	  {
	   name:'id_ser'
		,index:'id_ser'
		//,width:55
		,align:'center'
		,editable:false
		,hidden:true
		
		},{
		
		 name:'linea'
		,index:'linea'
		,width:80
		,align:'center'
		,hidden:true
		,editrules:{edithidden:true,required:true}
		,editable:true
		,search:true
		,edittype:'select'
		,editoptions:{ dataUrl: '../inc/lista.php?tb=linea_atencion&cid=linea&cd=linea' }
	},{	
		name:'telefono'
		,index:'telefono'
		,width:93
		,hidden:false
		,editrules:{edithidden:true,required:false}
		,editable:true
		,search:true
		,editoptions:{
		 
		dataInit:function(el){jQuery(el).autocomplete({
			source: "selectel.php",
			 select: function(event, ui) {
			         jQuery('#direccion').val(ui.item.dir);
                  }
		});} }
		
	},{	
	
	
		 name:'direccion'
		,index:'direccion'
		,width:200
		//,align:'center'
		,editable:true
		,search:true
		
	},{	
	
		 name:'detalle_serv'
		,index:'detalle_serv'
		,width:150
		//,align:'center'
		//,hidden:true
		,editrules:{edithidden:true,required:false}
		,editoptions:{value:'N/A'}
		,edittype:'textarea'
		,editable:true
		,search:true
		
		
	},{	
	
		 name:'fecha_reg'
		,index:'fecha_reg'
		,width:120
		,align:'center'
		,hidden:true
		,editable:false
		,search:true
		,formatter:'date', formatoptions:{srcformat:"Y-m-d H:i",newformat:"y/m/d h:i"}
	
		
	},{	
	  name:'id_movil'
		,index:'id_movil'
		,width:50
		,align:'center'
		,editable:true
		,search:true
		,hidedlg:true
		,editoptions:{
		 
		dataInit:function(el){jQuery(el).autocomplete({
			source: "selecmovil.php",
			 select: function(event, ui) {
                  }
		});} }
		
},{	
	 name:'color'
		,index:'color'
		,width:80
		//,align:'center'
		,hidden:false
		
 },{	
	 name:'acc'
		,index:'acc'
		,width:120
		//,align:'center'
	}
	
	 
	],
	   
	   pager: jQuery('#pcrudradio'),
    rowNum:15,
    rowList:[10,20,30],
	height:380,
	width:580,
    sortname: 'color',
    sortorder: "desc",
   // viewrecords: true,
     caption: 'Servicio Puntos de Radio',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl+"); 
	loadComplete:function(){
	    
		setTimeout(function(){jQuery('#crudradio').trigger('reloadGrid')},40000)
		
		//////configurar los colores de la celda dependiendo el tiempo transcurido de la toma del pedido
		var ids = jQuery("#crudradio").getDataIDs();
		for(var i=0;i<ids.length;i++){
			var cl = ids[i];
		var rowData = jQuery(this).getRowData(cl);
			  var color= rowData['color'];
		      var id_servi= rowData['id_ser'];
		
		 if(color ==1){ 
			  jQuery("#crudradio").setRowData(rowData.id_ser,{color:"<font color='green'>Baja</font>"}) 
			 }
		 if(color ==2){ 
			  jQuery("#crudradio").setRowData(rowData.id_ser,{color:"<font color='blue'>Media</font>"}) 
			 }
			 
			 if(color ==3){ 
			   jQuery("#crudradio").setRowData(rowData.id_ser,{color:"<font color='red'>Alta</font>"}) 
			 }
			 	des = "<a id='des' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=jQuery('#id_servicio').val('"+id_servi+"');jQuery('#descarte_serv').dialog('open');>Descarte<span class='ui-icon ui-icon-trash'></span></a>";
	
   			jQuery("#crudradio").setRowData(ids[i],{acc:des})
			
	
			 
			 }
			 
	},
	
	

	
	 onSelectRow: function(id){ 
      if(id && id!==lastSel){ 
         jQuery('#crudradio').restoreRow(lastSel); 
         lastSel=id; 
      } 
      jQuery('#crudradio').editRow(id, true); 
   },
	    editurl: 'gridpto_radio.php'// this is dummy existing url 
		
		 });
		 
		 
		 jQuery("#crudradio").jqGrid('navGrid','#pcrudradio',{edit:false,add:true,del:false,view:true,search:false,reload:false},{reloadAfterSubmit:true,closeAfterEdit :true,closeOnEscape:true},{reloadAfterSubmit:true,closeOnEscape:true,closeAfterAdd : true},{closeOnEscape:true});
		 jQuery("#crudradio").jqGrid('filterToolbar');

////		 
	//////////grilla novedad de vehiculos
var lastSelec;
jQuery("#crudnov").jqGrid({ url:'gridnovedad.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['','Movil','Novedad']
	  , colModel :[
	 	  
	  {
	   name:'id_nov_serv'
		,index:'id_nov_serv'
		//,width:55
		,align:'center'
		,editable:false
		,hidden:true
		
		},{
		
		 name:'id_movil'
		,index:'id_movil'
		,width:50
		,align:'center'
	
	},{	
		name:'operacion'
		,index:'operacion'
		,width:200
		,hidden:false
		
	
	}
	
	 
	],
	   
	//   pager: jQuery('#pcrudnov'),
    rowNum:15,
    rowList:[10,20,30],
	height:'auto',
	width:'auto',
    sortname: 'id_nov_serv',
    sortorder: "desc",
   // viewrecords: true,
     caption: 'Novedades en los Moviles',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl

		
		//jQuery('#crud').editRow("+cl+"); 
	loadComplete:function(){
	    
		setTimeout(function(){jQuery('#crudnov').trigger('reloadGrid')},40000)
		
		},
	
	 onSelectRow: function(id){ 
      if(id && id!==lastSelec){ 
         jQuery('#crudnov').restoreRow(lastSel); 
         lastSel=id; 
      } 
      //jQuery('#crudnov').editRow(id, true); 
	  jQuery("#crudnov").delGridRow( id,{closeOnEscape:true,caption: "Revisado",msg: "Confirmar la revision de la Novedad?",bSubmit: "Aceptar",
		bCancel: "Cancelar"} );
   },
	    editurl: 'gridnovedad.php?q=2'// this is dummy existing url 
		
		 });
		 
		 
		 jQuery("#crudnov").jqGrid('navGrid','#pcrudnov',{edit:false,add:false,del:false,view:true,search:false,reload:false},{reloadAfterSubmit:true,closeAfterEdit :true,closeOnEscape:true},{reloadAfterSubmit:true,closeOnEscape:true,closeAfterAdd : true},{closeOnEscape:true,caption: "Delete",msg: "Delete selected record(s)?",bSubmit: "Delete",
		bCancel: "Cancel"});
		// jQuery("#crudnov").jqGrid('filterToolbar');
	 		 		

	/*	 jQuery( "#tabs" ).tabs({
						//event: "mouseover"
					});*/
					
					
	jQuery( "#confirmar_baja" ).dialog({
			resizable: false,
			autoOpen: false,
			height:160,
			modal: true,
			buttons: {
				"Aceptar": function() {
					jQuery( this ).dialog( "close" );
					var idmovil=jQuery('#id_mov').val();
					grabar_baja_frec(idmovil)
					return 1;
				},
				Cancel: function() {
					jQuery( this ).dialog( "close" );
					return 0;
					//jQuery('#cerrar').dialog( 'close' );
				}
			}
		});
		
	jQuery( "#confirm_susp" ).dialog({
			resizable: false,
			autoOpen: false,
			height:160,
			modal: true,
			buttons: {
				"Aceptar": function() {
					jQuery( this ).dialog( "close" );
					var idmovil=jQuery('#id_mov').val();
					grabar_susp(idmovil)
					jQuery("#suspende" ).dialog( "open" );
					return 1;
				},
				Cancel: function() {
					jQuery( this ).dialog( "close" );
					return 0;
					//jQuery('#cerrar').dialog( 'close' );
				}
			}
		});	
		
		
	jQuery( "#confirm_1015" ).dialog({
			resizable: false,
			autoOpen: false,
			height:160,
			modal: true,
			buttons: {
				"Aceptar": function() {
					jQuery( this ).dialog( "close" );
					var idmovil=jQuery('#id_mov').val();
					grabar_acci(idmovil)
					jQuery("#accidente" ).dialog( "open" );
					return 1;
				},
				Cancel: function() {
					jQuery( this ).dialog( "close" );
					return 0;
					//jQuery('#cerrar').dialog( 'close' );
				}
			}
		});	
		
			jQuery( "#descarte_serv" ).dialog({
			resizable: false,
			autoOpen: false,
			height:160,
			modal: true,
			buttons: {
				"Aceptar": function() {
					jQuery( this ).dialog( "close" );
					var idservic=jQuery('#id_servicio').val();
					grabar_descarte_ser(idservic)
					jQuery("#descarte" ).dialog( "open" );
					return 1;
				},
				Cancel: function() {
					jQuery( this ).dialog( "close" );
					return 0;
					//jQuery('#cerrar').dialog( 'close' );
				}
			}
		});									
jQuery('#frecuencia').dialog({autoOpen: false, modal:true,width:550,height:300,});
jQuery('#descarte').dialog({autoOpen: false, modal:true,width:320,height:220,});
jQuery('#suspende').dialog({autoOpen: false, modal:true,width:400,height:300,});
jQuery('#accidente').dialog({autoOpen: false, modal:true,width:600,height:400,});					
});					
					

	//	 });
    </script>
 <script src="../src/jqDnR.js" type="text/javascript"></script>
	
	<script src="../src/jqModal.js" type="text/javascript"></script>
		<script src="../themes/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../themes/development-bundle/ui/jquery.ui.widget.js"></script>
	 <script src="../js/i18n/grid.locale-es.js" type="text/javascript"></script>
<script src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>

	 <link rel="stylesheet" type="text/css" href="../themes/css/custom-theme/jquery-ui-1.8.16.custom.css">
	
	<link rel="stylesheet" type="text/css" href="../css/ui.jqgrid.css">
	
    <link rel="stylesheet" type="text/css" media="screen" href="../themes/ui.multiselect.css" /> 
   	<link rel="stylesheet" type="text/css" href="../themes/development-bundle/themes/custom-theme/jquery.ui.all.css"> 
    <link rel="stylesheet" type="text/css" media="screen" href="../themes/ui.multiselect.css" /> 
   <link rel="stylesheet" type="text/css" href="../plugins/ui.multiselect.css">   
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
		#Layer2 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:2;
	left: 52px;
	top: 963px;
}
    #Layer3 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:3;
	left: 51px;
	top: 667px;
}
    #Layer4 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:4;
	left: 304px;
	top: 74px;
}
#frecuencia{
display: none;
}

#descarte_serv{
display: none;
}
	#confirmar_baja{
display: none;
}
	#confirm_susp{
display: none;
}
	#confirm_1015{
display: none;
}
#bfrecuencia{
display: none;
}
#suspende{
display: none;
}
#accidente{
display: none;
}
    #Layer5 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:5;
	left: 304px;
	top: 372px;
}
    #Layer6 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:6;
	left: 305px;
	top: 850px;
}
    #Layer7 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:7;
	left: 888px;
	top: 75px;
}
    </style>	
</head>

<body>
<div  id="login1">login: [ <?php echo $_SESSION['login'];  ?>]</div>
<div id="Layer1"></div>
<div align="right"><span class="Estilo2"><a href="../login/index2.php" class="ui-state-hover">Volver al Men&uacute </a></span></div>

<!--<span class="Estilo1">Moviles Inhabilitados</span> -->
    <table align="center" id="crudac"  >
<tr><td>&nbsp;</td></tr></table>
<div id="pcrudac" align="center"></div>

  <div id="Layer2"> 
  <table align="center" id="crud"  >
<tr><td>&nbsp;</td></tr></table>
<div id="pcrud" align="center"></div>
</div>
</div>
<!-- -->
<!--<span class="Estilo1">Moviles en Convenio </span> -->
<table align="center" id="crudsus"  >
<tr><td>&nbsp;</td></tr></table>
<div id="Layer6">
  <table align="center" id="crudsasig"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudsasig" align="center"></div>
</div>
<div id="pcrudcon" align="center"></div>

<div id="Layer3">
  <table align="center" id="crudcon"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudsus" align="center"></div></div>
<div id="Layer4">
  <table align="center" id="crudfre"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudfre" align="center"></div></div>
<!--<span class="Estilo1">Moviles Habilitados</span> -->
<div id="frecuencia" title="Dar Frecuencia a Movil"></div>
<div id="bfrecuencia" title="Bajar Movil de Frecuencia "></div>
<div id="descarte_serv" title="Descartar servicio">
<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta Segur@ de Descartar este servicio?</p>
</div>


<div id="Layer7">
  <table align="center" id="crudnov"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudnov" align="center"></div>
</div>

<input type="hidden" name="id_servicio" id="id_servicio" />
<div id="Layer5"> 
 <table align="center" id="crudradio"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudradio" align="center"></div>
</div>
<div id="confirmar_baja" title="Bajar Movil de Frecuencia">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta Segur@ de Bajar Este Movil de Frecuencia?</p>
</div>
<div id="confirm_susp" title="Suspender Movil 10-7">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta Segur@ de Suspender Temporalmente (10-7) el Movil?</p>
</div>

<div id="confirm_1015" title="Reporte Movil 10-42">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta Segur@ de Reportar (10-42) al Movil?</p>
</div>

<div id="suspende" title="Suspender Movil 10-7">
	
</div>
<div id="accidente" title="Movil 10-42">
	
</div>
<div id="descarte" title="Descartar El Servicio">
	
</div>
<input type="hidden" name="id_mov" id="id_mov" />
</body>
</html>
