<?php
session_start();
$login=$_SESSION['login'];
include('../inc/libreria.php');
$link=conectarse();
$id_condu =$_REQUEST['id_cond'];

$select = mysql_query("SELECT * FROM conductor where id_conductor ='$id_condu'");
$datos=mysql_fetch_array($select);
$num=mysql_num_rows($select);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Registro de infracciones de transito</title>
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
	jQuery("#tipomultas").change(function(event) {
event.preventDefault();
var escoje=jQuery("#tipomultas").val();
//alert(escoje)
if(escoje==0){
		   jQuery("#conmulta").slideUp();
           jQuery("#convenio").slideUp();
             }
 if(escoje==1){
 		   jQuery("#convenio").slideUp();
           jQuery("#conmulta").slideToggle();
             }
 if(escoje==2){
 		   jQuery("#conmulta").slideUp();
           jQuery("#convenio").slideToggle();
             }
});

jQuery("#conmulta").slideUp();
jQuery("#convenio").slideUp();

	jQuery( "#fecha_parte" ).datepicker({
	        dateFormat:'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,
		});	
		jQuery( "#fecha_partecon" ).datepicker({
	        dateFormat:'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,
		});	
	 });
    </script>
	<style type="text/css">
	#conmulta {
display: none;
}
</style>
	
	</head>

<body>
<table width="474" border="1" align="center" class=" ui-corner-all  ">
  <tr>
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="100%" border="0" align="center" cellspacing="5">
      <tr class="ui-widget-header" >
        <td width="84" ><div align="center" >Documento</div></td>
        <td width="152"><div align="center" ><span >Nombres</span></div></td>
        <td width="217"><div align="center" ><span >Apellidos</span></div></td>
      </tr>
      <tr class="ui-widget-header">
        <td class="ui-widget-content"><div align="center"><?php echo $datos['codigo'];?><input type="hidden" id="id_conductor" name="id_conductor" class="ui-widget-content ui-corner-all"  value="<?php echo $id_condu?>" /></div></td>
        <td class="ui-widget-content" id="nombrecon" ><div align="left"><?php echo $datos["nombre1"].'  '.$datos["nombre2"];?></div></td>
        <td class="ui-widget-content" id="apellidoscon"><div align="left"><?php echo $datos["apellido1"].' '.$datos["apellido2"];?></div></td>
      </tr>
      <!--<tr class="ui-widget-header">
        <td ><div align="center" class="Estilo3"><span >Grupo Sang. </span></div></td>
        <td><div align="center" class="Estilo3"><span >Tel&eacute;fono</span></div></td>
        <td><div align="center" class="Estilo3"><span >Direcci&oacute;n</span></div></td>
      </tr> -->
      <!--<tr>
        <td class="ui-widget-content" id="rh"> <?php echo $datos['rh'];?></td>
        <td class="ui-widget-content" id="telcon"><?php echo $datos['tele'];?></td>
        <td class="ui-widget-content" id="direcon"><?php echo $datos['direccion'];?></td>
      </tr> -->
    </table></td>
  </tr>
   <tr>
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix ">
	<table width="100%" border="1">
  <tr>
    <td width="53%">Tipo de Registro</td>
    <td width="47%"><select  name="tipomultas" id="tipomultas" class="ui-widget-content ui-corner-all" >
					<option value="" selected="selected" >Seleccione Tipo</option>
					<option value="0"  >Sin Multas</option>
		 			<option value="1" >Con Multas</option>
				    <option value="2" >Multas Con Convenio</option> 
		       </select>
	</td>
  </tr>
</table>

	</td>
  </tr>
  <tr>
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix ">
	
		<div id="convenio" >
	
	<table width="100%" border="1">
      <tr>
        <td width="25%">Parte #</td>
        <td width="33%">Infracci&oacute;n</td>
		 <td width="42%">Entidad </td>
		  </tr>
		 
      <tr>
        <td><input type="text" id="comparendocon" name="comparendocon" size="5" class="ui-widget-content ui-corner-all"  /></td>
        <td><input type="text" id="infraccioncon" name="infraccioncon" size="7" class="ui-widget-content ui-corner-all"  /></td>
		         <td class="ui-widget-content"><select  name="epscon" id="epscon" class="ui-widget-content ui-corner-all" >
		<option value="">Seleccione Entidad </option>
		<?php $sql="select * from entidad_salud";
		          $query=mysql_query($sql);
				  while($row=mysql_fetch_array($query)){
				  ?>
				  <option value="<?php echo $row['id_eps']?>" ><?php echo $row['eps']?></option>
				  
				  <?php
				  }
		 ?></select>		 </td>
      </tr>
      
	  <tr>
	   <td width="25%">Fecha </td>
         <td width="33%">Valor</td>
		 <td width="42%">Convenio</td>
      </tr>
	  <tr>
	    <td><input type="text" id="fecha_partecon" name="fecha_partecon" size="10" class="ui-widget-content ui-corner-all"  /></td>
		<td><input type="text" id="valorpartecon" name="valorpartecon" size="10" class="ui-widget-content ui-corner-all"  /></td>
		<td><input type="text" id="nconvenio" name="nconvenio" size="10" class="ui-widget-content ui-corner-all"  /></td>
      </tr>
    </table>
	</div>
	
	
	<div id="conmulta" >
	
	<table width="100%" border="1">
      <tr>
        <td width="9%">Parte#</td>
        <td width="14%">Infracci&oacute;n</td>
		 <td width="34%">Entidad </td>
		  <td width="17%">Fecha </td>
         <td width="26%">Valor</td>
      </tr>
      <tr>
        <td><input type="text" id="comparendo" name="comparendo" size="5" class="ui-widget-content ui-corner-all"  /></td>
        <td><input type="text" id="infraccion" name="infraccion" size="7" class="ui-widget-content ui-corner-all"  /></td>
		         <td class="ui-widget-content"><select  name="eps" id="eps" class="ui-widget-content ui-corner-all" >
		<option value="">Seleccione Entidad </option>
		<?php $sql="select * from entidad_salud";
		          $query=mysql_query($sql);
				  while($row=mysql_fetch_array($query)){
				  ?>
				  <option value="<?php echo $row['id_eps']?>" ><?php echo $row['eps']?></option>
				  
				  <?php
				  }
		 ?></select>		 </td>

        <td><input type="text" id="fecha_parte" name="fecha_parte" size="10" class="ui-widget-content ui-corner-all"  /></td>
		<td><input type="text" id="valorparte" name="valorparte" size="10" class="ui-widget-content ui-corner-all"  /></td>
      </tr>
    </table>
	</div>
	</td>
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
		    <textarea name="observacionesimit" id="observacionesimit" cols="60" rows="3"></textarea>
	        </div></td>
      </tr>
    </table>
	</td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr id="Act_Buttons">
        <td class="EditButton"><div align="center"><a class="fm-button ui-state-default ui-corner-all fm-button-icon-left" onclick="tipo_multa()">Guardar<span class="ui-icon ui-icon-disk"></span></a></div></td>
        <td class="EditButton"><div align="center"><a class="fm-button ui-state-default ui-corner-all fm-button-icon-left" onclick="javascript:jQuery('#regsimit').dialog( 'close' );">Salir<span class="ui-icon ui-icon-close"></span></a></div></td>
      </tr>
    </table></td>
  </tr>
</table>
<div id="grabasimit"></div>
</body>
</html>
