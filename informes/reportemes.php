<?php
$mes=$_REQUEST['mes'];
$anio=$_REQUEST['anio'];
$meses=array('ENERO'=>1,'FEBRERO'=>2,'MARZO'=>3,'ABRIL'=>4,'MAYO'=>5,'JUNIO'=>6,'JULIO'=>7,'AGOSTO'=>8,'SEPTIEMBRE'=>9,'OCTUBRE'=>10,'NOVIEMBRE'=>11,'DICIEMBRE'=>12);
$vmes=$meses[$mes];
$dias=date("d",(mktime(0,0,0,$meses[$mes]+1,1,$anio)-1));
//echo $mesac=date('Y-m-d');
?>
<table id="list1"></table>
<div id="pager1"></div>
<form method="post" action="../gesdocs/csvExport.php">
    <input type="hidden" name="csvBuffer" id="csvBuffer" value="" />
</form>
<script type="text/javascript"> 
jQuery().ready(function (){

 jQuery("#list1").jqGrid({
        url: "gridreportedia.php?q=1&anio=<?php echo $ani=$_REQUEST['anio'];?>&mes=<?php echo $vmes;?>",
        datatype: "json",
        height: "auto",
        pager: false,
       // loadui: "disable",
        colNames: ['Linea','',<?php for($dia=1; $dia<=$dias;$dia++){echo "'".$dia."',";}?>'Total','Estado'],
        colModel: [
            {name: "linea",index:'linea',width:1,hidden:false, width:150
			},{
		 name:'year(fecha_reg)'
		,index:'year(fecha_reg)'
		,width:55
	
		//,search:true
		//colu
		},{
		<?php for($dia=1; $dia<=$dias;$dia++){echo "name:".$dia.",index:".$dia.",width:30,align:'center',editable:true,sorttype:'float',formatter:'integer',summaryType:'sum'},{";
}?>

		name: "total", width:60, resizable: false, sortable:false
		,sorttype:"float", formatter:"integer", summaryType:'sum'
		},{
		name: "estado", width:150, resizable: false, sortable:false
    	,stype:'select',
		 search: true, 
		 searchoptions: {sopt: ['eq','ne'], dataUrl: 
	 'lista.php?tb=servicio&cid=estado&cd=estado' }
		}
            
        ],
       pager: jQuery('#pager1'),
    rowNum:100,
   rowList:[10,20,30],
	height:'auto',
	width:'auto',
    sortname: 'id_linea',
    sortorder: "asc",
	grouping:true, 
	groupingView : { 
	groupField : ['year(fecha_reg)'], 
	groupColumnShow : [true], 
	groupText : ['<b>{0}</b>'], 
	groupCollapse : false, 
	groupOrder: ['asc'], 
	groupSummary : [true], 
	groupDataSorted : true}, 
	//footerrow: true, 
	userDataOnFooter: true,
     caption: 'Reporte de Servicios Por Dia',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		}
		
//		loadComplete: function(){
//				setTimeout(function(){jQuery('#list1').trigger('reloadGrid')},40000)
//				}
//		
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
		  
      
		  
});

</script>