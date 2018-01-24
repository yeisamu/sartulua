<?
    /*  
  
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
	
	Autores: Pedro Obregón Mejías
			 Rubén D. Mancera Morán
	Versión: 1.0
	Fecha Liberación del código: 13/07/2004
	Galopín para gnuLinEx 2004 -- Extremadura		 
	
	*/

?>
<html>
<head>
<title>Galopin v1.0</title>
</head>
  <? include ("../conectar.php");
  include ("../convertirfechas2.php"); 
   $consulta = "Select * from albaranesp,proveedores where albaranesp.codalbaran='$codalbaran' and albaranesp.codproveedor=proveedores.codproveedor";
   $resultado = mysql_query($consulta, $conexion);
   $lafila=mysql_fetch_array($resultado);
   
   $observ=$lafila[7];
   $codcli=$lafila["codproveedor"];
   $codpro=$lafila["codprovincia"];
   $consulta1 = "Select * from provincias where codprovincia='$codpro'";
   $resultado1 = mysql_query($consulta1, $conexion);
   $lafila1=mysql_fetch_array($resultado1);     
?>
<body bgcolor="#ffffff">
<table width="35%" border="1" align="right" cellpadding="1" cellspacing="1" bordercolor="#0C9816">
  <tr> 
    <td width="27%" height="21" bgcolor="#0C9816"><div align="center"><font color="#FF0000" size="4" face="Verdana, Arial, Helvetica, sans-serif">ALBAR&Aacute;N FACTURADO</font></div></td>
  </tr>
  <tr> 
    <td><? echo $lafila["nombre"]; ?></td>
  </tr>
  <tr> 
    <td><? echo $lafila["direccion"]; ?></td>
  </tr>
  <tr> 
    <td><? echo $lafila["cp"]; ?> <? echo $lafila["localidad"]; ?> 
      <? echo $lafila1["denprovincia"]; ?></td>
  </tr>
  <tr> 
    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Tlf: 
      <? echo $lafila["telefono"]; ?> Fax: <? echo $lafila["fax"]; ?></font></td>
  </tr>
</table>
<br>
<br>
<br>
<br>
<p>&nbsp;</p>
<p><br>
  <br>
</p>
<table width="60%" border="1" align="right" cellpadding="1" cellspacing="1" bordercolor="#0C9816">
  <tr bgcolor="#0C9816"> 
    <td width="26%"><div align="center"><font color="#FFFFFF"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">NIF</font></strong></font></div></td>
    <td width="28%"><div align="center"><font color="#FFFFFF"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Cod. 
    Proveedor</font></strong></font></div></td>
    <td width="24%"><div align="center"><font color="#FFFFFF"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Fecha</font></strong></font></div></td>
    <td width="22%"><div align="center"><font color="#FFFFFF"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">N&ordm; 
    Albar&aacute;n</font></strong></font></div></td>
  </tr>
  <tr> 
    <td><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $lafila["nif"]; ?></font></div></td>
    <td><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $lafila["codproveedor"]; ?></font></div></td>
    <td><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? print reconversion($lafila["fecha"]); ?></font></div></td>
    <td><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $lafila["codalbaran"]; ?></font></div></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<p>
  <?
   $consulta2 = "Select * from albalineap where codproveedor='$codcli' and codalbaran='$codalbaran' order by numlinea";
   $resultado2 = mysql_query($consulta2, $conexion);
?>
</p>
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#0C9816">
  <tr bgcolor="#cddfed"> 
    <td bgcolor="#0C9816"> <div align="center"><font color="#FFFFFF"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">C&oacute;digo</font></strong></font></div></td>
    <td bgcolor="#0C9816"> <div align="left"><font color="#FFFFFF"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Descripci&oacute;n</font></strong></font></div></td>
    <td bgcolor="#0C9816"> <div align="center"><font color="#FFFFFF"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Cantidad</font></strong></font></div></td>
    <td bgcolor="#0C9816"> <div align="center"><font color="#FFFFFF"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Precio</font></strong></font></div></td>
    <td bgcolor="#0C9816"> <div align="center"><font color="#FFFFFF"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Descuento</font></strong></font></div></td>
    <td bgcolor="#0C9816"> <div align="center"><font color="#FFFFFF"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Importe</font></strong></font></div></td>
  </tr>
  <? 
  $importe=0;
  $contador=0;
  while ($lafila2=mysql_fetch_array($resultado2)) { 
  $contador++;
  $familia=$lafila2["codfamilia"]; 
  $subfamilia=$lafila2["codsubfamilia"];
  $codigoarticulo=$lafila2["codigo"];
  $consulta3 = "Select * from articulos where codfamilia='$familia' and codsubfamilia='$subfamilia' and codigo='$codigoarticulo'";
  $resultado3 = mysql_query($consulta3, $conexion);
  $lafila3=mysql_fetch_array($resultado3);
  ?>
  <tr bordercolor="#FFFFFF"> 
    <td>
	  <div align="center"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><? echo $familia; echo $subfamilia; echo $codigoarticulo; ?></font></font></div></td>
      <td>
	  <div align="left"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><? echo substr($lafila3["descripcion"],0,65); ?></font></font></div></td>
    <td>
      <div align="center"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><? $ca=number_format($lafila2["cantidad"],2,",","."); echo $ca; ?></font></font></div></td>
	<td>
      <div align="center"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><? $pr1=number_format($lafila2["precio"],2,",","."); echo $pr1; ?></font></font></div></td>
 <? if ($lafila2["dcto"]==0) { ?>
	  <td>&nbsp;</td><? } else { ?>
	  <td><div align="center"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><? echo $lafila2["dcto"]; ?>%</font></font></div></td>
	  <? } ?>
    <td>
	<div align="center"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><? $impor=number_format($lafila2["importe"],2,",","."); echo $impor; ?></font></font></div></td>
	<? $importe=$importe + $lafila2["importe"]; ?>
  </tr>
  <? 
   } 
  while ($contador<=10) { ?>
  <tr bordercolor="#FFFFFF">
    <td><br></td>
    <td><br></td>
    <td><br></td>
    <td><br></td>
  </tr>
  <? $contador ++; } ?>
</table>
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="53%" border="1" align="right" cellpadding="1" cellspacing="1" bordercolor="#0C9816">
  <tr bgcolor="#0C9816"> 
    <td width="21%"> <div align="center"><font color="#FFFFFF"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Neto</font></strong></font></div></td>
    <td width="18%"> <div align="center"><font color="#FFFFFF"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Cuota 
    IVA</font></strong></font></div></td>
    <td width="33%"> <div align="center"><font color="#FFFFFF"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Imposici&oacute;n 
    IVA</font></strong></font></div></td>
    <td width="28%"> <div align="center"><font color="#FFFFFF"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Total</font></strong></font></div></td>
  </tr>
      <? $ivai=$lafila["iva"];
	$impo=$importe*($ivai/100);
	$impo=sprintf("%01.2f", $impo); 
	$total=$importe+$impo; 
	$total=sprintf("%01.2f", $total); 
	$total2= number_format($total,2,",","."); 
	$impo= number_format($impo,2,",",".");?>
  <tr> 
    <td><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? $importe= number_format($importe,2,",","."); echo $importe; ?> 
        </font> </div>
      <div align="center"></div></td>
    <td><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><? echo $lafila["iva"]; ?>%</font></font></div></td>
	<td><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><? echo $impo; ?></font></font></div></td>
    <td><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><? echo $total2; ?></font></font></div></td>
  </tr>
</table>
<p><br>
</p>
<table width="100%" border="0">
  <tr>
    <td><br></td>
  </tr>
</table>
<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#0C9816">
  <tr> 
    <td><strong>Observaciones:
      </strong>      <? 
	print $lafila[6]; ?>
	<br>
	<br>
	<center>
	<font color="#FF0000"><b>ALBARÁN FACTURADO</b></font>
	</center>
    </td>
  </tr>
</table>
<p>
  <?  @mysql_free_result($resultado); 
      @mysql_free_result($resultado1);
	  @mysql_free_result($resultado2); 
	  @mysql_free_result($resultado3);?>
</p>
<center>
<form action="imprimir_albaranfactp.php" method="post" target="_blank">
  <input type="hidden" name="codalbaran" value="<?=$codalbaran?>">
  <input type="submit" value="Imprimir albarán">
</form>
</center>
<p>&nbsp;</p></body>
</html>
