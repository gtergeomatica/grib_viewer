<?php
//wind_driection

?>


<script>
    var startDate = new Date();
    startDate.setUTCHours(0, 0, 0, 0);
    
    var timeDimension = new L.TimeDimension({
      timeInterval: startDate.toISOString() + "/PT72H",
      period: "PT1H"
    });
    map.timeDimension = timeDimension; 

    /* var player = new L.TimeDimension.Player({
      transitionTime: 800, 
      loop: false
    }, timeDimension); */
    
    L.Control.TimeDimensionCustom = L.Control.TimeDimension.extend({
    _getDisplayDateFormat: function(date){
        return date.toLocaleString([], {year: 'numeric', month:'2-digit', day:'2-digit', hour: '2-digit', minute:'2-digit'});
    }
    });
    
    var timeDimensionControlOptions = {
      //player: player,
      timeDimension: timeDimension,
      timeZones: ["Local"],
      /* _getDisplayDateFormat: function(date){
        return date.toLocaleString([], {year: 'numeric', month:'2-digit', day:'2-digit', hour: '2-digit', minute:'2-digit'});
      }, */
      position: 'bottomleft'
    };
    
    var timeDimensionControl = new L.Control.TimeDimensionCustom(timeDimensionControlOptions);
    map.addControl(this.timeDimensionControl);

    /* var timeDimensionControl = new L.Control.TimeDimension(timeDimensionControlOptions);
    map.addControl(timeDimensionControl); */

    var layerName = startDate.toISOString().replaceAll("-", "").replaceAll(":", "").replaceAll(".", "")
    console.log(layerName)
	var wmsUrl_arw_3km_1h = "https://geoportale.lamma.rete.toscana.it/geoserver/ARW_3KM_RUN00/ows?"
	var arw_3km_1h = L.tileLayer.wms(wmsUrl_arw_3km_1h, {
		layers: 'arw_3km_Total_precipitation_surface_1_Hour_Accumulation_' + layerName,
		format: 'image/png',
		transparent: true,
        opacity: 0.3,
		attribution: 'Consorzio Lamma'
	});
	//map.addLayer(wmsLayer);
	var td_arw_3km_1h = L.timeDimension.layer.wms(arw_3km_1h,
	{
        //timeInterval: startDate.toISOString() + "/PT72H",
        //timeDimension: timeDimension,
		updateTimeDimension: true/*,
        requestTimeFromCapabilities: true,
        //duration: 'PT60H',
        updateTimeDimensionMode: 'replace'*/
	});
    
    var arw_3km_1h_legend = L.control({
    position: 'bottomright'
    });
    arw_3km_1h_legend.onAdd = function(map) {
        var src = wmsUrl_arw_3km_1h + "service=WMS&request=GetLegendGraphic&format=image/png&width=20&height=20&layer=arw_3km_Total_precipitation_surface_1_Hour_Accumulation_" + layerName + "&";
        var div = L.DomUtil.create('div', 'info legend');
        div.innerHTML +=
            '<img src="' + src + '" alt="legend" style="width: 70%;">';
        return div;
    };
    
	/* td_arw_3km_1h.addTo(map);  */
    
	//map.addLayer(arw_3km_1h);
    //var timeControl = L.Control.TimeDimension().addTo(map);

    //L.control.timeDimension().addTo(map);
</script>