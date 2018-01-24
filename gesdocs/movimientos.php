<?php
 $id_tarj=$_REQUEST['id_tarj'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<!-- <script  src="../inc/prototype.js"></script>
	<script  src="../inc/funciones.js"></script>
    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	
    <script src="../js/i18n/grid.locale-es.js" type="text/javascript"></script>
	<script src="../src/jqDnR.js" type="text/javascript"></script>
	
	<script src="../src/jqModal.js" type="text/javascript"></script> -->
		    <script type="text/javascript">
  /*  $.jgrid.no_legacy_api = true;
    $.jgrid.useJSON = true;*/
     jQuery.noConflict();

	jQuery(document).ready(function(){
	
	var idcom=<?php echo $id_tarj?>;
	//alert(idcomp);
		jQuery("#crudmov").jqGrid({ url:'gridmovi.php?q=1&id='+idcom,
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['Comprobante #','Fecha ELab','Fecha Ant','Fecha ','Documento Guia','Movimiento','Login',]
	  , colModel :[{
		name:'id_comp'
		,index:'id_comp'
		,width:65
		,align:'center'
	},{
	
	    name:'fecha_alavo'
		,index:'fecha_alavo'
		,width:150
		
		//,editrules:{required:true}
		//,align:'center'
		
	//	formatter:'number',
	//	formatoptions:{sorttype:"number"},
//		editrules:required:true}
		
		
	},{
		name:'fecha_nu'
		,index:'fecha_nu'
		,width:80
		//,align:'right'
		//,editable:true
		//,hidden:true
		//,editrules:{edithidden:true,required:true}
		//,edittype:'select'
		//,editoptions:{value:"1:Si;0:No"}  Name:Value;Name:Value 
	},{
	    name:'fecha_ante'
		,index:'fecha_ante'
		,width:80
		,editable:true
		//,align:'right'
		//,editable:true
		//,edittype:'select'
		//,editoptions:{value:"1:Si;0:No"}  Name:Value;Name:Value 
	},{
		name:'observaciones'
		,index:'observaciones'
		,width:150
		//,align:'right'
		//,editable:true
	},{
	name:'detalle_tran'
		,index:'detalle_tran'
		,width:150
		//,align:'right'
		//,editable:true
	},{
		name:'usuario'
		,index:'usuario'
		,width:60
		//,align:'right'
		//,editable:true
		//,hidden:true
		//,editrules:{edithidden:true,required:true}
	/*},{
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
		},{
		name:'tipo_rh'
		,index:'tipo_rh'
		,width:30
		,hidden:true
		,editrules:{edithidden:true,required:true}
		,editable:true
		,edittype:"select",editoptions:{value:"O-:O-;O+:O+;A-:A-;B-:B-;B+:B+;AB-:AB-;AB+:AB+"}
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
		,editable:true*/
	}],
	   
	   pager: jQuery('#pcrudmov'),
    rowNum:10,
    rowList:[10,20,30],
	height:'auto',
	width:'auto',
    sortname: 'id_comp',
    sortorder: "asc",
    viewrecords: true,
     caption: 'Movimientos Tarjeta de Control',
	  postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
	},
	    editurl: 'gridmovi.php?q=1'// this is dummy existing url 
		
		 });
		 
		 var verdadero= true
		 
		 jQuery("#crudmov").jqGrid('navGrid','#pcrudmov',{edit:false,add:false,del:false},{height:400,reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true});
		 
		 
		 //////configurar colspan de la cabezera
		 
		// jQuery("#crudmov").jqGrid('setGroupHeaders', { useColSpanStyle: true, groupHeaders:[ {startColumnName: 'nombre1', numberOfColumns: 2, titleText: '<em>Nombres</em>'}, {startColumnName: 'apellido1', numberOfColumns: 2, titleText: 'Apellidos'} ] });
		 /////funcion de calendario

	
	
	 
	
	 });
    </script>
		<!--<script src="../themes/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../themes/development-bundle/ui/jquery.ui.widget.js"></script>--> 
	<!--<script src="../themes/development-bundle/ui/jquery.ui.datepicker.js"></script> 
	<script src="../themes/development-bundle/ui/jquery.ui.dialog.js"></script> 
	  <script src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>
	
    <script src="../themes/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	 <link rel="stylesheet" type="text/css" href="../themes/css/custom-theme/jquery-ui-1.8.16.custom.css">
	<link rel="stylesheet" type="text/css" href="../css/ui.jqgrid.css">
	
    <link rel="stylesheet" type="text/css" media="screen" href="../themes/ui.multiselect.css" /> 
   	<link rel="stylesheet" type="text/css" href="../themes/development-bundle/themes/custom-theme/jquery.ui.all.css"> 
    <link rel="stylesheet" type="text/css" media="screen" href="../themes/ui.multiselect.css" /> 
   <link rel="stylesheet" type="text/css" href="../plugins/ui.multiselect.css"> -->
</head>

<body>
<span class="Estilo1">Movimientos de la tarjeta </span>
			<table align="center" id="crudmov"  >
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>
			<div id="pcrudmov" align="center"></div>
</body>

</html>
