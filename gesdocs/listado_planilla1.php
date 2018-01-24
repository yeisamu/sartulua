<?php
session_start();
 include('../inc/libreria.php');
 include('../inc/operaciones.php');
  $link=conectarse();
 if(!valida_usr(15)){
 
 echo "Acceso No Autorizado";
 return ;
 }
 
//$borrar=mysql_query("TRUNCATE TABLE `reporte_planilla`");
$consulta=mysql_query("select distinct grupo from empresa");
$num=mysql_num_rows($consulta);
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>listado de planillas</title>
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
	<script src="../themes/ejemplo/ui/i18n/jquery.ui.datepicker-es.js"></script>
	
	    <script type="text/javascript">
  /*  $.jgrid.no_legacy_api = true;
    $.jgrid.useJSON = true;*/
     jQuery.noConflict();

	jQuery(document).ready(function(){ 
	jQuery("#rangop").click(function(event) {
event.preventDefault();
jQuery("#rangos").slideToggle();
});
	/////tarjetas de control con novedad
	var n='<?php echo $num ?>';
	for(x=0;x<n;x++){
	
	var grupo_emp=jQuery("#id_grupo"+x).val();
	
	//alert(grupo_emp)
	var dir='gridreporteplanilla.php?q=1&grupo='+grupo_emp;
	jQuery("#crudnov"+x).jqGrid({ 
     
     url:dir,
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['Fecha','','# Planilla','Movil','Conductor','Destino','Elab','Recibido','Estado','Observaciones','Liquidado','Operaciones']
	, colModel :[
	{name:'fecha'
		,index:'fecha'
		,width:100
		//,align:'right'
		,editable:false	
		,search:false
	},{
	
	name:'id_planilla'
		,index:'id_planilla'
		,width:40
		,hidden:true
		,editable:false	
		,search:false
	},{
	name:'n_planilla'
		,index:'n_planilla'
		,width:50
		//,align:'right'
		,editable:false	
		},{
	name:'id_movil'
		,index:'id_movil'
		,width:35
		//,align:'right'
		,editable:false
		,search:true	
		
	},{
	name:'nombre_con'
		,index:'nombre_con'
		,width:100
		//,align:'right'
		,editable:false	
		,search:false
	},
	{
	
		name:'destino'
		,index:'destino'
		,width:50
		,editable:true
		,search:false
		//,align:'center'
		/*,editrules:{required:true}
		,formatoptions:{srcformat:"Y-m-d H:i:s",newformat:"Y-m-d"}
    	,formatter:"date"
		,editoptions:{
		dataInit:
		function(elm){setTimeout(function(){
                  jQuery(elm).datepicker({dateFormat:'yy-mm-dd',changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,});
                    jQuery('.ui-datepicker').css({'font-size':'75%'});
                },200);}
				}
		*/
	
	},{
		name:'elab'
		,index:'elab'
		//,align:'center'
		, width:40
		,search:false
		/*,searchoptions:{dataInit:function(el){jQuery(el).autocomplete({
			source: "selecmovil.php",
			 select: function(event, ui) {
                  }
		});} }*/
	},{
	  name:'recibido'
		,index:'recibido'
		,width:40
		,search:false
		//,align:'center'
		//,hidden:true
	},{
	  name:'estado'
		,index:'estado'
		,width:70
		//,align:'center'
		//,hidden:true
		,search:false
		},{
	  name:'observaciones'
		,index:'observaciones'
		,width:70
		//,align:'center'
		//,hidden:true
		,search:false		
	},{
	  name:'liquidado'
		,index:'liquidado'
		,width:70
		,align:'center'
		,search:false
		//,formatter:'date', formatoptions:{srcformat:"Y-m-d H:i",newformat:"d-M-Y h:i a"}
		//,hidden:true
		
	/*},{ name:'estado'
		,index:'estado'
		,width:65
		,align:'center'
		//,hidden:true
		,search:false
		
		},{ name:'servicio'
		,index:'servicio'
		,width:75
		,align:'center'
		//,hidden:true
		,search:false
		
	
		
	},{
	  name:'est_ant'
		,index:'est_ant'
		,width:10
		,align:'center'	
		,hidden:true
		},{
	  name:'est_new'
		,index:'est_new'
		,width:10
		,align:'center'	
		,hidden:true*/
		},{name:'accion',index:'accion',align:'center', width:80,sortable:false,search:false	
	
	}
	],
	   
	  // pager: jQuery('#pcrudoc'),
	   pager: jQuery('#pcrudnov'+x),
    rowNum:100,
    //rowList:[10,20,30],
	height:'auto',
	width:'auto',
    sortname: 'n_planilla',
    sortorder: "asc",
    viewrecords: true,
     caption: 'Relacion de Planillas de viaje para el grupo '+grupo_emp,
	 rownumbers: true,
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
		 
		 
		 
	loadComplete:function(){
	    
		//setTimeout(function(){jQuery('#crudnov').trigger('reloadGrid')},30000)
		var ids = jQuery(this).getDataIDs();
		var z=this.id.substring(7)
		//						  alert(this.id+' '+z)
		for(var i=0;i<ids.length;i++){
			var cl = ids[i];
			 var rowData = jQuery(this).getRowData(cl);
			  var id_planilla= rowData['id_planilla'];
			  var liquidado= rowData['liquidado'];
			  var estado= rowData['estado'];
			  if(liquidado=="Liquidada" ){
			    var habilita="disabled=disabled";
			  }else{
			  habilita="";
			  }
			  
			// alert(id_planilla)
			 //replace name with you 
			 if(id_planilla!=0){
			 btn = "<input style='height:22px;width:60px;' type='button' "+habilita+" value='Liquidar' onclick=liquida_planilla("+id_planilla+","+z+"); />";
			 
			 }else{
			 btn = "";
			 }

	
//	ntarj= "<input  id='id_tarj"+i+"' type='hidden' value="+id_planilla+" />"; 
//	id_movil= "<input  id='id_movil"+i+"' type='hidden' value="+id_movi+" />"; 
	//onclick=jQuery('#ntarjetao').dialog('open');
	//jQuery('#list10_d').jqGrid('setGridParam',{url:'subgrid.php?q=1&id=2',page:1}); jQuery('#list10_d').jqGrid('setCaption','Invoice Detail: 2') .trigger('reloadGrid')+"/>"; 
			
			
			//jQuery('#crud').editRow("+cl+"); />"; 
			//se = "<a href='#' id='trigger'>TRIGGER</a>"; 
			//ce = "<input style='height:22px;width:20px;' type='button' value='C' onclick=jQuery('#crud').restoreRow("+cl+"); />"; 
			jQuery(this).setRowData(ids[i],{accion:btn})
			
		}	
	},
	    editurl: 'gridreporteplanilla.php?q=1'// this is dummy existing url 
		
		 });
		 var y=jQuery("#y"+x).val();
		  jQuery("#crudnov"+x).jqGrid('navGrid','#pcrudnov'+x,{edit:false,add:false,del:false,searchtext:'Busqueda'},{height:400,reloadAfterSubmit:true,closeAfterEdit : true},{closeOnEscape:true},{closeOnEscape:true},{sopt:['cn','bw','eq','ne','lt','gt','ew','le','ge']}).navButtonAdd('#pcrudnov'+x,{
                                caption:"Exportar", 
                                buttonicon:"ui-icon-calculator", 
								
                                onClickButton: function(){ 
							      var y=this.id.substring(7)
								  //alert(this.id+' '+y)
                                  exportExcel(y);
                                }, 
                                position:"last"
                            });
							
							
function exportExcel(x)
        {
            var mya=new Array();
            mya=jQuery("#crudnov"+x).getDataIDs();  // Get All IDs
            var data=jQuery("#crudnov"+x).getRowData(mya[0]);     // Get First row to get the labels
            var colNames=new Array(); 
            var ii=0;
			var html="";
            for (var i in data){colNames[ii++]=i;html=html+i+"\t";}    // capture col names
           html=html+"\n";
            for(i=0;i<mya.length;i++)
                {
                data=jQuery("#crudnov"+x).getRowData(mya[i]); // get each row
                for(j=0;j<colNames.length;j++)
                    {
                    html=html+data[colNames[j]]+"\t"; // output each column as tab delimited
                    }
                html=html+"\n";  // output each row with end of line

                }
            html=html+"\n";  
			//alert(html)
			document.getElementById('csvBuffer'+x).value=html;
            eval('document.getElementById("form1'+x+'").method="POST";');
            eval('document.getElementById("form1'+x+'").action="csvExport.php"');  // send it to server which will open this contents in excel file
            eval('document.getElementById("form1'+x+'").target="_blank";');
            eval('document.getElementById("form1'+x+'").submit();');
        }							
	jQuery("#crudnov"+x).jqGrid('filterToolbar');	  
		   //jQuery("#crudnov").jqGrid('setGroupHeaders', { useColSpanStyle: true, groupHeaders:[ {startColumnName: 'nombre1', numberOfColumns: 2, titleText: '<em>Nombres</em>'}, {startColumnName: 'apellido1', numberOfColumns: 2, titleText: 'Apellidos'}, {startColumnName: 'tarj', numberOfColumns: 2, titleText: 'Tarjeta Ctrl'}	 ] });
		   }
 });
    </script>

    <script src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>
	
    <script src="../themes/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	 <link rel="stylesheet" type="text/css" href="../themes/css/custom-theme/jquery-ui-1.8.16.custom.css">
	<link rel="stylesheet" type="text/css" href="../css/ui.jqgrid.css">
	
   <!-- <link rel="stylesheet" type="text/css" media="screen" href="../themes/ui.multiselect.css" /> -->
   	<!--<link rel="stylesheet" type="text/css" href="../themes/development-bundle/themes/custom-theme/jquery.ui.all.css"> -->
    <!--<link rel="stylesheet" type="text/css" media="screen" href="../themes/ui.multiselect.css" /> -->
   <link rel="stylesheet" type="text/css" href="../plugins/ui.multiselect.css">

    <style type="text/css">
<!--
.Estilo1 {
	color: #333333;
	font-size: 36px;
	font-weight: bold;
	font-style: italic;
}
.Estilo2 {
	color: #333333;
	font-size: 18px;
	font-weight: bold;
	font-style: italic;
}
-->
    </style>
	<style type="text/css">
	#rangos {
display: none;
}
#tc {
display: none;
}
			/*demo page css*/
			body{ font: 62.5% "Trebuchet MS", sans-serif; margin: 50px;}
			.demoHeaders { margin-top: 2em; }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
		#actualiza1 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:1;
	left: 666px;
	top: 91px;
}
.Estilo4 {
	font-size: 24%;
	font-weight: bold;
}
    </style>	
</head>

<body>

<div  id="login1">login: [ <?php echo $_SESSION['login'];  ?>]</div>
<div id="Layer1"></div>
<div align="right"><span class="Estilo2"><a href="../login/index2.php" class="ui-state-hover">Volver al Men&uacute </a></span></div>
<span class="Estilo2"><a href=""  id="rangop" class="ui-state-hover">Agregar Rangos de Planillas </a></span>
<div id="rangos">
<span class="Estilo1">Rango de Planillas</span>

<table width="67%" border="1" class=" ui-corner-all  ">
  <tr class="ui-widget-header">
    <td width="34%">N&uacute;mero inicial </td>
    <td width="29%" class="ui-tabs">N&uacute;mero Final </td>
    <td width="37%">Empresa</td>
  </tr>
  <tr>
    <td class="ui-widget-content"><input name="ini" type="text" class="ui-widget-content ui-corner-all" id="ini" size="15" maxlength="15" /><input name="ngrupo" type="hidden"  id="ngrupo" size="15" maxlength="15" value="<?php   echo $num ?>" />
    &nbsp;</td>
    <td class="ui-widget-content"><input name="fin" type="text" class="ui-widget-content ui-corner-all" id="fin" size="15" maxlength="15" /></td>
    <td class="ui-widget-content"><select name="grupo" id="grupo" class="ui-widget-content ui-corner-all">
<?php
 
  $consultas="select * from empresa";
  $sql=mysql_query($consultas);
  while($filadoc=mysql_fetch_array($sql)){
  $value=" echo $"."filadoc['grupo'];";
 $dato="echo $"."filadoc['nombre'];";
  
  ?>
  <option value="<?php eval($value) ?>"><?php eval($dato) ?></option>
  
<?php  
  }
?>
</select>
  </td>
  </tr>
  <tr >
    <td colspan="3">
	<table width="100%" border="1">
  <tr>
    <td><div align="center">
      <input name="grabarango" type="button" value="Grabar"  onclick="inserta_rango()"/>
    </div></td>
    <td><div align="center">
      <input name="cancelarango" type="button" value="Cancelar" />
    </div></td>
  </tr>
</table>

	</td>
   
  </tr>
</table>
<div id="graba"></div>
</div>
<p>
  <?php 
$a=0;
while($rows=mysql_fetch_array($consulta)){
$id_grupo=$rows['grupo'];
$in=inicio_planilla($id_grupo);
$fin=fin_planilla($id_grupo);

$nplani=mysql_query("select * from reporte_planilla where grupo='$id_grupo'");
//echo $cpn="select * from reporte_planilla where grupo='$id_grupo'";

//for($i=$in;$i<=$fin;$i++){
while($fila=mysql_fetch_array($nplani)){
$n_planilla=$fila['n_planilla'];
     //insertar
	// $id_planilla= datos_p($i);
	
	//echo  $con="update reporte_planilla set `fecha`=$fecha_elab, `id_planilla`=$id_panilla,`id_movil`=$id_movil, `id_conductor`= $id_conductor, `codigo`=$codigo, `nombre_con`=$nombre, `destino`=$ciudad_d, `elab`=$usr_elab, `recibido`=$usr_rec, `liquidado`=$liquidado where n_planilla=$i ";
	 $veri=mysql_query("select * from planilla inner join (tarjeta_control inner join conductor on tarjeta_control.id_conductor=conductor.id_conductor) on planilla.id_tarjeta=tarjeta_control.id_tarjeta where n_planilla=$n_planilla");
	 $fila=mysql_fetch_array($veri);
      $id_panilla=$fila['id_planilla'];
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
	   if($tot_registro>0){	   
	  //$dato=mysql_query("insert into reporte_planilla (`fecha`, `id_planilla`,  `id_movil`, `grupo`, `id_conductor`, `codigo`, `nombre_con`, `destino`, `elab`, `recibido`, `estado`,observaciones, `liquidado`)values ('$fecha_elab',$id_panilla,'$id_movil','$id_grupo',$id_conductor,'$codigo','$nombre','$ciudad_d','$usr_elab', '$usr_rec',$estado,'$obs',$liquidado) ");
	  
	 $dato=mysql_query("update `reporte_planilla` set `fecha`='$fecha_elab', `id_planilla`=$id_panilla, `id_movil`='$id_movil',  `id_conductor`='$id_conductor', `codigo`='$codigo', `nombre_con`='$nombre', `destino`='$ciudad_d', `elab`='$usr_elab', `recibido`='$usr_rec', `estado`=$estado, `observaciones`='$obs', `liquidado`=$liquidado where n_planilla= $n_planilla");
	  }else{
	//  $inserta=mysql_query("insert into  `reporte_planilla` (`n_planilla`,grupo) values ('$i','$id_grupo')");
	  }
	 
}

switch($id_grupo){
		case 'TA':
		
		$n_grupo="Trans Argelia y Cairo";
		 break;
		case 'TM':
		$n_grupo="Trans Mariscal Robledo";
		 break;
		 case 'TC':
		 $n_grupo="Tax Cartago";
		 break;
}

?>
</p>
<p>  <span class="Estilo1">Planillas  <?php echo $n_grupo?></span>
</p>
<table align="center" id="crudnov<?php echo $a?>"  ><input type="hidden" id="y<?php echo $a?>" name="y<?php echo $a?>" value="<?php echo $a  ?>" /><input type="hidden" id="id_grupo<?php echo $a?>" name="id_grupo<?php echo $a?>" value="<?php echo $id_grupo  ?>" />
<tr><td>&nbsp;</td></tr></table><div id="pcrudnov<?php echo $a?>" align="center"><form method="post" id="form1<?php echo $a?>" action="csvExport.php">
    <input type="hidden" name="csvBuffer<?php echo $a?>" id="csvBuffer<?php echo $a?>" value="" /><input type="hidden" id="x" name="x" value="<?php echo $a  ?>" />
</form></div>

<?php
$a++;
}
//$borrar=mysql_query("TRUNCATE TABLE `reporte_planilla`");
?>
<div id="liquida_planilla"></div>
</body>
</html>
