voronoiMap = function(map, url) {
  var points = [],
      lastSelectedPoint,
      features = [],
      // currentPostcode = 'WC2N 5LR';
      currentPostcode;

  var voronoi = d3.geom.voronoi()
      // .extent([[-1, -1], [width + 1, height + 1]])
      .x(function(d) { return d.x; })
      .y(function(d) { return d.y; });


  var selectPoint = function() {

    d3.selectAll('.selected').classed('selected', false);

    var cell = d3.select(this),
        point = cell.datum();

    lastSelectedPoint = point;

    // $('#post_c').val(point.Postcode);

    // $('.popup p').html(point.Postcode + ' in ' + point.Ward);

    // toggle panel
    panel.slideReveal("toggle");

    var poly = new L.polygon(point.cell, { color: 'red' }).addTo(map);

    currentPostcode = point.Postcode;

    cell.classed('selected', true);

    st_view(map, {
      latitude: point.Latitude,
      longitude: point.Longitude
    });

    pLoc(currentPostcode);

    var form_input = document.getElementById('post_c');
    form_input.value = currentPostcode;

  }

  var pointsFilteredToSelectedTypes = function() {
    var currentSelectedTypes = d3.set([]);
    return points.filter(function(item){
      return true;
    });
  }

  var drawWithLoading = function(e) {
    d3.select('#loading').classed('visible', true);
    if (e && e.type == 'viewreset') {
      d3.select('#overlay').remove();
    }
    draw();
    d3.select('#loading').classed('visible', false);
  }

  var draw = function() {
    d3.select('#overlay').remove();

    var bounds = map.getBounds(),
        topLeft = map.latLngToLayerPoint(bounds.getNorthWest()),
        bottomRight = map.latLngToLayerPoint(bounds.getSouthEast()),
        existing = d3.set(),
        drawLimit = bounds.pad(0.4);

    filteredPoints = pointsFilteredToSelectedTypes().filter(function(d) {

      var latlng = new L.LatLng(d.Latitude, d.Longitude);

      if (!drawLimit.contains(latlng)) { return false };

      var point = map.latLngToLayerPoint(latlng);

      /**
       * abt 39 postcodes in london_all.csv have the same coordinates (latlon)
       * they're removed during voronoi map build in order
       * to avoid error in drawing path
       * as a result search queries for said postcodes return null
       * even though they exists in london
       * need to find a solution to circumvent that 
      **/
      key = point.toString();
      if (existing.has(key)) { return false };
      existing.add(key);

      d.x = point.x;
      d.y = point.y;

      return true;

    });

    voronoi(filteredPoints).forEach(function(d) { d.point.cell = d });

    var svg = d3.select(map.getPanes().overlayPane).append("svg")
      .attr('id', 'overlay')
      .attr("class", "leaflet-zoom-hide")
      .style("width", map.getSize().x + 'px')
      .style("height", map.getSize().y + 'px')
      .style("margin-left", topLeft.x + "px")
      .style("margin-top", topLeft.y + "px");

    var g = svg.append("g")
      .attr("transform", "translate(" + (-topLeft.x) + "," + (-topLeft.y) + ")");

    var svgPoints = g.attr("class", "points")
      .selectAll("g")
        .data(filteredPoints)
      .enter().append("g")
        .attr("class", "point");

    var buildPathFromPoint = function(point) {
      if( _normalize(point.Postcode) == _normalize(currentPostcode) ) {
        return "M" + point.cell.join("L") + "Z";
      }
      return "M" + point.cell.join("L") + "Z";
    }

    svgPoints.append("path")
      .attr("class", function(d) { return currentPostcode != null ? 'point-cell opacity' : 'point-cell' })
      .attr("d", buildPathFromPoint)
      .on('click', selectPoint)
      .classed("selected", function(d) { return _normalize(currentPostcode) == _normalize(d.Postcode)});

      svgPoints.append("circle")
        .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; })
        .style('fill', function(d) { return '#' + d.color } )
        .attr("r", function(d) { return _normalize(d.Postcode) == _normalize(currentPostcode) ? 2 : 0 });

  }

function _normalize(str) {
  if(str) {
    str = str.toLowerCase();
    str = str.replace(/\s/g, '');
    return str;
  }
}

L.Layer.Voronoi = L.Layer.extend({

    onAdd: function (map) {
        map.on('viewreset moveend', this._reset, this);
        this._reset();
        // map.fitBounds(this.getBounds());
        // console.log(this.getBounds());
        // map.fitBounds(L.featureGroup(this).getBounds());
    },

    onRemove: function (map) {
        map.off('viewreset moveend', this._reset, this);
        d3.selectAll('.selected').classed('selected', false);
        d3.selectAll('.opacity').classed('opacity', false);
    },

    _reset: function () {
        drawWithLoading();
    }

});

L.Layer.voronoi = function () {
  return new L.Layer.Voronoi();
};

L.Layer.voronoi().addTo(map);

var grayscale = L.tileLayer.grayscale('http://tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: 'Walulel',
  minZoom: 10,
  maxBounds: bounds
});

var base = {
  "Grayscale": grayscale.addTo(map),
  // "OSM": standard,
  // "Esri WorldStreetMap": Esri_WorldStreetMap
};

var drawnItems = L.featureGroup();

var overlays = {
  "Voronoi": L.Layer.voronoi().addTo(map),
  "Draw Layer": drawnItems.addTo(map)
};

var controlLayers = L.control.layers(base, overlays, {
  position: 'bottomleft', 
  collapsed: true
}).addTo(map);

map.on('layeradd', function() {
  // gatherBounds();
});

map.on('layerremove', function() {
  // gatherBounds();
});


var drawControl = new L.Control.Draw({
    // position: 'topright',
    edit: {
        featureGroup: drawnItems,
        poly: {
            allowIntersection: false
        }
    },
    draw: {
        polygon: {
            allowIntersection: false,
            showArea: true
        },
        circle: false, // Turns off this drawing tool
        polygon: false,
        marker: false,
    }
});

map.addControl(drawControl);

map.on(L.Draw.Event.CREATED, function (e) {
  var layer = e.layer;
  drawnItems.addLayer(layer);
});

map.on('load', function() {

  // Wl.postcodes(function(items) {
  //   points = items;
  //   draw();
  // });

  d3.csv(url, function(csv) {

    points = csv;
    
    draw();

    $(points).each(function(idx, el) {
      features.push(turf.point([Number(el.Latitude), Number(el.Longitude)], {
        "name" : el.Postcode
      }));
    });

    console.log('done');

  });

});

var southWest = L.latLng(51.508276, -0.126391),
    northEast = L.latLng(51.510963, -0.120675),
    bounds = L.latLngBounds(southWest, northEast);
  
  // WC2N 5LR
  map.setView([51.509486, -0.123344], map.getMaxZoom());
  map.fitBounds(bounds);

  function st_view(map, item) {
    d3.selectAll('.selected').classed('selected', false);
    d3.selectAll('.opacity').classed('opacity', false);
    map.flyTo(L.latLng(item.latitude, item.longitude), map.getMaxZoom(), {
      animate: true,
      pan: {
        duration: 1
      }
    });
  }

  // function to get Average download speed for wifi-signals
  function wifispeed(speed) {

    if (speed < 30) {
      $('.popup p').text("Your Broadband internet connection is weak");
        document.getElementById('wifi').className = 'weak';
    } else if (speed < 60) {
      $('.popup p').text("Your Broadband internet connection is poor");
      document.getElementById('wifi').className = 'poor';
    } else if (speed < 90) {
      $('.popup p').text("Your Broadband internet connection is average");
      document.getElementById('wifi').className = 'mid';
    } else if (speed < 120) {
      $('.popup p').text("Your Broadband internet connection is good");
      document.getElementById('wifi').className = 'four';
    } else if (speed < 153) {
      $('.popup p').text("Your Broadband internet connection is excellent");
      document.getElementById('wifi').className = 'full';
    }
  }


  // function to get postcode coordinates
  function pLoc(postcode) {
    currentPostcode = postcode;
    var t = Wl.i_postcode(postcode, function(res) {
       //console.log(res);
      if (res.Broadband == null) {
        $('.popup p').text("Sad as it is for us to admit this but we don\'t have this data but you bet we are working on it.");
        document.getElementById('wifi').className = 'sad';
      } else {
        var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
        wifispeed(Number(d_speed_mbs))
      
        // data for average download speed(mbs)
        $('.popup span.dps').text((d_speed_mbs) + ' mbs');
        
        // data for average download speed z-score
        var d_speed_zscore = res.Broadband.average_dload_speed_zscore;
        $('.popup span.dpz').text(d_speed_zscore);
        
        // data for upload speed(mbs)
        var u_speed_mbs = res.Broadband.average_upload_speed_mbs;
        $('.popup span.ups').text((u_speed_mbs) + ' mbs');
        
        // data for average upload speed z-score
        var u_speed_zscore = res.Broadband.average_upload_speed_zscore;
        $('.popup span.upz').text(u_speed_zscore);
        
        // data for less_than_30mb_access_quartiles
        var less_30mb = res.Broadband.less_than_30mb_access_quartiles;
        $('.popup span.less30').text((less_30mb) + ' mbs');
        
        // data for medium download speed(mbs)
        var m_speed_mbs = res.Broadband.median_dload_speed_mbs;
        $('.popup span.mds').text((m_speed_mbs) + ' mbs');
        
        // data for median download speed zscore
        var m_speed_zscore = res.Broadband.median_dload_speed_zscore;
        $('.popup span.mdz').text(m_speed_zscore);
        
        // data for Median upload speed(mbs)
        var m_uspeed_mbs = res.Broadband.median_upload_speed_mbs;
        $('.popup span.mus').text((m_uspeed_mbs) + ' mbs');
        
        // data for Median upload speed zscore
        var m_uspeed_zscore = res.Broadband.median_upload_speed_zscore;
        $('.popup span.muz').text(m_uspeed_zscore);
        
        // data for Minimum download speed(mbs)
        var mi_d_speed = res.Broadband.minimum_dload_speed_mbs;
        $('.popup span.mid').text((mi_d_speed) + ' mbs');
      
      } 
        // data for Me
      
      if( res.Latitude && res.Longitude ) {
        st_view(map, {
          latitude: res.Latitude,
          longitude: res.Longitude
        });
      } else {
        // console.log('postcode not found');
        $('.popup p').text('Sorry, postcode not found');
      }
    });
  }
  
  $(document).on('click', '#search_p', function(e) {
    e.preventDefault();
    var postcode = $('#post_c').val();
    if( postcode != '' ) {
      pLoc(postcode);
      // $('.popup p').text(postcode);
    } else {
      // console.log('no postcode provided');
      $('.popup p').text('no postcode provided');
    }
  });
    
  // Submit the form via enter key
  function checkSubmit(e) {
   if(e && e.keyCode == 13) {
      e.preventDefault();
        var postcode = $('#post_c').val();
        if( postcode != '' ) {
          pLoc(postcode);
          // $('.popup p').text(postcode);
        } else {
          // console.log('no postcode provided');
          $('.popup p').text('no postcode provided');
        }
   }
}

  $(document).on('click', '#cancel_p', function() {
    d3.selectAll('.selected').classed('selected', false);
    d3.selectAll('.opacity').classed('opacity', false);
  });


function getPostcodesInArea(e) {

    var type = e.layerType,
            layer = e.layer;

        layer.bindPopup(type);

        var layer_bounds = layer.getLatLngs();

        coordinates = [];

        latlngs = layer.getLatLngs();

        if (type === 'polyline') {
            for (var i = 0; i < latlngs.length; i++) {
                coordinates.push([latlngs[i].lat, latlngs[i].lng])
            }
        }

        if (type === 'rectangle') {
            $(latlngs[0]).each(function(idx, el) {
              coordinates.push([el.lat, el.lng])
            });
        }

        var searchWithin = {
          "type": "FeatureCollection",
          "features": [
            {
              "type": "Feature",
              "properties": {},
              "geometry": {
                "type": "Polygon",
                "coordinates": [coordinates]
              }
            }
          ]
        };

        // searchFor
        var searchFor = turf.featureCollection(features);

        var ptsWithin = turf.within(searchFor, searchWithin);

        console.log(ptsWithin);
        // console.log(ptsWithin.features);

        updateMap_areaSelect(ptsWithin.features);

        drawnItems.addLayer(layer);

  }

  map.on(L.Draw.Event.CREATED, function(e) {
    getPostcodesInArea(e);
  });

  // map.on('draw:edited', function(e) {
  //   console.log('edited');
  //   getPostcodesInArea(e);
  // });

function updateMap_areaSelect(data) {

  //change display to inline-block
  $('.area_select').show();

  var postcodesMarkup = '';

  $('.area_select_count').html(data.length);

  // console.log(data);

  $(data).each(function(idx, val) {
    postcodesMarkup += '<div class="radio"><label><input type="radio" value="' + val.properties.name + '" name="area_select_feature" class="radio_area_select">' + val.properties.name + '</label></div>';
  });

  $('div.area_select_content').html(postcodesMarkup);

}

$(document).on('click', '.radio_area_select', function(e) {
  var pst = this.value;
  pLoc(pst);
  // toggle panel
  panel.slideReveal("toggle");
});


}


