	//init scroll vars
	var scrollUpAmount = 0;
	var scrollDownAmount = 0;

	//make first slide active
	$( ".section:first-of-type" ).addClass( "activeSlide" );

	$( '.slideNav li a' ).click(function() {
	//this is not working properly yet
		$('.activeSlide').removeClass('.activeSlide');
		$('.activeSlide').css("margin-left: 100%;");
		$($(this).attr('href')).animate({ "margin-left": "0" }, { duration: 800, easing: "easeInBack" } );

		$($(this).attr('href')).addClass('activeSlide');

	});

	$("html, body").bind({'mousewheel DOMMouseScroll onmousewheel touchmove scroll':
	    function(e) {
	        if (e.target.id == 'el') return;
	        e.preventDefault();
	        e.stopPropagation();

	        //Determine Direction
	        if (e.originalEvent.wheelDelta && e.originalEvent.wheelDelta >= 0) {
				scrollUpAmount++;

	        } else if (e.originalEvent.detail && e.originalEvent.detail <= 0) {
	           scrollUpAmount++;

	        } else {
	            scrollDownAmount++;
	        }

	        if(scrollUpAmount > 3)
	        {
				$('.activeSlide').removeClass(function(){
					if($(this).prev('.section').length > 0)
					{
						window.location.hash = $(this).prev().attr('id');
						scrollUpAmount = 0;
						scrollDownAmount = 0;
						$(this).animate({ "margin-left": "+=100%" }, { duration: 800, easing: "easeOutBack" } );
						$(this).prev().addClass('activeSlide');
						return 'activeSlide';
					}
				})
			}
			if(scrollDownAmount > 3)
			{
					$('.activeSlide').removeClass(function(){
						if($(this).next('.section').length > 0)
						{
							window.location.hash = $(this).next().attr('id');
							scrollDownAmount = 0;
							scrollUpAmount = 0;
							$(this).next().animate({ "margin-left": "-=100%" }, { duration: 800, easing: "easeInBack" } );
							$(this).next().addClass('activeSlide');
							return 'activeSlide';
						}
					})

			}
	    }
	});

	$(document).ready(function() {
		$.material.init();
	});


