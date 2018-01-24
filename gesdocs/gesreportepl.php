<?php
session_start();
 include('../inc/libreria.php');
 
 if(!valida_usr(26)){
 
 echo "Acceso No Autorizado";
 return ;
 }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>resumen de planillas</title>
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
	 jQuery("#west-grid").jqGrid({
        url: "gridreporteanio.php?q=1&url=<?php echo "reporteaniop.php"?>",
        datatype: "json",
        height: "auto",
        pager: false,
       // loadui: "disable",
        colNames: ["Años ",''],
        colModel: [
            {name: "anio",width:1,hidden:false, key:true, width:85},
        /*   {name: "menu", width:150, resizable: false, sortable:false},*/
            {name: "url",width:1,hidden:true}
        ],
       // treeGrid: true,
		caption: "Reporte",
      //  ExpandColumn: "anio",
        width: 'auto',
        //width: 180,
        rowNum: 200,
       // ExpandColClick: true,
      /*   multiselect: false,
		 subGrid : true, 
		 subGridUrl: 'subgridmes.php?q=1',
		 subGridModel:
		 [{ name : ['Meses'],
		  width : [150] 
		  ,align:['center']
		  } ],
		  // caption: "Subgrid Example" */
		    onSelectRow: function(rowid) {
            var treedata = jQuery("#west-grid").jqGrid('getRowData',rowid);
           // if(treedata.isLeaf=="true") {
                //treedata.url
                var st = "#t"+treedata.anio;
				if(jQuery(st).html() != null ) {
					maintab.tabs('select',st);
				} else {
					//maintab.tabs('add',st, treedata.menu);
					jQuery("#tabs").load(treedata.url+"?anio="+treedata.anio);
					//alert(rowid)
				}
           // }
        },
		
		//subGrid: true, 
		//caption: "Grid as Subgrid",
		
	/*	subGridRowExpanded: function(subgrid_id,row_id) { 
		// we pass two parameters // subgrid_id is a id of the div tag created whitin a table data // the id of this elemenet is a combination of the "sg_" + id of the row // the row_id is the id of the row // If we wan to pass additinal parameters to the url we can use // a method getRowData(row_id) - which returns associative array in type name-value // here we can easy construct the flowing 
		var subgrid_table_id, pager_id;
		subgrid_table_id = subgrid_id+"_t";
		pager_id = "p_"+subgrid_table_id;
		jQuery("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");
		jQuery("#"+subgrid_table_id).jqGrid({
		 url:"subgridmes.php?q=1&id="+row_id
		, datatype: "json",
		 colNames: ['Mes',''], colModel: [ {name:"mes",index:"mes",width:150,key:true},{name: "path",width:1,hidden:true} ], rowNum:20,
		 // pager: pager_id, 
		 sortname: 'mes', sortorder: "asc", height: '100%',
		  onSelectRow: function(rowid) {
            var subdata = jQuery("#"+subgrid_table_id).jqGrid('getRowData',rowid);
			   var treedata = jQuery("#west-grid").jqGrid('getRowData',row_id);
           // if(treedata.isLeaf=="true") {
                //treedata.url
                var st = "#t"+subdata.mes;
				if(jQuery(st).html() != null ) {
					maintab.tabs('select',st);
				} else {
					//maintab.tabs('add',st, treedata.menu);
					jQuery("#tabs").load(subdata.path+"?mes="+subdata.mes+"&anio="+treedata.anio);
					//alert(rowid)
				}
           // }
        },
		  }); jQuery("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:false,add:false,del:false}) }, 
		 subGridRowColapsed: function(subgrid_id, row_id) { // this function is called before removing the data //
		// var subgrid_table_id; //
		// subgrid_table_id = subgrid_id+"_t"; //
	//	 jQuery("#"+subgrid_table_id).remove();
	 }
		  });
		  */
  ///////llamado al grafico
		/*enhance({
			loadScripts: [
				{src: '../grafico/js/excanvas.js', iecondition: 'all'},
				'../themes/js/jquery-1.6.2.min.js',
				'../grafico/js/visualize.jQuery.js',
				'../grafico/js/example.js'
			],
			loadStyles: [
				'../grafico/css/visualize.css',
				'../grafico/css/visualize-dark.css'
			]	 */
		});  
	
	
	});	
   
   
   </script>
   	
<!--	<script type="text/javascript" src="../grafico/js/enhance.js"></script> -->
   <script src="../src/jqDnR.js" type="text/javascript"></script>
	
	<script src="../src/jqModal.js" type="text/javascript"></script>
		<script src="../themes/ejemplo/ui/jquery.ui.core.js"></script>
	<script src="../themes/ejemplo/ui/jquery.ui.widget.js"></script>
	 <script src="../js/i18n/grid.locale-es.js" type="text/javascript"></script>
<script src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>



  <!--  <link href="../grafico/css/basic.css" type=<a href="../grafico/jquery.jqplot.1.0.0b2_r1012/dist/jquery.min.js"></a>"text/css" rel="stylesheet" /> -->
  
	 <link rel="stylesheet" type="text/css" href="../themes/css/custom-theme/jquery-ui-1.8.16.custom.css">
	
	<link rel="stylesheet" type="text/css" href="../css/ui.jqgrid.css">
	
   <!-- <link rel="stylesheet" type="text/css" media="screen" href="../themes/ejemplo/themes/ui.multiselect.css" />  -->
   	<link rel="stylesheet" type="text/css" href="../themes/ejemplo/themes/custom-theme/jquery.ui.all.css"> 
 <!--   <link rel="stylesheet" type="text/css" media="screen" href="../themes/ui.multiselect.css" /> --> 
   <link rel="stylesheet" type="text/css" href="../plugins/ui.multiselect.css">   
<!--   <link rel="stylesheet" type="text/css" href="../plugins/ui.multiselect.css"> -->
    <style type="text/css">
<!--
.Estilo1 {
	color: #333333;
	font-size: 36px;
	font-weight: bold;
	font-style: italic;
}
body{ font: 62.5% "Trebuchet MS", sans-serif; margin: 50px;}
			.demoHeaders { margin-top: 2em; }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
#tabs {
	position:absolute;
	width:200px;
	height:115px;
	z-index:2;
	left: 152px;
	top: 123px;
}

#pl {
display: none;
}
-->
    </style>
   </head>
   <body>
   <div  id="login1">login: [ <?php echo $_SESSION['login'];  ?>]</div>
<div align="right"><span class="Estilo2"><a href="../login/index2.php" class="ui-state-hover">Volver al Men&uacute </a></span></div>
<span class="Estilo1">Informe Detallado de Planillas por Años </span>
   	<table id="west-grid" align="left"></table>
	
		<div id="tabs" class="jqgtabs">		</div>	
   
   </body>
   
	 
</html>
 <!-- http://filamentgroup.com/lab/update_to_jquery_visualize_accessible_charts_with_html5_from_designing_with/ http://www.comolohago.cl/2009/05/29/como-crear-graficos-mediante-php/ -->