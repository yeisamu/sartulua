<?php
session_start();
 include('../inc/libreria.php');
 
 if(!valida_usr(23)){
 
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
 jQuery.noConflict();
	jQuery(document).ready(function(){ 
jQuery("#crudsus").jqGrid({ url:'grid107.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['','Movil','Inicio','Fin','Motivo','Justificacion','Conductor','Estado']
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
		,width:50
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
		 name:'f_inicio'
		,index:'f_inicio'
		,search:true
		,width:150
		,editable:true
		,formatoptions:{srcformat:"Y-m-d H:i:s",newformat:"Y-m-d h:i A"}
	//	,formoptions:{label: "Inicio (aa/mm/dd)"}
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
		,width:150
		//,align:'center'
		,editable:true
		//,formoptions:{label: "Fin (aa/mm/dd)"}
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
		,width:160
		//,align:'center'
		,editable:true
	},{
		 name:'justificacion'
		,index:'justificacion'
		,width:190
		//,align:'center'
		,editable:true	
		
	},{
		 name:'conductor'
		,index:'conductor'
		,width:90
		//,align:'center'
		,editable:true		
		},{
		 name:'estado'
		,index:'estado'
		,width:95
		//,align:'center'
		,editable:false	
	}
	
	 
	],
	   
	   pager: jQuery('#pcrudsus'),
    rowNum:10,
    rowList:[100,200,300],
	height:'auto',
	width:'auto',
    sortname: 'est desc,id_susp desc',
    sortorder: "",
   viewrecords: true,
     caption: 'Moviles En Suspension 10-7',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		/*loadComplete: function(){
				setTimeout(function(){jQuery('#crudsus').trigger('reloadGrid')},40000)
				},*/
		//jQuery('#crud').editRow("+cl+"); 
	
	
	    editurl: 'grid107.php'// this is dummy existing url 
		
		 });
		 
		 
		 jQuery("#crudsus").jqGrid('navGrid','#pcrudsus',{search:false,edit:true,add:false,del:true,view:true,reload:false},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true,height:200,width:250},{closeOnEscape:true,height:200,width:450}).navButtonAdd('#pcrudsus',{
                                caption:"Exportar", 
                                buttonicon:"ui-icon-calculator", 
                                onClickButton: function(){ 
                                  exportExcel107();
                                }, 
                                position:"last"
                            });
							
							
function exportExcel107()
        {
            var mya=new Array();
            mya=jQuery("#crudsus").getDataIDs();  // Get All IDs
            var data=jQuery("#crudsus").getRowData(mya[0]);     // Get First row to get the labels
            var colNames=new Array(); 
            var ii=0;
            for (var i in data){colNames[ii++]=i;}    // capture col names
            var html="";
            for(i=0;i<mya.length;i++)
                {
                data=jQuery("#crudsus").getRowData(mya[i]); // get each row
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
		 jQuery("#crudsus").jqGrid('filterToolbar');
		 
		 
/////10-5
var lastsel105;
jQuery("#crud105").jqGrid({ 
     scrollrows : true,
    url:'gridrep105.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['','Movil','Mensaje','','Fecha']
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
		,width:250
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
		 name:'fecha_reg'
		,index:'fecha_reg'
		,width:120
		//,align:'center'
		//,editable:true
		
		
	}
	
	 
	],
	   
	   pager: jQuery('#pcrud105'),
    rowNum:10,
    rowList:[100,200,300,500],
	height:'auto',
	width:'auto',
    sortname: 'id_msj',
    sortorder: "asc",
   // viewrecords: true,
     caption: '10-5',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
	
	    editurl: 'gridrep105.php'// this is dummy existing url 
		
		 });
		 
		 
		 jQuery("#crud105").jqGrid('navGrid','#pcrud105',{search:false,edit:false,add:false,del:false,view:true,reload:false},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true,height:200,width:250},{closeOnEscape:true,height:200,width:450}).navButtonAdd('#pcrud105',{
                                caption:"Exportar", 
                                buttonicon:"ui-icon-calculator", 
                                onClickButton: function(){ 
                                  exportExcel105();
                                }, 
                                position:"last"
                            });
							
							
function exportExcel105()
        {
            var mya=new Array();
            mya=jQuery("#crud105").getDataIDs();  // Get All IDs
            var data=jQuery("#crud105").getRowData(mya[0]);     // Get First row to get the labels
            var colNames=new Array(); 
            var ii=0;
            for (var i in data){colNames[ii++]=i;}    // capture col names
            var html="";
            for(i=0;i<mya.length;i++)
                {
                data=jQuery("#crud105").getRowData(mya[i]); // get each row
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
		 jQuery("#crud105").jqGrid('filterToolbar');		 
		 

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

<div id="Layer1">
<span class="Estilo1">10-7</span>
<table align="center" id="crudsus"  >
<tr><td>&nbsp;</td></tr></table>
<div id="pcrudsus" align="center"></div>
</div>


<form method="post" action="../gesdocs/csvExport.php">
    <input type="hidden" name="csvBuffer" id="csvBuffer" value="" />
</form>
<div id="Layer3">
<span class="Estilo1">10-5</span>
<table align="center" id="crud105"  >
<tr><td>&nbsp;</td></tr></table>
<div id="pcrud105" align="center"></div>
</div>
</body>
</html>
