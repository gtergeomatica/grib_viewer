<?php
//wind_driection

?>


<script>
    //var phpdata = "<?php echo $start_date;?>";
    //var startDate = new Date(phpdata);
    var startDate = new Date();
    startDate.setUTCHours(0, 0, 0, 0);
    
    var timeDimension = new L.TimeDimension({
      timeInterval: startDate.toISOString() + "/PT72H",
      period: "PT1H"
    });
    map.timeDimension = timeDimension; 
    
    L.Control.TimeDimensionCustom = L.Control.TimeDimension.extend({
    _getDisplayDateFormat: function(date){
        return date.toLocaleString([], {year: 'numeric', month:'2-digit', day:'2-digit', hour: '2-digit', minute:'2-digit'});
    }
    });
    
    var timeDimensionControlOptions = {
      timeDimension: timeDimension,
      timeZones: ["Local"],
      /* _getDisplayDateFormat: function(date){
        return date.toLocaleString([], {year: 'numeric', month:'2-digit', day:'2-digit', hour: '2-digit', minute:'2-digit'});
      }, */
      position: 'bottomleft'
    };
    
    // add custom control time dimension(to be used in order to change date and time format in the control slider with function _getDisplayDateFormat)
    var timeDimensionControl = new L.Control.TimeDimensionCustom(timeDimensionControlOptions);
    map.addControl(this.timeDimensionControl);

    // add standard control time dimension
    /* var timeDimensionControl = new L.Control.TimeDimension(timeDimensionControlOptions);
    map.addControl(timeDimensionControl); */

    var layerName = startDate.toISOString().replaceAll("-", "").replaceAll(":", "").replaceAll(".", "")

	var wmsUrl_arw_3km_1h = "https://geoportale.lamma.rete.toscana.it/geoserver/ARW_3KM_RUN00/ows?"
	var arw_3km_1h_prec = L.tileLayer.wms(wmsUrl_arw_3km_1h, {
		layers: 'arw_3km_Total_precipitation_surface_1_Hour_Accumulation_' + layerName,
		format: 'image/png',
		transparent: true,
        opacity: 0.3,
		attribution: 'Consorzio Lamma'
	});

	var td_arw_3km_1h_prec = L.timeDimension.layer.wms(arw_3km_1h_prec,
	{
		updateTimeDimension: true
	});
    
    var arw_3km_1h_hu = L.tileLayer.wms(wmsUrl_arw_3km_1h, {
		layers: 'arw_3km_Relative_humidity_height_above_ground_' + layerName,
		format: 'image/png',
		transparent: true,
        opacity: 0.3,
		attribution: 'Consorzio Lamma'
	});

	var td_arw_3km_1h_hu = L.timeDimension.layer.wms(arw_3km_1h_hu,
	{
		updateTimeDimension: true
	});
    
    var arw_3km_1h_prec_legend = L.control({
    position: 'bottomright'
    });
    arw_3km_1h_prec_legend.onAdd = function(map) {
        var src = wmsUrl_arw_3km_1h + "service=WMS&request=GetLegendGraphic&format=image/png&width=20&height=20&layer=arw_3km_Total_precipitation_surface_1_Hour_Accumulation_" + layerName + "&";
        var div = L.DomUtil.create('div', 'info legend');
        div.innerHTML +=
            '<img src="' + src + '" alt="legend" style="width: 70%;">';
        return div;
    };
    
    var arw_3km_1h_hu_legend = L.control({
    position: 'bottomright'
    });
    arw_3km_1h_hu_legend.onAdd = function(map) {
        var src = wmsUrl_arw_3km_1h + "service=WMS&request=GetLegendGraphic&format=image/png&width=20&height=20&layer=arw_3km_Relative_humidity_height_above_ground_" + layerName + "&";
        var div = L.DomUtil.create('div', 'info legend');
        div.innerHTML +=
            '<img src="' + src + '" alt="legend" style="width: 70%;">';
        return div;
    };
    
	/* td_arw_3km_1h.addTo(map);  the timedimension layer must be added to map after adding layertree control in order to display map on page load*/
</script>