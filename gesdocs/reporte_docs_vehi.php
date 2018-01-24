<?php
session_start();
 include('../inc/libreria.php');
 include('../inc/operaciones.php');
 
/* if(!valida_usr(33)){
 
 echo "Acceso No Autorizado";
 return ;
 }*/


    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Reporte de Multas</title>
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
     jQuery.noConflict();
	jQuery(document).ready(function(){ 
	
		jQuery("#multa").jqGrid({ 
   //scroll: true,
     url:'gridvehdocs.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['','Documento','Nombre','Apellidos','Movil','Placa','Grupo','Documento','Fecha vence']
	  , colModel :[
	{name:'id'
		,index:'id'
		,width:10
		//,align:'right'
		,editable:false	
		,search:false
		,hidden:true
	},{name:'id_prop'
		,index:'id_prop'
		,width:80
		//,align:'right'
		,editable:false	
		
		
	},{
	
		name:'nombre'
		,index:'nombre'
		,width:120
		,editable:true
	
	},{
		name:'apellidos'
		,index:'apellidos'
		,width:120
		//,align:'right'
		,editable:true
		
		
	},{
	name:'id_movil'
		,index:'id_movil'
		,width:50
		,align:'center'
		,editable:true
		
	},{
		name:'placa'
		,index:'placa'
		,width:60
		,align:'center'
		,editable:true
		
	},{
	name:'grupo'
		,index:'grupo'
		,width:40
		,align:'center'
		,editable:true
		,hidden:true
		
	
	},{
	  name:'descripcion'
		,index:'descripcion'
		,width:180
		
		
		},{ name:'fecha_ven'
		,index:'fecha_ven'
		,width:120
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
    sortname: 'fecha_ven',
    sortorder: "asc",
    viewrecords: true,
     caption: 'Reporte de Documentos Vencidos',

	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		
	},
	    editurl: 'gridvehdocs.php?q=1'// this is dummy existing url 
		
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

	
	 });
    </script>

    <script src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>
	
    <script src="../themes/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
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

<span class="Estilo1">Reporte de Documentos Vencidos de Vehiculos</span>
<table align="center" id="multa"  >
<tr><td>&nbsp;</td></tr></table><div id="pmulta" align="center"></div>

<form method="post" action="exceldocsvehi.php" name="frmpermitidas" id="frmpermitidas">
    <!--<input type="hidden" name="csvBuffer" id="csvBuffer" value="" />-->
</form>

</body>
</html>
