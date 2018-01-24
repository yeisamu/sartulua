<?php
session_start();
 include('../inc/libreria.php');
  $link=conectarse();
 if(!valida_usr(30)){
 
 echo "Acceso No Autorizado";
 return ;
 }
?>
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
	
		 jQuery("#fechainimov").datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,
			dateFormat:'yy-mm-dd',
		 });
		 	 jQuery("#fechafinmov").datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,
			dateFormat:'yy-mm-dd',
		 });
				 
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
	#informe {
	/*position:absolute;
	width:583px;
	height:115px;
	z-index:2;
	left: 204px;
	top: 293px;*/
}
-->
    </style>

<title>Cuadre de Caja</title><div  id="login1">login: [ <?php echo $_SESSION['login'];  ?>]</div>

<div align="right"><span class="Estilo2"><a href="../login/index2.php" class="ui-state-hover">Volver al Men&uacute </a></span></div>

<p class="Estilo2">Cuadre de Caja seguro Contractual y Extracontractual </p>

<table width="31%" border="1" align="center"  class="ui-corner-all">
  <tr >
    <td class="ui-corner-all " ><table width="100%" border="1">
      <tr>
        <td colspan="4" class="ui-widget-header" ><div align="center" class="Estilo2">Consultar Movimiento </div></td>
        </tr>
      <tr>
        <td width="50%" class="ui-widget-header Estilo2 " >Fecha Inicial </td>
        <td width="50%" class="ui-widget-header Estilo2" >Fecha Final </td>
      </tr>
      <tr>
        <td  class="Estilo1"><div align="center"><input type="text" id="fechainimov" name="fechainimov" class="ui-corner-all "   size="10" maxlength="10"  /></div></td
        ><td ><div align="center"><input type="text" id="fechafinmov" name="fechafinmov" size="10" maxlength="10" class="ui-corner-all"/></div></td>
      </tr>
      <tr>
        <td colspan="4" ><table width="100%" border="1">
  <tr>
    <td width="50%" class="ui-corner-all " colspan="2"><div align="center"><a id='des' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick="genera_rep('informe')";>Consultar<span class='ui-icon ui-icon-circle-plus'></span></a></div></td>
    
  </tr>
</table></td>
        </tr>
    </table></td>
  </tr>
</table>


<p>&nbsp;</p>
<div id="informe" align="center"></div>	

