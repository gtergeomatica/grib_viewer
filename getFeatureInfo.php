<?php
//wind_driection

?>
  <script>
        var getPopupContent = function(e, featureCollection) {
            //console.log('getFeatureInfosucceed: ', featureCollection);
            //console.log(featureCollection.features[0].properties);
            var features = featureCollection.features;
            var featuresCount = features.length;
            var _popupContent = '';
            if (featuresCount > 0) {
                for (var j = 0; j < featuresCount; j++) {
                  var feature = features[j];
                  var featureNumber = j + 1;
                  var properties = feature.properties;
                  var propertiesNames = Object.keys(properties) || [];

                  for (var q = 0; q < propertiesNames.length; q++) {
                    var propertiesName = propertiesNames[q];
                    var number = q + 1;
                    if (properties[propertiesName]!= null){
                        _popupContent += '<span>';
                        _popupContent += propertiesName;
                        _popupContent += ': ' + properties[propertiesName] + '</span><br>';
                    }
                  }
                }
              }
            var popup = L.popup({
                  minWidth: 300,
                  maxWidth: 400,
                  maxHeight: 300
                })
                .setLatLng(e.latlng)
                .setContent(_popupContent)
                .openOn(map);
          }
          
          map.on('click', function(e) {
            aree_elic.getFeatureInfo({
                latlng: e.latlng,
                done: (featureCollection) => {
                    getPopupContent(e, featureCollection)
                }
            });
           });
           
           // funziona solo su un layer, vedi esempio in doc per multilayer
           
           map.on('click', function(e) {
            infrastr.getFeatureInfo({
                latlng: e.latlng,
                done: (featureCollection) => {
                    getPopupContent(e, featureCollection)
                }
            });
           });
           
           map.on('click', function(e) {
            ist_scol.getFeatureInfo({
                latlng: e.latlng,
                done: (featureCollection) => {
                    getPopupContent(e, featureCollection)
                }
            });
           });
           
           map.on('click', function(e) {
            prot.getFeatureInfo({
                latlng: e.latlng,
                done: (featureCollection) => {
                    getPopupContent(e, featureCollection)
                }
            });
           });
           
           map.on('click', function(e) {
            rice.getFeatureInfo({
                latlng: e.latlng,
                done: (featureCollection) => {
                    getPopupContent(e, featureCollection)
                }
            });
           });
           
           map.on('click', function(e) {
            socc.getFeatureInfo({
                latlng: e.latlng,
                done: (featureCollection) => {
                    getPopupContent(e, featureCollection)
                }
            });
           });
           
           map.on('click', function(e) {
            acquedotti.getFeatureInfo({
                latlng: e.latlng,
                done: (featureCollection) => {
                    getPopupContent(e, featureCollection)
                }
            });
           });
           
           map.on('click', function(e) {
            censimento.getFeatureInfo({
                latlng: e.latlng,
                done: (featureCollection) => {
                    getPopupContent(e, featureCollection)
                }
            });
           });
           
           map.on('click', function(e) {
            aree_em.getFeatureInfo({
                latlng: e.latlng,
                done: (featureCollection) => {
                    getPopupContent(e, featureCollection)
                }
            });
           });
           
           map.on('click', function(e) {
            aree_comp_em.getFeatureInfo({
                latlng: e.latlng,
                done: (featureCollection) => {
                    getPopupContent(e, featureCollection)
                }
            });
           });
           
           map.on('click', function(e) {
            effetti.getFeatureInfo({
                latlng: e.latlng,
                done: (featureCollection) => {
                    getPopupContent(e, featureCollection)
                }
            });
           });
           
           map.on('click', function(e) {
            insed.getFeatureInfo({
                latlng: e.latlng,
                done: (featureCollection) => {
                    getPopupContent(e, featureCollection)
                }
            });
           });
          
        /* var wmsLayers = [aree_elic, infrastr, ist_scol, prot, rice, socc, acquedotti, censimento, aree_em, aree_comp_em, effetti, insed];
        wmsLayers.forEach((layerName) => {
            map.on('click', function(e) {
                layerName.getFeatureInfo({
                latlng: e.latlng,
                done: (featureCollection) => {
                    getPopupContent(e, featureCollection)
                }
                });
            });
        }); */
  </script>
