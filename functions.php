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
			return true;
	    }
	    else {
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
			elseif($weatherCondition == "Heavy Rain" || $weatherCondition == "Rain" || stripos($weatherCondition, 'Rain Mist') !== false)
			{
				$weatherIcon = "wi-rain";
			}
			// Some rain
			elseif($weatherCondition == "Light Rain" || $weatherCondition == "Unknown Precipitation" || $weatherCondition == "Chance of Rain" || stripos($weatherCondition, 'drizzle') !== false || stripos($weatherCondition, 'Rain') )
			{
				$weatherIcon = "wi-day-rain-mix";
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
			// Clear / unknown
			if($weatherCondition == "Clear" || $weatherCondition == "Unkown" )
			{
				$weatherIcon = "wi-night-clear";
			}
			// Sort of cloudy
			elseif($weatherCondition == "Partly Cloudy" || $weatherCondition == "Scattered Clouds")
			{
				$weatherIcon = "wi-night-cloudy";
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
				$weatherIcon = "wi-night-alt-rain-mix";
			}
			// Storms
			elseif(stripos($weatherCondition, 'Thunderstorm') !== false)
			{
				$weatherIcon = "wi-night-thunderstorm";
			}
			// Snow or ice
			elseif(stripos($weatherCondition, 'Snow') !== false || stripos($weatherCondition, 'Ice') !== false)
			{
				$weatherIcon = "wi-night-alt-snow";
			}
			// Hail
			elseif(stripos($weatherCondition, 'Hail') !== false)
			{
				$weatherIcon = "wi-night-alt-hail";
			}
			// Fog
			elseif(stripos($weatherCondition, 'Fog') !== false || stripos($weatherCondition, 'Mist') !== false)
			{
				$weatherIcon = "wi-night-fog";
			}
			// Nondescript
			else
			{
				$weatherIcon = "wi-night-cloudy";
			}
		}

		return $weatherIcon;
	}
	/*
	 * Takes the icon name from the weather provider and uses it to map to
	 * the icon from the icon set we are using.
	 *
	 * Returns the destination iconset icon name
	 *
	 */
	function mapForecastToIcon($weatherForecast = '', $night = false)
	{
		if ($night == true) 
		{
			if($weatherForecast == 'clear' || $weatherForecast == 'unknown')
			{
				$weatherIcon = "wi-night-clear";
			}
			elseif($weatherForecast == 'mostlycloudy' || $weatherForecast == 'cloudy' || $weatherForecast == 'partlycloudy' )
			{
				$weatherIcon = 'wi-night-cloudy';
			}
			elseif($weatherForecast == 'chancerain')
			{
				$weatherIcon = 'wi-night-rain-mix';
			}
			elseif($weatherForecast == 'rain')
			{
				$weatherIcon = 'wi-rain';
			}
			elseif($weatherForecast == 'fog' || $weatherForecast == 'hazy')
			{
				$weatherIcon = 'wi-night-fog';
			}
			elseif($weatherForecast == 'tstorms' || $weatherForecast == 'chancetstorms')
			{
				$weatherIcon = 'wi-night-thunderstorm';
			}
			elseif($weatherForecast == 'sleet' || $weatherForecast == 'chancesleet')
			{
				$weatherIcon = 'wi-night-hail';
			}
			elseif($weatherForecast == 'snow' || $weatherForecast == 'chancesnow' || $weatherForecast == 'flurries' || $weatherForecast == 'chanceflurries' )
			{
				$weatherIcon = 'wi-night-snow';
			}
			// Nondescript
			else
			{
				$weatherIcon = "wi-night-cloudy";
			}
		}
		else 
		{
			if($weatherForecast == 'clear' || $weatherForecast == 'sunny' || $weatherForecast == 'unknown')
			{
				$weatherIcon = "wi-day-sunny";
			}
			elseif($weatherForecast == 'mostlysunny')
			{
				$weatherIcon = 'wi-day-sunny-overcast';
			}
			elseif($weatherForecast == 'partlycloudy' || $weatherForecast == 'partlysunny')
			{
				$weatherIcon = 'wi-day-cloudy';
			}
			elseif($weatherForecast == 'mostlycloudy' || $weatherForecast == 'cloudy')
			{
				$weatherIcon = 'wi-cloudy';
			}
			elseif($weatherForecast == 'chancerain')
			{
				$weatherIcon = 'wi-day-rain-mix';
			}
			elseif($weatherForecast == 'rain')
			{
				$weatherIcon = 'wi-rain';
			}
			elseif($weatherForecast == 'fog' || $weatherForecast == 'hazy')
			{
				$weatherIcon = 'wi-day-fog';
			}
			elseif($weatherForecast == 'tstorms' || $weatherForecast == 'chancetstorms')
			{
				$weatherIcon = 'wi-thunderstorm';
			}
			elseif($weatherForecast == 'sleet' || $weatherForecast == 'chancesleet')
			{
				$weatherIcon = 'wi-hail';
			}
			elseif($weatherForecast == 'snow' || $weatherForecast == 'chancesnow' || $weatherForecast == 'flurries' || $weatherForecast == 'chanceflurries' )
			{
				$weatherIcon = 'wi-day-snow';
			}
			// Nondescript
			else
			{
				$weatherIcon = "wi-day-cloudy";
			}
		}

		return $weatherIcon;
	}

	/*
	 * Take a weather condition or forecast and use it
	 * to decide whether to display clouds, rain e.t.c.
	 * returns a CSS class.
	 * Simplified to use the icon generated by condition and forecast functions.
	 */
	function weatherGeneral($weatherIcon)
	{
		if ($weatherIcon === 'wi-cloudy' || $weatherIcon === 'wi-day-cloudy' || $weatherIcon === 'wi-night-cloudy')
		{
			$class = 'cloud';
		}
		elseif ($weatherIcon === 'wi-day-rain-mix' || $weatherIcon === 'wi-rain' ) {
			$class = 'rain';
		}
		else {
			$class = 'clear';
		}

		return $class;
	}

	/*
	 * Takes in a days forecast and returns formatted html to display
	 *
	 * Returns HTML string
	 *
	 */
	function outputForecast($forecast = '', $night = false)
	{
		if (!empty($forecast))
		{
			echo '	<div class="weatherIcon">
						<i class="wi ' . mapForecastToIcon($forecast->icon, $night) . '"></i>
					</div>
					<div class="weatherCondition">
						' .  $forecast->conditions . '
					</div>
					<div class="forecastTemperature">
						' .  $forecast->high->celsius .  '°C / ' . $forecast->low->celsius . '°C
					</div>';
		}
		// no forecast
		else
		{
			echo "No forecast found";
		}
	}


?>
