// JavaScript Document

/*function onTecla(e)
	{	var num = e?e.keyCode:event.keyCode;
	if (num ==65)
	{
		open("http://www.google.com.sv");
	}grabar_cuotaesp
	if (num ==66)
	{
		open("http://www.svcommunity.org");
	}
	if (num ==67)
	{
		open("http://www.todosv.com");
	}
	}
 
	document.onkeydown = onTecla;
	if(document.all)document.captureEvents(Event.KEYDOWN);	
*/


function trim(myString)
{
return myString.replace(/^\s+/g,'').replace(/\s+$/g,'')
}


//////////////////////////////nueva funcion

function grabar_cuotaesp(capa){
      var mensaje="";
	  var fini=$('fespe').value;
	  var ffin=$('fehasta').value;	
      var idmovi=$('id_movilesp').value;
	   var periodo=$('perio').value;
	 //
	 
	  if(fini=="")mensaje+="  - Fecha  Desde\n";
          if(ffin=="")mensaje+="  - Fecha  Hasta\n";
	if (mensaje!="") {
	     alert("Atencion, faltan los siguientes campos por llenar:\n\n"+mensaje);
	}else{
		//alert(ncuota)
		new Ajax.Updater(capa,'graba_cuotaesp.php?periodo='+periodo+'&fini='+fini+'&movil='+idmovi+'&ffin='+ffin,{asynchronous: false, method: 'get',evalScripts:true});
	}
}
/////////////////////////////
function grabar_contractual(capa,idperiodo){
	  //alert(capa+idperiodo)
		new Ajax.Updater(capa,'graba_valor.php?periodo='+idperiodo,{asynchronous: true, method: 'get',evalScripts:true});
}
 function imprimir(idmovi,peri,deta) {
		window.open('imprime_poliza.php?periodo='+peri+'&movil='+idmovi+'&deta='+deta,'miwin','width=600,height=500,scrollbars=yes');
		}

function reimprime_cuota(capa,idmovil,idperiodo){
	  //alert(capa+idperiodo)
new Ajax.Updater(capa,'recibos_cuota.php?periodo='+idperiodo+'&idmovi='+idmovil,{asynchronous: false, method: 'get',evalScripts:true});
}

function anula_recibo(capa,id_deta){
	
	  if(!confirm('Esta segur@ de Anular este Recibo?')){
				  return false
				  }else{
					new Ajax.Updater(capa,'graba_anularec.php?id_deta='+id_deta,{asynchronous: false, method: 'get',evalScripts:true});
}
					  
				  }


function grabar_contractual_mov(capa,idperiodo){
       var mensaje="";
	  var fini=$('finclu').value;	
      var ffin=$('vigen').value;
	  var vpoliza=$('vpoliza').value;
	   var idmovi=$('idmovi').value;
	 //alert(fini+ffin)
	  if(fini=="")mensaje+="  - Fecha de Inclucion\n";
	 if(ffin=="")mensaje+="  - Fecha de Vigencia\n";
	 if(trim(vpoliza)=="")mensaje+="  - Valor De la Poliza\n";
	 
	if (mensaje!="") {
	     alert("Atencion, faltan los siguientes campos por llenar:\n\n"+mensaje);
	}else{
		new Ajax.Updater(capa,'graba_valor_mov.php?periodo='+idperiodo+'&fini='+fini+'&ffin='+ffin+'&vpoliza='+vpoliza+'&idmovi='+idmovi,{asynchronous: true, method: 'get',evalScripts:true});
	}
}

function grabarexcluir(capa,idperiodo){
       var mensaje="";
	  var fini=$('fecha_inc').value;	
      	  var ffin=$('fecha_exc').value;
	  var vpoliza=$('valexclu').value;
	  var idmovi=$('idmovilexc').value;
	  //alert(fini+ffin)
	  if(fini=="")mensaje+="  - Fecha de Inclucion\n";
	  if(ffin=="")mensaje+="  - Fecha de Vigencia\n";
	  if(trim(vpoliza)=="")mensaje+="  - Valor De la Poliza\n";
	 
	if (mensaje!="") {
	     alert("Atencion, faltan los siguientes campos por llenar:\n\n"+mensaje);
	}else{
		new Ajax.Updater(capa,'graba_exclu.php?periodo='+idperiodo+'&fini='+fini+'&ffin='+ffin+'&vpoliza='+vpoliza+'&idmovi='+idmovi,{asynchronous: false, method: 'get',evalScripts:true});
	}
}


function grabar_cuota(capa,idperiodo){
      var mensaje="";
	  var fini=$('fecha_ini').value;	
      var ffin=$('fecha_fin').value;
	  var frc=$('fecha_rc').value;
	  var nrecibo=$('nrc').value;
	  var vcuota=$('vcuota').value;
	  var ncontra=$('ncontra').value;
	  var idmovi=$('idmovil').value;
	  var periodo=$('period').value;
	  var ncuota=$('ncuo').value;
	  var saldo=$('saldo').value;
	  var v_poliza=$('v_poliza').value;
	 //
	 
	  if(fini=="")mensaje+="  - Fecha  Desde\n";
	  if(ffin=="")mensaje+="  - Fecha Hasta\n";
	  if(trim(vcuota)=="")mensaje+="  - Valor De la Cuota\n";
	   if(frc=="")mensaje+="  - Fecha del Recibo de Caja\n";
	  if(trim(nrecibo)=="")mensaje+="  - Numero del Recibo de Caja\n";
	 
	if (mensaje!="") {
	     alert("Atencion, faltan los siguientes campos por llenar:\n\n"+mensaje);
	}else{
		//alert(ncuota)
		new Ajax.Updater(capa,'graba_cuota.php?periodo='+periodo+'&fini='+fini+'&ffin='+ffin+'&vcuota='+vcuota+'&idmovil='+idmovi+'&frc='+frc+'&nrecibo='+nrecibo+'&ncontra='+ncontra+'&ncuota='+ncuota+'&saldo='+saldo+'&v_poliza='+v_poliza,{asynchronous: false, method: 'get',evalScripts:true});
	}
}

function abre_cuota_contra(capa,idmov,ncontractual,perio){
	//alert(capa+idmov+ncontractual+perio)
new Ajax.Updater(capa,'liquida_cuota.php?periodo='+perio+'&movil='+idmov+'&contra='+ncontractual,{asynchronous: false, method: 'get',evalScripts:true});
}

function abre_exclu(capa,idmov,f_inclu,perio){
	  //alert(capa+idmov+ncontractual+perio)
new Ajax.Updater(capa,'liquida_excluir.php?periodo='+perio+'&movil='+idmov+'&f_inclu='+f_inclu,{asynchronous: false, method: 'get',evalScripts:true});
}

function abre_egreso(capa){
	  //alert(capa+idmov+ncontractual+perio)
new Ajax.Updater(capa,'comp_egreso.php',{asynchronous: false, method: 'get',evalScripts:true});
}

function exportapendi(capa){
	  //alert(capa+idmov+ncontractual+perio)
new Ajax.Updater(capa,'excelpendi.php',{asynchronous: false, method: 'get',evalScripts:true});
}

function grabar_excluir(capa){
       var mensaje="";
	  var fechaegre=$('fechaegre').value;	
      var valoregre=$('valoregre').value;
	  var concegre=$('concegre').value;
	   var negreso=$('negreso').value;
	  var pagadoa=$('pagadoa').value;
	 //  var idmovi=$('idmovilexc').value;
	 //alert(fini+ffin)
	  if(fechaegre=="")mensaje+="  - Fecha del Comprobante\n";
	 if(trim(valoregre)=="")mensaje+="  - Valor del Comprobante\n";
	 if(trim(concegre)=="")mensaje+="  - Concepto del Comprobante\n";
	 if(trim(pagadoa)=="")mensaje+="  - Pagado a\n";
	if (mensaje!="") {
	     alert("Atencion, faltan los siguientes campos por llenar:\n\n"+mensaje);
	}else{
		new Ajax.Updater(capa,'graba_egreso.php?fechaegre='+fechaegre+'&valoregre='+valoregre+'&concegre='+concegre+'&negreso='+negreso+'&pagadoa='+pagadoa,{asynchronous: false, method: 'get',evalScripts:true});
	}
}

function genera_rep(capa){
	  var fechainimov=$('fechainimov').value;	
      var fechafinmov=$('fechafinmov').value;
	  //alert(capa+idmov+ncontractual+perio)
new Ajax.Updater(capa,'reporte_caja.php?fechainimov='+fechainimov+'&fechafinmov='+fechafinmov,{asynchronous: false, method: 'get',evalScripts:true});
}


function detectarCarga(){
document.getElementById("cargando").style.display="none";
}


function iniciacarga(){
document.getElementById("cargando").style.display="block";
}
/*function calculav(){
var fini=$('finclu').value;	
var ffin=$('vigen').value;	

jQuery('#vpoliza').val(240000)

}*/
function strtotime (str, now) {
    // Convert string representation of date and time to a timestamp  
    // 
    // version: 1109.2015
    // discuss at: http://phpjs.org/functions/strtotime    // +   original by: Caio Ariede (http://caioariede.com)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +      input by: David
    // +   improved by: Caio Ariede (http://caioariede.com)
    // +   improved by: Brett Zamir (http://brett-zamir.me)    // +   bugfixed by: Wagner B. Soares
    // +   bugfixed by: Artur Tchernychev
    // %        note 1: Examples all have a fixed timestamp to prevent tests to fail because of variable time(zones)
    // *     example 1: strtotime('+1 day', 1129633200);
    // *     returns 1: 1129719600    // *     example 2: strtotime('+1 week 2 days 4 hours 2 seconds', 1129633200);
    // *     returns 2: 1130425202
    // *     example 3: strtotime('last month', 1129633200);
    // *     returns 3: 1127041200
    // *     example 4: strtotime('2009-05-04 08:30:00');    // *     returns 4: 1241418600
    var i, match, s, strTmp = '',
        parse = '';
 
    strTmp = str;    strTmp = strTmp.replace(/\s{2,}|^\s|\s$/g, ' '); // unecessary spaces
    strTmp = strTmp.replace(/[\t\r\n]/g, ''); // unecessary chars
    if (strTmp == 'now') {
        return (new Date()).getTime() / 1000; // Return seconds, not milli-seconds
    } else if (!isNaN(parse = Date.parse(strTmp))) {        return (parse / 1000);
    } else if (now) {
        now = new Date(now * 1000); // Accept PHP-style seconds
    } else {
        now = new Date();    }
 
    strTmp = strTmp.toLowerCase();
 
    var __is = {        day: {
            'sun': 0,
            'mon': 1,
            'tue': 2,
            'wed': 3,            'thu': 4,
            'fri': 5,
            'sat': 6
        },
        mon: {            'jan': 0,
            'feb': 1,
            'mar': 2,
            'apr': 3,
            'may': 4,            'jun': 5,
            'jul': 6,
            'aug': 7,
            'sep': 8,
            'oct': 9,            'nov': 10,
            'dec': 11
        }
    };
     var process = function (m) {
        var ago = (m[2] && m[2] == 'ago');
        var num = (num = m[0] == 'last' ? -1 : 1) * (ago ? -1 : 1);
 
        switch (m[0]) {        case 'last':
        case 'next':
            switch (m[1].substring(0, 3)) {
            case 'yea':
                now.setFullYear(now.getFullYear() + num);                break;
            case 'mon':
                now.setMonth(now.getMonth() + num);
                break;
            case 'wee':                now.setDate(now.getDate() + (num * 7));
                break;
            case 'day':
                now.setDate(now.getDate() + num);
                break;            case 'hou':
                now.setHours(now.getHours() + num);
                break;
            case 'min':
                now.setMinutes(now.getMinutes() + num);                break;
            case 'sec':
                now.setSeconds(now.getSeconds() + num);
                break;
            default:                var day;
                if (typeof(day = __is.day[m[1].substring(0, 3)]) != 'undefined') {
                    var diff = day - now.getDay();
                    if (diff == 0) {
                        diff = 7 * num;                    } else if (diff > 0) {
                        if (m[0] == 'last') {
                            diff -= 7;
                        }
                    } else {                        if (m[0] == 'next') {
                            diff += 7;
                        }
                    }
                    now.setDate(now.getDate() + diff);                }
            }
            break;
 
        default:            if (/\d+/.test(m[0])) {
                num *= parseInt(m[0], 10);
 
                switch (m[1].substring(0, 3)) {
                case 'yea':                    now.setFullYear(now.getFullYear() + num);
                    break;
                case 'mon':
                    now.setMonth(now.getMonth() + num);
                    break;                case 'wee':
                    now.setDate(now.getDate() + (num * 7));
                    break;
                case 'day':
                    now.setDate(now.getDate() + num);                    break;
                case 'hou':
                    now.setHours(now.getHours() + num);
                    break;
                case 'min':                    now.setMinutes(now.getMinutes() + num);
                    break;
                case 'sec':
                    now.setSeconds(now.getSeconds() + num);
                    break;                }
            } else {
                return false;
            }
            break;        }
        return true;
    };
 
    match = strTmp.match(/^(\d{2,4}-\d{2}-\d{2})(?:\s(\d{1,2}:\d{2}(:\d{2})?)?(?:\.(\d+))?)?$/);    if (match != null) {
        if (!match[2]) {
            match[2] = '00:00:00';
        } else if (!match[3]) {
            match[2] += ':00';        }
 
        s = match[1].split(/-/g);
 
        for (i in __is.mon) {            if (__is.mon[i] == s[1] - 1) {
                s[1] = i;
            }
        }
        s[0] = parseInt(s[0], 10); 
        s[0] = (s[0] >= 0 && s[0] <= 69) ? '20' + (s[0] < 10 ? '0' + s[0] : s[0] + '') : (s[0] >= 70 && s[0] <= 99) ? '19' + s[0] : s[0] + '';
        return parseInt(this.strtotime(s[2] + ' ' + s[1] + ' ' + s[0] + ' ' + match[2]) + (match[4] ? match[4] / 1000 : ''), 10);
    }
     var regex = '([+-]?\\d+\\s' + '(years?|months?|weeks?|days?|hours?|min|minutes?|sec|seconds?' + '|sun\\.?|sunday|mon\\.?|monday|tue\\.?|tuesday|wed\\.?|wednesday' + '|thu\\.?|thursday|fri\\.?|friday|sat\\.?|saturday)' + '|(last|next)\\s' + '(years?|months?|weeks?|days?|hours?|min|minutes?|sec|seconds?' + '|sun\\.?|sunday|mon\\.?|monday|tue\\.?|tuesday|wed\\.?|wednesday' + '|thu\\.?|thursday|fri\\.?|friday|sat\\.?|saturday))' + '(\\sago)?';
 
    match = strTmp.match(new RegExp(regex, 'gi')); // Brett: seems should be case insensitive per docs, so added 'i'
    if (match == null) {
        return false;    }
 
    for (i = 0; i < match.length; i++) {
        if (!process(match[i].split(' '))) {
            return false;        }
    }
 
    return (now.getTime() / 1000);
}


///////

function recal(date1,date2){
	 var div=[];
        div["secs"]=1000;
        div["mins"]=1000*60;
        div["hours"]=1000*60*60;
        div["days"]=1000*60*60*24;
       var trn=[];
        trn["secs"]="segundos";
        trn["mins"]="minutos";
        trn["hours"]="horas";
        trn["days"]="d�as"; 
    var re=/([\d]+)\/([\d]+)\/([\d]+)/;
    var data1=date1;
    var data2=date2;

    if(data1 && data2){
        var year=parseInt(data1.substring(0,4),10); 
        var month=parseInt(data1.substring(5,7),10); 
        var date=parseInt(data1.substring(8,10),10); 
        
        var d1=new Date(year, month, date, 0, 0, 0, 0);
        //var d1=new Date(month+"/"+date+"/"+year+" 00:00:00");

          var year=parseInt(data2.substring(0,4),10); 
        var month=parseInt(data2.substring(5,7),10); 
        var date=parseInt(data2.substring(8,10),10); 
        
        var d2=new Date(year, month, date, 0, 0, 0, 0);
        //var d2=new Date(month+"/"+date+"/"+year+" 00:00:00");
        
        var sel='days';
        var mea=div[ sel ];
        //var t1=d1.getTime();
        //var t2=d2.getTime();
        var t1=d1.getTime();
        var t2=d2.getTime();
        var t3=d1-d2;
            t3= parseInt((""+t3).replace("-",""))/mea;
            
      return  dias=t3 ;
	  // alert(dias)
    }
}

function addCommas(nStr){
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}
////
	
function calcdia(valorp){
	 //date1=f2;
 	 var date1=$('vigen').value;	
	 var date2=$('finclu').value;	
	/* var s = strtotime(date1)-strtotime(date2);
	 var d = parseInt(s/86400);
	 s -= d*86400;
	var  h = parseInt(s/3600);
	 s -= h*3600;
	var m = parseInt(s/60);
	 s -= m*60;
	// dif= ((d*24)+h).hrs." ".m."min";
	 dif2= d;*/
	 dif2=recal(date1,date2);
	 var valordia=valorp/365;
	 var original=parseFloat(valordia*dif2);


     var valorpoli=Math.round(original*1)/1 ;
	 
	 jQuery('#vpoliza').val(valorpoli)
}	


function calcdia2(valorp,date1,date2){
	 //date1=f2;
 	// var date1=$('vigen').value;	
	// var date2=$('finclu').value;	
	// var s = strtotime(date1)-strtotime(date2);
//	 var d = parseInt(s/86400);
//	 s -= d*86400;
//	var  h = parseInt(s/3600);
//	 s -= h*3600;
//	var m = parseInt(s/60);
//	 s -= m*60;
//	// dif= ((d*24)+h).hrs." ".m."min";
//	 dif2= d;
	 dif2=recal(date1,date2)
	 var restante=dif2
	 var valordia=valorp/365;
	 var original=parseFloat(valordia*restante);


     return valorpoli=Math.round(original*1)/1 ;
	 
	 //jQuery('#vpoliza').val(valorpoli)
}	




 function dar_formato(num){  
 var cadena = ""; var aux;  
 var cont = 1,m,k;  
 if(num<0) aux=1; else aux=0;  
num=num.toString();  
 for(m=num.length-1; m>=0; m--){  
  cadena = num.charAt(m) + cadena;  
  if(cont%3 == 0 && m >aux)  cadena = "." + cadena; else cadena = cadena;  
  if(cont== 3) cont = 1; else cont++;  
 }  
 cadena = cadena.replace(/.,/,",");   
 return cadena;  
 }


function calculasaldo(valorp){
	var vcuota=$('vcuota').value;
	var saldo=valorp-vcuota;
	//alert(saldo)
	jQuery('#nsaldo').html('$ '+dar_formato(saldo))
	
}

function calculaexclu(valorp,gpapel,date2,date1,valordebe){
	//alert(valorp)
	var poli=calcdia2(valorp,date1,date2)
	//var vcuota=$('vcuota').value;
	if(valordebe>0){
	var saldodev=valordebe-(parseInt(poli) + parseInt(gpapel));
	}else{
    var saldodev=valorp-(parseInt(poli) + parseInt(gpapel));
	}
	//alert(saldodev)
	var diasr=recal(date1,date2)
	 var restante=diasr
	jQuery('#vdev').html('$ '+dar_formato(saldodev))
	jQuery('#diasr').html(restante)
	jQuery('#valexclu').val(restante)
}

function calculaffin(saldo,fin,fno){
	var vcuota=$('vcuota').value;
	//var saldo=valorp-vcuota;
if(vcuota>=saldo){
	//alert(fin)
jQuery('#fecha_fin').val(fin)

}else{
jQuery('#fecha_fin').val(fno)

}
	//jQuery('#nsaldo').html('$ '+dar_formato(saldo))
	
}

