<?php
//wind_driection

?>
      <script>
    // Handle click on map.
    var wmsLayers = [aree_elic, infrastr, ist_scol, prot, rice, socc, acquedotti, censimento, aree_em, aree_comp_em, effetti, insed];
    map.on('click', function (e) {
      var wmsLayersCount = wmsLayers.length;
      var fullfilledRequestsCount = 0;
      var popupContent = '';
      var allFeatureCount = 0;

      // Send 'GetFeatureInfo' requests.
      for (var i = 0; i < wmsLayersCount; i++) {
        var wmsLayer = wmsLayers[i];
/*         wmsLayer.getBoundingBox({
          done: function (boundingBoxes, xhr) {
            console.log(boundingBoxes);
          },
          fail: function (errorThrown, xhr) {
            console.log(errorThrown);
          },
          always: function () {

          }
        }); */
        wmsLayer.getFeatureInfo({
          latlng: e.latlng,
          done: function (featuresCollection, xhr) {
            var result = createMarkingWhenDone(this, featuresCollection);
            popupContent += result.popupContent;
            allFeatureCount += result.allFeatureCount;
          },
          fail: function (errorThrown, xhr) {
            console.log('no layer');
          },
          always: function () {
            fullfilledRequestsCount++;
            // Stop spinner.
            if (fullfilledRequestsCount === wmsLayersCount) {
              var finalPopupContent = createFinalMarking(wmsLayersCount, allFeatureCount, popupContent);
              new L.Popup({
                  minWidth: 300,
                  maxWidth: 400,
                  maxHeight: 300
                })
                .setLatLng(e.latlng)
                .setContent(finalPopupContent)
                .openOn(map)
            }
          }
        });
      }
    });

    // Helper methods.
    function createMarkingWhenDone(_this, _featuresCollection) {
      var features = _featuresCollection.features;
      var featuresCount = features.length;
      var _popupContent = '';

      // Layer info.
      /* _popupContent += '<b>' + _this.options.name;
      _popupContent += '</b> <span>(Layer\'s feature count: ' + featuresCount + ')</span><br>'; */

      if (featuresCount > 0) {
        for (var j = 0; j < featuresCount; j++) {
          var feature = features[j];
          var featureNumber = j + 1;
          var properties = feature.properties;
          var propertiesNames = Object.keys(properties) || [];

          // Object info.
          /* _popupContent += '<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
          _popupContent += 'Object №' + featureNumber;
          _popupContent += '</b> <span>(Layer\'s property count: ' + propertiesNames.length + ')</span><br>'; */

          for (var q = 0; q < propertiesNames.length; q++) {
            var propertiesName = propertiesNames[q];
            var number = q + 1;
            if (properties[propertiesName]!= null){
            // Object properties.
            _popupContent += '<span>';
            _popupContent += propertiesName;
            _popupContent += ': ' + properties[propertiesName] + '</span><br>';
            }
          }
        }
      }
      var result = {};
      result.allFeatureCount = featuresCount;
      result.popupContent = _popupContent;
      return result;
    }

    /* function createMarkingWhenError(_this, _errorThrown) {
      var _popupContent = '';

      // Error message.
      _popupContent += '<u><b>' + _this.options.name + ':</u></b><br>';
      _popupContent += 'Error message: \'' + _errorThrown.message + '\'<br>';
      _popupContent += '<br>'

      return _popupContent;
    } */

    function createFinalMarking(_wmsLayersCount, _allFeatureCount, _popupContent) {
      var finalPopupContent = '';
/*       finalPopupContent += '<span>Layer count: ' + _wmsLayersCount + ' </span><br>';
      finalPopupContent += '<span>Feature count: ' + _allFeatureCount + ' </span><br><br>'; */
      finalPopupContent += _popupContent;

      return finalPopupContent;
    }
  </script>
