<?php 
 include('../inc/libreria.php');
  $link=conectarse();
 $valor=$_REQUEST[''];
 $campo_id=$_REQUEST['cid'];
$tabla=$_REQUEST['tb'];
 $campo_dato=$_REQUEST['cd'];
?>


<select name="<?php echo $campo_id ?>" id="<?php echo $campo_id ?>" class="ui-widget-content ui-corner-all">
<?php
 
  $consulta="select * from $tabla";
  $sql=mysql_query($consulta);
  while($filadoc=mysql_fetch_array($sql)){
  $value=" echo $"."filadoc['".$campo_id."'];";
 $dato="echo $"."filadoc['".$campo_dato."'];";
  
  ?>
  <option value="<?php eval($value) ?>"><?php eval($dato) ?></option>
  
<?php  
  }
?>
</select>
  