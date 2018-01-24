<?php 
 include('../inc/libreria.php');
  $link=conectarse();
 $valor=$_REQUEST[''];
 $campo_id=$_REQUEST['cid'];
$tabla=$_REQUEST['tb'];
 $campo_dato=$_REQUEST['cd'];
?>


<select name="<?php echo $campo_id ?>" id="<?php echo $campo_id ?>" class="ui-widget-content ui-corner-all">
<option value="" >Seleccione</option>
<?php
 
  $consulta="SELECT distinct(`estado`) as estado,case estado when 0 then 'sin asignar' when 1 then 'Asignados' when 2 then 'Descartados' when 3 then 'Apropiados' when 4 then 'Autorizados' end as est from servicio_h ";
  $sql=mysql_query($consulta);
  while($filadoc=mysql_fetch_array($sql)){
  $value=" echo $"."filadoc['estado'];";
 $dato="echo $"."filadoc['est'];";
  
  ?>
  <option value="<?php eval($value) ?>"><?php eval($dato) ?></option>
  
<?php  
  }
?>
</select>
