/*! main.js */
// Activate CSS emoticonization
$('#wrapper').emoticonize();

// http://andrewhenderson.me/tutorial/jquery-sticky-sidebar/
$(function(){ // document ready
	var stickyTop = $('#header nav').offset().top; // returns number
	$(window).scroll(function(){ // scroll event
		var windowTop = $(window).scrollTop(); // returns number
		if (stickyTop < windowTop) {
			$('#header nav').css({position:'fixed', top:0, background:'#fff', width:'100%'});
			$('#content').css('margin-top','70px');
		} else {
			$('#header nav').css({position:'static'});
			$('#content').css('margin-top','0');
		}
	});
});
