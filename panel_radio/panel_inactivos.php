<?php
session_start();
 include('../inc/libreria.php');
 
 if(!valida_usr(17)){
 
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
<script  src="../js/jquery.jqGrid.min.js"></script>
<script   src="../js/jquery.jqGrid.src.js"></script>
<script   src="../src/grid.base.js"></script>
<script   src= "../src/jquery.fmatter.js"></script>
<script   src="../src/grid.common.js"></script>
<script   src="../src/grid.custom.js"></script>
<script   src="../src/grid.formedit.js"></script>
<script   src="../src/grid.inlinedit.js"></script>
<script   src="../src/grid.celledit.js"></script>
<script   src="../src/jqDnR.js"></script>
<script   src="../src/jqModal.js"></script>
<script   src="../src/grid.import.js"></script>
<script type="text/javascript"> 
	
  /*  $.jgrid.no_legacy_api = true;
    $.jgrid.useJSON = true;*/
   jQuery.noConflict();
	jQuery(document).ready(function(){ 
	actualizatabla('Layer5')
	var auxiliar='<?php echo $_SESSION['loginaux'];?>';
	if(auxiliar!=""){
	l_aux("Layer12")
	}else{
	login_aux('Layer12')
	 } 
	 
	 ser_asig('Layer6')
	jQuery("#crud").jqGrid({ 
	 scrollrows : true,
	 url:'gridpinactivo.php?q=1',
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
		,search:true
		},{
		 name:'placa'
		,index:'placa'
		,width:55
		,align:'center'
		,editable:true
		,search:true
		},{
	  name:'grupo'
		,index:'grupo'
		,width:50
		,hidden:true
		,editable:true
		,search:true
	}
	
	 
	],
	   
	   pager: jQuery('#pcrud'),
    rowNum:100,
   rowList:[100,200,300],
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
		 
		 jQuery("#crud").jqGrid('navGrid','#pcrud',{search:true,edit:false,add:false,del:false},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true});


		 
		 
jQuery("#crud").jqGrid('filterToolbar');	


//////panel de activos

jQuery("#crudac").jqGrid({ 
      scrollrows : true,
     url:'gridpactivo.php?q=1',
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
		,searchoptions:{dataInit:function(el){jQuery(el).autocomplete({
			source: "valida_movil_108.php",
			 select: function(event, ui) {
                  }
		});} }
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
		,hidden:true
		,editable:true
		,search:true
	},{name:'act',index:'act',align:'center', width:90,sortable:false,search:false}
	
	 
	],
	   
	 //  pager: jQuery('#pcrudac'),
    rowNum:3,
   rowList:[10,20,30],
	height:100,
	width:250,
    sortname: 'vehiculo.id_movil',
    sortorder: "asc",
  // viewrecords: true,
   //  caption: 'Moviles Habilitados',
	postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl+"); 
			loadComplete: function(){
				setTimeout(function(){jQuery('#crudac').trigger('reloadGrid')},40000)
		var ids = jQuery("#crudac").jqGrid('getDataIDs');
		for(var i=0;i<ids.length;i++){
			var cl = ids[i];
			 var rowData = jQuery(this).jqGrid('getRowData',cl); 
                  var id_movil= rowData['id_movil'];//replace name with you 
				  
				  movil=trim(id_movil);
	be = "<a id='inas' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=abrefrec('"+movil+"');jQuery('#frecuencia').dialog('open');><span class='ui-icon ui-icon ui-icon-circle-check'></span>8-40</a>";
	
    co = "<input  id='idmovil"+i+"' type='hidden' value="+id_movil+" />"; 
			jQuery("#crudac").jqGrid('setRowData',ids[i],{act:be+co})
			
		}	
	}
	
	   , editurl: 'gridpactivo.php?q=1'// this is dummy existing url 
		
		 });
		 
		 jQuery("#crudac").jqGrid('navGrid','#pcrudac',{search:false,edit:false,add:false,del:false},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true});


		 
		 
jQuery("#crudac").jqGrid('filterToolbar');	
//////////	moviles en convenio

/*jQuery("#crudcon").jqGrid({ url:'gridconvenio.php',
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
*/	 		 
//////////	moviles suspendidos en 8-51

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
     caption: 'Moviles En Suspension 8-51',
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
		,hidden:true
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
	width:665,
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
     setTimeout(function(){jQuery('#crudfre').trigger('reloadGrid')},30000) 
		var ids = jQuery("#crudfre").jqGrid('getDataIDs');
		for(var i=0;i<ids.length;i++){
			var cl = ids[i];
			 var rowData = jQuery(this).jqGrid('getRowData',cl);
                  var id_movil= rowData['id_tarjeta'];//replace name with you 
				  
				  movil=trim(id_movil);
	be = "<a id='baja' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=grabar_baja_frec('"+movil+"');jQuery('#id_mov').val('"+movil+"');><span class='ui-icon ui-icon ui-icon-circle-close' ></span>B</a>";
	susp = "<a id='8-51' class='fm-button ui-state-default ui-corner-all'  href='#' onClick=jQuery('#id_mov').val('"+movil+"');grabar_susp('"+movil+"');jQuery('#suspende').dialog('open'); >8-51</a>";
	acci = "<a id='8-25' class='fm-button ui-state-default ui-corner-all'  href='#' onClick=grabar_acci('"+movil+"');jQuery('#accidente').dialog('open');>8-25</a>";
	
    co = "<input  id='idmovi"+i+"' type='hidden' value="+id_movil+" />"; 
			jQuery("#crudfre").jqGrid('setRowData',ids[i],{boton:be+co+susp+acci})
			
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
jQuery("#crudsasig").jqGrid({ 
     scrollrows : true, 
	 url:'gridserv_asig.php',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['','Telefono','Direccion','Detalle Servicio','Movil','Movil 2','Usuario','Fecha','Accion']
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
		,sortable:false
		
		
	},{	
	
	
		 name:'direccion'
		,index:'direccion'
		,width:260
		//,align:'center'
		,editable:true
		,search:true
		,sortable:false
		
	},{	
	
		 name:'detalle_serv'
		,index:'detalle_serv'
		,width:130
		,sortable:false
		//,align:'center'
		//,hidden:true
		,editrules:{edithidden:true}
		//,editoptions:{value:'N/A'}
		//,edittype:'textarea'
		,editable:true
		,search:true
		
	},{	

	  name:'id_movil'
		,index:'id_movil'
		,width:50
		,align:'center'
		,editable:true
		,search:true
			 ,sortable:false
	,hidedlg:true
		,editrules:{custom:true,custom_func:validamovil}
		,editoptions:{
		 
		dataInit:function(el){jQuery(el).autocomplete({
			source: "selecmovil.php",
			 select: function(event, ui) {
                  }
		});} }
		
		
	},{	
	  name:'id_movil2'
		,index:'id_movil2'
		,width:50
		,align:'center'
		,editable:true
		,sortable:false
		,search:true
		,hidedlg:true
		,editrules:{custom:true,custom_func:validamovil}
		,editoptions:{
		 
		dataInit:function(el){jQuery(el).autocomplete({
			source: "selecmovil.php",
			 select: function(event, ui) {
                  }
		});} }
		
},{	

	 name:'usuario'
		,index:'usuario'
		,width:55
		//,align:'center'
		,hidden:false
		,sortable:false
},{	

	 name:'fecha_reg'
		,index:'fecha_reg'
		,width:110
		//,align:'center'
		,hidden:false
		,sortable:false	
			,formatoptions:{srcformat:"Y-m-d H:I",newformat:"M-d h:i A"}
		,formatter:"date"	
 },{	
	 name:'acc'
		,index:'acc'
		,width:130
		//,align:'center'
		,sortable:false
			,search:false
	}
	
	 
	],
	   
	   pager: jQuery('#pcrudsasig'),
    rowNum:100,
    rowList:[100,200,300],
	height:380,
	width:'auto',
    sortname: 'id_ser',
    sortorder: "desc",
   // viewrecords: true,
     caption: 'Servicios Asignados',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},	
	 onSelectRow: function(id){ 
	 
	 if(id && id!==lastsel){
	   rowid = id;
	   jQuery('#crudsasig').jqGrid('restoreRow',lastsel);
	   jQuery('#crudsasig').jqGrid('editRow',id,true); 
	   jQuery("#crudsasig").jqGrid('editCell',1,3,true);
	   lastsel=id;
	    }
		},
		
		
		//jQuery('#crud').editRow("+cl+"); 
	loadComplete:function(){
	    
		//setTimeout(function(){jQuery('#crudsasig').trigger('reloadGrid')},90000)
		
		//////configurar los colores de la celda dependiendo el tiempo transcurido de la toma del pedido
		var idser = jQuery("#crudsasig").jqGrid('getDataIDs');
		for(var i=0;i<idser.length;i++){
			var cl = idser[i];
		var rowData = jQuery(this).jqGrid('getRowData',cl);
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
			 	des = "<a id='des' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=jQuery('#id_servicio').val('"+id_servi+"');jQuery('#descarte_serv').dialog('open');>8-514<span class='ui-icon ui-icon-trash'></span></a>";
				apro = "<a id='apr' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=jQuery('#id_servi').val('"+id_servi+"');jQuery('#apropiacion').dialog('open');>Ap<span class='ui-icon ui-icon-alert'></span></a>";
				
				
	        jQuery("#crudsasig").jqGrid('setCell',cl,'direccion', '', 'letragrande');
		   jQuery("#crudsasig").jqGrid('setCell',cl,'detalle_serv', '', 'letragrande');
		     jQuery("#crudsasig").jqGrid('setCell',cl,'id_movil', '', 'letragrande');
			   jQuery("#crudsasig").jqGrid('setCell',cl,'id_movil2', '', 'letragrande');
   			jQuery("#crudsasig").jqGrid('setRowData',idser[i],{acc:des+apro})
			
	
			 
			 }
			 
	},
	
	   editurl: 'gridserv_asig.php'// this is dummy existing url 
		
		 });
		 
		 
		 jQuery("#crudsasig").jqGrid('navGrid','#pcrudsasig',{edit:false,add:false,del:false,view:true,search:false,reload:false},{reloadAfterSubmit:true,closeAfterEdit :true,closeOnEscape:true},{reloadAfterSubmit:true,closeOnEscape:true,closeAfterAdd : true},{closeOnEscape:true});
		 jQuery("#crudsasig").jqGrid('filterToolbar');

////	 
//////////grilla servicio radio
var lastsel;
jQuery("#crudradio").jqGrid({ 
      url:'gridpto_radio.php?q=1',
	 datatype: "json",
	 scrollrows : true, 
	  mtype: 'GET',
	  colNames:['','','Linea','Telefono','Direccion','Detalle Servicio','Fecha','Movil','Prioridad','Accion']
	  , colModel :[
	 	  
	  {
	name:'act',index:'act', width:60,sortable:false,search:false
	  },{
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
		,sortable:false
		,edittype:'select'
		,editoptions:{ dataUrl: '../inc/lista.php?tb=linea_atencion&cid=linea&cd=linea' }
	},{	
		name:'telefono'
		,index:'telefono'
		,width:80
		,sortable:false
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
		,width:290
		,sortable:false
		//,align:'center'
		,editable:true
		,search:true
		
	},{	
	
		 name:'detalle_serv'
		,index:'detalle_serv'
		,width:150
		,sortable:false
		//,align:'center'
		//,hidden:true
		,editrules:{edithidden:true,required:false}
		,editoptions:{value:'N/A'}
		//,edittype:'textarea'
		,editable:true
		,search:true
		
		
	},{	
	
		 name:'fecha_reg'
		,index:'fecha_reg'
		,width:120
		,sortable:false
		,align:'center'
		,hidden:true
		,editable:false
		,search:true
		,formatter:'date', formatoptions:{srcformat:"Y-m-d H:i",newformat:"y/m/d h:i"}
	
		
	/*},{	
	name:'edi',index:'edi', width:25,sortable:false,search:false*/
	  },{

	  name:'id_movil'
		,index:'id_movil'
		,width:50
		,sortable:false
		,align:'center'
		,editable:true
		,search:true
		//,hidedlg:true
		,editrules:{custom:true,custom_func:validateCar}
		,editoptions:{
		 
		dataInit:function(el){jQuery(el).autocomplete({
			source: "selecmovil.php",
			 select: function(event, ui) {
                  }
		});} }
		
/*},{
name:'graba',index:'graba', width:25,sortable:false,search:false*/
	  },{
	
	 name:'color'
		,index:'color'
		,width:70
		//,align:'center'
		,hidden:false
		
 },{	
	 name:'acc'
		,index:'acc'
		,width:190
		//,align:'center'
	}
	
	 
	],
	   
	   pager: jQuery('#pcrudradio'),
    rowNum:20,
    rowList:[200,300,400],
	height:250,
	width:'auto',
    sortname: 'id_ser',
    sortorder: "asc",
   // viewrecords: true,
     caption: 'Captura de Servicio',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		gridComplete: function(){ 
		
		var ids = jQuery("#crudradio").jqGrid('getDataIDs'); 
		for(var i=0;i < ids.length;i++){
		 var cl = ids[i];
		  be = "<input style='height:22px;width:20px;' type='button' value='E' onclick=\"jQuery('#crudradio').jqGrid('editRow',"+cl+");\" />"; 
		  se = "<input style='height:22px;width:20px;' type='button' value='S' onclick=\"jQuery('#crudradio').jqGrid('saveRow',"+cl+");\" />"; 
		  ce = "<input style='height:22px;width:20px;' type='button' value='C' onclick=\"jQuery('#crudradio').jqGrid('restoreRow',"+cl+");\" />";
		   jQuery("#crudradio").jqGrid('setCell',cl,'direccion', '', 'letragrande');
		   jQuery("#crudradio").jqGrid('setCell',cl,'detalle_serv', '', 'letragrande');
		   jQuery("#crudradio").jqGrid('setRowData',ids[i],{act:ce+be+se}); 
		   // jQuery("#crudradio").jqGrid('setRowData',ids[i],{edi:be}); 
			// jQuery("#crudradio").jqGrid('setRowData',ids[i],{graba:se});
			 }
		   },
		//jQuery('#crud').editRow("+cl+"); 
	loadComplete:function(){
	    
		//setTimeout(function(){jQuery('#crudradio').trigger('reloadGrid')},120000)
		
		//////configurar los colores de la celda dependiendo el tiempo transcurido de la toma del pedido
		var ids = jQuery("#crudradio").jqGrid('getDataIDs');
		for(var i=0;i<ids.length;i++){
			var cl = ids[i];
		var rowData = jQuery(this).jqGrid('getRowData',cl);
			  var color= rowData['color'];
		      var id_servi= rowData['id_ser'];
		
		 if(color ==1){ 
			  jQuery("#crudradio").jqGrid('setRowData',rowData.id_ser,{color:"<font color='green'>Baja</font>"}) 
			 }
		 if(color ==2){ 
			  jQuery("#crudradio").jqGrid('setRowData',rowData.id_ser,{color:"<font color='blue'>Media</font>"}) 
			 }
			 
			 if(color ==3){ 
			   jQuery("#crudradio").jqGrid('setRowData',rowData.id_ser,{color:"<font color='red'>Alta</font>"}) 
			 }
			 	des = "<a id='des' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=jQuery('#id_servicio').val('"+id_servi+"');jQuery('#descarte_serv').dialog('open');>8-514<span class='ui-icon ui-icon-trash'></span></a>";
				auto = "<a id='apr' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=jQuery('#idser').val('"+id_servi+"');jQuery('#servauto').dialog('open');>Auto<span class='ui-icon ui-icon-check'></span></a>";
	    aprop = "<a id='apr' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=jQuery('#id_servi').val('"+id_servi+"');jQuery('#apropiacion').dialog('open');>Ap<span class='ui-icon ui-icon-alert'></span></a>";
   			jQuery("#crudradio").jqGrid('setRowData',ids[i],{acc:des+auto+aprop})
			
	
			 
			 }
			 
	},
	
	

	
	 onSelectRow: function(id){ 
	 
	 if(id && id!==lastsel){ rowid = id;jQuery('#crudradio').jqGrid('restoreRow',lastsel); jQuery('#crudradio').jqGrid('editRow',id,true, null, null, null, {}, aftersavefunc); jQuery("#crudradio").jqGrid('editCell',1,3,true);lastsel=id; }

 },
 
 reloadAfterEdit: true, //seems to have no effect
          reloadAfterSubmit: true, //seems to have no effect
	    editurl: 'gridpto_radio.php'// this is dummy existing url 
		
		


		
		 });
		 
		 
		 jQuery("#crudradio").jqGrid('navGrid','#pcrudradio',{edit:true,add:true,del:false,view:false,search:false,reload:false},{reloadAfterSubmit:false,closeAfterEdit :false,closeOnEscape:true,modal:false},{reloadAfterSubmit:true,closeOnEscape:true,closeAfterAdd : true},{closeOnEscape:true});
	 jQuery("#crudradio").jqGrid('filterToolbar');
		// jQuery('#crudradio').jqGrid('inlineNav','#pcrudradio',{add:true});
//jQuery("#crudradio").jqGrid('inlineNav',"#pcrudradio");


function aftersavefunc(rowid, result) {
        //   jQuery("#crudradio").trigger("reloadGrid");
		//0.jQuery("#crudsasig").trigger("reloadGrid");
		 jQuery("#tele").focus();
    }

function validateCar(value,colname) {
   
                var result = null;
    jQuery.ajax({
        async: false,      //this is crucial
        url: 'valida_movil.php',
        data: { id_movil: value },
        dataType: 'json',
        contentType: 'application/json; charset=utf-8',
        success: function (data) {
            if (!data) {
                result = [true, '']
            } else {
                result = [false, ' Movil no esta en Frecuencia'];
            }
        },
        error: function () { alert('Error trying to validate car ' + value); }
    });
    return result;

}


function validamovil(value,colname) {
   
                var result = null;
    jQuery.ajax({
        async: false,      //this is crucial
        url: 'valida_movil.php',
        data: { id_movil: value },
        dataType: 'json',
        contentType: 'application/json; charset=utf-8',
        success: function (data) {
            if (!data) {
                result = [true, '']
            } else {
                result = [false, ' Movil no esta en Frecuencia'];
            }
        },
        error: function () { alert('Error trying to validate car ' + value); }
    });
    return result;

}

////		 
	//////////grilla novedad de vehiculos
var lastSelec;
jQuery("#crudnov").jqGrid({ 
     scrollrows : true, 
	 url:'gridnovedad.php?q=1',
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
    rowNum:100,
    rowList:[100,200,300],
	height:200,
	width:250,
    sortname: 'id_nov_serv',
    sortorder: "desc",
   // viewrecords: true,
     //caption: 'Novedades en los Moviles',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		}
		
		,
		loadComplete: function(){
				setTimeout(function(){jQuery('#crudnov').trigger('reloadGrid')},10000)
				}
		,
		
		//jQuery('#crud').editRow("+cl

	
	 onSelectRow: function(id){ 
      if(id && id!==lastSelec){ 
         jQuery('#crudnov').restoreRow(lastSelec); 
         lastSelec=id; 
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

//////////	mensajes 10 5
var lastsel105;
jQuery("#crud105").jqGrid({ 
     scrollrows : true,
    url:'grid105.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['','Movil','Mensaje','','']
	  , colModel :[
	 	  
	  {
	   name:'id_msj'
		,index:'id_msj'
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
	   },{
		 name:'msj'
		,index:'msj'
		,width:80
		//,align:'center'
		,editable:false
		,search:true
		//,hidden:true
		},{
		 name:'estado'
		,index:'estado'
		,width:20
		,hidden:true
		//,align:'center'
		//,editable:true
		},{
		 name:'acci'
		,index:'acci'
		,width:20
		//,align:'center'
		//,editable:true
		
		
	}
	
	 
	],
	   
	   pager: jQuery('#pcrud105'),
    rowNum:100,
    rowList:[100,200,300],
	height:200,
	width:250,
    sortname: 'id_msj',
    sortorder: "asc",
  //  viewrecords: true,
     caption: '8-66',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		gridComplete: function(){ 
		
		var ids = jQuery("#crud105").jqGrid('getDataIDs'); 
		for(var i=0;i < ids.length;i++){
		var cl = ids[i];
		var rowmsj = jQuery(this).jqGrid('getRowData',cl);
			
			  
			  
		 desc = "<a id='descartea' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=graba_des_serv("+cl+");>D<span class='ui-icon ui-icon-circle-close'></span></a>";
		 
		   //jQuery("#crudradio").jqGrid('setCell',cl,'direccion', '', 'letragrande');
		  // jQuery("#crudradio").jqGrid('setCell',cl,'detalle_serv', '', 'letragrande');
		   jQuery("#crud105").jqGrid('setRowData',ids[i],{acci:desc}); 
		   // jQuery("#crudradio").jqGrid('setRowData',ids[i],{edi:be}); 
			// jQuery("#crudradio").jqGrid('setRowData',ids[i],{graba:se});
			 }
		   },
	 onSelectRow: function(id){	 
	          if(id && id!==lastsel105){
			  //rowid = id;
			 // jQuery('#crud105').jqGrid('restoreRow',lastsel105);
//			  jQuery('#crud105').jqGrid('editRow',id,true);
//			  jQuery("#crud105").jqGrid('editCell',1,3,true);
//			  lastsel105=id;
graba_rev(id);
 }

 },
	
	
	    editurl: 'grid105.php'// this is dummy existing url 
		
		 });
		 
		 
		 jQuery("#crud105").jqGrid('navGrid','#pcrud105',{search:false,edit:false,add:false,del:false,view:true,reload:false},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true,height:200,width:250},{closeOnEscape:true,height:200,width:450});
		 jQuery("#crud105").jqGrid('filterToolbar');
		 					
					
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
		
								
jQuery('#frecuencia').dialog({autoOpen: false,position:'top', modal:true,width:550,height:300,});

jQuery('#apropiacion').dialog({autoOpen: false,position:'top', modal:false,width:250,height:160,});
jQuery('#servauto').dialog({autoOpen: false,position:'top', modal:true,width:250,height:250,});
jQuery('#suspende').dialog({autoOpen: false,position:'top', modal:false,width:400,height:300,});
jQuery('#accidente').dialog({autoOpen: false,position:'top', modal:false,width:750,height:400,});	
jQuery('#asigna_movil').dialog({autoOpen: false,position:'top', modal:false,width:350,height:300,});	


////funcion de autocompleta del telefono tele
jQuery('#tele').autocomplete({
			source: "selectel.php",
			 select: function(event, ui) {
			         jQuery('#direcci').val(ui.item.dir);
                  }
		});
		jQuery('#id_movil_nov').autocomplete({
			source: "selecmovilap.php",
			 select: function(event, ui) {
			        // jQuery('#direcci').val(ui.item.dir);
                  }
		});
		jQuery('#id_movil_auto').autocomplete({
			source: "selecmovilap.php",
			 select: function(event, ui) {
			         //jQuery('#direcci').val(ui.item.dir);
                  }
		});
	jQuery('#descarte').dialog({autoOpen: false, modal:true,width:320,height:220,});		
});					
					

	//	 });
    </script>
 <script src="../src/jqDnR.js" type="text/javascript"></script>
	
	<script src="../src/jqModal.js" type="text/javascript"></script>
		<script src="../themes/ejemplo/ui/jquery.ui.core.js"></script>
	<script src="../themes/ejemplo/ui/jquery.ui.widget.js"></script>
	 <script src="../js/i18n/grid.locale-es.js" type="text/javascript"></script>
<script src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>

	 <link rel="stylesheet" type="text/css" href="../themes/css/custom-theme/jquery-ui-1.8.16.custom.css">
	
	<link rel="stylesheet" type="text/css" href="../css/ui.jqgrid.css">
	
   <!-- <link rel="stylesheet" type="text/css" media="screen" href="../themes/ejemplo/themes/ui.multiselect.css" />  -->
   	<link rel="stylesheet" type="text/css" href="../themes/ejemplo/themes/custom-theme/jquery.ui.all.css"> 
 <!--   <link rel="stylesheet" type="text/css" media="screen" href="../themes/ui.multiselect.css" /> --> 
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
	left: 710px;
	top: 861px;
}
    #Layer3 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:3;
	left: 964px;
	top: 684px;
}
    #Layer4 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:4;
	left: 42px;
	top: 860px;
}
#frecuencia{
display: none;
}


	#confirmar_baja{
display: none;
}

#asigna_movil{
display: none;
}
#apropiacion{
display: none;
}
#servauto{
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
	width:920px;
	height:210px;
	z-index:5;
	left: 47px;
	top: 228px;
	 overflow-x:hidden; overflow-y:auto;
}
    #Layer6 {
	position:absolute;
	width:920px;
	height:400px;
	z-index:6;
	left: 42px;
	top: 440px;
	
    /* background-color:#F2F2F2; overflow:scroll;*/
     
	 overflow-x:hidden; overflow-y: auto ;
}

    #Layer7 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:13;
	left: 965px;
	top: 456px;
}
    #Layer8 {
	position:absolute;
	width:660px;
	height:170px;
	z-index:8;
	left: 303px;
	top: 73px;
}
    #Layer9 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:9;
	left: 1106px;
	top: 422px;
}

    #Layer1 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:10;
	left: 48px;
	top: 78px;
}
    #Layer10 {
	position:absolute;
	width:200px;
	height:61px;
	z-index:11;
	left: 965px;
	top: 73px;
}

    #Layer11 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:14;
	left: 966px;
	top: 153px;
}
    #Layer12 {
	position:absolute;
	width:470px;
	height:66px;
	z-index:15;
	top: 0px;
}
    </style>	
</head>

<body onload="ubicafoco()">
<div id="Layer12">

</div>
<div  id="login1">login: [ <?php echo $_SESSION['login'];  ?>]</div>
<div id="Layer1">
  <table align="center" id="crudac"  >
<tr><td>&nbsp;</td></tr></table>
<div id="pcrudac" align="center"></div>
</div>

<div align="right"><span class="Estilo2"><a href="../login/index2.php" class="ui-state-hover">Volver al Men&uacute </a></span></div>

<!--<span class="Estilo1">Moviles Inhabilitados</span> -->
    

  <div id="Layer2"> 
  <table align="center" id="crud"  >
<tr><td>&nbsp;</td></tr></table>
<div id="pcrud" align="center"></div>
</div>
</div>
<!-- -->
<!--<span class="Estilo1">Moviles en Convenio </span> -->

<div id="Layer6">
  <!--<table align="center" id="crudsasig"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudsasig" align="center"></div> -->
</div>
<div id="Layer3">
  <table align="center" id="crudsus"  >
<tr><td>&nbsp;</td></tr></table>
<div id="pcrudsus" align="center"></div>
</div>
<div id="Layer10">

  <table width="201" border="1" class="ui-corner-all">
  <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top ">
    <td width="49" style="font-size:14px"  >Movil</td>
    <td width="136"  style="font-size:14px" ><div align="center">8-66</div></td>
  </tr>
  <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top ">
 <td> <input name="id_movil105" type="text" class="ui-corner-all" id="id_movil105" size="5" maxlength="5"  /></td>
    <td> <textarea name="msj105" rows="1" class="ui-corner-all" id="msj105" onkeypress="Entrar105(event);"></textarea></td>
	</tr>
 </table> 

</div>
<div id="pcrudcon" align="center"></div>

<!--<div id="Layer9">
  <table align="center" id="crudcon"  >
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
  
</div> -->
<div id="Layer4">
  <table align="center" id="crudfre"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudfre" align="center"></div></div>
<!--<span class="Estilo1">Moviles Habilitados</span> -->
<div id="frecuencia" title="Dar Frecuencia a Movil"></div>
<div id="bfrecuencia" title="Bajar Movil de Frecuencia "></div>



<div id="Layer7">
  <table align="center" id="crudnov"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudnov" align="center"></div>
</div>

<input type="hidden" name="id_servicio" id="id_servicio" />
<div id="Layer5"> 
 <!--<table align="center" id="crudradio"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudradio" align="center"></div> -->
</div>


<div id="confirmar_baja" title="Bajar Movil de Frecuencia">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta Segur@ de Bajar Este Movil de Frecuencia?</p>
</div>
<div id="confirm_susp" title="Suspender Movil 8-51">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta Segur@ de Suspender Temporalmente (8-51) el Movil?</p>
</div>

<div id="confirm_1015" title="Reporte Movil 8-25">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta Segur@ de Reportar (8-25) al Movil?</p>
</div>

<div id="suspende" title="Suspender Movil 8-51">
	
</div>
<div id="accidente" title="Movil 8-25">
	
</div>
<div id="descarte" title="Descartar El Servicio">
	
</div> 
<input type="hidden" name="id_mov" id="id_mov" />
<div id="Layer8">
  <table width="660" border="1" class="ui-corner-all">
  <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top ">
    <td width="144" style="font-size:14px"  >Puntos</td>
    <td width="290"  style="font-size:14px" >Celulares</td>
	<td width="195" style="font-size:14px" >Fijo</td>
  </tr>
  <tr class="ui-corner-all ">
    <td><select id="pto_radio" name="pto_radio" onchange="carga_pto(this.value);dir_pto(this.value);ubicafoco()" class="ui-corner-all" >
	<option value="" selected="selected">Seleccione Pto</option>
	<?php
	$link=conectarse();
	$conpto=mysql_query("select * from linea_atencion where id_tipo_linea=3 and estado='activo' order by linea");
	while($fila_pto=mysql_fetch_array($conpto)){
	?>
	<option value="<?php echo $fila_pto[linea] ?>"><?php echo $fila_pto[linea] ?></option>
	<?php
	}
	?>
	</select></td>
    <td><?php
	$conpto=mysql_query("select * from linea_atencion where id_tipo_linea=2");
	while($fila_pto=mysql_fetch_array($conpto)){
	?>
	<input type="button" value="<?php echo $fila_pto[linea] ?>" class="ui-corner-all" onclick="carga_pto(this.value)" />
	
	<?php
	}
	?>
	</td>
	<td><?php
	$conpto=mysql_query("select * from linea_atencion where id_tipo_linea=1");
	while($fila_pto=mysql_fetch_array($conpto)){
	?>
	<input type="button" value="<?php echo $fila_pto[linea] ?>" class="ui-corner-all" onclick="carga_pto(this.value)" />
	
	<?php
	}
	?></td>
  </tr>
  <tr class="ui-widget-header ui-corner-all">
    <td height="24" style="font-size:14px" >Tel&eacute;fono</td>
    <td style="font-size:14px" >Direcci&oacute;n</td>
	<td style="font-size:14px" >Detalle del Servicio </td>
  </tr>
  <tr>
    <td><input type="text" tabindex="4" id="tele" name="tele" class="ui-corner-all" /></td>
    <td><input name="direcci" tabindex="1" type="text" class="ui-corner-all" id="direcci" size="30" maxlength="50" onkeypress="Entrar(event);" /></td>
	<td><textarea name="detall" tabindex="2" rows="1" class="ui-corner-all" id="detall" onkeypress="Entrar(event);"></textarea>
	<input type="hidden" id="linea_at" name="linea_at"  value="FIJOS"/></td>
  </tr>
   <tr>
    <td colspan="2"><div align="center">
     <button  type="button"  class="ui-corner-all "  onclick="grabar_ser('graba_ser')"  accesskey="g" /><u>G</u>rabar</button>
    </div></td>
	<td style="font-size:14px" colspan="1" id="linea_servi" >FIJOS</td>
  </tr>
</table>

<div id="graba_ser"></div>
<div id="asigna_movil">
 <table width="275" border="1" class="ui-corner-all">
  <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top ">
  
    <td width="144" style="font-size:14px"  >Direcci&oacute;n</td>
	 </tr>
	  <tr class="ui-corner-all ">
  
    <td width="144" style="font-size:14px"  ><input type="text" id="dir_serv" /></td>
	 </tr>
	 <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top ">
    <td width="251"  style="font-size:14px" >Detalle</td>
	 </tr>
	   <tr class="ui-corner-all ">
  
         <td width="144" style="font-size:14px"  ><input name="datalle_serv" type="text" id="datalle_serv" /></td>
	   </tr>
	 <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top ">
	<td width="192" style="font-size:14px" >Movil</td>
  </tr>
    <tr class="ui-corner-all ">
  
    <td width="144" style="font-size:14px"  ><input type="text" id="movil_ser" /></td>
	 </tr>
	  <tr class="ui-corner-all ">
  
    <td width="144" style="font-size:14px"  > <button  type="button"  class="ui-corner-all "  onclick="grabar_ser1('graba_ser')"  accesskey="g" /><u>G</u>rabar</button></td>
	 </tr>
	 
	 
</table>
</div>
</div>



<div id="Layer11">
  <table align="center" id="crud105"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrud105" align="center"></div></div>
<div id="grabamsj"></div>

<div id="apropiacion" >
<table width="230" border="1" class="ui-corner-all">
  
  <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top ">
    <td width="100%" style="font-size:14px"  ><div align="center">Apropiaci&oacute;n de Servicio</div></td>
   </tr>
  <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top ">
  
    <td width="100%" style="font-size:14px"  ><div align="center">Movil</div></td>
    </tr>
	  <tr class="ui-corner-all ">
  
    <td width="100%" style="font-size:14px"  ><div align="center">
      <input type="text" id="id_movil_nov" size="5" maxlength="5" onkeypress="Entrarap(event);" />
	  <input type="hidden" id="id_servi" size="5" maxlength="5" />
    </div></td>
	 </tr>

	 
</table>	 

</div>
<div id="servauto" >
<table width="230" border="1" class="ui-corner-all">
  
  <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top ">
    <td width="100%" style="font-size:14px"  ><div align="center">Autorizaci&oacute;n de Servicio</div></td>
   </tr>
  <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top ">
  
    <td width="100%" style="font-size:14px"  ><div align="center">Movil</div></td>
    </tr>
	  <tr class="ui-corner-all ">
  
    <td width="100%" style="font-size:14px"  ><div align="center">
      <input type="text" id="id_movil_auto" size="5" maxlength="5" onkeypress="bajafoco(event);" />
	  <input type="hidden" id="idser" size="5" maxlength="5" />
    </div></td>
	 </tr>
	  <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top ">
  
    <td width="100%" style="font-size:14px"  ><div align="center">Observaci&oacute;n Obligatoria</div></td>
    </tr>
	  <tr class="ui-corner-all ">
<td width="100%" style="font-size:14px"  ><div align="center">
     <input id="observauto" onkeypress="Entrarauto(event);"/>
    </div></td>
	 </tr>
	 
</table>	 

</div>
</body>
</html>
