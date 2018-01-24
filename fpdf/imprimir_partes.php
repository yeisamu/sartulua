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
	miPopup = window.open("../buscarcliente.php","miwin","width=600,height=400,scrollbars=yes")
	miPopup.focus()
	}
</script>
</head>
<? include ("../conectar.php");  
   include ("../convertirfechas2.php");?>
<body>
<img src="../images/nuevas/impresionpartes.jpg" alt="Impresión de Partes"><br>
<br>

<form name="formul" method="post" action="imprimir_partes.php">
  <? if ($ini==1) {
     $error=0;
	 include ("../controlfecha1.php"); }
	 if ($error==1) {
	 print $errores; } ?>
  <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#0066FF">
    <tr> 
      <td width="20%" class="primeralineaizquierda">C&oacute;digo 
        de cliente:</td>
      <td colspan="2"> 
	  <? if ($ini==0) { ?>
	    <input name="codigo" type="text" id="codigo" size="10" maxlength="10"> 
	  <? } else { ?>
	  <input name="codigo" type="text" id="nombre" size="10" maxlength="10" value="<? echo $codigo; ?>"> 
	  <? } ?>
	  <a href="#"><img src="../images/lupa.jpg" alt="Buscar Cliente" width="17" height="17" border="0" onclick="abreVentana()"></a></td>
      </td>
    </tr>
    <tr> 
      <td class="primeralineaizquierda">C&oacute;digo 
        de parte:</td>
      <td colspan="2">
	  <? if ($ini==0) { ?>
	  <input name="parte" type="text" id="albaran" size="8" maxlength="8">
	  <? } else { ?>
	  <input name="parte" type="text" id="albaran" size="8" maxlength="8" value="<? echo $parte; ?>">
	  <? } ?>
    </td></tr>
    <tr> 
      <td class="primeralineaizquierda">Fecha del 
        parte:</td>
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
          <option selected value="codparte">Cod. Parte</option>
          <option value="fecha">Fecha</option>
          <option value="nombre">Cliente</option>
        </select></td>
      <td width="42%"><input name="ordenacion" type="radio" value="desc" checked>Descendente
	  <input name="ordenacion" type="radio" value="asc">Ascendente</td>
	  <? }  
	  if ($ini==1) { 
	     if ($campo=="codparte") { ?>
		 <td width="25%"><select name="campo" size="1"><option selected value="codparte">Cod. Parte</option>
          <option value="fecha">Fecha</option>
          <option value="nombre">Cliente</option></select></td>
		  <? } else { 
		  if ($campo=="fecha") { ?>
		  <td width="25%"><select name="campo" size="1"><option  value="codparte">Cod. Parte</option>
          <option selected value="fecha">Fecha</option>
          <option value="nombre">Cliente</option></select></td>
		  <? } else { ?>
		   <td width="25%"><select name="campo" size="1"><option  value="codparte">Cod. Parte</option>
          <option  value="fecha">Fecha</option>
          <option selected value="nombre">Cliente</option></select></td>
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
          <input type="submit" name="Submit" value="Buscar partes">
		  <input type="hidden" name="ini" value="1">
      </div></td>
    </tr>
  </table>
</form>
<p>
 <? if ($ini==1) {
     $consulta = "Select partes.*,nombre from partes,clientes";
     $consulta2 = "where partes.codcliente=clientes.codcliente and codalbaran=0";
	 include ("../cascadapartes.php");
	 $consulta = $consulta . " " . "order by ".$campo." ".$ordenacion." ";
	 $resultado = mysql_query($consulta, $conexion);
     $filas=mysql_num_rows($resultado);
	 if (empty($numi)) { $numi=0; }
	 print "<center><font size=2 face='Verdana, Arial, Helvetica, sans-serif'>Número de partes " . $filas . "</font></center>";
	 $consulta=$consulta." limit $numi,10";
	 $resultado = mysql_query($consulta, $conexion);
	 $enlaces=$filas;
   ?>
</p>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr bgcolor="#cddfed"> 
    <td width="6%" class="primeralinea">Cod. Parte</td>
    <td width="20%" class="primeralinea">Cliente</td>
    <td width="7%" class="primeralinea">Fecha</td>
    <td width="9%" class="primeralinea">Imprimir parte</td>
  </tr>
  <? while ($lafila=mysql_fetch_array($resultado)) { ?>
  <tr> 
    <? 
     $fech=$lafila["fecha"]; 
	 $fech=reconversion($fech);
	 $codcli=$lafila["codcliente"]; 
	 $consulta1 = "select nombre from clientes where codcliente = '$codcli'";
     $resultado1 = mysql_query($consulta1, $conexion);
     $lafila1=mysql_fetch_array($resultado1); ?>
    <td class="segundalinea"><font color="#FF0000"><b><? echo $lafila["codparte"]; ?></b></font></td>
    <td class="segundalineaizquierda"><font color="#FF0000"><? echo $lafila1["nombre"]; ?></font></td>
    <td class="segundalinea"><? echo $fech; ?></td>
	<td class="segundalinea">
    <form name="form2" method="post" action="vista_parte.php">
      <input type="submit" name="Submit2" value="Imprimir parte">
      <font size="1"></td></font>
      <input type="hidden" name="codparte" value="<? echo $lafila["codparte"]; ?>">
    </form>
	</td>
  </tr>
  <? } ?>
</table> 
  <? } 
  if ($enlaces>10) {
  $i=0;
  $j=1; 
  print "<center><font size=2 face='Verdana, Arial, Helvetica, sans-serif'>Páginas: ";
  while ($i<$enlaces) { ?>
      <a href="imprimir_partes.php?fecha1=<? echo reconversion($fecha1); ?>&fecha2=<? echo reconversion($fecha2); ?>&campo=<? echo $campo; ?>&ordenacion=<? echo $ordenacion; ?>&codigo=<? echo $codigo; ?>&ini=1&numi=<? echo $i; ?>"><? echo $j; ?></a>
 <? $j++; 
 $i=$i+10; }
 }
    @mysql_free_result($resultado);
    @mysql_free_result($resultado1);  ?>
</body>
</html>
