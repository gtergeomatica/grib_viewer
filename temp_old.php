<?php
//wind_driection

?>


<script>
slider = L.control.slider(function(value) {
	//console.log(value);
	
	
	d3.text('./data/temp_'+value+'.asc', function (temp) {
			if (check>0){
				map.removeLayer(temperature);
			} 
			let t = L.ScalarField.fromASCIIGrid(temp);
            //console.log(t);
            temperature = L.canvasLayer.scalarField(t, {
            color: chroma.scale(['#2c7bb6', '#abd9e9', '#ffffbf', '#fdae61', '#d7191c']).domain(t.range),
                opacity: 0.5
            });
			
			map.addLayer(temperature);
			check=1;
			temperature.on('click', function (e) {
				if (e.value !== null) {
					let tv = e.value.toFixed(2);
					let html = (`<span class="popupText">${tv}&degC</span>`);
					let popup = L.popup()
						.setLatLng(e.latlng)
						.setContent(html)
						.openOn(map);
				}
			});
		//});
	});
},{
	//slider temperature
	max: 47,
	min:1,
	value: <?php echo $hour;?>,
	step:1,
	size: '250px',
	logo:'W.D.',
	title: 'Temperature 2m above ground from <?php echo $start_date;?> 00:00 to <?php echo $end_date;?> 23:59',
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
        
        return 'Temperature 2m above ground at ' + newdate.toLocaleString([], {year: 'numeric', month:'2-digit', day:'2-digit', hour: '2-digit', minute:'2-digit'});
    },
	id: 'slider'
}).addTo(map);

</script>