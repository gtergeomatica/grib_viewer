<?php
//wind_driection

?>


<script>
	var piano_pc_wmsUrl = "https://www.gishosting.gter.it/lizmap-web-client/lizmap/www/index.php/lizmap/service/?repository=risqueau&project=piano_pc&"
	var aree_elic = L.tileLayer.wms(piano_pc_wmsUrl, {
		layers: 'AREE_ELIC',
		format: 'image/png',
		transparent: true/*,
        opacity: 0.3,
		attribution: 'Consorzio Lamma'*/
	});
    var infrastr = L.tileLayer.wms(piano_pc_wmsUrl, {
		layers: 'Infrastrutture',
		format: 'image/png',
		transparent: true/*,
        opacity: 0.3,
		attribution: 'Consorzio Lamma'*/
	});
    var ist_scol = L.tileLayer.wms(piano_pc_wmsUrl, {
		layers: 'Istituti_scolastici',
		format: 'image/png',
		transparent: true/*,
        opacity: 0.3,
		attribution: 'Consorzio Lamma'*/
	});
    var prot = L.tileLayer.wms(piano_pc_wmsUrl, {
		layers: 'Sedi_prot',
		format: 'image/png',
		transparent: true/*,
        opacity: 0.3,
		attribution: 'Consorzio Lamma'*/
	});
    var rice = L.tileLayer.wms(piano_pc_wmsUrl, {
		layers: 'sedi_rice',
		format: 'image/png',
		transparent: true/*,
        opacity: 0.3,
		attribution: 'Consorzio Lamma'*/
	});
    var socc = L.tileLayer.wms(piano_pc_wmsUrl, {
		layers: 'sedi_socc',
		format: 'image/png',
		transparent: true/*,
        opacity: 0.3,
		attribution: 'Consorzio Lamma'*/
	});
    var acquedotti = L.tileLayer.wms(piano_pc_wmsUrl, {
		layers: 'Aquedotti_principali',
		format: 'image/png',
		transparent: true/*,
        opacity: 0.3,
		attribution: 'Consorzio Lamma'*/
	});
    var censimento = L.tileLayer.wms(piano_pc_wmsUrl, {
		layers: 'censimento_interrati',
		format: 'image/png',
		transparent: true/*,
        opacity: 0.3,
		attribution: 'Consorzio Lamma'*/
	});
    var aree_em = L.tileLayer.wms(piano_pc_wmsUrl, {
		layers: 'AREE_EMERGENZA',
		format: 'image/png',
		transparent: true/*,
        opacity: 0.3,
		attribution: 'Consorzio Lamma'*/
	});
    var aree_comp_em = L.tileLayer.wms(piano_pc_wmsUrl, {
		layers: 'AREE_COMP_EMERG',
		format: 'image/png',
		transparent: true/*,
        opacity: 0.3,
		attribution: 'Consorzio Lamma'*/
	});
    var effetti = L.tileLayer.wms(piano_pc_wmsUrl, {
		layers: 'Carta_effetti_sito',
		format: 'image/png',
		transparent: true/*,
        opacity: 0.3,
		attribution: 'Consorzio Lamma'*/
	});
    var insed = L.tileLayer.wms(piano_pc_wmsUrl, {
		layers: 'Aree_insediate',
		format: 'image/png',
		transparent: true/*,
        opacity: 0.3,
		attribution: 'Consorzio Lamma'*/
	});
    var conf_com = L.tileLayer.wms(piano_pc_wmsUrl, {
		layers: 'limiti_amministrativi_comune',
		format: 'image/png',
		transparent: true/*,
        opacity: 0.3,
		attribution: 'Consorzio Lamma'*/
	});
    
/*     var arw_3km_1h_prec_legend = L.control({
    position: 'bottomright'
    });
    arw_3km_1h_prec_legend.onAdd = function(map) {
        var src = piano_pc_wmsUrl + "service=WMS&request=GetLegendGraphic&format=image/png&width=20&height=20&layer=arw_3km_Total_precipitation_surface_1_Hour_Accumulation_" + layerName + "&";
        var div = L.DomUtil.create('div', 'info legend');
        div.innerHTML +=
            '<span class="modallegend">Cumulata precipitazione oraria ARW 3km</span><br><img src="' + src + '" alt="legend" style="width: 70%;">';
        return div;
    };
    
    var arw_3km_1h_hu_legend = L.control({
    position: 'bottomright'
    });
    arw_3km_1h_hu_legend.onAdd = function(map) {
        var src = piano_pc_wmsUrl + "service=WMS&request=GetLegendGraphic&format=image/png&width=20&height=20&layer=arw_3km_Relative_humidity_height_above_ground_" + layerName + "&";
        var div = L.DomUtil.create('div', 'info legend');
        div.innerHTML +=
            '<span class="modallegend">Umidità relativa al suolo</span><br><img src="' + src + '" alt="legend" style="width: 70%;">';
        return div;
    }; */
    
	/* td_arw_3km_1h.addTo(map);  the timedimension layer must be added to map after adding layertree control in order to display map on page load*/
</script>