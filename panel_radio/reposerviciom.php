<?php
session_start();
 include('../inc/libreria.php');
 
 if(!valida_usr(22)){
 
 echo "Acceso No Autorizado";
 return ;
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Reporte de Servicios</title>
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

//////////grilla servicio asignado
var lastSel;
jQuery("#crudsasig").jqGrid({ 
     scrollrows : true, 
	 url:'gridrepserv.php',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['','Telefono','Linea','Direccion','Detalle Servicio','Fecha Servicio','Movil','Movil 2','Conductor','Usuario','estado','observacion']
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
	name:'linea'
		,index:'linea'
		,width:93
		,hidden:false
		,editrules:{edithidden:true,required:false}
		,editable:false
		,search:true
		,sortable:false
			
		
	},{	
	
	
		 name:'direccion'
		,index:'direccion'
		,width:300
		//,align:'center'
		,editable:true
		,search:true
		,sortable:false
		
	},{	
	
		 name:'detalle_serv'
		,index:'detalle_serv'
		,width:160
		,sortable:false
		//,align:'center'
		//,hidden:true
		,editrules:{edithidden:true}
		//,editoptions:{value:'N/A'}
		//,edittype:'textarea'
		,editable:true
		,search:true
	},{	
	
	
		 name:'fecha_reg'
		,index:'fecha_reg'
		,width:140
		//,align:'center'
		,formatoptions:{srcformat:"Y-m-d H:i:s",newformat:"d-m-Y h:i A"}
		,formatter:"date"
		,editable:true
		,search:true
		,sortable:false
			
	},{	

	  name:'id_movil'
		,index:'id_movil'
		,width:60
		,align:'center'
		,editable:true
		,search:true
			 ,sortable:false
	,hidedlg:true
	//	,editrules:{custom:true,custom_func:validamovil}
		,editoptions:{
		 
		dataInit:function(el){jQuery(el).autocomplete({
			source: "selecmovil.php",
			 select: function(event, ui) {
                  }
		});} }
		
		
	},{	
	  name:'id_movil2'
		,index:'id_movil2'
		,width:60
		,align:'center'
		,editable:true
		,sortable:false
		,search:true
		,hidedlg:true
	//	,editrules:{custom:true,custom_func:validamovil}
		,editoptions:{
		 
		dataInit:function(el){jQuery(el).autocomplete({
			source: "selecmovil.php",
			 select: function(event, ui) {
                  }
		});} }
		
		},{	

	 name:'nombres'
		,index:'nombres'
		,width:210
		//,align:'center'
		,hidden:false
		,sortable:false

		
},{	

	 name:'usuario'
		,index:'usuario'
		,width:80
		//,align:'center'
		,hidden:false
		,sortable:false
		},{	

	 name:'estado'
		,index:'estado'
		,width:80
		//,align:'center'
		,stype:'select',
		 search: true, 
		 searchoptions: {sopt: ['eq','ne'], dataUrl: 
	 'lista.php?tb=servicio_h&cid=estado&cd=estado' }
		,hidden:false
		,sortable:false
			},{	

	 name:'observacion'
		,index:'observacion'
		,width:150
		//,align:'center'
		,hidden:false
		,sortable:false
 /*},{	
	 name:'acc'
		,index:'acc'
		,width:130
		//,align:'center'
		,sortable:false
			,search:false*/
	}
	
	 
	],
	   
	   pager: jQuery('#pcrudsasig'),
    rowNum:100,
    rowList:[10,100,200,300,1000,20000],
	height:'auto',
	width:'auto',
    sortname: 'id_ser',
    sortorder: "desc",
   viewrecords: true,
     caption: 'Servicios Asignados',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},	
	   editurl: 'gridrepserv.php'// this is dummy existing url 
		
		 });
		 
		 
		 jQuery("#crudsasig").jqGrid('navGrid','#pcrudsasig',{edit:false,add:false,del:false,view:true,search:false,reload:false},{reloadAfterSubmit:true,closeAfterEdit :true,closeOnEscape:true},{reloadAfterSubmit:true,closeOnEscape:true,closeAfterAdd : true},{closeOnEscape:true}).navButtonAdd('#pcrudsasig',{
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
            mya=jQuery("#crudsasig").getDataIDs();  // Get All IDs
            var data=jQuery("#crudsasig").getRowData(mya[0]);     // Get First row to get the labels
            var colNames=new Array(); 
            var ii=0;
            for (var i in data){colNames[ii++]=i;}    // capture col names
            var html="";
            for(i=0;i<mya.length;i++)
                {
                data=jQuery("#crudsasig").getRowData(mya[i]); // get each row
                for(j=0;j<colNames.length;j++)
                    {
                    html=html+data[colNames[j]]+"\t"; // output each column as tab delimited
                    }
                html=html+"\n";  // output each row with end of line

                }
            html=html+"\n";  // end of line at the end
            document.forms[0].csvBuffer.value=html;
            document.forms[0].method='POST';
            document.forms[0].action='../gesdocs/csvExport.php';  // send it to server which will open this contents in excel file
            document.forms[0].target='_blank';
            document.forms[0].submit();
        }							
	  
		 jQuery("#crudsasig").jqGrid('filterToolbar');
		 
		 


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
			/*demo page css*/
			body{ font: 62.5% "Trebuchet MS", sans-serif; margin: 50px;}
			.demoHeaders { margin-top: 2em; }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
			.Estilo1 {
	color: #333333;
	font-size: 36px;
	font-weight: bold;
	font-style: italic;
}
			#Layer1 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:2;
}
#Layer2 {
	position:absolute;
	width:659px;
	height:115px;
	z-index:3;
	left: 48px;
	top: 472px;
}
#Layer3 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:4;
	left: 1002px;
	top: 72px;
}
</style>
</head>

<body>
<div  id="login1">login: [ <?php echo $_SESSION['login'];  ?>]</div>

<div align="right"><span class="Estilo2"><a href="../login/index2.php" class="ui-state-hover">Volver al Men&uacute </a></span></div>


<div id="Layer2">
<span class="Estilo1">Servicios Atendidos</span>
<table align="center" id="crudsasig"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudsasig" align="center"></div>
</div>

<form method="post" action="../gesdocs/csvExport.php">
    <input type="hidden" name="csvBuffer" id="csvBuffer" value="" />
</form>

</body>
</html>
