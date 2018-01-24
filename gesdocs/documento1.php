<?php
session_start();
 include('../inc/libreria.php');
 include('../inc/operaciones.php');
 
 if(!valida_usr(5)){
 
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
    <!--<script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script> -->
	<script  src="../themes/js/jquery-1.6.2.min.js"></script> 
	<script  src="../themes/js/jquery-ui-1.8.16.custom.min.js"></script> 
<script  src="../js/jquery-ui-timepicker-addon.js"></script>
<script  src="../themes/ejemplo/ui/jquery.ui.slider.js"></script>
<script  src="../js/timepicker_slider_access.js"></script>
    <script src="../js/i18n/grid.locale-es.js" type="text/javascript"></script>
	<script src="../src/jqDnR.js" type="text/javascript"></script>
	
	<script src="../src/jqModal.js" type="text/javascript"></script>
		<!--<script src="../themes/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../themes/development-bundle/ui/jquery.ui.widget.js"></script>--> 
	<!--<script src="../themes/ejemplo/ui/jquery.ui.datepicker.js"></script>  -->
	<!--<script src="../themes/development-bundle/ui/jquery.ui.dialog.js"></script>  -->
	<script src="../themes/ejemplo/ui/i18n/jquery.ui.datepicker-es.js"></script>
	    <script src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>
	    <script type="text/javascript">
  /*  $.jgrid.no_legacy_api = true;
    $.jgrid.useJSON = true;*/
     jQuery.noConflict();

	jQuery(document).ready(function(){ 
	
	//EFECTO DE OCULTAR DIVS
	jQuery("#trigger").click(function(event) {
event.preventDefault();
jQuery("#box").slideToggle();
});
 
jQuery("#box a").click(function(event) {
event.preventDefault();
//jQuery("#box").slideUp();
});

jQuery("#trigger").click(function(event) {
event.preventDefault();
jQuery("#tc").slideToggle();
});
 
jQuery("#tc a").click(function(event) {
event.preventDefault();
//jQuery("#box").slideUp();
});
/////reporte de pago de diarios
jQuery("#crudnov").jqGrid({ 

     url:'gridreportediario.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['','Movil','Novedad','Pago Hasta']
	, colModel :[
	{
	name:'id_nov'
		,index:'id_nov'
		,width:35
		,hidden:true
		,editable:false	
		,search:true
	},{name:'id_movil'
		,index:'id_movil'
		,width:40
		,align:'center'
		,editable:false	
		,search:true
	},{
	name:'novedad'
		,index:'novedad'
		,width:80
		//,align:'right'
		,editable:false	
		},{name:'fecha'
		,index:'fecha'
		,width:75
		,align:'center'
		,editable:false	
	//	,search:true
		
	}
	],
	   
	  // pager: jQuery('#pcrudoc'),
	   //pager: jQuery('#pcrudnov'),
    rowNum:5,
    //rowList:[10,20,30],
	height:'auto',
	width:'auto',
    sortname: 'id_nov',
    sortorder: "desc",
    viewrecords: true,
     caption: 'Pago de Diarios',
	 
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		 
		 
		 
	loadComplete:function(){
	    
		setTimeout(function(){jQuery('#crudnov').trigger('reloadGrid')},30000)
		
	},
	    editurl: 'gridreportediario.php?q=1'// this is dummy existing url 
		
		 });
		  jQuery("#crudnov").jqGrid('navGrid','#pcrudnov',{edit:false,add:false,del:false,searchtext:'Busqueda'},{height:400,reloadAfterSubmit:true,closeAfterEdit : true},{closeOnEscape:true},{closeOnEscape:true},{sopt:['cn','bw','eq','ne','lt','gt','ew','le','ge']});
	


////grilla principal
	var mygrid = jQuery("#crud").jqGrid({
	 url:'gridocs.php',
	 datatype: "json", 
	  mtype: 'POST',
	  colNames:['Codigo','Cedula','','','','','Eps-Lic.','Simit','','',]
	  , colModel :[
	 	  
	  {
		name:'id_conductor'
		,index:'id_conductor'
		,width:55
		,align:'center'
		,search:false
	},{
		name:'codigo'
		,index:'codigo'
		,width:80
		,editable:true
		,editrules:{required:true}
		,align:'center'
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
		name:'nombre1'
		,index:'nombre1'
		,width:70
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
	name:'nombre2'
		,index:'nombre2'
		,width:70
		//,align:'right'
		,editable:true
		//,edittype:'select'
		//,editoptions:{value:"1:Si;0:No"}  Name:Value;Name:Value 
		//,searchoptions:{dataInit:function(el){jQuery(el).autocomplete({
//			source: "busca_condu.php",
//			 select: function(event, ui) {
//                  }
//		});} }
	},{
		name:'apellido1'
		,index:'apellido1'
		,width:70
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
		,width:70
		//,align:'right'
		,editable:true
		,searchoptions:{dataInit:function(el){jQuery(el).autocomplete({
			source: "busca_condu_ap2.php",
			 select: function(event, ui) {
                  }
		});} }
	}
	 ,{name:'act',index:'act',align:'center', width:85,sortable:false,search:false}
	 ,{name:'parte',index:'parte',align:'center', width:110,sortable:false,search:false}
	  ,{name:'tarj',index:'tarj',align:'center', width:60,sortable:false,search:false},
	  {name:'ntarj',index:'ntarj',align:'center', width:60,sortable:false,search:false},
	],
	   
	   pager: jQuery('#pcrud'),
    rowNum:7,
    rowList:[10,20,30],
	height:'auto',
	width:'auto',
	//toolbar : [true,"top"],
    sortname: 'id_conductor',
    sortorder: "asc",
    viewrecords: true,
     caption: 'Conductores',
     gridview:true,
	 rownumbers: true,
	 
	 onSelectRow:
	 	function(ids) {
		
		var datoscon = jQuery(this).getRowData(ids);
		  var nom= datoscon['nombre1']+datoscon['nombre2']+'  '+datoscon['apellido1']+datoscon['apellido2'];
		 if(ids == null) { 
		 ids=0; 
		 if(jQuery('#crudoc').jqGrid('getGridParam','records') >0 ) {
		 jQuery('#crudoc').jqGrid('setGridParam',{url:'subgrid.php?q=1&id='+ids,page:1});
		 jQuery('#crudoc').jqGrid('setCaption','Detalle de documentos para el conductor: '+nom) .trigger('reloadGrid');
		 ///////ppara subgrid de tarjetas
		 
		 jQuery('#crudtc').jqGrid('setGridParam',{url:'subgridtc.php?q=1&id='+ids,page:1});
		 jQuery('#crudtc').jqGrid('setCaption','Detalle de tarjetas de control para el conductor: '+nom) .trigger('reloadGrid'); 
		//////grid para comparendos
		
		  jQuery('#crudsim').jqGrid('setGridParam',{url:'subgridparte.php?q=1&id='+ids,page:1});
		 jQuery('#crudsim').jqGrid('setCaption','Detalle de Comparendo para el conductor: '+nom) .trigger('reloadGrid'); 
		  }
	}else { 
	jQuery('#crudoc').jqGrid('setGridParam',{url:'subgrid.php?q=1&id='+ids,page:1});
	jQuery('#crudoc').jqGrid('setCaption','Detalle de documentos para el conductor: '+nom) .trigger('reloadGrid');
	//jQuery('#box').slideToggle(); para subgrid de tarjetas
	jQuery('#crudtc').jqGrid('setGridParam',{url:'subgridtc.php?q=1&id='+ids,page:1});
	jQuery('#crudtc').jqGrid('setCaption','Detalle de tarjetas de control para el conductor: '+nom) .trigger('reloadGrid');
	
	//////grid para comparendos
		
		  jQuery('#crudsim').jqGrid('setGridParam',{url:'subgridparte.php?q=1&id='+ids,page:1});
		 jQuery('#crudsim').jqGrid('setCaption','Detalle de Comparendo para el conductor: '+nom) .trigger('reloadGrid'); 
	 } 
	 }
			
	 
	 
	 , postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl+"); 
	///agregar botones de accion
		loadComplete: function(){
		var ids = jQuery("#crud").getDataIDs();
		for(var i=0;i<ids.length;i++){
			var cl = ids[i];
			 var rowData = jQuery(this).getRowData(cl); 
                  var id_cond= rowData['id_conductor'];//replace name with you 
	be = "<input style='height:22px;width:75px;' type='button' value='VER Y ACT' onclick=jQuery('#box').slideToggle(); />";
	simit = "<input style='height:22px;' type='button' value='VER' onclick=jQuery('#parte').slideToggle(); />";
	nsimit = "<input style='height:22px;' type='button' value='REG.' onclick=abreparte("+id_cond+");jQuery('#regsimit').dialog('open'); />";
	ta = "<input style='height:22px;width:60px;' type='button' value='VER T.C.' onclick=jQuery('#tc').slideToggle(); />";
	nta = "<input style='height:22px;width:50px;' type='button' value='NUEVA' onclick=abretarjetan("+id_cond+");jQuery('#ntarjetao').dialog('open'); />";
	
	//jQuery('#list10_d').jqGrid('setGridParam',{url:'subgrid.php?q=1&id=2',page:1}); jQuery('#list10_d').jqGrid('setCaption','Invoice Detail: 2') .trigger('reloadGrid')+"/>"; 
			
			
			//jQuery('#crud').editRow("+cl+"); />"; 
			//se = "<a href='#' id='trigger'>TRIGGER</a>"; 
			//ce = "<input style='height:22px;width:20px;' type='button' value='C' onclick=jQuery('#crud').restoreRow("+cl+"); />"; 
			jQuery("#crud").setRowData(ids[i],{act:be})
			jQuery("#crud").setRowData(ids[i],{parte:simit+nsimit})
			jQuery("#crud").setRowData(ids[i],{tarj:ta})
			jQuery("#crud").setRowData(ids[i],{ntarj:nta})
		}	
	},
	    editurl: 'gridocs.php'// this is dummy existing url 
		
		 });
		 
		// var verdadero= true
		 
		 jQuery("#crud").jqGrid('navGrid','#pcrud',{edit:false,add:false,del:false,search:false,refresh:false},{height:400,reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true});

        
//jQuery("#crud").jqGrid('filterGrid',"crud", { gridModel:true, gridNames:true, formtype:"vertical", enableSearch:true, enableClear:false, autosearch: false, afterSearch : function() { } } );

////		 
		 
		 //////configurar colspan de la cabezera
		 
		 jQuery("#crud").jqGrid('setGroupHeaders', { useColSpanStyle: true, groupHeaders:[ {startColumnName: 'nombre1', numberOfColumns: 2, titleText: '<em>Nombres</em>'}, {startColumnName: 'apellido1', numberOfColumns: 2, titleText: 'Apellidos'}, {startColumnName: 'act', numberOfColumns: 2, titleText: 'Documentos'}, {startColumnName: 'tarj', numberOfColumns: 2, titleText: 'Tarjeta Ctrl'}	 ] });
//	
jQuery("#crud").jqGrid('navButtonAdd',"#pcrud",{caption:"Buscar",title:"Barra de Busqueda", buttonicon :'ui-icon-pin-s', onClickButton:function(){ mygrid[0].toggleToolbar() } });
 jQuery("#crud").jqGrid('navButtonAdd',"#pcrud",{caption:"Limpiar",title:"Limpiar Busqueda",buttonicon :'ui-icon-refresh', onClickButton:function(){ mygrid[0].clearToolbar() } });
  jQuery("#crud").jqGrid('filterToolbar');
  
  		 function pickdates(id){
	  jQuery('#pcrud').datepicker({dateFormat:'yy-mm-dd'});
}
////subgrid detalle de documentos

jQuery("#crudoc").jqGrid({ 

     url:'subgrid.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['Codigo','Documento','Fecha','Actualizar Docs','','',]
	  , colModel :[
	{name:'codigo'
		,index:'codigo'
		,width:80
		//,align:'right'
		,editable:false	
	},{
	name:'documento'
		,index:'documento'
		,width:330
		//,align:'right'
		,editable:false	
	},{
	
		name:'fecha_vence'
		,index:'fecha_vence'
		,width:100
		,editable:true
		,editrules:{required:true}
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
		
	
	}
	,{name:'actu',index:'actu',align:'center', width:120,sortable:false},
	{
	  name:'condu'
		,index:'condu'
		,width:55
		,align:'center'
		,hidden:true
	},
	{
	  name:'doc'
		,index:'doc'
		,width:55
		,align:'center'
		,hidden:true
	},
	],
	   
	  // pager: jQuery('#pcrudoc'),
    rowNum:5,
    //rowList:[10,20,30],
	height:'auto',
	width:500,
    sortname: 'codigo',
    sortorder: "asc",
    viewrecords: true,
     caption: 'Documentos del conductor',
	 
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl+"); 
	loadComplete: function(){
		var ids = jQuery("#crudoc").getDataIDs();
  			
			
			//record=jQuery("#crudoc").jqGrid('getRowData',ids).codigo;
		 // jQuery("#crudoc").jqGrid('getRowData',ids);	       
		for(var i=0;i<ids.length;i++){
		   //  var dato = record[i];
			var cl = ids[i];
			
			 var rowData = jQuery(this).getRowData(cl); 
                  var temp= rowData['condu'];//replace name with you 
				  var doc= rowData['doc'];
				 // alert(temp);	
			
	be = "<input  type='button' value='Actualiza' onclick=abre("+i+");jQuery('#actualiza').slideToggle();jQuery('#actualiza').dialog('open'); />";
	
			se = "<input  id='codigo"+i+"' type='hidden' value="+cl+" />"; 
			co = "<input  id='condu"+i+"' type='hidden' value="+temp+" />"; 
			docu = "<input  id='doc"+i+"' type='hidden' value="+doc+" />"; 
			jQuery("#crudoc").setRowData(ids[i],{actu:be+se+co+docu})
		}	
	},
	
	    editurl: 'subgrid.php?q=1'// this is dummy existing url 
		
		 });
		 
////subgrid detalle de tarjetas de control

var mygrid1 =jQuery("#crudtc").jqGrid({ 

     url:'subgridtc.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['','Codigo','Tarjeta','Conductor','Movil','Vigencia','Elab','Estado','','Fec Corte','Estado Vg','','','Operaciones']
	  , colModel :[
	{
	name:'id_conductor'
		,index:'id_conductor'
		,width:40
		//,align:'right'
		,editable:false	
		,search:false
	},{name:'id_tarjeta'
		,index:'id_tarjeta'
		,width:40
		//,align:'right'
		,editable:false	
		,search:false
	},{
	name:'tarjeta'
		,index:'tarjeta'
		,width:55
		//,align:'right'
		,editable:false	
		
	},{
	
		name:'codigo'
		,index:'codigo'
		,width:70
		,editable:true
		,search:false
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
		name:'id_movil'
		,index:'id_movil'
		,align:'center'
		, width:35
		,search:false
		/*,searchoptions:{dataInit:function(el){jQuery(el).autocomplete({
			source: "selecmovil.php",
			 select: function(event, ui) {
                  }
		});} }*/
	},{
	  name:'fecha_vigencia'
		,index:'fecha_vigencia'
		,width:70
		,search:false
		//,align:'center'
		//,hidden:true
	},{
	  name:'fecha_elab'
		,index:'fecha_elab'
		,width:75
		//,align:'center'
		//,hidden:true
		,search:false	
	},{
	  name:'estado'
		,index:'estado'
		,width:50
		,align:'center'
		,search:false
		//,hidden:true
		
	},{ name:'id_conductor'
		,index:'id_conductor'
		,width:55
		,align:'center'
		,hidden:true
		,search:false
		},{ name:'fecha_plazo_a'
		,index:'fecha_plazo_a'
		,width:130
		
		,formatter:'date', formatoptions:{srcformat:"Y-m-d H:i",newformat:"d-M-Y h:i a"}
		
		,search:false
		},{
		  name:'est_vig'
		,index:'est_vig'
		,width:75
		,align:'center'
		,search:false
		//,hidden:true
	},{name:'planillas_mes',index:'planillas_mes',align:'center',hidden:true
	},{name:'total',index:'total',align:'center',hidden:true	
	},{ 
		name:'oper',index:'oper',align:'center', width:310,sortable:false,search:false
	
	}
	],
	   
	  // pager: jQuery('#pcrudoc'),
	  pager: jQuery('#pcrudtc'),
    rowNum:15,
    //rowList:[10,20,30],
	height:'auto',
	width:'auto',
    sortname: 'id_tarjeta',
    sortorder: "desc",
    viewrecords: true,
     caption: 'Planillas de Control',
	 onSelectRow:
	 	function(ids) {
		
		var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		  var  fhoy = new Date();
			  mes = meses[fhoy.getMonth()]
			  //mes = fecha_vig.substring(0,6);	
			    anio = fhoy.getFullYear(); 
		 var datos = jQuery(this).getRowData(ids);
		  var movil= datos['id_movil'];
		   var idcond= datos['id_conductor'];
		    var codi= datos['codigo'];
		 if(ids == null) { 
		 ids=0; 
		 if(jQuery('#crudplan').jqGrid('getGridParam','records') >0 ) {
		 jQuery('#crudplan').jqGrid('setGridParam',{url:'subgridplan.php?q=1&id='+movil,page:1});
		 jQuery('#crudplan').jqGrid('setCaption','Detalle de Planillas del Movil: '+movil+'Para el mes de '+mes+' de '+anio) .trigger('reloadGrid');
		 ///////ppara subgrid de tarjetas
		
		  }
	}else { 
	jQuery('#crudplan').jqGrid('setGridParam',{url:'subgridplan.php?q=1&id='+movil,page:1});
	jQuery('#crudplan').jqGrid('setCaption','Detalle de Planillas del Movil: '+movil+'Para el mes de '+mes+' de '+anio) .trigger('reloadGrid');
	jQuery('#gridplanilla').slideToggle(); 
	jQuery('#crudplancon').jqGrid('setGridParam',{url:'subgridplancondu.php?q=1&id='+idcond+'&id_movil='+movil,page:1});
	jQuery('#crudplancon').jqGrid('setCaption','Detalle de Planillas del Conductor : '+codi+' En otros Moviles Para el mes de '+mes+' de '+anio) .trigger('reloadGrid');
	jQuery('#gridplanillacond').slideToggle(); 
	//para subgrid de tarjetas
	
	 } 
	 } 
	 ,postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl+"); 
	loadComplete: function(){
		var ids = jQuery("#crudtc").getDataIDs();
  			
			
			//record=jQuery("#crudoc").jqGrid('getRowData',ids).codigo;
		 // jQuery("#crudoc").jqGrid('getRowData',ids);	       
		for(var i=0;i<ids.length;i++){
		   //  var dato = record[i];
			var cl = ids[i];
			
			 var rowData = jQuery(this).getRowData(cl);
			  var idconductor= rowData['id_conductor']; 
                  var id_tarj= rowData['id_tarjeta'];
				  var ntarj= rowData['tarjeta'];
				  var est= rowData['estado'];
				   var vig= rowData['fecha_plazo_a'];
				   var nplanilla= rowData['planillas_mes'];
				   var tot= rowData['total'];
				   if (tot>=nplanilla){
				   	var control_p=1;		   
				   }else {
				    var control_p=0;	
				   }
				  if (est=='Abierta'){var estado="";
				  }else{
				estado="disabled=disabled";
				  }
				  
				  //replace name with you 
				 // var doc= rowData['doc'];
				 // alert(doc);	
			
	be = "<input  type='button' value='Actualiza' "+estado+"  onclick=abre_actu_tarjeta("+i+");jQuery('#actualizatc').slideToggle();jQuery('#actualizatc').dialog('open'); />";
	ver = "<input  type='button' value='Movimiento' onclick=abre_movi("+i+");jQuery('#veractualizatc').slideToggle();jQuery('#veractualizatc').dialog('open');j />";
	cer = "<input  type='button' value='Cerrar' "+estado+" onclick=cerrar("+i+");jQuery('#cerrar').slideToggle();jQuery('#cerrar').dialog('open'); />";
	autor = "<input  type='button' value='Autoriza' "+estado+" onclick=autoriza("+i+");jQuery('#autorizatc').slideToggle();jQuery('#autorizatc').dialog('open') />";
	//plani = "<input  type='button' value='Planilla' "+estado+" onclick=abre_planilla("+i+","+control_p+");jQuery('#planillas').slideToggle();jQuery('#planillas').dialog('open') />";
	         condoc = "<input  id='con_doc"+i+"' type='hidden' value="+idconductor+" />";
			fe = "<input  id='fvige"+i+"' type='hidden' value="+vig+" />"; 
			
			co = "<input  id='idtarj"+i+"' type='hidden' value="+id_tarj+" />"; 
			ntarj = "<input  id='ntarj"+i+"' type='hidden' value="+ntarj+" />";
			
			//docu = "<input  id='doc"+i+"' type='hidden' value="+doc+" />"; +se+co+docu
			jQuery("#crudtc").setRowData(ids[i],{oper:be+fe+co+ver+cer+ntarj+condoc+autor})
			//jQuery("#crudtc").setRowData(ids[i],{doc:ntarj1})
		}	
	},
	
	    editurl: 'subgridtc.php?q=1'// this is dummy existing url 
		
		 });
		  jQuery("#crudtc").jqGrid('navGrid','#pcrudtc',{edit:false,add:false,del:false,searchtext:'Busqueda'},{height:400,reloadAfterSubmit:true,closeAfterEdit : true},{closeOnEscape:true},{closeOnEscape:true},{sopt:['cn','bw','eq','ne','lt','gt','ew','le','ge']});
		  
		  jQuery("#crudtc").jqGrid('navButtonAdd',"#pcrudtc",{caption:"Buscar",title:"Barra de Busqueda", buttonicon :'ui-icon-pin-s', onClickButton:function(){ mygrid1[0].toggleToolbar() } });
 jQuery("#crudtc").jqGrid('navButtonAdd',"#pcrudtc",{caption:"Limpiar",title:"Limpiar Busqueda",buttonicon :'ui-icon-refresh', onClickButton:function(){ mygrid1[0].clearToolbar() } });
  jQuery("#crudtc").jqGrid('filterToolbar');
/////////////////////funcion para el calendario		 
		 
	jQuery( "#date1" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,
		});	
		
//////grilla de planillas



var mygridpla =jQuery("#crudplan").jqGrid({ 

     url:'subgridplan.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['Codigo','Nro Planilla','Fecha Elab','Movil','Destino','Fecha Sal','Fecha Ret','Fecha Entrega','Estado','Observacion','Operaciones']
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
		
		},{ name:'observacion'
		,index:'observacion'
		,width:75
		,align:'center'
		//,hidden:true
		,search:false
		
	},{name:'accion',index:'accion',align:'center', width:130,sortable:false,search:false	
		
	}
	],
	   
	  // pager: jQuery('#pcrudoc'),
	  pager: jQuery('#pcrudplan'),
    rowNum:5,
    //rowList:[10,20,30],
	height:'auto',
	width:'auto',
    sortname: 'id_planilla',
    sortorder: "desc",
    viewrecords: true,
     caption: 'Planillas de Control',
	 
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl+"); 
	loadComplete: function(){
	setTimeout(function(){jQuery('#crudplan').trigger('reloadGrid')},30000)
		var ids = jQuery("#crudplan").getDataIDs();
  			
			
			//record=jQuery("#crudoc").jqGrid('getRowData',ids).codigo;
		 // jQuery("#crudoc").jqGrid('getRowData',ids);	       
		for(var i=0;i<ids.length;i++){
		   //  var dato = record[i];
			var cl = ids[i];
			
			 var rowData = jQuery(this).getRowData(cl);
			  var obser= rowData['observacion']; 
                  var id_plani= rowData['id_planilla'];
				 var n_plan= rowData['n_planilla'];
				   var esta= rowData['estado'];
				  /* var vig= rowData['fecha_plazo_a'];
				   var nplanilla= rowData['planillas_mes'];
				   var tot= rowData['total'];*/
				  
				  //replace name with you 
				 // var doc= rowData['doc'];
				 // alert(doc);	
				  if (esta=='En Circulacion'){var estadop="";
				  }else{
				estadop="disabled=disabled";
				  }
				   if (obser=='Retrazada'){
			  jQuery("#crudplan").setRowData(rowData.id_planilla,{observacion:"<font color='red'>Sin Devolver</font>"}) 
			 }
			
	re = "<input  type='button' value='Recibir' "+estadop+"  onclick=recibir_planilla("+i+");jQuery('#recibe_planilla').dialog('open'); />";
	//anu = "<input  type='button' value='Anular' "+estadop+" onclick=anula_planilla("+i+");jQuery('#anula_planilla').dialog('open'); />";
	//des = "<input  type='button' value='Descartar' "+estadop+" onclick=descarta_planilla("+i+");jQuery('#descarta_planilla').dialog('open'); />";
/*	autor = "<input  type='button' value='Autoriza' "+estado+" onclick=autoriza("+i+");jQuery('#autorizatc').slideToggle();jQuery('#autorizatc').dialog('open') />";
		plani = "<input  type='button' value='Planilla' "+estado+" onclick=abre_planilla("+i+","+control_p+");jQuery('#planillas').slideToggle();jQuery('#planillas').dialog('open') />";
	      */   idplanilla = "<input  id='id_plan"+i+"' type='hidden' value="+id_plani+" />";
			numplani = "<input  id='n_plani"+i+"' type='hidden' value="+n_plan+" />"; 
			
			//co = "<input  id='idtarj"+i+"' type='hidden' value="+id_tarj+" />"; 
			//ntarj = "<input  id='ntarj"+i+"' type='hidden' value="+ntarj+" />";
		
			//docu = "<input  id='doc"+i+"' type='hidden' value="+doc+" />"; +se+co+docu
			//jQuery("#crudplan").setRowData(ids[i],{oper:be+fe+co+ver+cer+ntarj+condoc+autor+plani})
			jQuery("#crudplan").setRowData(ids[i],{accion:re+idplanilla+numplani})
		}	
	},
	
	    editurl: 'subgridplan.php?q=1'// this is dummy existing url 
		
		 });
		  jQuery("#crudplan").jqGrid('navGrid','#pcrudplan',{edit:false,add:false,del:false,searchtext:'Busqueda'},{height:400,reloadAfterSubmit:true,closeAfterEdit : true},{closeOnEscape:true},{closeOnEscape:true},{sopt:['cn','bw','eq','ne','lt','gt','ew','le','ge']});
		  
		  jQuery("#crudplan").jqGrid('navButtonAdd',"#pcrudplan",{caption:"Buscar",title:"Barra de Busqueda", buttonicon :'ui-icon-pin-s', onClickButton:function(){ mygridpla[0].toggleToolbar() } });
 jQuery("#crudplan").jqGrid('navButtonAdd',"#pcrudplan",{caption:"Limpiar",title:"Limpiar Busqueda",buttonicon :'ui-icon-refresh', onClickButton:function(){ mygridpla[0].clearToolbar() } });
  jQuery("#crudplan").jqGrid('filterToolbar');		
		
		
		
		
		
		
//////grilla de planillas x conductor



var mygridpla =jQuery("#crudplancon").jqGrid({ 

     url:'subgridplancondu.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['Codigo','Nro Planilla','Fecha Elab','Movil','Destino','Fecha Sal','Fecha Ret','Fecha Entrega','Estado','Observacion','Operaciones']
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
		
		},{ name:'observacion'
		,index:'observacion'
		,width:75
		,align:'center'
		//,hidden:true
		,search:false
		
	},{name:'accion',index:'accion',align:'center', width:130,sortable:false,search:false	
		
	}
	],
	   
	  // pager: jQuery('#pcrudoc'),
	  pager: jQuery('#pcrudplancon'),
    rowNum:5,
    //rowList:[10,20,30],
	height:'auto',
	width:'auto',
    sortname: 'id_planilla',
    sortorder: "desc",
    viewrecords: true,
     caption: 'Planillas de Control',
	 
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl+"); 
	loadComplete: function(){
	setTimeout(function(){jQuery('#crudplancon').trigger('reloadGrid')},30000)
		var ids = jQuery("#crudplancon").getDataIDs();
  			
			
			//record=jQuery("#crudoc").jqGrid('getRowData',ids).codigo;
		 // jQuery("#crudoc").jqGrid('getRowData',ids);	       
		for(var i=0;i<ids.length;i++){
		   //  var dato = record[i];
			var cl = ids[i];
			
			 var rowData = jQuery(this).getRowData(cl);
			  var obser= rowData['observacion']; 
                  var id_pla= rowData['id_planilla'];
				 var n_plan= rowData['n_planilla'];
				   var esta= rowData['estado'];
				  /* var vig= rowData['fecha_plazo_a'];
				   var nplanilla= rowData['planillas_mes'];
				   var tot= rowData['total'];*/
				  
				  //replace name with you 
				 // var doc= rowData['doc'];
				 // alert(doc);	
				  if (esta=='En Circulacion'){var estadop="";
				  }else{
				estadop="disabled=disabled";
				  }
				   if (obser=='Retrazada'){
			  jQuery("#crudplancon").setRowData(rowData.id_planilla,{observacion:"<font color='red'>Sin Devolver</font>"}) 
			 }
			
	re = "<input  type='button' value='Recibir' "+estadop+"  onclick=recibir_planilla_con("+i+");jQuery('#recibe_planilla').dialog('open'); />";
//	anu = "<input  type='button' value='Anular' "+estadop+" onclick=anula_planilla_con("+i+");jQuery('#anula_planilla').dialog('open'); />";
	des = "<input  type='button' value='Descartar' "+estadop+" onclick=descarta_planilla_con("+i+");jQuery('#descarta_planilla').dialog('open'); />";
/*	autor = "<input  type='button' value='Autoriza' "+estado+" onclick=autoriza("+i+");jQuery('#autorizatc').slideToggle();jQuery('#autorizatc').dialog('open') />";
		plani = "<input  type='button' value='Planilla' "+estado+" onclick=abre_planilla("+i+","+control_p+");jQuery('#planillas').slideToggle();jQuery('#planillas').dialog('open') />";
	      */   idplanilla = "<input  id='id_plan_con"+i+"' type='hidden' value="+id_pla+" />";
			numplani = "<input  id='n_plani_con"+i+"' type='hidden' value="+n_plan+" />"; 
			
			//co = "<input  id='idtarj"+i+"' type='hidden' value="+id_tarj+" />"; 
			//ntarj = "<input  id='ntarj"+i+"' type='hidden' value="+ntarj+" />";
		
			//docu = "<input  id='doc"+i+"' type='hidden' value="+doc+" />"; +se+co+docu
			//jQuery("#crudplancon").setRowData(ids[i],{oper:be+fe+co+ver+cer+ntarj+condoc+autor+plani})
			jQuery("#crudplancon").setRowData(ids[i],{accion:re+des+idplanilla+numplani})
		}	
	},
	
	    editurl: 'subgridplancondu.php?q=1'// this is dummy existing url 
		
		 });
		  jQuery("#crudplancon").jqGrid('navGrid','#pcrudplancon',{edit:false,add:false,del:false,searchtext:'Busqueda'},{height:400,reloadAfterSubmit:true,closeAfterEdit : true},{closeOnEscape:true},{closeOnEscape:true},{sopt:['cn','bw','eq','ne','lt','gt','ew','le','ge']});
		  
		  jQuery("#crudplancon").jqGrid('navButtonAdd',"#pcrudplancon",{caption:"Buscar",title:"Barra de Busqueda", buttonicon :'ui-icon-pin-s', onClickButton:function(){ mygridpla[0].toggleToolbar() } });
 jQuery("#crudplancon").jqGrid('navButtonAdd',"#pcrudplancon",{caption:"Limpiar",title:"Limpiar Busqueda",buttonicon :'ui-icon-refresh', onClickButton:function(){ mygridpla[0].clearToolbar() } });
  jQuery("#crudplancon").jqGrid('filterToolbar');		
		
		
		
		
			
		
////alertas modales 											
jQuery('#actualiza').dialog({autoOpen: false, modal:true,width:600,height:200,}); 
jQuery('#cerrar').dialog({autoOpen: false, modal:true,width:400,height:200,}); 
jQuery('#recibe_planilla').dialog({autoOpen: false, modal:true,width:400,height:270,}); 
jQuery('#cierramultas').dialog({autoOpen: false, modal:true,width:400,height:200,}); 
jQuery('#pagamultas').dialog({autoOpen: false, modal:true,width:600,height:350,}); 
jQuery('#actualizatc').dialog({autoOpen: false, modal:true,width:600,height:800,});
jQuery('#veractualizatc').dialog({autoOpen: false, modal:true,width:800,height:800,});
jQuery('#ntarjetao').dialog({autoOpen: false, modal:true,width:600,height:800,}); 
jQuery('#regsimit').dialog({autoOpen: false, modal:true,width:550,height:450,}); 
jQuery('#autorizatc').dialog({autoOpen: false, modal:true,width:500,height:250,}); 
jQuery('#planillas').dialog({autoOpen: false, modal:true,width:700,height:800,}); 
jQuery('#anula_planilla').dialog({autoOpen: false, modal:true,width:400,height:270,}); 	
jQuery('#descarta_planilla').dialog({autoOpen: false, modal:true,width:400,height:270,});
////subgrid detalle de comparendos

jQuery("#crudsim").jqGrid({ 

     url:'subgridparte.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:[ '','','Documento','# Comp','Infraccion','Entidad','Valor','Fecha','Fecha Pago','Convenio','Estado','Actualizar']
	  , colModel :[
	{name:'id_simit'
		,index:'id_simit'
		,width:55
		,align:'center'
		,search:false
		,hidden:true
	},{	
      	
	name:'id_conductor'
		,index:'id_conductor'
		,width:55
		,align:'center'
		,search:false
		,hidden:true
	},{	
	name:'codigo'
		,index:'codigo'
		,width:80
		//,align:'right'
		,editable:false	
	/*},{
     	name:'nombre1'
		,index:'nombre1'
		,width:70
		//,align:'right'
		,editable:true
	},{
	name:'nombre2'
		,index:'nombre2'
		,width:70
		//,align:'right'
		,editable:true
	},{
		name:'apellido1'
		,index:'apellido1'
		,width:70
	},{
	name:'apellido2'
		,index:'apellido2'
		,width:70*/
	},{	
	name:'n_parte'
		,index:'n_parte'
		,width:80
		//,align:'right'
		,editable:false	
	},{
	name:'cod_infraccion'
		,index:'cod_infraccion'
		,width:70
		//,align:'right'
		,editable:false	
	},{
     	name:'eps'
		,index:'eps'
		,width:100
		//,align:'right'
		,editable:true
	},{
	name:'valor'
		,index:'valor'
		,width:60
		//,align:'right'
		,editable:true
	},{
		name:'fecha_parte'
		,index:'fecha_parte'
		,width:75
	},{
	name:'fecha_pago'
		,index:'fecha_pago'
		,width:75	
	},{
		name:'convenio'
		,index:'convenio'
		,width:75	
	},{
	name:'estado'
		,index:'estado'
		,width:50		
	},{name:'acciones',index:'acciones',align:'center', width:165,sortable:false,search:false
	}
   	],
	   
	   pager: jQuery('#pcrudsim'),
    rowNum:7,
    rowList:[10,20,30],
	height:'auto',
	width:'auto',
	//toolbar : [true,"top"],
    sortname: 'estado',
    sortorder: "asc",
    viewrecords: true,
     caption: 'Detalle de Comparendo',
     gridview:true,
	 rownumbers: true
	 	 , postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl+"); 
	///agregar botones de accion
		loadComplete: function(){
		var idrow = jQuery("#crudsim").getDataIDs();
		for(var i=0;i<idrow.length;i++){
			var valrow = idrow[i];
			 var row = jQuery(this).getRowData(valrow); 
             var idsimi= row['id_simit'];
			
			 var estmulta= row['estado']; 
			   if (estmulta=='Activa'){var estadosimit="";
				  }else{
				estadosimit="disabled=disabled";
				  } 
				  
				  
			   
				  
	actualparte = "<input style='height:22px;' type='button' value='ACTUALIZAR' "+estadosimit+" onclick=pagamulta("+idsimi+");jQuery('#pagamultas').dialog('open') />";
	anulaparte = "<input style='height:22px;' type='button' value='Cerrar' onclick=anulamulta("+idsimi+");jQuery('#cierramultas').dialog('open') />";
	
			jQuery("#crudsim").setRowData(idrow[i],{acciones:actualparte+anulaparte})
		}	
	},
	    editurl: 'subgridparte.php?q=1'// this is dummy existing url 
		
		 });
		 
		// var verdadero= true
jQuery("#crudsim").jqGrid('navGrid','#pcrudsim',{edit:false,add:false,del:false,search:false},{height:400,reloadAfterSubmit:true,closeAfterEdit : true},{closeOnEscape:true},{closeOnEscape:true},{sopt:['cn','bw','eq','ne','lt','gt','ew','le','ge']});
////		 
		 
 });
    </script>


	
    
	 <link rel="stylesheet" type="text/css" href="../themes/css/custom-theme/jquery-ui-1.8.16.custom.css">
	<link rel="stylesheet" type="text/css" href="../css/ui.jqgrid.css">

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
#parte {
display: none;
}
#gridplanilla {
display: none;
}
#gridplanillacond {
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

    #Layer2 {
	position:absolute;
	width:82px;
	height:115px;
	z-index:2;
	left: 892px;
	top: 73px;
}
    </style>	
</head>

<body>
<div  id="login1">login: [ <?php echo $_SESSION['login'];  ?>]</div>
<div id="Layer1"></div>
<div align="right"><span class="Estilo2"><a href="../login/index2.php" class="ui-state-hover">Volver al Men&uacute </a></span></div>

<span class="Estilo1">Selecci&oacute;n de Conductor </span>
<!--<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Usuario</a></li>
				<li><a href="#tabs-2">Conductor</a></li>
				<li><a href="#tabs-3">Asociado</a></li>
			</ul>
 -->			
<div id="tabs-1"><table align="center" id="crud"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrud" align="center">
 
</div> 
<div id="Layer2"><span class="Estilo1">Diarios</span>
  <table align="center" id="crudnov"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudnov" align="center"> </div></div>
<div id="filter" style="margin-left:30%;display:none">Search Invoices</div>
</div>
			<!--<div id="tabs-2">Phasellus mattis tincidunt nibh. Cras orci urna, blandit id, pretium vel, aliquet ornare, felis. Maecenas scelerisque sem non nisl. Fusce sed lorem in enim dictum bibendum.</div>
			<div id="tabs-3">Nam dui erat, auctor a, dignissim quis, sollicitudin eu, felis. Pellentesque nisi urna, interdum eget, sagittis et, consequat vestibulum, lacus. Mauris porttitor ullamcorper augue.</div>
		</div> -->
		<br />
	<!--<table id="list10_d"></table> <div id="pager10_d"></div> -->
	
	
	<!--documentos -->
	
<div id="box">
<table align="center" id="crudoc"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudoc" align="center"></div>
<div id="actualiza" title="Actualizacion de Documentos"></div>

</div>
<div id="parte">
<table align="center" id="crudsim"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudsim" align="center"></div>
</div>

<div id="tc">
<table align="center" id="crudtc"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudtc" align="center"></div>
<div id="actualizatc" title="Actualizacion de Tarjeta de Control"></div>
<div id="veractualizatc" title="Movimientos de Tarjeta de Control"></div>
<div id="cerrar" title="Cerrar Tarjeta de Control"></div>
<div id="autorizatc" title="Funcion Especial"></div>
</div>
</div>

<div id="ntarjetao" title="Nueva Tarjeta de Control">

</div>
<div id="regsimit" title="Nuevo Registro de Infracciones de Transito">
<div id="pagamultas" title="Actualizar Pago de Comparendo"></div>
</div>
<div id="cierramultas" title="Cerrar Comparendo"></div>
</div>

<div id="planillas" title="Planillas de Viaje"></div>



<div id="grabaplanilla" >
</div>

	<br />
<div id="gridplanilla">
<table align="center" id="crudplan"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudplan" align="center"></div>
<div id="recibe_planilla" title="Recibir Planilla de Viaje Ocasional"></div>
<div id="anula_planilla" title="Funci&oacute;n Especial"></div>
<div id="descarta_planilla" title="Funci&oacute;n Especial"></div>
</div>

<div id="gridplanillacond">
<table align="center" id="crudplancon"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudplancon" align="center"></div>
<!--<div id="recibe_planilla" title="Recibir Planilla de Viaje Ocasional"></div>
<div id="anula_planilla" title="Funci&oacute;n Especial"></div>
<div id="descarta_planilla" title="Funci&oacute;n Especial"></div> -->
</div>


</body>
</html>
