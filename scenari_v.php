<?php 

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        	<?php
	//CSS
	require('./require/require_css.php');
	?>
        <style>
        html, body, #map {
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
        }
        </style>
        <title></title>
    </head>
    <body>
        <div id="map">
        </div>
        <?php
	//javascript
	require('./require/require_js.php');
	?>  
        <script>
        var highlightLayer;
        function highlightFeature(e) {
            highlightLayer = e.target;
            highlightLayer.openPopup();
        }
        var map = L.map('map', {
            zoomControl:true, maxZoom:28, minZoom:1
        }).setView([43.78581, 7.64030], 13);
        //var hash = new L.Hash(map);
        map.attributionControl.setPrefix('<a href="https://github.com/tomchadwin/qgis2web" target="_blank">qgis2web</a> &middot; <a href="https://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> &middot; <a href="https://qgis.org">QGIS</a>');
        //var autolinker = new Autolinker({truncate: {length: 30, location: 'smart'}});
        //var bounds_group = new L.featureGroup([]);
        <!-- function setBounds() {} -->
        //map.createPane('pane_OSMStandard_0');
        //map.getPane('pane_OSMStandard_0').style.zIndex = 400;>
        var layer_OSMStandard_0 = L.tileLayer('http://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            //pane: 'pane_OSMStandard_0',
            opacity: 1.0,
            attribution: '<a href="https://www.openstreetmap.org/copyright">© OpenStreetMap contributors, CC-BY-SA</a>',
            minZoom: 1,
            maxZoom: 28,
            minNativeZoom: 0,
            maxNativeZoom: 19
        });
        layer_OSMStandard_0;
        map.addLayer(layer_OSMStandard_0);
        L.marker([43.78581, 7.64030]).addTo(map)
            .bindPopup("<h4>Vallecrosia</h4>Dati attualmente non disponibili.").openPopup();


        var popup = L.popup();
        //setBounds();
        </script>
    </body>
</html>
<?php 


?>