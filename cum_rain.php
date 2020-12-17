<?php
//wind_driection

?>


<script>
slider = L.control.slider(function(value) {
	//console.log(value);
	
	
    d3.text('./data/ws_u_'+value+'.asc', function (u) {
		d3.text('./data/ws_v_'+value+'.asc', function (v) {
            d3.text('./data/cum_rain_3h_'+value+'.asc', function (rain) {
                if (check>0){
                    map.removeLayer(vento);
                    map.removeLayer(cum_rain);
                    colorbar.remove();
                }
                let vf = L.VectorField.fromASCIIGrids(u, v);
                    vento = L.canvasLayer.vectorFieldAnim(vf, {
                        paths: 800,
                        maxAge: 200,
                });
                let s = L.ScalarField.fromASCIIGrid(rain);
                //let s = L.ScalarField.fromGeoTIFF(rain.response, bandIndex = 0);

                var range = s.range;
                var scale = chroma.scale('PuBu').domain(s.range);
                cum_rain = L.canvasLayer.scalarField(s, {
                    color: scale,
                    opacity: 0.5
                });
                
                map.addLayer(cum_rain);
                map.addLayer(vento);
                check=1;
                
                colorbar = L.control.colorBar(scale, range, {
                    title: 'Precipitation accumulation (mm)',
                    units: 'mm',
                    steps: 100,
                    decimals: 1,
                    width: 350,
                    height: 20,
                    position: 'bottomleft',
                    background: 'rgba(0, 0, 0, .2)',
                    textColor: 'white',
                    textLabels: [range[0].toFixed(0), range[1].toFixed(0)],
                    labels: [range[0], range[1]],
                    labelFontSize: 9
                }).addTo(map);
                
                vento.on('click', function (e) {
                        if (e.value !== null) {
                            let vector = e.value;
                            let vv = vector.magnitude().toFixed(2);
                            let d = vector.directionTo().toFixed(0);
                            let html = (`<span class="popupText">${vv} m/s to ${d}&deg</span>`);
                            let popup = L.popup()
                                .setLatLng(e.latlng)
                                .setContent(html)
                                .openOn(map);
                        }
                });
                /* cum_rain.on('click', function (e) {
                    if (e.value !== null) {
                        let rv = e.value.toFixed(3);
                        let html = (`<span class="popupText">${rv} mm</span>`);
                        let popup = L.popup()
                            .setLatLng(e.latlng)
                            .setContent(html)
                            .openOn(map);
                    }
                }); */
            });
        });
	});
},{
	//slider rain
	max: 48,
	min:3,
	value: <?php echo $hour;?>,
	step:1,
	size: '250px',
	logo:'W.D.',
	title: 'Cumulata di precipitazione sulle 3h - Dal <?php echo $start_date;?> 03:00 al <?php echo $end_date;?> 23:59',
	orientation:'horizontal',
	collapsed: false,
	position: 'bottomleft',
    increment: true,
    getValue: function(value) {
        var phpdata = "<?php echo $start_date;?>";
        // return 'Wind direction from <?php echo $start_date;?> to <?php echo $end_date;?>, hour:' + value;
        var mydata = new Date(phpdata);
        //console.log(mydata)
        var myhour = mydata.setHours(value);
        var newdate = new Date(myhour);
        
        return 'Precipitation Accumulation at ' + newdate.toLocaleString([], {year: 'numeric', month:'2-digit', day:'2-digit', hour: '2-digit', minute:'2-digit'});
    },
	id: 'slider'
}).addTo(map);

</script>