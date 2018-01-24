<?php
session_start();
 include('../inc/libreria.php');
 include('../inc/operaciones.php');
  $link=conectarse();
 if(!valida_usr(15)){
 
 echo "Acceso No Autorizado";
 return ;
 }
 
//$borrar=mysql_query("TRUNCATE TABLE `reporte_planilla`");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>listado de planillas</title>
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
		//alert(grupo_emp)
	var dir='gridreporteplanilla_liq.php?q=1';
	jQuery("#crudnov").jqGrid({ 
     
     url:dir,
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['Fecha','','# Planilla','Movil','Grupo','Pla. x mes','Conductor','Destino','Elab','Recibido','Estado','Observaciones','Liquidado']
	, colModel :[
	{name:'fecha'
		,index:'fecha'
		,width:105
		//,align:'right'
		,editable:false	
		,search:false
	},{
	
	name:'id_planilla'
		,index:'id_planilla'
		,width:40
		,hidden:true
		,editable:false	
		,search:false
	},{
	name:'n_planilla'
		,index:'n_planilla'
		,width:50
		//,align:'right'
		,editable:false	
		},{
	name:'id_movil'
		,index:'id_movil'
		,width:35
		//,align:'right'
		,editable:false
		,search:true	
	},{
	name:'grupo'
		,index:'grupo'
		,width:40
		,align:'center'
		,editable:false
		,search:true
		,hidden:true
	},{
	name:'planillam'
		,index:'planillam'
		,width:70
		,align:'center'
		,editable:false	
		,search:false			
	},{
	name:'nombre_con'
		,index:'nombre_con'
		,width:100
		//,align:'right'
		,editable:false	
		,search:false
	},
	{
	
		name:'destino'
		,index:'destino'
		,width:60
		,editable:true
		,search:false
		//,align:'center'
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
		name:'elab'
		,index:'elab'
		//,align:'center'
		, width:60
		,search:false
		/*,searchoptions:{dataInit:function(el){jQuery(el).autocomplete({
			source: "selecmovil.php",
			 select: function(event, ui) {
                  }
		});} }*/
	},{
	  name:'recibido'
		,index:'recibido'
		,width:60
		,search:false
		//,align:'center'
		//,hidden:true
	},{
	  name:'estado'
		,index:'estado'
		,width:80
		//,align:'center'
		//,hidden:true
		,search:false
		},{
	  name:'observaciones'
		,index:'observaciones'
		,width:100
		//,align:'center'
		//,hidden:true
		,search:false		
	},{
	  name:'liquidado'
		,index:'liquidado'
		,width:100
		,align:'left'
		,search:false
		//,formatter:'date', formatoptions:{srcformat:"Y-m-d H:i",newformat:"d-M-Y h:i a"}
		//,hidden:true
		
	/*},{ name:'estado'
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
		,hidden:true*/
		//},{name:'accion',index:'accion',align:'center', width:80,sortable:false,search:false	
	
	}
	],
	   
	  // pager: jQuery('#pcrudoc'),
	   pager: jQuery('#pcrudnov'),
    rowNum:50,
    //rowList:[10,20,30],
	height:'auto',
	width:'auto',
    sortname: 'fecha',
    sortorder: "desc",
    viewrecords: true,
     caption: 'Relacion de Planillas de viaje ',
	 rownumbers: true,
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		 
  editurl: 'gridreporteplanilla_liq.php?q=1'// this is dummy existing url 
		
		 });
		
		  jQuery("#crudnov").jqGrid('navGrid','#pcrudnov',{edit:false,add:false,del:false,searchtext:'Busqueda'},{height:400,reloadAfterSubmit:true,closeAfterEdit : true},{closeOnEscape:true},{closeOnEscape:true},{sopt:['cn','bw','eq','ne','lt','gt','ew','le','ge']}).navButtonAdd('#pcrudnov',{
                                caption:"Exportar", 
                                buttonicon:"ui-icon-calculator", 
								
                                onClickButton: function(){ 
							     //var y=this.id.substring(7)
								  //alert(this.id+' '+y)
                                  exportExcel();
                                }, 
                                position:"last"
                            });
							
							
function exportExcel()
        {
            var mya=new Array();
            mya=jQuery("#crudnov").getDataIDs();  // Get All IDs
            var data=jQuery("#crudnov").getRowData(mya[0]);     // Get First row to get the labels
            var colNames=new Array(); 
            var ii=0;
			var html="";
            for (var i in data){colNames[ii++]=i;html=html+i+"\t";}    // capture col names
           html=html+"\n";
            for(i=0;i<mya.length;i++)
                {
                data=jQuery("#crudnov").getRowData(mya[i]); // get each row
                for(j=0;j<colNames.length;j++)
                    {
                    html=html+data[colNames[j]]+"\t"; // output each column as tab delimited
                    }
                html=html+"\n";  // output each row with end of line

                }
            html=html+"\n";  
			//alert(html)
			document.getElementById('csvBuffer').value=html;
            eval('document.getElementById("form1").method="POST";');
            eval('document.getElementById("form1").action="csvExport.php"');  // send it to server which will open this contents in excel file
            eval('document.getElementById("form1").target="_blank";');
            eval('document.getElementById("form1").submit();');
        }							
	jQuery("#crudnov").jqGrid('filterToolbar');	  
		   //jQuery("#crudnov").jqGrid('setGroupHeaders', { useColSpanStyle: true, groupHeaders:[ {startColumnName: 'nombre1', numberOfColumns: 2, titleText: '<em>Nombres</em>'}, {startColumnName: 'apellido1', numberOfColumns: 2, titleText: 'Apellidos'}, {startColumnName: 'tarj', numberOfColumns: 2, titleText: 'Tarjeta Ctrl'}	 ] });
		   //}
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
	#rangos {
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

<div id="graba"></div>
</div>
<p>
</p>
<p>  <span class="Estilo1">Planillas Liquidadas </span>
</p>
<table align="center" id="crudnov"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudnov" align="center"><form method="post" id="form1" action="csvExport.php">
    <input type="hidden" name="csvBuffer" id="csvBuffer" value="" />
</form></div>

<div id="liquida_planilla"></div>
</body>
</html>
