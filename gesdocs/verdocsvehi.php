<table width="500" border="0" align="center" cellspacing="5">
      <tr class="ui-widget-header" >
       <!-- <td width="65"><div align="center" >id</div></td> -->
        <td width="45"><div align="center" >C&oacute;digo</div></td>
        <td width="165"><div align="center" >Documento</div></td>
		<td width="90"><div align="center">N&uacute;mero</div></td>
        <td width="124"><div align="center" >Fecha Vigencia </div></td>
      </tr>
      
	 


<?php
   
		include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
		include('../inc/operaciones.php');
		$link=conectarse();
		$fecha=date('Y-m-d h:i');
        $id_movil=$_REQUEST['id_movil'];
	  $consulta = "SELECT * FROM `veh_doc` a INNER JOIN documentos_v b ON a.`id_documento` = b.`id_documento`
WHERE `id_movil` ='$id_movil'";
       $resultado=mysql_query($consulta);
	      $ndoc=mysql_num_rows($resultado);
	   $error="";
	   $i=0;
	   $novedad=0;
	   $msje=' ';
	   $fech[]=array();
	    $idcondoc[]=array();
		$diascon[]=array();
		 $elementoc = 0;
		 $mayorc=0;
		 $menorc=0;
       while($condu=mysql_fetch_array($resultado)){
	   $i++;
	   $fvence=$condu['fecha_ven']." 11:59:59";;
	    $document=$condu['descripcion'];
		 $fech[]=$condu['fecha_ven'];
	    $idcondoc[]=$condu['id_documento'];
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
        <tr >
		<td width="45" class="ui-widget-content"><?php echo $condu['id_documento'] ?>
		  <input type="hidden" name="idvdoc<?php echo $i?>" value="<?php echo $condu['id_documento'];?>" /></td>
		<td width="165" class="ui-widget-content"><?php echo $condu['descripcion'] ?></td>
		<td width="90" class="ui-widget-content"><?php echo $condu['numero'] ?></td>
		<td width="124" class="ui-widget-content"><?php echo $condu['fecha_ven']; ?>
		  <input type="hidden" name="vdocs<?php echo $i?>" value="<?php echo $condu['fecha_ven'];?>" /><input type="hidden" name="nvdoc" value="<?php echo $i;?>" /></td>
		<?php 
		if($novedad==1){

?>		
		<td width="36" class="ui-widget-content">
		<?php echo $error ?>		</td>
  </tr>
<?php 
}
} 

if($novedad==1){
echo $modal="
<div class='ui-state-error' id='mensaje' title='Documento Vencido'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Debe Actualizar $msje antes de continuar  </div><script language='javascript'>document.getElementById('grabaimp').disabled=true;jQuery('#mensaje').dialog({modal: true,buttons: {Ok: function() {
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
<input type="hidden" name="mfechveh" id="mfechveh" value="<?php echo $menorcondoc;?>" />	
<input type="hidden" name="dfechveh" id="dfechveh" value="<?php echo $idcd;?>" />	

 
    </table>