<?php
session_start();  
date_default_timezone_set('UTC');    
		include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
		$link=conectarse();
		/*$login=$_SESSION['login'];
		$idtarj=$_REQUEST['idtarj'];
	    $ntarj=$_REQUEST['ntarj'];
		 $doc=$_REQUEST['doc']; 
	    $fechact=date("Y-m-d h:i:s");*/
		 $id_tarjeta=$_REQUEST['id_tarjeta'];
		  
		 $datos=mysql_query("select vehiculo.id_movil,placa,conductor.id_conductor,codigo,concat(nombre1,' ',nombre2,' ',apellido1,' ',apellido2) as nombres,marca from (tarjeta_control inner join (vehiculo inner join marca on vehiculo.id_marca=marca.id_marca) on tarjeta_control.id_movil=vehiculo.id_movil) inner join conductor on tarjeta_control.id_conductor=conductor.id_conductor where id_tarjeta=$id_tarjeta");
$filad=mysql_fetch_array($datos);

$id_movil=$filad['id_movil'];
$placa=$filad['placa'];
$id_conductor=$filad['id_conductor'];
$marca=$filad['marca'];
$codigo=$filad['codigo'];
$nombres=$filad['nombres'];
$tarjeta=$filad['tarjeta'];
$fecha_act=date('Y-m-d h:i');

?>		

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
	<script  src="../inc/prototype.js"></script> 
	<script  src="../inc/funciones.js"></script>
	<script  src="../themes/js/jquery-1.6.2.min.js"></script>
<script  src="../themes/js/jquery-ui-1.8.16.custom.min.js"></script> 
<script  src="../js/jquery-ui-timepicker-addon.js"></script>
<script  src="../js/timepicker_slider_access.js"></script>
<script  src="../themes/ejemplo/ui/jquery.ui.slider.js"></script>

	
	<script type="text/javascript">
	jQuery(document).ready(function(){ 
	jQuery("#loginauto" ).focus();
	jQuery("#f_inic" ).datetimepicker({ampm:true,
	        dateFormat:'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			showWeek: true,
			addSliderAccess: true,
			sliderAcessArgs: {touchonly: false }
			});
		
		
		
	
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

	
    
	<script src="../src/jqDnR.js" type="text/javascript"></script>
	
	<script src="../src/jqModal.js" type="text/javascript"></script>
		<script src="../themes/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../themes/development-bundle/ui/jquery.ui.widget.js"></script>
	 <script src="../js/i18n/grid.locale-es.js" type="text/javascript"></script>
<script src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>
<script  src="../themes/ejemplo/ui/i18n/jquery.ui.datepicker-es.js"></script>

	 <link rel="stylesheet" type="text/css" href="../themes/css/custom-theme/jquery-ui-1.8.16.custom.css">
	
	<link rel="stylesheet" type="text/css" href="../css/ui.jqgrid.css">
	
    <link rel="stylesheet" type="text/css" media="screen" href="../themes/ui.multiselect.css" /> 
   	<link rel="stylesheet" type="text/css" href="../themes/development-bundle/themes/custom-theme/jquery.ui.all.css"> 
    <link rel="stylesheet" type="text/css" media="screen" href="../themes/ui.multiselect.css" /> 
   <link rel="stylesheet" type="text/css" href="../plugins/ui.multiselect.css">   
</head>

<body onload="javascript:">
 <table width="611" border="1" align="left" cellpadding="1" class="ui-corner-all" >
  <tr>
    <td width="611"  class="ui-jqgrid-titlebar ui-widget-header ui-corner-top ui-helper-clearfix ">
	<table width="100%" height="127" border="1" align="center" cellpadding="1" class="ui-corner-all">
      <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top" >
        <td width="50%" colspan="2">
		<table width="100%" border="1">
            <tr>
              <td width="90">Movil</td>
              <td width="53" class="ui-widget-content"><input name="id_tarjetac" type="hidden" id="id_tarjetac" class="ui-widget-content ui-corner-all"  value="<?php echo $id_tarjeta ?>" />
                  <?php echo $id_movil ?></td>
              <td width="46">Placa</td>
              <td width="59" class="ui-widget-content"><input name="placa" type="hidden" id="placa" class="ui-widget-content ui-corner-all"  value="<?php echo $placa ?>" />
                  <?php echo $placa ?></td>
              <td width="74">Marca</td>
              <td width="155" class="ui-widget-content"><input name="marca" type="hidden" id="marca" class="ui-widget-content ui-corner-all"  value="<?php echo $marca ?>" />
                  <?php echo $marca ?></td>
            </tr>
            <tr>
              <td width="90">Conductor</td>
              <td class="ui-widget-content" colspan="5"><input name="nombres" type="hidden" id="nombres" class="ui-widget-content ui-corner-all"  value="<?php echo $nombres ?>" />
                  <?php echo $nombres ?></td>
            </tr>
        </table>
		</td>
      </tr>
	  
   <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top">
        <td  colspan="2">
		<table width="100%" border="1">
            <tr>
              <td width="12%">Fecha</td>
              <td width="36%" class="ui-widget-content"><input name="f_inic" type="text" id="f_inic" class="ui-widget-content ui-corner-all" /></td>
              <td colspan="2">Direcci&oacute;n</td>
              <td width="34%" colspan="2"><input type="text" name="diracc" id="diracc" /></td>
            </tr>
        </table>
		</td>
      </tr>
    
         <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top">
        <td width="43%" colspan="2">
		<table width="100%" border="1">
  <tr>
    <td width="12%">Tipo</td>
    <td width="9%"><select name="id_tipo_a" id="id_tipo_a">
	<?php
	$consu=mysql_query("select * from tipo_accidente");
	while($filatipo=mysql_fetch_array($consu)){
	?>
	<option value="<?php echo $filatipo['id_tipo_a']?>"><?php echo $filatipo['tipo_accidente']?></option>
	
	<?php
	
	}
	?>
	</select>
	</td>
    <td width="9%">Placa</td>
    <td width="17%"><input name="placa_otro" type="text" id="placa_otro" size="7" maxlength="10" /></td>
	<td width="25%">Info. Otro Vh</td>
    <td width="28%" class="ui-widget-content"><textarea name="info_otro" id="info_otro" cols="15" rows="2" class="ui-widget-content ui-corner-all"></textarea></td>
  </tr>
</table>
</td>
  </tr> 
  
  
<tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top">
        <td width="43%" colspan="2">
		<table width="100%" border="1">
  <tr>
    <td width="12%">Propietario</td>
    <td width="9%"><select name="prop" id="prop">
	<option value="1">SI</option>
	<option value="0">NO</option>
	</select>	</td>
    <td width="9%">Ambulancia</td>
    <td width="17%"><select name="amb" id="amb">
	<option value="1">SI</option>
	<option value="0">NO</option>
	</select></td>
	<td width="25%">Lesionados</td>
    <td width="28%" class="ui-widget-content"><select name="les" id="les">
	<option value="1">SI</option>
	<option value="0">NO</option>
	</select></td>
    <td width="28%" >Reportado a</td>
  </tr>
  <tr>
    <td width="12%">Traslado</td>
    <td width="9%"><select name="tras" id="tras">
	<option value="1">SI</option>
	<option value="0">NO</option>
	</select>	</td>
    <td width="9%">Clinica</td>
    <td width="17%"><input type="text" id="entidad" name="entidad" /></td>
	<td width="25%">Transito</td>
    <td width="28%" class="ui-widget-content"><select name="transito" id="transito">
	<option value="1">SI</option>
	<option value="0">NO</option>
	</select></td>
    <td width="28%" class="ui-widget-content">
	<input type="text" name="inforep" id="inforep" >
    <!-- <select name="inforep" id="inforep">
	<option value="TIBERIO">TIBERIO</option>
	<option value="ALEX">ALEX</option>
	</select> --></td>
  </tr>
</table>
</td>
  </tr>   
  
   
    </table></td>
  </tr>
 
  <tr>
    <td><table width="300" border="0" align="center" cellpadding="0">
      <tr>
        <td><div align="center">
          <input  type="button" class="fm-button ui-state-default ui-corner-all fm-button-icon-left"  id="grabaauto"  onclick="valida_1042()" value="Aceptar"  />
        </div></td>
       <!-- <td><div align="center">
          <input  type="button" id="trigger" name="trigger" class="fm-button ui-state-default ui-corner-all fm-button-icon-left" value="Cancelar" onClick="javascript:jQuery('#cerrar').dialog( 'close' );" />
        </div></td> -->
        <td><div align="center">
          <input  type="button" id="trigger2" name="trigger2" class="fm-button ui-state-default ui-corner-all fm-button-icon-left" value="Salir" onClick="javascript:jQuery('#accidente').dialog( 'close' );" />
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
