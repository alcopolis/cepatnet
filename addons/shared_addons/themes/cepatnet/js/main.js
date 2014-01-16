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