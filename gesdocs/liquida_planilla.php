<?php
session_start();
 include('../inc/libreria.php');
 include('../inc/operaciones.php');
  $link=conectarse();
  $id_planilla=$_REQUEST['idplanilla'];
 // $i=$_REQUEST['id'];
/* if(!valida_usr(11)){
 
 echo "Acceso No Autorizado";
 return ;
 }*/
 
$borrar=mysql_query("update `reporte_planilla` set liquidado=1 where id_planilla=$id_planilla");
$consulta=mysql_query("update `planilla` set liquidado=1 where id_planilla=$id_planilla");
//$num=mysql_num_rows($consulta);
    

if(!$borrar || !$consulta){
		echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Error al grabar los datos </div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');}}});</script>";

	}else{
	?>
	
<div class='ui-state-error' id='errorgraba' title='Liquidar  Planilla'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Planilla Liquidada con exito </div><script language='javascript'>
	  		//jQuery('#crudtc').jqGrid('setCaption','Detalle de tarjetas de control') .trigger('reloadGrid');
	   //document.getElementById('grabaimp').disabled=true;
	 //  var i="<?php echo $i?>";
	   jQuery('#crudnov').trigger('reloadGrid');
	   jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');}}});</script>
	
	<?php
	}	
		?>	
