<?php
session_start();
$login=$_SESSION['login'];
include('../inc/libreria.php');
$link=conectarse();
$cadena =$_REQUEST['id_cond'];
$items[] = array();
$select = mysql_query("SELECT * FROM conductor where id_conductor ='$cadena'");
$ntarj = mysql_query("SELECT max(id_tarjeta) as ntar FROM tarjeta_control");
$filat=mysql_fetch_array($ntarj);
$signu=$filat['ntar']+1;
$fila=mysql_fetch_array($select);
$num=mysql_num_rows($select);
$items=array("label"=>$fila["codigo"],"value"=>$fila["codigo"],"nombre" =>$fila["nombre1"].'  '.$fila["nombre2"],"apellidos" =>$fila["apellido1"].' '.$fila["apellido2"],"id_con"=>$fila["id_conductor"],"rh"=>$fila["tipo_rh"],"direccion" => $fila["direccion"],"tele" => $fila["telefono"],"acu" => $fila["acudiente"],"telea" => $fila["telefonoa"],"cel" => $fila["celulara"]);
?>
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
		<!--<script src="../themes/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../themes/development-bundle/ui/jquery.ui.widget.js"></script>--> 
	<script src="../themes/development-bundle/ui/jquery.ui.datepicker.js"></script> 
	<script src="../themes/development-bundle/ui/jquery.ui.dialog.js"></script> 
	
	    <script type="text/javascript">
  /*  $.jgrid.no_legacy_api = true;
    $.jgrid.useJSON = true;*/
     jQuery.noConflict();

	jQuery(document).ready(function(){ 
	////funcion de autocompletar el conductor
	//jQuery("#cedula").autocomplete({
			/*source: "buscacon.php",
			// select: function(event, ui) {
            jQuery('#nombrecon').html(ui.item.nombre);
			jQuery('#apellidoscon').html(ui.item.apellidos);
			jQuery('#telcon').html(ui.item.tele);
			jQuery('#direcon').html(ui.item.direccion);
			jQuery('#rh').html(ui.item.rh);
			jQuery('#nombrea').html(ui.item.acu);
			jQuery('#telefonoa').html(ui.item.telea);
			jQuery('#celulara').html(ui.item.cel);
			id_con(ui.item.id_con);*/
			
			verdocs('condocs');
			
       // }
	//	});
		/////funcion para autocompletar el movil
		jQuery("#movil1").autocomplete({
		    source: "selecmovil.php",
			select: function(event, ui) {
           	jQuery('#placa1').html(ui.item.placa);
			jQuery('#marca1').html(ui.item.marca);
			jQuery('#modelo1').html(ui.item.modelo);
			jQuery('#vigencia1').html(ui.item.vigencia);  
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
   diverror.innerHTML = "vencido";
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
	
	
	
	jQuery('#movil1').focus();
	jQuery('#autoriza').dialog({autoOpen: false, modal:true,width:400,height:200,}); 

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

<body >
<!--<form name="tarjetac" id="tarjetac" method="post" action="grabatarjeta.php"> -->
<table width="500" border="1" align="center" cellspacing="5" class=" ui-corner-all  ">
  <tr >
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="500" border="0" align="center" cellspacing="5">
      <tr class="ui-widget-header" >
        <td width="95"  class=" ui-corner-all" ><div align="center"><span>Nro. Tarjeta </span></div></td>
        <td width="200"><div align="center" ><span >Registrado Por </span></div></td>
        <td width="179"><div align="center" ><span >Fecha y Hora </span></div></td>
      </tr>
      <tr>
        <td class="ui-widget-content"><?php echo $signu ?><input type="hidden" id="tarjeta" name="tarjeta" size="5" class="ui-widget-content ui-corner-all"  value="<?php echo $signu ?>" /></td>
        <td class="ui-widget-content"><?php echo $login;?></td>
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
        <td width="141"><div align="center" ><span >Nombres</span></div></td>
        <td width="185"><div align="center" ><span >Apellidos</span></div></td>
      </tr>
      <tr class="ui-widget-header">
        <td class="ui-widget-content"><div align="center"><?php echo $items['value'];?><input type="hidden" id="id_cond" name="id_cond" class="ui-widget-content ui-corner-all"  value="<?php echo $cadena?>" /></div></td>
        <td class="ui-widget-content" id="nombrecon" ><div align="left"><?php echo $items['nombre'];?></div></td>
        <td class="ui-widget-content" id="apellidoscon"><div align="left"><?php echo $items['apellidos'];?></div></td>
      </tr>
      <tr class="ui-widget-header">
        <td ><div align="center" class="Estilo3"><span >Grupo Sang. </span></div></td>
        <td><div align="center" class="Estilo3"><span >Tel&eacute;fono</span></div></td>
        <td><div align="center" class="Estilo3"><span >Direcci&oacute;n</span></div></td>
      </tr>
      <tr>
        <td class="ui-widget-content" id="rh"> <?php echo $items['rh'];?></td>
        <td class="ui-widget-content" id="telcon"><?php echo $items['tele'];?></td>
        <td class="ui-widget-content" id="direcon"><?php echo $items['direccion'];?></td>
      </tr>
    </table></td>
  </tr>
  <!--<tr>
    <td class="titulos ui-corner-all"><div align="center" >Documentos del Conductor </div></td>
  </tr> -->
  <tr>
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix ">
    
       <div  id="condocs" ></div>
   
    </td>
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
        <td class="ui-widget-content" id="nombrea"><div align="left" class="Estilo6"><?php echo $items['acu'];?></div></td>
        <td class="ui-widget-content" id="telefonoa"> <div align="left" class="Estilo6"><?php echo $items['telea'];?></div></td>
        <td class="ui-widget-content" id="celulara"><div align="left" class="Estilo6"><?php echo $items['cel'];?></div></td>
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

		<?php

		$consulemp="select * from empresa";
		 $queryemp=mysql_query($consulemp);
	   $emp=mysql_fetch_array($queryemp);
		?>
		<td ><input type="hidden" id="empresa" value="<?php echo $emp['id_empresa']?>"><?php echo $emp['nombre']?></td>
	   <tr>
	   <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix " id="nits" colspan="2"> <div align="left" class="Estilo6" id="nit">
      <table width="500" border="0" align="center" cellspacing="5">
 <tr class="ui-widget-header">
     

 <td width="108"><div align="center" class="Estilo10">NIT.</div></td> 
    <td width="108"><div align="center" class="Estilo10">Sitio de Control</div></td> 
         </tr>
  <tr>
      <td width="108" class="ui-widget-content"><div align="center" class="Estilo10"><?php
 echo $emp["nit"];?></div></td> 
    <td width="108" class="ui-widget-content"><div align="center" class="Estilo10"><?php
 echo $emp["direccion"];?></div></td> 
    
     </tr>
     </table> 
     </div></td>
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
        <td class="ui-widget-content" ><input name="movil1" type="text" class="ui-widget-content ui-corner-all" id="movil1" size="15" maxlength="15"  /> </td>
        <td class="ui-widget-content" id="placa1"><span class="Estilo6">&nbsp;</span></td>
        <td class="ui-widget-content" id="marca1"><span class="Estilo6">&nbsp;</span></td>
        <td class="ui-widget-content" id="modelo1"><span class="Estilo16">&nbsp;</span></td>
        <td class="ui-widget-content"  id="vigencia1" onclick="javascript:abre_autoriza();jQuery('#autoriza').dialog( 'open' );">&nbsp;</td><div  id="idiario"></div><input type="hidden" id="diariosv" name="diariosv" class="ui-widget-content ui-corner-all"  />
      </tr>
    </table></td>
  </tr>
 <!-- <tr>
    <td class="titulos ui-corner-all"><div align="center">Documentos del Veh&iacute;culo </div></td>
  </tr> -->
  <tr>
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix ">
       <div  id="vehidocs" ></div>
    </td>
  </tr>
 <!-- <tr>
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
  </tr> -->
  <input type="hidden" value="0" name="id_planilla" id="id_planilla" />
  <tr>
    <td class="ui-corner-all"><table width="493" border="0" cellspacing="5">
      <tr>
        <td width="165"><div align="center">
          <input type="button" name="grabaimp" id="grabaimp" class="fm-button ui-state-default ui-corner-all fm-button-icon-left" value="Guardar e Imprimir" onclick="validatc()" />
        </div></td>
       <!-- <td width="166"><div align="center">
          <input type="submit" name="Submit2" class="fm-button ui-state-default ui-corner-all fm-button-icon-left" value="Cancelar" />
        </div></td> -->
        <td width="136"><div align="center">
          <input type="button" name="cancelatc" value="Salir" class="fm-button ui-state-default ui-corner-all fm-button-icon-left" onclick="javascript:jQuery('#ntarjetao').dialog( 'close' );" />
		  
        </div></td>
      </tr>
    </table></td>
  </tr>
</table>

<!--//</form> -->
<div id="grabatc"></div>
<div id="autoriza" title="Funci&oacute;n Especial [Autorizar Tarjeta]"></div>

</body>
</html>
