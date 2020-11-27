<?php
//echo "Sono qua<br>";
//$id=$_GET['id'];
$id=$pluviometro;
//echo $id;

//require(explode('emergenze-pcge',getcwd())[0].'emergenze-pcge/conn.php');

//echo strtotime("now");
//echo "<br><br>";
//echo date('Y-m-d H:i:s');
//echo "<br><br>";
//echo date('Y-m-d H:i:s')-3600;
//echo "<br><br>";
$now = new DateTime("now", new DateTimeZone('Europe/Rome'));
//$date = $now->modify('-1 hour')->format('Y-m-d H:i:s');
$date = $now->format('Y-m-d H:i:s');
//$station='Montoggio';
//echo $date;




/*$query="SELECT name, shortcode FROM geodb.tipo_idrometri_arpa";
if ($idrometro!=''){
	$query=$query ." WHERE shortcode='".$idrometro."' ";
}
$query=$query .";";
//echo $query;
$result = pg_query($conn, $query);
while($r = pg_fetch_assoc($result)) {
	$query_soglie="SELECT liv_arancione, liv_rosso FROM geodb.soglie_idrometri_arpa WHERE cod='".$r["shortcode"]."';";
	$result_soglie = pg_query($conn, $query_soglie);
	while($r_soglie = pg_fetch_assoc($result_soglie)) {
		$arancio=$r_soglie['liv_arancione'];
		$rosso=$r_soglie['liv_rosso'];
		$liv_max=$rosso+1;
	}*/
?>
<!-- 2. Add the JavaScript to initialize the chart on document ready -->
<script type="text/javascript">
// con questa riga faccio i grafici nel timezone CEST
Highcharts.setOptions({
global: {
	useUTC: false
}
});
//https://demo-live-data.highcharts.com/aapl-v.json

Highcharts.getJSON('./data/<?php echo $id;?>_PluvioNative.json', function (data) {

    // create the chart
 Highcharts.chart('container_<?php echo $id;?>',
   {
      chart: {
         type: 'column',
         zoomType: 'x',
         panning: true,
         plotBorderWidth: 1,
         panKey: 'shift'
      },
      title: {
           text: 'Dati ultime 12 ore <?php echo $pluvio_name;?>'
      },
      xAxis: {
           type: 'datetime',
           dateTimeLabelFormats: {
               month: '%e. %b'
           },
           title: {
               text: 'Date'
           }
       },
      yAxis: [{
         title: {
            text: 'Précipitations',
            style: {
               color: '#2196F3'
            }
         },
         labels: {
             format: '{value} mm',
             style: {
                 color: '#2196F3'
              }
         },
      }],
      tooltip: {
         xDateFormat: '%A, %b %e',
         valueDecimals: 1,
         valueSuffix: ' mm'
      },
      legend: {
         enabled: false
      },
      series: [{
          data: data,
          name: 'Pioggia',
          color:'#2196F3'
      }]
   });
});
   </script>




	






		
			
<?php
//}
?>