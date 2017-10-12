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

    // get nhs data (dentists, gppractices)
    get_dentists(currentPostcode);
    get_gppractices(currentPostcode);

    var form_input = document.getElementById('post_c');
    form_input.value = currentPostcode;

    var form_input1 = document.getElementById('post_m');
    form_input1.value = currentPostcode;

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
      document.getElementById("heading").innerHTML = "Your Broadband connection is weak";
      document.getElementById("mobile-heading").innerHTML = "Your Broadband connection is weak";
      document.getElementById('wifi').className = 'weak';
    } else if (speed < 60) {
      document.getElementById("heading").innerHTML = "Your Broadband connection is poor";
      document.getElementById("mobile-heading").innerHTML = "Your Broadband connection is poor";
//      $('.popup p, .mobile-search-results h3').text("Your Broadband connection is poor");
      document.getElementById('wifi').className = 'poor';
    } else if (speed < 90) {
      document.getElementById("heading").innerHTML = "Your Broadband connection is average";
      document.getElementById("mobile-heading").innerHTML = "Your Broadband connection is average";
//      $('.popup p, .mobile-search-results h3').text("Your Broadband connection is average");
      document.getElementById('wifi').className = 'mid';
    } else if (speed < 120) {
      document.getElementById("heading").innerHTML = "Your Broadband connection is good";
      document.getElementById("mobile-heading").innerHTML = "Your Broadband connection is good";
//      $('.popup p, .mobile-search-results h3').text("Your Broadband connection is good");
      document.getElementById('wifi').className = 'four';
    } else if (speed < 153) {
      document.getElementById("heading").innerHTML = "Your Broadband connection is excellent";
      document.getElementById("mobile-heading").innerHTML = "Your Broadband connection is excellent";
//      $('.popup p, .mobile-search-results h3').text("Your Broadband  connection is excellent");
      document.getElementById('wifi').className = 'full';
    }
  }


// function to get postcode coordinates
function pLoc(postcode) {
    currentPostcode = postcode;
    var t = Wl.i_postcode(postcode, function(res) {
       //console.log(res);
        
      // if Postcode contain any Broadband information
      if (res.Broadband != null) {
      $('#broadband-results').removeClass('hide');
      $('#broadband-mobile').removeClass('hide');
        
        // if main "broadband" is selected
        
        if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == true && document.getElementById("average_zs").checked == true && document.getElementById("average_us").checked == true && document.getElementById("average_uzs").checked == true) || (document.getElementById("broadband-m-title").checked == true && document.getElementById("m-average_mbs").checked == true && document.getElementById("m-average_zs").checked == true && document.getElementById("m-average_us").checked == true && document.getElementById("m-average_uzs").checked == true)){
            
        //alert("here we go");
        var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
        wifispeed(Number(d_speed_mbs));
        
        broadbandAverage();

        // data for average download speed(mbs)
        document.getElementById("broadband-results").innerHTML += "<h4 class='text-center'>BROADBAND INFORMATION</h4><div class='isd-1'><h6>Average Download Speed(mbs)</h6><span>" + d_speed_mbs + " mbs</span></div>";
        document.getElementById("broadband-mobile").innerHTML += "<h4 class='text-center'>BROADBAND INFORMATION</h4><div class='col-xs-6 border-left'><h6>Average Download Speed(mbs)</h6><span>" + d_speed_mbs + " mbs</span></div>";

        // data for average download speed z-score
        var d_speed_zscore = res.Broadband.average_dload_speed_zscore;
        var d_speed_zscore = (Number(d_speed_zscore).toFixed(2));
        document.getElementById("broadband-results").innerHTML += "<div class='isd-2'><h6>Average Download Z-Score</h6><span>" + d_speed_zscore + "</span></div>";
        document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6 border-right'><h6>Average Download Z-Score</h6><span>" + d_speed_zscore + "</span></div>"; 
        //$('.mobile-search-results span.dpz').text(d_speed_zscore);

        // data for upload speed(mbs)
        var u_speed_mbs = res.Broadband.average_upload_speed_mbs;
        document.getElementById("broadband-results").innerHTML += "<div class='isd-1'><h6>Average Upload Speed(mbs)</h6><span>" + u_speed_mbs + " mbs</span></div>";
        document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6 border-left'><h6>Average Upload Speed(mbs)</h6><span>" + u_speed_mbs + " mbs</span></div>";
        //$('.popup span.ups, .mobile-search-results span.ups').text((u_speed_mbs) + ' mbs');

        // data for average upload speed z-score
        var u_speed_zscore = res.Broadband.average_upload_speed_zscore;
        var u_speed_zscore = (Number(u_speed_zscore).toFixed(2));
        document.getElementById("broadband-results").innerHTML += "<div class='isd-2'><h6>Average Upload Z-Score</h6><span>" + u_speed_zscore + "</span></div><br />";
        document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6 border-right'><h6>Average Upload Z-Score</h6><span>" + u_speed_zscore + "</span></div><br />";
        //$('.popup span.upz, .mobile-search-results span.upz').text(u_speed_zscore);
            
            
        } //1
          // if subs "broadband-dropdowns" are selected
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == true && document.getElementById("average_zs").checked == false && document.getElementById("average_us").checked == false && document.getElementById("average_uzs").checked == false) || (document.getElementById("broadband-m-title").checked == true && document.getElementById("m-average_mbs").checked == true && document.getElementById("m-average_zs").checked == false && document.getElementById("m-average_us").checked == false && document.getElementById("m-average_uzs").checked == false)) {
            var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
            wifispeed(Number(d_speed_mbs));
              
            broadbandAverage();
            
            // data for average download speed(mbs)
            document.getElementById("broadband-results").innerHTML += "<div class='isd-1'><h6>Average Download Speed(mbs)</h6><span>" + d_speed_mbs + " mbs</span></div>";
            document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Download Speed(mbs)</h6><span>" + d_speed_mbs + " mbs</span></div>";
              
          } // this will display just the average download speed 2
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == false && document.getElementById("average_zs").checked == true && document.getElementById("average_us").checked == false && document.getElementById("average_uzs").checked == false) || (document.getElementById("broadband-m-title").checked == true && document.getElementById("m-average_mbs").checked == false && document.getElementById("m-average_zs").checked == true && document.getElementById("m-average_us").checked == false && document.getElementById("m-average_uzs").checked == false)) {
            var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
            wifispeed(Number(d_speed_mbs));
              
            broadbandAverage();

            // data for average download speed z-score
            var d_speed_zscore = res.Broadband.average_dload_speed_zscore;
            var d_speed_zscore = (Number(d_speed_zscore).toFixed(2));
            document.getElementById("broadband-results").innerHTML += "<div class='isd-1'><h6>Average Download Z-Score</h6><span>" + d_speed_zscore + "</span></div>";
            document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Download Z-Score</h6><span>" + d_speed_zscore + "</span></div>";
              
          } // this will display just the average download speed z-score 3
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == false && document.getElementById("average_zs").checked == false && document.getElementById("average_us").checked == true && document.getElementById("average_uzs").checked == false) || (document.getElementById("broadband-m-title").checked == true && document.getElementById("m-average_mbs").checked == false && document.getElementById("m-average_zs").checked == false && document.getElementById("m-average_us").checked == true && document.getElementById("m-average_uzs").checked == false)) {
            var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
            wifispeed(Number(d_speed_mbs));
            broadbandAverage();

            // data for upload speed(mbs)
            var u_speed_mbs = res.Broadband.average_upload_speed_mbs;
            document.getElementById("broadband-results").innerHTML += "<div class='isd-1'><h6>Average Upload Speed(mbs)</h6><span>" + u_speed_mbs + " mbs</span></div>";
            document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Upload Speed(mbs)</h6><span>" + u_speed_mbs + " mbs</span></div>";
              
          } // this will display just the average upload speed 4
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == false && document.getElementById("average_zs").checked == false && document.getElementById("average_us").checked == false && document.getElementById("average_uzs").checked == true) || (document.getElementById("broadband-m-title").checked == true && document.getElementById("m-average_mbs").checked == false && document.getElementById("m-average_zs").checked == false && document.getElementById("m-average_us").checked == false && document.getElementById("m-average_uzs").checked == true)) {
            var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
            wifispeed(Number(d_speed_mbs));
            broadbandAverage();

            // data for average upload speed z-score
            var u_speed_zscore = res.Broadband.average_upload_speed_zscore;
            var u_speed_zscore = (Number(u_speed_zscore).toFixed(2));
            document.getElementById("broadband-results").innerHTML += "<div class='isd-1'><h6>Average Upload Z-Score</h6><span>" + u_speed_zscore + "</span></div>";
            document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Upload Z-Score</h6><span>" + u_speed_zscore + "</span></div>";
              
          } // this will display just the average upload speed z-score 5
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == true && document.getElementById("average_zs").checked == true && document.getElementById("average_us").checked == false && document.getElementById("average_uzs").checked == false) || (document.getElementById("broadband-m-title").checked == true && document.getElementById("m-average_mbs").checked == true && document.getElementById("m-average_zs").checked == true && document.getElementById("m-average_us").checked == false && document.getElementById("m-average_uzs").checked == false)) {
              var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
              wifispeed(Number(d_speed_mbs));
              broadbandAverage();

              // data for average download speed(mbs)
              document.getElementById("broadband-results").innerHTML += "<div class='isd-1'><h6>Average Download Speed(mbs)</h6><span>" + d_speed_mbs + " mbs</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Download Speed(mbs)</h6><span>" + d_speed_mbs + " mbs</span></div>";

              // data for average download speed z-score
              var d_speed_zscore = res.Broadband.average_dload_speed_zscore;
              var d_speed_zscore = (Number(d_speed_zscore).toFixed(2));
              document.getElementById("broadband-results").innerHTML += "<div class='isd-2'><h6>Average Download Z-Score</h6><span>" + d_speed_zscore + "</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Download Z-Score</h6><span>" + d_speed_zscore + "</span></div>";
              
          } // this will display just the average download speed and average download speed z-score 6
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == true && document.getElementById("average_zs").checked == false && document.getElementById("average_us").checked == true && document.getElementById("average_uzs").checked == false) || (document.getElementById("broadband-m-title").checked == true && document.getElementById("m-average_mbs").checked == true && document.getElementById("m-average_zs").checked == false && document.getElementById("m-average_us").checked == true && document.getElementById("m-average_uzs").checked == false)) {
              var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
              wifispeed(Number(d_speed_mbs));
              broadbandAverage();

              // data for average download speed(mbs)
              document.getElementById("broadband-results").innerHTML += "<div class='isd-1'><h6>Average Download Speed(mbs)</h6><span>" + d_speed_mbs + " mbs</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Download Speed(mbs)</h6><span>" + d_speed_mbs + " mbs</span></div>";

              // data for upload speed(mbs)
              var u_speed_mbs = res.Broadband.average_upload_speed_mbs;
              document.getElementById("broadband-results").innerHTML += "<div class='isd-2'><h6>Average Upload Speed(mbs)</h6><span>" + u_speed_mbs + " mbs</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Upload Speed(mbs)</h6><span>" + u_speed_mbs + " mbs</span></div>";
              
          }  // this will display just the average download speed and average upload speed 7
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == true && document.getElementById("average_zs").checked == false && document.getElementById("average_us").checked == false && document.getElementById("average_uzs").checked == true) || (document.getElementById("broadband-m-title").checked == true && document.getElementById("m-average_mbs").checked == true && document.getElementById("m-average_zs").checked == false && document.getElementById("m-average_us").checked == false && document.getElementById("m-average_uzs").checked == true)) {
              var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
              wifispeed(Number(d_speed_mbs));
              broadbandAverage();

              // data for average download speed(mbs)
              document.getElementById("broadband-results").innerHTML += "<div class='isd-1'><h6>Average Download Speed(mbs)</h6><span>" + d_speed_mbs + " mbs</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Download Speed(mbs)</h6><span>" + d_speed_mbs + " mbs</span></div>";

              // data for average upload speed z-score
              var u_speed_zscore = res.Broadband.average_upload_speed_zscore;
              var u_speed_zscore = (Number(u_speed_zscore).toFixed(2));
              document.getElementById("broadband-results").innerHTML += "<div class='isd-2'><h6>Average Upload Z-Score</h6><span>" + u_speed_zscore + "</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Upload Z-Score</h6><span>" + u_speed_zscore + "</span></div>";
              
          } // this will display just the average download speed and average upload speed z-score 8
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == false && document.getElementById("average_zs").checked == true && document.getElementById("average_us").checked == true && document.getElementById("average_uzs").checked == false) || (document.getElementById("broadband-m-title").checked == true && document.getElementById("m-average_mbs").checked == false && document.getElementById("m-average_zs").checked == true && document.getElementById("m-average_us").checked == true && document.getElementById("m-average_uzs").checked == false)){
              var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
              wifispeed(Number(d_speed_mbs));
              broadbandAverage();

              // data for average download speed z-score
              var d_speed_zscore = res.Broadband.average_dload_speed_zscore;
              var d_speed_zscore = (Number(d_speed_zscore).toFixed(2));
              document.getElementById("broadband-results").innerHTML += "<div class='isd-1'><h6>Average Download Z-Score</h6><span>" + d_speed_zscore + "</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Download Z-Score</h6><span>" + d_speed_zscore + "</span></div>";

              // data for upload speed(mbs)
              var u_speed_mbs = res.Broadband.average_upload_speed_mbs;
              document.getElementById("broadband-results").innerHTML += "<div class='isd-2'><h6>Average Upload Speed(mbs)</h6><span>" + u_speed_mbs + " mbs</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Upload Speed(mbs)</h6><span>" + u_speed_mbs + " mbs</span></div>";
          
          } // this will display just the average download speed z-score and average upload speed 9
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == false && document.getElementById("average_zs").checked == true && document.getElementById("average_us").checked == false && document.getElementById("average_uzs").checked == true) || (document.getElementById("broadband-m-title").checked == true && document.getElementById("m-average_mbs").checked == false && document.getElementById("m-average_zs").checked == true && document.getElementById("m-average_us").checked == false && document.getElementById("m-average_uzs").checked == true)){
              var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
              wifispeed(Number(d_speed_mbs));
              broadbandAverage();

              // data for average download speed z-score
              var d_speed_zscore = res.Broadband.average_dload_speed_zscore;
              var d_speed_zscore = (Number(d_speed_zscore).toFixed(2));
              document.getElementById("broadband-results").innerHTML += "<div class='isd-1'><h6>Average Download Z-Score</h6><span>" + d_speed_zscore + "</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Download Z-Score</h6><span>" + d_speed_zscore + "</span></div>";

              // data for upload speed(mbs)
              var u_speed_zscore = res.Broadband.average_upload_speed_zscore;
              var u_speed_zscore = (Number(u_speed_zscore).toFixed(2));
              document.getElementById("broadband-results").innerHTML += "<div class='isd-2'><h6>Average Upload Z-Score</h6><span>" + u_speed_zscore + "</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Upload Z-Score</h6><span>" + u_speed_zscore + "</span></div>";
          
          } // this will display just the average download speed z-score and average upload speed z-score 10
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == false && document.getElementById("average_zs").checked == true && document.getElementById("average_us").checked == true && document.getElementById("average_uzs").checked == true) || (document.getElementById("broadband-m-title").checked == true && document.getElementById("m-average_mbs").checked == false && document.getElementById("m-average_zs").checked == true && document.getElementById("m-average_us").checked == true && document.getElementById("m-average_uzs").checked == true)){
              var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
              wifispeed(Number(d_speed_mbs));
              broadbandAverage();

              // data for average download speed z-score
              var d_speed_zscore = res.Broadband.average_dload_speed_zscore;
              var d_speed_zscore = (Number(d_speed_zscore).toFixed(2));
              document.getElementById("broadband-results").innerHTML += "<div class='isd-1'><h6>Average Download Z-Score</h6><span>" + d_speed_zscore + "</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Download Z-Score</h6><span>" + d_speed_zscore + "</span></div>";

              // data for upload speed(mbs)
              var u_speed_mbs = res.Broadband.average_upload_speed_mbs;
              document.getElementById("broadband-results").innerHTML += "<div class='isd-2'><h6>Average Upload Speed(mbs)</h6><span>" + u_speed_mbs + " mbs</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Upload Speed(mbs)</h6><span>" + u_speed_mbs + " mbs</span></div>";

              // data for average upload speed z-score
              var u_speed_zscore = res.Broadband.average_upload_speed_zscore;
              var u_speed_zscore = (Number(u_speed_zscore).toFixed(2));
              document.getElementById("broadband-results").innerHTML += "<div class='isd-1'><h6>Average Upload Z-Score</h6><span>" + u_speed_zscore + "</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Upload Z-Score</h6><span>" + u_speed_zscore + "</span></div>";
        
          } // this will display just the average download speed z-score and average upload speed and average upload speed z-score 11
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == false && document.getElementById("average_zs").checked == false && document.getElementById("average_us").checked == true && document.getElementById("average_uzs").checked == true) || (document.getElementById("broadband-m-title").checked == true && document.getElementById("m-average_mbs").checked == false && document.getElementById("m-average_zs").checked == false && document.getElementById("m-average_us").checked == true && document.getElementById("m-average_uzs").checked == true)){
              var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
              wifispeed(Number(d_speed_mbs));
              broadbandAverage();

              // data for upload speed(mbs)
              var u_speed_mbs = res.Broadband.average_upload_speed_mbs;
              document.getElementById("broadband-results").innerHTML += "<div class='isd-1'><h6>Average Upload Speed(mbs)</h6><span>" + u_speed_mbs + " mbs</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Upload Speed(mbs)</h6><span>" + u_speed_mbs + " mbs</span></div>";

              // data for average upload speed z-score
              var u_speed_zscore = res.Broadband.average_upload_speed_zscore;
              var u_speed_zscore = (Number(u_speed_zscore).toFixed(2));
              document.getElementById("broadband-results").innerHTML += "<div class='isd-2'><h6>Average Upload Z-Score</h6><span>" + u_speed_zscore + "</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Upload Z-Score</h6><span>" + u_speed_zscore + "</span></div>";
          
          } // this will display just the average upload speed and average upload speed z-score 12
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == true && document.getElementById("average_zs").checked == true && document.getElementById("average_us").checked == true && document.getElementById("average_uzs").checked == false) || (document.getElementById("broadband-m-title").checked == true && document.getElementById("m-average_mbs").checked == true && document.getElementById("m-average_zs").checked == true && document.getElementById("m-average_us").checked == true && document.getElementById("m-average_uzs").checked == false)){
              var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
              wifispeed(Number(d_speed_mbs));
              broadbandAverage();
              
              // data for average download speed(mbs)
              document.getElementById("broadband-results").innerHTML += "<div class='isd-1'><h6>Average Download Speed(mbs)</h6><span>" + d_speed_mbs + " mbs</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Download Speed(mbs)</h6><span>" + d_speed_mbs + "</span></div>";
              
              // data for average download speed z-score
              var d_speed_zscore = res.Broadband.average_dload_speed_zscore;
              var d_speed_zscore = (Number(d_speed_zscore).toFixed(2));
              document.getElementById("broadband-results").innerHTML += "<div class='isd-2'><h6>Average Download Z-Score</h6><span>" + d_speed_zscore + "</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Download Z-Score</h6><span>" + d_speed_zscore + "</span></div>";
              
              // data for upload speed(mbs)
              var u_speed_mbs = res.Broadband.average_upload_speed_mbs;
              document.getElementById("broadband-results").innerHTML += "<div class='isd-1'><h6>Average Upload Speed(mbs)</h6><span>" + u_speed_mbs + " mbs</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Upload Speed(mbs)</h6><span>" + u_speed_mbs + " mbs</span></div>";
                   
          } // this will display just the average download speed and average download speed z-score and average upload speed 13
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == true && document.getElementById("average_zs").checked == false && document.getElementById("average_us").checked == true && document.getElementById("average_uzs").checked == true) || (document.getElementById("broadband-m-title").checked == true && document.getElementById("m-average_mbs").checked == true && document.getElementById("m-average_zs").checked == false && document.getElementById("m-average_us").checked == true && document.getElementById("m-average_uzs").checked == true)){
              var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
              wifispeed(Number(d_speed_mbs));
              broadbandAverage();
              
              // data for average download speed(mbs)
              document.getElementById("broadband-results").innerHTML += "<div class='isd-1'><h6>Average Download Speed(mbs)</h6><span>" + d_speed_mbs + " mbs</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Download Speed(mbs)</h6><span>" + d_speed_mbs + "</span></div>";
              
              // data for upload speed(mbs)
              var u_speed_mbs = res.Broadband.average_upload_speed_mbs;
              document.getElementById("broadband-results").innerHTML += "<div class='isd-2'><h6>Average Upload Speed(mbs)</h6><span>" + u_speed_mbs + " mbs</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Upload Speed(mbs)</h6><span>" + u_speed_mbs + " mbs</span></div>";
              
              // data for average upload speed z-score
              var u_speed_zscore = res.Broadband.average_upload_speed_zscore;
              var u_speed_zscore = (Number(u_speed_zscore).toFixed(2));
              document.getElementById("broadband-results").innerHTML += "<div class='isd-1'><h6>Average Upload Z-Score</h6><span>" + u_speed_zscore + "</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Upload Z-Score</h6><span>" + u_speed_zscore + "</span></div>";
                   
          } // this will display just the average download speed and average upload speed and average upload speed z-score 14
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == true && document.getElementById("average_zs").checked == true && document.getElementById("average_us").checked == false && document.getElementById("average_uzs").checked == true) || (document.getElementById("broadband-m-title").checked == true && document.getElementById("m-average_mbs").checked == true && document.getElementById("m-average_zs").checked == true && document.getElementById("m-average_us").checked == false && document.getElementById("m-average_uzs").checked == true)){
              var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
              wifispeed(Number(d_speed_mbs));
              broadbandAverage();
              
              // data for average download speed(mbs)
              document.getElementById("broadband-results").innerHTML += "<div class='isd-1'><h6>Average Download Speed(mbs)</h6><span>" + d_speed_mbs + " mbs</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Download Speed(mbs)</h6><span>" + d_speed_mbs + " mbs</span></div>";
              
              // data for average download speed z-score
              var d_speed_zscore = res.Broadband.average_dload_speed_zscore;
              var d_speed_zscore = (Number(d_speed_zscore).toFixed(2));
              document.getElementById("broadband-results").innerHTML += "<div class='isd-2'><h6>Average Download Z-Score</h6><span>" + d_speed_zscore + "</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Download Z-Score</h6><span>" + d_speed_zscore + "</span></div>";
              
              // data for average upload speed z-score
              var u_speed_zscore = res.Broadband.average_upload_speed_zscore;
              var u_speed_zscore = (Number(u_speed_zscore).toFixed(2));
              document.getElementById("broadband-results").innerHTML += "<div class='isd-1'><h6>Average Upload Z-Score</h6><span>" + u_speed_zscore + "</span></div>";
              document.getElementById("broadband-mobile").innerHTML += "<div class='col-xs-6'><h6>Average Upload Z-Score</h6><span>" + u_speed_zscore + "</span></div>";
                   
          } // this will display just the average download speed and average upload speed and average upload speed z-score 15
          
          else if ((document.getElementById("broadband-title").checked == false && document.getElementById("average_mbs").checked == false && document.getElementById("average_zs").checked == false && document.getElementById("average_us").checked == false && document.getElementById("average_uzs").checked == false) || (document.getElementById("broadband-m-title").checked == false && document.getElementById("m-average_mbs").checked == false && document.getElementById("m-average_zs").checked == false && document.getElementById("m-average_us").checked == false && document.getElementById("m-average_uzs").checked == false)) {
          //$('.popup p').text("Kindly select an option from Broadband from the search box on the left and re-submit to display the information accordingly");
          document.getElementById("heading").innerHTML = " ";
          document.getElementById('wifi').className = '';
          $('#broadband-results').addClass('hide');
          $('#broadband-mobile').addClass('hide');
          }
          
      } else { // if Postcode doesn't contain any Broadband information
        document.getElementById("heading").innerHTML = "Sad as it is for us to admit this but we don\'t have this data but you bet we are working on it.";
          
        document.getElementById("mobile-heading").innerHTML = "Sad as it is for us to admit this but we don\'t have this data but you bet we are working on it.";
          
        document.getElementById('wifi').className = 'sad';
        $('#broadband-results').addClass('hide');
      }
        
        
      // Data for the Tall Buildings Section
        
      if (res.TallBuildings != null) {
          // check to see if the checkboxes are selected
          if ((document.getElementById("tallbuilings-title").checked == true && document.getElementById("ltbc").checked == true && document.getElementById("wtbs").checked == true && document.getElementById("wtbc").checked == true) || (document.getElementById("tallbuildings-m-title").checked == true && document.getElementById("m-ltbc").checked == true && document.getElementById("m-wtbs").checked == true && document.getElementById("m-wtbc").checked == true)) {
              
              $('#tallbuildings-results').removeClass('hide');
              $('#tall-mobile').removeClass('hide');
              
              // data for local tall building count
              var local_tbuild_c = res.TallBuildings.local_tall_builing_count;
              if (local_tbuild_c == null){
                  document.getElementById("tallbuildings-results").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='isd-1'><h6>Local Tall Buildings Count</h6><span>0</span></div>";
                  document.getElementById("tall-mobile").innerHTML = "<h5 class='text-center'>TALL BUILDINGS INFORMATION</h5><div class='col-xs-6 border-left'><h6>Local Tall Buildings Count</h6><span>0</span></div>";
              } else {
                  document.getElementById("tallbuildings-results").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='isd-1'><h6>Local Tall Buildings Count</h6><span>" + local_tbuild_c + "</span></div>";
                  document.getElementById("tall-mobile").innerHTML = "<h5 class='text-center'>TALL BUILDINGS INFORMATION</h5><div class='col-xs-6 border-left'><h6>Local Tall Buildings Count</h6><span>" + local_tbuild_c + "</span></div>";
              }

            // data for walulel tall building impact score
            var walulel_tbuild_s = res.TallBuildings.walulel_tall_building_impact_score;
              if (walulel_tbuild_s == null){
                  document.getElementById("tallbuildings-results").innerHTML += "<div class='isd-2'><h6>Walulel Tall Building Impact Score</h6><span>0</span></div>";
                  document.getElementById("tall-mobile").innerHTML += "<div class='col-xs-6 border-right'><h6>Walulel Tall Building Impact Score</h6><span>0</span></div>";
              } else {
                  document.getElementById("tallbuildings-results").innerHTML += "<div class='isd-2'><h6>Walulel Tall Building Impact Score</h6><span>" + walulel_tbuild_s + "</span></div>";
                  document.getElementById("tall-mobile").innerHTML += "<div class='col-xs-6 border-right'><h6>Walulel Tall Building Impact Score</h6><span>" + walulel_tbuild_s + "</span></div>";
              }

            // data for walulel tall building cluster effect score
            var walulel_tbcs = res.TallBuildings.walulel_tb_cluster_effect_score;
              if (walulel_tbcs == null){
                  document.getElementById("tallbuildings-results").innerHTML += "<div class='isd-1'><h6>Walulel Tall Building Cluster Effect Score</h6><span>0</span></div>";
                  document.getElementById("tall-mobile").innerHTML += "<div class='col-xs-6 border-left'><h6>Walulel Tall Building Cluster Effect Score</h6><span>0</span></div>";
              } else {
                  document.getElementById("tallbuildings-results").innerHTML += "<div class='isd-1'><h6>Walulel Tall Building Cluster Effect Score</h6><span>" + walulel_tbcs + "</span></div>";
                  document.getElementById("tall-mobile").innerHTML += "<div class='col-xs-6 border-left'><h6>Walulel Tall Building Cluster Effect Score</h6><span>" + walulel_tbcs + "</span></div>";
              }
              
            }
          
          else if ((document.getElementById("tallbuilings-title").checked == true && document.getElementById("ltbc").checked == true && document.getElementById("wtbs").checked == false && document.getElementById("wtbc").checked == false) || (document.getElementById("tallbuildings-m-title").checked == true && document.getElementById("m-ltbc").checked == true && document.getElementById("m-wtbs").checked == false && document.getElementById("m-wtbc").checked == false)) {
              //alert("clicked ltbc");
            
              // data for local tall building count
              var local_tbuild_c = res.TallBuildings.local_tall_builing_count;
              if (local_tbuild_c == null){
                  document.getElementById("tallbuildings-results").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='isd-1'><h6>Local Tall Buildings Count</h6><span>0</span></div>";
                  document.getElementById("tall-mobile").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='col-xs-6 border-left'><h6>Local Tall Buildings Count</h6><span>0</span></div>";
              } else {
                  document.getElementById("tallbuildings-results").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='isd-1'><h6>Local Tall Buildings Count</h6><span>" + local_tbuild_c + "</span></div>";
                  document.getElementById("tall-mobile").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='col-xs-6 border-left'><h6>Local Tall Buildings Count</h6><span>" + local_tbuild_c + "</span></div>";
              }
              
        } // this displays just info for ltbc
          
        else if ((document.getElementById("tallbuilings-title").checked == true && document.getElementById("ltbc").checked == false && document.getElementById("wtbs").checked == true && document.getElementById("wtbc").checked == false) || (document.getElementById("tallbuildings-m-title").checked == true && document.getElementById("m-ltbc").checked == false && document.getElementById("m-wtbs").checked == true && document.getElementById("m-wtbc").checked == false)) {
           
              // data for walulel tall building impact score
            var walulel_tbuild_s = res.TallBuildings.walulel_tall_building_impact_score;
              if (walulel_tbuild_s == null){
                  document.getElementById("tallbuildings-results").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='isd-1'><h6>Walulel Tall Building Impact Score</h6><span>0</span></div>";
                  document.getElementById("tall-mobile").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='col-xs-6 border-left'><h6>Walulel Tall Building Impact Score</h6><span>0</span></div>";
              } else {
                  document.getElementById("tallbuildings-results").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='isd-1'><h6>Walulel Tall Building Impact Score</h6><span>" + walulel_tbuild_s + "</span></div>";
                  document.getElementById("tall-mobile").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='col-xs-6 border-left'><h6>Walulel Tall Building Impact Score</h6><span>" + walulel_tbuild_s + "</span></div>";
              }
              
        } // this displays just info for wtbs
          
        else if ((document.getElementById("tallbuilings-title").checked == true && document.getElementById("ltbc").checked == false && document.getElementById("wtbs").checked == false && document.getElementById("wtbc").checked == true) || (document.getElementById("tallbuildings-m-title").checked == true && document.getElementById("m-ltbc").checked == false && document.getElementById("m-wtbs").checked == false && document.getElementById("m-wtbc").checked == true)) {
            
            // data for walulel tall building cluster effect score
            var walulel_tbcs = res.TallBuildings.walulel_tb_cluster_effect_score;
              if (walulel_tbcs == null){
                  document.getElementById("tallbuildings-results").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='isd-1'><h6>Walulel Tall Building Cluster Effect Score</h6><span>0</span></div>";
                  document.getElementById("tall-mobile").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='col-xs-6 border-left'><h6>Walulel Tall Building Cluster Effect Score</h6><span>0</span></div>";
              } else {
                  document.getElementById("tallbuildings-results").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='isd-1'><h6>Walulel Tall Building Cluster Effect Score</h6><span>" + walulel_tbcs + "</span></div>";
                  document.getElementById("tall-mobile").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='col-xs-6 border-left'><h6>Walulel Tall Building Cluster Effect Score</h6><span>" + walulel_tbcs + "</span></div>";
              }
              
        } // this displays just info for wtbc
          
        else if ((document.getElementById("tallbuilings-title").checked == true && document.getElementById("ltbc").checked == true && document.getElementById("wtbs").checked == true && document.getElementById("wtbc").checked == false) || (document.getElementById("tallbuildings-m-title").checked == true && document.getElementById("m-ltbc").checked == true && document.getElementById("m-wtbs").checked == true && document.getElementById("m-wtbc").checked == false)) {
            
              // data for local tall building count
              var local_tbuild_c = res.TallBuildings.local_tall_builing_count;
              if (local_tbuild_c == null){
                  document.getElementById("tallbuildings-results").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='isd-1'><h6>Local Tall Buildings Count</h6><span>0</span></div>";
                  document.getElementById("tall-mobile").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='col-xs-6 border-left'><h6>Local Tall Buildings Count</h6><span>0</span></div>";
              } else {
                  document.getElementById("tallbuildings-results").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='isd-1'><h6>Local Tall Buildings Count</h6><span>" + local_tbuild_c + "</span></div>";
                  document.getElementById("tall-mobile").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='col-xs-6 border-left'><h6>Local Tall Buildings Count</h6><span>" + local_tbuild_c + "</span></div>";
              }
            
              // data for walulel tall building impact score
              var walulel_tbuild_s = res.TallBuildings.walulel_tall_building_impact_score;
              if (walulel_tbuild_s == null){
                  document.getElementById("tallbuildings-results").innerHTML += "<div class='isd-2'><h6>Walulel Tall Building Impact Score</h6><span>0</span></div>";
                  document.getElementById("tall-mobile").innerHTML += "<div class='col-xs-6 border-right'><h6>Walulel Tall Building Impact Score</h6><span>0</span></div>";
              } else {
                  document.getElementById("tallbuildings-results").innerHTML += "<div class='isd-2'><h6>Walulel Tall Building Impact Score</h6><span>" + walulel_tbuild_s + "</span></div>";
                  document.getElementById("tall-mobile").innerHTML += "<div class='col-xs-6 border-right'><h6>Walulel Tall Building Impact Score</h6><span>" + walulel_tbuild_s + "</span></div>";
              }
            
        } // this displays info from ltbc and wtbs
          
        else if ((document.getElementById("tallbuilings-title").checked == true && document.getElementById("ltbc").checked == true && document.getElementById("wtbs").checked == false && document.getElementById("wtbc").checked == true) || (document.getElementById("tallbuildings-m-title").checked == true && document.getElementById("m-ltbc").checked == true && document.getElementById("m-wtbs").checked == false && document.getElementById("m-wtbc").checked == true)) {
            
            // data for local tall building count
              var local_tbuild_c = res.TallBuildings.local_tall_builing_count;
              if (local_tbuild_c == null){
                  document.getElementById("tallbuildings-results").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='isd-1'><h6>Local Tall Buildings Count</h6><span>0</span></div>";
                  document.getElementById("tall-mobile").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='col-xs-6 border-left'><h6>Local Tall Buildings Count</h6><span>0</span></div>";
              } else {
                  document.getElementById("tallbuildings-results").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='isd-1'><h6>Local Tall Buildings Count</h6><span>" + local_tbuild_c + "</span></div>";
                  document.getElementById("tall-mobile").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='col-xs-6 border-left'><h6>Local Tall Buildings Count</h6><span>" + local_tbuild_c + "</span></div>";
              }
            
            // data for walulel tall building cluster effect score
            var walulel_tbcs = res.TallBuildings.walulel_tb_cluster_effect_score;
              if (walulel_tbcs == null){
                  document.getElementById("tallbuildings-results").innerHTML += "<div class='isd-2'><h6>Walulel Tall Building Cluster Effect Score</h6><span>0</span></div>";
                  document.getElementById("tall-mobile").innerHTML = "<div class='col-xs-6 border-right'><h6>Walulel Tall Building Cluster Effect Score</h6><span>0</span></div>";
              } else {
                  document.getElementById("tallbuildings-results").innerHTML += "<div class='isd-2'><h6>Walulel Tall Building Cluster Effect Score</h6><span>" + walulel_tbcs + "</span></div>";
                  document.getElementById("tall-mobile").innerHTML += "<div class='col-xs-6 border-right'><h6>Walulel Tall Building Cluster Effect Score</h6><span>" + walulel_tbcs + "</span></div>";
              }
            
        } // this displays info from ltbc and wtbc
          
        else if ((document.getElementById("tallbuilings-title").checked == true && document.getElementById("ltbc").checked == false && document.getElementById("wtbs").checked == true && document.getElementById("wtbc").checked == true) || (document.getElementById("tallbuildings-m-title").checked == true && document.getElementById("m-ltbc").checked == false && document.getElementById("m-wtbs").checked == true && document.getElementById("m-wtbc").checked == true)) {
            
              // data for walulel tall building impact score
              var walulel_tbuild_s = res.TallBuildings.walulel_tall_building_impact_score;
              if (walulel_tbuild_s == null){
                  document.getElementById("tallbuildings-results").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='isd-1'><h6>Walulel Tall Building Impact Score</h6><span>0</span></div>";
                  document.getElementById("tall-mobile").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='col-xs-6 border-left'><h6>Walulel Tall Building Impact Score</h6><span>0</span></div>";
              } else {
                  document.getElementById("tallbuildings-results").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='isd-1'><h6>Walulel Tall Building Impact Score</h6><span>" + walulel_tbuild_s + "</span></div>";
                  document.getElementById("tall-mobile").innerHTML = "<h4 class='text-center'>TALL BUILDINGS INFORMATION</h4><div class='col-xs-6 border-left'><h6>Walulel Tall Building Impact Score</h6><span>" + walulel_tbuild_s + "</span></div>";
              }
            
            // data for walulel tall building cluster effect score
            var walulel_tbcs = res.TallBuildings.walulel_tb_cluster_effect_score;
              if (walulel_tbcs == null){
                  document.getElementById("tallbuildings-results").innerHTML += "<div class='isd-2'><h6>Walulel Tall Building Cluster Effect Score</h6><span>0</span></div>";
                  document.getElementById("tall-mobile").innerHTML += "<div class='col-xs-6 border-right'><h6>Walulel Tall Building Cluster Effect Score</h6><span>0</span></div>";
              } else {
                  document.getElementById("tallbuildings-results").innerHTML += "<div class='isd-2'><h6>Walulel Tall Building Cluster Effect Score</h6><span>" + walulel_tbcs + "</span></div>";
                  document.getElementById("tall-mobile").innerHTML += "<div class='col-xs-6 border-right'><h6>Walulel Tall Building Cluster Effect Score</h6><span>" + walulel_tbcs + "</span></div>";
              }
            
        } // this displays info from wtbs and wtbc 
          
        else if ((document.getElementById("tallbuilings-title").checked == false && document.getElementById("ltbc").checked == false && document.getElementById("wtbs").checked == false && document.getElementById("wtbc").checked == false) || (document.getElementById("tallbuildings-m-title").checked == false && document.getElementById("m-ltbc").checked == false && document.getElementById("m-wtbs").checked == false && document.getElementById("m-wtbc").checked == false)) {
          $('#tallbuildings-results').addClass('hide');
          $('#tall-mobile').addClass('hide');
          }
        
      }
        else {
            document.getElementById("tallbuildings-results").innerHTML = "Sad as it is for us to admit this but we don\'t have this data but you bet we are working on it.";
        }
        
    // data for Me
      if( res.Latitude && res.Longitude ) {
        st_view(map, {
          latitude: res.Latitude,
          longitude: res.Longitude
        });
      } else {
        // console.log('postcode not found');
        document.getElementById("heading").innerHTML = "Sorry, Postcode not found!";
//        $('.popup p').text('Sorry, postcode not found');
        //$('.mobile-search-results h3').text('Sorry, postcode not found');
        document.getElementById("mobile-heading").innerHTML = "Sorry, postcode not found!";
      }
    });
  }
  
 // function for submitting the form
function submit_form() {
    var postcode = inp_val();
//  var postcode = $('#post_c').val();
    if( postcode != '' ) {
    // alert('here it is');
      reveal_modal();
      pLoc(postcode);
      // get nhs data (dentists, gppractices)
      get_dentists(postcode);
      get_gppractices(postcode);
      // $('.popup p').text(postcode);
    } else {
       //console.log('no postcode provided');
      document.getElementById("heading").innerHTML = "Kindly provide a postcode!";
      //$('.popup p').text('Kindly provide a postcode');
      document.getElementById("mobile-heading").innerHTML = "Kindly provide a postcode!";
      //$('.mobile-search-results h3').text('Kindly provide a postcode');
      $('#broadband').addClass('hide');
    }
}
    
//function to to reveal which results slider on which screen size   
function reveal_modal() {
    
    if( navigator.userAgent.match(/iPad/i) ) {
        // tablet
        //alert('tablet');
        showModal_mobile();
    } else if ( navigator.userAgent.match(/Android|webOS|iPhone|iPod|Blackberry/i) ) {
        // mobile
//        alert('mobile');
        showModal_mobile();
    } else {
        // desktop
//        alert('desktop');
//        panel.slideReveal("toggle");
    }
    
}
    
//function to get postcode input (either mobile or desktop)
function inp_val() {
    if ( navigator.userAgent.match(/iPad/i) ) {
         var postcode = $('#post_m').val();
        return postcode;
    } else if (navigator.userAgent.match(/Android|webOS|iPhone|iPod|Blackberry/i))  {
         var postcode = $('#post_m').val();
        return postcode;
    } else {
        var postcode = $('#post_c').val();
        return postcode;
    }
}

// function to get dental information from 3rd party api
function get_dentists(postcode) {
  //console.log('requesting....dentists, nhs');
  var t = Wl.nhs_dentists(postcode, function(res) {
    obj = JSON.parse(res);
    //console.log(obj);
      
      if(obj != null) {
          //alert("something is here");
          if((document.getElementById("dentist-title").checked == true) || (document.getElementById("dentist-m-title").checked == true)){
              $('#dental-results').removeClass('hide');
              $('#dental-mobile').removeClass('hide');
              
              //alert("you clicked on dental information");
              var dentist_name = obj[0].name;
              var dentist_address = obj[0].address;
              var dentist_distance = obj[0].distance_from_postcode_center;
              var dentist_accept = obj[0].accepting_new_patients_yn;
              var dentist_stars = obj[0].nhs_choices_user_star_rating;
              
              document.getElementById("dental-results").innerHTML = "<div class='isd-3'><h4 class='text-center'>DENTAL INFORMATION</h4>Name: " + dentist_name + "<br>" +
              "Address: " + dentist_address + "<br>" +
              "Distance from Postcode Centre: " + dentist_distance + "<br>" +
              "Accepting new patients: " + dentist_accept + "<br>" +
              "NHS User Star Ratings: " + dentist_stars + "</div>";
              
              document.getElementById("dental-mobile").innerHTML = "<div class='col-xs-12'><h5 class='text-center'>DENTAL INFORMATION</h5>Name: " + dentist_name + "<br>" +
              "Address: " + dentist_address + "<br>" +
              "Distance from Postcode Centre: " + dentist_distance + "<br>" +
              "Accepting new patients: " + dentist_accept + "<br>" +
              "NHS User Star Ratings: " + dentist_stars + "</div>";
              // 1st option
              
              var dentist_name = obj[1].name;
              var dentist_address = obj[1].address;
              var dentist_distance = obj[1].distance_from_postcode_center;
              var dentist_accept = obj[1].accepting_new_patients_yn;
              var dentist_stars = obj[1].nhs_choices_user_star_rating;
              
              document.getElementById("dental-results").innerHTML += "<div class='isd-3'>Name: " + dentist_name + "<br>" +
              "Address: " + dentist_address + "<br>" +
              "Distance from Postcode Centre: " + dentist_distance + "<br>" +
              "Accepting new patients: " + dentist_accept + "<br>" +
              "NHS User Star Ratings: " + dentist_stars + "</div>";
              
              document.getElementById("dental-mobile").innerHTML += "<div class='col-xs-12'>Name: " + dentist_name + "<br>" +
              "Address: " + dentist_address + "<br>" +
              "Distance from Postcode Centre: " + dentist_distance + "<br>" +
              "Accepting new patients: " + dentist_accept + "<br>" +
              "NHS User Star Ratings: " + dentist_stars + "</div>";
              // 2nd option
              
              var dentist_name = obj[2].name;
              var dentist_address = obj[2].address;
              var dentist_distance = obj[2].distance_from_postcode_center;
              var dentist_accept = obj[2].accepting_new_patients_yn;
              var dentist_stars = obj[2].nhs_choices_user_star_rating;
              
              document.getElementById("dental-results").innerHTML += "<div class='isd-3'>Name: " + dentist_name + "<br>" +
              "Address: " + dentist_address + "<br>" +
              "Distance from Postcode Centre: " + dentist_distance + "<br>" +
              "Accepting new patients: " + dentist_accept + "<br>" +
              "NHS User Star Ratings: " + dentist_stars + "</div>";
              
              document.getElementById("dental-mobile").innerHTML += "<div class='col-xs-12'>Name: " + dentist_name + "<br>" +
              "Address: " + dentist_address + "<br>" +
              "Distance from Postcode Centre: " + dentist_distance + "<br>" +
              "Accepting new patients: " + dentist_accept + "<br>" +
              "NHS User Star Ratings: " + dentist_stars + "</div>";
              // 3rd option
              
              var dentist_name = obj[3].name;
              var dentist_address = obj[3].address;
              var dentist_distance = obj[3].distance_from_postcode_center;
              var dentist_accept = obj[3].accepting_new_patients_yn;
              var dentist_stars = obj[3].nhs_choices_user_star_rating;
              
              document.getElementById("dental-results").innerHTML += "<div class='isd-3'>Name: " + dentist_name + "<br>" +
              "Address: " + dentist_address + "<br>" +
              "Distance from Postcode Centre: " + dentist_distance + "<br>" +
              "Accepting new patients: " + dentist_accept + "<br>" +
              "NHS User Star Ratings: " + dentist_stars + "</div>";
              
              document.getElementById("dental-mobile").innerHTML += "<div class='col-xs-12'>Name: " + dentist_name + "<br>" +
              "Address: " + dentist_address + "<br>" +
              "Distance from Postcode Centre: " + dentist_distance + "<br>" +
              "Accepting new patients: " + dentist_accept + "<br>" +
              "NHS User Star Ratings: " + dentist_stars + "</div>";
              // 4th option
              
              var dentist_name = obj[4].name;
              var dentist_address = obj[4].address;
              var dentist_distance = obj[4].distance_from_postcode_center;
              var dentist_accept = obj[4].accepting_new_patients_yn;
              var dentist_stars = obj[4].nhs_choices_user_star_rating;
              
              document.getElementById("dental-results").innerHTML += "<div class='isd-3'>Name: " + dentist_name + "<br>" +
              "Address: " + dentist_address + "<br>" +
              "Distance from Postcode Centre: " + dentist_distance + "<br>" +
              "Accepting new patients: " + dentist_accept + "<br>" +
              "NHS User Star Ratings: " + dentist_stars + "</div>";
              
              document.getElementById("dental-mobile").innerHTML += "<div class='col-xs-12'>Name: " + dentist_name + "<br>" +
              "Address: " + dentist_address + "<br>" +
              "Distance from Postcode Centre: " + dentist_distance + "<br>" +
              "Accepting new patients: " + dentist_accept + "<br>" +
              "NHS User Star Ratings: " + dentist_stars + "</div>";
              // 5th option
          }
          
          else {
              $('#dental-results').addClass('hide');
              $('#dental-mobile').addClass('hide');
          }
              
      } else {
          document.getElementById("dentist-results").innerHTML = "Sorry.";
          document.getElementById("dental-mobile").innerHTML = "Sorry.";
      }
      
  });
}

// function to get nhs information from 3rd party api
function get_gppractices(postcode) {
  //console.log('requesting....gppractices, nhs');
  var t = Wl.nhs_gppractices(postcode, function(res) {
    obj = JSON.parse(res);
    //console.log(obj);
      
    if (obj != null) {
        if ((document.getElementById("nhs-title").checked == true) || (document.getElementById("nhs-m-title").checked == true)){
            //alert("nhs information");
            $("#nhs-results").removeClass('hide');
            $("#nhs-mobile").removeClass('hide');
            
            var nhs_name = obj[0].name;
            var nhs_address = obj[0].address;
            var nhs_distance = obj[0].distance_from_postcode_center;
            var nhs_accept = obj[0].accepting_new_patients_yn;
            var nhs_registered = obj[0].number_of_registred_patients;
            var nhs_surgery = obj[0].percentage_surgery_recommend;
            var nhs_stars = obj[0].nhs_choices_user_star_rating;
            
            document.getElementById("nhs-results").innerHTML = "<div class='isd-3'><h4 class='text-center'>NHS HEALTH</h4>Name: " + nhs_name + "<br>" + "Address: " + nhs_address + "<br>" + 
            "Distance from Postcode Center: " + nhs_distance + "<br>" +
            "Accepting new patients: " + nhs_accept + "<br>" +
            "Number of Registered Patients: " + nhs_registered + "<br>" +
            "Percentage Surgery: " + nhs_surgery + "<br>" + 
            "NHS User Star Rating: " + nhs_stars + "</div>";
            
            document.getElementById("nhs-mobile").innerHTML = "<div class='col-xs-12'><h4 class='text-center'>NHS HEALTH</h4>Name: " + nhs_name + "<br>" + "Address: " + nhs_address + "<br>" + 
            "Distance from Postcode Center: " + nhs_distance + "<br>" +
            "Accepting new patients: " + nhs_accept + "<br>" +
            "Number of Registered Patients: " + nhs_registered + "<br>" +
            "Percentage Surgery: " + nhs_surgery + "<br>" + 
            "NHS User Star Rating: " + nhs_stars + "</div>";
            // 1st option
            
            var nhs_name = obj[1].name;
            var nhs_address = obj[1].address;
            var nhs_distance = obj[1].distance_from_postcode_center;
            var nhs_accept = obj[1].accepting_new_patients_yn;
            var nhs_registered = obj[1].number_of_registred_patients;
            var nhs_surgery = obj[1].percentage_surgery_recommend;
            var nhs_stars = obj[1].nhs_choices_user_star_rating;
            
            document.getElementById("nhs-results").innerHTML += "<div class='isd-3'>Name: " + nhs_name + "<br>" + "Address: " + nhs_address + "<br>" + 
            "Distance from Postcode Center: " + nhs_distance + "<br>" +
            "Accepting new patients: " + nhs_accept + "<br>" +
            "Number of Registered Patients: " + nhs_registered + "<br>" +
            "Percentage Surgery: " + nhs_surgery + "<br>" + 
            "NHS User Star Rating: " + nhs_stars + "</div>";
            
            document.getElementById("nhs-mobile").innerHTML += "<div class='col-xs-12'>Name: " + nhs_name + "<br>" + "Address: " + nhs_address + "<br>" + 
            "Distance from Postcode Center: " + nhs_distance + "<br>" +
            "Accepting new patients: " + nhs_accept + "<br>" +
            "Number of Registered Patients: " + nhs_registered + "<br>" +
            "Percentage Surgery: " + nhs_surgery + "<br>" + 
            "NHS User Star Rating: " + nhs_stars + "</div>";
            // 2nd option
            
            var nhs_name = obj[2].name;
            var nhs_address = obj[2].address;
            var nhs_distance = obj[2].distance_from_postcode_center;
            var nhs_accept = obj[2].accepting_new_patients_yn;
            var nhs_registered = obj[2].number_of_registred_patients;
            var nhs_surgery = obj[2].percentage_surgery_recommend;
            var nhs_stars = obj[2].nhs_choices_user_star_rating;
            
            document.getElementById("nhs-results").innerHTML += "<div class='isd-3'>Name: " + nhs_name + "<br>" + "Address: " + nhs_address + "<br>" + 
            "Distance from Postcode Center: " + nhs_distance + "<br>" +
            "Accepting new patients: " + nhs_accept + "<br>" +
            "Number of Registered Patients: " + nhs_registered + "<br>" +
            "Percentage Surgery: " + nhs_surgery + "<br>" + 
            "NHS User Star Rating: " + nhs_stars + "</div>";
            
            document.getElementById("nhs-mobile").innerHTML += "<div class='col-xs-12'>Name: " + nhs_name + "<br>" + "Address: " + nhs_address + "<br>" + 
            "Distance from Postcode Center: " + nhs_distance + "<br>" +
            "Accepting new patients: " + nhs_accept + "<br>" +
            "Number of Registered Patients: " + nhs_registered + "<br>" +
            "Percentage Surgery: " + nhs_surgery + "<br>" + 
            "NHS User Star Rating: " + nhs_stars + "</div>";
            // 3rd option
            
            var nhs_name = obj[3].name;
            var nhs_address = obj[3].address;
            var nhs_distance = obj[3].distance_from_postcode_center;
            var nhs_accept = obj[3].accepting_new_patients_yn;
            var nhs_registered = obj[3].number_of_registred_patients;
            var nhs_surgery = obj[3].percentage_surgery_recommend;
            var nhs_stars = obj[3].nhs_choices_user_star_rating;
            
            document.getElementById("nhs-results").innerHTML += "<div class='isd-3'>Name: " + nhs_name + "<br>" + "Address: " + nhs_address + "<br>" + 
            "Distance from Postcode Center: " + nhs_distance + "<br>" +
            "Accepting new patients: " + nhs_accept + "<br>" +
            "Number of Registered Patients: " + nhs_registered + "<br>" +
            "Percentage Surgery: " + nhs_surgery + "<br>" + 
            "NHS User Star Rating: " + nhs_stars + "</div>";
            
            document.getElementById("nhs-mobile").innerHTML += "<div class='col-xs-12'>Name: " + nhs_name + "<br>" + "Address: " + nhs_address + "<br>" + 
            "Distance from Postcode Center: " + nhs_distance + "<br>" +
            "Accepting new patients: " + nhs_accept + "<br>" +
            "Number of Registered Patients: " + nhs_registered + "<br>" +
            "Percentage Surgery: " + nhs_surgery + "<br>" + 
            "NHS User Star Rating: " + nhs_stars + "</div>";
            // 4th option
            
            var nhs_name = obj[4].name;
            var nhs_address = obj[4].address;
            var nhs_distance = obj[4].distance_from_postcode_center;
            var nhs_accept = obj[4].accepting_new_patients_yn;
            var nhs_registered = obj[4].number_of_registred_patients;
            var nhs_surgery = obj[4].percentage_surgery_recommend;
            var nhs_stars = obj[4].nhs_choices_user_star_rating;
            
            document.getElementById("nhs-results").innerHTML += "<div class='isd-3'>Name: " + nhs_name + "<br>" + "Address: " + nhs_address + "<br>" + 
            "Distance from Postcode Center: " + nhs_distance + "<br>" +
            "Accepting new patients: " + nhs_accept + "<br>" +
            "Number of Registered Patients: " + nhs_registered + "<br>" +
            "Percentage Surgery: " + nhs_surgery + "<br>" + 
            "NHS User Star Rating: " + nhs_stars + "</div>";
            
            document.getElementById("nhs-mobile").innerHTML += "<div class='col-xs-12'>Name: " + nhs_name + "<br>" + "Address: " + nhs_address + "<br>" + 
            "Distance from Postcode Center: " + nhs_distance + "<br>" +
            "Accepting new patients: " + nhs_accept + "<br>" +
            "Number of Registered Patients: " + nhs_registered + "<br>" +
            "Percentage Surgery: " + nhs_surgery + "<br>" + 
            "NHS User Star Rating: " + nhs_stars + "</div>";
            // 5th option
            
        } else {
            $("#nhs-results").addClass('hide');    
            $("#nhs-mobile").addClass('hide');    
        }
    } else {
        document.getElementById("nhs-results").innerHTML = "Sorry.";
        document.getElementById("nhs-mobile").innerHTML = "Sorry.";
    }
  });
}

// get_dentists('SE1 7AE');
// get_gppractices('SE1 7AE');

  // Submit the form via click event
  $(document).on('click', '#search_p, #mobile-ss', function(e) {
    e.preventDefault();
    submit_form();
  });
    
// Submit the form via enter key
$(document).keypress(function (e){
    if(e.which == 13){
        e.preventDefault();
        submit_form();
        panel.slideReveal("toggle");
    }
});
    
$(document).on('click', '#cancel_p', function() {
    d3.selectAll('.selected').classed('selected', false);
    d3.selectAll('.opacity').classed('opacity', false);
});

 
// Slide up for Mobile View Results
function showModal_mobile() {
    if($('.mobile-search-results').hasClass('slide-up')) {
        $('.mobile-search-results').addClass('slide-down', 1000);
        $('.mobile-search-results').removeClass('slide-up');
    } else {
        $('.mobile-search-results').removeClass('slide-down');
        $('.mobile-search-results').delay(800).addClass('slide-up', 1000);
    }
}

// Slide up for Mobile View Results
$('#mobile-ss').click(function() {
    if($('.mobile-search-results').hasClass('slide-up')) {
        $('.mobile-search-results').addClass('slide-down', 1000);
        $('.mobile-search-results').removeClass('slide-up');
    } else {
        $('.mobile-search-results').removeClass('slide-down');
        $('.mobile-search-results').delay(800).addClass('slide-up', 1000);
    }
});
    
// Slide the Mobile Results Down if Mobile Popup is clicked
$('#mobile-expand-ss').click(function(){
    if($('.mobile-search-results').hasClass('slide-up')) {
        $('.mobile-search-results').addClass('slide-down', 1000);
        $('.mobile-search-results').removeClass('slide-up');
    } else {
        // do nothing!!
    }
});
    
// Slide the Mobile Popup Left if Mobile Search is clicked
$('#mobile-ss').click(function() {
   if($('.mobile-expand-popup').css('left', '0px')){
       $('.mobile-expand-popup').css('left', '-300px');
   } else {
       // do nothing
   }
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
  // get nhs data (dentists, gppractices)
  get_dentists(pst);
  get_gppractices(pst);
  reveal_modal();
});
    
  
    
// this is from the search page itself (dont delete).... 
function broadbandAverage() {
    document.getElementById("broadband-results").innerHTML = "<table class='table'><thead><tr><th>London-wide <br>descriptive statistic</th><th>Values</th></tr></thead><tbody><tr><td>Min Value</td><td>0.3 mbps</td></tr><tr><td>1st Quartile</td><td>18 mbps</td></tr><tr><td>Mean</td><td>26.32 mbps</td></tr><tr><td>Median</td><td>25.8 mbps</td></tr><tr><td>3rd Quartile</td><td>33.5 mbps</td></tr><tr><td>Max Value</td><td>152 mbps</td></tr></tbody></table>";
    
    document.getElementById("broadband-mobile").innerHTML = "<table class='table'><thead><tr><th>London-wide <br>descriptive statistic</th><th>Values</th></tr></thead><tbody><tr><td>Min Value</td><td>0.3 mbps</td></tr><tr><td>1st Quartile</td><td>18 mbps</td></tr><tr><td>Mean</td><td>26.32 mbps</td></tr><tr><td>Median</td><td>25.8 mbps</td></tr><tr><td>3rd Quartile</td><td>33.5 mbps</td></tr><tr><td>Max Value</td><td>152 mbps</td></tr></tbody></table>";
}
    

}


