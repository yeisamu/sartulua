<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Nueva Tarjete de Control</title>
 <script  src="../inc/prototype.js"></script>
	<script  src="../inc/funciones.js"></script>
    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	
    <script src="../js/i18n/grid.locale-es.js" type="text/javascript"></script>
	<script src="../src/jqDnR.js" type="text/javascript"></script>
	
	<script src="../src/jqModal.js" type="text/javascript"></script>
		<!--<!--<script src="../themes/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../themes/development-bundle/ui/jquery.ui.widget.js"></script>--> 
	<script src="../themes/development-bundle/ui/jquery.ui.datepicker.js"></script> 
	<script src="../themes/development-bundle/ui/jquery.ui.dialog.js"></script> 
	
	    <script type="text/javascript">
  /*  $.jgrid.no_legacy_api = true;
    $.jgrid.useJSON = true;*/
     jQuery.noConflict();

	jQuery(document).ready(function(){ 
	////funcion de autocompletar el conductor
	jQuery("#cedula").autocomplete({
			source: "buscacon.php",
			 select: function(event, ui) {
            jQuery('#nombrecon').html(ui.item.nombre);
			jQuery('#apellidoscon').html(ui.item.apellidos);
			jQuery('#telcon').html(ui.item.tele);
			jQuery('#direcon').html(ui.item.direccion);
			jQuery('#rh').html(ui.item.rh);
			jQuery('#nombrea').html(ui.item.acu);
			jQuery('#telefonoa').html(ui.item.telea);
			jQuery('#celulara').html(ui.item.cel);
			id_con(ui.item.id_con);
			
			verdocs('condocs');
			
        }
		});
		/////funcion para autocompletar el movil
		jQuery("#movil").autocomplete({
		    source: "selecmovil.php",
			select: function(event, ui) {
           	jQuery('#placa').html(ui.item.placa);
			jQuery('#marca').html(ui.item.marca);
			jQuery('#modelo').html(ui.item.modelo);
			jQuery('#vigencia').html(ui.item.vigencia);  
			fdiario(ui.item.vigencia);
			diario(ui.item.vigencia);   
			verdocsmovil('vehidocs')	  
				  
				  
				  }
			});
		////funcion que pasa el valor de la consulta a la caja de texto con id id_cond
		function id_con(thisValue) {
		jQuery('#id_cond').val(thisValue);
		}
		function diario(thisValue) {
		jQuery('#diariosv').val(thisValue);
		
		}
		////funcion que permite verificar si los diarios estan cancelados al dia de lo contrario muestra alert
		function fdiario(thisValue) {
		var fecha=thisValue;
		var fhoy="<?php echo  $fdiarios=date('Y-m-d')?>";
		
		if(fecha<=fhoy){
		var valor="Fecha";
		document.getElementById('grabaimp').disabled=true;
		////crear div
		var newdiv = document.createElement('div');
		var id='mensaje1';
   newdiv.setAttribute('id', id);
   newdiv.setAttribute('class', 'ui-state-error');
   newdiv.setAttribute('title', 'Documento vencido');
   newdiv.innerHTML = "Vigencia de diarios Vencido";
   document.body.appendChild(newdiv);
   
   
   var diverror = document.createElement('div');
   var id3='mensaje3';
   diverror.setAttribute('id', id3);
   diverror.setAttribute('class', 'ui-state-error');
   diverror.innerHTML = "Actualice los diarios del vehiculo  para seguir";
   document.getElementById("idiario").appendChild(diverror);
 ///mostrar div
	   jQuery('#mensaje1').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');	}}})
		}else {
		jQuery("#mensaje3").hide();
		document.getElementById('grabaimp').disabled=false;
		}
		}
	//////funcion de mensaje de alerta
	
	//jQuery( "#dialog:ui-dialog" ).dialog( "destroy" );
	//funcion para el llenado de datos de la empresa
	
	/*function displayVals() {
      var singleValues = jQuery("#empresa").val();
	   jQuery("#nits").html(singleValues);
	  // alert(singleValues)

}*/

/* jQuery("select").change();
  var idemp = jQuery("#empresa").val();
 source: "buscaemp.php?id_emp="+idemp,
			 select: function(ui) {
			  jQuery('#nits').html(ui.item.nit);
    displayVals();

	}	*/
	
	
	
	
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
</head>

<body>
<form name="tarjetac" id="tarjetac" method="post" action="grabatarjeta.php">
<table width="500" border="1" align="center" cellspacing="5" class=" ui-corner-all  ">
  <tr class=" ui-corner-all  ">
    <td width="706" class=" ui-corner-all  "><div align="center" class="Estilo7">
      <div align="right" class="titulos">Nueva  Tarjeta de Control </div>
    </div></td>
  </tr>
<!--  <tr>
    <td class="titulos ui-corner-all"><div align="center">Datos Generales de la Tarjeta </div></td>
  </tr> -->
  <tr >
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="500" border="0" align="center" cellspacing="5">
      <tr class="ui-widget-header" >
        <td width="95"  class=" ui-corner-all" ><div align="center" class="Estilo3"><span>Nro. Tarjeta </span></div></td>
        <td width="231"><div align="center" class="Estilo3"><span class="Estilo1">Registrado Por </span></div></td>
        <td width="148"><div align="center" class="Estilo3"><span class="Estilo1">Fecha y Hora </span></div></td>
      </tr>
      <tr>
        <td class="ui-widget-content"><input type="text" id="tarjeta" name="tarjeta" size="5" class="ui-widget-content ui-corner-all"  /></td>
        <td class="ui-widget-content">&nbsp; </td>
        <td class="ui-widget-content"><?php echo $fechact=date("Y-m-d h:i:s");  ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td  class="titulos ui-corner-all" ><div align="center">Datos Personales del Conductor </div></td>
  </tr>
  <tr>
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="500" border="0" align="center" cellspacing="5">
      <tr class="ui-widget-header" >
        <td width="148" ><div align="center" >Documento</div></td>
        <td width="141"><div align="center" class="Estilo3"><span class="Estilo1">Nombres</span></div></td>
        <td width="185"><div align="center" class="Estilo3"><span class="Estilo1">Apellidos</span></div></td>
      </tr>
      <tr class="ui-widget-header">
        <td class="ui-widget-content"><div align="center"><input type="text" id="cedula" class="ui-widget-content ui-corner-all"   /><input type="hidden" id="id_cond" name="id_cond" class="ui-widget-content ui-corner-all"  /></div></td>
        <td class="ui-widget-content" id="nombrecon"><div align="left"></div></td>
        <td class="ui-widget-content" id="apellidoscon"><div align="left"></div></td>
      </tr>
      <tr class="ui-widget-header">
        <td ><div align="center" class="Estilo3"><span class="Estilo1">Grupo Sang. </span></div></td>
        <td><div align="center" class="Estilo3"><span class="Estilo1">Tel&eacute;fono</span></div></td>
        <td><div align="center" class="Estilo3"><span class="Estilo1">Direcci&oacute;n</span></div></td>
      </tr>
      <tr>
        <td class="ui-widget-content" id="rh">&nbsp;</td>
        <td class="ui-widget-content" id="telcon">&nbsp;</td>
        <td class="ui-widget-content" id="direcon">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <!--<tr>
    <td class="titulos ui-corner-all"><div align="center" >Documentos del Conductor </div></td>
  </tr> -->
  <tr>
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="500" border="0" align="center" cellspacing="5">
      <tr class="ui-widget-header" >
       <!-- <td width="62" ><div align="center" class="Estilo3"><span class="Estilo1">id</span></div></td> -->
        <td width="60"><div align="center" class="Estilo3"><span class="Estilo1">C&oacute;digo</span></div></td>
        <td width="240"><div align="center" class="Estilo3"><span class="Estilo1">Documento</span></div></td>
        <td width="100"><div align="center" class="Estilo3"><span class="Estilo1">Fecha Vigencia </span></div></td>
      </tr>
     <tr >
	 <td colspan="3">
       <div  id="condocs" ></div>
     </td>
	 </tr>
    </table></td>
  </tr>
  <tr>
    <td class="titulos ui-corner-all"><div align="center" >En Caso de Accidente Avisar a </div></td>
  </tr>
  <tr>
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="500" border="0" align="center" cellspacing="5">
      <tr class="ui-widget-header">
        <td width="211" ><div align="center" class="Estilo10">Nombre</div></td>
        <td width="108"><div align="center" class="Estilo10">Tel&eacute;fono</div></td>
        <td width="145"><div align="center" class="Estilo10">Celular</div></td>
      </tr>
      <tr>
        <td class="ui-widget-content" id="nombrea"><div align="left" class="Estilo6">&nbsp;</div></td>
        <td class="ui-widget-content" id="telefonoa"> <div align="left" class="Estilo6">&nbsp;</div></td>
        <td class="ui-widget-content" id="celulara"><div align="left" class="Estilo6">&nbsp;</div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="titulos ui-corner-all"><div align="center" >Empresa </div></td>
  </tr>
  <tr>
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="500" border="0" align="center" cellspacing="5">
      <tr class="ui-widget-header">
        <td width="211" colspan="2" ><div align="center" class="Estilo10">Nombre</div></td>
       
       </tr>
      <tr>
        <td class="ui-widget-content" ><div align="left" class="Estilo6">
		<select id="empresa" name="empresa"  onchange="empresa1()">
		<option value="">Seleccione la Empresa</option> 
		<?php
		include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
		$link=conectarse();
		$consulemp="select * from empresa";
		 $queryemp=mysql_query($consulemp);
		while($emp=mysql_fetch_array($queryemp)){
		?>
		<option value="<?php echo $emp['id_empresa']?>"><?php echo $emp['nombre']?></option>
		<?php 
	
		}?>
		</select></div></td>
        
       </tr>
	  
	   <tr>
	   <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix " id="nits" colspan="2"> <div align="left" class="Estilo6" id="nit"></div></td>
	   </tr>
	   </table></td>
  </tr>
  <tr>
    <td class="titulos ui-corner-all"><div align="center" >Datos del Veh&iacute;c&uacute;lo </div></td>
  </tr>
  <tr>
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="500" border="0" align="center" cellspacing="5">
      <tr class="ui-widget-header">
        <td width="94" ><div align="center" class="Estilo10">Movil</div></td>
        <td width="77"><div align="center" class="Estilo10">Placa</div></td>
        <td width="74"><div align="center" class="Estilo10">Marca</div></td>
        <td width="83"><div align="center" class="Estilo10">Modelo</div></td>
        <td width="132"><div align="center" class="Estilo10">Vigencia Diarios </div></td>
      </tr>
      <tr>
        <td class="ui-widget-content" ><input name="movil" type="text" class="ui-widget-content ui-corner-all" id="movil" size="15" maxlength="15"  /> </td>
        <td class="ui-widget-content" id="placa"><span class="Estilo6">&nbsp;</span></td>
        <td class="ui-widget-content" id="marca"><span class="Estilo6">&nbsp;</span></td>
        <td class="ui-widget-content" id="modelo"><span class="Estilo16">&nbsp;</span></td>
        <td class="ui-widget-content"  id="vigencia">&nbsp;</td><div  id="idiario"></div><input type="hidden" id="diariosv" name="diariosv" class="ui-widget-content ui-corner-all"  />
      </tr>
    </table></td>
  </tr>
 <!-- <tr>
    <td class="titulos ui-corner-all"><div align="center">Documentos del Veh&iacute;culo </div></td>
  </tr> -->
  <tr>
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="500" border="0" align="center" cellspacing="5">
      <tr class="ui-widget-header" >
       <!-- <td width="65"><div align="center" >id</div></td> -->
        <td width="77"><div align="center" >C&oacute;digo</div></td>
        <td width="194"><div align="center" >Documento</div></td>
        <td width="123"><div align="center" >Fecha Vigencia </div></td>
      </tr>
      <tr >
	 <td colspan="3">
       <div  id="vehidocs" ></div>
     </td>
	 </tr>
    </table></td>
  </tr>
  <tr>
    <td class="titulos ui-corner-all">
    <div align="center">Documentos de Retorno </div></td>
  </tr>
  <tr>
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="500" border="0" align="center" cellspacing="5">
      <tr class="ui-widget-header" >
        <td width="64"><div align="center" class="Estilo10">id</div></td>
        <td width="60"><div align="center" class="Estilo10">C&oacute;digo</div></td>
        <td width="138"><div align="center" class="Estilo10">Documento</div></td>
        <td width="195"><div align="center" class="Estilo10">Fecha Entrega </div></td>
        <td width="105"><div align="center" class="Estilo10">Estado </div></td>
      </tr>
      <tr>
        <td class="ui-widget-content">&nbsp;</td>
        <td class="ui-widget-content">&nbsp;<input type="hidden" value="0" name="id_planilla" id="id_planilla" /></td>
        <td class="ui-widget-content">&nbsp;</td>
        <td class="ui-widget-content">&nbsp;</td>
        <td class="ui-widget-content" >&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="ui-corner-all"><table width="493" border="0" cellspacing="5">
      <tr>
        <td width="165"><div align="center">
          <input type="submit" name="grabaimp" id="grabaimp"  value="Guardar e Imprimir" />
        </div></td>
        <td width="166"><div align="center">
          <input type="submit" name="Submit2" value="Cancelar" />
        </div></td>
        <td width="136"><div align="center">
          <input type="submit" name="Submit3" value="Cerrar" />
        </div></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
</body>
</html>
