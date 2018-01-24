<?php
session_start();
 include('../inc/libreria.php');
 $link=conectarse();
  $id_login = $_SESSION['id_usr'];
 $ani=$_REQUEST['anio'];
 $seldetalle=mysql_query("SELECT distinct `ncuota` FROM `detalle_contra` WHERE `periodo`= '$ani'");
 $seldetalle1=mysql_query("SELECT distinct `ncuota` FROM `detalle_contra` WHERE `periodo`= '$ani'");
 
 $conadmin=mysql_query("SELECT `admin` FROM `acc_usuario` WHERE `id_usr` =$id_login");
 $permiso=mysql_result($conadmin,0,admin);
		 $y=1;
          $z=1;
?>
<script type="text/javascript">
	
  /*  $.jgrid.no_legacy_api = true;
    $.jgrid.useJSON = true;*/
jQuery.noConflict();
	jQuery(document).ready(function(){ 


	/////reporte de diarios
	jQuery("#crud").jqGrid({ url:'gridpago.php?q=1&anio=<?php echo $ani=$_REQUEST['anio'];?>',
	 datatype: "json", 
	  mtype: 'GET',
	  colNames:['Accion','Saldo Ant','Saldo','Movil','Placa','Propietario','Apellido','D.I.','Clase','Direccion','Telefono','Servicio','Modelo','Marca','Motor','Chasis','Linea','Tipo','Color','Grupo','F. Inclucion','Vigencia','Dias','V/R RCC','',<?php  while($filadeta = mysql_fetch_array($seldetalle1,MYSQL_ASSOC)) {if($z==1){$cuota="Inicial";}else{ $indi=($z-1);$cuota="Cuota ".$indi; } echo "'# R.C','".$cuota."',"; $z++; } ?>'Saldo']
	  , colModel :[
	 	  
	  {
	name:'oper'
		,index:'oper'
		,width:200
		//,align:'right'
		,search:false	
		,editable:false	
		 ,sortable:false
	},{
name:'saldoant'
		,index:'saldoant'
		,width:80
		//,align:'right'
		,editable:false	
       ,formatter:'currency'
		,formatoptions:{decimalSeparator:".",thousandsSeparator:",",decimalPlaces:0,prefix:"$"}
      ,sortable:false
	,search:false
	 ,summaryType:'sum'
		},{
name:'saldo1'
		,index:'saldo1'
		,width:80
		//,align:'right'
		,editable:false	
		,search:false
     /*  ,formatter:'currency'
		,formatoptions:{decimalSeparator:".",thousandsSeparator:",",decimalPlaces:0,prefix:"$"}
      ,sortable:false
	,search:false
	 ,summaryType:'sum'*/
		},{
	  name:'id_movil'
		,index:'id_movil'
		,width:60
		,align:'center'
		,editable:true
                 ,editoptions: { size: 10, readonly: 'readonly'} 
		,summaryType:'count', summaryTpl : '({0}) total'
                 ,key:true    
		},{	
		
	  name:'placa'
		,index:'placa'
		,width:60
		//,align:'center'
		,editable:false
		
		},{
			name:'nombre'
		,index:'nombre'
		,width:80
		//,align:'center'
		,editable:false
	 // ,editrules:{number:true}
	 },{
			name:'apellidos'
		,index:'apellidos'
		,width:80
		//,align:'center'
		,editable:false
	 // ,editrules:{number:true}
	  },{
		name:'id_prop'
		,index:'id_prop'
		,width:80
		//,align:'center'
		,editable:false
	 
	},{
	name:'clase'
		,index:'clase'
		,width:80
		,hidden:true
		//,align:'right'
		,editable:false	
		
    	},{
		
	  name:'direccion'
		,index:'direccion'
		,width:150
		//,align:'center'
		,editable:false
		,search:false
		,hidden:true
		
	},{
	name:'telefono'
		,index:'telefono'
		,width:80
		//,align:'right'
		,editable:false	
		,search:false	
		,hidden:true
	},{
	name:'tipov'
		,index:'tipov'
		,width:80
		//,align:'right'
		,editable:false	
		,search:false	
		,hidden:true
	},{
		name:'modelo'
		,index:'modelo'
		,width:70
		,align:'center'
		,editable:false		
		,hidden:true		
	},{
	
		name:'marca'
		,index:'marca'
		,width:110
		//,align:'center'
		,editable:false
		,hidden:true
	},{
		name:'motor'
		,index:'motor'
		,width:130
		//,align:'center'
		,editable:false
		,search:false
	    ,hidden:true
		},{
	name:'serie'
		,index:'serie'
		,width:130
		//,align:'right'
		,editable:false	
		,search:false
		,hidden:true
		},{
	name:'referencia'
		,index:'referencia'
		,width:100
		,hidden:true
		//,align:'right'
		,editable:false	
		},{
	name:'tipo'
		,index:'tipo'
		,width:85
		,hidden:true
		//,align:'right'
		,editable:false	
	,hidden:true
		},{
	name:'color'
		,index:'color'
		,width:80
		//,align:'right'
		,editable:false	
	,hidden:true
	
		},{
	name:'grupo'
		,index:'grupo'
		,width:50
		,align:'center'
		,editable:false	
     },{	
		
	  name:'f_inclusion'
		,index:'f_inclusion'
		,width:80
		//,align:'center'
		,search:false	
		 ,sortable:false
		,editable:false
		,formatoptions:{srcformat:"Y-m-d H:i:s",newformat:"Y-M-d"}
    	,formatter:"date"
		,editoptions:{
		dataInit:
		function(elm){setTimeout(function(){
                  jQuery(elm).datepicker({dateFormat:'yy-mm-dd',changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,});
                    jQuery('.ui-datepicker').css({'font-size':'100%'});
                },200);}
				}
		},{
			name:'f_fin'
		,index:'f_fin'
		,width:80
		,search:false	
		//,align:'center'
		,editable:true
		 ,sortable:false
	 // ,editrules:{number:true}
	 ,formatoptions:{srcformat:"Y-m-d H:i:s",newformat:"Y-m-d"}
    	,formatter:"date"
		,editoptions:{
		dataInit:
		function(elm){setTimeout(function(){
                  jQuery(elm).datepicker({dateFormat:'yy-mm-dd',changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showWeek: true,});
                    jQuery('.ui-datepicker').css({'font-size':'100%'});
                },200);}
				}
	  },{
		name:'dias'
		,index:'dias'
		,search:false	
		,width:35
		,align:'center'
		,editable:false
	    ,sortable:false
	},{
	name:'valorp'
		,index:'valorp'
		,search:false	
		,width:70
		//,align:'right'
		,editable:false	
		,formatter:'currency'
		,formatoptions:{decimalSeparator:".",thousandsSeparator:",",decimalPlaces:0,prefix:"$"}
		 ,sortable:false
		 ,summaryType:'sum'
	},{
	name:'id_contra'
		,index:'id_contra'
		,width:80
		,hidden:true
		,editable:false	
		 ,sortable:false
		 ,key:true	
    	},{
		<?php  while($filadeta = mysql_fetch_array($seldetalle,MYSQL_ASSOC)) {echo "name:'rc".$y."',index:'rc".$y."',width:50,align:'center',editable:false,search:false},{name:'cuota".$y."',index:'cuota".$y."',width:80,align:'center',editable:false ,sortable:false	
		,search:false,formatter:'currency',formatoptions:{decimalSeparator:'.',thousandsSeparator:',',decimalPlaces:0,prefix:'$'},summaryType:'sum'},{";

$y++;
}?>

	name:'saldo'
		,index:'saldo'
		,width:80
		//,align:'right'
		,editable:false	
      /* ,formatter:'currency'
		,formatoptions:{decimalSeparator:".",thousandsSeparator:",",decimalPlaces:0,prefix:"$"}
      ,sortable:false*/
	,search:false
//	 ,summaryType:'sum'
		}
	
	 
	],
	   
	   pager: jQuery('#pcrud'),
    rowNum:350,
    rowList:[10,200,300,400],
	height:'auto',
	width:'auto',
    sortname: 'id_movil',
    sortorder: "asc",
    viewrecords: true,
	grouping:true, 
	groupingView : { 
	groupField : ['tipov'], 
	groupColumnShow : [true], 
	groupText : ['<b>{0}</b>'], 
	groupCollapse : false, 
	groupOrder: ['asc'], 
	groupSummary : [true], 
	groupDataSorted : true}, 
	footerrow: true, 
	userDataOnFooter: true,
     caption: 'Relacion de pagos de seguros para el periodo <?php echo $ani;?>',
	 postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
		
		},
	
	
	loadComplete: function(){
		var ids = jQuery("#crud").getDataIDs();
  			
			
			//record=jQuery("#crudoc").jqGrid('getRowData',ids).codigo;
		 // jQuery("#crudoc").jqGrid('getRowData',ids);	       
		for(var i=0;i<ids.length;i++){
		   //  var dato = record[i];
			var cl = ids[i];
			
			 var rowData = jQuery(this).getRowData(cl); 
                  var movil= rowData['id_movil'];//replace name with you 
				  var ncontra= rowData['id_contra'];
				  var f_inc= rowData['f_inclusion'];
				 // alert(temp);
			 var saldo1= rowData['saldo1'];	 
			 if(saldo1=="Excluido"){
				 jQuery("#crud").setRowData(rowData.id_movil,{saldo1:"<font color='red'>Excluido</font>"})  
			
			
			}
			var saldo= rowData['saldo'];	 
			 if(saldo=="Excluido"){
				 jQuery("#crud").setRowData(rowData.id_movil,{saldo:"<font color='red'>Excluido</font>"})  
			
			
			}
	be = "<a id='inas' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#'  accesskey='c' onClick=abre_cuota_contra('cuota','"+trim(movil)+"','"+ncontra+"','<?php echo $ani;?>');jQuery('#cuota').dialog('open'); ><span class='ui-icon ui-icon ui-icon-note'></span>Cuota</a>";
	se = "<a id='inas' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=abre_exclu('exclu','"+trim(movil)+"','"+f_inc+"','<?php echo $ani;?>');jQuery('#exclu').dialog('open');><span class='ui-icon ui-icon ui-icon-circle-minus'></span>Excl</a>"; 
	reimp = "<a id='inas' class='fm-button ui-state-default ui-corner-all fm-button-icon-left'  href='#' onClick=reimprime_cuota('imprime','"+trim(movil)+"','<?php echo $ani;?>');jQuery('#imprime').dialog('open');><span class='ui-icon ui-icon ui-icon-print'></span>Reimp</a>"; 
			
			jQuery("#crud").setRowData(ids[i],{oper:be+se+reimp})
		}	
	},	
		//jQuery('#crud').editRow("+cl+");abre_cuota_contra('cuota','"+trim(movil)+"','"+ncontra+"','<?php echo $ani;?>'); 
	
	
	    editurl: 'gridpago.php?q=1&anio=<?php echo $ani=$_REQUEST['anio'];?>'// this is dummy existing url 
		
		 });
		 
		 jQuery("#crud").jqGrid('navGrid','#pcrud',{edit:true,add:false,del:<?php if($permiso==1) { echo "true"; }else{ echo "false";}?>,search:false},{reloadAfterSubmit:true,closeAfterEdit : true,closeOnEscape:true},{closeOnEscape:true},{closeOnEscape:true},{sopt:['cn','bw','eq','ne','lt','gt','ew','le','ge'], odata : ['igual ', 'no igual a', 'menor que', 'menor o igual que','mayor que','mayor o igual a', 'empiece por','no empiece por','está en','no está en','termina por','no termina por','contiene','no contiene'],
            groupOps: [ { op: "AND", text: "todo" },    { op: "OR",  text: "cualquier" }        ],
}).navButtonAdd('#pcrud',{
                                caption:"Exportar", 
                                buttonicon:"ui-icon-calculator", 
                                onClickButton: function(){ 
                                  exportExcel();
                                }, 
                                //position:"last"
                            }).navButtonAdd('#pcrud',{
                                caption:"Columnas", 
                                buttonicon:"ui-icon-calculator", 
                                onClickButton: function(){ 
                                 jQuery("#crud").jqGrid('columnChooser');

                                }, 
                                position:"last"
      
	                        });
						
function exportExcel()
        {
            var mya=new Array();
            mya=jQuery("#crud").getDataIDs();  // Get All IDs
            var data=jQuery("#crud").getRowData(mya[0]);     // Get First row to get the labels
            var colNames=new Array(); 
            var ii=0;
            for (var i in data){colNames[ii++]=i;}    // capture col names
            var html="";
            for(i=0;i<mya.length;i++)
                {
                data=jQuery("#crud").getRowData(mya[i]); // get each row
                for(j=0;j<colNames.length;j++)
                    {
                    html=html+data[colNames[j]]+"\t"; // output each column as tab delimited
                    }
                html=html+"\n";  // output each row with end of line

                }
            html=html+"\n";  // end of line at the end
           // document.forms[0].csvBuffer.value=html;
            document.forms[0].method='POST';
            document.forms[0].action='excelrelacionpago.php';  // send it to server which will open this contents in excel file
            document.forms[0].target='_blank';
            document.forms[0].submit();
        }	

 jQuery("#crud").jqGrid('filterToolbar');
			jQuery('#cuota').dialog({autoOpen: false, modal:true,width:450,height:500,position: ['left','top']});	
	        jQuery('#exclu').dialog({autoOpen: false, modal:true,width:400,height:350,position: ['left','top']});
			jQuery('#imprime').dialog({autoOpen: false, modal:true,width:400,height:350,position: ['left','top']});	
/*jQuery("#vcol").click(function (){

 jQuery("#crud").setColumns();
 });	*/	 
		 
	
		 
/*		
		 function pickdates(id){
	  jQuery('#pcrud').datepicker({dateFormat:'yy-mm-dd'});
}
	/*	 jQuery( "#tabs" ).tabs({
						//event: "mouseover"
					});*/
					
					
/*$("#bsdata").click(function(){
	jQuery("#crud").searchGrid(
		{sopt:['cn','bw','eq','ne','lt','gt','ew','le','ge'], odata : ['igual ', 'no igual a', 'menor que', 'menor o igual que','mayor que','mayor o igual a', 'empiece por','no empiece por','está en','no está en','termina por','no termina por','contiene','no contiene']
}
	)
});	*/
	
});					
					

	//	 });
    </script>
<style>
#cuota{

display: none;
}
#exclu{

display: none;
}
#imprime{

display: none;
}

.norecibo {
	font-size: 18px;
	color: #CC0000;
}

.Estilo4 {font-size: 24px; color: #CC0033; }
-->
    </style>	
<!--<a href="#" id="vcol">Hide/Show Columns</a>-->

<div id="exclu" title="Excluir Vehiculo">

</div>
<div id="imprime" title="Reimprimir Certificado">

</div>

 <br/><br> <table id="setcols" class="scroll" cellpadding="0" cellspacing="0"></table> <div id="psetcols" class="scroll" style="text-align:center;"></div>

<table align="center" id="crud"  >
<tr><td>&nbsp;</td></tr></table><div id="pcrud" align="center"></div>

<form method="post" action="excelrelacionpago.php">
    <input type="hidden" name="ani" id="ani" value="<?php echo $ani;?>" />
</form>

<div id="novedad"  title="Novedad de Diarios"></div>
