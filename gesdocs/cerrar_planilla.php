<?php
session_start();      
		include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
		$link=conectarse();
		$login=$_SESSION['login'];
		$id_planilla=$_REQUEST['idplanilla'];
	    $numplanilla=$_REQUEST['n_planilla'];
		 //$doc=$_REQUEST['doc']; 
	    $fechact=date("Y-m-d h:i:s");
		
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
	
	
	
	jQuery( "#grabar_planillar" ).click(function() {
			//jQuery( "#confirmar_cierre_p" ).dialog( "open" );
			grabar_rplanilla()
			return false;
		});

	jQuery( "#confirmar_cierre_p" ).dialog({
			resizable: false,
			autoOpen: false,
			height:160,
			modal: true,
			buttons: {
				"Aceptar": function() {
					jQuery( this ).dialog( "close" );
					grabar_rplanilla()
				},
				Cancel: function() {
					jQuery( this ).dialog( "close" );
					jQuery('#recibe_planilla').dialog( 'close' );
				}
			}
		});



});/////cierre del document ready


</script>
</head>

<body>
 <table width="350" border="1" align="left" cellpadding="1" class="ui-corner-all" >
  <tr>
    <td width="355" class="ui-jqgrid-titlebar ui-widget-header ui-corner-top ui-helper-clearfix "><table width="100%" border="1" align="center" cellpadding="1" class="ui-corner-all">
      <tr >
        <td width="22%">C&oacute;digo</td>
        <td width="29%">Planilla #</td>
        <td width="49%">Fecha Recibido</td>
       <!-- <td width="18%" >Act.Doc # </td> -->
      </tr>
      <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top">
        <td class="ui-widget-content"><input name="id_planilla" type="hidden" id="id_planilla" value="<?php echo $id_planilla  ?>" /><?php echo $id_planilla  ?></td>
        <td class="ui-widget-content"><input name="numplanilla" type="hidden" id="numplanilla" value="<?php echo $numplanilla  ?>" /><?php echo $numplanilla  ?></td>
        <td class="ui-widget-content"><?php echo $fechact ?></td>
     
      </tr>

    </table></td>
  </tr>
  <tr>
    <td ><table width="100%" border="1" align="center" cellpadding="1" class="ui-corner-all">
      <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top  ">
        <td ><div align="center">Observaciones </div></td>
      </tr>
      <tr>
        <td class="ui-widget-content">
		<textarea name="observaciones_p" id="observaciones_p" cols="44" rows="3"></textarea>
		
		</td>
       
      </tr>
    </table></td>
  </tr> 
  <tr>
    <td><table width="300" border="0" align="center" cellpadding="0">
      <tr>
        <td><div align="center">
          <input  type="button" class="fm-button ui-state-default ui-corner-all fm-button-icon-left"  id="grabar_planillar"  value="Grabar"  />
        </div></td>
       <!-- <td><div align="center">
          <input  type="button" id="trigger" name="trigger" class="fm-button ui-state-default ui-corner-all fm-button-icon-left" value="Cancelar" onClick="javascript:jQuery('#cerrar').dialog( 'close' );" />
        </div></td> -->
        <td><div align="center">
          <input  type="button" id="trigger2" name="trigger2" class="fm-button ui-state-default ui-corner-all fm-button-icon-left" value="Salir" onClick="javascript:jQuery('#recibe_planilla').dialog( 'close' );" />
        </div></td>
      </tr>
    </table></td>
  </tr>
</table>



<div id="graba_plani"></div>
<div id="confirmar_cierre_p" title="Recibir Planilla">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta Segur@ de Recibir esta Planilla?</p>
</div>


</body>
</html>
