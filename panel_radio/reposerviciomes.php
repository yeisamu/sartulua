<?php
$mes=$_REQUEST['mes'];
$anio=$_REQUEST['anio'];
$meses=array('ENERO'=>1,'FEBRERO'=>2,'MARZO'=>3,'ABRIL'=>4,'MAYO'=>5,'JUNIO'=>6,'JULIO'=>7,'AGOSTO'=>8,'SEPTIEMBRE'=>9,'OCTUBRE'=>10,'NOVIEMBRE'=>11,'DICIEMBRE'=>12);
$vmes=$meses[$mes];
$dias=date("d",(mktime(0,0,0,$meses[$mes]+1,1,$anio)-1));
?>
<script type="text/javascript"> 
	
  /*  $.jgrid.no_legacy_api = true;
    $.jgrid.useJSON = true;*/
   jQuery.noConflict();
	jQuery(document).ready(function(){ 

//////////grilla servicio asignado
var lastSel;
jQuery("#crudsasig").jqGrid({ 
     scrollrows : true, 
	 url:'gridrepservmes.php?anio=<?php echo $ani=$_REQUEST['anio'];?>&mes=<?php echo $vmes;?>',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['','Telefono','Linea','Direccion','Detalle Servicio','Fecha Servicio','Movil','Movil 2','Conductor ','Usuario','estado','observacion']
	  , colModel :[
	 	  
	  {
	   name:'id_ser'
		,index:'id_ser'
		//,width:55
		,align:'center'
		,editable:false
		,hidden:true
		
		
	
		
	},{	
		name:'telefono'
		,index:'telefono'
		,width:93
		,hidden:false
		,editrules:{edithidden:true,required:false}
		,editable:false
		,search:true
		,sortable:false
	},{	
	name:'linea'
		,index:'linea'
		,width:93
		,hidden:false
		,editrules:{edithidden:true,required:false}
		,editable:false
		,search:true
		,sortable:false
			
		
	},{	
	
	
		 name:'direccion'
		,index:'direccion'
		,width:300
		//,align:'center'
		,editable:true
		,search:true
		,sortable:false
		
	},{	
	
		 name:'detalle_serv'
		,index:'detalle_serv'
		,width:160
		,sortable:false
		//,align:'center'
		//,hidden:true
		,editrules:{edithidden:true}
		//,editoptions:{value:'N/A'}
		//,edittype:'textarea'
		,editable:true
		,search:true
	},{	
	
	
		 name:'fecha_reg'
		,index:'fecha_reg'
		,width:140
		//,align:'center'
		,formatoptions:{srcformat:"Y-m-d H:i:s",newformat:"d-m-Y h:i A"}
		,formatter:"date"
		,editable:true
		,search:true
		,sortable:false
			
	},{	

	  name:'id_movil'
		,index:'id_movil'
		,width:60
		,align:'center'
		,editable:true
		,search:true
			 ,sortable:false
	,hidedlg:true
	//	,editrules:{custom:true,custom_func:validamovil}
		,editoptions:{
		 
		dataInit:function(el){jQuery(el).autocomplete({
			source: "selecmovil.php",
			 select: function(event, ui) {
                  }
		});} }
		
		
	},{	
	  name:'id_movil2'
		,index:'id_movil2'
		,width:60
		,align:'center'
		,editable:true
		,sortable:false
		,search:true
		,hidedlg:true
	//	,editrules:{custom:true,custom_func:validamovil}
		,editoptions:{
		 
		dataInit:function(el){jQuery(el).autocomplete({
			source: "selecmovil.php",
			 select: function(event, ui) {
                  }
		});} }
},{	

	 name:'nombres'
		,index:'nombres'
		,width:210
		//,align:'center'
		,hidden:false
		,sortable:false
		
},{	

	 name:'usuario'
		,index:'usuario'
		,width:80
		//,align:'center'
		,hidden:false
		,sortable:false
		},{	

	 name:'estado'
		,index:'estado'
		,width:80
		//,align:'center'
		,stype:'select',
		 search: true, 
		 searchoptions: {sopt: ['eq','ne'], dataUrl: 
	 'lista.php?tb=servicio_h&cid=estado&cd=estado' }
		,hidden:false
		,sortable:false
			},{	

	 name:'observacion'
		,index:'observacion'
		,width:150
		//,align:'center'
		,hidden:false
		,sortable:false
 /*},{	
	 name:'acc'
		,index:'acc'
		,width:130
		//,align:'center'
		,sortable:false
			,search:false*/
	}
	
	 
	],
	   
	   pager: jQuery('#pcrudsasig'),
    rowNum:100,
    rowList:[100,200,300,1000,20000,50000],
	height:'auto',
	width:'auto',
    sortname: 'fecha_reg desc,id_ser',
    sortorder: "desc",
   viewrecords: true,
     caption: 'Servicios Asignados',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},	
	   editurl: 'gridrepserv.php'// this is dummy existing url 
		
		 });
		 
		 
		 jQuery("#crudsasig").jqGrid('navGrid','#pcrudsasig',{edit:false,add:false,del:false,view:true,search:false,reload:false},{reloadAfterSubmit:true,closeAfterEdit :true,closeOnEscape:true},{reloadAfterSubmit:true,closeOnEscape:true,closeAfterAdd : true},{closeOnEscape:true}).navButtonAdd('#pcrudsasig',{
                                caption:"Exportar", 
                                buttonicon:"ui-icon-calculator", 
                                onClickButton: function(){ 
                                  exportExcel();
                                }, 
                                position:"last"
                            });
							
							
function exportExcel()
        {
            var mya=new Array();
            mya=jQuery("#crudsasig").getDataIDs();  // Get All IDs
            var data=jQuery("#crudsasig").getRowData(mya[0]);     // Get First row to get the labels
            var colNames=new Array(); 
            var ii=0;
            for (var i in data){colNames[ii++]=i;}    // capture col names
            var html="";
            for(i=0;i<mya.length;i++)
                {
                data=jQuery("#crudsasig").getRowData(mya[i]); // get each row
                for(j=0;j<colNames.length;j++)
                    {
                    html=html+data[colNames[j]]+"\t"; // output each column as tab delimited
                    }
                html=html+"\n";  // output each row with end of line

                }
            html=html+"\n";  // end of line at the end
            document.forms[0].csvBuffer.value=html;
            document.forms[0].method='POST';
            document.forms[0].action='../gesdocs/csvExport.php';  // send it to server which will open this contents in excel file
            document.forms[0].target='_blank';
            document.forms[0].submit();
        }							
	  
		 jQuery("#crudsasig").jqGrid('filterToolbar');
		 
		 
		 

});					
					

	//	 });
    </script>

<span class="Estilo1">Servicios Atendidos</span>
<table align="center" id="crudsasig"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrudsasig" align="center"></div>


<form method="post" action="../gesdocs/csvExport.php">
    <input type="hidden" name="csvBuffer" id="csvBuffer" value="" />
</form>