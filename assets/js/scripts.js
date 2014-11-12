	//init scroll vars
	var scrollUpAmount = 0;
	var scrollDownAmount = 0;

	//make first slide active
	$( ".section:first-of-type" ).addClass( "active" );

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
				$('.active').removeClass(function(){
					if($(this).prev().length > 0)
					{
						scrollUpAmount = 0;
						scrollDownAmount = 0;
						$(this).animate({ "margin-left": "+=100%" }, { duration: 800, easing: "easeOutBack" } );
						$(this).prev().addClass('active');
						return 'active';
					}
				})
			}
			if(scrollDownAmount > 5)
			{
					$('.active').removeClass(function(){
						if($(this).next().length > 0)
						{
							scrollDownAmount = 0;
							scrollUpAmount = 0;
							$(this).next().animate({ "margin-left": "-=100%" }, { duration: 800, easing: "easeInBack" } );
							$(this).next().addClass('active');
							return 'active';
						}
					})

			}
	    }
	});

