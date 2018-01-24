<?php
session_start();
date_default_timezone_set ('America/Bogota');
//date_default_timezone_set('UTC');  
$login=$_SESSION['login'];
include('../inc/libreria.php');
$link=conectarse();
//$cadena =$_REQUEST['id_cond'];
$id_tarjeta =$_REQUEST['idtarj'];
//$idvehi =$_REQUEST['id_movil'];
/*$items[] = array();
$itemsveh[] = array();
$select = mysql_query("SELECT * FROM conductor where id_conductor ='$cadena'");
$fila=mysql_fetch_array($select);
$num=mysql_num_rows($select);
$items=array("label"=>$fila["codigo"],"value"=>$fila["codigo"],"nombre" =>$fila["nombre1"].'  '.$fila["nombre2"],"apellidos" =>$fila["apellido1"].' '.$fila["apellido2"],"id_con"=>$fila["id_conductor"],"rh"=>$fila["tipo_rh"],"direccion" => $fila["direccion"],"tele" => $fila["telefono"],"acu" => $fila["acudiente"],"telea" => $fila["telefonoa"],"cel" => $fila["celulara"]);

$selectveh = mysql_query("select * from vehiculo where id_movil like '%$cadena%'");
$filaveh=mysql_fetch_array($selectveh);
$items,array("id"=>$i,"label"=>$filaveh["id_movil"].'-'.$filaveh["placa"],"value"=>$filaveh["id_movil"],"placa" => $filaveh["placa"],"marca" => $filaveh["referencia"],"modelo" => $filaveh["modelo"],"vigencia" => $filaveh["pago_hasta"], )*/
$selectar = mysql_query("SELECT * FROM ((tarjeta_control a inner join (vehiculo d inner join marca e on d.id_marca=e.id_marca) on a.id_movil=d.id_movil) inner join empresa c on a.id_empresa=c.id_empresa) inner join conductor b on a.id_conductor=b.id_conductor where id_tarjeta =$id_tarjeta");
$filatar=mysql_fetch_array($selectar);



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
	<script src="../themes/ejemplo/ui/jquery.ui.datepicker.js"></script> 
	<script src="../themes/ejemplo/ui/jquery.ui.dialog.js"></script> 
	
	    <script type="text/javascript">
  /*  $.jgrid.no_legacy_api = true;
    $.jgrid.useJSON = true;*/
     jQuery.noConflict();

	jQuery(document).ready(function(){ 
	////funcion de autocompletar el conductor
	//jQuery("#cedula").autocomplete({
			/*source: "buscacon.php",
			// select: function(event, ui) {
            jQuery('#nombrecon').html(ui.item.nombre);
			jQuery('#apellidoscon').html(ui.item.apellidos);
			jQuery('#telcon').html(ui.item.tele);
			jQuery('#direcon').html(ui.item.direccion);
			jQuery('#rh').html(ui.item.rh);
			jQuery('#nombrea').html(ui.item.acu);
			jQuery('#telefonoa').html(ui.item.telea);
			jQuery('#celulara').html(ui.item.cel);
			id_con(ui.item.id_con);*/
			
		//	verdocs('condocs');
			//verdocsmovil('vehidocs')	
       // }
	//	});
		
	fdiario(document.getElementById('fvencediario').value); 
		/////funcion para autocompletar el movil
		jQuery("#movil").autocomplete({
		    source: "selecmovil.php",
			select: function(event, ui) {
           	jQuery('#placa').html(ui.item.placa);
			jQuery('#marca').html(ui.item.marca);
			jQuery('#modelo').html(ui.item.modelo);
			jQuery('#vigencia').html(ui.item.vigencia);  
			
			diario(ui.item.vigencia);   
			verdocsmovil('vehidocs');
			 
				  
				  
				  }
			});
		////funcion que pasa el valor de la consulta a la caja de texto con id id_cond
		
		
		function id_con(thisValue) {
		jQuery('#id_cond').val(thisValue);
		}
		function diario(thisValue) {
		jQuery('#diariosv').val(thisValue);
		
		}
		////funcion que permite verificar si los diarios estan cancelados al dia de lo contrario muestra alert
		function fdiario(thisValue) {
		var fecha=thisValue;
		var fhoy="<?php echo  $fdiarios=date('Y-m-d h:i')?>";
		//alert(fecha+'-'+fhoy)
		if(fecha<=fhoy){
		
		var valor="Fecha";
		document.getElementById('grabaimp').disabled=true;
		////crear div
		var newdiv = document.createElement('div');
		var id='mensaje1';
   newdiv.setAttribute('id', id);
   newdiv.setAttribute('class', 'ui-state-error');
   newdiv.setAttribute('title', 'Documento vencido');
   newdiv.innerHTML = "Vigencia de diarios Vencido";
   document.body.appendChild(newdiv);
   
   
   var diverror = document.createElement('div');
   var id3='mensaje3';
   diverror.setAttribute('id', id3);
   diverror.setAttribute('class', 'ui-state-error');
   diverror.innerHTML = "Vencido";
   document.getElementById("idiario").appendChild(diverror);
 ///mostrar div
	   jQuery('#mensaje1').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');	}}})
		}else {
		jQuery("#mensaje3").hide();
		document.getElementById('grabaimp').disabled=false;
		}
		}
	//////funcion de mensaje de alerta
	
	
	
	
	
	
	
	//jQuery( "#dialog:ui-dialog" ).dialog( "destroy" );
	//funcion para el llenado de datos de la empresa
	
	/*function displayVals() {
      var singleValues = jQuery("#empresa").val();
	   jQuery("#nits").html(singleValues);
	  // alert(singleValues)

}*/

/* jQuery("select").change();
  var idemp = jQuery("#empresa").val();
 source: "buscaemp.php?id_emp="+idemp,
			 select: function(ui) {
			  jQuery('#nits').html(ui.item.nit);
    displayVals();

	}	*/
	
	
	
	jQuery('#tarjeta').focus();
	 });
    </script>

    <script src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>
	
    <script src="../themes/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	 <link rel="stylesheet" type="text/css" href="../themes/css/custom-theme/jquery-ui-1.8.16.custom.css">
	<link rel="stylesheet" type="text/css" href="../css/ui.jqgrid.css">
   <link rel="stylesheet" type="text/css" href="../plugins/ui.multiselect.css">
</head>

<body >
<!--<form name="tarjetac" id="tarjetac" method="post" action="grabatarjeta.php"> -->
<table width="500" border="1" align="center" cellspacing="5" class=" ui-corner-all  ">
  
  <tr>
    <td  class="titulos ui-corner-all" ><div align="center">Datos Personales del Conductor </div></td>
  </tr>
  <tr>
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="655" border="0" align="center" cellspacing="5">
      <tr class="ui-widget-header" >
        <td width="78" rowspan="4" ><img src="../fotos/<?php echo $filatar['codigo'];?>.jpg" width="104" height="120"  /></td>
        <td width="218" ><div align="center" >Documento</div></td>
        <td width="141"><div align="center" ><span >Nombres</span></div></td>
        <td width="185"><div align="center" ><span >Apellidos</span></div></td>
      </tr>
      <tr class="ui-widget-header">
        <td class="ui-widget-content"><div align="center"><?php echo $filatar['codigo'];?><input type="hidden" id="id_cond" name="id_cond" class="ui-widget-content ui-corner-all"  value="<?php echo $filatar['id_conductor']?>" /></div></td>
        <td class="ui-widget-content" id="nombrecon"><div align="left"><?php echo $filatar['nombre1'].'  '.$filatar['nombre2'];?></div></td>
        <td class="ui-widget-content" id="apellidoscon"><div align="left"><?php echo $filatar['apellido1'].' '.$filatar['apellido2'];?></div></td>
      </tr>
      <tr class="ui-widget-header">
        <td ><div align="center" class="Estilo3"><span >Grupo Sang. </span></div></td>
        <td><div align="center" class="Estilo3"><span >Tel&eacute;fono</span></div></td>
        <td><div align="center" class="Estilo3"><span >Direcci&oacute;n</span></div></td>
      </tr>
      <tr>
        <td class="ui-widget-content" id="rh"> <?php echo $filatar['tipo_rh'];?></td>
        <td class="ui-widget-content" id="telcon"><?php echo $filatar['telefono'];?></td>
        <td class="ui-widget-content" id="direcon"><?php echo $filatar['direccion'];?></td>
      </tr>
    </table></td>
  </tr>
  <!--<tr>
    <td class="titulos ui-corner-all"><div align="center" >Documentos del Conductor </div></td>
  </tr> -->
  <tr>
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="491" border="0" align="center" cellspacing="5">
      <tr class="ui-widget-header" >
       <!-- <td width="62" ><div align="center" class="Estilo3"><span class="Estilo1">id</span></div></td> -->
        <td width="53"><div align="center" class="Estilo3"><span >C&oacute;digo</span></div></td>
        <td width="160"><div align="center" class="Estilo3"><span >Documento</span></div></td>
		<td width="160"><div align="center" class="Estilo3"><span >N&uacute;mero</span></div></td>
		<td width="160"><div align="center" class="Estilo3"><span >Entidad</span></div></td>
		 <td width="89"><div align="center" class="Estilo3"><span >Fecha Reg </span></div></td>
        <td width="105"><div align="center" class="Estilo3"><span >Fecha Vigencia </span></div></td>
      </tr>
     <tr >
	<!-- <td colspan="3">
	 <table width="500" border="0" align="center" > -->

<?php
	//	include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
		include('../inc/operaciones.php');
		//$link=conectarse();
		$fechai=mysql_query('select now() as fecha');
		$datofe=mysql_fetch_array($fechai);
		$fecha=$datofe['fecha'];
		//date('Y-m-d H:i:s');
        $id_cond=$filatar['id_conductor'];
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
	   $fvenc=$condu['fecha_vence'];
	   $tipod=$condu['id_doc'];
            if($tipod==22){
	   $fvence=$fvenc;
            }else{
            $fvence=aumenta_dias($fvenc,1);
            }
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
		<td width="53" class="ui-widget-content"><?php echo $condu['id_doc'] ?>
		  <input type="hidden" name="idcondoc<?php echo $i?>" value="<?php echo $condu['id_doc'];?>" /></td>
		<td width="160" class="ui-widget-content"><?php echo $condu['documento'] ?></td>
		<td width="160" class="ui-widget-content"><?php echo $condu['numero'] ?></td>
		<td width="160" class="ui-widget-content"><?php echo $condu['eps'] ?></td>
		<td width="89" class="ui-widget-content"><?php echo deme_f_detallecon($id_tarjeta,$condu['id_doc']); ?></td>
		
		<td width="105" class="ui-widget-content"><?php echo $condu['fecha_vence']; ?>
		  <input type="hidden" name="fdocs<?php echo $i?>" value="<?php echo $condu['fecha_vence'];?>" /><input type="hidden" name="ndoc" value="<?php echo $i;?>" /></td>
	
		<?php 
		if($novedad==1){

?>		
		<td width="44" class="ui-widget-content">
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
<!--</table>
       <div  id="condocs" ></div> 
     </td>
	 </tr> -->
    </table></td>
  </tr>
  <tr>
    <td class="titulos ui-corner-all"><div align="center" >En Caso de Accidente Avisar a </div></td>
  </tr>
  <tr>
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="500" border="0" align="center" cellspacing="5">
      <tr class="ui-widget-header">
        <td width="211" ><div align="center" class="Estilo10">Nombre</div></td>
        <td width="108"><div align="center" class="Estilo10">Tel&eacute;fono</div></td>
        <td width="145"><div align="center" class="Estilo10">Celular</div></td>
      </tr>
      <tr>
        <td class="ui-widget-content" id="nombrea"><div align="left" class="Estilo6"><?php echo $filatar['acudiente'];?></div></td>
        <td class="ui-widget-content" id="telefonoa"> <div align="left" class="Estilo6"><?php echo $filatar['telefonoa'];?></div></td>
        <td class="ui-widget-content" id="celulara"><div align="left" class="Estilo6"><?php echo $filatar['celulara'];?></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="titulos ui-corner-all"><div align="center" >Empresa </div></td>
  </tr>
  <tr>
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="500" border="0" align="center" cellspacing="5">
      <tr class="ui-widget-header">
        <td width="500" colspan="2" >
          <div align="center">Nombre </div></td>
       </tr>
      <tr>
        <td class="ui-widget-content" colspan="2" ><div align="left" class="Estilo6">
		<?php
		$id_empresa=$filatar['id_empresa'];
		//include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
		//$link=conectarse();
		$consulemp="SELECT * FROM empresa where id_empresa=$id_empresa";
		 $queryemp=mysql_query($consulemp);
		$emp=mysql_fetch_array($queryemp);
		
		 echo $emp['nombre'];
		?>
		</div></td>
       </tr>
	  
	   <tr class="ui-widget-header">
	   

 <td width="108"><div align="center" class="Estilo10">NIT.</div></td> 
		<td width="108"><div align="center" class="Estilo10">Sitio de Control</div></td> 
			   </tr>
  <tr>
	    <td width="108" class="ui-widget-content"><div align="center" class="Estilo10"><?php
 echo $emp["nit"];?></div></td> 
		<td width="108" class="ui-widget-content"><div align="center" class="Estilo10"><?php
 echo $emp["direccion"];?></div></td> 
	   </tr>
	   </table></td>
  </tr>
  <tr>
    <td class="titulos ui-corner-all"><div align="center" >Datos del Veh&iacute;c&uacute;lo </div></td>
  </tr>
  <tr>
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="500" border="0" align="center" cellspacing="5">
      <tr class="ui-widget-header">
        <td width="94" ><div align="center" class="Estilo10">Movil</div></td>
        <td width="77"><div align="center" class="Estilo10">Placa</div></td>
        <td width="74"><div align="center" class="Estilo10">Marca</div></td>
        <td width="83"><div align="center" class="Estilo10">Modelo</div></td>
        <td width="132"><div align="center" class="Estilo10">Vigencia Diarios </div></td>
      </tr>
      <tr>
        <td class="ui-widget-content" ><?php echo $filatar['id_movil']?><input name="movil" type="hidden" class="ui-widget-content ui-corner-all" id="movil" size="15" value="<?php echo $filatar['id_movil']?>" maxlength="15"  />  </td>
        <td class="ui-widget-content" id="placa"><span class="Estilo6"><?php echo $filatar['placa']?></span></td>
        <td class="ui-widget-content" id="marca"><span class="Estilo6"><?php echo $filatar['marca']?></span></td>
        <td class="ui-widget-content" id="modelo"><span class="Estilo16"><?php echo $filatar['modelo']?></span></td>
        <td class="ui-widget-content"  id="vigencia"><?php 		
		 $can_dias=deme_info("plazo_diarios") ; 
// $dias= (int) $can_dias; 	
 $fecha_vigencia=$filatar["pago_hasta"]; 

 
 $fechaComparacion = strtotime($fecha_vigencia);
 $calculo= strtotime("$can_dias days", $fechaComparacion);
 $fecha_ok=date("Y-m-d", $calculo);
		
	echo $fecha_ok;$fvigencia=$fecha_ok ?></td><div  id="idiario"></div><input type="hidden" id="diariosv" name="diariosv"  value="<?php echo $filatar['id_movil']?>" class="ui-widget-content ui-corner-all"  /><input type="hidden" id="fvencediario" name="fvencediario"  value="<?php $fech1=strtotime($fecha_ok);
$sumafe=strtotime("1 day 8 hours",$fech1);
$fechsuma=date('Y-m-d h:i',$sumafe);echo $fechsuma?>" class="ui-widget-content ui-corner-all"  />
      </tr>
    </table></td>
  </tr>
 <!-- <tr>
    <td class="titulos ui-corner-all"><div align="center">Documentos del Veh&iacute;culo </div></td>
  </tr> -->
  <tr>
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="500" border="0" align="center" cellspacing="5">
      <tr class="ui-widget-header" >
       <!-- <td width="65"><div align="center" >id</div></td> -->
        <td width="55"><div align="center" >C&oacute;digo</div></td>
        <td width="181"><div align="center" >Documento</div></td>
		<td width="160"><div align="center" class="Estilo3"><span >N&uacute;mero</span></div></td>
		 <td width="88"><div align="center" >Fecha Reg </div></td>
        <td width="93"><div align="center" >Fecha Vigencia </div></td>
      </tr>
    <!--  <tr >
	 <td colspan="3">
	 <table width="500" border="0" align="center" cellspacing="5"> -->

<?php
   
	//	include('../inc/libreria.php'); //incluimos el config.php que contiene los datos de la conexión a la db
	//	include('../inc/operaciones.php');
	//	$link=conectarse();
		//$fecha=date('Y-m-d');
        $id_movil=$filatar['id_movil'];
	  $consulta = "SELECT * FROM `veh_doc` a INNER JOIN documentos_v b ON a.`id_documento` = b.`id_documento`
WHERE `id_movil` ='$id_movil'";
       $resultado=mysql_query($consulta);
	      $ndocv=mysql_num_rows($resultado);
		$errorv="";
	   $iv=0;
	   $novedadv=0;
	   $msjev=' ';
	   $fechv[]=array();
	    $idcondocv[]=array();
		$diasconv[]=array();
		 $elementocv = 0;
		 $mayorcv=0;
		 $menorcv=0;
       while($condu=mysql_fetch_array($resultado)){
	   $iv++;
	   $fve=$condu['fecha_ven'];
	   
	   $fvencev=aumenta_dias($fve,1);
	  // echo $fecha;
	    $documentv=$condu['descripcion'];
		 $fechv[]=$condu['fecha_ven'];
	    $idcondocv[]=$condu['id_documento'];
	   if($fvencev<$fecha){
	    $novedadv=1;
		$msjev=$msjev.$documentv.' -- ';
	   $errorv="<div class='ui-state-error' id='mensaje2v' >
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 5px 0;'></span>
		Vencido 
	  </div>";
	  
	  
?>		


<?php 
} else{
 $errorv="";
}
?>	
         <tr class="ui-widget-content">
		<td width="55" class="ui-widget-content"><?php echo $condu['id_documento'] ?>
		  <input type="hidden" name="idvdoc<?php echo $i?>" value="<?php echo $condu['id_documento'];?>" /></td>
		<td width="181" class="ui-widget-content"><?php echo $condu['descripcion'] ?></td>
		<td width="160" class="ui-widget-content"><?php echo $condu['numero'] ?></td>
		<td width="88" class="ui-widget-content"><?php echo deme_f_detalle($id_tarjeta,$condu['id_documento']); ?></td>
		
		<td width="93" class="ui-widget-content"><?php echo $condu['fecha_ven']; ?>
		  <input type="hidden" name="vdocs<?php echo $iv?>" value="<?php echo $condu['fecha_ven']; ?>" /><input type="hidden" name="nvdoc" value="<?php echo $iv;?>" /></td>
		<?php 
		if($novedadv==1){

?>		
		<td width="43" class="ui-widget-content">
		<?php echo $errorv ?>		</td>
		 </tr>
<?php 
}
} 

if($novedadv==1){
echo $modalv="
<div class='ui-state-error' id='mensajev' title='Documento Vencido'>
		<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>
	   Debe Actualizar $msjev antes de continuar  </div><script language='javascript'>document.getElementById('grabaimp').disabled=true;jQuery('#mensajev').dialog({modal: true,buttons: {Ok: function() {
					jQuery( this ).dialog('close');	}}});</script>";

}

  for($x=1;$x<=$ndocv;$x++){
		 	  ///se recibe la matriz de documnetos
			 $fcdocsv= $fechv[$x];
			 $fecha;
			 //calculo de dias comparados con la fecha actual
			$diasconv[]=calcdia($fecha,$fcdocsv);  
			sort($diasconv);
			 $menorc = $diasconv[0];
				
			}//fin for x
		 for($a=1;$a<=$ndocv;$a++){
				$fcondocsv= $fechv[$a];
			  $idcdocsv= $idcondocv[$a];
				 $diasdifv=calcdia($fecha,$fcondocsv);
					 if($diasdifv==$menorc){
						 
						 $menorcondocv=$fcondocsv;
					 $idcdv=$idcdocsv;
						 }  
			 }//fin for a
			 
/////calculo de los fechas a dias teniendo en cuenta como base el dia actual
		 $diasdifc=calcdia($fecha,$menorcondoc);
		 $diasdifv=calcdia($fecha,$menorcondocv);
		 $diasdifd=calcdia($fecha,$fvigencia);
////////se busca cual es la menor fecha de todos los documentos para tenerla como referencia en la vigencia de la tarjeta de control
		  if( $diasdifc< $diasdifv){
	        if( $diasdifc<$diasdifd){
	         	$fecha_vence=$menorcondoc;
		 		$id_doc=$idcd;
	        }else{
	         	 $idiario=22;
			   	 $fecha_vence=$fvigencia;
				 $id_doc=$idiario;
				 }
	    }else{
	        if( $diasdifv<$diasdifd){
	          $fecha_vence=$menorcondocv;
			  $id_doc=$idcdv;
	        }else{
            $idiario=22;
			$fecha_vence=$fvigencia;
		 	$id_doc=$idiario;
			}
	}			 
			 
			 
?>		
<input type="hidden" name="mfechveh" id="mfechveh" value="<?php echo $menorcondocv;?>" />	
<input type="hidden" name="dfechveh" id="dfechveh" value="<?php echo $idcdv;?>" />	
<!--</table>
       <div  id="vehidocs" ></div> 
     </td>
	 </tr> -->
    </table></td>
  </tr>
 <!-- <tr>
    <td class="titulos ui-corner-all">
    <div align="center">Documentos de Retorno </div></td>
  </tr>
  <tr>
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="500" border="0" align="center" cellspacing="5">
      <tr class="ui-widget-header" >
        <td width="64"><div align="center" class="Estilo10">id</div></td>
        <td width="60"><div align="center" class="Estilo10">C&oacute;digo</div></td>
        <td width="138"><div align="center" class="Estilo10">Documento</div></td>
        <td width="195"><div align="center" class="Estilo10">Fecha Entrega </div></td>
        <td width="105"><div align="center" class="Estilo10">Estado </div></td>
      </tr>
      <tr>
        <td class="ui-widget-content">&nbsp;</td>
        <td class="ui-widget-content">&nbsp;<input type="hidden" value="0" name="id_planilla" id="id_planilla" /></td>
        <td class="ui-widget-content">&nbsp;</td>
        <td class="ui-widget-content">&nbsp;</td>
        <td class="ui-widget-content" >&nbsp;</td>
      </tr>
    </table></td>
  </tr> -->
  <input type="hidden" value="0" name="id_planilla" id="id_planilla" />
  <tr >
    <td class="ui-jqgrid-titlebar ui-widget-header ui-corner-all ui-helper-clearfix "><table width="500" border="0" align="center" cellspacing="5">
      <tr class="ui-widget-header" >
        <td width="95"  class=" ui-corner-all" ><div align="center"><span>Nro. Tarjeta </span></div></td>
        <td width="200"><div align="center" ><span >Registrado Por </span></div></td>
        <td width="179"><div align="center" ><span >Fecha y Hora </span></div></td>
      </tr>
      <tr>
        <td class="ui-widget-content"><?php echo $filatar['tarjeta'];?><input type="hidden" id="tarjeta" name="tarjeta" size="5" class="ui-widget-content ui-corner-all"  value="<?php echo $filatar['id_tarjeta'];?>" /> </td>
        <td class="ui-widget-content"><?php echo $login;?></td>
        <td class="ui-widget-content"><?php echo $fechact=date("Y-m-d h:i:s");  ?></td>
      </tr>
	   <tr class="ui-widget-header" >
        <td width="95"  class=" ui-corner-all" ><div align="center"><span>Nva Vigencia </span></div></td>
        <td width="200"><div align="center" ><span >Vigencia ant.</span></div></td>
        <td width="179"><div align="center" ><span >Documento Guia </span></div></td>
      </tr>
      <tr>
        <td class="ui-widget-content"><?php echo $fecha_vence;?><input type="hidden" id="fecha_new" name="fecha_new"  value="<?php echo $fecha_vence;?>" /></td>
        <td class="ui-widget-content"><?php echo $filatar['fecha_vigencia']?><input type="hidden" id="fecha_ant" name="fecha_ant" value="<?php echo $filatar['fecha_vigencia'];?>" /></td>
        <td class="ui-widget-content"><?php  $condocu="select * from v_documentos where id_doc='$id_doc'";
		 $sqldocu=mysql_query($condocu);
		 $filadocu= mysql_fetch_array($sqldocu);
		 echo $filadocu['documento'];
		   ?><input type="hidden" id="docguia" name="docguia" value="<?php echo $filadocu['documento'];?>" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="ui-corner-all"><table width="493" border="0" cellspacing="5">
      <tr>
        <td width="165"><div align="center">
          <input type="button" name="grabaimp" id="grabaimp"  value="Guardar"  class="fm-button ui-state-default ui-corner-all fm-button-icon-left" onclick="grabactu('grabatc')" />
        </div></td>
        <!--<td width="166"><div align="center">
          <input type="button" name="buttonc" value="Cancelar" class="fm-button ui-state-default ui-corner-all fm-button-icon-left" onclick="javascript:jQuery('#actualizatc').dialog( 'close' );" />
        </div></td> -->
        <td width="136"><div align="center">
          <input type="button" name="cancelatc" value="Salir"  class="fm-button ui-state-default ui-corner-all fm-button-icon-left"onclick="javascript:jQuery('#actualizatc').dialog( 'close' );" />
		  
        </div></td>
      </tr>
    </table></td>
  </tr>
</table>

<!--//</form> -->
<div id="grabatc"></div>
</body>
</html>
