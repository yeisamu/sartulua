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
<img src="../images/nuevas/impresionfacturas.jpg" alt="Administraci&oacute;n de Facturas"><br>
<br>

<form name="formul" method="post" action="impresionlistafacturas.php" target="_blank">
  <? if ($ini==1) {
     $error=0;
	 include ("../controlfecha1.php"); }
	 if ($error==1) {
	 print $errores; } ?>
  <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#0066FF">
    <tr> 
      <td width="33%" class="primeralineaizquierda">C&oacute;digo 
        de cliente</td>
      <td width="67%"> 
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
        de factura:</td>
      <td>
	  <? if ($ini==0) { ?>
	    <input name="factura" type="text" id="factura" size="8" maxlength="8">
	  <? } else { ?>
	    <input name="factura" type="text" id="factura" size="8" maxlength="8" value="<? echo $factura; ?>">
	  <? } ?>
    </td></tr>
    <tr> 
      <td class="primeralineaizquierda">Fecha de 
        la factura:</td>
      <td>Desde 
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
      <td class="primeralineaizquierda">Estado de la Factura:</td>
      <td>
	  <? if ($ini==0) { ?>
	    <select name="estado">
		  <option value="">Todas</option>
		  <option value="1">No pagada</option>
		  <option value="2">En Proceso</option>
		  <option value="3">Pagada</option>
		</select>
	  <? } else { ?>
	   	<select name="estado">
		  <option value="" <? if ($estado=="") print ("selected");?>>Todas</option>
		  <option value="1" <? if ($estado=="1") print ("selected");?>>No pagada</option>  
		  <option value="2" <? if ($estado=="2") print ("selected");?>>En proceso</option>
		  <option value="3" <? if ($estado=="3") print ("selected");?>>Pagada</option>
		  
		</select>
	  <? } ?>
    </td></tr>
	<tr> 
      <td class="primeralineaizquierda">Fecha de 
        cobro:</td>
      <td>Desde 
	  <? if ($ini==0) { ?>
        <input name="fecha11" type="text" id="fecha11" size="10" maxlength="10">
		<? } else { ?>
		<input name="fecha11" type="text" id="fecha11" size="10" maxlength="10" value="<? echo $fecha11; ?>">
		<? } ?>
        hasta 
		<? if ($ini==0) { ?>
        <input name="fecha22" type="text" id="fecha22" size="10" maxlength="10">
		<? } else { ?>
		<input name="fecha22" type="text" id="fecha22" size="10" maxlength="10" value="<? echo $fecha22; ?>">
		<? } ?>
    </td></tr>
	
    <tr> 
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2"><div align="center"> 
          <input type="submit" name="Submit" value="Imprimir búsqueda">
		  <input type="hidden" name="ini" value="1">
      </div></td>
    </tr>
  </table>
</form>


<?  @mysql_free_result($resultado);
    @mysql_free_result($resultado1);  ?>
</body>
</html>

