// Javascript for the Navbar Toggle

$(document).ready(function () {
   $(".navbar-toggle").on("click", function () {
   $(this).toggleClass("active");
   });
});

// Javascript for the Navbar Class Active Switcher
//$(function() {
//    $(".nav li").on("click", function() {
//    $(".nav li").removeClass("active");
//    $(this).addClass("active");
//  });
  
//});

//$(".nav a").on("click", function(){
//	$(".nav").find("active").removeClass("active");
//	$(this).parent().addClass("active");	
//});

// Javascript for Back-to-top 
$(document).ready(function(){
	$(window).scroll(function(){
		if($(this).scrollTop() > 50){
			$('#back-to-top').fadeIn();
		}else {
			$('#back-to-top').fadeOut();
		}
	});	
	// Scroll to top
	$('#back-to-top').click(function(){
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});
});

// Javascript for Back-to-top-inverse 
$(document).ready(function(){
	$(window).scroll(function(){
		if($(this).scrollTop() > 50){
			$('#back-to-top-inverse').fadeIn();
		}else {
			$('#back-to-top-inverse').fadeOut();
		}
	});	
	// Scroll to top
	$('#back-to-top-inverse').click(function(){
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});
});


// Javascript for the Modals 

$('#myModal').on('shown.bs.modal', function() {
  $('#myInput').focus()
})

// JavaScript for the Search map
        var mymap = L.map('mapid', { fadeAnimation: false }).setView([51.5074, 0.1278], 13);
        L.tileLayer.grayscale('http://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="http://openstreetmap.org/">OpenStreetMap</a> contributors',
        }).addTo(mymap);

/*var mymap = L.map('mapid').setView([5.55779, -0.17224], 13);

L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(mymap);*/
    

var mymap = L.map('mapid', {
	zoomControl: false
});

// Javascript for the Information Panel 
// hides the information panel first!
//$(".results").hide();
$("btn").click(function(){
	$('.results').hide('slide', {
		direction: 'left'}, 1000);
})
/* Fade in the Information panel
$('#btn').click(function({
	
})) 
*/


