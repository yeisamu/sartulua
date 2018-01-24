<?php
session_start();
$login=$_SESSION['login'];
include('../inc/libreria.php');
$link=conectarse();
$idsimit =$_REQUEST['idsimit'];

$select = mysql_query("SELECT * FROM (simit inner join entidad_salud on simit.id_eps=entidad_salud.id_eps) inner join conductor on simit.id_conductor=conductor.id_conductor where id_simit ='$idsimit'");
$datosimit=mysql_fetch_array($select);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Actualiza multas</title>
<script  src="../inc/prototype.js"></script>
	<script  src="../inc/funciones.js"></script>
	 <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
		<script src="../themes/development-bundle/ui/jquery.ui.datepicker.js"></script> 
	<script src="../themes/development-bundle/ui/jquery.ui.dialog.js"></script> 
	  <script type="text/javascript">
  /*  $.jgrid.no_legacy_api = true;
    $.jgrid.useJSON = true;*/
     jQuery.noConflict();

	jQuery(document).ready(function(){ 
	jQuery( "#fecha_pago" ).datepicker({
	        dateFormat:'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,
		});	
	 });
    </script>

</head>

<body>
<table width="562" border="1" align="center" class=" ui-corner-all  ">
  <tr>
    <td width="562" class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="100%" border="0" align="center" cellspacing="5">
      <tr class="ui-widget-header" >
        <td width="84" ><div align="center" >Documento</div></td>
        <td width="152"><div align="center" ><span >Nombres</span></div></td>
        <td width="217"><div align="center" ><span >Apellidos</span></div></td>
      </tr>
      <tr class="ui-widget-header">
        <td class="ui-widget-content"><div align="center"><?php echo $datosimit['codigo'];?><input type="hidden" id="id_simit" name="id_simit" class="ui-widget-content ui-corner-all"  value="<?php echo $idsimit?>" /></div></td>
        <td class="ui-widget-content" id="nombrecon" ><div align="left"><?php echo $datosimit["nombre1"].'  '.$datosimit["nombre2"];?></div></td>
        <td class="ui-widget-content" id="apellidoscon"><div align="left"><?php echo $datosimit["apellido1"].' '.$datosimit["apellido2"];?></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="100%" border="1">
      <tr>
        <td width="13%">Parte #</td>
        <td width="16%">Infracci&oacute;n</td>
		 <td width="26%">Entidad </td>
		  <td width="14%">Fecha </td>
         <td width="15%">Valor</td>
		  <td width="16%">Fecha Pago </td>
      </tr>
      <tr>
        <td class="ui-widget-content"><?php echo $datosimit['n_parte'];?></td>
        <td class="ui-widget-content"><?php echo $datosimit['cod_infraccion'];?></td>
		         <td class="ui-widget-content"><?php echo $datosimit['eps'];?> </td>

        <td class="ui-widget-content"><?php echo $datosimit['fecha_parte'];?><input type="hidden" id="fecha_ant_parte" name="fecha_ant_parte" size="10" class="ui-widget-content ui-corner-all"  value="<?php echo $datosimit['fecha_parte'];?>" /></td>
		<td class="ui-widget-content"><?php echo $datosimit['valor'];?></td>
		 <td class="ui-widget-content"><input type="text" id="fecha_pago" name="fecha_pago" size="10" class="ui-widget-content ui-corner-all"  /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix ">
	<table width="100%" border="1" align="center" cellpadding="1" class="ui-corner-all">
      <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top  ">
        <td ><div align="center">Observaciones </div></td>
      </tr>
      <tr>
        <td class="ui-widget-content">
		  <div align="center">
		    <textarea name="observacionesimitpago" id="observacionesimitpago" cols="60" rows="3"></textarea>
	        </div></td>
      </tr>
    </table>
	</td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr id="Act_Buttons">
        <td class="EditButton"><div align="center"><a id="sData" class="fm-button ui-state-default ui-corner-all fm-button-icon-left" onclick="validapagaparte()">Guardar<span class="ui-icon ui-icon-disk"></span></a></div></td>
        <td class="EditButton"><div align="center"><a id="cData"  class="fm-button ui-state-default ui-corner-all fm-button-icon-left" onclick="javascript:jQuery('#pagamultas').dialog( 'close' );">Salir<span class="ui-icon ui-icon-close"></span></a></div></td>
      </tr>
    </table></td>
  </tr>
</table>
<div id="grabapagasimit"></div>
</body>
</html>
