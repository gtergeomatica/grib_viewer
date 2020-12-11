<?php
//wind_driection

?>
<script>
    map.on('overlayadd', function(eventLayer) {
    if (eventLayer.name == 'Previsioni LAMMA <br> (Cumulata precipitazione oraria ARW 3km)') {
        arw_3km_1h_prec_legend.addTo(this);
        $("span#lammalegend").append($(".info.legend.leaflet-control"));
        //$("span#lammalegend div.info.legend.leaflet-control").attr("id", "rain");
        //$("span#lammalegend div.info.legend.leaflet-control.rain").prepend('<span class="modallegend">Previsioni LAMMA (Cumulata precipitazione oraria ARW 3km)</span>');
    } else if (eventLayer.name == 'Previsioni LAMMA <br> (Umidità relativa al suolo)') {
        arw_3km_1h_hu_legend.addTo(this);
        $("span#lammalegend").append($(".info.legend.leaflet-control"));
        //$("span#lammalegend div.info.legend.leaflet-control").attr("id", "hum");
        //$("span#lammalegend div.info.legend.leaflet-control.hum").prepend('<span class="modallegend">Previsioni LAMMA (Umidità relativa al suolo)</span>');
    }/* else if (eventLayer.name == 'SAPO - direction of the peak') {
        sapoPeakDirectionLegend.addTo(this);
    } */
    });

    map.on('overlayremove', function(eventLayer) {
        if (eventLayer.name == 'Previsioni LAMMA <br> (Cumulata precipitazione oraria ARW 3km)') {
            map.removeControl(arw_3km_1h_prec_legend);
        } else if (eventLayer.name == 'Previsioni LAMMA <br> (Umidità relativa al suolo)') {
            map.removeControl(arw_3km_1h_hu_legend);
        } /*else if (eventLayer.name == 'SAPO - direction of the peak') {
            map.removeControl(sapoPeakDirectionLegend);
        } */
    });
</script>