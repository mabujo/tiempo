$(document).ready(function() {

	// initialize material bootstrap
	$.material.init();

	// init fitText on main forecast text
	$(".forecastContent").fitText(0.9, { minFontSize: '40px'  });

	//make first slide active
	$( ".section:first-of-type" ).addClass( "activeSlide" );

	// nav buttons
	$( '.slideNav li a' ).click(function() {

		// current and next slide divs
		var	currentActive = $('#fullpage').find('.activeSlide').attr('id');
		var nextActive = $(this).attr('href');

		// slide current slide left
		$("#"+currentActive).css("margin-left: +=100%;");
		$("#"+currentActive).removeClass('activeSlide');

		// bring in new slide
		$(nextActive).velocity({ "margin-left": "0" }, { duration: 800, easing: "easeInBack" } );
		$(nextActive).addClass('activeSlide');

	});

	// add stars to night slides
	$( ".bgNight" ).append( '<div id="stars"></div><div id="stars2"></div><div id="stars3"></div>' );

	// init scroll vars
	var scrollUpAmount = 0;
	var scrollDownAmount = 0;
	var didScroll = false;

	// function to limit polling for scroll etc
	// just set didScroll to true, and handle the scroll event in the interval
	$("html, body").bind({'mousewheel DOMMouseScroll onmousewheel touchmove scroll':
	    function(e) {
	    	didScroll = true;
	    }
	});

	// this function handles state changes on scroll e.t.c.
	setInterval(function() {

		// scroll already fired
	    if ( didScroll ) {
	        didScroll = false;

	        // bind to scroll and swipe events
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

		        if(scrollUpAmount > 5)
		        {
					$('.activeSlide').removeClass(function(){
						if($(this).prev('.section').length > 0)
						{
							window.location.hash = $(this).prev().attr('id');
							scrollUpAmount = 0;
							scrollDownAmount = 0;
							$(this).velocity({ "margin-left": "+=100%" }, { duration: 800, easing: "easeOutBack" } );
							$(this).prev().addClass('activeSlide');
							return 'activeSlide';
						}
					})
				}
				if(scrollDownAmount > 5)
				{
						$('.activeSlide').removeClass(function(){
							if($(this).next('.section').length > 0)
							{
								window.location.hash = $(this).next().attr('id');
								scrollDownAmount = 0;
								scrollUpAmount = 0;
								$(this).next().velocity({ "margin-left": "-=100%" }, { duration: 800, easing: "easeInBack" } );
								$(this).next().addClass('activeSlide');
								return 'activeSlide';
							}
						})

				}
			}
		});
		}

	}, 250);

});
