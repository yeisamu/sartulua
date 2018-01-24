<?php
$ani=$_REQUEST['anio'];
?>
<table id="list1"></table>
<div id="pager1"></div>

<form method="post" action="../gesdocs/csvExport.php">
    <input type="hidden" name="csvBuffer" id="csvBuffer" value="" />
</form>
<div id="pl" title="Historico de planillas"></div>
<script type="text/javascript"> 
jQuery().ready(function (){

 jQuery("#list1").jqGrid({
        url: "gridreportemesp.php?q=1&anio=<?php echo $ani=$_REQUEST['anio'];?>",
        datatype: "json",
        height: "auto",
        pager: false,
       // loadui: "disable",
        colNames: ["id_movil",'','ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE','Total','Grupo','Planilla'],
        colModel: [
            {name: "id_movil",index:'id_movil',width:1,hidden:false, width:65,align:'center'
			},{
		 name:'year(fecha)'
		,index:'year(fecha)'
		,width:35
	 ,hidden:true
		,search:false
			},{
		 name:'ENERO'
		,index:'ENERO'
		,width:55
	,align:'center'
		,editable:true
	,sorttype:"float", formatter:"integer", summaryType:'sum'
	,search:false
		//,search:true
					},{
		 name:'FEBRERO'
		,index:'FEBRERO'
		,width:70
		,align:'center'
		,editable:true
	,sorttype:"float", formatter:"integer", summaryType:'sum'
	,search:false
		//,search:true
         			},{
		 name:'MARZO'
		,index:'MARZO'
		,width:55
		,align:'center'
		,editable:true
	,sorttype:"float", formatter:"integer", summaryType:'sum'
	,search:false
		//,search:true
        			},{
		 name:'ABRIL'
		,index:'ABRIL'
		,width:55
		,align:'center'
		,editable:true
		,search:false
		//,search:true
		,sorttype:"float", formatter:"integer", summaryType:'sum'
			},{
		 name:'MAYO'
		,index:'MAYO'
		,width:55
		,align:'center'
		,editable:true
         ,search:false
		//,search:true
,sorttype:"float", formatter:"integer", summaryType:'sum'
			},{
		 name:'JUNIO'
		,index:'JUNIO'
		,width:55
		,align:'center'
		,editable:true
	  ,sorttype:"float", formatter:"integer", summaryType:'sum'
		//,search:true
,search:false
			},{
		 name:'JULIO'
		,index:'JULIO'
		,width:55
		,align:'center'
		,editable:true
	,search:false
		//,search:true
,sorttype:"float", formatter:"integer", summaryType:'sum'
			},{
		 name:'AGOSTO'
		,index:'AGOSTO'
		,width:65
		,align:'center'
		,editable:true
	,search:false
		//,search:true
,sorttype:"float", formatter:"integer", summaryType:'sum'
			},{
		 name:'SEPTIEMBRE'
		,index:'SEPTIEMBRE'
		,width:75
		,align:'center'
		,editable:true
		,sorttype:"float", formatter:"integer", summaryType:'sum'
		//,search:true
,search:false
			},{
		 name:'OCTUBRE'
		,index:'OCTUBRE'
		,width:65
		,align:'center'
		,editable:true
,sorttype:"float", formatter:"integer", summaryType:'sum'
		//,search:true
,search:false
			},{
		 name:'NOVIEMBRE'
		,index:'NOVIEMBRE'
		,width:75
		,align:'center'
		,editable:true
		,sorttype:"float", formatter:"integer", summaryType:'sum'
,search:false
			},{
		 name:'DICIEMBRE'
		,index:'DICIEMBRE'
		,width:75
		,align:'center'
		,editable:true
		,sorttype:"float", formatter:"integer", summaryType:'sum'
		,search:false
},{
		name: "total", width:60, resizable: false, sortable:false,align:'center'
		,sorttype:"float", formatter:"integer", summaryType:'sum'
		,search:false
		},{
		 name:'grupo'
		,index:'grupo'
		,width:50
		,align:'center'
		,editable:true
		//,sorttype:"float", formatter:"integer", summaryType:'sum'
		//,search:true
},{ 
		name:'oper',index:'oper',align:'center', width:65,sortable:false,search:false		
		}
            
        ],
       pager: jQuery('#pager1'),
    rowNum:260,
   rowList:[10,200,300,400],
	height:'auto',
	width:'auto',
    sortname: 'id_movil',
	 // viewrecords: true,
    sortorder: "asc",
	grouping:true, 
	groupingView : { 
	groupField : ['year(fecha)'], 
	groupColumnShow : [true], 
	groupText : ['<b>{0}</b>'], 
	groupCollapse : false, 
	groupOrder: ['asc'], 
	groupSummary : [true], 
	groupDataSorted : true}, 
	//footerrow: true, 
	userDataOnFooter: true,
     caption: 'Reporte de Planillas Por mes'
	 ,loadComplete: function(){
		var ids = jQuery("#list1").getDataIDs();
		for(var i=0;i<ids.length;i++){
		   //  var dato = record[i];
			var cl = ids[i];
			
			 var rowData = jQuery(this).getRowData(cl);
			  var idmov= rowData['id_movil']; 
             var ani= rowData['year(fecha)'];
			 var veri=idmov;
			 //<input  type='button' value='Ver' onclick=abre_verpl("+i+","+ani+",'pl');jQuery('#pl').dialog('open'); />
	be = "<a id='des_asig' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onclick=abre_verpl("+i+","+ani+",'pl');jQuery('#pl').dialog('open');;>Ver<span class='ui-icon ui-icon-circle-plus'></span></a>";
	co = "<input  id='idmovil"+i+"' type='hidden' value="+veri+" />"; 
			jQuery("#list1").setRowData(ids[i],{oper:be+co})
			
		}	
	},
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		}
		/*,
		loadComplete: function(){
				setTimeout(function(){jQuery('#list1').trigger('reloadGrid')},40000)
				}
		*/
		//jQuery('#crud').editRow("+cl+"); 
	
	
	    ,editurl: 'gridreportemes.php?q=1&anio=<?php echo $ani=$_REQUEST['anio'];?>'// this is dummy existing url 
		
		 });
		 
		 jQuery("#list1").jqGrid('navGrid','#pager1',{search:true,edit:false,add:false,del:false},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true}).navButtonAdd('#pager1',{
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
            mya=jQuery("#list1").getDataIDs();  // Get All IDs
            var data=jQuery("#list1").getRowData(mya[0]);     // Get First row to get the labels
            var colNames=new Array(); 
            var ii=0;
			var html="";
            for (var i in data){colNames[ii++]=i;html=html+i+"\t";}    // capture col names
           html=html+"\n";
            for(i=0;i<mya.length;i++)
                {
                data=jQuery("#list1").getRowData(mya[i]); // get each row
                for(j=0;j<colNames.length;j++)
                    {
                    html=html+data[colNames[j]]+"\t"; // output each column as tab delimited
                    }
                html=html+"\n";  // output each row with end of line

                }
            html=html+"\n";   // end of line at the end
            document.forms[0].csvBuffer.value=html;
            document.forms[0].method='POST';
            document.forms[0].action='../gesdocs/csvExport.php';  // send it to server which will open this contents in excel file
            document.forms[0].target='_blank';
            document.forms[0].submit();
        }							
	  
		 

		 
		 
jQuery("#list1").jqGrid('filterToolbar');	
		  
 jQuery('#pl').dialog({autoOpen: false, modal:true,width:450,height:500,});     
		  
});

</script>