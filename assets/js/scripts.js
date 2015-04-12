$(document).ready(function() {

	// initialize material bootstrap
	$.material.init();

	// init fitText on main forecast text
	$(".forecastContent").fitText(0.9, { minFontSize: '40px'  });

	// make first slide active
	$( ".section:first-of-type" ).addClass( "activeSlide" );

	// array of our slides
	var slideArray = [ "now", "later", "tomorrow", "dayTwo", "dayThree" ];

	// nav buttons
	$( '.slideNav li a' ).click(function() {

		// current and next slide divs
		var	currentSlide = $('#fullpage').find('.activeSlide').attr('id');
		var clickedSlide = $(this).attr('href');

		// determine current and clicked slide
		$.each(slideArray, function( index, value ) {

			// current slide index and id
 			if (value === currentSlide)
 			{
 				currentSlideIndex = index;
 				currentSlideId = value;
 			}

 			// clicked slide index and id
 			if ("#" + value === clickedSlide)
 			{
 				clickedSlideIndex = index;
 				clickedSlideId = value;
 			}
		});

		// if clicked slide is to the right of current slide
		if (clickedSlideIndex > currentSlideIndex)
		{
			// bring in new slide
			$(clickedSlide).velocity({ "margin-left": "0" }, {
				duration: 800,
				easing: "easeInBack",
				complete: function() {
					// when the animation is finished,
					// slide current slide left
					$("#"+currentSlide).css("margin-left", "-100%");
					$("#"+currentSlide).removeClass('activeSlide');
				}
			} );
		}

		// clicked slide is to the left of current slide
		else if (currentSlideIndex > clickedSlideIndex)
		{
			// bring in new slide
			$(clickedSlide).velocity({ "margin-left": "0" }, {
				duration: 800,
				easing: "easeInBack"
			});

			// slide current slide right
			$("#"+currentSlide).velocity({ "margin-left": "+100%" }, { duration: 800, easing: "easeInBack"} ) ;
			$("#"+currentSlide).removeClass('activeSlide');
		}

		// remove other active class from bottom button
		$('.slideNav li a').removeClass('activeButton');

		// make clicked slide button active
		$( 'a[href*="' + clickedSlide + '"]' ).addClass('activeButton');

		// give activeSlide class to clicked slide
		$(clickedSlide).addClass('activeSlide');

	});

	// add stars to night slides
	// and animation divs for weather
	$( ".bgNight" ).append( '<div id="stars"></div><div id="stars3"></div>' );
	$( ".rain" ).append( '<div id="rainDrops"></div><div id="rainDrops2"></div><div id="rainDrops3"></div>' );
	$( ".cloud" ).append( '<div id="cloud1"></div><div id="cloud2"></div><div id="cloud3"></div><div id="cloud6"></div>' );

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
	    if ( didScroll )
	    {
	        didScroll = false;

	        // bind to scroll and swipe events
	        $("html, body").bind({'mousewheel DOMMouseScroll onmousewheel touchmove scroll':
		    function(e)
		    {
		    	// scroll timeout (don't scroll twice too quickly)
				clearTimeout($.data(this, 'scrollTimer'));

				// scroll timeout function
				$.data(this, 'scrollTimer', setTimeout(function()
				{

					if (e.target.id == 'el') return;
					e.preventDefault();
					e.stopPropagation();

					// determine Direction
					// if scroll up
					if (e.originalEvent.wheelDelta && e.originalEvent.wheelDelta >= 0) {
						scrollUpAmount++;

					// else other scroll, swipe up
					} else if (e.originalEvent.detail && e.originalEvent.detail <= 0) {
					   scrollUpAmount++;

					// else scrolled down
					} else {
					    scrollDownAmount++;
					}

					// if we scrolled up
					if(scrollUpAmount > 2)
					{
						$('.activeSlide').removeClass(function(){
							if($(this).prev('.section').length > 0)
							{
								// set location
								window.location.hash = $(this).prev().attr('id');

								// reset scroll counts
								scrollUpAmount = 0;
								scrollDownAmount = 0;

								console.log("this : " + $(this).attr('id'));
								console.log("this prev : " + $(this).prev('.section').attr('id'));
								console.log("this next : " + $(this).next('.section').attr('id'));

								// bring in new slide
								$(this).prev('.section').velocity({ "margin-left": "0" }, {
									duration: 800,
									easing: "easeInBack",
									complete: function() {
										// when the animation is finished,
										// slide current slide left
										$(this).css("margin-left", "+100%");
										$(this).addClass('activeSlide');
									}
								} );

								return 'activeSlide';
							}
						})
					}

					// if scrolled down
					if(scrollDownAmount > 2)
					{
						// remove activeSlide class from current slide
						$('.activeSlide').removeClass(function()
						{
							// if there is another slide to scroll to
							if($(this).next('.section').length > 0)
							{
								// set the location hash
								window.location.hash = $(this).next().attr('id');

								// reset scroll counters
								scrollDownAmount = 0;
								scrollUpAmount = 0;

								// bring in new slide
								$(this).next('.section').velocity({ "margin-left": "0" }, {
									duration: 800,
									easing: "easeInBack",
									complete: function() {
										// when the animation is finished,
										// slide current slide left
										$(this).prev('.section').css("margin-left", "-100%");
										$(this).addClass('activeSlide');
									}
								} );

								return 'activeSlide';
							}
						})

					}

				}, 250));

			}

			});
		}

	}, 250);

});
