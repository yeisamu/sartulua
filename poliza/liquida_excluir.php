<?php
session_start();
include('../inc/libreria.php');
include('../inc/operaciones.php');
$link=conectarse();
$per=$_REQUEST['periodo'];
 $idmovil=$_REQUEST['movil'];
 $f_inclu=$_REQUEST['f_inclu'];
$ahora=mysql_query("select date_format(now(),'%Y-%m-%d') as hoy");
$fhoy=mysql_result($ahora,0,hoy);


$valorpa=mysql_query("select v_exclusion from compania_poliza ");
$vpapeleria=mysql_result($valorpa,0,v_exclusion);

$selsaldo=mysql_query("select * from contractual where id_movil='$idmovil' and periodo='$per'");
$filasaldo=mysql_fetch_array($selsaldo);
$valorp=$filasaldo['valorp'];
$saldo1=$filasaldo['saldo'];
//$fecha_ini=$fhoy;
$dias=calcdia($filasaldo['f_inclusion'],$fhoy);
$diasrestan=$dias;
$valordia=$valorp/365;
if($saldo1>0){
$vexclu=$saldo1-($valordia*$diasrestan+$vpapeleria);
$valorliq=$saldo1;
}else{
$vexclu=$valorp-($valordia*$diasrestan+$vpapeleria);
$valorliq=0;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
	<script  src="funpoli.js"></script>
 <script type="text/javascript">

jQuery( "#fecha_exc" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,
			dateFormat:'yy-mm-dd',
		 });
		 
		 jQuery( "#fecha_inc" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,
			dateFormat:'yy-mm-dd',
		 });
		 
	jQuery( "#graba_excluir" ).dialog({
			resizable: false,
			autoOpen: false,
			height:160,
			modal: true,
			buttons: {
				"Aceptar": function() {
					jQuery( this ).dialog( "close" );
					//jQuery('#cuota').dialog('close')
					var idper='<?php echo $per?>'
					//alert(idper)
					grabarexcluir('grabaexc',idper)
					
					
					return 1;
				},
				"Cancelar": function() {
					jQuery( this ).dialog( "close" );
					//jQuery('#cuota').dialog('close')
					return 0;
					//jQuery('#cerrar').dialog( 'close' );
				}
			}
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
</head>

<body>

<table width="73%" border="1" align="center"  class="ui-corner-all">
  <tr >
    <td class="ui-corner-all " ><table width="100%" border="1">
      <tr>
        <td colspan="4" class="ui-widget-header" ><div align="center">Exclusi&oacute;n del Movil <?php echo $idmovil?> </div></td>
        </tr>
      <tr>
        <td width="26%" class="ui-widget-header" >Fecha de Inclusi&oacute;n </td>
        <td width="43%" class="ui-widget-header" >Fecha de Exclusi&oacute;n </td>
        <td width="8%" class="ui-widget-header" >Dias</td>
        <td width="23%" class="ui-widget-header" >Saldo</td>
      </tr>
      <tr>
        <td class=""><input type="text" id="fecha_inc" name="fecha_inc" class="ui-corner-all "   size="10" maxlength="10" value="<?php echo $filasaldo['f_inclusion']?>" /></td>
        <td><input type="text" id="fecha_exc" name="fecha_exc" class="ui-corner-all "   size="10" maxlength="10" value="<?php echo $fhoy?>" onchange="calculaexclu('<?php echo $valorp?>','<?php echo $vpapeleria?>','<?php echo $filasaldo['f_inclusion']?>',this.value,'<?php echo $valorliq?>')" /></td>
        <td class="Estilo5" id="diasr"><?php echo $diasrestan?></td>
        <td class="Estilo4"><div align="right">$<?php echo number_format($filasaldo['saldo'],"0","",".")?></div></td>
      </tr>
      <tr>
        <td class="ui-widget-header" >Gastos Papeleria </td>
        <td colspan="3" class="ui-widget-header" ><div align="center">Total a Devolver </div></td>
        </tr>
      <tr>
        <td class="Estilo4"><div align="right">$<?php echo  number_format($vpapeleria,"0","",".")?></div></td>
        <td colspan="3" class="Estilo4"><div align="right" id="vdev"><input type="text" size="10" id="valexclu" name="valexclu"  value="<?php echo number_format($vexclu,"0","","") ?>"/><input type="hidden" id="idmovilexc" name="idmovilexc" value="<?php echo $idmovil ?>" /></div></td>
        </tr>
      <tr>
        <td colspan="4" ><table width="100%" border="1">
  <tr>
    <td width="50%" class="ui-corner-all "><div align="center"><a id='des' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=jQuery('#graba_excluir').dialog('open');>Grabar<span class='ui-icon ui-icon-circle-plus'></span></a></div></td>
    <td width="50%" class="ui-corner-all "><div align="center"><a id='des' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=jQuery('#exclu').dialog('close');>Cancelar<span class='ui-icon ui-icon-cancel'></span></a></div></td>
  </tr>
</table>
</td>
        </tr>
    </table></td>
  </tr>
</table> 
<div id="graba_excluir" title="Excluir Movil En el Periodo">
<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta Segur@ de Excluir el movil <?php echo $idmovil?> para el periodo <?php echo $per?>?</p>
</div>
<div id="grabaexc"></div>
</body>
</html>
