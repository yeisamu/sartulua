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
	
	Autores: Pedro Obreg�n Mej�as
			 Rub�n D. Mancera Mor�n
	Versi�n: 1.0
	Fecha Liberaci�n del c�digo: 13/07/2004
	Galop�n para gnuLinEx 2004 -- Extremadura		 
	
	*/

?>
<html>
<head>
<title>Galopin v1.0</title>
</head>
  <? include ("../conectar.php");
  include ("../convertirfechas2.php"); 
   $consulta = "Select * from facturasp,proveedores where facturasp.codfactura='$codfactura' and facturasp.codproveedor='$codcli' and facturasp.codproveedor=proveedores.codproveedor";
   $resultado = mysql_query($consulta, $conexion);
   $lafila=mysql_fetch_array($resultado);
   $codpro=$lafila["codprovincia"];
   $consulta1 = "Select * from provincias where codprovincia='$codpro'";
   $resultado1 = mysql_query($consulta1, $conexion);
   $lafila1=mysql_fetch_array($resultado1);     
?>
<body bgcolor="#ffffff">
<p>&nbsp;</p>
<table width="30%" border="1" align="right" cellpadding="1" cellspacing="1" bordercolor="#0C9816">
  <tr> 
    <td width="27%" align="center" bgcolor="#0C9816"><strong><font color="#FFFFFF">FACTURA DE PROVEEDOR</font></strong></td>
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
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<br>
<table width="60%" border="1" align="right" cellpadding="1" cellspacing="1" bordercolor="#0C9816">
  <tr bgcolor="#0C9816"> 
    <td width="26%" align="center"><font color="#FFFFFF"><strong>NIF</strong></font></td>
    <td width="28%" align="center"><font color="#FFFFFF"><strong>Cod. Proveedor</strong></font></td>
    <td width="24%" align="center"><font color="#FFFFFF"><strong>Fecha</strong></font></td>
    <td width="22%" align="center"><font color="#FFFFFF"><strong>N&ordm; Factura</strong></font></td>
  </tr>
  <tr> 
    <td align="center"><? echo $lafila["nif"]; ?></td>
    <td align="center"><? echo $lafila["codproveedor"]; ?></td>
    <td align="center"><? print reconversion($lafila["fecha"]); ?></td>
    <td align="center"><? echo $lafila["codfactura"]; ?></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>
  <?
   $consulta2 = "Select * from factulineap where codfactura='$codfactura' and codproveedor='$codcli' order by numlinea";
   $resultado2 = mysql_query($consulta2, $conexion);
?>
</p>
<p>&nbsp;</p>
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#0C9816">
  <tr bgcolor="#cddfed" align="center"> 
    <td align="center" bgcolor="#0C9816"><font color="#FFFFFF"><strong>C&oacute;digo</strong></font></td>
    <td align="center" bgcolor="#0C9816"><font color="#FFFFFF"><strong>Descripci&oacute;n</strong></font></td>
    <td align="center" bgcolor="#0C9816"><font color="#FFFFFF"><strong>Cantidad</strong></font></td>
    <td align="center" bgcolor="#0C9816"><font color="#FFFFFF"><strong>Precio</strong></font></td>
	<td align="center" bgcolor="#0C9816"><font color="#FFFFFF"><strong>Descuento</strong></font></td>
    <td align="center" bgcolor="#0C9816"><font color="#FFFFFF"><strong>Importe</strong></font></td>
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
    <td><? if (($familia=="a") and ($subfamilia=="a")) { ?>
      <div align="center"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif">Albar�n</font></font></div></td>
	  <? } else { ?>
	  <div align="center"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><? echo $familia; echo $subfamilia; echo $codigoarticulo; ?></font></font></div></td>
	  <? } ?>
    <td><? if (($familia=="a") and ($subfamilia=="a")) { ?> 
      <div align="left"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif">Albar�n n� <? echo $codigoarticulo; ?></font></font></div></td>
	  <? } else { ?>
	  <div align="left"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><? echo substr($lafila3["descripcion"],0,65); ?></font></font></div></td>
    <? } ?>
	<td><? if (($familia=="a") and ($subfamilia=="a")) { ?> 
      <div align="center"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"></font></font></div></td>
	  <? } else { 
	  $cantidad= number_format($lafila2["cantidad"],2,",","."); 
	?> 		  
	  <div align="right"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><?=$cantidad?></font></font></div></td>
	  <? } ?>
    <td><? if (($familia=="a") and ($subfamilia=="a")) { ?> 
      <div align="center"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"></font></font></div></td>
	  <? } else { 
	  $precio= number_format($lafila2["precio"],2,",",".");
	?> 		  
	  <div align="right"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><?=$precio?></font></font></div></td>
	  <? } ?>
	  <? if ($lafila2["dcto"]==0) { ?>
	  <td>&nbsp;</td><? } else { ?>
	  <td><div align="center"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><? echo $lafila2["dcto"]; ?>%</font></font></div></td>
	  <? } ?>
    <td><? if (($familia=="a") and ($subfamilia=="a")) { ?> 
      <div align="center"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"></font></font></div></td>
	<? } else { 
	  $importe2= number_format($lafila2["importe"],2,",",".");
	?> 		
	<div align="center"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><?=$importe2?></font></font></div></td>
	<? $importe=$importe + $lafila2["importe"]; ?>
	<? } ?>
  </tr>
  
    <? 
  if (($familia=="a") and ($subfamilia=="a")) 
     {
       $consultap = "Select * from albalineap,articulos where codproveedor='$codcli' and codalbaran='$codigoarticulo' and albalineap.codfamilia=articulos.codfamilia and
       albalineap.codsubfamilia=articulos.codsubfamilia and albalineap.codigo=articulos.codigo";
       $resultadop = mysql_query($consultap, $conexion);
       while ($lafilap=mysql_fetch_array($resultadop)) 
	      {  
	?>
             <tr bordercolor="#FFFFFF"> 
               <td><div align="center"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif" color="#000000"><? echo $lafilap[3]; echo $lafilap[4]; echo $lafilap[5]; ?></font></font></div></td>
               <td><div align="left"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif" color="#000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- <? echo substr($lafilap["descripcion"],0,65); ?></font></font></div></td>
               <td>
	            <?
	             $cantidad2= number_format($lafilap["cantidad"],2,",","."); 
	           ?> 			   
			   <div align="right"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif" color="#000000"><?=$cantidad2?></font></font></div></td>
               <td>
	            <?
	              $precio2= number_format($lafilap["precio"],2,",",".");
	            ?> 				   
			   <div align="right"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif" color="#000000"><?=$precio2?></font></font></div></td>
			   <? if ($lafilap["dcto"]==0) { ?>
               <td><div align="center"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif" color="#000000"></font></font></div></td>
			   <? } else { ?>
			   <td><div align="center"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif" color="#000000"><? echo $lafilap["dcto"]; ?>%</font></font></div></td>
			   <? } ?>
               <td>
			   	<?
	              $importe3= number_format($lafilap["importe"],2,",","."); 
	            ?> 
			   <div align="center"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif" color="#000000"><?=$importe3?></font></font></div></td>
			   <? $importe=$importe + $lafilap["importe"]; ?>
             </tr>
      <? }
    }
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
<br>
<table width="53%" border="1" align="right" cellpadding="1" cellspacing="1" bordercolor="#0C9816">
  <tr bgcolor="#0C9816"> 
    <td width="21%"> <div align="center"><font color="#FFFFFF"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Neto</font></strong></font></div></td>
    <td width="18%"> <div align="center"><font color="#FFFFFF"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Cuota 
    IVA</font></strong></font></div></td>
    <td width="33%"> <div align="center"><font color="#FFFFFF"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Imposici&oacute;n 
    IVA</font></strong></font></div></td>
    <td width="28%"> <div align="center"><font color="#FFFFFF"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Total</font></strong></font></div></td>
  </tr>
  <tr> 
    <td>
	<?
	  $importe4= number_format($importe,2,",","."); 
	?> 		
	<div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?=$importe4?> 
        </font> </div>
      <div align="center"></div></td>
    <td><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><? echo $lafila["iva"]; ?>%</font></font></div></td>
    <? $ivai=$lafila["iva"];
	$impo=$importe*($ivai/100);
	$impo=sprintf("%01.2f",$impo);
	$total=$importe+$impo; 
	$impo= number_format($impo,2,",",".");
	?>
	<td>	
	<div align="right"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><? echo $impo; ?></font></font></div></td>
    <td>
	<?
	  $total=sprintf("%01.2f",$total);
	  $total2= number_format($total,2,",","."); 
	?> 			
	<div align="right"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><? echo $total2; ?> �</font></font></div></td>
  </tr>
</table>
<p><br>
  <br><br></p>
<p><br></p>
<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#0C9816">
  <tr> 
    <td><strong>Observaciones:
      </strong>      <? 
	print $lafila[5]; ?>
    </td>
  </tr>
</table>
  <?  @mysql_free_result($resultado); 
      @mysql_free_result($resultado1);
	  @mysql_free_result($resultado2); 
	  @mysql_free_result($resultado3);?>
<center>
<form action="imprimir_facturap.php" method="post" target="_blank">
 <input type="hidden" name="codfactura" value="<? echo $lafila["codfactura"]; ?>">
 <input type="hidden" name="codalba" value="<? echo $lafila["codfactura"]; ?>">
 <input type="hidden" name="codcli" value="<? echo $codcli; ?>">
 <input type="hidden" name="ini" value="0">
 <input type="submit" value="Imprimir factura de proveedor">
</form>
</center>
</body>
</html>
