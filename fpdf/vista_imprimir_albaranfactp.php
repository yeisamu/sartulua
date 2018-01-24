<?php
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
   $codpro=$lafila["codprovincia"];
   $consulta1 = "Select * from provincias where codprovincia='$codpro'";
   $resultado1 = mysql_query($consulta1, $conexion);
   $lafila1=mysql_fetch_array($resultado1);     
?>
<body bgcolor="#ffffff">
<table width="35%" border="1" cellpadding="1" cellspacing="1" bordercolor="#0C9816" align="right">
  <tr> 
    <td width="27%" height="21" bgcolor="#0C9816"><div align="center"><strong><font color="#FF0000">ALBAR&Aacute;N FACTURADO</font></strong></div></td>
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
    <td>Tlf: 
      <? echo $lafila["telefono"]; ?> Fax: <? echo $lafila["fax"]; ?></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="60%" border="1" align="right" cellpadding="1" cellspacing="1" bordercolor="#0C9816">
  <tr bgcolor="#0C9816"> 
    <td width="26%"><div align="center"><font color="#FFFFFF"><strong>NIF</strong></font></div></td>
    <td width="28%"><div align="center"><font color="#FFFFFF"><strong>Cod. 
    Proveedor</strong></font></div></td>
    <td width="24%"><div align="center"><font color="#FFFFFF"><strong>Fecha</strong></font></div></td>
    <td width="22%"><div align="center"><font color="#FFFFFF"><strong>N&ordm; 
    Albar&aacute;n</strong></font></div></td>
  </tr>
  <tr> 
    <td align="center"><? echo $lafila["nif"]; ?></td>
    <td align="center"><? echo $lafila["codproveedor"]; ?></td>
    <td align="center"><? print reconversion($lafila["fecha"]); ?></td>
    <td align="center"><? echo $lafila["codalbaran"]; ?></td>
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
   $consulta2 = "Select * from albalineap where codalbaran='$codalbaran' order by numlinea";
   $resultado2 = mysql_query($consulta2, $conexion);
?>
</p>
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#0C9816">
  <tr bgcolor="#cddfed"> 
    <td bgcolor="#0C9816"> <div align="center"><strong><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">C&oacute;digo</font></strong></div></td>
    <td bgcolor="#0C9816"> <div align="center"><font color="#FFFFFF"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Descripci&oacute;n</font></strong></font></div></td>
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
  <tr> 
   <td>
	  <? echo $familia; echo $subfamilia; echo $codigoarticulo; ?></td>
    <td>
	  <? echo substr($lafila3["descripcion"],0,65); ?></td>
    <td>
	   <? $ca= number_format($lafila2["cantidad"],2,",","."); echo $ca; ?></td>
	<td>
	   <? $pr1= number_format($lafila2["precio"],2,",","."); echo $pr1; ?></td>
	  <? if ($lafila2["dcto"]==0) { ?>
	  <td>&nbsp;</td><? } else { ?>
	  <td><? echo $lafila2["dcto"]; ?>%</td>
	  <? } ?>		  
    <td>
	<? $impor= number_format($lafila2["importe"],2,",","."); echo $impor; ?></td>
	<? $importe=$importe + $lafila2["importe"]; ?>
  </tr>
    <? 
  } 
  while ($contador<=10) { ?>
  <tr>
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
    <td width="33%"> <div align="center"><font color="#FFFFFF"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">IVA</font></strong></font></div></td>
    <td width="28%"> <div align="center"><font color="#FFFFFF"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Total</font></strong></font></div></td>
  </tr>
  <tr> 
    <td><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? $importe= number_format($importe,2,",","."); echo $importe; ?> 
        </font> </div>
      <div align="center"></div></td>
    <td><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><? echo $lafila["iva"]; ?>%</font></font></div></td>
    <? $ivai=$lafila["iva"];
	$impo=$importe*($ivai/100);
	$impo=sprintf("%01.2f", $impo); 
	$total=$importe+$impo; 
	$total=sprintf("%01.2f", $total); 
	$impo= number_format($impo,2,",","."); ?>
	<td><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><? echo $impo; ?></font></font></div></td>
    <td><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><? echo $total; ?></font></font></div></td>
  </tr>
</table>
<p><br>
  <?  @mysql_free_result($resultado); 
      @mysql_free_result($resultado1);
	  @mysql_free_result($resultado2); 
	  @mysql_free_result($resultado3);?>
</p>
<p>&nbsp;</p>
<p align="center">

<form action="imprimir_albaranfactp.php" method="post" target="_blank">
  <input type="hidden" name="codalbaran" value="<?=$codalbaran?>">
  <center><input type="submit" value="Imprimir albarán">
  </center>
</form>
</p>
</body>
</html>
