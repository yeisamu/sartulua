<?php
session_start();
$login=$_SESSION['login'];
include('../inc/libreria.php');
$link=conectarse();

$idtarjeta=$_REQUEST['id_tarj'];
$controlp=$_REQUEST['controlp'];
$grupo=$_REQUEST['grupo'];
$selectarj = "SELECT * FROM ((tarjeta_control a inner join (vehiculo d inner join marca e on d.id_marca=e.id_marca) on a.id_movil=d.id_movil) inner join empresa c on a.id_empresa=c.id_empresa) inner join conductor b on a.id_conductor=b.id_conductor where id_tarjeta =$idtarjeta";
$selectarj = mysql_query("SELECT * FROM ((tarjeta_control a inner join (vehiculo d inner join marca e on d.id_marca=e.id_marca) on a.id_movil=d.id_movil) inner join empresa c on a.id_empresa=c.id_empresa) inner join conductor b on a.id_conductor=b.id_conductor where id_tarjeta =$idtarjeta");
$filaplan=mysql_fetch_array($selectarj);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Planillas de viaje ocasional</title>
 <script  src="../inc/prototype.js"></script>
	<script  src="../inc/funciones.js"></script>
    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	
    <script src="../js/i18n/grid.locale-es.js" type="text/javascript"></script>
	<script src="../src/jqDnR.js" type="text/javascript"></script>
	
	<script src="../src/jqModal.js" type="text/javascript"></script>
	    <script src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>
	
    <script src="../themes/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	<script type="text/javascript">
	jQuery(document).ready(function(){ 
	jQuery("#forigen" ).datepicker({
	      changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,
			dateFormat:'yy-mm-dd'
			});
			
	jQuery("#fdestino" ).datepicker({
	       changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,
			dateFormat:'yy-mm-dd'
			});	
			
			jQuery('#autoriza_planilla').dialog({autoOpen: false, modal:true,width:400,height:200,}); 	
		});/////cierre del document ready


</script>

	
	 <link rel="stylesheet" type="text/css" href="../themes/css/custom-theme/jquery-ui-1.8.16.custom.css">
	<link rel="stylesheet" type="text/css" href="../css/ui.jqgrid.css">
   <link rel="stylesheet" type="text/css" href="../plugins/ui.multiselect.css">

</head>

<body onload="document.getElementById('nplanilla').focus()">
<?php
if($controlp==true){
echo $modal="
<div class='ui-state-error' id='errorgraba' title='Numero Maximo de planillas'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	 Se Han Expedido Las Planillas Permitidas Para El Movil En Este Mes </div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');	}}});</script>";

}

?> 
<table width="572" border="1" align="center" cellpadding="1" class=" ui-corner-all  ">
  <tr >
    <td width="562" colspan="4"  class="titulos ui-corner-all" ><div align="center">Nueva planilla unica de viaje ocasional </div></td>
  </tr>
 
  <tr >
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix ">
	<table width="100%" border="1" cellpadding="1">
  <tr class="ui-widget-header" >
    <td width="94"># de planilla </td>
    <td width="140"># Tarjeta de control</td>
    <td width="120">Registrado Por</td>
    <td width="184">Fecha Elab.</td>
  </tr>
  <tr class="ui-widget-header">
   <td><input name="nplanilla" type="text" class="ui-widget-content ui-corner-all" id="nplanilla" size="10" maxlength="10"  onfocusout="validan_planilla('valida')"/><input type="hidden" name="idgrupo" id="idgrupo" value="<?php echo $grupo;?>"  /></td>
    <td class="ui-widget-content"><div align="center"><input type="hidden" name="tarjeta" id="tarjeta" value="<?php echo $filaplan['tarjeta'];?>"  /><input type="hidden" name="idtarjeta" id="idtarjeta" value="<?php echo $idtarjeta;?>"  /><?php echo $filaplan['tarjeta'];?></div></td>
    <td class="ui-widget-content"><div align="center"><?php echo $login;?></div></td>
	<td class="ui-widget-content"><input type="hidden" name="factual" id="factual" value="<?php echo date("m");?>"  /><?php echo $fechact=date("Y-m-d h:i:s");  ?></td>
  </tr>
</table>	</td>
  </tr>
  <tr>
    <td colspan="4" class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="100%" border="1" cellpadding="1">
      <tr class="ui-widget-header">
        <td width="153">Empresa de Transporte </td>
        <td width="108">Nit </td>
		</tr>
		<tr class="ui-widget-header">
		 <td class="ui-widget-content"><?php echo $filaplan['nombre'];?></td>
        <td class="ui-widget-content"><?php echo $filaplan['nit'];?></td>
      </tr>
    </table></td>
    
  </tr>
  <tr>
    <td colspan="4" class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="570" border="1" cellpadding="1">
      <tr class="ui-widget-header">
        <td width="153">Ciudad Origen </td>
        <td width="108">Fecha inicio </td>
        <td width="173">Ciudad Destino </td>
        <td width="108">Fecha Regreso </td>
      </tr>
      <tr class="ui-widget-header">
        <td class="ui-widget-content">
		<?php 
		   $concity= mysql_query("select origen_planilla from info_sistema");
		   $filacity=mysql_fetch_array($concity);
		   
		   ?>
		
		<input name="corigen" type="hidden" class="ui-widget-content ui-corner-all" id="corigen" value="<?php echo $filacity['origen_planilla'];?>" size="25" maxlength="25" /><?php echo $filacity['origen_planilla'];?></td>
        <td><input name="forigen" type="text" class="ui-widget-content ui-corner-all" id="forigen" size="15" maxlength="15" /></td>
        <td><input name="cdestino" type="text" class="ui-widget-content ui-corner-all" id="cdestino" size="25" maxlength="25" /></td>
        <td><input name="fdestino" type="text" class="ui-widget-content ui-corner-all" id="fdestino" size="15" maxlength="15" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="562" colspan="4"  class="titulos ui-corner-all" ><div align="center">Datos del Contratante del Servicio</div></td>
  </tr> 
  <tr>
    <td colspan="4" class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="100%" border="1" cellpadding="1">
      <tr class="ui-widget-header">
        <td width="56%">Persona o Empresa </td>
        <td width="19%">Tipo Documento </td>
        <td width="25%">N&uacute;mero</td>
      </tr>
      <tr class="ui-widget-header">
        <td><input name="contra" type="text" class="ui-widget-content ui-corner-all" id="contra" size="45" maxlength="45" /></td>
        <td>NIT<input type="radio"  id="doc" name="doc" value="CC"/>
        C.C.<input type="radio"  id="doc" name="doc" value="CC" checked="checked"/></td>
        <td><input name="nid" type="text" class="ui-widget-content ui-corner-all" id="nid" size="15" maxlength="15" /></td>
      </tr>
      <tr class="ui-widget-header">
        <td>Direcci&oacute;n </td>
        <td>Telefono</td>
        <td>N&ordm; Pasajeros </td>
      </tr>
      <tr class="ui-widget-header">
        <td><input name="dircontra" type="text" class="ui-widget-content ui-corner-all" id="dircontra" size="45" maxlength="45" /></td>
        <td><input name="telcontra" type="text" class="ui-widget-content ui-corner-all" id="telcontra" size="15" maxlength="15" /></td>
        <td><input name="npasajero" type="text" class="ui-widget-content ui-corner-all" id="npasajero" size="5" maxlength="5" />Cupo</td>
      </tr>
    </table></td>
  </tr> 
   <tr>
    <td width="562" colspan="4"  class="titulos ui-corner-all" ><div align="center">Datos del Vehiculo</div></td>
  </tr>
  <tr>
    <td colspan="4" class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="100%" border="1" cellpadding="1">
  <tr>
    <td><table width="100%" border="1" cellpadding="1">
      <tr class="ui-widget-header">
        <td width="19%">Movil</td>
        <td width="17%">Placa</td>
        <td width="22%">Clase</td>
        <td width="23%">Marca</td>
        <td width="19%">Modelo</td>
      </tr>
      <tr>
	    <td class="ui-widget-content"><?php echo $filaplan['id_movil'];?></td>
        <td class="ui-widget-content"><?php echo $filaplan['placa'];?></td>
        <td class="ui-widget-content"><?php echo $filaplan['clase'];?></td>
        <td class="ui-widget-content"><?php echo $filaplan['marca'];?></td>
        <td class="ui-widget-content"><?php echo $filaplan['modelo'];?></td>
      </tr>
    </table></td>
    
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="1">
      <tr>
        <td width="36%">Poliza SOAT </td>
        <td width="28%">Compa&ntilde;ia de Seguros </td>
        <td width="36%">Tarjeta de Operacion </td>
      </tr>
      <tr>
        <td  class="ui-widget-content"><?php $movil=$filaplan['id_movil'];
		   $consoat= mysql_query("select * from veh_doc where id_movil=$movil and id_documento=1 ");
		   $filasoat=mysql_fetch_array($consoat);
		   echo $filasoat['numero'];
		  ?></td>
        <td  class="ui-widget-content"><input name="compa" type="text" class="ui-widget-content ui-corner-all" id="compa" size="20" maxlength="35" /></td>
        <td  class="ui-widget-content"><?php //$movil=$filaplan['id_movil'];
		   $conoper= mysql_query("select * from veh_doc where id_movil=$movil and id_documento=2 ");
		   $filaoper=mysql_fetch_array($conoper);
		   echo $filaoper['numero']
		  ?></td>
      </tr>
    </table></td>
   
  </tr>
</table>
</td>
  </tr>
   <tr>
    <td width="562" colspan="4"  class="titulos ui-corner-all" ><div align="center">Datos del Conductor</div></td>
  </tr>
  <tr>
    <td colspan="4"  class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="100%" border="1" cellpadding="1">
  <tr>
    <td width="48%">Nombre</td>
    <td width="18%">Identificaci&oacute;n</td>
    <td width="21%">N&ordm; Licencia  </td>
    <td width="13%">Categoria</td>
  </tr>
  <tr>
    <td class="ui-widget-content"><?php echo $filaplan['nombre1'].' '.$filaplan['nombre2'].' '.$filaplan['apellido1'].' '.$filaplan['apellido2'];?></td>
    <td class="ui-widget-content"><?php echo $filaplan['codigo']?></td>
    <td class="ui-widget-content"><?php $id_cond=$filaplan['id_conductor'];
	       $conlicencia= mysql_query("select * from con_doc where id_conductor=$id_cond and id_doc=20 ");
		   $filalicencia=mysql_fetch_array($conlicencia);
	  echo $filalicencia['numero'];
	?>
	<input type="hidden" name="id_conduc" id="id_conduc" value="<?php echo $id_cond?>"  />
	</td>
    <td class="ui-widget-content"><?php echo $filalicencia['categoria'];?></td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td colspan="4"><table width="100%" border="0">
      <tr id="Act_Buttons">
        <td class="EditButton"><div align="center"><input type="button"   id="guardapl" class="fm-button ui-state-default ui-corner-all fm-button-icon-left" onclick="validaplanilla(<?php echo $controlp;?>)"  value="Guardar"><span class="ui-icon ui-icon-disk"></span></div></td>
        <td class="EditButton"><div align="center"><input type="button" class="fm-button ui-state-default ui-corner-all fm-button-icon-left" onclick="javascript:jQuery('#planillas').dialog( 'close' );" value="Salir"><span class="ui-icon ui-icon-close"></span></a></div></td>
      </tr>
    </table>
</td>
  </tr> 
  <!--<tr>
    <td colspan="4">&nbsp;</td>
  </tr>  -->
</table>

<div id="autoriza_planilla" title="Funci&oacute;n Especial"></div>
<div id="valida"></div>
</body>
</html>
