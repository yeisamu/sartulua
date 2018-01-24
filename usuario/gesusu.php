<?php
session_start();
 include('../inc/libreria.php');
 
 if(!valida_usr(2)){
 
 echo "Acceso No Autorizado";
 return ;
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gestion usuarios del Sistema</title>
   <script  src="../inc/prototype.js"></script>
	<script  src="../inc/funciones.js"></script>
    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	
    <script src="../js/i18n/grid.locale-es.js" type="text/javascript"></script>
	<script src="../src/jqDnR.js" type="text/javascript"></script>
		<script src="../themes/development-bundle/ui/jquery.ui.autocomplete.js" type="text/javascript"></script>
	<script src="../src/jqModal.js" type="text/javascript"></script>
	 <script type="text/javascript">
      jQuery.noConflict();
	jQuery(document).ready(function(){ 
	jQuery("#crud").jqGrid({ url:'gridusu.php',
	 datatype: "json", 
	  mtype: 'POST',
	  colNames:['Id','Login','Clave','Admin']
	  , colModel :[
	 	  
	  {
	  name:'id_usr'
		,index:'id_usr'
		,width:55
		,align:'center'
		,editable:false
		},{
	  name:'login'
		,index:'login'
		,width:60
		//,align:'center'
		,editable:true
		
	},{
	name:'clave'
		,index:'clave'
		,width:100
		//,align:'right'
		,editable:true
		, edittype: 'password'	
		,hidden:true
		,editrules:{edithidden:true,required:true}
		,editoptions:{
		dataInit:
		function(elm){
                  jQuery(elm).val('');
                  //  jQuery('.ui-datepicker').css({'font-size':'85%'});
               // },200);}
				}
				}
				
	},{
	  name:'admin'
		,index:'admin'
		,width:60
		//,align:'center'
		,editable:true
		,edittype:'select'
		,editoptions:{value:"1:Si;0:No"}			
	  
	}
	
	 
	],
	   
	   pager: jQuery('#pcrud'),
    rowNum:10,
    rowList:[10,20,30],
	height:200,
	width:600,
    sortname: 'id_usr',
    sortorder: "asc",
   //viewrecords: true,
     caption: 'Gestión de Usuarios',
	 /////llamado de la grilla detalle 
	 	 onSelectRow:
	 	function(ids) {
		 if(ids == null) { 
		 ids=0; 
		 if(jQuery('#crudper').jqGrid('getGridParam','records') >0 ) {
		 jQuery('#crudper').jqGrid('setGridParam',{url:'gridper.php?id_usr='+ids,page:1});
		 jQuery('#crudper').jqGrid('setCaption','Detalle de permisos para el usuario: '+ids) .trigger('reloadGrid');
		
		  }
	}else { 
	jQuery('#crudper').jqGrid('setGridParam',{url:'gridper.php?id_usr='+ids,page:1});
	jQuery('#crudper').jqGrid('setCaption','Detalle de permisos para el usuario: '+ids) .trigger('reloadGrid');

	 } 
	 }
		
	 
	 
	 
	 
	 
	, postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
		//jQuery('#crud').editRow("+cl+"); if(gsr){ jQuery("#custbut").GridToForm(gsr,"#order"); } else { alert("Please select Row") }
	
	
	    editurl: 'gridusu.php'// this is dummy existing url 
		
		 });
		 
		 jQuery("#crud").jqGrid('navGrid','#pcrud',{edit:true,add:true,del:true},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true});

/////agregar botton en la barra 
jQuery("#crud").jqGrid('navButtonAdd','#pcrud',{caption:"",buttonicon:"ui-icon-check", onClickButton:function(){ registra_opc();  } }); 
		 
jQuery("#crud").jqGrid('navButtonAdd','#pcrud',{caption:"Res",buttonicon:"ui-icon-arrowrefresh-1-s", onClickButton:function(){ resetea_opc() } }); 		 
	


////subgrid detalle de permisos
jQuery("#crudper").jqGrid({ 

     url:'gridper.php',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['','Usuario','','Opcion','Permiso',]
	  , colModel :[
	{name:'id_permiso'
		,index:'id_permiso'
		,width:50
		,hidden:true
		//,editable:true	
		
	},{
	
	
	   name:'id_usr'
		,index:'id_usr'
		,width:50
		//,align:'right'
		,editable:false	
		,hidden:true
	},{
	name:'id_opcion'
		,index:'id_opcion'
		,width:80
		,hidden:true
		//,editrules:{edithidden:true,required:true}
		,editable:true		
	},{
	name:'opcion'
		,index:'opcion'
		,width:150
		//,align:'right'
		,editable:true
		,editoptions:{readonly:true,size:40}	
	},{
	
	 name:'permiso'
		,index:'permiso'
		,width:55
		,align:'center'
		,editable:true	
		,edittype:"select"
		,editoptions:{value:"0:NO;1:SI"}

	},
	],
	   
	   pager: jQuery('#pcrudper'),
    rowNum:10,
   rowList:[10,20,30],
	height:'auto',
	width:350,
    sortname: 'id_permiso',
    sortorder: "asc",
   // viewrecords: true,
     caption: 'Detalle de permisos',
	 
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		
	
	    editurl: 'gridper.php'// this is dummy existing url 
		
		 });
		 
		  jQuery("#crudper").jqGrid('navGrid','#pcrudper',{edit:true,add:false,del:false,searchtext:'Buscar'},{reloadAfterSubmit:true,closeAfterEdit : true},{},{},{sopt:['cn','bw','eq','ne','lt','gt','ew','le','ge']});


		 });
    </script>
    <script src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>
	
    <script src="../themes/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	 <link rel="stylesheet" type="text/css" href="../themes/css/custom-theme/jquery-ui-1.8.16.custom.css">
	<link rel="stylesheet" type="text/css" href="../css/ui.jqgrid.css">
	
   <!-- <link rel="stylesheet" type="text/css" media="screen" href="../themes/ui.multiselect.css" /> -->
   <link rel="stylesheet" type="text/css" href="../plugins/ui.multiselect.css">
    <style type="text/css">
<!--
.Estilo1 {
	color: #333333;
	font-size: 36px;
	font-weight: bold;
	font-style: italic;
}
-->
    </style>
	<style type="text/css">
			/*demo page css*/
			body{ font: 50.5% "Trebuchet MS", sans-serif; margin: 50px;}
			.demoHeaders { margin-top: 2em; }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}

   
    </style>	
</head>

<body>

<div align="right">
  <div  id="login1">login: [ <?php echo $_SESSION['login'];  ?>]</div>
<span class="Estilo2"><a href="../login/index2.php" class="ui-state-hover">Volver al Men&uacute </a></span></div>
<span class="Estilo1">Gesti&oacute;n de Usuarios   </span>
<!--<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Usuario</a></li>
				<li><a href="#tabs-2">Conductor</a></li>
				<li><a href="#tabs-3">Asociado</a></li>
			</ul>
 -->			<table align="center" id="crud"  >
<tr><td>&nbsp;</td></tr></table>
<p>&nbsp;</p>
<div id="pcrud" align="center"></div>


		<table  id="crudper"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudper" align="center"></div>


<div id="registrar"></div>

</body>
</html>
