<?php
session_start();
include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexi�n a la db
include('../inc/operaciones.php');
		$link=conectarse();
		
		 $login=$_SESSION['login'];
 $fechact=date("Y-m-d h:i:s");
 //$hoy=date('Y-m-d');
// $n = $_REQUEST['nvdoc'];
 $ndoc = $_REQUEST['doc_cond'];
 $idtarjeta=$_REQUEST['idtarjeta'];
 $nplanilla=$_REQUEST['nplanilla'];
 $tarjeta=$_REQUEST['tarjeta'];
 $corigen=$_REQUEST['corigen'];
 $forigen=$_REQUEST['forigen'];
 $cdestino=$_REQUEST['cdestino'];
 
 $id_tran=4;
 $fdestino=$_REQUEST['fdestino'];
 $contra=$_REQUEST['contra'];
 $doc=$_REQUEST['doc'];
$nid=$_REQUEST['nid'];
$dircontra=$_REQUEST['dircontra'];
$telcontra=$_REQUEST['telcontra'];
$npasajero=$_REQUEST['npasajero'];
$compa=$_REQUEST['compa'];
 $f_plazo=sig_dia_habil($forigen);
 $estado=1;
 $selnp=("select * from reporte_planilla where n_planilla=$nplanilla and estado=0");
//echo "update `reporte_planilla` set `fecha`='$fecha_elab', `id_planilla`=$id_panilla, `id_movil`='$id_movil',  `id_conductor`='$id_conductor', `codigo`='$codigo', `nombre_con`='$nombre', `destino`='$ciudad_d', `elab`='$usr_elab', `recibido`='$usr_rec', `estado`=$estado, `observaciones`='$obs', `liquidado`=$liquidado where n_planilla= $nplanilla";
 $selnp=mysql_query("select * from reporte_planilla where n_planilla=$nplanilla and estado=0");
  $nresp=mysql_num_rows($selnp);
 if($nresp>0){
  $insertcomp="insert into `planilla` (`n_planilla`, `fecha_elaboracion`, `id_tarjeta`, `tarjeta`, `ciudad_o`, `fecha_inicio`, `ciudad_d`, `fecha_retorno`, `contra`, `tipo_doc`, `doc`, `dircontra`, `telcontra`, `npasajero`,`compania`,`estado`, `fecha_plazo_e`,`usr_elab`,est_ant) values ('$nplanilla','$fechact','$idtarjeta','$tarjeta','$corigen','$forigen','$cdestino','$fdestino','$contra',
'$doc','$nid','$dircontra','$telcontra','$npasajero','$compa','$estado','$f_plazo','$login',0) ";
//echo "select * from planilla inner join (tarjeta_control inner join conductor on tarjeta_control.id_conductor=conductor.id_conductor) on planilla.id_tarjeta=tarjeta_control.id_tarjeta where n_planilla=$nplanilla";
	$sqlcomp=mysql_query($insertcomp);
	
	
	$veri=mysql_query("select * from planilla inner join (tarjeta_control inner join conductor on tarjeta_control.id_conductor=conductor.id_conductor) on planilla.id_tarjeta=tarjeta_control.id_tarjeta where n_planilla=$nplanilla");
	 $fila=mysql_fetch_array($veri);
      $id_panilla=$fila['id_planilla'];
	   $n_panilla=$fila['n_planilla'];
	  $id_movil=$fila['id_movil'];
	  $id_conductor=$fila['id_conductor'];
	  $codigo=$fila['codigo'];
	  $nombre=$fila['nombre1'].' '.$fila['nombre2'].' '.$fila['apellido1'].' '.$fila['apellido2'];
	  $ciudad_d=$fila['ciudad_d'];
	  $usr_elab=$fila['usr_elab'];
	  $usr_rec=$fila['usr_rec'];
	  $liquidado=$fila['liquidado'];
	  $estado=$fila['estado'];
	   $obs=$fila['observaciones'];
	   $fecha_elab=$fila['fecha_elaboracion']; 
	  //echo $consu="insert into reporte_planilla (`fecha`, `id_planilla`, `n_planilla`, `id_movil`, `grupo`, `id_conductor`, `codigo`, `nombre_con`, `destino`, `elab`, `recibido`, `estado`, `liquidado`)values ('$fecha_elab',$id_panilla,$i,'$id_movil','$id_grupo',$id_conductor,'$codigo','$nombre','$ciudad_d','$usr_elab', '$usr_rec',$estado,$liquidado) ";
	 $tot_registro=mysql_num_rows($veri);
	 //  if($tot_registro>0){	   
	  //$dato=mysql_query("insert into reporte_planilla (`fecha`, `id_planilla`,  `id_movil`, `grupo`, `id_conductor`, `codigo`, `nombre_con`, `destino`, `elab`, `recibido`, `estado`,observaciones, `liquidado`)values ('$fecha_elab',$id_panilla,'$id_movil','$id_grupo',$id_conductor,'$codigo','$nombre','$ciudad_d','$usr_elab', '$usr_rec',$estado,'$obs',$liquidado) ");
	  
	 $dato=mysql_query("update `reporte_planilla` set `fecha`='$fecha_elab', `id_planilla`=$id_panilla, `id_movil`='$id_movil',  `id_conductor`='$id_conductor', `codigo`='$codigo', `nombre_con`='$nombre', `destino`='$ciudad_d', `elab`='$usr_elab', `recibido`='$usr_rec', `estado`=$estado, `observaciones`='$obs', `liquidado`=$liquidado where n_planilla= $nplanilla");
	
	
	
	$insertcomp="insert into `comprobante` (fecha_ante,`fecha_nu`, `id_conductor`, `usuario`, `fecha_alavo`, `id_comprobante`, `id_tran`) values ('$forigen','$fdestino','$ndoc','$login','$fechact',LAST_INSERT_ID(),'$id_tran') ";
	$sqlcomp=mysql_query($insertcomp);
	}else{
		$sqlcomp=false;
		$dato=false;

	}
	if(!$sqlcomp || !$dato ){
		echo $modal="
<div class='ui-state-error' id='errorgraba' title='Error en consulta'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Error al grabar los datos es posible que el numero de planilla no corresponda </div><script language='javascript'>jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');	}}});</script>";

	}else{
	?>
	
<div class='ui-state-error' id='errorgraba' title='Grabar Planilla'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Planilla Grabada con exito </div>
<form  action="../fpdf/imprime_planilla.php" method="post" target="_blank" id="fplanilla">
	   <input type="hidden" value="<?php echo $id_panilla ?>" name="planilla" id="planilla" />
	   <input type="hidden" value="<?php echo $idtarjeta ?>" name="id_tarj" id="id_tarj" />
	   </form>	   
<script language='javascript'>
	  		//jQuery('#crudtc').jqGrid('setCaption','Detalle de tarjetas de control') .trigger('reloadGrid');
	   //document.getElementById('grabaimp').disabled=true;
	   jQuery('#crudtc').trigger('reloadGrid');
	   jQuery('#crudplan').trigger('reloadGrid');jQuery('#crudplancon').trigger('reloadGrid');
	   jQuery('#errorgraba').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');jQuery('#planillas').dialog( 'close' );jQuery('#autoriza_planilla').dialog( 'close' );document.getElementById('fplanilla').submit();}}});</script>
	
	<?php
	}	
		?>	
