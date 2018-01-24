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
	miPopup = window.open("../listado_articulos.php","miwin","width=600,height=400,scrollbars=yes")
	miPopup.focus()
	}
</script>
<style type="text/css">
<!--
.Estilo2 {color: #FF0000}
-->
</style>
</head>

<body>
<img src="../images/nuevas/impresionarticulos.jpg" alt="Impresi&oacute;n de Art&iacute;culos"><br>
<br>


  <?
   include ("../conectar.php");
  ?>
<blockquote><font size="2">Buscador de Artículos:</font></blockquote>

<table width="80%" border="0" align="center" bordercolor="#0066FF" cellspacing="0" cellpadding="0">
   <tr>
    <td width="51%" bgcolor="#0066FF" align="left">
    <form action="imprimir_lista_articulos.php" name="formul" target="_blank">
	  <input type="hidden" name="ini" value="true">
	 <br> 
	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#0066FF">
     <tr>
	   <td colspan="4" class="primeralinea">
	     Búsquedas por código, articulo y proveedor</td>
	  </tr>
	  <tr>
	   <td class="primeralineaizquierda">
	     Código <font color="ff0000" size="1">(6dig)</font>:
	   </td>
	   <td colspan="3">
	     <input type="text" name="codigo" size="6" maxlength="6">
		 <a href="#"><img src="../images/lupa.jpg" alt="Buscar Artículo" width="17" height="17" border="0" onclick="abreVentana()"></a></td>
	   </td>
	  </tr>
	  	  <tr>
	   <td class="primeralineaizquierda">
	     Código Inicio <font color="ff0000" size="1">(6dig)</font>:
	   </td>
	   <td width="8%">
	     <input type="text" name="codini" size="6" maxlength="6">
	   </td>
	   
	   <td width="18%" class="primeralineaizquierda">Código Fin <font color="ff0000" size="1">(6dig)</font>:</td>
	   <td width="54%"><input type="text" name="codfin" size="6" maxlength="6"></td>
	  	  </tr>
	  <tr> 
	    <td width="20%" class="primeralineaizquierda">
		  Artículo:
		</td>
		<td colspan="3">
		 <input name="articulo" type="text" size="35">
		</td>
	  </tr>
	  <tr>
	    <td width="20%" class="primeralineaizquierda">
		   <?
	        //buscamos los proveedores
	        $consulta="select * from proveedores order by nombre";
	        $query = mysql_query($consulta);
	       ?>
		   Proveedor:
		</td>
		<td colspan="3">
		<select name="proveedor" >
	     <option value=""></option>
	     <?
		   while ($row=mysql_fetch_row($query))
		      {
		 ?>
		        <option value="<?=$row[0]?>"><?=$row[1]?></option>
		 <?
			  }
	     ?>
	   </select>
		</td>
	  </tr>
	</table> 
       <br>
	   <center>
	   <input type="submit" value="Buscar Artículos">
	   </center>
	</form>	 
</table>

</body>
</html>

