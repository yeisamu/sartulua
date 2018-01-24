<?php 
session_start();  
$id_serv=$_REQUEST['id_serv'];
?>		 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<table width="279" border="1" class="ui-corner-all">
  <tr>
    <td width="100%" class="ui-jqgrid-titlebar ui-widget-header ui-corner-top ui-helper-clearfix "><div align="center">Detalle del Descarte Obligatorio </div></td>
  </tr>
  <tr>
    <td><div align="center">
      <input name="observacion" cols="30" rows="2" id="observacion" class="ui-corner-all"/>
	  <input  type="hidden" name="id_ser" id="id_ser" value="<?php echo $id_serv?>" />
    </div></td>
  </tr>
  <tr>
    <td><table width="100%" border="1">
  <tr>
    <td width="100"><div align="center">
          <input  type="button" class="fm-button ui-state-default ui-corner-all fm-button-icon-left"  id="grabaauto"  onclick="grabar_desc_ser();" value="Aceptar"  />
        </div></td>
    <td width="84"><div align="center">
          <input  type="button" id="trigger2" name="trigger2" class="fm-button ui-state-default ui-corner-all fm-button-icon-left" value="Salir" onClick="javascript:jQuery('#descarte').dialog( 'close' );" />
        </div></td>
  </tr>
</table></td>
  </tr>
</table>

<div id="graba_des"></div>
</body>
</html>
