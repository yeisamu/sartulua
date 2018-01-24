<?php
session_start();
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
include('../inc/operaciones.php');
		$link=conectarse();
?>	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Nueva Tarjete de Control</title>
 <script  src="../inc/prototype.js"></script>
	<script  src="../inc/funciones.js"></script>
    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	
    <script src="../js/i18n/grid.locale-es.js" type="text/javascript"></script>
	<script src="../src/jqDnR.js" type="text/javascript"></script>
	
	<script src="../src/jqModal.js" type="text/javascript"></script>
		<!--<script src="../themes/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../themes/development-bundle/ui/jquery.ui.widget.js"></script>--> 
	<script src="../themes/development-bundle/ui/jquery.ui.datepicker.js"></script> 
	<script src="../themes/development-bundle/ui/jquery.ui.dialog.js"></script> 	
    </script>

    <script src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>
	
    <script src="../themes/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	 <link rel="stylesheet" type="text/css" href="../themes/css/custom-theme/jquery-ui-1.8.16.custom.css">
	<link rel="stylesheet" type="text/css" href="../css/ui.jqgrid.css">
	
   <!-- <link rel="stylesheet" type="text/css" media="screen" href="../themes/ui.multiselect.css" /> -->
   	<!--<link rel="stylesheet" type="text/css" href="../themes/development-bundle/themes/custom-theme/jquery.ui.all.css"> -->
    <!--<link rel="stylesheet" type="text/css" media="screen" href="../themes/ui.multiselect.css" /> -->
   <link rel="stylesheet" type="text/css" href="../plugins/ui.multiselect.css">
</head>

<body >		



<?php
		
 $login=$_SESSION['login'];
 $fechact=deme_now();
 //date("Y-m-d h:i:s");
 $hoy=date('Y-m-d');
// $n = $_REQUEST['nvdoc'];
// $ndoc = $_REQUEST['ndoc'];
 //$fdiarios=$_REQUEST['diariosv'];
 $ntarjeta=$_REQUEST['tarjeta'];
 $id_cond=$_REQUEST['id_cond'];
 $id_movil=$_REQUEST['movil'];
 $id_empre=$_REQUEST['empresa'];
 $id_planilla=$_REQUEST['id_planilla'];
 
 
 $fdiarios=$_REQUEST['fechdiario'];
 $fcond=$_REQUEST['fcond'];
 $fvehi=$_REQUEST['fvehi'];
 $dfechcon=$_REQUEST['dfechcon'];
 $dfechveh=$_REQUEST['dfechveh'];

 $query=mysql_query("select * from documento where id_doc=".$dfechcon);
 $rowcond=mysql_fetch_array($query);

 $queryv=mysql_query("select * from documentos_v where id_docv=".$dfechveh);
 $rowv=mysql_fetch_array($queryv);
 
 $elemento = 0;
 $mayor=0;
 $menor=0;
 $elementoc = 0;
 $mayorc=0;
 $menorc=0;
	/////calculo de los fechas a dias teniendo en cuenta como base el dia actual
	
	
		 $diasdifc=calcdia($hoy,$fcond);
		 $diasdifv=calcdia($hoy,$fvehi);
		 $diasdifd=calcdia($hoy,$fdiarios);
	////////se busca cual es la menor fecha de todos los documentos para tenerla como referencia en la vigencia de la tarjeta de control
		  if( $diasdifc< $diasdifv){
	        if( $diasdifc<$diasdifd){
	         	$fecha_vence=$fcond;
		 		$id_doc=$dfechcon;
		 		$mot=$rowcond['documento'];
	        }else{
	         	 $idiario=22;
			   	 $fecha_vence=$fdiarios;
				 $id_doc=$idiario;
				 $mot="diarios Vehiculo";

				 }
	    }else{
	        if( $diasdifv<$diasdifd){
	            $fecha_vence=$fvehi;
				 $id_doc=$dfechveh;
				 $mot=$rowcond['descripcion'];
	        }else{
            $idiario=22;
			$fecha_vence=$fdiarios;
		 	$id_doc=$idiario;
		 	$mot="diarios Vehiculo";
			}
	}
		
		 $id_estado=1;
		 $id_tran=1;
	 
		 
		 $fecha_corte=aumenta_dias($fecha_vence,1);
		 
echo $insertat="insert into `tarjeta_control` (`tarjeta`, `id_conductor`, `id_movil`, `id_empresa`, `fecha_vigencia`, `fecha_elab`,fecha_plazo_a ,`id_doc_ref`, `planilla`, `estado`,est_ant) values ('$ntarjeta','$id_cond','$id_movil','$id_empre','$fecha_vence','$hoy','$fecha_corte','$id_doc','$id_planilla','$id_estado',0)";
	$sqltar=mysql_query($insertat);
	 $ntarj=mysql_insert_id();
 echo $conve="insert into `detalle_tarjeta`  (`id_tarjeta`, `id_doc`, `documento`, `categoria`,`fecha_vence`, `numero_doc`, `tipo_doc`) SELECT  LAST_INSERT_ID(),b.`id_documento`,b.descripcion,'0',a.fecha_ven,a.numero,'V' FROM `veh_doc` a inner join documentos_v b on a.`id_documento`= b.`id_documento` WHERE `id_movil`= '$id_movil' ";
$resve=mysql_query($conve);		
echo $concon="insert into `detalle_tarjeta`  (`id_tarjeta`, `id_doc`, `documento`, `categoria`,`fecha_vence`, `numero_doc`, `tipo_doc`)	
SELECT  LAST_INSERT_ID(),b.`id_doc`,b.documento,a.categoria,a.fecha_vence,a.numero,'C' FROM `con_doc` a inner join documento b on a.`id_doc`= b.`id_doc` WHERE `id_conductor`= '$id_cond' ";	
$rescon=mysql_query($concon);	

	echo $insertcomp="insert into `comprobante` (fecha_ante,`fecha_nu`, `id_conductor`, `usuario`, `fecha_alavo`, `id_comprobante`, `id_tran`,observaciones) values ('$fecha_vence','$fecha_vence','$id_cond','$login','$fechact',LAST_INSERT_ID(),'$id_tran','$mot') ";
	$sqlcomp=mysql_query($insertcomp);
	if(!$sqlcomp || !$sqltar || !$rescon || !$resve){
	echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Error al grabar los datos </div><script language='javascript'>document.getElementById('grabaimp').disabled=true;jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');	}}});</script>";

	}else{
	?>
	
<div class='ui-state-error' id='errorgraba' title='Grabar Tarjeta de Control'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Tarjeta de control Nº <?php echo $ntarjeta ?>  Grabada con exito </div><script language='javascript'>
	   function imprimir() {
	    var codigotarjeta=<?php echo $ntarj ?>;
		//codigotarjeta=codigotarjeta.toString(8);
		//alert(codigotarjeta);
			//window.open('../fpdf/imprime_mariscal.php?ntarjeta='+codigotarjeta,'miwin','width=700,height=500,scrollbars=yes');
			window.open('../../diarios/sart.php/sistemasart/pdf?ntarjeta='+codigotarjeta,'miwin','width=700,height=500,scrollbars=yes');
		}
		jQuery('#crudtc').jqGrid('setCaption','Detalle de tarjetas de control') .trigger('reloadGrid');
	   document.getElementById('grabaimp').disabled=true;jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');jQuery('#ntarjetao').dialog( 'close' );imprimir()	}}});</script>";
	
	<?php
	}	
		?>		

</body>
</html>