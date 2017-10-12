function init() {

    var map = L.map('mapid', { 
    fadeAnimation: false
    });

voronoiMap(map, 'assets/london_all.csv');

}

// Script for the Popup
var panel = $('.popup').slideReveal({
    trigger: $("#search_p"),
    position: "right",
    push: false,
    width: 400,
    top: 60,
    autoEscape: false,
    overlayColor: "rgba(0,0,0,0)"	
});

// Script for the Popup
var panel = $('.mobile-expand-popup').slideReveal({
    trigger: $("#mobile-expand-ss"),
    position: "left",
    push: false,
    width: 300,
    top: 160,
    autoEscape: false,
    overlayColor: "rgba(0,0,0,0)"	
});

// Script for the Ordered List
$(function(){
    $("#sortable").sortable();
    $("#sortable").disableSelection();	
});

// Script for Popovers
$('[data-toggle="popover"]').popover({
    placement : 'right',
    trigger : 'hover',
    container: 'body'
});

// Script for Checkbox Header Dropdowns
$(document).on('click', '.panel-heading span.clickable', function(e){
    var $this = $(this);
    if(!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.addClass('panel-collapsed');
        $this.find('i').removeClass('fa fa-chevron-down').addClass('fa fa-chevron-up');
    } else {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.removeClass('panel-collapsed');
        $this.find('i').removeClass('fa fa-chevron-up').addClass('fa fa-chevron-down');
    }            
})

// Scripts for Header Checkboxes
$("#broadband-title").click(function () {
    $(".bb-check").prop('checked', $(this).prop('checked'));
}); // broadband checkboxes

$("#broadband-m-title").click(function () {
    $(".bb-m-check").prop('checked', $(this).prop('checked'));
}); // broadband mobile checkboxes

$("#tallbuilings-title").click(function () {
    $(".tb-check").prop('checked', $(this).prop('checked'));
}); // tallbuilding checkboxes

$("#tallbuildings-m-title").click(function () {
    $(".tbm-check").prop('checked', $(this).prop('checked'));
}); // tallbuilding mobile checkboxes

$("#dentist-title").click(function () {
    $(".d-check").prop('checked', $(this).prop('checked'));
}); // dental information checkboxes

$("#dentist-m-title").click(function () {
    $(".dm-check").prop('checked', $(this).prop('checked'));
}); // dental information mobile checkboxes

$("#nhs-title").click(function () {
    $(".nhs-check").prop('checked', $(this).prop('checked'));
}); // NHS checkboxes

$("#nhs-m-title").click(function () {
    $(".nhm-check").prop('checked', $(this).prop('checked'));
}); // NHS mobile checkboxes


// Function for Broadband Checkbox
function checkb() {
    if (document.getElementById("average_mbs").checked == true){
        document.getElementById("broadband-title").checked = true;
        //alert("Checked Average Download Speed");
    } else if (document.getElementById("average_zs").checked == true) {
        document.getElementById("broadband-title").checked = true;
        //alert("Checked Average Download Z-Score");
    } else if (document.getElementById("average_us").checked == true) {
        document.getElementById("broadband-title").checked = true;
        //alert("Checked Average Upload Z-Score");
    } else if (document.getElementById("average_uzs").checked == true) {
        document.getElementById("broadband-title").checked = true;
        //alert("Checked Average Upload Z-Score");
    } else {
        document.getElementById("broadband-title").checked = false;
    }
} // function for broadband checkboxes

// Function for Mobile Broadband Checkbox
function checkbm() {
    if (document.getElementById("m-average_mbs").checked == true){
        document.getElementById("broadband-m-title").checked = true;
        //alert("Checked Average Download Speed");
    } else if (document.getElementById("m-average_zs").checked == true) {
        document.getElementById("broadband-m-title").checked = true;
        //alert("Checked Average Download Z-Score");
    } else if (document.getElementById("m-average_us").checked == true) {
        document.getElementById("broadband-m-title").checked = true;
        //alert("Checked Average Upload Z-Score");
    } else if (document.getElementById("m-average_uzs").checked == true) {
        document.getElementById("broadband-m-title").checked = true;
        //alert("Checked Average Upload Z-Score");
    } else {
        document.getElementById("broadband-m-title").checked = false;
    }
} // function for Mobile Broadband checkboxes

// Function for TallBuildings Checkbox
function checktb() {
    if (document.getElementById("ltbc").checked == true){
        document.getElementById("tallbuilings-title").checked = true;
        //alert("Checked ltbc");
    } else if (document.getElementById("wtbs").checked == true) {
        document.getElementById("tallbuilings-title").checked = true;
        //alert("Checked wtbs");
    } else if (document.getElementById("wtbc").checked == true) {
        document.getElementById("tallbuilings-title").checked = true;
        //alert("wtbc");
    } else {
        document.getElementById("tallbuilings-title").checked = false;
    }
} // function for TallBuildings checkbox

// Function for Mobile TallBuildings Checkbox
function checktbm() {
    if (document.getElementById("m-ltbc").checked == true){
        document.getElementById("tallbuildings-m-title").checked = true;
        //alert("Checked ltbc");
    } else if (document.getElementById("m-wtbs").checked == true) {
        document.getElementById("tallbuildings-m-title").checked = true;
        //alert("Checked wtbs");
    } else if (document.getElementById("m-wtbc").checked == true) {
        document.getElementById("tallbuildings-m-title").checked = true;
        //alert("wtbc");
    } else {
        document.getElementById("tallbuildings-m-title").checked = false;
    }
} // function for Mobile TallBuildings checkbox






    
function busy() {
    alert("clicked a checkbox");
}
