 <?php
        
		include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
		$link=conectarse();
        $id_cond=$_REQUEST['condu'];
	    $id_doc=$_REQUEST['docu']; 
	    $id_condoc=$_REQUEST['con_doc'];
	    $fechact=date("Y-m-d h:i:s");
	  $consulta = "select * from conductor a inner join (con_doc b inner join documento c on b.id_doc=c.id_doc)  on a.id_conductor=b.id_conductor where a.id_conductor=$id_cond and b.id_doc=$id_doc";
       $resultado=mysql_query($consulta);
        $condu=mysql_fetch_array($resultado);
        ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
 
	<script  src="../inc/prototype.js"></script>
	<script  src="../inc/funciones.js"></script>
	 <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	
    
	<script src="../src/jqDnR.js" type="text/javascript"></script>
	
	<script src="../src/jqModal.js" type="text/javascript"></script>
		<script src="../themes/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../themes/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="../themes/development-bundle/ui/jquery.ui.datepicker.js"></script>  
	<script>
	jQuery(function() {
		jQuery( "#date" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,
			dateFormat:'yy-mm-dd',
		});
	});
	</script> 
 <script src="../js/i18n/grid.locale-es.js" type="text/javascript"></script>
<script src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>
	
    <script src="../themes/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	 <link rel="stylesheet" type="text/css" href="../themes/css/custom-theme/jquery-ui-1.8.16.custom.css">
	<link rel="stylesheet" type="text/css" href="../css/ui.jqgrid.css">
	
    <link rel="stylesheet" type="text/css" media="screen" href="../themes/ui.multiselect.css" /> 
   	<link rel="stylesheet" type="text/css" href="../themes/development-bundle/themes/custom-theme/jquery.ui.all.css"> 
    <link rel="stylesheet" type="text/css" media="screen" href="../themes/ui.multiselect.css" /> 
   <link rel="stylesheet" type="text/css" href="../plugins/ui.multiselect.css">  
   </head>
<body>   
 <table width="535" border="1" align="left" cellpadding="1" class="ui-corner-all" >
  <tr>
    <td width="527" class="ui-jqgrid-titlebar ui-widget-header ui-corner-top ui-helper-clearfix "><table width="100%" border="1" align="center" cellpadding="1" class="ui-corner-all">
      <tr >
        <td width="10%">C&oacute;digo</td>
        <td width="34%">Nombres</td>
        <td width="38%">Documento</td>
        <td width="18%" >Act.Doc # </td>
      </tr>
      <tr class="subgrid-data">
        <td class="ui-widget-content"><?php echo $condu['codigo']  ?></td>
        <td class="ui-widget-content"><?php echo $condu['nombre1'].' '.$condu['nombre2'].' '.$condu['apellido1'].' '.$condu['apellido2']  ?></td>
        <td class="ui-widget-content"><?php echo $condu['documento']  ?></td>
        <td class="ui-widget-content"><div align="center"><?php $conse="select max(id_act) as num from actual_doc";
		          $resconse=mysql_query($conse);
				  $fila=mysql_fetch_array($resconse);
				  
				  echo $fila['num']+1;
		    ?>		  
		  </div></td>
      </tr>

    </table></td>
  </tr>
   <tr>
    <td ><table width="455" border="1" align="center" cellpadding="1" class="ui-corner-all">
      <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top  ">
        <td width="194" colspan="2">N&uacute;mero Recibo</td>
        <td width="90">Categoria</td>
	
      </tr>
      <tr>
        <td class="ui-widget-content" colspan="2"><input type="text" id="nrecib" value="<?php echo $condu['numero']  ?>" /><input type="hidden" id="id_cond" value="<?php echo $id_cond  ?>" /></td>
        <td class="ui-widget-content"><input type="text" id="cat" value="<?php if($condu['categoria']==" "){echo $n=1;}else{ echo $condu['categoria']; } ?>"  size="15"></td>
		
      </tr>
    </table></td>
  </tr>
  
  
  <tr>
    <td ><table width="455" border="1" align="center" cellpadding="1" class="ui-corner-all">
      <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top  ">
        <td width="194">Fecha Anterior </td>
        <td width="90">Fecha Nueva </td>
		<?php if($id_doc!=1) {?>
        <td width="149">Entidad</td>
		 <?php
				  }
		 ?>
      </tr>
      <tr>
        <td class="ui-widget-content"><?php echo $condu['fecha_vence']  ?><input type="hidden" id="fant" value="<?php echo $condu['fecha_vence']  ?>" /><input type="hidden" id="id_cond" value="<?php echo $id_cond  ?>" /><input type="hidden" id="id_doc" value="<?php echo $id_doc  ?>" /><input type="hidden" id="id_condoc" value="<?php echo $id_condoc  ?>" /></td>
        <td class="ui-widget-content"><input type="text" id="date" size="15"></td>
		
		<?php if($id_doc!=1) {?>
        <td class="ui-widget-content"><select name="eps" id="eps" class="ui-widget-content ui-corner-all" >
		<option value="">Seleccione Entidad </option>
		<?php $sql="select * from entidad_salud";
		          $query=mysql_query($sql);
				  while($row=mysql_fetch_array($query)){
				  ?>
				  <option value="<?php echo $row['id_eps']?>" ><?php echo $row['eps']?></option>
				  
				  <?php
				  }
		 ?></select>		 </td>
		  <?php
				  }else{
				   ?>
				  <input type="hidden" id="eps" value="<?php echo "1"  ?>" />
				  
				   <?php
				  }
		 ?>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="300" border="0" align="center" cellpadding="0">
      <tr>
        <td><div align="center">
          <input  type="button" class="ui-icon-plus" id="grabact"  value="Grabar" onclick="valida();" />
        </div></td>
        <td><div align="center">
          <input  type="button" id="trigger" name="trigger" value="Cancelar" onClick="javascript:jQuery('#actualiza').dialog( 'close' );" />
        </div></td>
        <td><div align="center">
          <input  type="button" id="trigger2" name="trigger2" value="Cerrar" onclick="javascript:jQuery('#actualiza').dialog( 'close' );" />
        </div></td>
      </tr>
    </table></td>
  </tr>
</table>



<div id="graba"></div>
