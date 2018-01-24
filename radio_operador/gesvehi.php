<?php
session_start();
 include('../inc/libreria.php');
 
 if(!valida_usr(9)){
 
 echo "Acceso No Autorizado";
 return ;
 }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Relaci&oacute;n de Pago de Diarios</title>
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
		jQuery("#crudnov").jqGrid({ 

     url:'gridreportediario.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['','Movil','Fecha Elab','Pago Hasta','','','Acciones']
	, colModel :[
	{
	name:'id_nov'
		,index:'id_nov'
		,width:40
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
	name:'fecha'
		,index:'fecha'
		,width:120
		//,align:'right'
		,editable:false	
		,search:false
		
	},{
	name:'pago_hasta_n'
		,index:'pago_hasta_n'
		,width:80
		//,align:'right'
		,editable:false	
		,search:false
	},
	{
	
		name:'control'
		,index:'control'
		,width:35
		,hidden:true
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
		name:'control2'
		,index:'control2'
		,hidden:true
		, width:70
		,search:false
	},{name:'accion',index:'accion',align:'center', width:80,sortable:false,search:false	
	
	}
	],
	   
	  // pager: jQuery('#pcrudoc'),
	   pager: jQuery('#pcrudnov'),
    rowNum:5,
    //rowList:[10,20,30],
	height:'auto',
	width:'auto',
    sortname: 'fecha',
    sortorder: "desc",
    viewrecords: true,
     caption: 'Pago de Diarios',
	 
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		 
		 
		 
	loadComplete:function(){
	    
		setTimeout(function(){jQuery('#crudnov').trigger('reloadGrid')},30000)
		var ids = jQuery("#crudnov").getDataIDs();
		for(var i=0;i<ids.length;i++){
			var cl = ids[i];
			 var rowData = jQuery(this).getRowData(cl);
			  var estado1= rowData['control'];
			    var id_nov= rowData['id_nov'];
			  var estado2= rowData['control2'];
			  var id_movil= rowData['id_movil'];
			 var plazo= rowData['pago_hasta_n'];
			 
			//replace name with you 

	btn = "<input style='height:22px;width:60px;' type='button' value='Revisado' onclick=actu_estado_diario("+i+"); />";
	
	id_nove= "<input  id='id_nov"+i+"' type='hidden' value="+id_nov+" />"; 
	id_mov= "<input  id='id_movil"+i+"' type='hidden' value="+id_movil+" />"; 
	plazo_a= "<input  id='plazo"+i+"' type='hidden' value="+plazo+" />"; 
	
			jQuery("#crudnov").setRowData(ids[i],{accion:btn+id_nove+id_mov+plazo_a})
			
		}	
	},
	    editurl: 'gridreportediario.php?q=1'// this is dummy existing url 
		
		 });
		  jQuery("#crudnov").jqGrid('navGrid','#pcrudnov',{edit:false,add:false,del:false,searchtext:'Busqueda'},{height:400,reloadAfterSubmit:true,closeAfterEdit : true},{closeOnEscape:true},{closeOnEscape:true},{sopt:['cn','bw','eq','ne','lt','gt','ew','le','ge']});
	
 jQuery("#crudnov").jqGrid('filterToolbar');

	/////reporte de diarios
	jQuery("#crud").jqGrid({ url:'gridvehi.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['Movil','Placa','Clase','','Marca','Referencia','Tipo','Motor','Serie','Color','Modelo','Pago Hasta','Dias Mora','Grupo',]
	  , colModel :[
	 	  
	  {
	  name:'id_movil'
		,index:'id_movil'
		,width:60
		,align:'center'
		,editable:{number:false}
		},{
	  name:'placa'
		,index:'placa'
		,width:60
		//,align:'center'
		,editable:true
		
	},{
	name:'clase'
		,index:'clase'
		,width:80
		//,align:'right'
		,editable:true	
	},{
	name:'id_marca'
		,index:'id_marca'
		,width:80
		//,align:'right'
		,editable:true	
		,hidden:true
	},{
		name:'marca'
		,index:'marca'
		,width:80
		,align:'center'
		,editable:true
	
		},{
	name:'referencia'
		,index:'referencia'
		,width:85
		//,align:'right'
		,editable:true	
		},{
	name:'tipo'
		,index:'tipo'
		,width:60
		//,align:'right'
		,editable:true	
	},{
		name:'motor'
		,index:'motor'
		,width:80
		,align:'center'
		,editable:true
	
		},{
	name:'serie'
		,index:'serie'
		,width:85
		//,align:'right'
		,editable:true	
		},{
	name:'color'
		,index:'color'
		,width:60
		//,align:'right'
		,editable:true	
	},{
		name:'modelo'
		,index:'modelo'
		,width:70
		,align:'center'
		,editable:true		
	},{
		name:'pago_hasta'
		,index:'pago_hasta'
		,width:80
		,align:'center'
		,editable:true
	
		},{
			name:'dias_mora'
		,index:'dias_mora'
		,width:90
		,align:'left'
		,editable:true
	  ,editrules:{number:true}
		},{
	name:'grupo'
		,index:'grupo'
		,width:70
		//,align:'right'
		,editable:true	
		,hidden:true
	 // , edittype: 'file'
/*	 ,formatter:function() {
	 var ids = jQuery("#crud").getDataIDs();
  			
			
			//record=jQuery("#crudoc").jqGrid('getRowData',ids).codigo;
		 // jQuery("#crudoc").jqGrid('getRowData',ids);	       
		for(var i=0;i<ids.length;i++){
		   //  var dato = record[i];
			var cl = ids[i];
			
			 var rowData = jQuery(this).getRowData(cl); 
                  var temp= rowData['logo'];//replace name with you 
				//  alert(temp)
                             be="<img src='logo/"+temp+".GIF'/>";
 			 jQuery("#crud").setRowData(ids[i],{logo:be})
}
}	  
*/	}
	
	 
	],
	   
	   pager: jQuery('#pcrud'),
    rowNum:50,
    rowList:[100,200,300],
	height:'auto',
	width:'auto',
    sortname: 'id_movil',
    sortorder: "asc",
    viewrecords: true,
     caption: 'Gestion de movil',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl+"); 
	
	
	    editurl: 'gridvehi.php?q=1'// this is dummy existing url 
		
		 });
		 
		 jQuery("#crud").jqGrid('navGrid','#pcrud',{edit:false,add:false,del:false},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true},{sopt:['cn','bw','eq','ne','lt','gt','ew','le','ge'], odata : ['igual ', 'no igual a', 'menor que', 'menor o igual que','mayor que','mayor o igual a', 'empiece por','no empiece por','est� en','no est� en','termina por','no termina por','contiene','no contiene'],
            groupOps: [ { op: "AND", text: "todo" },    { op: "OR",  text: "cualquier" }        ],
}).navButtonAdd('#pcrud',{
                                caption:"Exportar", 
                                buttonicon:"ui-icon-calculator", 
                                onClickButton: function(){ 
                                  exportExcel();
                                }, 
                                position:"last"
                            });
							
							
function exportExcel()
        {
            /*var mya=new Array();
            mya=jQuery("#crud").getDataIDs();  // Get All IDs
            var data=jQuery("#crud").getRowData(mya[0]);     // Get First row to get the labels
            var colNames=new Array(); 
            var ii=0;
            for (var i in data){colNames[ii++]=i;}    // capture col names
            var html="";
            for(i=0;i<mya.length;i++)
                {
                data=jQuery("#crud").getRowData(mya[i]); // get each row
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
            document.forms[0].target='_blank';*/
            document.forms[0].submit();
        }	

 jQuery("#crud").jqGrid('filterToolbar');
		 
		 
	
		 
/*		
		 function pickdates(id){
	  jQuery('#pcrud').datepicker({dateFormat:'yy-mm-dd'});
}
	/*	 jQuery( "#tabs" ).tabs({
						//event: "mouseover"
					});*/
					
					
/*$("#bsdata").click(function(){
	jQuery("#crud").searchGrid(
		{sopt:['cn','bw','eq','ne','lt','gt','ew','le','ge'], odata : ['igual ', 'no igual a', 'menor que', 'menor o igual que','mayor que','mayor o igual a', 'empiece por','no empiece por','est� en','no est� en','termina por','no termina por','contiene','no contiene']
}
	)
});	*/
jQuery('#novedad').dialog({autoOpen: false, modal:true,width:650,height:900,}); 				
});					
					

	//	 });
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
	#box {
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
<span class="Estilo1">Pago de Diarios Reciente</span>
<table align="center" id="crudnov"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudnov" align="center"> </div>
  <p>&nbsp;</p>
<span class="Estilo1">Relaci&oacute;n de Pago de Diarios </span>
		<table align="center" id="crud"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrud" align="center"></div>

<form method="post" action="excelparque.php">
    <input type="hidden" name="csvBuffer" id="csvBuffer" value="" />
</form>

<div id="novedad"  title="Novedad de Diatios"></div>
</body>
</html>
