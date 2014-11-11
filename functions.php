<?php
	
	/*
	 * See if it is day or night in the location while ignoring local server time.
	 * 
	 * Returns boolean true if day (between 6am and 8pm), false if night.
	 */
	function spainIsDay() 
	{
	    date_default_timezone_set('Europe/Madrid');
	
	    $time = date('H');
	
	    if ($time >= 6 && $time <= 20) 
	    {
			echo "day";
			return true;
	    }
	    else {
			echo "night";
			return false;
	    }
	}
	
	/*
	 * Take the weather condition from the weather provider and map it to 
	 * an icon in the Weather Icons fontset.
	 * Takes day or night into account, setting the correct icon.
	 * Is basically a horrorshow.
	 * 
	 * Returns the icon CSS class.
	 */
	function mapWeatherToIcon($weatherCondition = "Clear") 
	{
		// Daytime
		if(spainIsDay())
		{
			// Clear / unknown
			if($weatherCondition == "Clear" || $weatherCondition == "Unkown" )
			{
				$weatherIcon = "wi-day-sunny";
			}
			// Sort of cloudy
			elseif($weatherCondition == "Partly Cloudy" || $weatherCondition == "Scattered Clouds")
			{
				$weatherIcon = "wi-day-cloudy";
			}
			// Very cloudy
			elseif($weatherCondition == "Mostly Cloudy" || $weatherCondition == "Overcast")
			{
				$weatherIcon = "wi-cloudy";
			}
			// Lots of rain
			elseif($weatherCondition == "Heavy Rain" || stripos($weatherCondition, 'Rain Mist') !== false)
			{
				$weatherIcon = "wi-rain";
			}
			// Some rain
			elseif($weatherCondition == "Light Rain" || $weatherCondition == "Unknown Precipitation" || stripos($weatherCondition, 'drizzle') !== false || stripos($weatherCondition, 'Rain') )
			{
				$weatherIcon = "wi-rain-mix"; 
			}
			// Storms
			elseif(stripos($weatherCondition, 'Thunderstorm') !== false)
			{
				$weatherIcon = "wi-thunderstorm";
			}
			// Snow or ice
			elseif(stripos($weatherCondition, 'Snow') !== false || stripos($weatherCondition, 'Ice') !== false)
			{
				$weatherIcon = "wi-day-snow";
			}
			// Hail
			elseif(stripos($weatherCondition, 'Hail') !== false)
			{
				$weatherIcon = "wi-hail";
			}
			// Fog
			elseif(stripos($weatherCondition, 'Fog') !== false || stripos($weatherCondition, 'Mist') !== false)
			{
				$weatherIcon = "wi-day-fog";
			}
			// Nondescript
			else 
			{
				$weatherIcon = "wi-day-cloudy";
			}
		}
		// Nightime is better than daytime
		else
		{
			
		}
		
		return $weatherIcon;

	}


?>
