<?php 
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
include('../inc/operaciones.php');
$link=conectarse();

include ('numerosALetras.class.php') ; 
$id_egreso=$_REQUEST['idegre'];
$seldatos=mysql_query("select * from comp_egresos where id_egreso=$id_egreso");
$filadatoe=mysql_fetch_array($seldatos);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Comprobante de Egreso</title>
 <script type="text/javascript">
function imprimir() {
	window.print();
	//window.close();
}
    </script>
</head>

<body onLoad="imprimir()">
<table width="65%" border="0" align="center">
  <tr>
    <td><table width="100%" border="1">
      <tr>
        <td width="49%" rowspan="2">&nbsp;</td>
        <td width="51%">COMPROBANTE DE EGRESO </td>
      </tr>
      <tr>
        <td>No. <?php echo $filadatoe['id_egreso'] ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="1">
      <tr>
        <td width="43%">FECHA ELABORACI&Oacute;N </td>
        <td width="21%"><?php echo $filadatoe['fecha_com'] ?></td>
        <td width="17%">VALOR</td>
        <td width="19%">$<?php echo number_format($filadatoe['valor_egreso'],0,',','.') ?></td>
      </tr>
	   </table></td></tr>
	   <tr>
    <td><table width="100%" border="1">
      <tr>
        <td width="30%" >PAGADOA:</td>
        <td width="70%" ><?php echo strtoupper($filadatoe['pagado_a']) ?> </td>
      </tr>
      <tr>
        <td >POR CONCEPTO DE : </td>
        <td ><?php echo strtoupper($filadatoe['concepto']) ?></td>
      </tr>
      <tr>
        <td >LA SUMA DE : </td>
        <td ><?php
     $val=number_format($filadatoe['valor_egreso'],0,',','.');
echo   strtoupper(numtoletras($filadatoe['valor_egreso']))?> M/C</td>
      </tr>
      <tr>
        <td colspan="2" ><table width="100%" border="1">
          <tr>
            <td width="33%">RECIBI</td>
            <td colspan="2">&nbsp;</td>
            </tr>
          <tr>
            <td height="77" colspan="3"><p>&nbsp;</p>
              <p>_______________________________________________</p>
              <p>CC <input type="checkbox" > 
              NIT  <input type="checkbox" ></p></td>
            </tr>
          <tr>
            <td>PREPARADO</td>
            <td width="31%">APROBADO</td>
            <td width="36%">CONTABILIZADO</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
