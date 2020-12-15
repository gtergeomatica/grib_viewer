<?php
//wind_driection

?>


<script>
slider = L.control.slider(function(value) {
	//console.log(value);
	
	
	d3.text('./data/cum_rain_'+value+'.asc', function (rain) {
			if (check>0){
				map.removeLayer(cum_rain);
			} 
			let s = L.ScalarField.fromASCIIGrid(rain);
            cum_rain = L.canvasLayer.scalarField(s, {
                color: chroma.scale('PuBu').domain(s.range),
                opacity: 0.5
            });
			
			map.addLayer(cum_rain);
			check=1;
			cum_rain.on('click', function (e) {
				if (e.value !== null) {
					let rv = e.value.toFixed(3);
					let html = (`<span class="popupText">${rv} mm</span>`);
					let popup = L.popup()
						.setLatLng(e.latlng)
						.setContent(html)
						.openOn(map);
				}
			});
		//});
	});
},{
	//slider rain
	max: 47,
	min:1,
	value: <?php echo $hour;?>,
	step:1,
	size: '250px',
	logo:'W.D.',
	title: 'Precipitation Accumulation from <?php echo $start_date;?> 00:00 to <?php echo $end_date;?> 23:59',
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