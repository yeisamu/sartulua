<?php
session_start();
 include('../inc/libreria.php');
 
 if(!valida_usr(20)){
 
 echo "Acceso No Autorizado";
 return ;
 }
?> 
 <!DOCTYPE html>

<html>
<head>
	
	<title>Bar Charts</title>

    <link rel="stylesheet" type="text/css" href="../grafico/jquery.jqplot.min.css" />
    <link rel="stylesheet" type="text/css" href="../grafico/examplesexamples.min.css" />
    <link type="text/css" rel="stylesheet" href="../grafico/examples/syntaxhighlighter/styles/shCoreDefault.min.css" />
    <link type="text/css" rel="stylesheet" href="../grafico/examples/syntaxhighlighter/styles/shThemejqPlot.min.css" />
  
  <!--[if lt IE 9]><script language="javascript" type="text/javascript" src="../excanvas.js"></script><![endif]-->
    <script  type="text/javascript" src="../grafico/jquery.min.js"></script>
    
   
</head>
<body>
<!--
    <div class="example-content">

    <div class="example-nav"> -->

<!--    
    <div><span>You Clicked: </span><span id="info1">Nothing yet</span></div>
        
    <div id="chart1" style="margin-top:20px; margin-left:20px; width:300px; height:300px;"></div>
<pre class="code brush:js"></pre>

    <p>The plot target also fires a 'jqplotDataMouseOver' when the cursor is moused over a bar even if highlighting is turned off.  This event will fire continuously as the user mouses over the bar.  'jqplotDataHighlight' fires only once when the user first passes over the bar.  Additionally, a 'jqplotDataUnhighlight' event is fired when the user moves out of a bar (if highlighting is enabled).<p> -->

 <!--   <div><span>Moused Over: </span><span id="info2">Nothing</span></div> -->
    
    <div id="chart2" style="margin-top:20px; margin-left:20px; width:2200px; height:600px;"></div>
<!--<pre class="code brush:js"></pre> -->

  <div id="chartf" style="margin-top:20px; margin-left:20px; width:400px; height:400px;"></div>
<!--<pre class="code brush:js"></pre> -->

 <div id="chartc" style="margin-top:20px; margin-left:20px; width:600px; height:400px;"></div>
<!--<pre class="code brush:js"></pre> -->
  <div id="chartp" style="margin-top:20px; margin-left:20px; width:1400px; height:400px;"></div>
<!--<pre class="code brush:js"></pre>
 --> 



  <div id="chart3" style="margin-top:20px; margin-left:20px; width:1400px; height:400px;"></div>
<!--<pre class="code brush:js"></pre> -->
  <div id="chart4" style="margin-top:20px; margin-left:20px; width:1400px; height:400px;"></div>
<!--<pre class="code brush:js"></pre> -->
    
   <!-- <div><span>Moused Over: </span><span id="info2b">Nothing</span></div>
    <div><span>Clicked: </span><span id="info2c">Nothing</span></div>
    
    <div id="chart2b" style="margin-top:20px; margin-left:20px; width:300px; height:300px;"></div>
<pre class="code brush:js"></pre>
    
    <p>The next example has the plot's 'captureRightClick' option set to true.  This causes the plot to fire a 'jqplotRightClick' event the the user clicks the right mouse button over a bar.  Here, the 'highlightMouseDown' option is also set to true.  This will highlight a slice on mouse down instead of on move over.  Highlighting will occur for either left or right click.</p> 

    <div><span>You Right Clicked: </span><span id="info3">Nothing yet</span></div>
    
    <div id="chart3" style="margin-top:20px; margin-left:20px; width:300px; height:300px;"></div>
<pre class="code brush:js"></pre>
    
    <div id="chart4" style="margin-top:20px; margin-left:20px; width:300px; height:300px;"></div>
<pre class="code brush:js"></pre>
    
    <div id="chart5" style="margin-top:20px; margin-left:20px; width:300px; height:300px;"></div>
<pre class="code brush:js"></pre>
        
<p>A pie chart is added to test for incompatibilities.</p>
    <div id="chart6" style="margin-top:20px; margin-left:20px; width:300px; height:200px;"></div>
<pre class="code brush:js"></pre>

<p>The nex example shows the placement of point labels on negative bars. They shou be placed on the opposite position. That is, if it is placed 'north' to the positive bars, then it should be placed 'south' to the negative bars.</p>
    <div id="chart7" style="margin-top:20px; margin-left:20px; width:300px; height:300px;"></div>
<pre class="code brush:js"></pre> -->

    
  <script   type="text/javascript">$(document).ready(function(){
/*        var s1 = [9, 6, 7, 10];
      //  var s2 = [7, 5, 3, 2];
        var ticks = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
        
        plot2 = $.jqplot('chart2', [s1], {
            seriesDefaults: {
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true }
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks
                }
            }
        });
    
        $('#chart2').bind('jqplotDataHighlight', 
            function (ev, seriesIndex, pointIndex, data) {
                $('#info2').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }
        );
            
        $('#chart2').bind('jqplotDataUnhighlight', 
            function (ev) {
                $('#info2').html('Nothing');
            }
        );*/
 var line1 =	<?php 
			
			$lista1="";
			$contador=1;
			$consulta1=mysql_query("select CONCAT(SUBSTR(UPPER(linea_atencion.linea),1,1),SUBSTR(LOWER(linea_atencion.linea),2,200)) AS linea,sum(if(year( fecha_reg ) =2012  ,1,0)) as total from linea_atencion
left join servicio_h ON  linea_atencion.`linea`=servicio_h.`linea` group by linea_atencion.linea");
			 $num=mysql_num_rows($consulta1);
			while($filad=mysql_fetch_array($consulta1)){
			
			$lista1=$lista1."['".$filad['linea']."',".$filad['total']."]";
		 	if($contador<$num){
			 $lista1=$lista1.",";
			}
			
			$contador++;
			
			}
			
			echo $lista1="[".$lista1."]";
		 
			
			
			?>
			
/////////////////////////////

 //var linetot =	<?php 
			
//			$lista1="";
//			$contador=1;
//			$consulta1=mysql_query("SELECT CONCAT( SUBSTR( UPPER( linea_atencion.linea ) , 1, 1 ) , SUBSTR( LOWER( linea_atencion.linea ) , 2, 200 ) ) AS linea, sum( if( year( fecha_reg ) =2012, 1, 0 ) ) AS total
//FROM linea_atencion
//LEFT JOIN servicio_h ON linea_atencion.`linea` = servicio_h.`linea`
//
//GROUP BY linea_atencion.`linea`");
//			 $num=mysql_num_rows($consulta1);
//			while($filad=mysql_fetch_array($consulta1)){
//			
//			$lista1=$lista1."['".$filad['linea']."',".$filad['total']."]";
//		 	if($contador<$num){
//			 $lista1=$lista1.",";
//			}
//			
//			$contador++;
//			
//			}
//			
//			echo $lista1="[".$lista1."]";
//		 
			
			
			?>
//////linea fija general
var linef =	<?php 
			
			$lista1="";
			$contador=1;
			$consulta1=mysql_query("SELECT CONCAT( SUBSTR( UPPER( linea_atencion.linea ) , 1, 1 ) , SUBSTR( LOWER( linea_atencion.linea ) , 2, 200 ) ) AS linea, sum( if( year( fecha_reg ) =2012, 1, 0 ) ) AS total
FROM linea_atencion 
LEFT JOIN servicio_h ON linea_atencion.`linea` = servicio_h.`linea`
where linea_atencion.id_tipo_linea =1
GROUP BY linea_atencion.linea");
			 $num=mysql_num_rows($consulta1);
			while($filad=mysql_fetch_array($consulta1)){
			
			$lista1=$lista1."['".$filad['linea']."',".$filad['total']."]";
		 	if($contador<$num){
			 $lista1=$lista1.",";
			}
			
			$contador++;
			
			}
			
			echo $lista1="[".$lista1."]";
		 
			
			
			?>;
			
///////////////linea fija Pendiente

var linefp =	<?php 
			
			$lista1="";
			$contador=1;
			$consulta1=mysql_query("SELECT CONCAT( SUBSTR( UPPER( linea_atencion.linea ) , 1, 1 ) , SUBSTR( LOWER( linea_atencion.linea ) , 2, 200 ) ) AS linea, sum( if( year( fecha_reg ) =2012  AND estado =0, 1, 0 ) ) AS total
FROM linea_atencion 
LEFT JOIN servicio_h ON linea_atencion.`linea` = servicio_h.`linea`
where linea_atencion.id_tipo_linea =1
GROUP BY linea_atencion.linea");
			 $num=mysql_num_rows($consulta1);
			while($filad=mysql_fetch_array($consulta1)){
			
			$lista1=$lista1."['".$filad['linea']."',".$filad['total']."]";
		 	if($contador<$num){
			 $lista1=$lista1.",";
			}
			
			$contador++;
			
			}
			
			echo $lista1="[".$lista1."]";
		 
			
			
			?>;
			
///////////////linea fija ASignado

var linefa =	<?php 
			
			$lista1="";
			$contador=1;
			$consulta1=mysql_query("SELECT CONCAT( SUBSTR( UPPER( linea_atencion.linea ) , 1, 1 ) , SUBSTR( LOWER( linea_atencion.linea ) , 2, 200 ) ) AS linea, sum( if( year( fecha_reg ) =2012  AND estado =1, 1, 0 ) ) AS total
FROM linea_atencion 
LEFT JOIN servicio_h ON linea_atencion.`linea` = servicio_h.`linea`
where linea_atencion.id_tipo_linea =1
GROUP BY linea_atencion.linea");
			 $num=mysql_num_rows($consulta1);
			while($filad=mysql_fetch_array($consulta1)){
			
			$lista1=$lista1."['".$filad['linea']."',".$filad['total']."]";
		 	if($contador<$num){
			 $lista1=$lista1.",";
			}
			
			$contador++;
			
			}
			
			echo $lista1="[".$lista1."]";
		 
			
			
			?>;
			
///////////////linea fija Pendiente

var linefd =	<?php 
			
			$lista1="";
			$contador=1;
			$consulta1=mysql_query("SELECT CONCAT( SUBSTR( UPPER( linea_atencion.linea ) , 1, 1 ) , SUBSTR( LOWER( linea_atencion.linea ) , 2, 200 ) ) AS linea, sum( if( year( fecha_reg ) =2012  AND estado =2, 1, 0 ) ) AS total
FROM linea_atencion 
LEFT JOIN servicio_h ON linea_atencion.`linea` = servicio_h.`linea`
where linea_atencion.id_tipo_linea =1
GROUP BY linea_atencion.linea");
			 $num=mysql_num_rows($consulta1);
			while($filad=mysql_fetch_array($consulta1)){
			
			$lista1=$lista1."['".$filad['linea']."',".$filad['total']."]";
		 	if($contador<$num){
			 $lista1=$lista1.",";
			}
			
			$contador++;
			
			}
			
			echo $lista1="[".$lista1."]";
		 
			
			
			?>;
			










//////			
			
 var linec =	<?php 
			
			$lista1="";
			$contador=1;
			$consulta1=mysql_query("SELECT CONCAT( SUBSTR( UPPER( linea_atencion.linea ) , 1, 1 ) , SUBSTR( LOWER( linea_atencion.linea ) , 2, 200 ) ) AS linea, sum( if( year( fecha_reg ) =2012, 1, 0 ) ) AS total
FROM linea_atencion 
LEFT JOIN servicio_h ON linea_atencion.`linea` = servicio_h.`linea`
where linea_atencion.id_tipo_linea =2
GROUP BY linea_atencion.`linea`");
			 $num=mysql_num_rows($consulta1);
			while($filad=mysql_fetch_array($consulta1)){
			
			$lista1=$lista1."['".$filad['linea']."',".$filad['total']."]";
		 	if($contador<$num){
			 $lista1=$lista1.",";
			}
			
			$contador++;
			
			}
			
			echo $lista1="[".$lista1."]";
		 
			
			
			?>
			
			
//////////////////////////celulares pendientes
 var linecp =	<?php 
			
			$lista1="";
			$contador=1;
			$consulta1=mysql_query("SELECT CONCAT( SUBSTR( UPPER( linea_atencion.linea ) , 1, 1 ) , SUBSTR( LOWER( linea_atencion.linea ) , 2, 200 ) ) AS linea, sum( if( year( fecha_reg ) =2012 AND estado =0, 1, 0 ) ) AS total
FROM linea_atencion 
LEFT JOIN servicio_h ON linea_atencion.`linea` = servicio_h.`linea`
where linea_atencion.id_tipo_linea =2
GROUP BY linea_atencion.`linea`");
			 $num=mysql_num_rows($consulta1);
			while($filad=mysql_fetch_array($consulta1)){
			
			$lista1=$lista1."['".$filad['linea']."',".$filad['total']."]";
		 	if($contador<$num){
			 $lista1=$lista1.",";
			}
			
			$contador++;
			
			}
			
			echo $lista1="[".$lista1."]";
		 
			
			
			?>	
			
//////////////////////////celulares asignados
 var lineca =	<?php 
			
			$lista1="";
			$contador=1;
			$consulta1=mysql_query("SELECT CONCAT( SUBSTR( UPPER( linea_atencion.linea ) , 1, 1 ) , SUBSTR( LOWER( linea_atencion.linea ) , 2, 200 ) ) AS linea, sum( if( year( fecha_reg ) =2012 AND estado =1, 1, 0 ) ) AS total
FROM linea_atencion 
LEFT JOIN servicio_h ON linea_atencion.`linea` = servicio_h.`linea`
where linea_atencion.id_tipo_linea =2
GROUP BY linea_atencion.`linea`");
			 $num=mysql_num_rows($consulta1);
			while($filad=mysql_fetch_array($consulta1)){
			
			$lista1=$lista1."['".$filad['linea']."',".$filad['total']."]";
		 	if($contador<$num){
			 $lista1=$lista1.",";
			}
			
			$contador++;
			
			}
			
			echo $lista1="[".$lista1."]";
		 
			
			
			?>	
			
//////////////////////////celulares descartados
 var linecd =	<?php 
			
			$lista1="";
			$contador=1;
			$consulta1=mysql_query("SELECT CONCAT( SUBSTR( UPPER( linea_atencion.linea ) , 1, 1 ) , SUBSTR( LOWER( linea_atencion.linea ) , 2, 200 ) ) AS linea, sum( if( year( fecha_reg ) =2012 AND estado =2, 1, 0 ) ) AS total
FROM linea_atencion 
LEFT JOIN servicio_h ON linea_atencion.`linea` = servicio_h.`linea`
where linea_atencion.id_tipo_linea =2
GROUP BY linea_atencion.`linea`");
			 $num=mysql_num_rows($consulta1);
			while($filad=mysql_fetch_array($consulta1)){
			
			$lista1=$lista1."['".$filad['linea']."',".$filad['total']."]";
		 	if($contador<$num){
			 $lista1=$lista1.",";
			}
			
			$contador++;
			
			}
			
			echo $lista1="[".$lista1."]";
		 
			
			
			?>									

 var linep =	<?php 
			
			$lista1="";
			$contador=1;
			$consulta1=mysql_query("SELECT CONCAT( SUBSTR( UPPER( linea_atencion.linea ) , 1, 1 ) , SUBSTR( LOWER( linea_atencion.linea ) , 2, 200 ) ) AS linea, sum( if( year( fecha_reg ) =2012, 1, 0 ) ) AS total
FROM linea_atencion 
LEFT JOIN servicio_h ON linea_atencion.`linea` = servicio_h.`linea`
where linea_atencion.id_tipo_linea =3
GROUP BY linea_atencion.`linea`");
			 $num=mysql_num_rows($consulta1);
			while($filad=mysql_fetch_array($consulta1)){
			
			$lista1=$lista1."['".$filad['linea']."',".$filad['total']."]";
		 	if($contador<$num){
			 $lista1=$lista1.",";
			}
			
			$contador++;
			
			}
			
			echo $lista1="[".$lista1."]";
		 
			
			
			?>
			
/////////puntos pendientes			
		 var linepp =	<?php 
			
			$lista1="";
			$contador=1;
			$consulta1=mysql_query("SELECT CONCAT( SUBSTR( UPPER( linea_atencion.linea ) , 1, 1 ) , SUBSTR( LOWER( linea_atencion.linea ) , 2, 200 ) ) AS linea, sum( if( year( fecha_reg ) =2012 AND estado =0, 1, 0 ) ) AS total
FROM linea_atencion 
LEFT JOIN servicio_h ON linea_atencion.`linea` = servicio_h.`linea`
where linea_atencion.id_tipo_linea =3
GROUP BY linea_atencion.`linea`");
			 $num=mysql_num_rows($consulta1);
			while($filad=mysql_fetch_array($consulta1)){
			
			$lista1=$lista1."['".$filad['linea']."',".$filad['total']."]";
		 	if($contador<$num){
			 $lista1=$lista1.",";
			}
			
			$contador++;
			
			}
			
			echo $lista1="[".$lista1."]";
		 
			
			
			?>	

/////////puntos pendientes			
		 var linepa =	<?php 
			
			$lista1="";
			$contador=1;
			$consulta1=mysql_query("SELECT CONCAT( SUBSTR( UPPER( linea_atencion.linea ) , 1, 1 ) , SUBSTR( LOWER( linea_atencion.linea ) , 2, 200 ) ) AS linea, sum( if( year( fecha_reg ) =2012 AND estado =1, 1, 0 ) ) AS total
FROM linea_atencion 
LEFT JOIN servicio_h ON linea_atencion.`linea` = servicio_h.`linea`
where linea_atencion.id_tipo_linea =3
GROUP BY linea_atencion.`linea`");
			 $num=mysql_num_rows($consulta1);
			while($filad=mysql_fetch_array($consulta1)){
			
			$lista1=$lista1."['".$filad['linea']."',".$filad['total']."]";
		 	if($contador<$num){
			 $lista1=$lista1.",";
			}
			
			$contador++;
			
			}
			
			echo $lista1="[".$lista1."]";
		 
			
			
			?>
			
		/////////puntos pendientes			
		 var linepd =	<?php 
			
			$lista1="";
			$contador=1;
			$consulta1=mysql_query("SELECT CONCAT( SUBSTR( UPPER( linea_atencion.linea ) , 1, 1 ) , SUBSTR( LOWER( linea_atencion.linea ) , 2, 200 ) ) AS linea, sum( if( year( fecha_reg ) =2012 AND estado =2, 1, 0 ) ) AS total
FROM linea_atencion 
LEFT JOIN servicio_h ON linea_atencion.`linea` = servicio_h.`linea`
where linea_atencion.id_tipo_linea =3
GROUP BY linea_atencion.`linea`");
			 $num=mysql_num_rows($consulta1);
			while($filad=mysql_fetch_array($consulta1)){
			
			$lista1=$lista1."['".$filad['linea']."',".$filad['total']."]";
		 	if($contador<$num){
			 $lista1=$lista1.",";
			}
			
			$contador++;
			
			}
			
			echo $lista1="[".$lista1."]";
		 
			
			
			?>	

////////////////////////////			
			
			
			
		var line2 =	<?php 
			$lista1="[";
			$lista="";
			$contador=1;
			$consulta=mysql_query("select CONCAT(SUBSTR(UPPER(linea_atencion.linea),1,1),SUBSTR(LOWER(linea_atencion.linea),2,200)) AS linea,sum(if(year( fecha_reg ) =2012  AND estado =0,1,0)) as total
FROM linea_atencion
left join servicio_h ON  linea_atencion.`linea`=servicio_h.`linea`
GROUP BY linea_atencion.linea");
			 $num=mysql_num_rows($consulta);
			while($filad=mysql_fetch_array($consulta)){
			
			$lista=$lista."['".$filad['linea']."',".$filad['total']."]";
		 	if($contador<$num){
			 $lista=$lista.",";
			}
			
			$contador++;
			
			}
			
			echo $lista="[".$lista."]";
		 
			
			
			?>	
 
 var line3 =	<?php 
			$lista1="[";
			$lista="";
			$contador=1;
			$consulta=mysql_query("select CONCAT(SUBSTR(UPPER(linea_atencion.linea),1,1),SUBSTR(LOWER(linea_atencion.linea),2,200)) AS linea,sum(if(year( fecha_reg ) =2012  AND estado =1,1,0)) as total
FROM linea_atencion
left join servicio_h ON  linea_atencion.`linea`=servicio_h.`linea`
GROUP BY linea_atencion.linea");
			 $num=mysql_num_rows($consulta);
			while($filad=mysql_fetch_array($consulta)){
			
			$lista=$lista."['".$filad['linea']."',".$filad['total']."]";
		 	if($contador<$num){
			 $lista=$lista.",";
			}
			
			$contador++;
			
			}
			
			echo $lista="[".$lista."]";
		 
			
			
			?>	
			var line4 =	<?php 
			$lista1="[";
			$lista="";
			$contador=1;
			$consulta=mysql_query("SELECT CONCAT(SUBSTR(UPPER(linea_atencion.linea),1,1),SUBSTR(LOWER(linea_atencion.linea),2,200)) AS linea,sum(if(year( fecha_reg ) =2012  AND estado =2,1,0)) as total
FROM linea_atencion
left join servicio_h ON  linea_atencion.`linea`=servicio_h.`linea`
GROUP BY linea_atencion.linea

");
			 $num=mysql_num_rows($consulta);
			while($filad=mysql_fetch_array($consulta)){
			
			$lista=$lista."['".$filad['linea']."',".$filad['total']."]";
		 	if($contador<$num){
			 $lista=$lista.",";
			}
			
			$contador++;
			
			}
			
			echo $lista="[".$lista."]";
		 
			
			
			?>	
 
 
 /*
  [['Cup Holder Pinion Bob', 7], ['Generic Fog Lamp', 9], ['HDTV Receiver', 15],
  ['8 Track Control Module', 12], [' Sludge Pump Fourier Modulator', 3],
  ['Transcender/Spice Rack', 6], ['Hair Spray Danger Indicator', 18]]*/;
  var plot1b = $.jqplot('chart2', [line1,line2,line3,line4], {
    title: 'Comportamiento de Servicios Anual',
   // series:[{renderer:$.jqplot.BarRenderer}],
  //stackSeries: true, 
     seriesDefaults: {
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true, stackedValue: true }
            },
	series:[
            {label:'General'},
            {label:'Pendiente'},
            {label:'Asignados'},
			{label:'Descartados'}
        ],
		legend: {
            show: true,
            placement: 'outsideGrid'
        },
			cursor:{
        show: true,
        zoom:true,
        showTooltip:false
      } ,		
    axesDefaults: {
        tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
        tickOptions: {
          fontFamily: 'Georgia',
          fontSize: '8pt',
          angle: -90
        }
    },

    axes: {
      xaxis: {
        renderer: $.jqplot.CategoryAxisRenderer
      }
    }
	
	
  });
  

       /* $('#chart2').bind('jqplotDataHighlight', 
            function (ev, seriesIndex, pointIndex, data) {
                $('#info2').html('Valores: '+data);
            }
        );*/
            
        $('#chart2').bind('jqplotDataUnhighlight', 
            function (ev) {
                $('#info2').html('Nothing');
            }
        );
	
///////////////////////grafica general de fijos


/////grafica de asignados por linea fija
		 var plot1b = $.jqplot('chartf', [linef,linefp,linefa,linefd], {
    title: 'Servicio Anual por linea Fijo',
   // series:[{renderer:$.jqplot.BarRenderer}],
  //stackSeries: true, 
     seriesDefaults: {
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true, stackedValue: true }
            },
	series:[
           
            {label:'Fijos General'},
			{label:'Fijos Pendiente'},
			{label:'Fijos Asignado'},
			{label:'Fijos Descartado'}
			
			
        ],
		legend: {
            show: true,
            placement: 'outsideGrid'
        },
			cursor:{
        show: true,
        zoom:true,
        showTooltip:false
      } ,		
    axesDefaults: {
        tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
        tickOptions: {
          fontFamily: 'Georgia',
          fontSize: '8pt',
          angle: -90
        }
    },

    axes: {
      xaxis: {
        renderer: $.jqplot.CategoryAxisRenderer
      }
    }
	
	
  });
  
  
  ////////lineas celular
  
  	 var plot1b = $.jqplot('chartc', [linec,linecp,lineca,linecd], {
    title: 'Servicio Anual Por lineas Celulares',
   // series:[{renderer:$.jqplot.BarRenderer}],
  //stackSeries: true, 
     seriesDefaults: {
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true, stackedValue: true }
            },
	series:[
           
            {label:'Celulares Total'},
			{label:'Celulares Pendiente'},
			{label:'Celulares Asignado'},
			{label:'Celulares Descartado'}
			
        ],
		legend: {
            show: true,
            placement: 'outsideGrid'
        },
			cursor:{
        show: true,
        zoom:true,
        showTooltip:false
      } ,		
    axesDefaults: {
        tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
        tickOptions: {
          fontFamily: 'Georgia',
          fontSize: '8pt',
          angle: -90
        }
    },

    axes: {
      xaxis: {
        renderer: $.jqplot.CategoryAxisRenderer
      }
    }
	
	
  });
  
  
  ///////lineas puntos
  
   var plot1b = $.jqplot('chartp', [linep,linepp,linepa,linepd], {
    title: 'Servicio Anual Por Puntos de Radio',
   // series:[{renderer:$.jqplot.BarRenderer}],
  //stackSeries: true, 
     seriesDefaults: {
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true, stackedValue: true }
            },
	series:[
           
            {label:'Ptos Radio total'},
			{label:'Ptos Radio Pendiente'},
			{label:'Ptos Radio Asignado'},
			{label:'Ptos Radio Descartado'}
			
			
        ],
		legend: {
            show: true,
            placement: 'outsideGrid'
        },
			cursor:{
        show: true,
        zoom:true,
        showTooltip:false
      } ,		
    axesDefaults: {
        tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
        tickOptions: {
          fontFamily: 'Georgia',
          fontSize: '8pt',
          angle: -90
        }
    },

    axes: {
      xaxis: {
        renderer: $.jqplot.CategoryAxisRenderer
      }
    }
	
	
  });
  

       /* $('#chart2').bind('jqplotDataHighlight', 
            function (ev, seriesIndex, pointIndex, data) {
                $('#info2').html('Valores: '+data);
            }
        );*/
            
        $('#chartf').bind('jqplotDataUnhighlight', 
            function (ev) {
                $('#info2').html('Nothing');
            }
        );	
	
	
		
		///////grafica de asignados
		 var plot1b = $.jqplot('chart3', [line3], {
    title: 'Comportamiento de servicios Anual servicios Asignados',
   // series:[{renderer:$.jqplot.BarRenderer}],
  //stackSeries: true, 
     seriesDefaults: {
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true, stackedValue: true }
            },
	series:[
           
            {label:'Asignados'}
			
        ],
		legend: {
            show: true,
            placement: 'outsideGrid'
        },
			cursor:{
        show: true,
        zoom:true,
        showTooltip:false
      } ,		
    axesDefaults: {
        tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
        tickOptions: {
          fontFamily: 'Georgia',
          fontSize: '8pt',
          angle: -90
        }
    },

    axes: {
      xaxis: {
        renderer: $.jqplot.CategoryAxisRenderer
      }
    }
	
	
  });
  

       /* $('#chart2').bind('jqplotDataHighlight', 
            function (ev, seriesIndex, pointIndex, data) {
                $('#info2').html('Valores: '+data);
            }
        );*/
            
        $('#chart3').bind('jqplotDataUnhighlight', 
            function (ev) {
                $('#info2').html('Nothing');
            }
        );
/////////////////////////////////////
 var plot1b = $.jqplot('chart4', [line4], {
    title: 'Comportamiento de servicios Anual Descartados',
   // series:[{renderer:$.jqplot.BarRenderer}],
  //stackSeries: true, 
     seriesDefaults: {
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true, stackedValue: true }
            },
	series:[
          
			{label:'Descartados'}
        ],
		legend: {
            show: true,
            placement: 'outsideGrid'
        },
			cursor:{
        show: true,
        zoom:true,
        showTooltip:false
      } ,		
    axesDefaults: {
        tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
        tickOptions: {
          fontFamily: 'Georgia',
          fontSize: '8pt',
          angle: -90
        }
    },

    axes: {
      xaxis: {
        renderer: $.jqplot.CategoryAxisRenderer
      }
    }
	
	
  });
  

       /* $('#chart2').bind('jqplotDataHighlight', 
            function (ev, seriesIndex, pointIndex, data) {
                $('#info2').html('Valores: '+data);
            }
        );*/
            
        $('#chart4').bind('jqplotDataUnhighlight', 
            function (ev) {
                $('#info2').html('Nothing');
            }
        );
				
		
				
    });</script>
    


<!-- Don't touch this! -->

<!--
    <script class="include" type="text/javascript" src="../grafico/jquery.jqplot.min.js"></script> -->
    <script type="text/javascript" src="../grafico/examples/syntaxhighlighter/scripts/shCore.min.js"></script>
    <script type="text/javascript" src="../grafico/examples/syntaxhighlighter/scripts/shBrushJScript.min.js"></script>
    <script type="text/javascript" src="../grafico/examples/syntaxhighlighter/scripts/shBrushXml.min.js"></script>
<!-- Additional plugins go here -->

  <script  type="text/javascript" src="../grafico/jquery.jqplot.min.js"></script>
  <script type="text/javascript" src="../grafico/plugins/jqplot.barRenderer.min.js"></script>
  <script type="text/javascript" src="../grafico/plugins/jqplot.pieRenderer.min.js"></script>
  <script  type="text/javascript" src="../grafico/plugins/jqplot.categoryAxisRenderer.min.js"></script>
  <script type="text/javascript" src="../grafico/plugins/jqplot.pointLabels.min.js"></script>
  <script type="text/javascript" src="../grafico/plugins/jqplot.dateAxisRenderer.min.js"></script>
<script type="text/javascript" src="../grafico/plugins/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="../grafico/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>

<!-- End additional plugins -->

<!--http://www.jqplot.com/tests/rotated-tick-labels.php
	</div>	 -->
	<script type="text/javascript" src="../grafico/examples/example.min.js"></script>
	</body>


</html>
