<?php
session_start();
include('../inc/libreria.php');
include('../inc/operaciones.php');
$link=conectarse();



$per=$_REQUEST['periodo'];
 $idmovil=$_REQUEST['idmovi'];
 
$ahora=mysql_query("select date_format(now(),'%Y-%m-%d') as hoy");
$fhoy=mysql_result($ahora,0,hoy);

$selrec=mysql_query("select * from detalle_contra  where id_movil='$idmovil' and periodo = '$per' ");
$sireb=mysql_num_rows($selrec);
?>
 <script type="text/javascript">
     jQuery.noConflict();
	jQuery(document).ready(function(){ 
jQuery("#fespe").datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,
			dateFormat:'yy-mm-dd',
		});
jQuery("#fehasta").datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,
			dateFormat:'yy-mm-dd',
		});
 });
    </script>		


<table width="100%" border="1" class="ui-corner-all">
  <tr>
    <td colspan="2"  class="ui-widget-header" ><div align="center">Recibo Especial </div></td>
  </tr>
  <tr>
    <td class="ui-widget-header" >Desde</td>
    <td class="ui-widget-header" >Hasta</td>
  </tr>
  <tr>
    <td><input type="hidden" name="id_movilesp" id="id_movilesp" class="ui-corner-all " value="<?php echo  $idmovil?>" /><input type="hidden" name="perio" id="perio" class="ui-corner-all " value="<?php echo  $per?>" /><input type="text" name="fespe" id="fespe" class="ui-corner-all " /></td>

 <td><input type="text" name="fehasta" id="fehasta" class="ui-corner-all " /></td>
  </tr>
  <tr>
    <td><div align="center"><a id='des' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick="grabar_cuotaesp('grabaesp')";>Grabar<span class='ui-icon ui-icon-circle-plus'></span></a></div></td>
    <td><div align="center"><a id='des' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=jQuery('#imprime').dialog('close');>Cerrar<span class='ui-icon ui-icon-cancel'></span></a></div></td>
  </tr>
</table>
<p>
  <?php 
if($sireb==0){
echo "<p class='norecibo'>No Hay Recibos Generados para el Movil $idmovil en el Periodo $per</p>";
}else{
?>



<table width="100%" border="1" align="center"  class="ui-corner-all">
  <tr >
    <td class="ui-corner-all " ><table width="100%" border="1">
      <tr>
        <td colspan="5" class="ui-widget-header" ><div align="center">Recibos de pago Generados al  Movil <?php echo $idmovil?> en el Periodo <?php echo $per?>  </div></td>
        </tr>
      <tr>
        <td width="33%" class="ui-widget-header" >Fecha del Recibo </td>
        <td width="34%" class="ui-widget-header" >Recibo # </td>
        <td width="15%" class="ui-widget-header" >Valor</td>
        <td width="18%" class="ui-widget-header" >Imprimir</td>
		
        <td width="18%" class="ui-widget-header" >Anular</td>
      </tr>
	  
	  <?php 
	  $pagos=0;
	  while($filarec=mysql_fetch_array($selrec)){
	  ?>
      <tr>
        <td width="33%" ><?php echo $filarec['frecibo']?></td>
        <td  width="34%"><?php echo $filarec['nrecibo']?></td>
        <td width="15%"><?php echo number_format($filarec['vrecibo'],"0","",".")?></td>
        <td width="18%"><div align="center"><a id='des' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=imprimir('<?php echo $idmovil?>','<?php echo $per?>','<?php echo $filarec[id_deta_contra]?>');>Reimp.<span class='ui-icon ui-icon-print'></span></a></div></td>
        <td width="18%"><div align="center"><a id='des' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=anula_recibo('grabanula','<?php echo $filarec[id_deta_contra]?>');>Anular<span class='ui-icon ui-icon-circle-close'></span></a></td>
      </tr>
	  
	   <?php 
	   $pagos=$pagos+$filarec['vrecibo'];
	  }
	  ?>
	   <tr>
        <td width="33%"  colspan="2" ><strong>Total Pagos</strong></td>
        <td width="18%"  class="Estilo4" colspan="3" >$ <?php echo number_format($pagos,"0","",".")?></td>
      </tr>
      <tr>
        <td colspan="5" ><table width="100%" border="1">
  <tr>
    
    <td width="50%" class="ui-corner-all " colspan="2"><div align="center"><a id='des' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=jQuery('#imprime').dialog('close');>Cerrar<span class='ui-icon ui-icon-cancel'></span></a></div></td>
  </tr>
</table></td>
        </tr>
    </table></td>
  </tr>
</table> 
   <?php 
	  }
	  ?>
<div id="grabanula"></div>
<div id="grabaesp"></div>		  
