<?php 
$id_movil=$_REQUEST['id_movil'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
     <script  src="../inc/prototype.js"></script>
	<script  src="../inc/funciones.js"></script>

	<script  src="../themes/js/jquery-1.6.2.min.js"></script> 
	<script  src="../themes/js/jquery-ui-1.8.16.custom.min.js"></script> 
<script  src="../js/jquery-ui-timepicker-addon.js"></script>
<script  src="../themes/ejemplo/ui/jquery.ui.slider.js"></script>
<script  src="../js/timepicker_slider_access.js"></script>
    <script src="../js/i18n/grid.locale-es.js" type="text/javascript"></script>
	<script src="../src/jqDnR.js" type="text/javascript"></script>
	
	<script src="../src/jqModal.js" type="text/javascript"></script>
	
	<script src="../themes/ejemplo/ui/i18n/jquery.ui.datepicker-es.js"></script>
	    <script src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>
  <script type="text/javascript">
  /*  $.jgrid.no_legacy_api = true;
    $.jgrid.useJSON = true;*/
     jQuery.noConflict();

	jQuery(document).ready(function(){ 
	
//////grid tarjetas


	jQuery("#crudtar").jqGrid({ 
	 scrollrows : true,
	url:'gridtarjetaactiva.php?q=1&id_movil=<?php echo $id_movil?>',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['Movil','Id Tarjeta','Tarjeta','','Documento','Conductor','']
	  , colModel :[
	 	  
	  {
	  name:'id_movil'
		,index:'id_movil'
		,width:55
		,align:'center'
		,editable:false
		,search:false
		},{
		 name:'id_tarjeta'
		,index:'id_tarjeta'
		,width:55
		,align:'center'
		,editable:false
		,search:true
		,hidden:true
		},{
	  name:'tarjeta'
		,index:'tarjeta'
		,width:70
		//,align:'center'
		,editable:true
		,search:true
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
		,width:100
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
		,width:220
		//,align:'right'
		,editable:true
		//,edittype:'select'
		//,editoptions:{value:"1:Si;0:No"}  Name:Value;Name:Value 
		,searchoptions:{dataInit:function(el){jQuery(el).autocomplete({
			source: "busca_condu_nc.php",
			 select: function(event, ui) {
                  }
		});} }
	},{
	  name:'total'
		,index:'total'
	//	,width:70
		//,align:'center'
		,hidden:true
		//,search:true
	}
	
	 
	],
	   
	   pager: jQuery('#pcrudtar'),
    rowNum:30,
   rowList:[10,20,30],
	height:'auto',
	width:'auto',
    sortname: 'id_movil',
    sortorder: "asc",
   viewrecords: true,
     caption: 'Tarjetas de Control Activas para el Movil <?php echo $id_movil?>',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		onSelectRow:
	 	function(ids) {
		  // function movil(ids) {
		  var datoscon = jQuery(this).getRowData(ids);
		  var tarj= datoscon['id_tarjeta'];
		jQuery('#id_tarjeta').val(ids);
		
		//}
	     jQuery( "#confirmar_cierre" ).dialog( "open" );
		
		 
	  
	 } 
	 ,
		
		//jQuery('#crud').editRow("+cl+"); 
			loadComplete: function(){
				//setTimeout(function(){jQuery('#crudtar').trigger('reloadGrid')},40000)
		var ids = jQuery("#crudtar").getDataIDs();
		//alert(ids)
		if(ids==''){
			jQuery('#total_tc').html("No Hay Tarjetas de control habilitadas para este movil");
			
			}
		
	}
	
	
	   , editurl: 'gridtarjetaactiva.php?q=1'// this is dummy existing url 
		
		 });
		 
		 jQuery("#crudtar").jqGrid('navGrid','#pcrudtar',{search:false,edit:false,add:false,del:false},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true});


		 
		 
jQuery("#crudtar").jqGrid('filterToolbar');	


	jQuery( "#confirmar_cierre" ).dialog({
			resizable: false,
			autoOpen: false,
			height:160,
			modal: true,
			buttons: {
				"Aceptar": function() {
					jQuery( this ).dialog( "close" );
					grabar_asigna_frec()
					return 1;
				},
				Cancel: function() {
					jQuery( this ).dialog( "close" );
					return 0;
					//jQuery('#cerrar').dialog( 'close' );
				}
			}
		});
});					
					

	//	 });
    </script>
	<style type="text/css">
	#confirmar_cierre{
display: none;
}
	</style>
	 <link rel="stylesheet" type="text/css" href="../themes/css/custom-theme/jquery-ui-1.8.16.custom.css">
	<link rel="stylesheet" type="text/css" href="../css/ui.jqgrid.css">

   <link rel="stylesheet" type="text/css" href="../plugins/ui.multiselect.css">
</head>

<body>
<table align="center" id="crudtar"  >
<tr><td>&nbsp;</td></tr></table>
<div id="pcrudtar" align="center"></div>
<div id="confirmar_cierre" title="Activar Frecuencia">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta Segur@ de poner este Movil  en Frecuencia?</p>
</div>
<p>&nbsp;</p>
<div id="total_tc" class="ui-state-error ui-state-error-text"></div>

<input type="hidden" name="id_tarjeta" id="id_tarjeta" />

</body>
</html>
