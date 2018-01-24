<?php
session_start();
 include('../inc/libreria.php');
 include('../inc/operaciones.php');
 
 if(!valida_usr(33)){
 
 echo "Acceso No Autorizado";
 return ;
 }
//SELECT id_simit,codigo,nombre1,nombre2,apellido1,apellido2,id_movil,n_parte,`cod_infraccion`,eps,`valor`,`fecha_parte`,`fecha_pago`,if(simit.`estado`=1,'Activa','Paga') FROM (`simit` inner join (conductor inner join tarjeta_control on conductor.`id_conductor`=tarjeta_control.`id_conductor`  ) on simit.`id_conductor`=conductor.`id_conductor`) inner join entidad_salud on simit.`id_eps`=entidad_salud.`id_eps` order by codigo,`n_parte` 


    
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
     url:'gridmultasact.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['Codigo','Cedula','','','','','Multa','Codigo','Entidad','valor','Fecha Multa','Fecha Pago','Convenio','OBS','Estado','Movil','Placa','grupo']
	  , colModel :[
	{name:'id_simit'
		,index:'id_simit'
		,width:10
		//,align:'right'
		,editable:false	
		,search:false
		,hidden:true
	},{
	
		name:'codigo'
		,index:'codigo'
		,width:60
		,editable:true
		,searchoptions:{dataInit:function(el){jQuery(el).autocomplete({
			source: "busca_condu.php",
			 select: function(event, ui) {
                  }
		});} }
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
		name:'nombre1'
		,index:'nombre1'
		,width:60
		//,align:'right'
		,editable:true
		,searchoptions:{dataInit:function(el){jQuery(el).autocomplete({
			source: "busca_condu_n1.php",
			 select: function(event, ui) {
                  }
		});} }
		//,edittype:'select'
		//,editoptions:{value:"1:Si;0:No"}  Name:Value;Name:Value 
	},{
	name:'nombre2'
		,index:'nombre2'
		,width:60
		//,align:'right'
		,editable:true
		//,edittype:'select'
		//,editoptions:{value:"1:Si;0:No"}  Name:Value;Name:Value 
	},{
		name:'apellido1'
		,index:'apellido1'
		,width:60
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
		,width:60
		//,align:'right'
		,editable:true
		,searchoptions:{dataInit:function(el){jQuery(el).autocomplete({
			source: "busca_condu_ap2.php",
			 select: function(event, ui) {
                  }
		});} }
	
	},{
	  name:'n_parte'
		,index:'n_parte'
		,width:40
		//,align:'center'
		//,hidden:true
/*	},{
	  name:'fecha_elab'
		,index:'fecha_elab'
		,width:70
		//,align:'center'
		//,hidden:true	
	},{
	  name:'estado'
		,index:'estado'
		,width:50
		,align:'center'*/
		//,hidden:true
		
		},{ name:'cod_infraccion'
		,index:'cod_infraccion'
		,width:70
		//,formatter:'date', formatoptions:{srcformat:"Y-m-d H:i",newformat:"d-M-Y h:i a"}
		
	},{
	  name:'eps'
		,index:'eps'
		,width:70
		//,align:'center'	
		//,search:false
		},{
	  name:'valor'
		,index:'valor'
		,width:65
		,align:'center'	
		
		,formatter:'integer'
		,formatoptions:{thousandsSeparator:",", decimalSeparator:".",prefix:"$ "}
		//,hidden:true
		},{
	  name:'fecha_parte'
		,index:'fecha_parte'
		,width:78
		,align:'center'	
		//,hidden:true
		},{
	  name:'fecha_pago'
		,index:'fecha_pago'
		,width:78
		//,search:true
		//,align:'center'	
		//,hidden:true
			},{
	  name:'convenio'
		,index:'convenio'
		,width:50
		//,search:true
		//,align:'center'	
		//,hidden:true
			},{
	  name:'observacion'
		,index:'observacion'
		,width:60
		//,search:true
		//,align:'center'	
		//,hidden:true
	},{name:'estado',index:'estado', width:65,search:false
	},{name:'movil',index:'movil', width:50,search:false
	},{name:'placa',index:'placa', width:50,search:false
	},{
	name:'grupo',index:'grupo', width:65,search:true,sortable:false
	
	}
	],
	   
	  // pager: jQuery('#pcrudoc'),
	  pager: jQuery('#pmulta'),
    rowNum:500,
    //rowList:[10,20,30],
	//scroll: true, 
	height:'auto',
	
	width:'auto',
    sortname: 'estado,b.id_conductor',
    sortorder: "asc",
    viewrecords: true,
     caption: 'Reporte de Comparendos',
/*   jsonReader: {
		repeatitems : true,
		cell:"",
		id: "0"
	},*/
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
           /* var mya=new Array();
            mya=jQuery("#multa").getDataIDs();  // Get All IDs
            var data=jQuery("#multa").getRowData(mya[0]);     // Get First row to get the labels
            var colNames=new Array(); 
           var ii=0;
            var html="";
            for (var i in data){colNames[ii++]=i;html=html+i+"\t";}    // capture col names
           html=html+"\n";
            for(i=0;i<mya.length;i++)
                {
                data=jQuery("#multa").getRowData(mya[i]); // get each row
                for(j=0;j<colNames.length;j++)
                    {
                    html=html+data[colNames[j]]+"\t"; // output each column as tab delimited
                    }
                html=html+"\n";  // output each row with end of line

                }
            html=html+"\n";  // end of line at the end*/
            //document.forms[0].csvBuffer.value=html;
           // document.forms[0].method='POST';
           // document.forms[0].action='csvExport.php';  // send it to server which will open this contents in excel file
          //  document.forms[0].target='_blank';
            document.getElementById('frmpermitidas').submit();
        }							
	  
		   jQuery("#multa").jqGrid('setGroupHeaders', { useColSpanStyle: true, groupHeaders:[ {startColumnName: 'nombre1', numberOfColumns: 2, titleText: '<em>Nombres</em>'}, {startColumnName: 'apellido1', numberOfColumns: 2, titleText: 'Apellidos'}, {startColumnName: 'tarj', numberOfColumns: 2, titleText: 'Tarjeta Ctrl'}	 ] });
//	 
  jQuery("#multa").jqGrid('filterToolbar');
	
//////////////////////////////////////////multas con tarjetas suspendidas
jQuery("#multasus").jqGrid({ 
   //scroll: true,
     url:'gridmultasus.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['Codigo','Cedula','','','','','Multa','Codigo','Entidad','valor','Fecha Multa','Fecha Pago','Convenio','OBS','Estado','Movil','Placa','Grupo']
	  , colModel :[
	{name:'id_simit'
		,index:'id_simit'
		,width:10
		//,align:'right'
		,editable:false	
		,search:false
		,hidden:true
	},{
	
		name:'codigo'
		,index:'codigo'
		,width:60
		,editable:true
		,searchoptions:{dataInit:function(el){jQuery(el).autocomplete({
			source: "busca_condu.php",
			 select: function(event, ui) {
                  }
		});} }
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
		name:'nombre1'
		,index:'nombre1'
		,width:60
		//,align:'right'
		,editable:true
		,searchoptions:{dataInit:function(el){jQuery(el).autocomplete({
			source: "busca_condu_n1.php",
			 select: function(event, ui) {
                  }
		});} }
		//,edittype:'select'
		//,editoptions:{value:"1:Si;0:No"}  Name:Value;Name:Value 
	},{
	name:'nombre2'
		,index:'nombre2'
		,width:60
		//,align:'right'
		,editable:true
		//,edittype:'select'
		//,editoptions:{value:"1:Si;0:No"}  Name:Value;Name:Value 
	},{
		name:'apellido1'
		,index:'apellido1'
		,width:60
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
		,width:60
		//,align:'right'
		,editable:true
		,searchoptions:{dataInit:function(el){jQuery(el).autocomplete({
			source: "busca_condu_ap2.php",
			 select: function(event, ui) {
                  }
		});} }
	
	},{
	  name:'n_parte'
		,index:'n_parte'
		,width:40
		//,align:'center'
		//,hidden:true
/*	},{
	  name:'fecha_elab'
		,index:'fecha_elab'
		,width:70
		//,align:'center'
		//,hidden:true	
	},{
	  name:'estado'
		,index:'estado'
		,width:50
		,align:'center'*/
		//,hidden:true
		
		},{ name:'cod_infraccion'
		,index:'cod_infraccion'
		,width:70
		//,formatter:'date', formatoptions:{srcformat:"Y-m-d H:i",newformat:"d-M-Y h:i a"}
		
	},{
	  name:'eps'
		,index:'eps'
		,width:70
		//,align:'center'	
		//,search:false
		},{
	  name:'valor'
		,index:'valor'
		,width:65
		,align:'center'	
		
		,formatter:'integer'
		,formatoptions:{thousandsSeparator:",", decimalSeparator:".",prefix:"$ "}
		//,hidden:true
		},{
	  name:'fecha_parte'
		,index:'fecha_parte'
		,width:78
		,align:'center'	
		//,hidden:true
		},{
	  name:'fecha_pago'
		,index:'fecha_pago'
		,width:78
		//,search:true
		//,align:'center'	
		//,hidden:true
			},{
	  name:'convenio'
		,index:'convenio'
		,width:50
		//,search:true
		//,align:'center'	
		//,hidden:true
			},{
	  name:'observacion'
		,index:'observacion'
		,width:60
		//,search:true
		//,align:'center'	
		//,hidden:true
	},{name:'estado',index:'estado', width:65,search:false
	},{name:'movil',index:'movil', width:50,search:true
	},{name:'placa',index:'placa', width:50,search:true
	},{
	name:'grupo',index:'grupo', width:65,search:true,sortable:true
	
	}
	],
	   
	  // pager: jQuery('#pcrudoc'),
	  pager: jQuery('#pmultasus'),
    rowNum:500,
    //rowList:[10,20,30],
	//scroll: true, 
	height:'auto',
	
	width:'auto',
    sortname: 'estado,a.id_conductor,grupo',
    sortorder: "asc",
    viewrecords: true,
     caption: 'Reporte de Comparendos Tarjetas Suspendidas',
/*   jsonReader: {
		repeatitems : true,
		cell:"",
		id: "0"
	},*/
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		
	},
	    editurl: 'gridmultas.php?q=1'// this is dummy existing url 
		
		 });
		  jQuery("#multasus").jqGrid('navGrid','#pmultasus',{edit:false,add:false,del:false,searchtext:'Busqueda', excel:true},{height:400,reloadAfterSubmit:true,closeAfterEdit : true},{closeOnEscape:true},{closeOnEscape:true},{sopt:['cn','bw','eq','ne','lt','gt','ew','le','ge']}).navButtonAdd('#pmultasus',{
                                caption:"Exportar", 
                                buttonicon:"ui-icon-calculator", 
                                onClickButton: function(){ 
                                  exportExcelsus();
                                }, 
                                position:"last"
                            });
							
							
function exportExcelsus()
        {
            /*var mya=new Array();
            mya=jQuery("#multasus").getDataIDs();  // Get All IDs
            var data=jQuery("#multasus").getRowData(mya[0]);     // Get First row to get the labels
            var colNames=new Array(); 
			var ii=0;
            var html="";
            for (var i in data){colNames[ii++]=i;html=html+i+"\t";}    // capture col names
           html=html+"\n";
            for(i=0;i<mya.length;i++)
                {
                data=jQuery("#multasus").getRowData(mya[i]); // get each row
                for(j=0;j<colNames.length;j++)
                    {
                    html=html+data[colNames[j]]+"\t"; // output each column as tab delimited
                    }
                html=html+"\n";  // output each row with end of line

                }
            html=html+"\n";  // end of line at the end
            document.forms[0].csvBuffer.value=html;
            document.forms[0].method='POST';
            document.forms[0].action='csvExport.php';  // send it to server which will open this contents in excel file
            document.forms[0].target='_blank';*/
            document.getElementById('frmsuspendidas').submit();
        }							
	  
		   jQuery("#multasus").jqGrid('setGroupHeaders', { useColSpanStyle: true, groupHeaders:[ {startColumnName: 'nombre1', numberOfColumns: 2, titleText: '<em>Nombres</em>'}, {startColumnName: 'apellido1', numberOfColumns: 2, titleText: 'Apellidos'}, {startColumnName: 'tarj', numberOfColumns: 2, titleText: 'Tarjeta Ctrl'}	 ] });
//	 
  jQuery("#multasus").jqGrid('filterToolbar');
	
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

<span class="Estilo1">Reporte de Multas de Transito</span>
<table align="center" id="multa"  >
<tr><td>&nbsp;</td></tr></table><div id="pmulta" align="center"></div>

<p class="Estilo1">&nbsp;</p>
<p class="Estilo1">Reporte de Multas de Transito tarjetas suspendidas
</p>
<p>&nbsp;</p>
<table align="center" id="multasus"  >
<tr><td>&nbsp;</td></tr></table><div id="pmultasus" align="center"></div>

<form method="post" action="excelpermitidas.php" name="frmpermitidas" id="frmpermitidas">
    <!--<input type="hidden" name="csvBuffer" id="csvBuffer" value="" />-->
</form>
<form method="post" action="excelsuspendidas.php" name="frmsuspendidas" id="frmsuspendidas">
    <!--<input type="hidden" name="csvBuffer" id="csvBuffer" value="" />-->
</form>
</body>
</html>
