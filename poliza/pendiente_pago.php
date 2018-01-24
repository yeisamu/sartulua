<?php
session_start();
 include('../inc/libreria.php');
 $link=conectarse();
 $ani=$_REQUEST['anio'];
 $seldetalle=mysql_query("SELECT distinct periodo from contractual where saldo > 0 order by periodo asc");
 $seldetalle1=mysql_query("SELECT distinct periodo from contractual where saldo > 0 order by periodo asc");
		 $y=1;
          $z=1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>relacion Pendientes por pago</title>
 <script  src="../inc/prototype.js"></script>
	<script  src="funpoli.js"></script>
	
 <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
 <script src="../js/i18n/grid.locale-es.js" type="text/javascript"></script>
 <script src="../src/jqDnR.js" type="text/javascript"></script>
 <script src="../src/jqModal.js" type="text/javascript"></script>
 <script src="../themes/ejemplo/ui/i18n/jquery.ui.datepicker-es.js"></script>
<script type="text/javascript">
	
  /*  $.jgrid.no_legacy_api = true;
    $.jgrid.useJSON = true;*/
jQuery.noConflict();
	jQuery(document).ready(function(){ 


	/////reporte de diarios
	jQuery("#crud").jqGrid({ url:'gridpendi_pago.php?q=1',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['Tipo Vehiculo','Movil','Placa','D.I.','Propietario','Apellido',<?php while($filadeta = mysql_fetch_array($seldetalle1,MYSQL_ASSOC)) { echo "'".$filadeta[periodo]."',"; $z++; } ?>'Saldo']
	  , colModel :[
	 	  
	  {
	  name:'tipov'
		,index:'tipov'
		,width:60
		//,align:'center'
		//,editable:{number:false}
		},{	
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
		,editable:false
		
		  },{
		name:'id_prop'
		,index:'id_prop'
		,width:80
		//,align:'center'
		,editable:false
		},{
		
			name:'nombre'
		,index:'nombre'
		,width:100
		//,align:'center'
		,editable:false
		,search:false
	 // ,editrules:{number:true}
	 },{
			name:'apellidos'
		,index:'apellidos'
		,width:150
		//,align:'center'
		,editable:false
		,search:false
	 // ,editrules:{number:true}
	
	 
   	},{
	<?php  while($filadeta = mysql_fetch_array($seldetalle,MYSQL_ASSOC)) {echo "name:'$filadeta[periodo]',index:'$filadeta[periodo]',width:80,align:'center',editable:false,search:false,formatter:'currency'
		,formatoptions:{decimalSeparator:'.',thousandsSeparator:',',decimalPlaces:0,prefix:'$'}
      ,sortable:false,sorttype:'number',formatter:'number', summaryType:'sum'},{";

$y++;
}?>

	name:'saldo'
		,index:'saldo'
		,width:80
		//,align:'right'
		,editable:false	
       ,formatter:'currency'
		,formatoptions:{decimalSeparator:".",thousandsSeparator:",",decimalPlaces:0,prefix:"$"}
      ,sortable:false
	,search:false
	,sorttype:'number',formatter:'number', summaryType:'sum'	
	}
	
	 
	],
	   
	   pager: jQuery('#pcrud'),
    rowNum:350,
    rowList:[10,200,300],
	height:'auto',
	width:'auto',
    sortname: 'id_movil',
    sortorder: "asc",
    viewrecords: true,
	grouping:true, 
	groupingView : { 
	groupField : ['tipov'], 
	groupColumnShow : [true], 
	groupText : ['<b>{0}</b>'], 
	groupCollapse : false, 
	groupOrder: ['asc'], 
	groupSummary : [true], 
	groupDataSorted : true}, 
	footerrow: true, 
	userDataOnFooter: true,
     caption: 'Relacion de Pendientes Por Pago',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
	
	
	loadComplete: function(){
		var ids = jQuery("#crud").getDataIDs();
  			
			
			//record=jQuery("#crudoc").jqGrid('getRowData',ids).codigo;
		 // jQuery("#crudoc").jqGrid('getRowData',ids);	       
		for(var i=0;i<ids.length;i++){
		   //  var dato = record[i];
			var cl = ids[i];
			
			 var rowData = jQuery(this).getRowData(cl); 
                  var movil= rowData['id_movil'];//replace name with you 
				  var ncontra= rowData['id_contra'];
				  var f_inc= rowData['f_inclusion'];
				 // alert(temp);	
			
	be = "<a id='inas' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=abre_cuota_contra('cuota','"+trim(movil)+"','"+ncontra+"','<?php echo $ani;?>');jQuery('#cuota').dialog('open');><span class='ui-icon ui-icon ui-icon-note'></span>Cuota</a>";
	se = "<a id='inas' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=abre_exclu('exclu','"+trim(movil)+"','"+f_inc+"','<?php echo $ani;?>');jQuery('#exclu').dialog('open');><span class='ui-icon ui-icon ui-icon-circle-minus'></span>Excl</a>"; 
	reimp = "<a id='inas' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=reimprime_cuota('imprime','"+trim(movil)+"','<?php echo $ani;?>');jQuery('#imprime').dialog('open');><span class='ui-icon ui-icon ui-icon-print'></span>Reimp</a>"; 
			
			jQuery("#crud").setRowData(ids[i],{oper:be+se+reimp})
		}	
	},	
		//jQuery('#crud').editRow("+cl+");abre_cuota_contra('cuota','"+trim(movil)+"','"+ncontra+"','<?php echo $ani;?>'); 
	
	
	    editurl: 'gridpendi_pago.php?q=1'// this is dummy existing url 
		
		 });
		 
		 jQuery("#crud").jqGrid('navGrid','#pcrud',{edit:false,add:false,del:false,search:false},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true},{sopt:['cn','bw','eq','ne','lt','gt','ew','le','ge'], odata : ['igual ', 'no igual a', 'menor que', 'menor o igual que','mayor que','mayor o igual a', 'empiece por','no empiece por','está en','no está en','termina por','no termina por','contiene','no contiene'],
            groupOps: [ { op: "AND", text: "todo" },    { op: "OR",  text: "cualquier" }        ],
}).navButtonAdd('#pcrud',{
                                caption:"Exportar", 
                                buttonicon:"ui-icon-calculator", 
                                onClickButton: function(){ 
                                 // exportExcel();
								 exportExcel();
                                }, 
                                //position:"last"
                           
      
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
            document.forms[0].action='excelpendi.php';  // send it to server which will open this contents in excel file
            document.forms[0].target='_blank';
            document.forms[0].submit();
        }	

 jQuery("#crud").jqGrid('filterToolbar');
			jQuery('#cuota').dialog({autoOpen: false, modal:true,width:550,height:650,position: ['left','top']});	
	        jQuery('#exclu').dialog({autoOpen: false, modal:true,width:400,height:350,position: ['left','top']});
			jQuery('#imprime').dialog({autoOpen: false, modal:true,width:400,height:350,position: ['left','top']});	
/*jQuery("#vcol").click(function (){

 jQuery("#crud").setColumns();
 });	*/	 
		 
	
		 
/*		
		 function pickdates(id){
	  jQuery('#pcrud').datepicker({dateFormat:'yy-mm-dd'});
}
	/*	 jQuery( "#tabs" ).tabs({
						//event: "mouseover"
					});*/
					
					
/*$("#bsdata").click(function(){
	jQuery("#crud").searchGrid(
		{sopt:['cn','bw','eq','ne','lt','gt','ew','le','ge'], odata : ['igual ', 'no igual a', 'menor que', 'menor o igual que','mayor que','mayor o igual a', 'empiece por','no empiece por','está en','no está en','termina por','no termina por','contiene','no contiene']
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
   <link rel="stylesheet" type="text/css" href="ui.multiselect.css">
  <!-- <link rel="stylesheet" type="text/css" href="jquery-ui.css"> -->
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
	width:583px;
	height:115px;
	z-index:2;
	left: 15px;
	top: 271px;
}
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
#Layer2 {
	position:absolute;
	width:319px;
	height:115px;
	z-index:3;
	left: 11px;
	top: 185px;
	display: none;
}
#graba_per{
display: none;
}
#cargando{

display: none;
}


-->
    </style>
	
</head>

<body>
<div  id="login1">login: [ <?php echo $_SESSION['login'];  ?>]</div>
<div id="Layer1"></div>
<div align="right"><span class="Estilo2"><a href="../login/index2.php" class="ui-state-hover">Volver al Men&uacute </a></span></div>

<p class="Estilo2">Relaci&oacute;n Pendientes Por Pagos seguro Contractual y Extracontractual </p>	
<!--<a href="#" id="vcol">Hide/Show Columns</a>-->
<div id="cuota" title="Liquidar Abono">

</div>
<div id="exclu" title="Excluir Vehiculo">

</div>
<div id="imprime" title="Reimprimir Certificado">

</div>

 <br/><br> <table id="setcols" class="scroll" cellpadding="0" cellspacing="0"></table> <div id="psetcols" class="scroll" style="text-align:center;"></div>

<table align="center" id="crud"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrud" align="center"></div>

<form method="post" action="excelpendi.php">
    <input type="hidden" name="csvBuffer" id="csvBuffer" value="" />
</form>

<div id="novedad"  title="Novedad de Diarios"></div>
<div id="expo"></div>
</body>
</html>
