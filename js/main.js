/*! main.js */
// Activate CSS emoticonization
$('#wrapper').emoticonize();

// http://andrewhenderson.me/tutorial/jquery-sticky-sidebar/
$(function(){ // document ready
	var stickyTop = $('#header nav').offset().top; // returns number
	$(window).scroll(function(){ // scroll event
		var windowTop = $(window).scrollTop(); // returns number
		var placeholderHeight = $('#header nav').height() + 'px'; // returns number
		if (stickyTop < windowTop) {
			$('#header nav').css({position:'fixed', top:0, background:'#fff', width:'100%', 'border-bottom-color':'#aaa'});
			$('.nav-placeholder').css({height:placeholderHeight});
		} else {
			$('#header nav').css({position:'static', 'border-bottom-color':'#eee'});
			$('.nav-placeholder').css({height:'0px'});
		}
	});
});
