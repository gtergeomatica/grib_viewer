<?php 

require('./data.php');


$origin = strtotime($data);
//echo $origin."<br>";
$target=time();
//$target = strtotime(date("Y-m-d H:i:s"));
//echo $target."<br>";
$hour = round(abs($target - $origin)/(60*60),0);
//echo $hour;
//exit;

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <!--meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1"-->
    <title>Risqueau WebGIS</title>
    <!--meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /-->
	<?php
	//CSS
	require('./require/require_css.php');
	?>
  </head>
  <body class="text-center">
  <!--div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column"-->
  <div class="cover-container">
  <header class="masthead mb-auto">
    <div class="inner">
      <h1 class="masthead-brand">Demo Risqueau WebGIS</h1>
      <!--nav class="nav nav-masthead justify-content-center">
        <a class="nav-link active" href="#">Home</a>
        <a class="nav-link" href="#">Features</a>
        <a class="nav-link" href="#">Contact</a>
      </nav-->
    </div>
  </header>
  <div id="map"></div>



	<?php
	//javascript
	require('./require/require_js.php');
	?>  
  

  <!--main role="main" class="inner cover">
    <h1 class="cover-heading">Cover your page.</h1>
    <p class="lead">Cover is a one-page template for building simple and beautiful home pages. Download, edit the text, and add your own fullscreen background photo to make it your own.</p>
    <p class="lead">
      <a href="#" class="btn btn-lg btn-secondary">Learn more</a>
    </p>
  </main-->
  <script>
		//aa
		//let map = L.map('map');
		let map = L.map('map').setView([43.5, 6.912661], 10);
        var check=0;
        let vento;
        let magnitude;
        //var vento1;
        //var vento2;
        //var vf;
        /* Basemap */
        let url = 'https://cartodb-basemaps-{s}.global.ssl.fastly.net/dark_nolabels/{z}/{x}/{y}.png';
        var cartodb = L.tileLayer(url, {
            attribution: 'OSM & Carto',
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(map);



		// measure plugin
		/*var measureControl = new L.Control.Measure({
            primaryLengthUnit: 'meters',
            secondaryLengthUnit: 'kilometers',
            primaryAreaUnit: 'sqmeters',
            secondaryAreaUnit: 'hectares'
        });
        measureControl.addTo(map);
		*/
		
		var realvista = L.tileLayer.wms("https://mappe.comune.genova.it/realvista/reflector/open/service", {
                layers: 'rv1',
                format: 'image/jpeg',attribution: '<a href="http://www.realvista.it/website/Joomla/" target="_blank">RealVista &copy; CC-BY Tiles</a>.'
              });

        var basemap2 = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors,<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>,Tiles courtesy of <a href="http://hot.openstreetmap.org/" target="_blank">Humanitarian OpenStreetMap Team</a>',
            maxZoom: 28
        });



</script>

<?php
// qua sarà da metter una scelta in funzione di quello che vuole vedere l'utente
// forse nella pagina in basso
require('wd.php');
?>

        
<script>	
	var pluvio_siac0 = [
		<?php 
		require('./pluviometri.php');
		?>
		];
		
		var icon_pluvui_siac = L.icon({
		  iconUrl: 'icon/segn_no_lavorazione.png',
		  //iconSize: [32, 37],
		  iconSize: [19,22],
		  iconAnchor: [16, 37],
		  popupAnchor: [0, -28]
		});
		
		var pluvio_siac = L.geoJson(pluvio_siac0, {
		    pointToLayer: function (feature, latlng) {
		        //return L.circleMarker(latlng, stile_non_lavorazione);
		        return L.marker(latlng, {title: '<font color="#FFA500"> S.'+feature.properties.id + '-'+feature.properties.criticita + ' - '+feature.properties.localizzazione +'</font>',icon: icon_pluvui_siac});
		    }
		    ,
			onEachFeature: function (feature, layer) {
				layer.bindPopup('<div align="right" style="color:grey"><i class="fas fa-pause-circle"></i> Pluviometri </div>'+
				'<h4><b>Nome</b>: '+
				feature.properties.name+'</h4>'+
				'<h4><b>Descrizione</b>: '+
				feature.properties.descr+'</h4>'+
				'<a class="btn btn-primary active" role="button" href="./grafici_pluvio.php?id='+
				feature.properties.id +
				'"> Grafici </a>' );
			}
		});
		map.addLayer(pluvio_siac);
		
		// gruppo con le baselayers
		var baseLayers = {
        		'OpenStreetMap': basemap2, 
        		'Realvista e-geos': realvista,
        		'CartoDB': cartodb
        	};
		
		// gruppo con gli strumenti e altre eventuali mappe
        var overlayLayers = {'<img src="icon/segn_no_lavorazione.png" width="20" height="24" alt=""> Pluviometri': pluvio_siac//,
        //,'Vento1': vento1,'vento2': vento2//'<img src="icon/segn_lavorazione.png" width="20" height="24" alt="">  Segnalazioni in lavorazione': markers1,
        //'<img src="icon/segn_chiusa.png" width="20" height="24" alt="">  Segnalazioni chiuse': layer_v_segnalazioni_2,
        //'<img src="icon/sopralluogo.png" width="20" height="24" alt="">  Altri presidi': presidi,
        //'<img src="icon/elemento_rischio.png" width="20" height="24" alt=""> Provvedimenti cautelari':pc
        }

		
        //legenda
        L.control.layers(baseLayers,overlayLayers,
        {collapsed:true,
		position: 'bottomleft'}
        ).addTo(map);


		//inizialize Leaflet List Markers
		/*var list0 = new L.Control.ListMarkers({layer: pluvio_siac, maxZoom:14, label: 'title', itemIcon: null});
		
		list0.on('item-mouseover', function(e) {
			e.layer.setIcon(L.icon({
				iconUrl: './leaflet-list-markers/images/select-marker.png'
			}))
		}).on('item-mouseout', function(e) {
			e.layer.setIcon(L.icon({
				iconUrl: 'icon/segn_no_lavorazione.png'
			}))
		});

		map.addControl( list0 );*/

	
        
		//setBounds();
	
	
    </script>

  <footer class="mastfoot mt-auto">
    <div class="inner">
      <p>Cover template for <a href="https://getbootstrap.com/">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
    </div>
  </footer>
</div>
<style>
#map{
    height:80%;
}
</style>
</body>
</html>
<?php 


?>