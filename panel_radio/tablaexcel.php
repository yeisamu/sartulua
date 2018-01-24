<?php
session_start();
date_default_timezone_set('America/bogota');
include('../inc/libreria.php');
$link=conectarse();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>KeyTables editing example</title>
		
			<script  src="../inc/prototype.js"></script> 
	<script  src="../inc/funciones.js"></script>
	<script  src="../themes/js/jquery-1.6.2.min.js"></script> 
<script  src="../themes/js/jquery-ui-1.8.16.custom.min.js"></script> 
<script  src="../js/jquery-ui-timepicker-addon.js"></script>
<script  src="../js/timepicker_slider_access.js"></script>
<script  src="../themes/ejemplo/ui/jquery.ui.slider.js"></script>
<script  src="../themes/ejemplo/ui/i18n/jquery.ui.datepicker-es.js"></script>
<script  src="../js/jquery.jqGrid.min.js"></script>
<script   src="../js/jquery.jqGrid.src.js"></script>
<script   src="../src/grid.base.js"></script>
<script   src= "../src/jquery.fmatter.js"></script>
<script   src="../src/grid.common.js"></script>
<script   src="../src/grid.custom.js"></script>
<script   src="../src/grid.formedit.js"></script>
<script   src="../src/grid.inlinedit.js"></script>
<script   src="../src/grid.celledit.js"></script>
<script   src="../src/jqDnR.js"></script>
<script   src="../src/jqModal.js"></script>
<script   src="../src/grid.import.js"></script> 
<script type="text/javascript" charset="utf-8" src="../inc/jquery.dataTables.js"></script>
		
		<script type="text/javascript" charset="utf-8">
		      jQuery.noConflict();
			jQuery(document).ready( function () {
			
		
	jQuery("input.flat").keypress( function (e) {
      tecla = e.keyCode 
	 // alert(tecla); 
        switch(e.keyCode)
        {
            // left arrow
            case 37:
                jQuery(this).parent()
                        .prev()
                        .children("input.flat")
                        .focus();
                break;
 
            // right arrow
            case 39:
                jQuery(this).parent()
                        .next()
                        .children("input.flat")
                        .focus();
                break;
 
            // up arrow
            case 40:
                jQuery(this).parent()
                        .parent()
                        .next()
                        .children("td")
                        .children("input.flat[name="
                            +jQuery(this).attr("name")+"]")
                        .focus();
                break;
 
            // down arrow
            case 38:
                jQuery(this).parent()
                        .parent()
                        .prev()
                        .children("td")
                        .children("input.flat[name="
                            +jQuery(this).attr("name")+"]")
                        .focus();
                break;
				case 9:
                ubicafoco();
                break;
				
				
        }
    });
jQuery( "#descarte_serv" ).dialog({
			resizable: false,
			autoOpen: false,
			height:160,
			modal: true,
			buttons: {
				"Aceptar": function() {
					jQuery( this ).dialog( "close" );
					var idservic=jQuery('#id_servicio').val();
					grabar_descarte_ser(idservic);
					jQuery("#descarte" ).dialog( "open" );
					
					return 1;
				},
				Cancel: function() {
					jQuery( this ).dialog( "close" );
					return 0;
					//jQuery('#cerrar').dialog( 'close' );
				}
			}
		});				
			
});					


			

		
		
		</script>
		<style type="text/css">
#descarte_serv{
display: none;
}
</style>
</head>

<body >		
<table width="915" border="1" cellpadding="0" cellspacing="0" class="ui-jqgrid-htable"  id="captura">
	<thead>
		<tr class="ui-jqgrid-labels">
			<th width="66" class="ui-state-default ui-th-column ui-th-ltr">Linea</th>
			<th width="78" class="ui-state-default ui-th-column ui-th-ltr">Telefono</th>
			<th width="230" class="ui-state-default ui-th-column ui-th-ltr">Direccion</th>
			<th width="172" class="ui-state-default ui-th-column ui-th-ltr">Detalle Servicio</th>
			<th width="52" class="ui-state-default ui-th-column ui-th-ltr">Movil</th>
			<th width="107" class="ui-state-default ui-th-column ui-th-ltr">Fecha</th>
			<th width="194" class="ui-state-default ui-th-column ui-th-ltr">Operaciones</th>
		</tr>
	</thead>
	<tbody>
	
	<?php
	$selectar = mysql_query("SELECT * FROM servicio where servicio.estado=0 order by id_ser desc limit 0,20");
	$i=0;
	

while($filatar=mysql_fetch_array($selectar)){

	
	?>
		<tr class="gradeX">
			<td class="flat "   id="linea<?php echo $filatar['id_ser'] ?>"><?php echo $filatar['linea'] ?></td>
			<td class="flat"   id="tel<?php echo $filatar['id_ser'] ?>"><?php echo $filatar['telefono'] ?></td>
			
			
			<td class="flat" id="dir<?php echo $filatar['id_ser'] ?>"><input name='foo' class='flat grande' id="direc<?php echo $i ?>" value='<?php echo $filatar['direccion'] ?>'  onKeyPress="actualiza_dir(event,<?php echo $i ?>)" size="35">
			<input  type="hidden" value='<?php echo $filatar['id_ser'] ?>' id="id_serv<?php echo $i ?>"></td>
			
			
			<td class="flat"   id="deta<?php echo $filatar['id_ser'] ?>"><input class='flat grande' name='foo' value='<?php echo $filatar['detalle_serv'] ?>' id="deta<?php echo $i ?>" onKeyPress="actualiza_dir(event,<?php echo $i ?>)" ></td>
			
			
			
			<td class="letragrande" userid="idmovil<?php echo $filatar['id_ser'] ?>" id="moviltd"><input name='foo' class='flat grandem' id="idmovilasig<?php echo $i ?>"  value='<?php echo $filatar['id_movil'] ?>' size="4" maxlength="4" tabindex="3"  onKeyPress="validamovil(event,this.value,<?php echo $i ?>)" ></td>
			<td class="flat" id="fecha<?php echo $filatar['id_ser'] ?>"><?php $f1=strtotime($filatar['fecha_reg']);echo $f2=date('d-m-Y h:i A',$f1) ?></td>
			<td   userid="idmovil<?php echo $filatar['id_ser'] ?>" id="movil"><a id='des' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick='grabar_descarte_ser("<?php echo $filatar['id_ser'] ?>");jQuery("#descarte" ).dialog( "open" );jQuery("#id_servicio").val("<?php echo $filatar['id_ser'] ?>");'>10-74<span class='ui-icon ui-icon-trash'></span></a><a id='apr' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=jQuery('#idser').val('<?php echo $filatar['id_ser'] ?>');jQuery('#servauto').dialog('open');>Auto<span class='ui-icon ui-icon-check'></span></a><a id='apr' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=jQuery('#id_servi').val('<?php echo $filatar['id_ser'] ?>');jQuery('#apropiacion').dialog('open');>Aprop<span class='ui-icon ui-icon-alert'></span></a></td>
		</tr>
		
<?php 
$i++;
}
?>		
		
	</tbody>
	
</table>
			
			 <div id="destino"></div>
			 <div id="descarte_serv" title="Descartar servicio">
<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta Segur@ de Descartar este servicio?</p>
</div>
	
</body>
</html>
