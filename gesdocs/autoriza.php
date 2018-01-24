<?php
session_start();      
		include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
		/*$link=conectarse();
		$login=$_SESSION['login'];
		$idtarj=$_REQUEST['idtarj'];
	    $ntarj=$_REQUEST['ntarj'];
		 $doc=$_REQUEST['doc']; 
	    $fechact=date("Y-m-d h:i:s");*/
		
?>		

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
	<script  src="../inc/prototype.js"></script>
	<script  src="../inc/funciones.js"></script>
	<script type="text/javascript">
	jQuery(document).ready(function(){ 
	
	
	
	jQuery( "#grabact" ).click(function() {
			jQuery( "#confirm" ).dialog( "open" );
			return false;
		});

	jQuery( "#confirm" ).dialog({
			resizable: false,
			autoOpen: false,
			height:160,
			modal: true,
			buttons: {
				"Aceptar": function() {
					jQuery( this ).dialog( "close" );
					grabacierre()
				},
				Cancel: function() {
					jQuery( this ).dialog( "close" );
					jQuery('#cerrar').dialog( 'close' );
				}
			}
		});



});/////cierre del document ready


</script>
	 <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	
    
	<script src="../src/jqDnR.js" type="text/javascript"></script>
	
	<script src="../src/jqModal.js" type="text/javascript"></script>
		<script src="../themes/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../themes/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="../themes/development-bundle/ui/jquery.ui.datepicker.js"></script>  
	
 <script src="../js/i18n/grid.locale-es.js" type="text/javascript"></script>
<script src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>
	
    <script src="../themes/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	 <link rel="stylesheet" type="text/css" href="../themes/css/custom-theme/jquery-ui-1.8.16.custom.css">
	<link rel="stylesheet" type="text/css" href="../css/ui.jqgrid.css">
	
    <link rel="stylesheet" type="text/css" media="screen" href="../themes/ui.multiselect.css" /> 
   	<link rel="stylesheet" type="text/css" href="../themes/development-bundle/themes/custom-theme/jquery.ui.all.css"> 
    <link rel="stylesheet" type="text/css" media="screen" href="../themes/ui.multiselect.css" /> 
   <link rel="stylesheet" type="text/css" href="../plugins/ui.multiselect.css">   
</head>

<body>
 <table width="350" border="1" align="left" cellpadding="1" class="ui-corner-all" >
  <tr>
    <td width="355" class="ui-jqgrid-titlebar ui-widget-header ui-corner-top ui-helper-clearfix "><table width="100%" border="1" align="center" cellpadding="1" class="ui-corner-all">
      <tr >
        <td width="22%">Login</td>
		  <td class="ui-widget-content"><input name="logina" type="text" id="logina" class="ui-widget-content ui-corner-all"  /></td>
       <!-- <td width="29%">Tarjeta #</td>
        <td width="49%">Fecha Cierre</td> -->
       <!-- <td width="18%" >Act.Doc # </td> -->
      </tr>
      <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top">
	  <td width="22%">Password</td>
      <td class="ui-widget-content"><input name="passa" type="password" id="passa" class="ui-widget-content ui-corner-all"  /></td>
      <!--    <td class="ui-widget-content"><input name="n_tarj" type="hidden" id="n_tarj" value="<?php echo $ntarj  ?>" /><?php echo $ntarj  ?><input name="doc" type="hidden" id="id_docon" value="<?php echo $doc  ?>" /></td>
        <td class="ui-widget-content"><?php echo $fechact ?></td>
      -->
      </tr>

    </table></td>
  </tr>
 
  <tr>
    <td><table width="300" border="0" align="center" cellpadding="0">
      <tr>
        <td><div align="center">
          <input  type="button" class="fm-button ui-state-default ui-corner-all fm-button-icon-left"  id="grabaauto"  onclick="acepta_autoriza('grabauto')" value="Aceptar"  />
        </div></td>
       <!-- <td><div align="center">
          <input  type="button" id="trigger" name="trigger" class="fm-button ui-state-default ui-corner-all fm-button-icon-left" value="Cancelar" onClick="javascript:jQuery('#cerrar').dialog( 'close' );" />
        </div></td> -->
        <td><div align="center">
          <input  type="button" id="trigger2" name="trigger2" class="fm-button ui-state-default ui-corner-all fm-button-icon-left" value="Salir" onClick="javascript:jQuery('#autoriza').dialog( 'close' );" />
        </div></td>
      </tr>
    </table></td>
  </tr>
</table>



<div id="grabauto"></div>
<!--<div id="confirm" title="Cerrar Tarjeta">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta Segur@ de Cerrar esta tarjeta?</p>
</div>
 -->

</body>
</html>
