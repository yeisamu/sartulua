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

		
		<script type="text/javascript" charset="utf-8">
		      jQuery.noConflict();
			jQuery(document).ready( function () {
			

		
	jQuery("input.flat_asig").keypress( function (e) {
      tecla = e.keyCode 
	 // alert(tecla); 
        switch(e.keyCode)
        {
            // left arrow
            case 37:
                jQuery(this).parent()
                        .prev()
                        .children("input.flat_asig")
                        .focus();
                break;
 
            // right arrow
            case 39:
                jQuery(this).parent()
                        .next()
                        .children("input.flat_asig")
                        .focus();
                break;
 
            // up arrow
            case 40:
                jQuery(this).parent()
                        .parent()
                        .next()
                        .children("td")
                        .children("input.flat_asig[name="
                            +jQuery(this).attr("name")+"]")
                        .focus();
                break;
 
            // down arrow
            case 38:
                jQuery(this).parent()
                        .parent()
                        .prev()
                        .children("td")
                        .children("input.flat_asig[name="
                            +jQuery(this).attr("name")+"]")
                        .focus();
                break;
				case 9:
                ubicafoco();
                break;
				
				
        }
    });

	jQuery('#descarte').dialog({autoOpen: false, modal:true,width:320,height:220,});		
});					


			
	


		
		
		</script>

</head>

<body >		
<table width="915" border="1" cellpadding="0" cellspacing="0" class="ui-jqgrid-htable" >
	<thead>
		<tr class="ui-jqgrid-labels">
			<th width="62" class="ui-state-default ui-th-column ui-th-ltr">Telefono</th>
			<th width="238" class="ui-state-default ui-th-column ui-th-ltr">Direccion</th>
			<th width="171" class="ui-state-default ui-th-column ui-th-ltr">Detalle Servicio</th>
			<th width="66" class="ui-state-default ui-th-column ui-th-ltr">Movil</th>
			<th width="61" class="ui-state-default ui-th-column ui-th-ltr">Movil 2</th>
			<th width="98" class="ui-state-default ui-th-column ui-th-ltr">Fecha</th>
			<th width="203" class="ui-state-default ui-th-column ui-th-ltr">Operaciones</th>
		</tr>
	</thead>
	<tbody>
	
	<?php
	$selectar = mysql_query("SELECT * FROM servicio where servicio.estado>=1 order by id_ser desc ");
	$i=0;
	

while($filatar=mysql_fetch_array($selectar)){

	
	?>
		<tr class="gradeX">
			
			<td  ><?php echo $filatar['telefono'] ?></td>
			<td ><input  name='foo' class='flat_asig grande' id="direc_asig<?php echo $i ?>" value='<?php echo $filatar['direccion'] ?>' size="35" onKeyPress="actualiza_dir_asig(event,<?php echo $i ?>)"></td>
			<td class="flat"><input class='flat_asig grande' name='foo' value='<?php echo $filatar['detalle_serv'] ?>' id="deta_asig<?php echo $i ?>" onKeyPress="actualiza_dir_asig(event,<?php echo $i ?>)"><input  type="hidden" value='<?php echo $filatar['id_ser'] ?>' id="id_serv_asig<?php echo $i ?>"></td>
			
			<td class="letragrande" align="center"	 ><input name='foo'  id="idmovil_asig<?php echo $i ?>"  value='<?php echo $filatar['id_movil'] ?>' size="4" maxlength="4"  type="hidden"  ><?php echo $filatar['id_movil'] ?><input  type="hidden" value='<?php echo $filatar['id_ser'] ?>' id="id_serv_asig<?php echo $i ?>"></td>
			<td  ><input name='foo' class='flat_asig grandem' id="idmovil_asig2<?php echo $i ?>"  value='<?php echo $filatar['id_movil2'] ?>' size="4" maxlength="4"  type="text"  onKeyPress="validamovil_asig(event,this.value,<?php echo $i ?>)" ></td>
			<td ><?php $f1=strtotime($filatar['fecha_reg']);echo $f2=date('d-m-Y h:i A', $f1) ?></td>
			<td width="203" ><a id='des_asig' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=jQuery('#id_servicio').val('<?php echo $filatar['id_ser'] ?>');jQuery('#descarte_serv').dialog('open');>10-74<span class='ui-icon ui-icon-trash'></span></a><a id='apr' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=jQuery('#idser').val('<?php echo $filatar['id_ser'] ?>');jQuery('#servauto').dialog('open');>Auto<span class='ui-icon ui-icon-check'></span></a><a id='apr_asig' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=jQuery('#id_servi').val('<?php echo $filatar['id_ser'] ?>');jQuery('#apropiacion').dialog('open');>Aprop<span class='ui-icon ui-icon-alert'></span></a></td>
		</tr>
		
<?php 
$i++;
}
?>		
		
	</tbody>
	
</table>
			
			 <div id="destino"></div>
			 <div id="descarte" title="Descartar El Servicio">
	
</div>
</body>
</html>
