//Use for navigation bar for mobile
window.addEventListener('scroll', function () {
  // Hide the displayed menu. If you want to scroll, you're obviously not interested in the options.
  $('.navbar-collapse').collapse('hide');
// Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function() {
  $(".navbar-collapse").collapse('hide');});
});

// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {$('body').on('click', 'a.scrollable', function(event) {
  var $anchor = $(this);
  $('html, body').stop().animate({scrollTop: ($($anchor.attr('href')).offset().top - $('#banner').outerHeight())},1500,'easeInOutExpo');
  event.preventDefault();
  });
});

//JavaScript for Google Map
var map;
function initMap() {
  if ($(window).width() <= 768){
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 40.4168, lng: 5.7038},
    zoom: 1,
    scrollwheel: false
  });
} else {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 40.4168, lng: 5.7038},
    zoom: 2,
    scrollwheel: false
  });
}}
