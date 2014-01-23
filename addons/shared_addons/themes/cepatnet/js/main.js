// JavaScript Document

$(document).ready(function() {
	$('.orbit-slider').orbit({
		 animation: 'fade',  
		 animationSpeed: 800,   
		 timer: true, 			
		 advanceSpeed: 8000, 		
		 directionalNav: false, 		 
		 captions: true, 			 
		 captionAnimation: 'fade', 		 
		 captionAnimationSpeed: 800, 	 
		 bullets: true,			 
		 bulletThumbs: true,
		 fluid:true
	});
	
	centerOrbitNav();
});

$(window).resize(function() {
	centerOrbitNav();
	setLayout();
});

function setLayout(){
	var winW = $(window).width();
	if(winW <= 960){
		$('#header, #footer, #util').width(960);
	}else{
		$('#header, #footer, #util').css('width', '100%');
	}
}

function centerOrbitNav(){
	var navW = $('.orbit-bullets').width();
	var winW = $(window).width();
	var centerPos = Math.floor((winW - navW)/2);
	
	$('.orbit-bullets').css('left', centerPos + 'px');
}