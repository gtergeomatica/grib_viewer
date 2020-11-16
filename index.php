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
    <title>Risqueau WebGIS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- jquery -->
    <!--script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script-->
    
    <!-- CDN -->
    <!--link rel="stylesheet" href="//unpkg.com/leaflet@1.4.0/dist/leaflet.css" /-->
	<link rel="stylesheet" href="./vendor/Leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="examples.css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,400" rel="stylesheet">
    <!-- Plugin -->
    <link rel="stylesheet" href="./vendor/leaflet-slider/dist/leaflet-slider.css"/>
	<link href="./vendor/leaflet-list-markers/src/leaflet-list-markers.css" rel="stylesheet" type="text/css">
</head>

<body>
    <h1 class="title mapTitle">Demo Risqueau WebGIS</h1>
    <div id="map"></div>

    <!-- CDN -->
    <script src="//d3js.org/d3.v4.min.js"></script>
    <!--script src="//npmcdn.com/leaflet@1.4.0/dist/leaflet.js"></script-->
	<script src="./vendor/Leaflet/dist/leaflet.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/chroma-js/2.1.0/chroma.min.js"></script>

    <!-- Plugin -->

    <script src="./vendor/Leaflet.CanvasLayer.Field/dist/leaflet.canvaslayer.field.js"></script>
    <script src="./vendor/leaflet-slider/dist/leaflet-slider.js"></script>
	<script src="./vendor/Leaflet.markercluster-1.4.1/dist/leaflet.markercluster.js"></script>
	<script src="./vendor/leaflet-list-markers/src/leaflet-list-markers.js"></script>



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







        slider = L.control.slider(function(value) {
            console.log(value);
            
            
            d3.text('./data/ws_u_'+value+'.asc', function (u) {
                d3.text('./data/ws_v_'+value+'.asc', function (v) {
                    if (value>1 || check>0){
                        //alert('Sono entrato qua. Check='+check+' e value='+value+'');
						//alert('Sono qua');
						map.removeLayer(vento);
						//map.removeLayer(magnitude);
						//var vf;
						//let vf;
                    } 
					let vf = L.VectorField.fromASCIIGrids(u, v);
					/*s = vf.getScalarField('magnitude');
					magnitude = L.canvasLayer.scalarField(s, {
                    color: chroma.scale(
                        ['#1F263A', '#414AA9', '#44758C', '#399B58', 'DCD296', 'F2E899', 'A53E3C', '9C3333'], [.1, .2, .3, .4, .7, .9, 1.5, 2]
                    ),
                    opacity: 0.65
                });
					map.addLayer(magnitude);*/
					vento = L.canvasLayer.vectorFieldAnim(vf, {
					paths: 800,
					//color: 'white', // html-color | function colorFor(value) [e.g. chromajs.scale]
					//width: 1.0, // number | function widthFor(value)
					//fade: 0.96, // 0 to 1
					//duration: 20, // milliseconds per 'frame'
					maxAge: 200, // number of maximum frames per path
					//velocityScale: 1 / 5000
				});
					
					map.addLayer(vento);
                    //map.fitBounds(vento.getBounds());
                    check=1;
                    vento.on('click', function (e) {
                        if (e.value !== null) {
                            let vector = e.value;
                            let vv = vector.magnitude().toFixed(2);
                            let d = vector.directionTo().toFixed(0);
                            let html = ('<span class="popupText">${vv} m/s to ${d}&deg</span>');
                            let popup = L.popup()
                                .setLatLng(e.latlng)
                                .setContent(html)
                                .openOn(map);
                        }
                    }); // {onClick: callback} inside 'options' is also supported when using layer contructor
                });
            });

        }, {
		//slider vento
        max: 47,
        min:0,
        value: <?php echo $hour;?>,
        step:1,
        size: '250px',
		logo:'W.D.',
		title: 'Wind direction from <?php echo $start_date;?> 00:00 to <?php echo $end_date;?> 23:59',
        orientation:'horizontal',
        collapsed: true,
        position: 'bottomleft',
        id: 'slider'
    }).addTo(map);
	
	var segn_non_lav = [
		<?php 
		require('./pluviometri.php');
		?>
		];
		
		var icon_no_lav = L.icon({
		  iconUrl: 'icon/segn_no_lavorazione.png',
		  //iconSize: [32, 37],
		  iconSize: [19,22],
		  iconAnchor: [16, 37],
		  popupAnchor: [0, -28]
		});
		
		var layer_v_segnalazioni_0 = L.geoJson(segn_non_lav, {
		    pointToLayer: function (feature, latlng) {
		        //return L.circleMarker(latlng, stile_non_lavorazione);
		        return L.marker(latlng, {title: '<font color="#FFA500"> S.'+feature.properties.id + '-'+feature.properties.criticita + ' - '+feature.properties.localizzazione +'</font>',icon: icon_no_lav});
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
		map.addLayer(layer_v_segnalazioni_0);
		

		var baseLayers = {
        		'OpenStreetMap': basemap2, 
        		'Realvista e-geos': realvista,
        		'CartoDB': cartodb
        	};
        
        var overlayLayers = {'<img src="icon/segn_no_lavorazione.png" width="20" height="24" alt=""> Pluviometri': layer_v_segnalazioni_0//,
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
		/*var list0 = new L.Control.ListMarkers({layer: layer_v_segnalazioni_0, maxZoom:14, label: 'title', itemIcon: null});
		
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
</body>

</html>
<?php 


?>