<?php
session_start();
 include('../inc/libreria.php');
 
 if(!valida_usr(1)){
 
 echo "Acceso No Autorizado";
 return ;
 }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gestion usuarios</title>
   
    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="../src/jqDnR.js" type="text/javascript"></script>
	<script src="../src/jqModal.js" type="text/javascript"></script>
	<script src="../themes/ejemplo/ui/i18n/jquery.ui.datepicker-es.js"></script>

    <script type="text/javascript">
	jQuery(document).ready(function(){ 
	jQuery("#multa").jqGrid({ 
   //scroll: true,
     url:'gridmultasact.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['Codigo','Cedula','','','','','Documento','Fecha vence']
	  , colModel :[
	{name:'id_conductor'
		,index:'id_conductor'
		,width:10
		//,align:'right'
		,editable:false	
		,search:false
		,hidden:true
	},{
	
		name:'codigo'
		,index:'codigo'
		,width:80
		,editable:true
	
	},{
		name:'nombre1'
		,index:'nombre1'
		,width:80
		//,align:'right'
		,editable:true
		
		
	},{
	name:'nombre2'
		,index:'nombre2'
		,width:80
		//,align:'right'
		,editable:true
		
	},{
		name:'apellido1'
		,index:'apellido1'
		,width:80
		//,align:'right'
		,editable:true
		
	},{
	name:'apellido2'
		,index:'apellido2'
		,width:80
		//,align:'right'
		,editable:true
		
	
	},{
	  name:'documento'
		,index:'documento'
		,width:180
		
		
		},{ name:'fecha_vence'
		,index:'fecha_vence'
		,width:80
		,formatter:'date', formatoptions:{srcformat:"Y-m-d H:i",newformat:"d-M-Y"}
		
	}
	],
	   
	  // pager: jQuery('#pcrudoc'),
	  pager: jQuery('#pmulta'),
    rowNum:50,
    //rowList:[10,20,30],
	//scroll: true, 
	height:'auto',
	
	width:'auto',
    sortname: 'fecha_vence',
    sortorder: "desc",
    viewrecords: true,
     caption: 'Reporte de Documentos Vencidos',

	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		
	},
	    editurl: 'gridmultasact.php?q=1'// this is dummy existing url 
		
		 });
		  jQuery("#multa").jqGrid('navGrid','#pmulta',{edit:false,add:false,del:false,searchtext:'Busqueda', excel:true},{height:400,reloadAfterSubmit:true,closeAfterEdit : true},{closeOnEscape:true},{closeOnEscape:true},{sopt:['cn','bw','eq','ne','lt','gt','ew','le','ge']}).navButtonAdd('#pmulta',{
                                caption:"Exportar", 
                                buttonicon:"ui-icon-calculator", 
                                onClickButton: function(){ 
                                  exportExcel();
                                }, 
                                position:"last"
                            });
							
							
function exportExcel()
        {
            document.getElementById('frmpermitidas').submit();
        }							
	  
		   jQuery("#multa").jqGrid('setGroupHeaders', { useColSpanStyle: true, groupHeaders:[ {startColumnName: 'nombre1', numberOfColumns: 2, titleText: '<em>Nombres</em>'}, {startColumnName: 'apellido1', numberOfColumns: 2, titleText: 'Apellidos'}, {startColumnName: 'tarj', numberOfColumns: 2, titleText: 'Tarjeta Ctrl'}	 ] });
//	 
  jQuery("#multa").jqGrid('filterToolbar');
  
	jQuery("#crud").jqGrid({ url:'gridcondu.php',
	 datatype: "json", 
	  mtype: 'POST',
	  colNames:['Codigo','Cedula','Nombre1','Nombre2','Apellido1','Apellido2','Direccion','Telefono','Fecha Nac','Est. Civil','Rh','Acudiente','Telefono','Celular','EPS','ARL']
	  , colModel :[{
		name:'id_conductor'
		,index:'id_conductor'
		,width:55
		,align:'center'
	},{
		name:'codigo'
		,index:'codigo'
		,width:65
		,editable:true
		,editrules:{required:true}
		//,align:'center'
	},{
		name:'nombre1'
		,index:'nombre1'
		,width:55
		//,align:'right'
		,editable:true
		//,hidden:true
		//,editrules:{edithidden:true,required:true}
		//,edittype:'select'
		//,editoptions:{value:"1:Si;0:No"}  Name:Value;Name:Value 
	},{
	name:'nombre2'
		,index:'nombre2'
		,width:55
		//,align:'right'
		,editable:true
		//,edittype:'select'
		//,editoptions:{value:"1:Si;0:No"}  Name:Value;Name:Value 
	},{
		name:'apellido1'
		,index:'apellido1'
		,width:70
		//,align:'right'
		,editable:true
	},{
	name:'apellido2'
		,index:'apellido2'
		,width:70
		//,align:'right'
		,editable:true
	},{
		name:'direccion'
		,index:'direccion'
		,width:130
		//,align:'right'
		,editable:true
		,hidden:true
		,editrules:{edithidden:true,required:true}
	},{
		name:'telefono'
		,index:'telefono'
		,width:85
		,sortable:false
		,editable:true
		},{
		name:'fecha_nace'
		,index:'fecha_nace'
		,width:80
		,hidden:true
		,editrules:{edithidden:true,required:true}
		,formatoptions:{srcformat:"Y-m-d H:i:s",newformat:"Y-m-d"}
		,formatter:"date"
		,editable:true
		,editoptions:{
		dataInit:
		function(elm){setTimeout(function(){
                  jQuery(elm).datepicker({dateFormat:'yy-mm-dd',changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,});
                    jQuery('.ui-datepicker').css({'font-size':'85%'});
                },200);}
				}
		
		},{
		name:'est_civil'
		,index:'est_civil'
		,width:80
		
		,editable:true
		,edittype:"select",editoptions:{value:"soltero:Soltero;Casado:Casado;Union libre:Union libre;Separado:Separado"}
		,hidden:true
		,editrules:{edithidden:true,required:true}
		},{
		name:'tipo_rh'
		,index:'tipo_rh'
		,width:30
		,hidden:true
		,editrules:{edithidden:true,required:true}
		,editable:true
		,edittype:"select",editoptions:{value:"O-:O-;O+:O+;A+:A+;A-:A-;B-:B-;B+:B+;AB-:AB-;AB+:AB+"}
		},{
	name:'acudiente'
		,index:'acudiente'
		,width:130
		//,align:'right'
		,editable:true
	},{
		name:'telefonoa'
		,index:'telefonoa'
		,width:70
		//,align:'right'
		,editable:true
	},{
		name:'celulara'
		,index:'celulara'
		,width:80
		,sortable:false
		,editable:true
	},{
		name:'eps'
		,index:'eps'
		,width:70
		//,align:'right'
		,editable:true
	},{
		name:'arl'
		,index:'arl'
		,width:70
		//,align:'right'
		,editable:true
	}],
	   
	   pager: jQuery('#pcrud'),
    rowNum:10,
    rowList:[10,20,30],
	height:200,
	width:'auto',
    sortname: 'id_conductor',
    sortorder: "asc",
    viewrecords: true,
     caption: 'Gestion de Conductor',
	  postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
	},
	    editurl: 'gridcondu.php'// this is dummy existing url 
		
		 });
		 
		 var verdadero= true
		 
		 jQuery("#crud").jqGrid('navGrid','#pcrud',{edit:true,add:true,del:true},{height:500,reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true});
		 
		 
		 //////configurar colspan de la cabezera
		 
		 jQuery("#crud").jqGrid('setGroupHeaders', { useColSpanStyle: true, groupHeaders:[ {startColumnName: 'nombre1', numberOfColumns: 2, titleText: '<em>Nombres</em>'}, {startColumnName: 'apellido1', numberOfColumns: 2, titleText: 'Apellidos'} ] });
		 /////funcion de calendario
		 function pickdates(id){
	  jQuery('#pcrud').datepicker({dateFormat:'yy-mm-dd'});
}

///////////grilla de movil  ,'Nombre','Apellido'

	jQuery("#gridmovil").jqGrid({ url:'../gesdocs/gridmovil.php',
	 datatype: "json", 
	  mtype: 'POST',
	  colNames:['ID','Movil','placa','Codigo','Nombre','Apellido']
	  , colModel :[
	 	  
	  {
	  name:'id_vehi_cond'
		,index:'id_vehi_cond'
		,width:55
		,align:'center'
		,editable:false
		},{
		name:'id_movil'
		,index:'id_movil'
		,width:55
		,align:'center'
		,editable:true
		,editrules:{edithidden:true,required:true}
			,editoptions:{
		dataInit:
		function(elem){
			// Autocomplete plugin
				$(elem).autocomplete({
			source: "../gesdocs/selecmovil.php",
			 select: function(event, ui) {
                  }
		});
			
		}
		}
	},{
	name:'placa'
		,index:'placa'
		,width:120
		,editable:false		
	},{
	
	  name:'id_conductor'
		,index:'id_conductor'
		,width:85
		,align:'center'
		,editable:true
		
		,editrules:{edithidden:true,required:true}
		,editoptions:{
		dataInit:
		function(elem){
			// Autocomplete plugin
				$(elem).autocomplete({
			source: "../gesdocs/buscacondu.php",
			 select: function(event, ui) {
                  }
		});
			
		}
		}	
	},{
	name:'nombre'
		,index:'nombre'
		,width:100
		,editable:false	
	},{
	name:'apellido'
		,index:'apellido'
		,width:100
		,editable:false	
	/*},{
		name:'id_doc'
		,index:'id_doc'
		,width:55
		,align:'center'
		,editable:true
		,hidden:true
		,editrules:{edithidden:true,required:true}
			,editoptions:{
		dataInit:
		function(elem){
			// Autocomplete plugin
				$(elem).autocomplete({
			source: "../gesdocs/selecdoc.php",
			 select: function(event, ui) {
                  }
		});
			
		}
		}
		},{
	name:'numero'
		,index:'numero'
		,width:120
		,editable:true	
		},{
	name:'categoria'
		,index:'categoria'
		,width:30
		,align:'center'
		,editable:true	
		,edittype:"select",editoptions:{value:"0:0;1:1;2:2;3:3;4:4;5:5;6:6"}
	},{
	
		name:'fecha_vence'
		,index:'fecha_vence'
		,width:140
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
                    jQuery('.ui-datepicker').css({'font-size':'80%'});
                },200);}
			}*/	
	}
	
	 
	],
	   
	   pager: jQuery('#piemovil'),
    rowNum:10,
    rowList:[10,20,30],
	height:200,
	width:'auto',
    sortname: 'id_vehi_cond',
    sortorder: "asc",
    viewrecords: true,
     caption: 'Gestion de Moviles',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl+"); 
	
	
	    editurl: '../gesdocs/gridmovil.php'// this is dummy existing url 
		
		 });
		 jQuery("#gridmovil").jqGrid('navGrid','#piemovil',{edit:true,add:true,del:true},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true});
		 
		 
	
		 
		
		 function pickdates(id){
	  jQuery('#piemovil').datepicker({dateFormat:'yy-mm-dd'});
}


///////////grilla de documentos

	jQuery("#gridoc").jqGrid({ url:'../gesdocs/gridcondoc.php',
	 datatype: "json", 
	  mtype: 'POST',
	  colNames:['','Cedula','Cedula','Documento','Entidad','Entidad','Tipo documento','Numero','Cat','Fecha Vencimiento']
	  , colModel :[
	 	  
	  {
	  name:'id'
		,index:'id'
		,width:55
		,align:'center'
		,hidden:true
		,editable:false
	},{
	  name:'id_conductor'
		,index:'id_conductor'
		,width:55
		,align:'center'
		,editable:true
		,hidden:true
		,editrules:{edithidden:true,required:true}
		,editoptions:{
		dataInit:
		function(elem){
			// Autocomplete plugin
				$(elem).autocomplete({
			source: "../gesdocs/buscacondu.php",
			 select: function(event, ui) {
                  }
		});
			
		}
		}	
	},{
	name:'codigo'
		,index:'codigo'
		,width:70
		,editable:false	
	},{
	name:'documento'
		,index:'documento'
		,width:180
		,editable:false	
		},{
	name:'eps'
		,index:'eps'
		,width:85
		,editable:false	
		/*,edittype:'select'
		,editoptions:{ dataUrl: '../inc/lista.php?tb=entidad_salud&cid=id_eps&cd=eps' }*/
			},{
	name:'id_eps'
		,index:'id_eps'
		,width:85
		,editable:true	
		,hidden:true
		,editrules:{edithidden:true,required:true}
		,edittype:'select'
		,editoptions:{ dataUrl: '../inc/lista.php?tb=entidad_salud&cid=id_eps&cd=eps' }
	},{
		name:'id_doc'
		,index:'id_doc'
		,width:55
		,align:'center'
		,editable:true
		,hidden:true
		
		,editrules:{edithidden:true,required:true}
		,edittype:'select'
		,editoptions:{ dataUrl: '../inc/lista.php?tb=documento&cid=id_doc&cd=documento' }
//			,editoptions:{
//		dataInit:
//		function(elem){
//			// Autocomplete plugin
//				$(elem).autocomplete({
//			source: "../gesdocs/selecdoc.php",
//			 select: function(event, ui) {
//                  }
//		});
//			
//		}
//		}
		},{
	name:'numero'
		,index:'numero'
		,width:90
		,editable:true	
		},{
	name:'categoria'
		,index:'categoria'
		,width:30
		,align:'center'
		,editable:true	
		,edittype:"select",editoptions:{value:"0:0;1:1;2:2;3:3;4:4;5:5;6:6"}
	},{
	
		name:'fecha_vence'
		,index:'fecha_vence'
		,width:120
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
                    jQuery('.ui-datepicker').css({'font-size':'100%'});
                },200);}
				}
	}
	
	 
	],
	   
	   pager: jQuery('#piedoc'),
    rowNum:10,
    rowList:[10,20,30],
	height:200,
	width:'auto',
    sortname: 'codigo',
    sortorder: "asc",
    viewrecords: true,
     caption: 'Gestion de Documentos',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl+"); 
	
	
	    editurl: '../gesdocs/gridcondoc.php'// this is dummy existing url 
		
		 });
		 
		 
		 jQuery("#gridoc").jqGrid('navGrid','#piedoc',{edit:true,add:true,del:true},{width:400,reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true,},{width:400,closeOnEscape:true},{closeOnEscape:true});
		 
		 
	
		 
		
		 function pickdates(id){
	  jQuery('#piedoc').datepicker({dateFormat:'yy-mm-dd'});
}
///////////////funcion para las pestañas
		 jQuery( "#tabs" ).tabs({
						//event: "mouseover"
					});

		 });
    </script>
	<script src="../js/i18n/grid.locale-es.js" type="text/javascript"></script>
    <script src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>
	
    <script src="../themes/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	 <link rel="stylesheet" type="text/css" href="../themes/css/custom-theme/jquery-ui-1.8.16.custom.css">
	<link rel="stylesheet" type="text/css" href="../css/ui.jqgrid.css">
	
    <link rel="stylesheet" type="text/css" media="screen" href="../themes/ui.multiselect.css" />
 <!--  <link rel="stylesheet" type="text/css" href="../plugins/ui.multiselect.css"> -->
    <style type="text/css">
<!--
.Estilo1 {
	color: #333333;
	font-size: 28px;
	font-weight: bold;
	font-style: italic;
}

-->
    </style>
	<style type="text/css">
			/*demo page css*/
			body{ font: 50.5% "Trebuchet MS", sans-serif; margin: 50px;}
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
<div align="lefth"><span class="Estilo1">Gesti&oacute;n de Conductor</span></div>

<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Datos de Conductor</a></li>
				<!--<li><a href="#tabs-2">Movil</a></li> -->
				<li><a href="#tabs-3">Vinculaci&oacute;n Documentos</a></li>
				<li><a href="#tabs-2">Fechas Documentos</a></li>
			</ul>
		<div id="tabs-1">
			<span class="Estilo1">Datos de Conductores </span>
			<table align="center" id="crud"  >
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>
			<div id="pcrud" align="center"></div>
		</div>
			
			
			
			<!--pestaña para la grilla de documentos -->
			<div id="tabs-3">
			
				<span class="Estilo1">Vinculaci&oacute;n de Documentos </span>
				<table align="center" id="gridoc"  >
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table>
				<div id="piedoc" align="center"></div>
			</div>
			<div id="tabs-2">
			
			 <table align="center" id="multa"  >
<tr><td>&nbsp;</td></tr></table><div id="pmulta" align="center"></div>

<form method="post" action="exceldocscond.php" name="frmpermitidas" id="frmpermitidas">
    <!--<input type="hidden" name="csvBuffer" id="csvBuffer" value="" />-->
</form>
			</div>
</div>
	

</body>
</html>
