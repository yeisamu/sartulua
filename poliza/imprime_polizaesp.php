<?php
session_start();
include('../inc/libreria.php');
include('../inc/operaciones.php');
$link=conectarse();
$per=$_REQUEST['peri'];
$idmovil=$_REQUEST['movil'];
$fhasta=$_REQUEST['fecha'];
$ffin=$_REQUEST['fhas'];
$dato=explode('-',$per);
$ini=$dato[0];
$fin=$dato[1];
$ahora=mysql_query("select date_format(now(),'%Y-%m-%d') as hoy");
$fhoy=mysql_result($ahora,0,hoy);

$consultatipo=mysql_query("select * from (vehiculo inner join marca on vehiculo.id_marca=marca.id_marca) inner join (tipo_taxi inner join tipov on tipo_taxi.id_tipov=tipov.id_tipov) on vehiculo.id_movil=tipo_taxi.id_movil and vehiculo.id_movil='$idmovil'");

$filamov=mysql_fetch_array($consultatipo);

$tipo=$filamov['id_tipov'];
$id_mov=$filamov['id_movil'];
$selmovil=mysql_query("select * from vehiculo  inner join empresa on vehiculo.grupo=empresa.grupo where id_movil='$idmovil'");
$row=mysql_fetch_array($selmovil);
$grupo=$row['grupo'];
$selcomp=mysql_query("select * from compania_poliza WHERE `grupo`='$grupo'");
$rowcom=mysql_fetch_array($selcomp);
$selvige=mysql_query("SELECT * FROM `valor_poliza` WHERE `grupo`='$grupo'  and  concat_ws('-',date_format(`fini`,'%Y'),date_format(`ffin`,'%Y'))= '$per' ");
//echo $a="select max(ncuota) as ncuota from `detalle_contra` where id_movil='$idmovil' and periodo = '$per'";
//echo $tcuota=mysql_num_rows($selvige);
$filfecha=mysql_fetch_array($selvige);
$fdes=$filfecha['fini'];
$fok=strtotime($fdes);
$fdesde=date('Y-m-d',$fok);
//$fhasta=$filfecha['fhasta'];

$marcagua=$row['grupo'];
if($marcagua=='TA'){
$fondo='marcagua.png';
}
if($marcagua=='TM'){
$fondo='marcaguatm.png';
}
if($marcagua=='TC'){
$fondo='marcaguatc.png';
}

?>
	<script  src="funpoli.js"></script>
 <script type="text/javascript">
function imprimir() {
	window.print();
	//window.close();
}
    </script>
	
<style>
#registrarp{

/*display: none;*/
}
#liquidac{

/*display: none;*/
}
#graba_perind{
display: none;
}
.Estilo1 {
	font-size: 26px;
	color: #FF0000;
}
.Estilo3 {font-size: 13}
.Estilo4 {font-size: 13; font-weight: bold; }
.Estilo5 {font-size: 12px}
-->
    </style>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Poliza Provisional</title>

</head>

<body onLoad="imprimir()">
<div id="liquidac">

<table width="100%" border="8" align="left" cellpadding="1" bordercolor="#8080FF" class="ui-corner-all ">
  <tr class="ui-corner-all "  background="<?php echo $fondo ?>">
   <td colspan="4">
  <table width="100%" border="0"  class="ui-corner-all ">
  <tr>
    <td width="21%"  class="ui-corner-all  Estilo1"><?php $prim=$filamov['tipov'];  $datosmov=explode(' ',$prim);
		
	 $letra1=substr($datosmov[0],0,1);$letra2=substr($datosmov[1],0,1);  echo $letra1.$letra2.$idmovil ?></td>
    <td width="23%"  class="ui-corner-all "><img src="imagenes/<?php echo $row['logo'] ?>" width="57" height="66" /> </td>
    <td width="56%"  class="ui-corner-all "><p align="left"><strong>Poliza de Responzabilidad Civil </strong></p>
    <p align="left"><strong>RCC-RCE No <?php echo $rowcom['npoliza']?></strong></p></td>
  </tr>
</table></td>
   <td width="50%" rowspan="4"><table width="100%" height="89%" border="0">
     <tr>
       <td><table width="100%" border="0">
         <tr>
           <td width="88%"><strong>COBERTURAS</strong></td>
           <td width="6%"><strong>SI</strong></td>
           <td width="6%"><strong>NO</strong></td>
         </tr>
         <tr>
           <td>&nbsp;</td>
           <td ></td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td><strong>1. Responsabilidad civil Extracontractual 60/60/120 smmlv </strong></td>
           <td bordercolor="#000000"><div align="center"><strong>X</strong></div></td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td><strong>2. Responsabilidad civil Contractual 60/60/60/60 smmlv </strong></td>
           <td bordercolor="#000000"><div align="center"><strong>X</strong></div></td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td class="Estilo5"> <strong class="Estilo5">DEDUCIBLES 10% MINIMO 2 smmlv</strong></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
       </table></td>
     </tr>
     <tr>
       <td bordercolor="#000000" bgcolor="#CCCCCC"><div align="center"><strong>PROCEDIMIENTOS EN CASO DE ACCIDENTE </strong></div></td>
     </tr>
     <tr>
       <td><p class="Estilo4">1.Solicitar la intervenci&oacute;n del tr&aacute;nsito, tomar nombres y tel&eacute;fonos de testigos, al igual que los datos del tercero.</p>
         <p class="Estilo3"><strong>2. No haga ning&uacute;n arreglo con terceros ni admita responsabilidad, pues esto lo obligar&iacute;a a usted y no a la Compa&ntilde;ia </strong>.</p>
         <p class="Estilo3"><strong>3. Informe a nuestras oficinas a m&aacute;s tardar dentro de las 48 horas siguientes al accidente a los tels: 2121144-2123900. </strong></p></td>
     </tr>
   </table></td>
  </tr>
  <tr  background="<?php echo $fondo ?>">
    <td colspan="4"><table width="100%" border="0">
  <tr>
    <td width="22%"><strong>Tomador:</strong></td>
    <td width="51%"><?php echo $row['nombre']?></td>
    <td width="27%"><div align="center"><strong>Vigencia</strong></div></td>
  </tr>
  <tr>
    <td height="31"><strong>Nit:</strong></td>
    <td><?php echo $row['nit']?></td>
    <td rowspan="3"><table width="100%" border="0">
      <tr>
        <td><strong>Desde</strong></td>
        <td bgcolor="#CCCCCC"><?php echo $fhasta?></td>
      </tr>
      <tr>
        <td><strong>Hasta</strong></td>
        <td bgcolor="#CCCCCC"><?php echo $ffin?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><strong>Beneficiario:</strong></td>
    <td>Terceros Afectados </td>
    </tr>
  <tr>
    <td><strong>Compa&ntilde;ia:</strong></td>
    <td><?php echo $rowcom['nomcompa']?></td>
    </tr>
</table>	</td>
    </tr>
 <!-- <tr>
    <td colspan="4"><table width="100%" border="1" class="ui-corner-all">
      <tr class="ui-jqgrid-titlebar ui-widget-header ui-corner-top ">
        <td colspan="6"><div align="center">Vigencia</div></td>
        </tr>
      <tr class="ui-corner-all " >
        <td width="15%" class="ui-widget-header" >Desde </td>
        <td width="14%"><input name="fecha_ini" type="text" class="ui-corner-all " id="fecha_ini" value="<?php echo $fechainipol?>"  size="10" maxlength="10"  /></td>
        <td width="10%" class="ui-widget-header" >Hasta</td>
        <td width="18%"><input type="text" id="fecha_fin" name="fecha_fin" value="<?php echo $fechafinpoli?>" class="ui-corner-all "   size="10" maxlength="10" /></td>
        <td width="28%" class="ui-widget-header" >Saldo Poliza </td>
        <td width="15%"><?php echo $filacontra['saldo']?><input type="hidden" id="saldo" name="saldo" value="<?php echo $filacontra['saldo']?>" /></td>
      </tr>
      <tr class="ui-corner-all " >
        <td class="ui-widget-header" >Total Cuota </td>
        <td><input type="text" id="vcuota" name="vcuota" class="ui-corner-all " value="<?php echo $valcuota?>"    size="8" maxlength="8" onChange="calculasaldo(<?php echo $valorpolizamovil?>)" /></td>
        <td class="ui-widget-header" ># Recibo </td>
        <td><input type="text" id="nrc" name="nrc" class="ui-corner-all "   size="8" maxlength="8" /></td>
        <td class="ui-widget-header" >Fecha Recibo </td>
        <td><input type="text" id="fecha_rc" name="fecha_rc" class="ui-corner-all "   size="10" maxlength="10" /><input type="hidden" id="ncontra" name="ncontra" value="<?php echo $ncontra?>" /><input type="hidden" id="idmovil" name="idmovil" value="<?php echo $idmovil?>" /><input type="hidden" id="period" name="period" value="<?php echo $per?>" /><input type="hidden" id="ncuo" name="ncuo" value="<?php echo $ncuota?>" /></td>
      </tr>
      <tr class="ui-corner-all " >
        <td colspan="3" class="ui-widget-header" >Nuevo Saldo</td>
        <td colspan="3" class="Estilo4" ><div align="right" id="nsaldo">$ <?php echo number_format($nsaldo,"0","",".")?></div></td>
        </tr>
    </table></td>
    </tr>
  <tr> -->
    <tr  background="<?php echo $fondo ?>"><td colspan="4" >
	<table width="100%" border="0" class="ui-corner-all">
	<tr>
	<td colspan="4" class="ui-jqgrid-titlebar ui-widget-header "  >
	<div align="center"><strong>Caracter&iacute;sticas del Veh&iacute;culo Asegurado </strong></div></td>
    </tr>
  <tr class="ui-corner-all " >
    <td width="17%" class="ui-widget-header"  ><strong>Marca</strong></td>
    <td width="44%" class="ui-corner-all ui-widget-content " ><?php echo $filamov['marca']?></td>
    <td width="20%" class="ui-widget-header" ><strong>Placa</strong></td>
    <td width="19%" class="ui-corner-all " ><?php echo $filamov['placa']?></td>
    </tr>
  <tr class="ui-corner-all " >
    <td class="ui-widget-header"><strong>Clase</strong></td>
    <td class="ui-corner-all " ><?php echo $filamov['clase']?></td>
    <td class="ui-widget-header" ><strong>Modelo</strong></td>
    <td class="ui-corner-all " ><?php echo $filamov['modelo']?></td>
  </tr>
  <tr class="ui-corner-all " >
    <td class="ui-widget-header" ><strong>Motor</strong></td>
    <td class="ui-corner-all " ><?php echo $filamov['motor']?></td>
    <td class="ui-widget-header"><strong>Servicio</strong></td>
    <td class="ui-corner-all " ><?php echo $filamov['tipov']?></td>
  </tr>
  <!--<tr class="ui-corner-all " >
    <td class="ui-widget-header">Empresa</td>
    <td colspan="3" class="ui-corner-all " ></td>
    </tr> -->
	</table>
	</td>
    </tr>
	<tr>
	<td colspan="4">
	<table width="100%" border="0">
  <tr  background="<?php echo $fondo ?>">
    <td height="10"><p align="justify" class="Estilo5"><strong>Este documento no constituye poliza ni certificado de seguros: el mismo simplemente acredita la existencia de un contrato de seguro celebrado entre el tomador/asegurado y CHARTIS Colombia seguros generales.</strong></p>
      </td>
  </tr>
</table>	</td>
	</tr>
</table>
<div id="grabacuota"></div>
</div>

</body>
</html>
