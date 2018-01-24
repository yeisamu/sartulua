<?php
include('../inc/libreria.php');
$link=conectarse();
$in =$_REQUEST['ini'];
$fin =$_REQUEST['fin'];
$id_grupo =$_REQUEST['grupo'];
$ngrupo =$_REQUEST['ngrupo'];
echo "select count(*) as np from reporte_planilla where n_planilla between $in and  $fin ";
$busca_rango=mysql_query("select count(*) as np from reporte_planilla where n_planilla between $in and  $fin ");
$filap=mysql_fetch_array($busca_rango);
//if($filap['np']>0){
 //$inserta=false;
//}else{
for($i=$in;$i<=$fin;$i++){
//echo $inserta="insert into  `reporte_planilla` (`n_planilla`,grupo) values ('$i','$id_grupo')";
$inserta=mysql_query("insert into  `reporte_planilla` (`n_planilla`,grupo) values ('$i','$id_grupo')");

//}
}

if(!$inserta){
		echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Rango de planillas ya esta asignado </div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');	}}});</script>";

	}else{
	?>
	
<div class='ui-state-error' id='errorgraba' title='Grabar Planilla'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Rango de Planillas Registrado con exito </div><script language='javascript'>
	  		//jQuery('#crudtc').jqGrid('setCaption','Detalle de tarjetas de control') .trigger('reloadGrid');
	   //document.getElementById('grabaimp').disabled=true;
	  // jQuery('#crudtc').trigger('reloadGrid');
	  // jQuery('#crudplan').trigger('reloadGrid');jQuery('#crudplancon').trigger('reloadGrid');
	   jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');jQuery("#rangos").slideUp();
					var num=<?php echo $ngrupo?>; 
					for(i=1;i<=num;i++){
					jQuery('#crudnov'+i).trigger('reloadGrid');
					}
					//jQuery('#planillas').dialog( 'close' );jQuery('#autoriza_planilla').dialog( 'close' );
					}}});</script>
	
	<?php
	}		
	?>
