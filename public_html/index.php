<?php

require '../vendor/autoload.php';
require '../wunderground/Wunderground.php';

$weather = new Wunderground("bdff1e0a39d8035f", "en");

// cache dir
$weather->setCacheDir(getcwd() . '/cache/');
$weather->setCacheExpiry(200);

$city = "Estepona";
$country = "Spain";

// get current weather
$weatherCurrent = $weather->getCurrentWeather($city, $country);

// get forecast
$weatherForecast = $weather->getForecast($city, $country);

//var_dump($weatherCurrent);
//var_dump($weatherForecast);

//temperature
$temp = $weatherCurrent->current_observation->temp_c;

//weather condition, clear, cloudy e.t.c.
$weatherCondition = $weatherCurrent->current_observation->weather;

switch ($weatherCondition) {
    case "clear":
        $weatherIcon = "wi-day-sunny";
        break;
    case "Partly Cloudy":
        $weatherIcon = "wi-day-sunny-overcast";
        break;
	default:
		$weatherIcon = "wi-day-cloudy";
}

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="/assets/css/style.css">

        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
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
