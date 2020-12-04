<?php
//wind_driection

?>


<script>
	var wmsUrl_arw_3km_1h = "https://geoportale.lamma.rete.toscana.it/geoserver/ARW_3KM_RUN00/ows?"
	var arw_3km_1h = L.tileLayer.wms(wmsUrl_arw_3km_1h, {
		layers: 'arw_3km_Total_precipitation_surface_1_Hour_Accumulation_20201204T000000000Z',
		format: 'image/png',
		transparent: true,
		attribution: 'Consorzio Lamma'
	});
	//map.addLayer(wmsLayer);

	var td_arw_3km_1h = L.timeDimension.layer.wms(arw_3km_1h);
	td_arw_3km_1h.addTo(map); // questo è il duplicato di quello che c'è sotto
	map.addLayer(arw_3km_1h);
</script>