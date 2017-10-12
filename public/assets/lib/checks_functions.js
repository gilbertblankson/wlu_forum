function check_broadband() {

// if Postcode contain any Broadband information
      if (res.Broadband != null) {
      $('#broadband-results').removeClass('hide');
        
        // if main "broadband" is selected
        
        if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == true && document.getElementById("average_zs").checked == true && document.getElementById("average_us").checked == true && document.getElementById("average_uzs").checked == true)){
            
        //alert("here we go");
        var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
        wifispeed(Number(d_speed_mbs))

        // data for average download speed(mbs)
        document.getElementById("broadband-results").innerHTML = "<div class='isd-1'><h2>Broadband Average Download Speed(mbs)</h2><span>" + d_speed_mbs + " mbs</span></div>";

        // data for average download speed z-score
        var d_speed_zscore = res.Broadband.average_dload_speed_zscore;
        document.getElementById("broadband-results").innerHTML += "<div class='isd-2'><h2>Broadband Average Download Z-Score</h2><span>" + d_speed_zscore + "</span></div>";
        //$('.mobile-search-results span.dpz').text(d_speed_zscore);

        // data for upload speed(mbs)
        var u_speed_mbs = res.Broadband.average_upload_speed_mbs;
        document.getElementById("broadband-results").innerHTML += "<div class='isd-1'><h2>Broadband Average Upload Speed(mbs)</h2><span>" + u_speed_mbs + " mbs</span></div>";
        //$('.popup span.ups, .mobile-search-results span.ups').text((u_speed_mbs) + ' mbs');

        // data for average upload speed z-score
        var u_speed_zscore = res.Broadband.average_upload_speed_zscore;
        document.getElementById("broadband-results").innerHTML += "<div class='isd-2'><h2>Broadband Average Upload Z-Score</h2><span>" + u_speed_zscore + "</span></div>";
        //$('.popup span.upz, .mobile-search-results span.upz').text(u_speed_zscore);
            
            
        } 1
          // if subs "broadband-dropdowns" are selected
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == true && document.getElementById("average_zs").checked == false && document.getElementById("average_us").checked == false && document.getElementById("average_uzs").checked == false)) {
            var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
            wifispeed(Number(d_speed_mbs))
            
            // data for average download speed(mbs)
            document.getElementById("broadband-results").innerHTML = "<div class='isd-1'><h2>Broadband Average Download Speed(mbs)</h2><span>" + d_speed_mbs + " mbs</span></div>";
              
          } // this will display just the average download speed 2
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == false && document.getElementById("average_zs").checked == true && document.getElementById("average_us").checked == false && document.getElementById("average_uzs").checked == false)) {
            var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
            wifispeed(Number(d_speed_mbs))

            // data for average download speed z-score
            var d_speed_zscore = res.Broadband.average_dload_speed_zscore;
            document.getElementById("broadband-results").innerHTML = "<div class='isd-1'><h2>Broadband Average Download Z-Score</h2><span>" + d_speed_zscore + "</span></div>";
            //$('.mobile-search-results span.dpz').text(d_speed_zscore);
              
          } // this will display just the average download speed z-score 3
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == false && document.getElementById("average_zs").checked == false && document.getElementById("average_us").checked == true && document.getElementById("average_uzs").checked == false)) {
            var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
            wifispeed(Number(d_speed_mbs))

            // data for upload speed(mbs)
            var u_speed_mbs = res.Broadband.average_upload_speed_mbs;
            document.getElementById("broadband-results").innerHTML = "<div class='isd-1'><h2>Broadband Average Upload Speed(mbs)</h2><span>" + u_speed_mbs + " mbs</span></div>";
            //$('.popup span.ups, .mobile-search-results span.ups').text((u_speed_mbs) + ' mbs');
              
          } // this will display just the average upload speed 4
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == false && document.getElementById("average_zs").checked == false && document.getElementById("average_us").checked == false && document.getElementById("average_uzs").checked == true)) {
            var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
            wifispeed(Number(d_speed_mbs))

            // data for average upload speed z-score
            var u_speed_zscore = res.Broadband.average_upload_speed_zscore;
            document.getElementById("broadband-results").innerHTML = "<div class='isd-1'><h2>Broadband Average Upload Z-Score</h2><span>" + u_speed_zscore + "</span></div>";
            //$('.popup span.upz, .mobile-search-results span.upz').text(u_speed_zscore);
              
          } // this will display just the average upload speed z-score 5
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == true && document.getElementById("average_zs").checked == true && document.getElementById("average_us").checked == false && document.getElementById("average_uzs").checked == false)) {
              var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
              wifispeed(Number(d_speed_mbs))

              // data for average download speed(mbs)
              document.getElementById("broadband-results").innerHTML = "<div class='isd-1'><h2>Broadband Average Download Speed(mbs)</h2><span>" + d_speed_mbs + " mbs</span></div>";

              // data for average download speed z-score
              var d_speed_zscore = res.Broadband.average_dload_speed_zscore;
              document.getElementById("broadband-results").innerHTML += "<div class='isd-2'><h2>Broadband Average Download Z-Score</h2><span>" + d_speed_zscore + "</span></div>";
              //$('.mobile-search-results span.dpz').text(d_speed_zscore);
              
          } // this will display just the average download speed and average download speed z-score 6
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == true && document.getElementById("average_zs").checked == false && document.getElementById("average_us").checked == true && document.getElementById("average_uzs").checked == false)) {
              var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
              wifispeed(Number(d_speed_mbs))

              // data for average download speed(mbs)
              document.getElementById("broadband-results").innerHTML = "<div class='isd-1'><h2>Broadband Average Download Speed(mbs)</h2><span>" + d_speed_mbs + " mbs</span></div>";

              // data for upload speed(mbs)
              var u_speed_mbs = res.Broadband.average_upload_speed_mbs;
              document.getElementById("broadband-results").innerHTML += "<div class='isd-2'><h2>Broadband Average Upload Speed(mbs)</h2><span>" + u_speed_mbs + " mbs</span></div>";
              //$('.popup span.ups, .mobile-search-results span.ups').text((u_speed_mbs) + ' mbs');
              
          }  // this will display just the average download speed and average upload speed 7
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == true && document.getElementById("average_zs").checked == false && document.getElementById("average_us").checked == false && document.getElementById("average_uzs").checked == true)) {
              var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
              wifispeed(Number(d_speed_mbs))

              // data for average download speed(mbs)
              document.getElementById("broadband-results").innerHTML = "<div class='isd-1'><h2>Broadband Average Download Speed(mbs)</h2><span>" + d_speed_mbs + " mbs</span></div>";

              // data for average upload speed z-score
              var u_speed_zscore = res.Broadband.average_upload_speed_zscore;
              document.getElementById("broadband-results").innerHTML += "<div class='isd-2'><h2>Broadband Average Upload Z-Score</h2><span>" + u_speed_zscore + "</span></div>";
              //$('.popup span.upz, .mobile-search-results span.upz').text(u_speed_zscore);
              
          } // this will display just the average download speed and average upload speed z-score 8
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == false && document.getElementById("average_zs").checked == true && document.getElementById("average_us").checked == true && document.getElementById("average_uzs").checked == false)){
              var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
              wifispeed(Number(d_speed_mbs))

              // data for average download speed z-score
              var d_speed_zscore = res.Broadband.average_dload_speed_zscore;
              document.getElementById("broadband-results").innerHTML = "<div class='isd-1'><h2>Broadband Average Download Z-Score</h2><span>" + d_speed_zscore + "</span></div>";
              //$('.mobile-search-results span.dpz').text(d_speed_zscore);

              // data for upload speed(mbs)
              var u_speed_mbs = res.Broadband.average_upload_speed_mbs;
              document.getElementById("broadband-results").innerHTML += "<div class='isd-2'><h2>Broadband Average Upload Speed(mbs)</h2><span>" + u_speed_mbs + " mbs</span></div>";
              //$('.popup span.ups, .mobile-search-results span.ups').text((u_speed_mbs) + ' mbs');
          
          } // this will display just the average download speed z-score and average upload speed 9
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == false && document.getElementById("average_zs").checked == true && document.getElementById("average_us").checked == false && document.getElementById("average_uzs").checked == true)){
              var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
              wifispeed(Number(d_speed_mbs))

              // data for average download speed z-score
              var d_speed_zscore = res.Broadband.average_dload_speed_zscore;
              document.getElementById("broadband-results").innerHTML = "<div class='isd-1'><h2>Broadband Average Download Z-Score</h2><span>" + d_speed_zscore + "</span></div>";
              //$('.mobile-search-results span.dpz').text(d_speed_zscore);

              // data for upload speed(mbs)
              var u_speed_zscore = res.Broadband.average_upload_speed_zscore;
              document.getElementById("broadband-results").innerHTML += "<div class='isd-2'><h2>Broadband Average Upload Z-Score</h2><span>" + u_speed_zscore + "</span></div>";
              //$('.popup span.upz, .mobile-search-results span.upz').text(u_speed_zscore);
          
          } // this will display just the average download speed z-score and average upload speed z-score 10
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == false && document.getElementById("average_zs").checked == true && document.getElementById("average_us").checked == true && document.getElementById("average_uzs").checked == true)){
              var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
              wifispeed(Number(d_speed_mbs))

              // data for average download speed z-score
              var d_speed_zscore = res.Broadband.average_dload_speed_zscore;
              document.getElementById("broadband-results").innerHTML = "<div class='isd-1'><h2>Broadband Average Download Z-Score</h2><span>" + d_speed_zscore + "</span></div>";
              //$('.mobile-search-results span.dpz').text(d_speed_zscore);

              // data for upload speed(mbs)
              var u_speed_mbs = res.Broadband.average_upload_speed_mbs;
              document.getElementById("broadband-results").innerHTML += "<div class='isd-2'><h2>Broadband Average Upload Speed(mbs)</h2><span>" + u_speed_mbs + " mbs</span></div>";
              //$('.popup span.ups, .mobile-search-results span.ups').text((u_speed_mbs) + ' mbs');

              // data for average upload speed z-score
              var u_speed_zscore = res.Broadband.average_upload_speed_zscore;
              document.getElementById("broadband-results").innerHTML += "<div class='isd-1'><h2>Broadband Average Upload Z-Score</h2><span>" + u_speed_zscore + "</span></div>";
              //$('.popup span.upz, .mobile-search-results span.upz').text(u_speed_zscore);
        
          } // this will display just the average download speed z-score and average upload speed and average upload speed z-score 11
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == false && document.getElementById("average_zs").checked == false && document.getElementById("average_us").checked == true && document.getElementById("average_uzs").checked == true)){
              var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
              wifispeed(Number(d_speed_mbs))

              // data for upload speed(mbs)
              var u_speed_mbs = res.Broadband.average_upload_speed_mbs;
              document.getElementById("broadband-results").innerHTML = "<div class='isd-1'><h2>Broadband Average Upload Speed(mbs)</h2><span>" + u_speed_mbs + " mbs</span></div>";
              //$('.popup span.ups, .mobile-search-results span.ups').text((u_speed_mbs) + ' mbs');

              // data for average upload speed z-score
              var u_speed_zscore = res.Broadband.average_upload_speed_zscore;
              document.getElementById("broadband-results").innerHTML += "<div class='isd-2'><h2>Broadband Average Upload Z-Score</h2><span>" + u_speed_zscore + "</span></div>";
              //$('.popup span.upz, .mobile-search-results span.upz').text(u_speed_zscore);
          
          } // this will display just the average upload speed and average upload speed z-score 12
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == true && document.getElementById("average_zs").checked == true && document.getElementById("average_us").checked == true && document.getElementById("average_uzs").checked == false)){
              var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
              wifispeed(Number(d_speed_mbs))
              
              // data for average download speed(mbs)
              document.getElementById("broadband-results").innerHTML = "<div class='isd-1'><h2>Broadband Average Download Speed(mbs)</h2><span>" + d_speed_mbs + " mbs</span></div>";
              
              // data for average download speed z-score
              var d_speed_zscore = res.Broadband.average_dload_speed_zscore;
              document.getElementById("broadband-results").innerHTML += "<div class='isd-2'><h2>Broadband Average Download Z-Score</h2><span>" + d_speed_zscore + "</span></div>";
              //$('.mobile-search-results span.dpz').text(d_speed_zscore);
              
              // data for upload speed(mbs)
              var u_speed_mbs = res.Broadband.average_upload_speed_mbs;
              document.getElementById("broadband-results").innerHTML += "<div class='isd-1'><h2>Broadband Average Upload Speed(mbs)</h2><span>" + u_speed_mbs + " mbs</span></div>";
              //$('.popup span.ups, .mobile-search-results span.ups').text((u_speed_mbs) + ' mbs');
                   
          } // this will display just the average download speed and average download speed z-score and average upload speed 13
          
          else if ((document.getElementById("broadband-title").checked == true && document.getElementById("average_mbs").checked == true && document.getElementById("average_zs").checked == false && document.getElementById("average_us").checked == true && document.getElementById("average_uzs").checked == true)){
              var d_speed_mbs = res.Broadband.average_dload_speed_mbs;
              wifispeed(Number(d_speed_mbs))
              
              // data for average download speed(mbs)
              document.getElementById("broadband-results").innerHTML = "<div class='isd-1'><h2>Broadband Average Download Speed(mbs)</h2><span>" + d_speed_mbs + " mbs</span></div>";
              
              // data for upload speed(mbs)
              var u_speed_mbs = res.Broadband.average_upload_speed_mbs;
              document.getElementById("broadband-results").innerHTML += "<div class='isd-2'><h2>Broadband Average Upload Speed(mbs)</h2><span>" + u_speed_mbs + " mbs</span></div>";
              //$('.popup span.ups, .mobile-search-results span.ups').text((u_speed_mbs) + ' mbs');
              
              // data for average upload speed z-score
              var u_speed_zscore = res.Broadband.average_upload_speed_zscore;
              document.getElementById("broadband-results").innerHTML += "<div class='isd-1'><h2>Broadband Average Upload Z-Score</h2><span>" + u_speed_zscore + "</span></div>";
              //$('.popup span.upz, .mobile-search-results span.upz').text(u_speed_zscore);
                   
          } // this will display just the average download speed and average upload speed and average upload speed z-score 14
          
          else if ((document.getElementById("broadband-title").checked == false && document.getElementById("average_mbs").checked == false && document.getElementById("average_zs").checked == false && document.getElementById("average_us").checked == false && document.getElementById("average_uzs").checked == false)) {
          $('.popup p').text("Kindly select an option from Broadband from the search box on the left and re-submit to display the information accordingly");
          document.getElementById('wifi').className = '';
          $('#broadband-results').addClass('hide');
          }
          
      } else { // if Postcode doesn't contain any Broadband information
        $('.popup p, .mobile-search-results h3').text("Sad as it is for us to admit this but we don\'t have this data but you bet we are working on it.");
        document.getElementById('wifi').className = 'sad';
      } 


} // end of check_broadband function