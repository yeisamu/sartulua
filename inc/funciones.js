// JavaScript Document
function grabact(capa){
	  var nrecib=$('nrecib').value;
	   var cat=$('cat').value;
	  
	  var fant=$('fant').value;
	   var fnew=$('date').value;
	   var eps=$('eps').value;
	   var id_cond=$('id_cond').value;
	   var id_doc=$('id_doc').value;
	   var id_condoc=$('id_condoc').value;	
		new Ajax.Updater(capa,'grabact.php?fant='+fant+'&fnew='+fnew+'&eps='+eps+'&id_cond='+id_cond+'&id_doc='+id_doc+'&id_condoc='+id_condoc+'&nrecib='+nrecib+'&cat='+cat,{asynchronous: true, method: 'get',evalScripts:true});
}

function grabactu(capa){
	  var id_tarj=$('tarjeta').value;
	   var fnew=$('fecha_new').value;
	   var fecha_ant=$('fecha_ant').value;
	   var id_cond=$('id_cond').value;
	   var movil=$('movil').value;
	    var docguia=$('docguia').value;
	   //alert(docguia);
		new Ajax.Updater(capa,'grabactutarjeta.php?id_tarj='+id_tarj+'&fnew='+fnew+'&fecha_ant='+fecha_ant+'&id_cond='+id_cond+'&movil='+movil+'&docguia='+docguia,{asynchronous: true, method: 'get',evalScripts:true});
}



function inserta_rango(){
var capa='graba';
var ini=$('ini').value;
var fin=$('fin').value;
var grupo=$('grupo').value;
var ngrupo=$('ngrupo').value;
new Ajax.Updater(capa,'rango.php?ini='+ini+'&fin='+fin+'&grupo='+grupo+'&ngrupo='+ngrupo,{asynchronous: true, method: 'get',evalScripts:true});
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
jQuery('#guardapl').removeAttr("disabled");

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
	  var factual=$('factual').value;
	  var mesori=forigen.substr(5,2);

          /////
           var contra=$('contra').value;
	
	  var doc=$('doc').value;
	   var nid=$('nid').value;
	  var dircontra=$('dircontra').value;
	  var telcontra=$('telcontra').value;
	  var npasajero=$('npasajero').value;
          var compa=$('compa').value;



	  if(factual!=mesori){
		  control=1
	  }
	  
	    // var contra=$('contra').value;
//	  var doc=$('doc').value;
//	  var nid=$('nid').value;
//	   var dircontra=$('dircontra').value;
//	  var telcontra=$('telcontra').value;
//	  var npasajero=$('npasajero').value;
	  
	 if(nplanilla=="")mensaje+="  - Numero de la Planilla\n";
	 if(corigen=="")mensaje+="  - Ciudad de Origen\n";
	 if(forigen=="")mensaje+="  - Fecha de Inicio\n";
	  if(cdestino=="")mensaje+="  - Ciudad de Destino\n";
	  if(fdestino=="")mensaje+="  - Fecha de Regrezo\n";
	 if(contra=="")mensaje+="  - Nombre del Contratante\n";
	 
	  if(doc=="")mensaje+="  - Tipo de Identificaci\xF3n\n";
	 if(nid=="")mensaje+="  - N\xFAmero de Identificaci\xF3n\n";
	 if(dircontra=="")mensaje+="  - Direcci\xf3n del Contratante\n";
	 // if(telcontra=="")mensaje+="  - Telefono del Contratante\n";
	  if(npasajero=="")mensaje+="  - N\xFAmero de Pasajeros\n";
        if(compa=="")mensaje+="  - Compañia de Seguros \n";

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
          var contra=$('contra').value;
	  var doc=$('doc').value;
	  var nid=$('nid').value;
	   var dircontra=$('dircontra').value;
	  var telcontra=$('telcontra').value;
	  var npasajero=$('npasajero').value;
           var compa=$('compa').value;
	  //alert (doc)
	  new Ajax.Updater(capa,'graba_planilla.php?nplanilla='+nplanilla+'&tarjeta='+tarjeta+'&corigen='+corigen+'&forigen='+forigen+'&cdestino='+cdestino+'&fdestino='+fdestino+'&idtarjeta='+idtarjeta+'&doc_cond='+doc_cond+'&contra='+contra+'&doc='+doc+'&nid='+nid+'&dircontra='+dircontra+'&telcontra='+telcontra+'&npasajero='+npasajero+'&compa='+compa,{asynchronous: true, method: 'get',evalScripts:true});
	   jQuery('#guardapl').attr("disabled", true);
}


function validan_planilla(capa){
	var nplanilla=$('nplanilla').value;
	var idgrupo=$('idgrupo').value;
	//alert (idgrupo)
	if(nplanilla!=''){
		new Ajax.Updater(capa,'validar_n_pl.php?nplanilla='+nplanilla+'&idgrupo='+idgrupo,{asynchronous: true, method: 'get',evalScripts:true});
	}
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

function liquida_planilla(id){
//	var idplanilla=$('id_plan_con'+i).value;
//	var n_planilla=$('n_plani_con'+i).value;
	new Ajax.Updater('liquida_planilla','liquida_planilla.php?idplanilla='+id,{asynchronous: true, method: 'get',evalScripts:true});
}

function actu_estado_diario(i){
var capa='novedad';
var id_nov=$('id_nov'+i).value;
var id_movil=$('id_movil'+i).value;
var plazo=$('plazo'+i).value;
new Ajax.Updater(capa,'actualiza_estado_diario.php?id_nov='+id_nov+'&movil='+id_movil+'&plazo='+plazo,{asynchronous: true, method: 'get',evalScripts:true});
}


function abrefrec(movil){
var capa='frecuencia';
//var id_movil=$('idmovil'+i).value;

new Ajax.Updater(capa,'asigna_frec.php?id_movil='+movil,{asynchronous: true, method: 'get',evalScripts:true});
}


function abre_sel_tarjeta(movil){
var capa='frecuencia';
//var id_movil=$('idmovil'+i).value;

new Ajax.Updater(capa,'asigna_tarjeta1042.php?id_movil='+movil,{asynchronous: true, method: 'get',evalScripts:true});
}


function grabar_asigna_frec(){
var capa='frecuencia';
var id_tarjeta=$('id_tarjeta').value;
//alert(id_tarjeta)
new Ajax.Updater(capa,'graba_asigna_frec.php?id_tarjeta='+id_tarjeta,{asynchronous: true, method: 'get',evalScripts:true});
}

function trim(myString)
{
return myString.replace(/^\s+/g,'').replace(/\s+$/g,'')
}

function grabar_baja_frec(movil){
var capa='bfrecuencia';
//var id_movil=$('idmovil'+i).value;
//alert(movil)
new Ajax.Updater(capa,'bajar_frec.php?id_tarjeta='+movil,{asynchronous: true, method: 'get',evalScripts:true});
}
function grabar_susp(movil){
var capa='suspende';
//var id_movil=$('idmovil'+i).value;
//alert(movil)
new Ajax.Updater(capa,'suspender.php?id_tarjeta='+movil,{asynchronous: true, method: 'get',evalScripts:true});
}

function graba_suspender(capa){
//var capa='suspende';
var mensaje="";
var id_tarjeta=$('id_tarjeta').value;
//a//lert(id_tarjeta)
var f_ini=$('f_ini').value;
var f_fin=$('f_fin').value;
var motivo=$('motivo').value;
  if(trim(motivo)=="")mensaje+="  - Motivo del 10-7\n";
	 if(f_fin=="")mensaje+="  - Fecha y hora final del 10-7\n"; 
	if (mensaje!="") {
	     alert("Atenci\xF3n, Faltan los siguientes campos por Diligenciar:\n\n"+mensaje);
	}else{

//alert(motivo)
new Ajax.Updater(capa,'graba_susp.php?id_tarjeta='+id_tarjeta+'&f_inicio='+f_ini+'&f_fin='+f_fin+'&motivo='+motivo,{asynchronous: true, method: 'get',evalScripts:true});
	}
}

function grabar_acci(movil){
var capa='accidente';
//var id_movil=$('idmovil'+i).value;
//alert(movil)
new Ajax.Updater(capa,'accidente.php?id_tarjeta='+movil,{asynchronous: true, method: 'get',evalScripts:true});
}


function graba_reporte1015(capa){
 var f_ini=$('f_inic').value;
	 var diracc=$('diracc').value;
	   var id_tipo_a=$('id_tipo_a').value;
	  var placa_otro=$('placa_otro').value;
	  var info_otro=$('info_otro').value;
	  var entidad=$('entidad').value;
var id_tarjeta=$('id_tarjetac').value;
var prop=$('prop').value;
var amb=$('amb').value;
var les=$('les').value;
var tras=$('tras').value;
var transito=$('transito').value;
var inforep=$('inforep').value;
new Ajax.Updater(capa,'graba_reporte1015.php?id_tarjeta='+id_tarjeta+'&f_inicio='+f_ini+'&diracc='+diracc+'&id_tipo_a='+id_tipo_a+'&placa_otro='+placa_otro+'&info_otro='+info_otro+'&entidad='+entidad+'&prop='+prop+'&amb='+amb+'&les='+les+'&tras='+tras+'&transito='+transito+'&inforep='+inforep,{asynchronous: true, method: 'get',evalScripts:true});
}

function valida_1042(){
	 var mensaje="";
	 
	 
	 var f_ini=$('f_inic').value;
	 var diracc=$('diracc').value;
	   var id_tipo_a=$('id_tipo_a').value;
	  var placa_otro=$('placa_otro').value;
	  var info_otro=$('info_otro').value;
	  var entidad=$('entidad').value;
	    
	 if(f_ini=="")mensaje+="  - Fecha y hora del 10-42\n";
	 if(diracc=="")mensaje+="  - Direccion de 10-42\n";
	 if(id_tipo_a=="")mensaje+="  - Tipo de 10-42\n";
	  if(placa_otro=="")mensaje+="  - Placa Otro Vehiculo\n";
	  if(info_otro=="")mensaje+="  - Informacion del otro Vehiculo \n";
	  if(entidad=="")mensaje+="  - Entidad  Atencion de Emergencia\n";
	 
	if (mensaje!="") {
	     alert("Atenci\xF3n, Faltan los siguientes campos por Diligenciar:\n\n"+mensaje);
	}else{
		
		
		graba_reporte1015('grabauto');
		
		
	 }
}


function grabar_descarte_ser(id_serv){
var capa='descarte';
//var id_movil=$('idmovil'+i).value;
//alert(movil)
new Ajax.Updater(capa,'descarte.php?id_serv='+id_serv,{asynchronous: false, method: 'get',evalScripts:true});

}

function grabar_desc_ser(){
	 var mensaje="";
var capa='graba_des';
var id_serv=$('id_ser').value;
var obse=$('observacion').value;
var obs=trim(obse)
//alert(movil)

 if(trim(obs)=="")mensaje+="  - Motivo del Descarte\n";
 if (mensaje!="") {
	     alert("Atenci\xF3n, Faltan los siguientes campos por Diligenciar:\n\n"+mensaje);
	}else{
new Ajax.Updater(capa,'graba_descarte_serv.php?id_serv='+id_serv+'&obs='+obs,{asynchronous: true, method: 'get',evalScripts:true});
jQuery('#descarte').dialog('close')
}

}

function carga_pto(control){

jQuery('#linea_at').val(control);
jQuery('#linea_servi').html(control);
}
function dir_pto(control){

jQuery('#direcci').val(control);
}

function grabar_ser(capa){
	 var mensaje="";
var linea_at=$('linea_at').value;
var detall=$('detall').value;
var direccio=$('direcci').value;
direcci=String(direccio);
//alert(direcci)
var tele=$('tele').value;
if(direcci=="")mensaje+="  - Direcci\xF3n del servicio\n";
if(linea_at=="")mensaje+="  - Linea de atencion del servicio\n";
 if (mensaje!="") {
	     alert("Atenci\xF3n, Faltan los siguientes campos por Diligenciar:\n\n"+mensaje);
	}else{

//alert(linea_at+detall+direcci+tele)
new Ajax.Updater(capa,'graba_serv.php?linea_at='+linea_at+'&detall='+detall+'&tele='+tele+'&direcci='+direcci,{asynchronous: true, method: 'get',evalScripts:true});
$('linea_at').value='FIJOS';
$('detall').value='';
$('direcci').value='';
$('tele').value='';
jQuery('#linea_servi').html('FIJOS');
	}
}

    function teclas(event) {
        tecla=(document.all) ? event.keyCode : event.which;
        if (tecla==13 && event.altKey) {
            grabar_ser('graba_ser')
        }
		
    }

function Entrar(e) 
{ 
   tecla = (document.all) ? e.keyCode : e.which; 
   if(tecla == 13)
   {
     // alert("Listo"); 
	   grabar_ser('graba_ser')
   } 
} 

function Entrar105(e) 
{ 
   tecla = (document.all) ? e.keyCode : e.which; 
   if(tecla == 13)
   {
     // alert("Listo");'graba_ser' 
	   valida105('grabamsj');
   } 
} 

function Entrarap(e) 
{ 
 

   tecla = (document.all) ? e.keyCode : e.which;
    if(tecla == 13)
   {
       var idmov=$('id_movil_nov').value;
	   var idserv=$('id_servi').value;
	   new Ajax.Updater('grabamsj','graba_ap.php?id_movil='+idmov+'&idserv='+idserv,{asynchronous: true, method: 'get',evalScripts:true});
  jQuery('#apropiacion').dialog('close');
  $('id_movil_nov').value='';
   }
	
}


function Entrarauto(e) 
{ 
 

   tecla = (document.all) ? e.keyCode : e.which;
    if(tecla == 13)
   {
       var idmov=$('id_movil_auto').value;
	   var idserv=$('idser').value;
	   var obs=$('observauto').value;
	  //alert(obs) 
	    var mensaje="";
      if(idmov=="")mensaje+="  - Movil\n";
      if(trim(obs)=="")mensaje+="  - Observcion\n";
      if (mensaje!="") {
	     alert("Atenci\xF3n, Faltan los siguientes campos por Diligenciar:\n\n"+mensaje);
	}else{
	   new Ajax.Updater('grabamsj','graba_serv_auto.php?id_movil='+idmov+'&idserv='+idserv+'&obs='+obs,{asynchronous: false, method: 'get',evalScripts:true});
  jQuery('#servauto').dialog('close');
  $('id_movil_auto').value='';
  $('observauto').value='';
   }
   }
}

function ubicafoco(){
$('direcci').focus();	
}

function valida105(capa){
	 var mensaje="";
var id_movil105=$('id_movil105').value;
var msj105=$('msj105').value;
msj105=String(msj105);
if(id_movil105=="")mensaje+="  - Movil\n";
if(msj105=="")mensaje+="  - Mensaje \n";
 if (mensaje!="") {
	     alert("Atenci\xF3n, Faltan los siguientes campos por Diligenciar:\n\n"+mensaje);
	}else{
		
		
//alert(linea_at+detall+direcci+tele)
new Ajax.Updater(capa,'graba_msj.php?msj='+msj105+'&id_movil='+id_movil105,{asynchronous: true, method: 'get',evalScripts:true});
	}
	
}

function graba_rev(id){
	new Ajax.Updater('grabamsj','actualiza_msj.php?idmsj='+id,{asynchronous: true, method: 'get',evalScripts:true});

}

function graba_nov(id){
	new Ajax.Updater('grabanov','actunovedad.php?idmsj='+id,{asynchronous: true, method: 'get',evalScripts:true});

}


function graba_des_serv(id){
	new Ajax.Updater('grabamsj','descarta_msj.php?idmsj='+id,{asynchronous: true, method: 'get',evalScripts:true});

}
	
	
function actualizatabla(capa){
	new Ajax.Updater(capa,'tablaexcel.php',{asynchronous: false, method: 'get',evalScripts:true});

}

function ser_asig(capa){
	new Ajax.Updater(capa,'serv_asignados.php',{asynchronous: false, method: 'get',evalScripts:true});

}



function validamovil(e,value,i) 
{ 
  
   var idmovil=$('idmovilasig'+i).value;
   var direc=$('direc'+i).value;
   var deta=$('deta'+i).value;
   var id_serv=$('id_serv'+i).value;
  
  tecla = (document.all) ? e.keyCode : e.which; 
   if(tecla == 13)
   {
  
   
    			 if(value!= ""){
        jQuery.ajax({
            type: "POST",
            url: "../panel_radio/valida_movil2.php",
            data: "movil="+value,
           // beforeSend: function(){
//             // $('#movil').html('verificando');
//            },
            success: function( respuesta ){
              if(respuesta == '0'){
              
				 new Ajax.Updater('destino','graba_mov.php?id_movil='+idmovil+'&id_serv='+id_serv+'&direccion='+direc+'&deta='+deta+'&i='+i,{asynchronous: true, method: 'get',evalScripts:true});
             } else{
            			
				alert("Movil No esta en Frecuencia")
				
			}	
            }
        });
		}else{
			
		alert('Indique un movil')	
			
		}
   } 
} 



function validamovil_asig(e,value,i) 
{ 
  
   var idmovil=$('idmovil_asig2'+i).value;
   var direc=$('direc_asig'+i).value;
   var deta=$('deta_asig'+i).value;
   var id_serv=$('id_serv_asig'+i).value;
  
  tecla = (document.all) ? e.keyCode : e.which; 
   if(tecla == 13)
   {
  
   
    			 if(value!= ""){
        jQuery.ajax({
            type: "POST",
            url: "../panel_radio/valida_movil2.php",
            data: "movil="+value,
           // beforeSend: function(){
//             // $('#movil').html('verificando');
//            },
            success: function( respuesta ){
              if(respuesta == '0'){
              
				 new Ajax.Updater('destino','graba_mov_asig.php?id_movil='+idmovil+'&id_serv='+id_serv+'&direccion='+direc+'&deta='+deta+'&i='+i,{asynchronous: true, method: 'get',evalScripts:true});
             } else{
            			
				alert("Movil No esta en Frecuencia")
				
			}	
            }
        });
		}else{
			
		alert('Indique un movil')	
			
		}
   } 
} 

function isset(variable_name) {
    try {
         if (typeof(eval(variable_name)) != 'undefined')
         if (eval(variable_name) != null)
         return true;
     } catch(e) { }
    return false;
   }


function actualiza_dir(e,i)
{
 var direc=$('direc'+i).value;
   var deta=$('deta'+i).value;
   var id_serv=$('id_serv'+i).value;
   var idmovil="";
   //alert(deta)
    tecla = (document.all) ? e.keyCode : e.which; 
   if(tecla == 13)
   {
    new Ajax.Updater('destino','graba_mov.php?id_movil='+idmovil+'&id_serv='+id_serv+'&direccion='+direc+'&deta='+deta+'&i='+i,{asynchronous: true, method: 'get',evalScripts:true});
   }
}
	
function actualiza_dir_asig(e,i)
{
 var direc=$('direc_asig'+i).value;
   var deta=$('deta_asig'+i).value;
   var id_serv=$('id_serv_asig'+i).value;
   var idmovil=$('idmovil_asig2'+i).value;
   //alert(deta)
    tecla = (document.all) ? e.keyCode : e.which; 
   if(tecla == 13)
   {
    new Ajax.Updater('destino','graba_mov_asig.php?id_movil='+idmovil+'&id_serv='+id_serv+'&direccion='+direc+'&deta='+deta+'&i='+i,{asynchronous: false, method: 'get',evalScripts:true});
   }
}
	
	
function valida_aux(capa)
{
 var aux=$('aux').value;
 var pasaux=$('pasaux').value;

 
    new Ajax.Updater(capa,'validaaux.php?aux='+aux+'&pasaux='+pasaux,{asynchronous: true, method: 'get',evalScripts:true});

}
function login_aux(capa)
{

    new Ajax.Updater(capa,'loginaux.php',{asynchronous: true, method: 'get',evalScripts:true});

}
function l_aux(capa)
{

    new Ajax.Updater(capa,'laux.php',{asynchronous: true, method: 'get',evalScripts:true});

}
function cambia_aux(capa)
{

    new Ajax.Updater(capa,'logoutaux.php',{asynchronous: true, method: 'get',evalScripts:true});

}
function abre_verpl(i,ani,capa){
	
	var idmovil=$('idmovil'+i).value;
	//alert(codigo+docu+condu);
new Ajax.Updater(capa,'hplanilla.php?idmovil='+idmovil+'&anio='+ani,{asynchronous: true, method: 'get',evalScripts:true});
}


function bajafoco(e) 
{ 
 

   tecla = (document.all) ? e.keyCode : e.which;
    if(tecla == 13)
   {
     $('observauto').focus(); 
   }
}

function imp(i){
	var idtarj=$('idtarj'+i).value;

	//var docu=$('doc'+i).value;
	//alert(doc);
	window.open('../../diarios/sart.php/sistemasart/pdf?ntarjeta='+idtarj,'miwin','width=700,height=500,scrollbars=yes');
	} 
	
