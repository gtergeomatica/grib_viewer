<?php 

require('./data.php');


$origin = strtotime($data);
//echo $origin."<br>";
$target=time();

$milliseconds = round(microtime(true) * 1000);
//echo $milliseconds;
//$target = strtotime(date("Y-m-d H:i:s"));
//echo $target."<br>";

//$hour = round(abs($target - $origin)/(60*60),0);
$hour = intval(abs($target - $origin)/(60*60));

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
    <title>Risqeau WebGIS</title>
    <!--meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /-->
	<?php
	//CSS
	require('./require/require_css.php');
	?>
  </head>
  <body class="text-center">
  <!--div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column"-->
  <div class="cover-container" style="background-color: lavender">
  <?php
	//javascript
	require('./header.php');
	?>
  <div id="map"></div>


	<?php
	//javascript
	require('./require/require_js.php');
	?>  
    
    <script type="text/javascript">
        $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
          if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
          }
          var $subMenu = $(this).next(".dropdown-menu");
          $subMenu.toggleClass('show');


          $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
          });


          return false;
        });
    </script>
  

  <!--main role="main" class="inner cover">
    <h1 class="cover-heading">Cover your page.</h1>
    <p class="lead">Cover is a one-page template for building simple and beautiful home pages. Download, edit the text, and add your own fullscreen background photo to make it your own.</p>
    <p class="lead">
      <a href="#" class="btn btn-lg btn-secondary">Learn more</a>
    </p>
  </main-->
  <script type="text/javascript">
        var startDate = new Date();
        startDate.setUTCHours(0, 0, 0, 0);
		//aa
		//let map = L.map('map');
		let map = L.map('map'/*,{
            timeDimension: true,
            timeDimensionOptions: {
                timeInterval: startDate.toISOString() + "/PT72H",
                //currentTime: <?php echo $milliseconds;?>,
				period: "PT1H"
            },
            timeDimensionControl: true,
        }*/).setView([43.5, 6.912661], 10);
        
		// per mantenere il livello di zoom e center al refresh
		var hash = new L.Hash(map);
		
		
	
        
		
		//*******************************************************************************************************
		//MAPPE DI BASE
        var check=0;
        let vento;
        let cum_rain;
        let temperature;
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
		//*******************************************************************************************************

        

</script>

<!--script>
    function changeSlider() {
      var radioW = document.getElementById("layw");
      var radioR = document.getElementById("layr");
      if (radioW.checked == true){
        <?php
	//javascript
        //require('wd.php');
        ?>  
      } if (radioR.checked == true) {
        <?php
	//javascript
        //require('cum_rain.php');
        ?> 
      }
    }
</script-->

<?php
$wind_status = 'checked';
$rain_status = 'unchecked';
$temp_status = 'unchecked';
if(isset($_POST["layer"])){
    if($_POST["layer"]=='wind'){
        $wind_status = 'checked';
        $rain_status = 'unchecked';
        $temp_status = 'unchecked';
        require('wd.php');
    }
    else if($_POST["layer"]=='rain'){
        $wind_status = 'unchecked';
        $rain_status = 'checked';
        $temp_status = 'unchecked';
        require('cum_rain.php');
    }
    else if($_POST["layer"]=='temp'){
        $wind_status = 'unchecked';
        $rain_status = 'unchecked';
        $temp_status = 'checked';
        require('temp.php');
    }
    
    //echo $_POST["layer"];
}
else{
    require('wd.php');
}
// qua sarà da metter una scelta in funzione di quello che vuole vedere l'utente
// forse nella pagina in basso
//require('wd.php');
require('pianopc_wms.php');
require('time_wms.php');
?>
  <div id="bar"><span>Previsioni ad Alta Risoluzione</span>
  <?php
    //if(isset($_POST['layer']))
    //{
    //echo "The layer you have selected ".$_POST['layer'];
    //}
    ?>
  <form action="" method="post">
  <!--form action="">
      <input type="radio" id="layw" name="layer" onclick="changeSlider()" value="wind" checked>
      <label for="wind">Wind direction</label>
      <input type="radio" id="layr" name="layer" onclick="changeSlider()" value="rain">
      <label for="rain">Precipitation accumulation</label-->
      <input type="radio" id="layw" name="layer" onclick="javascript: submit()" value="wind" <?php print $wind_status; ?>>
      <label for="wind">Velocità del vento</label>
      <input type="radio" id="layp" name="layer" onclick="javascript: submit()" value="rain" <?php print $rain_status; ?>>
      <label for="rain">Cumulata precipitazione 3h</label>
      <input type="radio" id="layt" name="layer" onclick="javascript: submit()" value="temp" <?php print $temp_status; ?>>
      <label for="rain">Temperatura a 2m dal suolo</label>
      <!--input type="submit" value="Submit"-->
    </form></div>
  <div id="lamma"><span>Dati Consorzio LAMMA</span>&nbsp;&nbsp;&nbsp;<!--button type="button" class="btn btn-primary blu" data-toggle="modal" data-target="#exampleModal2" style="margin-left:10px;"><i class="fas fa-info-circle"></i>Legends</button--><a data-toggle="modal" href="#exampleModal2"><i class="fas fa-list-alt"></i>&nbsp;Show Legends</a>
</div>

  <!--script>
        var wmsUrl = "https://geoportale.lamma.rete.toscana.it/geoserver/ARW_3KM_RUN00/ows?"
        var wmsLayer = L.tileLayer.wms(wmsUrl, {
            layers: 'arw_3km_Total_precipitation_surface_1_Hour_Accumulation_20201204T000000000Z',
            attribution: 'Consorzio Lamma'
        });

        var tdWmsLayer = L.timeDimension.layer.wms(wmsLayer);
        tdWmsLayer.addTo(map);
  </script-->
<?php
//****************************************************************
// MODAL GRAFICI
//****************************************************************
$query0="SELECT name, shortcode FROM arpal.pluvio 
UNION 
SELECT name, replace(replace(cod_stazioni,' ','-'),'’','') as shortcode 
FROM monitoraggio.stazioni_risqueau sr
WHERE pluviometro ='t'";

$result0 = pg_query($conn, $query0);
while($r0 = pg_fetch_assoc($result0)) {
?>
	<div id="grafico_pluvio_a<?php echo $r0['shortcode']; ?>" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Grafico <?php echo $r0['name']; ?></h4>
		  </div>
		  <div class="modal-body">
				<?php 
				$pluviometro=$r0["shortcode"];
				$pluvio_name=$r0["name"];
				//echo $pluviometro;
				require('./grafico_pluvio.php'); 
				?>
				<div id="container_pluvio_<?php echo $pluviometro;?>" style="width: 100%; height: 400px"></div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
		  </div>
		</div>
	  </div>
	</div>
	
  <?php
}

  $query0="SELECT name, shortcode FROM arpal.idro 
UNION 
SELECT name, replace(replace(cod_stazioni,' ','-'),'’','') as shortcode 
FROM monitoraggio.stazioni_risqueau sr
WHERE idrometro ='t'";

$result0 = pg_query($conn, $query0);
while($r0 = pg_fetch_assoc($result0)) {
?>
	<div id="grafico_idro_a<?php echo $r0['shortcode']; ?>" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Grafico <?php echo $r0['name']; ?></h4>
		  </div>
		  <div class="modal-body">
				<?php 
				$idrometro=$r0["shortcode"];
				$idro_name=$r0["name"];
				//echo $pluviometro;
				require('./grafico_idro.php'); 
				?>
				<div id="container_idro_<?php echo $idrometro;?>" style="width: 100%; height: 400px"></div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
		  </div>
		</div>
	  </div>
	</div>

  <?php }

  //****************************************************************
  // PAGINA PRINCIPALE HTML
  //****************************************************************
?>

	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><span style="color: #e6335b;">Risq'eau</span> <span style="color: #394283;">WebGIS</span>
        <img class="masthead" src="./icon/logo_risqueau.png" style="max-height: 100px; margin-bottom: 0px !important;"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: justify!important;">
        <span style="color:#394283; text-shadow: 0 0.05rem 0.1rem rgba(0, 0, 0, .0);"><strong><br>The WebGIS has been created by <b><a class="footlink" href="https://www.gter.it/">Gter srl</a></b> as part of the <b>Interreg Alcotra <a class="footlink" href="https://www.risqeau.eu/">Project Risq'eau</a></b> and it has been financed with funds from the <b>INTERREG V A France-Italy cross-border cooperation program (ALCOTRA 2014-2020)</b>.<br><br><br>The WebGIS is completely based on <b>Open Source libraries</b> and its code is available on <b><a class="footlink" href="https://github.com/gtergeomatica/grib_viewer">GitHub</a></b> with license <a class="footlink" href="https://www.gnu.org/licenses/gpl-3.0.html">GNU General Public License v3.0</a>.</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary blu" data-dismiss="modal">Close</button>
        <!--button type="button" class="btn btn-primary">Save changes</button-->
      </div>
    </div>
  </div>
</div>
       
<?php
//********************************************************** */
// Strumenti di misura
//********************************************************** */
?>
	  
<script type="text/javascript">	
	var pluvio_siac0 = [
		<?php 
		require('./pluviometri.php');
		?>
		];
		
		var  icon_pluvio_siac= L.icon({
		  iconUrl: 'icon/pluvio.png',
		  //iconSize: [32, 37],
		  iconSize: [19,22],
		  iconAnchor: [16, 37],
		  popupAnchor: [0, -28]
		});
		
		var pluvio_siac = L.geoJson(pluvio_siac0, {
		    pointToLayer: function (feature, latlng) {
		        //return L.circleMarker(latlng, stile_non_lavorazione);
		        return L.marker(latlng, {title: '<font color="#FFA500"> S.'+feature.properties.id + '-'+feature.properties.criticita + ' - '+feature.properties.localizzazione +'</font>',icon: icon_pluvio_siac});
		    }
		    ,
			onEachFeature: function (feature, layer) {
				layer.bindPopup('<div align="right" style="color:grey"><i class="fas fa-pause-circle"></i> Pluviometri </div>'+
				'<b>Nome</b>: '+
				feature.properties.name+'<br>'+
				'<b>Descrizione</b>: '+
				feature.properties.descr+'<br><br>'+
				'<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#grafico_pluvio_a'+feature.properties.id+'">\<i class="fas fa-chart-line" title="Visualizza grafico pluviometro"></i>Grafico </button>' );
			}
		});
		map.addLayer(pluvio_siac);



		var idro_siac0 = [
		<?php 
		require('./idrometri.php');
		?>
		];
		
		var  icon_idro_siac= L.icon({
		  iconUrl: 'icon/idro.png',
		  //iconSize: [32, 37],
		  iconSize: [19,22],
		  iconAnchor: [16, 37],
		  popupAnchor: [0, -28]
		});
		
		var idro_siac = L.geoJson(idro_siac0, {
		    pointToLayer: function (feature, latlng) {
		        //return L.circleMarker(latlng, stile_non_lavorazione);
		        return L.marker(latlng, {title: '<font color="#FFA500"> S.'+feature.properties.id + '-'+feature.properties.criticita + ' - '+feature.properties.localizzazione +'</font>',icon: icon_idro_siac});
		    }
		    ,
			onEachFeature: function (feature, layer) {
				layer.bindPopup('<div align="right" style="color:grey"><i class="fas fa-pause-circle"></i> Idrometri </div>'+
				'<b>Nome</b>: '+
				feature.properties.name+'<br>'+
				'<b>Descrizione</b>: '+
				feature.properties.descr+'<br><br>'+
				'<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#grafico_idro_a'+feature.properties.id+'">\<i class="fas fa-chart-line" title="Visualizza grafico pluviometro"></i>Grafico </button>' );
			}
		});
		map.addLayer(idro_siac);
		
		
		
		// gruppo con le baselayers
		/* var baseLayers = {
        		'OpenStreetMap': basemap2, 
        		'Realvista e-geos': realvista,
        		'CartoDB': cartodb
        	}; */
		
		// gruppo con gli strumenti e altre eventuali mappe
        /* var overlayLayers = {'<img src="icon/pluvio.png" width="20" height="24" alt=""> Pluviometri': pluvio_siac,
		'Previsioni LAMMA <br> (Cumulata precipitazione oraria ARW 3km)': td_arw_3km_1h_prec,
        'Previsioni LAMMA <br> (Umidità relativa al suolo)': td_arw_3km_1h_hu
        //,'Vento1': vento1,'vento2': vento2//'<img src="icon/segn_lavorazione.png" width="20" height="24" alt="">  Segnalazioni in lavorazione': markers1,
        //'<img src="icon/segn_chiusa.png" width="20" height="24" alt="">  Segnalazioni chiuse': layer_v_segnalazioni_2,
        //'<img src="icon/sopralluogo.png" width="20" height="24" alt="">  Altri presidi': presidi,
        //'<img src="icon/elemento_rischio.png" width="20" height="24" alt=""> Provvedimenti cautelari':pc
        } */
        
        function iconByName(name) {
            return '<i class="icon icon-'+name+'"></i>';
        }

        
        var baseLayers = [
            {
                group: "Base maps",
                //icon: iconByName('sfondi'),
                collapsed: true,
                layers: [
                    {
                        name: "CartoDB",
                        //icon: iconByName('drinking_water'),
                        layer: cartodb
                    },
                    {
                        name: "OpenStreetMap",
                        //icon: iconByName('drinking_water'),
                        layer: basemap2
                    },
                    {
                        name: "Realvista e-geos",
                        //icon: iconByName('drinking_water'),
                        layer: realvista
                    }
                ]
            }
        ];
        
        var overLayers = [
          {
                group: "Strumenti misura",
                icon: iconByName('strumenti'),
                collapsed: false,
                layers: [{
                        name: "Pluviometri",
                        icon: iconByName('pluvio'),
                        layer: pluvio_siac
                        },{
                        name: "Idrometri",
                        icon: iconByName('idro'),
                        layer: idro_siac
                        }
              ]},
          {
              group: "Previsioni LAMMA",
              icon: iconByName('lamma'),
              collapsed: true,
              layers: [
                    {
                        name: "Cumulata precipitazione oraria ARW 3km",
                        //icon: iconByName('drinking_water'),
                        layer: td_arw_3km_1h_prec
                    },
                    {
                        name: "Umidità relativa al suolo",
                        //icon: iconByName('fuel'),
                        layer: td_arw_3km_1h_hu
                    }
                ]
            },
            {
                group: "Piano Protezione Civile",
                icon: iconByName('lamma'),
                collapsed: true,
                layers: [
                    {
                        name: "Limiti amministrativi",
                        //icon: iconByName('drinking_water'),
                        layer: conf_com
                    },
                    {
                        name: "Aree insediate",
                        //icon: iconByName('drinking_water'),
                        layer: insed
                    },
                    {
                        name: "Carta effetti sito",
                        //icon: iconByName('drinking_water'),
                        layer: effetti
                    },
                    {
                        name: "Aree competenza emergenza",
                        //icon: iconByName('drinking_water'),
                        layer: aree_comp_em
                    },
                    {
                        name: "Aree emergenza",
                        //icon: iconByName('drinking_water'),
                        layer: aree_em
                    },
                    {
                        name: "Censimento interrati",
                        //icon: iconByName('drinking_water'),
                        layer: censimento
                    },
                    {
                        name: "Acquedotti principali",
                        //icon: iconByName('drinking_water'),
                        layer: acquedotti
                    },
                    {
                        name: "Sedi enti di soccorso per emergenza",
                        //icon: iconByName('drinking_water'),
                        layer: socc
                    },
                    {
                        name: "Sedi ricettività",
                        //icon: iconByName('drinking_water'),
                        layer: rice
                    },
                    {
                        name: "Sedi protezione civile",
                        //icon: iconByName('drinking_water'),
                        layer: prot
                    },
                    {
                        name: "Istituti scolastici",
                        //icon: iconByName('drinking_water'),
                        layer: ist_scol
                    },
                    {
                        name: "Infrastrutture",
                        //icon: iconByName('fuel'),
                        layer: infrastr
                    },
                    {
                        name: "Aree atterraggio elicotteri",
                        //icon: iconByName('drinking_water'),
                        layer: aree_elic
                    }
                ]
            }
        ];
        
        </script>
        <?php 
		require('./add_timewms_legend.php');
		?>
        
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><span style="color: #e6335b;">Risq'eau</span> <span style="color: #394283;">WebGIS</span>
        <img class="masthead" src="./icon/logo_risqueau.png" style="max-height: 100px; margin-bottom: 0px !important;"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: left!important;">
        <span id="lammalegend" ></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary blu" data-dismiss="modal">Close</button>
        <!--button type="button" class="btn btn-primary">Save changes</button-->
      </div>
    </div>
  </div>
</div>
        
        <script type="text/javascript">
		
        //legenda
        /* L.control.layers(baseLayers,overlayLayers,
        {collapsed:false,
		position: 'bottomleft'}
        ).addTo(map); */
        
        var panelLayers = new L.Control.PanelLayers(baseLayers, overLayers, {
            collapsibleGroups: true,
            collapsed: true
        });
        map.addControl(panelLayers);
        
        //add timeDimension Layer to map (must be run after layer tree initialisation)
        //commented in order to made the not checked by default
        //td_arw_3km_1h_prec.addTo(map);
        //td_arw_3km_1h_hu.addTo(map); 
        
        
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
    <script type="text/javascript">
        // move the control slider outside the map
        $('#bar').append(slider.onAdd(map))
        $('.leaflet-control-slider.leaflet-control-slider-horizontal.leaflet-control-slider-expanded.leaflet-control').remove()
        $('#lamma').append(timeDimensionControl.onAdd(map))
        //$('.leaflet-bar-timecontrol').prepend("<span>Test</span>")
        $('.leaflet-bar.leaflet-bar-horizontal.leaflet-bar-timecontrol.leaflet-control').remove()
    </script>
  <footer class="mastfoot mt-auto" style="background-color: lavender">
    <div class="inner">
    <!--div id="test"></div-->
	<br><br>
    <hr>
	<button type="button" class="btn btn-primary blu" data-toggle="modal" data-target="#exampleModal" style="margin-top:20px;"><i class="fas fa-info-circle"></i>
  Credits
</button>
	<br>
      <p style="color:#394283;"><b><a class="footlink" style="color:#394283;" href="https://www.gter.it/">Gter</a> Copyleft, 2020. Starting from the <i>Cover</i> template for <a class="footlink" style="color:#394283;" href="https://getbootstrap.com/">Bootstrap</a>, by <a class="footlink" style="color:#394283;" href="https://twitter.com/mdo">@mdo</a>.</b></p>
    </div>
  </footer>
      <!--script>
        // move the control slider outside the map
        $('#test').append(slider.onAdd(map))
        $('.leaflet-control-slider.leaflet-control-slider-horizontal.leaflet-control-slider-expanded.leaflet-control').remove()
        //$("p.leaflet-control-slider-value").html($("a.leaflet-control-slider-toggle").attr("title"))
    </script-->
</div>
</body>
</html>
<?php 


?>