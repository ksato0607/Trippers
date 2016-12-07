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
