<html>
<head>
<title>Galopin v1.0</title>
<link href="../estilo.css" rel="stylesheet" type="text/css">
</head>

<body>
<img src="../images/nuevas/impresionarticulos.jpg" alt="Impresi&oacute;n de Art&iacute;culos"><br>
<br>

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
	
   include ("../conectar.php");
?>
  </p>
  
  
<? 
   if ($familia=="")
     {
?>  
  <table align="center">
    <tr>
      <td class="primeralineaizquierda">
	  <form name="form1" method="post" action="buscar_familia_articulo.php">
        <br>
          Familia:
          <select name="familia">
<?
		  $consulta="Select * from familia order by codigo,familia";
		  $query = mysql_query($consulta);
		  
		  while ($row=mysql_fetch_row($query))
		     {
?>
		      <option value="<?=$row[1]?>"><?=$row[1]?> -- <?=$row[2]?> </option>
<?
		     };
?>
		</select>
		<input type="submit" name="Selecciona Familia" value="Selecciona familia">
       </form>		
	  </th>
    </tr>
  </table>
   <br><br>	 

<?
}
else
{
?>
<form name="form1" method="post" action="imprimir_familias_bajo_minimos.php" target="_blank">
  <table align="center">
    <tr>
      <td align="left" class="primeralineaizquierda">
	     Familia:
	 </td>
	 <td align="left">	  
		  <? 
		  $consulta="Select * from familia where codigo='$familia';";
		  $query = mysql_query($consulta);
          $row = mysql_fetch_row($query);
          print($row[1] . " -- " . $row[2]);
		  ?>
		  <input type="hidden" name="familia" value="<?=$row[1]?>"> 
	  </td>
	</tr> 
	<tr> 
	  <td align="left" class="primeralineaizquierda">
		  Subfamilia: 
	  <td align="left">  
		  <select name="subfamilia">
<?			
			 $consulta2="Select * from subfamilia where idfamilia=$row[1] order by codigo, subfamilia";
			 $query2 = mysql_query($consulta2);
			 while ($row2=mysql_fetch_row($query2))
			    {
?>
                   <option value="<?=$row2[2]?>"><?=$row2[2]?> -- <?=$row2[3]?></option>
<?				
				};
?>
            </select> 

	  </td>
    </tr>
	<tr>
	  <td>
	  </td>
	  <td>
	  <input type="submit" name="imprime" value="Imprimir artículos">
	
	  </td>
	</tr>
  </table>
</form>	
  <br><br>	 

<?
};
?>  
  <p>&nbsp;    </p>
</div>

</body>
</html>
