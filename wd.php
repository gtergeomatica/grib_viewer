<?php
//wind_driection

?>


<script>
slider = L.control.slider(function(value) {
	console.log(value);
	
	
	d3.text('./data/ws_u_'+value+'.asc', function (u) {
		d3.text('./data/ws_v_'+value+'.asc', function (v) {
			if (check>0){
				//alert('Sono entrato qua. Check='+check+' e value='+value+'');
				//alert('Sono qua');
				map.removeLayer(vento);
				//map.removeLayer(magnitude);
				//var vf;
				//let vf;
			} 
			let vf = L.VectorField.fromASCIIGrids(u, v);
			/*s = vf.getScalarField('magnitude');
			magnitude = L.canvasLayer.scalarField(s, {
			color: chroma.scale(
				['#1F263A', '#414AA9', '#44758C', '#399B58', 'DCD296', 'F2E899', 'A53E3C', '9C3333'], [.1, .2, .3, .4, .7, .9, 1.5, 2]
			),
			opacity: 0.65
		});
			map.addLayer(magnitude);*/
			vento = L.canvasLayer.vectorFieldAnim(vf, {
			paths: 800,
			//color: 'white', // html-color | function colorFor(value) [e.g. chromajs.scale]
			//width: 1.0, // number | function widthFor(value)
			//fade: 0.96, // 0 to 1
			//duration: 20, // milliseconds per 'frame'
			maxAge: 200, // number of maximum frames per path
			//velocityScale: 1 / 5000
		});
			
			map.addLayer(vento);
			//map.fitBounds(vento.getBounds());
			check=1;
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
			}); // {onClick: callback} inside 'options' is also supported when using layer contructor
		});
	});
},{
	//slider vento
	max: 47,
	min:1,
	value: <?php echo $hour;?>,
	step:1,
	size: '250px',
	logo:'W.D.',
	title: 'Wind direction from <?php echo $start_date;?> 00:00 to <?php echo $end_date;?> 23:59',
	orientation:'horizontal',
	collapsed: false,
	position: 'bottomleft',
    increment: true,
    getValue: function(value) {
        //var data = "<?php echo $start_date;?>";
        // return 'Wind direction from <?php echo $start_date;?> to <?php echo $end_date;?>, hour:' + value;
        var mydata = new Date("November 29, 2020");
        //console.log(mydata)
        var aux = mydata.setHours(value);
        return 'Wind direction at ' + mydata.setHours(value);
    },
	id: 'slider'
}).addTo(map);

</script>