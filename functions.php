<?php

	function spainIsDay() 
	{
	    date_default_timezone_set('Europe/Madrid');
	
	    $time = date('H');
	
	    if ($time >= 6 && $time <= 20) 
	    {
			return true;
	    }
	    else {
			return false;
	    }
	}
	
	function mapWeatherToIcon() 
	{

	}


?>
