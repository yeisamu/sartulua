<?php
session_start();
 include('../inc/libreria.php');
  $link=conectarse();
 if(!valida_usr(29)){
 
 echo "Acceso No Autorizado";
 return ;
 }
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>relacion de pagos</title>
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
	jQuery("#peripoli").change(function(event) {
	var valor=jQuery("#peripoli").val();
	 if(valor!= ""){
        jQuery.ajax({
            type: "POST",
            url: "valida_pago.php",
            data: "periodo="+valor,
           // beforeSend: function(){
//             // $('#movil').html('verificando');
//            },
            success: function( respuesta ){
              if(respuesta == '0'){
              //	alert(valor)
				
					  var st = "#t"+valor;
				if(jQuery(st).html() != null ) {
					maintab.tabs('select',st);
				} else {
					//maintab.tabs('add',st, treedata.menu);
					jQuery("#tabs").load("relacionpagos.php?anio="+valor);
					//jQuery("#Layer2").hidden();
					document.getElementById("Layer2").style.display="none";
					document.getElementById("tabs").style.display="block";
					//alert(rowid)
				}
				// new Ajax.Updater('destino','graba_mov.php?id_movil='+idmovil+'&id_serv='+id_serv+'&direccion='+direc+'&deta='+deta+'&i='+i,{asynchronous: true, method: 'get',evalScripts:true});
             } else{
            			
				//alert("Movil No esta en Frecuencia")
					jQuery("#Layer2").show();
					jQuery("#datoper").html('Registrar Moviles en el periodo  '+valor);
					document.getElementById("tabs").style.display="none";
			//	}
				
			}	
            }
        });
		}else{
			
		alert('Indique un Periodo')	
			
		}
	
	
	

	});
	
	
	jQuery( "#graba_per" ).dialog({
			resizable: false,
			autoOpen: false,
			height:160,
			modal: true,
			buttons: {
				"Aceptar": function() {
					jQuery( this ).dialog( "close" );
					jQuery("#Layer2").slideUp();
					iniciacarga();
					var idper=jQuery('#peripoli').val();
					//alert(idper)
					grabar_contractual('grabador',idper)
					
					
					return 1;
				},
				Cancel: function() {
					jQuery( this ).dialog( "close" );
					jQuery("#Layer2").slideUp();
					return 0;
					//jQuery('#cerrar').dialog( 'close' );
				}
			}
		});	
		

jQuery('#egreso').dialog({autoOpen: false, modal:true,width:420,height:300});

			 
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
#Layer3 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:4;
	left: 585px;
	top: 97px;
}
#egreso{

display: none;
}

-->
    </style>
</head>

<body>
<div  id="login1">login: [ <?php echo $_SESSION['login'];  ?>]</div>
<div id="Layer1"></div>
<div align="right"><span class="Estilo2"><a href="../login/index2.php" class="ui-state-hover">Volver al Men&uacute </a></span></div>

<p class="Estilo2">Relaci&oacute;n Pagos seguro Contractual y Extracontractual </p>

<!-- <div class="Estilo2" id="Layer3"><a href="#" class="ui-state-hover" onClick="abre_egreso('egreso');jQuery('#egreso').dialog('open');" >Registrar Egresos</a>
<div id="egreso" title="Registrar Egresos">
</div>
</div>-->


<select id="peripoli" name="peripoli" class="ui-corner-all">
<option value="" >Seleccione Periodo</option>
<?php 
$seleper=mysql_query("select distinct concat_ws('-',year(`fini`),year(`ffin`)) as periodo,year(`fini`) as perini from valor_poliza order by year(`fini`) desc ");
$anioac=date('Y');
while($filaper=mysql_fetch_array($seleper)){
$perio=$filaper['perini'];
 ?>


<option <?php echo $filaper['periodo']  ?> <?php  //if($perio==$anioac) {echo "selected='selected'";}?>><?php echo $filaper['periodo']  ?></option>
<?php
}
  ?>
</select>
<div id="cargando" style="text-align:center;">
<b>Cargando...</b>
<img src="imagenes/loadingbar-deep-orange.gif" />
</div>
<div id="Layer2">
<table width="100%" border="1"  class="ui-corner-all">
  <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top ">
    <td colspan="2" style="font-size:14px" class="ui-corner-all " ><div id="datoper"></div></td>
  </tr>
  <tr class="ui-corner-all ">
    <td class="ui-corner-all "><div align="center"><a id='des' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=jQuery('#graba_per').dialog('open');>Grabar<span class='ui-icon ui-icon-circle-plus'></span></a></div></td>
    <td class="ui-corner-all "><div align="center"><a id='des' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=jQuery("#Layer2").slideUp();>Cancelar<span class='ui-icon ui-icon-cancel'></span></a></div></td>
  </tr>
</table>
<div id="graba_per" title="Incluir Moviles En el Periodo">
<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta Segur@ de Incluir todos los moviles para este periodo?</p>
</div>

<div id="grabador"></div>

</div>
<div id="cuota" title="Liquidar Abono">

</div>

<div id="tabs" class="jqgtabs">


</div>	

</body>
</html>
