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
<img src="../images/nuevas/impresionfacturas.jpg" alt="Impresi�n de Facturas"><br>
<br>

<form name="formul" method="post" action="facturas.php">
  <? if ($ini==1) {
     $error=0;
	 include ("../controlfecha1.php"); }
	 if ($error==1) {
	 print $errores; } ?>
  <table align="center">
    <tr> 
      <td width="20%" class="primeralineaizquierda">C&oacute;digo 
        de cliente</td>
      <td colspan="2"> 
	  <? if ($ini==0) { ?>
	    <input name="codigo" type="text" id="codigo" size="10" maxlength="10"> 
	  <? } else { ?>
	  <input name="codigo" type="text" id="nombre" size="10" maxlength="10" value="<? echo $codigo; ?>"> 
	  <? } ?>
	  <a href="#"><img src="../images/lupa.jpg" alt="Buscar Cliente" width="17" height="17" border="0" onclick="abreVentana()"></a></td>
      <td width="1%"></td>
    </tr>
    <tr> 
      <td class="primeralineaizquierda">C&oacute;digo 
        de factura:</td>
      <td colspan="3">
	  <? if ($ini==0) { ?>
	    <input name="factura" type="text" id="factura" size="8" maxlength="8">
	  <? } else { ?>
	    <input name="factura" type="text" id="factura" size="8" maxlength="8" value="<? echo $factura; ?>">
	  <? } ?>
    </td></tr>
    <tr> 
      <td class="primeralineaizquierda">Fecha de 
        la factura:</td>
      <td colspan="3">Desde 
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
      <td colspan="3">
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
      <td colspan="3">Desde 
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
      <td class="primeralineaizquierda"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Ordenar 
        resultados por:</font></td>
		<? if ($ini==0) { ?>
      <td width="25%"><select name="campo" size="1">
          <option selected value="codfactura">Cod. Factura</option>
          <option value="fecha">Fecha</option>
		  <option value="fechacobro">Fecha de Cobro</option>
          <option value="nombre">Cliente</option>
        </select></td>
      <td width="42%"><input name="ordenacion" type="radio" value="desc" checked>Descendente
	  <input name="ordenacion" type="radio" value="asc">Ascendente</td>
	  <? }  
	  if ($ini==1) { 
	     if ($campo=="codfactura") { ?>
		       <td width="25%"><select name="campo" size="1"><option selected value="codfactura">Cod. Factura</option>
                <option value="fecha">Fecha</option>
		         <option value="fechacobro">Fecha de Cobro</option>
                <option value="nombre">Cliente</option></select></td>
		      <? } else { 
		       if ($campo=="fecha") { ?>
		           <td width="25%"><select name="campo" size="1"><option  value="codfactura">Cod. Factura</option>
                   <option selected value="fecha">Fecha</option>
		           <option value="fechacobro">Fecha de Cobro</option>
                   <option value="nombre">Cliente</option></select></td>
		         <? } else { 
		              if ($campo=="fechacobro") { ?>
		                 <td width="25%"><select name="campo" size="1"><option  value="codfactura">Cod. Factura</option>
                         <option value="fecha">Fecha</option>
		                 <option selected value="fechacobro">Fecha de Cobro</option>
                         <option value="nombre">Cliente</option></select></td>
		             <? } else { ?>
		                    <td width="25%"><select name="campo" size="1"><option  value="codfactura">Cod. Factura</option>
		                    <option  value="fecha">Fecha</option>
		                    <option value="fechacobro">Fecha de Cobro</option>
                            <option selected value="nombre">Cliente</option></select></td>
		  <? } } } ?>
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
          <input type="submit" name="Submit" value="Buscar facturas">
		  <input type="hidden" name="ini" value="1">
      </div></td>
    </tr>
  </table>
</form>
<p>
  <? if ($ini==1) {
     $consulta = "Select facturas.*,nombre from facturas,clientes";
	
     $consulta2 = "where facturas.codcliente=clientes.codcliente and codfactura<>'0'";
	 
	 if ($estado<>"") $consulta2 = $consulta2 . " and estado=$estado";
	 
	 
	 include ("../convertirfechas.php");
	 $fecha11=conversion($fecha11);
     $fecha22=conversion($fecha22);
	 
	 if (($fecha11<>"") and ($fecha22<>""))
	   {
	     $consulta2= $consulta2 . " and fechacobro >= '$fecha11' and fechacobro <= '$fecha22'";
	   };
	 include ("../cascadafacturas.php");
	 $consulta = $consulta . " " . "order by ".$campo." ".$ordenacion." ";
     $resultado = mysql_query($consulta, $conexion);
     $filas=mysql_num_rows($resultado);
	 if (empty($numi)) { $numi=0; }
	 print "<center><font size=2 face='Verdana, Arial, Helvetica, sans-serif'>N�mero de facturas " . $filas . "</font></center>";
	 $consulta=$consulta." limit $numi,10";
	 $resultado = mysql_query($consulta, $conexion);
	 $enlaces=$filas;
	 if ($estado==1) $estadofacturas=" no pagadas";
	 if ($estado==2) $estadofacturas=" en proceso de pago";
	 if ($estado==3) $estadofacturas=" pagadas";
   ?>
</p>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#0066FF">
  <tr> 
    <td width="13%" class="primeralineaizquierda">Cod. Factura</td>
    <td width="32%" class="primeralineaizquierda">Cliente</td>
    <td width="7%" class="primeralineaizquierda">Fecha</td>
	<td width="7%" class="primeralineaizquierda">F.Cobro</td>
    <td width="19%" class="primeralineaizquierda">Ver Factura</td>
  </tr>
  <? while ($lafila=mysql_fetch_array($resultado)) { ?>
  <tr> 
    <? 
     $fech=$lafila["fecha"]; 
	 $fech=reconversion($fech);
	 $fechacobro=$lafila["fechacobro"];
	 $fechacobro=reconversion($fechacobro);
	 $codcli=$lafila["codcliente"]; 
	 $consulta1 = "select nombre from clientes where codcliente = '$codcli'";
     $resultado1 = mysql_query($consulta1, $conexion);
     $lafila1=mysql_fetch_array($resultado1); ?>
    <td class="segundalinea"><b><font color="#FF0000"><? echo $lafila["codfactura"]; ?></font></b></td>
    <td class="segundalineaizquierda"><font color="#FF0000"><? echo $lafila1["nombre"]; ?></font></td>
    <td class="segundalinea"><? echo $fech; ?></td>
	<td class="segundalinea"><? echo $fechacobro; ?></td>
    <td class="segundalinea"> 
      <form name="form2" method="post" action="vista_factura.php"> 
        <input type="submit" name="Submit2" value="Imprimir factura">
      </td>
	    <input type="hidden" name="codfactura" value="<? echo $lafila["codfactura"]; ?>">
				  <input type="hidden" name="codalba" value="<? echo $lafila["codfactura"]; ?>">
		  <input type="hidden" name="codcli" value="<? echo $codcli; ?>">
		  <input type="hidden" name="ini" value="0">
		 </form>
  </tr>
  <? } ?>
</table> 
  <? } 
  if ($enlaces>10) {
  $i=0;
  $j=1; 
  print "<center><font size=2 face='Verdana, Arial, Helvetica, sans-serif'>P�ginas: ";
  while ($i<$enlaces) { ?>
      <a href="facturas.php?fecha11=<? echo reconversion($fecha11); ?>&fecha22=<? echo reconversion($fecha22); ?>&fecha1=<? echo reconversion($fecha1); ?>&fecha2=<? echo reconversion($fecha2); ?>&estado=<? echo $estado; ?>&campo=<? echo $campo; ?>&ordenacion=<? echo $ordenacion; ?>&codigo=<? echo $codigo; ?>&ini=1&numi=<? echo $i; ?>"><? echo $j; ?></a>
 <? $j++; 
 $i=$i+10; }
 }
    @mysql_free_result($resultado);
    @mysql_free_result($resultado1);  ?>
</body>
</html>
