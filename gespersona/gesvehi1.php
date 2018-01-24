<?php
session_start();
 include('../inc/libreria.php');
 
 if(!valida_usr(25)){
 
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


	/////reporte de diarios
	jQuery("#crud").jqGrid({ url:'gridvehi.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['Movil','D.I.','Propietario','Placa','Clase','Marca','Referencia','Tipo','Motor','Chasis','Color','Modelo','Grupo',]
	  , colModel :[
	 	  
	  {
	  name:'id_movil'
		,index:'id_movil'
		,width:60
		,align:'center'
		,editable:{number:false}
		},{
		name:'id_prop'
		,index:'id_prop'
		,width:80
		,align:'center'
		,editable:false
	
		},{
			name:'nombre'
		,index:'nombre'
		,width:150
		//,align:'center'
		,editable:false
	 // ,editrules:{number:true}
		},{
		
	  name:'placa'
		,index:'placa'
		,width:60
		//,align:'center'
		,editable:false
		
	},{
	name:'clase'
		,index:'clase'
		,width:80
		//,align:'right'
		,editable:false	
	},{
	
		name:'marca'
		,index:'marca'
		,width:110
		,align:'center'
		,editable:false
	
		},{
	name:'referencia'
		,index:'referencia'
		,width:100
		//,align:'right'
		,editable:false	
		},{
	name:'tipo'
		,index:'tipo'
		,width:85
		//,align:'right'
		,editable:false	
	},{
		name:'motor'
		,index:'motor'
		,width:130
		,align:'center'
		,editable:false
	
		},{
	name:'serie'
		,index:'serie'
		,width:130
		//,align:'right'
		,editable:false	
		},{
	name:'color'
		,index:'color'
		,width:80
		//,align:'right'
		,editable:false	
	},{
		name:'modelo'
		,index:'modelo'
		,width:70
		,align:'center'
		,editable:false		
	
		},{
	name:'grupo'
		,index:'grupo'
		,width:70
		,align:'center'
		,editable:true	
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
    rowNum:200,
    rowList:[10,200,300],
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
		 
		 jQuery("#crud").jqGrid('navGrid','#pcrud',{edit:true,add:false,del:false},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true},{sopt:['cn','bw','eq','ne','lt','gt','ew','le','ge'], odata : ['igual ', 'no igual a', 'menor que', 'menor o igual que','mayor que','mayor o igual a', 'empiece por','no empiece por','est� en','no est� en','termina por','no termina por','contiene','no contiene'],
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
            var mya=new Array();
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
            document.forms[0].target='_blank';
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

<span class="Estilo1">Relaci&oacute;n de Pago de Diarios </span>
		<table align="center" id="crud"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrud" align="center"></div>

<form method="post" action="../gesdocs/csvExport.php">
    <input type="hidden" name="csvBuffer" id="csvBuffer" value="" />
</form>

<div id="novedad"  title="Novedad de Diarios"></div>
</body>
</html>
