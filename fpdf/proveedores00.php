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
<link href="../estilo.css" rel="stylesheet" type="text/css">
<script>
var miPopup
function abreVentana(){
	miPopup = window.open("../buscarproveedor.php","miwin","width=600,height=400,scrollbars=yes")
	miPopup.focus()
	}
</script>
</head>
<? include ("../conectar.php");  
   include ("../convertirfechas2.php");?>
<body>
<img src="../images/nuevas/impresionalbaranesprovfact.jpg" alt="Impresión de Albaranes de Proveedor Facturados"><br>
<br>

<form name="form1" method="post" action="proveedores00.php">
  <? if ($ini==1) {
     $error=0;
	 include ("../controlfecha1.php"); }
	 if ($error==1) {
	 print $errores; } ?>
  <table align="center">
    <tr> 
      <td width="23%" class="primeralineaizquierda">C&oacute;digo 
        de proveedor</td>
      <td colspan="2"> 
	  <? if ($ini==0) { ?>
	    <input name="codigo" type="text" id="codigo" size="10" maxlength="10"> 
	  <? } else { ?>
	  <input name="codigo" type="text" id="nombre" size="10" maxlength="10" value="<? echo $codigo; ?>"> 
	  <? } ?>
	  <a href="#"><img src="../images/lupa.jpg" alt="Buscar Proveedor" width="17" height="17" border="0" onclick="abreVentana()"></a></td>
      </td>
    </tr>
    <tr> 
      <td class="primeralineaizquierda">C&oacute;digo 
        de albar&aacute;n:</td>
      <td>
	  <? if ($ini==0) { ?>
	  <input name="albaran" type="text" id="albaran" size="12" maxlength="12">
	  <? } else { ?>
	  <input name="albaran" type="text" id="albaran" size="12" maxlength="12" value="<? echo $albaran; ?>">
	  <? } ?>
    </td></tr>
    <tr> 
      <td class="primeralineaizquierda">Fecha del 
        albar&aacute;n:</td>
      <td colspan="2">Desde 
	  <? if ($ini==0) { ?>
        <input name="fecha1" type="text" id="fecha1" size="10" maxlength="10">
		<? } else { ?>
		<input name="fecha1" type="text" id="fecha1" size="10" maxlength="10" value="<? echo $fecha1; ?>">
		<? } ?>
        hasta 
		<? if ($ini==0) { ?>
        <input name="fecha2" type="text" id="fecha2" size="10" maxlength="10">
		<? } else { ?>
		<input name="fecha2" type="text" id="fecha2" size="10" maxlength="10" value="<? echo $fecha2; ?>">
		<? } ?>
    </td></tr>
	<tr> 
      <td class="primeralineaizquierda"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Ordenar 
        resultados por:</font></td>
		<? if ($ini==0) { ?>
      <td width="25%"><select name="campo" size="1">
          <option selected value="codalbaran">Cod. Albarán</option>
          <option value="fecha">Fecha</option>
          <option value="nombre">Proveedor</option>
        </select></td>
      <td width="42%"><input name="ordenacion" type="radio" value="desc" checked>Descendente
	  <input name="ordenacion" type="radio" value="asc">Ascendente</td>
	  <? }  
	  if ($ini==1) { 
	     if ($campo=="codalbaran") { ?>
		 <td width="25%"><select name="campo" size="1"><option selected value="codalbaran">Cod. Albarán</option>
          <option value="fecha">Fecha</option>
          <option value="nombre">Proveedor</option></select></td>
		  <? } else { 
		  if ($campo=="fecha") { ?>
		  <td width="25%"><select name="campo" size="1"><option  value="codalbaran">Cod. Albarán</option>
          <option selected value="fecha">Fecha</option>
          <option value="nombre">Proveedor</option></select></td>
		  <? } else { ?>
		   <td width="25%"><select name="campo" size="1"><option  value="codalbaran">Cod. Albarán</option>
          <option  value="fecha">Fecha</option>
          <option selected value="nombre">Proveedor</option></select></td>
		  <? } } ?>
		  <? if ($ordenacion=="desc") { ?>
		  <td width="42%"><input name="ordenacion" type="radio" value="desc" checked>Descendente
	  <input name="ordenacion" type="radio" value="asc">Ascendente</td>
		  <? } else { ?>
		  <td width="42%"><input name="ordenacion" type="radio" value="desc">Descendente
	  <input name="ordenacion" type="radio" value="asc" checked>Ascendente</td>
		  <? } ?>
	  
	  <? } ?>
    </tr>
    <tr> 
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="3"><div align="center"> 
          <input type="submit" name="Submit" value="Buscar albaranes">
		  <input type="hidden" name="ini" value="1">
      </div></td>
    </tr>
  </table>
</form>
<p>
<? if ($ini==1) {
     
      $consulta = "Select albaranesp.*,nombre from albaranesp,proveedores";
	  $consulta2 = " where albaranesp.codproveedor=proveedores.codproveedor and codfactura<>'0'";	 
	 include ("../cascadaalbaranesp.php");
	 $consulta = $consulta . " " . "order by ".$campo." ".$ordenacion." ";
     $resultado = mysql_query($consulta, $conexion);
     $filas=mysql_num_rows($resultado);
	 if (empty($numi)) { $numi=0; }
	 print "<center><font size=2 face='Verdana, Arial, Helvetica, sans-serif'>Número de albaranes " . $filas . "</font></center>";
	 $consulta=$consulta." limit $numi,10";
	 $resultado = mysql_query($consulta, $conexion);
	 $enlaces=$filas;
   ?>
</p>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr bgcolor="#cddfed"> 
    <td width="8%" class="primeralinea">Cod. Albar&aacute;n</td>
    <td width="20%" class="primeralinea">Proveedor</td>
    <td width="7%" class="primeralinea">Fecha</td>
    <td width="9%" class="primeralinea">Ver 
      albar&aacute;n</td>
  </tr>
  <? while ($lafila=mysql_fetch_array($resultado)) { ?>
  <tr> 
    <? 
     $fech=$lafila["fecha"]; 
	 $fech=reconversion($fech);
	 $codcli=$lafila["codproveedor"]; 
	 $consulta1 = "select nombre from proveedores where codproveedor = '$codcli'";
     $resultado1 = mysql_query($consulta1, $conexion);
     $lafila1=mysql_fetch_array($resultado1); ?>
    <td class="segundalinea"><font color="#FF0000"><b><? echo $lafila["codalbaran"]; ?></b></font></td>
    <td class="segundalineaizquierda"><font color="#FF0000"><? echo $lafila1["nombre"]; ?></font></td>
    <td class="segundalinea"><? echo $fech; ?></td>
    <td class="segundalinea">
    <form name="form2" method="post" action="vista_albaran_facturadop.php">
      <input type="submit" name="Submit2" value="Ver albar&aacute;n facturado">
	</td>
	  <input type="hidden" name="codcli" value="<?=$codcli?>">
      <input type="hidden" name="codalbaran" value="<? echo $lafila["codalbaran"]; ?>">
    </form>
  </tr>
  <? } ?>
</table> 
 <? } 
  if ($enlaces>10) {
  $i=0;
  $j=1; 
  print "<center><font size=2 face='Verdana, Arial, Helvetica, sans-serif'>Páginas: ";
  while ($i<$enlaces) { ?>
      <a href="proveedores00.php?fecha1=<? echo reconversion($fecha1); ?>&fecha2=<? echo reconversion($fecha2); ?>&campo=<? echo $campo; ?>&ordenacion=<? echo $ordenacion; ?>&codigo=<? echo $codigo; ?>&ini=1&numi=<? echo $i; ?>"><? echo $j; ?></a>
 <? $j++; 
 $i=$i+10; }
 }
    @mysql_free_result($resultado);
    @mysql_free_result($resultado1);  ?>
</body>
</html>
