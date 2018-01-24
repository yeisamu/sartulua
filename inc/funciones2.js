// JavaScript Document
function grabact(capa){
	  var fant=$('fant').value;
	   var fnew=$('date').value;
	   var eps=$('eps').value;
	   var id_cond=$('id_cond').value;
	   var id_doc=$('id_doc').value;
	   var id_condoc=$('id_condoc').value;	
		new Ajax.Updater(capa,'grabact.php?fant='+fant+'&fnew='+fnew+'&eps='+eps+'&id_cond='+id_cond+'&id_doc='+id_doc+'&id_condoc='+id_condoc,{asynchronous: true, method: 'get',evalScripts:true});
}

function grabactu(capa){
	  var id_tarj=$('tarjeta').value;
	   var fnew=$('fecha_new').value;
	   var fecha_ant=$('fecha_ant').value;
	   var id_cond=$('id_cond').value;
	   var movil=$('movil').value;
	   //alert(movil);
		new Ajax.Updater(capa,'grabactutarjeta.php?id_tarj='+id_tarj+'&fnew='+fnew+'&fecha_ant='+fecha_ant+'&id_cond='+id_cond+'&movil='+movil,{asynchronous: true, method: 'get',evalScripts:true});
}


function abre(i){
	var capa='actualiza';
	var codigo=$('codigo'+i).value;
	var condu=$('condu'+i).value;
	var docu=$('doc'+i).value;
	//alert(codigo+docu+condu);
new Ajax.Updater(capa,'actualizadocs.php?con_doc='+codigo+'&condu='+condu+'&docu='+docu,{asynchronous: true, method: 'get',evalScripts:true});
}

function abre_actu_tarjeta(i){
	var capa='actualizatc';
	var idtarj=$('idtarj'+i).value;
	//var condu=$('condu'+i).value;
//	var docu=$('doc'+i).value;
		//alert(capa+idtarj);
	//+'&condu='+condu+'&docu='+docu
	
new Ajax.Updater(capa,'../gesdocs/actu_tarjetac.php?idtarj='+idtarj,{asynchronous: true, method: 'get',evalScripts:true});
}
function abretarjetan(id_cond){
	var capa='ntarjetao';
new Ajax.Updater(capa,'tarjeta_control1.php?id_cond='+id_cond,{asynchronous: true, method: 'get',evalScripts:true});
}
function abreparte(id_cond){
	var capa='regsimit';
new Ajax.Updater(capa,'registra_parte.php?id_cond='+id_cond,{asynchronous: true, method: 'get',evalScripts:true});
}
function valida(){
	 var eps=$('eps').value;
	 if(eps==""){
		 
		alert('Debe seleccionar la entidad');
		
	 }else{
		grabact('graba');
		document.getElementById('grabact').disabled=true;
		document.getElementById('trigger').disabled=true;
	 }
}

function verdocs(capa){
	 var id_con=$('id_cond').value;
	new Ajax.Updater(capa,'verdocs.php?id_con='+id_con,{asynchronous: true, method: 'get',evalScripts:true});
}

function verdocsmovil(capa){
	 var id_movil=$('movil1').value;
	new Ajax.Updater(capa,'verdocsvehi.php?id_movil='+id_movil,{asynchronous: true, method: 'get',evalScripts:true});
}

function empresa1(){
	 var id_emp=$('empresa').value;
	 nit='nit';
	new Ajax.Updater(nit,'../gesempresa/buscaemp.php?id_emp='+id_emp,{asynchronous: true, method: 'get'});
}

function grabatc(capa){
	  var fechdiario=$('diariosv').value;
	   var fcond=$('mfechcon').value;
	   var fvehi=$('mfechveh').value;
	   var dfechcon=$('dfechcon').value;
	   var dfechveh=$('dfechveh').value;
	  var tarjet=$('tarjeta').value;
	  tarjeta=String(tarjet);
	   var id_cond=$('id_cond').value;	
	  var empresa=$('empresa').value;	
	  var movil=$('movil1').value;	
	  var id_planilla=$('id_planilla').value;	
		new Ajax.Updater(capa,'grabatarjeta.php?fechdiario='+fechdiario+'&fcond='+fcond+'&fvehi='+fvehi+'&dfechcon='+dfechcon+'&dfechveh='+dfechveh+'&tarjeta='+tarjeta+'&id_cond='+id_cond+'&empresa='+empresa+'&movil='+movil+'&id_planilla='+id_planilla,{asynchronous: true, method: 'get',evalScripts:true});
}

function validatc(){
	 var mensaje="";
	 var tarjeta=$('tarjeta').value;
	 var empresa=$('empresa').value;
	  var movil=$('movil1').value;
	 if(tarjeta=="")mensaje+="  - Numero de tarjeta\n";
	 if(empresa=="")mensaje+="  - Empresa\n";
	 if(movil=="")mensaje+="  - Movil\n";
	 
	if (mensaje!="") {
	     alert("Atencion, faltan los siguientes campos por llenar:\n\n"+mensaje);
	}else{
		grabatc('grabatc');
		//document.getElementById('grabact').disabled=true;
		//document.getElementById('trigger').disabled=true;
	 }
}

function tipo_multa(){
 var tipo=$('tipomultas').value;
 
 if(tipo==""){
	alert("Debe Seleccionar el tipo de Registro ")
 }
 if(tipo==0){
	  capa='grabasimit';
	  var id_conductor=$('id_conductor').value;
	   var comparendo="NO";
	   var cod_infraccion="NO";
	   var id_eps=17;
	   var estad=3
	   var valorparte="NO";
	   var conv="NO";
	   var obs=$('observacionesimit').value;
	   obs=String(obs);
	     var fecha="0000-00-00";
		// alert(fecha)
	  new Ajax.Updater(capa,'graba_parte.php?id_conductor='+id_conductor+'&comparendo='+comparendo+'&cod_infraccion='+cod_infraccion+'&id_eps='+id_eps+'&valorparte='+valorparte+'&obs='+obs+'&fecha='+fecha+'&est='+estad+'&conv='+conv,{asynchronous: true, method: 'get',evalScripts:true});
 }
 if(tipo==1){
	validaparte(); 
 }
 if(tipo==2){
	validapartecon(); 
 }
	
}

function validaparte(){
	 var mensaje="";
	 var nparte=$('comparendo').value;
	 var infraccion=$('infraccion').value;
	  var eps=$('eps').value;
	   var fech=$('fecha_parte').value;
	  var valor=$('valorparte').value;
	 if(nparte=="")mensaje+="  - Numero de Comparendo\n";
	 if(infraccion=="")mensaje+="  - Codigo de la Infraccion\n";
	 if(eps=="")mensaje+="  - Entidad\n";
	  if(fech=="")mensaje+="  - Fecha del Comparendo\n";
	  if(valor=="")mensaje+="  - Valor del Comparendo\n";
	 
	if (mensaje!="") {
	     alert("Atencion, faltan los siguientes campos por llenar:\n\n"+mensaje);
	}else{
		grabaparte('grabasimit');
		//document.getElementById('grabact').disabled=true;
		//document.getElementById('trigger').disabled=true;
	 }
}


function grabaparte(capa){
	  var id_conductor=$('id_conductor').value;
	   var comparendo=$('comparendo').value;
	   var cod_infraccion=$('infraccion').value;
	   var id_eps=$('eps').value;
	   var valorparte=$('valorparte').value;
	   var obs=$('observacionesimit').value;
	   obs=String(obs);
	    var estad=1
		var conv="NO";
	     var fecha=$('fecha_parte').value;
		// alert(fecha)
	  new Ajax.Updater(capa,'graba_parte.php?id_conductor='+id_conductor+'&comparendo='+comparendo+'&cod_infraccion='+cod_infraccion+'&id_eps='+id_eps+'&valorparte='+valorparte+'&obs='+obs+'&fecha='+fecha+'&est='+estad+'&conv='+conv,{asynchronous: true, method: 'get',evalScripts:true});
}

function validapartecon(){
	 var mensaje="";
	 var nparte=$('comparendocon').value;
	 var infraccion=$('infraccioncon').value;
	  var eps=$('epscon').value;
	   var fech=$('fecha_partecon').value;
	  var valor=$('valorpartecon').value;
	  var conve=$('nconvenio').value;
	 if(nparte=="")mensaje+="  - Numero de Comparendo\n";
	 if(infraccion=="")mensaje+="  - Codigo de la Infraccion\n";
	 if(eps=="")mensaje+="  - Entidad\n";
	  if(fech=="")mensaje+="  - Fecha del Comparendo\n";
	  if(valor=="")mensaje+="  - Valor del Comparendo\n";
	 if(conve=="")mensaje+="  - Numero del Covenio\n";

	if (mensaje!="") {
	     alert("Atencion, faltan los siguientes campos por llenar:\n\n"+mensaje);
	}else{
		grabapartecon('grabasimit');
		//document.getElementById('grabact').disabled=true;
		//document.getElementById('trigger').disabled=true;
	 }
}


function grabapartecon(capa){
	  var id_conductor=$('id_conductor').value;
	   var comparendo=$('comparendocon').value;
	   var cod_infraccion=$('infraccioncon').value;
	   var id_eps=$('epscon').value;
	   var valorparte=$('valorpartecon').value;
	   var obs=$('observacionesimit').value;
	   obs=String(obs);
	    var estad=4
		var conv=$('nconvenio').value;
	     var fecha=$('fecha_partecon').value;
		// alert(fecha)
	  new Ajax.Updater(capa,'graba_parte.php?id_conductor='+id_conductor+'&comparendo='+comparendo+'&cod_infraccion='+cod_infraccion+'&id_eps='+id_eps+'&valorparte='+valorparte+'&obs='+obs+'&fecha='+fecha+'&est='+estad+'&conv='+conv,{asynchronous: true, method: 'get',evalScripts:true});
}

////funciones para actualizar las multas

function validapagaparte(){
	 var mensaje="";
	 var fecha_pago=$('fecha_pago').value;
	  if(fecha_pago=="")mensaje+="  - Fecha de Pago del Comparendo\n";
	 
	if (mensaje!="") {
	     alert("Atencion, faltan los siguientes campos por llenar:\n\n"+mensaje);
	}else{
		grabapagaparte('grabapagasimit');
	 }
}


function grabapagaparte(capa){
	     var fechapago=$('fecha_pago').value;
		 var fecha_ant_parte=$('fecha_ant_parte').value;
		 var id_simit=$('id_simit').value;
		 var obsimit=$('observacionesimitpago').value;
		 obsimit=String(obsimit);
		 //alert(fecha_ant_parte)
	  new Ajax.Updater(capa,'graba_paga_parte.php?fechapago='+fechapago+'&id_simit='+id_simit+'&obsimit='+obsimit+'&fecha_ant_parte='+fecha_ant_parte,{asynchronous: true, method: 'get',evalScripts:true});
}

////////////////////////////////
function cerrar(i){
	var capa='cerrar';
	var idtarj=$('idtarj'+i).value;
	var ntarj=$('ntarj'+i).value;
	var doc=$('con_doc'+i).value;
	//var docu=$('doc'+i).value;
	//alert(doc);
new Ajax.Updater(capa,'cerrar_tarjeta.php?idtarj='+idtarj+'&ntarj='+ntarj+'&doc='+doc,{asynchronous: true, method: 'get',evalScripts:true});
}

function grabarcierre(){
	var capa='graba';
	var id_tarj=$('id_tarj').value;
	var n_tarj=$('n_tarj').value;
	var doc=$('id_docon').value;
	var observaciones=$('observaciones').value;
	observaciones=String(observaciones);
	//alert(observaciones);
new Ajax.Updater(capa,'grabacierre.php?id_tarj='+id_tarj+'&n_tarj='+n_tarj+'&observaciones='+observaciones+'&doc='+doc,{asynchronous: false, method: 'get',evalScripts:true});
}

function abre_movi(i){
var capa='veractualizatc';
var idtarj=$('idtarj'+i).value;
new Ajax.Updater(capa,'movimientos.php?id_tarj='+idtarj,{asynchronous: true, method: 'get',evalScripts:true});
	
}

function registra_opc(){
var capa='registrar';
//var idtarj=$('idtarj'+i).value;
new Ajax.Updater(capa,'registrar_op.php',{asynchronous: true, method: 'get',evalScripts:true});
	
}
function resetea_opc(){
	
	if(!confirm('Esta seguro de resetear las opciones')) return;
var capa='registrar';
//
new Ajax.Updater(capa,'resetear.php',{asynchronous: true, method: 'get',evalScripts:true});
}
function abre_autoriza(){
	var capa='autoriza';
new Ajax.Updater(capa,'autoriza.php',{asynchronous: true, method: 'get',evalScripts:true});
}
function acepta_autoriza(capa){
	//var capa='autoriza';
	var login1=$('logina').value;
	var pass1=$('passa').value;
new Ajax.Updater(capa,'valida_autoriza.php?logina='+login1+'&passa='+pass1,{asynchronous: true, method: 'get',evalScripts:true});
}

function autoriza(i){
var capa='autorizatc';
var idtarj=$('idtarj'+i).value;
var fvigen=$('fvige'+i).value;

new Ajax.Updater(capa,'autoriza_fecha.php?id_tarj='+idtarj+'&fvigen='+fvigen,{asynchronous: true, method: 'get',evalScripts:true});
	
}

function abre_planilla(i,controlp){
var capa='planillas';
var idtarj=$('idtarj'+i).value;
var grupo=$('id_grupo'+i).value;

new Ajax.Updater(capa,'planillas.php?id_tarj='+idtarj+'&controlp='+controlp+'&grupo='+grupo,{asynchronous: true, method: 'get',evalScripts:true});
	
}

function autoriza_fechas(capa){
	//var capa='autoriza';
	var logina=$('loginauto').value;
	var passa=$('passauto').value;
	var fvigencia=$('fvigencia').value;
	
	var fauto=$('fauto').value;
	var n_tarj=$('n_tarj').value;
new Ajax.Updater(capa,'graba_autoriza.php?loginauto='+logina+'&passauto='+passa+'&fvigencia='+fvigencia+'&fauto='+fauto+'&n_tarj='+n_tarj,{asynchronous: true, method: 'get',evalScripts:true});
}

function ver_tarjeta(id_tarj){
var capa='vertc';	
//var id_tarj=$('id_tarj'+i).value;

new Ajax.Updater(capa,'ver_tarjeta.php?idtarj='+id_tarj,{asynchronous: true, method: 'get',evalScripts:true});	
	
}

function actu_estadon(id_tarj,est_new,i){
var capa='vertc';
var id_movil=$('id_movil'+i).value;
new Ajax.Updater(capa,'actualiza_estado.php?idtarj='+id_tarj+'&est_new='+est_new+'&id_movil='+id_movil,{asynchronous: true, method: 'get',evalScripts:true});
}
function actu_estado_pl(id_planilla,est_new,i){
var capa='vertc';
var id_movil=$('id_movil'+i).value;
new Ajax.Updater(capa,'actualiza_estado_pl.php?idtarj='+id_planilla+'&est_new='+est_new+'&id_movil='+id_movil,{asynchronous: true, method: 'get',evalScripts:true});
}

function pagamulta(idsimit){
	var capa='pagamultas';
new Ajax.Updater(capa,'actualiza_multa.php?idsimit='+idsimit,{asynchronous: true, method: 'get',evalScripts:true});
}

function anulamulta(idsimit){
	var capa='cierramultas';
	//alert(idsimit)
new Ajax.Updater(capa,'cerrar_multa.php?idsimit='+idsimit,{asynchronous: true, method: 'get',evalScripts:true});
}
function autoriza_anulamulta(capa){
	//var capa='autoriza';
	var loginm=$('loginmulta').value;
	var passm=$('passmulta').value;
	var n_simit=$('n_simit').value;
new Ajax.Updater(capa,'graba_anula_multa.php?loginauto='+loginm+'&passauto='+passm+'&n_simit='+n_simit,{asynchronous: true, method: 'get',evalScripts:true});
}


function validaplanilla(control){
	 var mensaje="";
	 var nplanilla=$('nplanilla').value;
	
	  var corigen=$('corigen').value;
	   var forigen=$('forigen').value;
	  var cdestino=$('cdestino').value;
	  var fdestino=$('fdestino').value;
	 //    var contra=$('contra').value;
//	  var doc=$('doc').value;
//	  var nid=$('nid').value;
//	   var dircontra=$('dircontra').value;
//	  var telcontra=$('telcontra').value;
//	  var npasajero=$('npasajero').value;
//	  
	 if(nplanilla=="")mensaje+="  - Numero de la Planilla\n";
	 if(corigen=="")mensaje+="  - Ciudad de Origen\n";
	 if(forigen=="")mensaje+="  - Fecha de Inicio\n";
	  if(cdestino=="")mensaje+="  - Ciudad de Destino\n";
	  if(fdestino=="")mensaje+="  - Fecha de Regrezo\n";
	// if(contra=="")mensaje+="  - Nombre del Contratante\n";
//	 
//	  if(doc=="")mensaje+="  - Tipo de Identificaci\xF3n\n";
//	 if(nid=="")mensaje+="  - N\xFAmero de Identificaci\xF3n\n";
//	 if(dircontra=="")mensaje+="  - Direcci\xf3n del Contratante\n";
//	  if(telcontra=="")mensaje+="  - Telefono del Contratante\n";
//	  if(npasajero=="")mensaje+="  - N\xFAmero de Pasajeros\n";


	if (mensaje!="") {
	     alert("Atenci\xF3n, faltan los siguientes campos por Diligenciar:\n\n"+mensaje);
	}else{
		
		if(control==1){//control == a 1 cuando se alcanza el maximo permitido de planillas para el mes
		    jQuery('#autoriza_planilla').dialog( 'open' );
			new Ajax.Updater('autoriza_planilla','autoriza_planilla.php',{asynchronous: true, method: 'get',evalScripts:true});
		}else{
		grabaplanilla('grabaplanilla');
		//document.getElementById('grabact').disabled=true;
		//document.getElementById('trigger').disabled=true;
		}
	 }
}


function grabaplanilla(capa){
	
    var nplanilla=$('nplanilla').value;
	   var tarjeta=$('tarjeta').value;
	var idtarjeta=$('idtarjeta').value;
	   var doc_cond=$('id_conduc').value;
	  var corigen=$('corigen').value;
	   var forigen=$('forigen').value;
	  var cdestino=$('cdestino').value;
	  var fdestino=$('fdestino').value;
	 /*    var contra=$('contra').value;
	  var doc=$('doc').value;
	  var nid=$('nid').value;
	   var dircontra=$('dircontra').value;
	  var telcontra=$('telcontra').value;
	  var npasajero=$('npasajero').value;*/
	  //alert (doc)
	  new Ajax.Updater(capa,'graba_planilla.php?nplanilla='+nplanilla+'&tarjeta='+tarjeta+'&corigen='+corigen+'&forigen='+forigen+'&cdestino='+cdestino+'&fdestino='+fdestino+'&idtarjeta='+idtarjeta+'&doc_cond='+doc_cond,{asynchronous: true, method: 'get',evalScripts:true});
}


function validan_planilla(capa){
	var nplanilla=$('nplanilla').value;
	var idgrupo=$('idgrupo').value;
	//alert (idgrupo)
	new Ajax.Updater(capa,'validar_n_pl.php?nplanilla='+nplanilla+'&idgrupo='+idgrupo,{asynchronous: true, method: 'get',evalScripts:true});
}
function acepta_autorizap(capa){
	//var capa='autoriza';
	var login1=$('logina').value;
	var pass1=$('passa').value;
	//alert(login1+pass1)
new Ajax.Updater(capa,'graba_autorizap.php?logina='+login1+'&passa='+pass1,{asynchronous: true, method: 'get',evalScripts:true});
}

function recibir_planilla(i){
	var capa='recibe_planilla';
	var idplanilla=$('id_plan'+i).value;
	var n_planilla=$('n_plani'+i).value;
	//var doc=$('con_doc'+i).value;
	//var docu=$('doc'+i).value;
	//alert(doc);
new Ajax.Updater(capa,'cerrar_planilla.php?idplanilla='+idplanilla+'&n_planilla='+n_planilla,{asynchronous: true, method: 'get',evalScripts:true});
}


function recibir_planilla_con(i){
	var capa='recibe_planilla';
	var idplanilla=$('id_plan_con'+i).value;
	var n_planilla=$('n_plani_con'+i).value;
	//var doc=$('con_doc'+i).value;
	//var docu=$('doc'+i).value;
	//alert(doc);
new Ajax.Updater(capa,'cerrar_planilla.php?idplanilla='+idplanilla+'&n_planilla='+n_planilla,{asynchronous: true, method: 'get',evalScripts:true});
}
function grabar_rplanilla(){
	var capa='graba_plani';
	var id_planilla=$('id_planilla').value;
	var numplanilla=$('numplanilla').value;
//	var doc=$('id_docon').value;
	var observaciones_p=$('observaciones_p').value;
	observaciones_p=String(observaciones_p);
	//alert(observaciones);
new Ajax.Updater(capa,'graba_planilla_re.php?id_planilla='+id_planilla+'&numplanilla='+numplanilla+'&observaciones_p='+observaciones_p,{asynchronous: false, method: 'get',evalScripts:true});
}

function anula_planilla(i){
	var idplanilla=$('id_plan'+i).value;
	var n_planilla=$('n_plani'+i).value;
	new Ajax.Updater('anula_planilla','anula_planilla.php?idplanilla='+idplanilla+'&n_planilla='+n_planilla,{asynchronous: true, method: 'get',evalScripts:true});
}
function anula_planilla_con(i){
	var idplanilla=$('id_plan_con'+i).value;
	var n_planilla=$('n_plani_con'+i).value;
	new Ajax.Updater('anula_planilla','anula_planilla.php?idplanilla='+idplanilla+'&n_planilla='+n_planilla,{asynchronous: true, method: 'get',evalScripts:true});
}
function acepta_anula(capa){
	//var capa='autoriza';
	var login1=$('loginanula').value;
	var pass1=$('passanula').value;
	var id_planilla=$('idplanill').value;
	var numplanilla=$('num_planilla').value;
//	var doc=$('id_docon').value;
	var observaciones_p=$('observaciones_anula_p').value;
	observaciones_p=String(observaciones_p);
	//alert(login1+pass1)
new Ajax.Updater(capa,'graba_anula_p.php?loginan='+login1+'&passan='+pass1+'&id_planilla='+id_planilla+'&numplanilla='+numplanilla+'&observaciones_p='+observaciones_p,{asynchronous: true, method: 'get',evalScripts:true});
}
function descarta_planilla(i){
	var idplanilla=$('id_plan'+i).value;
	var n_planilla=$('n_plani'+i).value;
	new Ajax.Updater('descarta_planilla','descarta_planilla.php?idplanilla='+idplanilla+'&n_planilla='+n_planilla,{asynchronous: true, method: 'get',evalScripts:true});
}
function descarta_planilla_con(i){
	var idplanilla=$('id_plan_con'+i).value;
	var n_planilla=$('n_plani_con'+i).value;
	new Ajax.Updater('descarta_planilla','descarta_planilla.php?idplanilla='+idplanilla+'&n_planilla='+n_planilla,{asynchronous: true, method: 'get',evalScripts:true});
}
function acepta_descarta(capa){
	//var capa='autoriza';
	var login1=$('loginanula').value;
	var pass1=$('passanula').value;
	var id_planilla=$('idplanill').value;
	var numplanilla=$('num_planilla').value;
//	var doc=$('id_docon').value;
	var observaciones_p=$('observaciones_anula_p').value;
	observaciones_p=String(observaciones_p);
	//alert(login1+pass1)
new Ajax.Updater(capa,'graba_descarta_p.php?loginan='+login1+'&passan='+pass1+'&id_planilla='+id_planilla+'&numplanilla='+numplanilla+'&observaciones_p='+observaciones_p,{asynchronous: true, method: 'get',evalScripts:true});
}

function liquida_planilla(id,i){
//	var idplanilla=$('id_plan_con'+i).value;
//	var n_planilla=$('n_plani_con'+i).value;
	new Ajax.Updater('liquida_planilla','liquida_planilla.php?idplanilla='+id+'&id='+i,{asynchronous: true, method: 'get',evalScripts:true});
}

function actu_estado_diario(i){
var capa='novedad';
var id_nov=$('id_nov'+i).value;
var id_movil=$('id_movil'+i).value;
var plazo=$('plazo'+i).value;
new Ajax.Updater(capa,'actualiza_estado_diario.php?id_nov='+id_nov+'&movil='+id_movil+'&plazo='+plazo,{asynchronous: true, method: 'get',evalScripts:true});
}



function registra_doc(){
var capa='registra';
//var idtarj=$('idtarj'+i).value;
new Ajax.Updater(capa,'registrar_op.php',{asynchronous: true, method: 'get',evalScripts:true});
	
}

function registra_doc(){
var capa='registra';
//var idtarj=$('idtarj'+i).value;
new Ajax.Updater(capa,'registrar_op.php',{asynchronous: true, method: 'get',evalScripts:true});
	
}


function registra_docv(){
var capa='registra_doc';
//var idtarj=$('idtarj'+i).value;
new Ajax.Updater(capa,'registrar_docv.php',{asynchronous: true, method: 'get',evalScripts:true});
	
}

function inserta_rango(){
var capa='graba';
var ini=$('ini').value;
var fin=$('fin').value;
var grupo=$('grupo').value;
var ngrupo=$('ngrupo').value;
new Ajax.Updater(capa,'rango.php?ini='+ini+'&fin='+fin+'&grupo='+grupo+'&ngrupo='+ngrupo,{asynchronous: true, method: 'get',evalScripts:true});
}

