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
        
        if(scrollUpAmount > 10)
        {
			$('.active').removeClass(function(){
				scrollUpAmount = 0;
				$(this).animate({ "margin-left": "=100%" }, "slow" );
				$(this).prev().css("margin-left", "=0");
				$(this).prev().addClass('active');
				return 'active';
			})
		}
		if(scrollDownAmount > 10)
		{
			$('.active').removeClass(function(){
				scrollDownAmount = 0;
				$(this).animate({ "margin-left": "-100%" }, "slow" );
				$(this).next().animate({ "margin-left": "=0" }, "slow" );
				$(this).next().addClass('active');
				$(this).next().css("margin-left", "0");
				return 'active';
			})
		}
    }
});
