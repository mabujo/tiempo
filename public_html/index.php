<?php

require '../vendor/autoload.php';
require '../wunderground/Wunderground.php';

$weather = new Wunderground("bdff1e0a39d8035f", "en");

// cache dir
$weather->setCacheDir(getcwd() . '/cache/');
$weather->setCacheExpiry(200);

$city = "Malaga";
$country = "Spain";

// get current weather
$weatherCurrent = $weather->getCurrentWeather($city, $country);

// get forecast
$weatherForecast = $weather->getForecast($city, $country);

//var_dump($weatherCurrent);

//temperature
$temp = $weatherCurrent->current_observation->temp_c;

//weather condition, clear, cloudy e.t.c.
$weatherCondition = $weatherCurrent->current_observation->weather;

switch ($weatherCondition) {
    case "clear":
        $weatherIcon = "wi-day-sunny";
        break;
	default:
		$weatherIcon = "wi-day-sunny";
}

?>
<html>
<head>
	<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
	<div class="container">
		
		<div id="weatherIcon">
			<i class="wi <?php echo $weatherIcon; ?>"></i>
		</div>
	</div>
	
<script src="/assets/js/scripts.js"></script>
</body>
</html>

