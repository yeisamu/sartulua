<table width="500" border="0" align="center" cellspacing="5">
      <tr class="ui-widget-header" >
       <!-- <td width="62" ><div align="center" class="Estilo3"><span class="Estilo1">id</span></div></td> -->
        <td width="45"><div align="center" class="Estilo3"><span >C&oacute;digo</span></div></td>
        <td width="206"><div align="center" class="Estilo3"><span >Documento</span></div></td>
		<td width="206"><div align="center" class="Estilo3"><span >N&uacute;mero</span></div></td>
		<td width="206"><div align="center" class="Estilo3"><span >Entidad</span></div></td>
        <td width="124"><div align="center" class="Estilo3"><span >Fecha Vigencia </span></div></td>
      </tr>
<?php
		include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
		include('../inc/operaciones.php');
		$link=conectarse();
		$fecha=date('Y-m-d');
        $id_cond=$_REQUEST['id_con'];
	  $consulta = "SELECT * FROM (`con_doc` left join entidad_salud on con_doc.id_eps=entidad_salud.id_eps) inner join documento on con_doc. `id_doc` = documento. `id_doc` WHERE con_doc. `id_conductor` =$id_cond";
       $resultado=mysql_query($consulta);
	   $ndoc=mysql_num_rows($resultado);
	    $error="";
		$i=0;
		$novedad=0;
		  $elementoc = 0;
		 $mayorc=0;
		 $menorc=0;
	   $msje=' ';
	   $fech[]=array();
	    $idcondoc[]=array();
		$diascon[]=array();
       while($condu=mysql_fetch_array($resultado)){
	   $fvence=$condu['fecha_vence'];
	    $fech[]=$condu['fecha_vence'];
	   $document=$condu['documento'];
	   $idcondoc[]=$condu['id_doc'];
	   $i++;
	   ///////calcular cual de las fechas es la menor de todas y a cual documento pertenece
	 
	 
	   
	   if($fvence<$fecha){
	    $novedad=1;
		$msje=$msje.$document.' -- ';
	   $error="<div class='ui-state-error' id='mensaje2' >
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 5px 0;'></span>
		Vencido
	  </div>";
	  
?>		


<?php 
} else{
 $error="";
}
?>	
         <tr class="ui-widget-content">
		<td width="45" class="ui-widget-content"><?php echo $condu['id_doc'] ?>
		  <input type="hidden" name="idcondoc<?php echo $i?>" value="<?php echo $condu['id_doc'];?>" /></td>
		<td width="206" class="ui-widget-content"><?php echo $condu['documento'] ?></td>
		<td width="206" class="ui-widget-content"><?php echo $condu['numero'] ?></td>
		<td width="206" class="ui-widget-content"><?php echo $condu['eps'] ?></td>
		<td width="124" class="ui-widget-content"><?php echo $condu['fecha_vence']; ?>
		  <input type="hidden" name="fdocs<?php echo $i?>" value="<?php echo $condu['fecha_vence'];?>" /><input type="hidden" name="ndoc" value="<?php echo $i;?>" /></td>
	
		<?php 
		if($novedad==1){

?>		
		<td width="92" class="ui-widget-content">
		<?php echo $error ?>		</td>
		 </tr>
<?php 
}
} 

if($novedad==1){
echo $modal="
<div class='ui-state-error' id='mensaje' title='Documento Vencido'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Debe Actualizar $msje </div><script language='javascript'>document.getElementById('grabaimp').disabled=true;jQuery('#mensaje').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');	}}});</script>";

}

   for($x=1;$x<=$ndoc;$x++){
		 	  ///se recibe la matriz de documnetos
			 $fcdocs= $fech[$x];
			 //calculo de dias comparados con la fecha actual
			$diascon[]=calcdia($fecha,$fcdocs);  
			sort($diascon);
			$menorc = $diascon[0];
				
			}//fin for x
		 for($a=1;$a<=$ndoc;$a++){
				$fcondocs= $fech[$a];
				$idcdocs= $idcondoc[$a];
				 $diasdif=calcdia($fecha,$fcondocs);
					 if($diasdif==$menorc){
						 
						 $menorcondoc=$fcondocs;
						 $idcd=$idcdocs;
						 }  
			 }//fin for a
?>		
<input type="hidden" name="mfechcon" id="mfechcon" value="<?php echo $menorcondoc;?>" />	
<input type="hidden" name="dfechcon" id="dfechcon" value="<?php echo $idcd;?>" />	
</table>