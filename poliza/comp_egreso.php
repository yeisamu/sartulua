<?php
session_start();
include('../inc/libreria.php');
include('../inc/operaciones.php');
$link=conectarse();
$ahora=mysql_query("select date_format(now(),'%Y-%m-%d') as hoy");
$fhoy=mysql_result($ahora,0,hoy);


$ncompegre=mysql_query("select id_egreso from comp_egresos order by id_egreso desc limit 0,1");
$numcomp=@mysql_num_rows($ncompegre);
$consecutivo="CE-";
if($numcomp==0){
$consecutivo=$consecutivo."1";
}else{
 $con=mysql_result($ncompegre,0,id_egreso);
$conse=$con+1;
$consecutivo=$consecutivo.$conse;
}


$selsaldo=mysql_query("select * from contractual where id_movil='$idmovil' and periodo='$per'");
$filasaldo=mysql_fetch_array($selsaldo);
$valorp=$filasaldo['valorp'];
$saldo1=$filasaldo['saldo'];
//$fecha_ini=$fhoy;
$dias=calcdia($filasaldo['f_inclusion'],$fhoy);
$diasrestan=365-$dias;
$valordia=$valorp/365;
$vexclu=$valordia*$diasrestan+$vpapeleria;

?>

 <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
 <script src="../js/i18n/grid.locale-es.js" type="text/javascript"></script>
 <script src="../src/jqDnR.js" type="text/javascript"></script>
 <script src="../src/jqModal.js" type="text/javascript"></script>
 <script src="../themes/ejemplo/ui/i18n/jquery.ui.datepicker-es.js"></script>
	<script  src="funpoli.js"></script>
 <script type="text/javascript">

     jQuery.noConflict();

	jQuery(document).ready(function(){ 
		 jQuery("#fechaegre").datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,
			dateFormat:'yy-mm-dd',
		 });
		 
	/*jQuery( "#graba_excluir" ).dialog({
			resizable: false,
			autoOpen: false,
			height:160,
			modal: true,
			buttons: {
				"Aceptar": function() {
					jQuery( this ).dialog( "close" );
					//jQuery('#cuota').dialog('close')
					var idper=''
					//alert(idper)
					grabar_excluir('grabaexc',idper)
					
					
					return 1;
				},
				"Cancelar": function() {
					jQuery( this ).dialog( "close" );
					//jQuery('#cuota').dialog('close')
					return 0;
					//jQuery('#cerrar').dialog( 'close' );
				}
			}
		});*/	
	});			 
    </script>
<style>	
.Estilo4 {font-size: 24px; color: #CC0033; }
.Estilo5 {font-size: 18px;color: #333333}
#graba_excluir{
display: none;
}
-->
    </style>		


<table width="100%" border="1" align="center"  class="ui-corner-all">
  <tr >
    <td class="ui-corner-all " ><table width="100%" border="1">
      <tr>
        <td colspan="4" class="ui-widget-header" ><div align="center" class="Estilo2"> EGRESO No  <span class="Estilo4"><?php echo $consecutivo?>
          <input type="hidden" id="negreso" name="negreso" value="<?php echo $consecutivo?>"></span> </div></td>
        </tr>
      <tr>
       <td width="50%" class="ui-widget-header" >FECHA DE EGRESO </td>
        <td width="50%" class="ui-widget-header" ><div align="center">VALOR</div></td>
 </tr>
     
      <tr>
        <td ><input type="text" id="fechaegre" name="fechaegre" class="ui-corner-all "   size="10" maxlength="10"  value="<?php echo $fhoy?>" /></td
        ><td ><div align="right"><span class="Estilo4">$</span><input type="text" id="valoregre" name="valoregre" size="10" maxlength="10" class="ui-corner-all"/></div></td>
      </tr>
   <tr>
        <td  class="Estilo2"><div align="center">PAGADO A: </div></td>
       <td  class=""><div align="center">
          <input type="text" name="pagadoa"  class="ui-corner-all" id="pagadoa" size="35">
        </div></td>
        </tr>
      <tr>
        <td colspan="2"  class="Estilo2"><div align="center">CONCEPTO</div></td
        >
        </tr>
      <tr>
        <td colspan="2" class=""><div align="center">
          <textarea name="concegre" cols="45" rows="2" id="concegre"></textarea>
        </div></td
        >
        </tr>
      <tr>
        <td colspan="4" ><table width="100%" border="1">
  <tr>
    <td width="50%" class="ui-corner-all "><div align="center"><a id='des' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick="grabar_excluir('graba_egreso')";>Grabar<span class='ui-icon ui-icon-circle-plus'></span></a></div></td>
    <td width="50%" class="ui-corner-all "><div align="center"><a id='des' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=jQuery('#egreso').dialog('close');>Cancelar<span class='ui-icon ui-icon-cancel'></span></a></div></td>
  </tr>
</table></td>
        </tr>
    </table></td>
  </tr>
</table> 
<!--<div id="graba_egreso" title="Validacion del Comprobante">
<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta Segur@ de Gr ?</p>
</div> -->
<div id="graba_egreso"></div>
