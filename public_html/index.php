<?php
//init
require '../vendor/autoload.php';
require '../wunderground/Wunderground.php';
require '../functions.php';

//slim init
$tiempo = new \Slim\Slim(array(
	'debug' => true,
	'log.enabled' => true
));

//weather provider object
$weather = new Wunderground("bdff1e0a39d8035f", "en");

//cache dir
$weather->setCacheDir(getcwd() . '/cache/');
$weather->setCacheExpiry(1000);

//location
$city = "Estepona";
$country = "Spain";

//get current weather
$weatherCurrent = $weather->getCurrentWeather($city, $country);

//get forecast
$weatherForecast = $weather->getForecast($city, $country);

var_dump($weatherForecast->forecast->simpleforecast->forecastday['1']);




//temperature
$temp = $weatherCurrent->current_observation->temp_c;

//weather condition, clear, cloudy e.t.c.
$weatherCondition = $weatherCurrent->current_observation->weather;

//setup 
$weatherIcon = mapWeatherToIcon($weatherCondition);
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Marbella Weather</title>
        <meta name="description" content="Marbella current weather conditions and 3 day forecast">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="/assets/css/style.css">
    </head>
    <body>

	<div id="fullpage">
		<div id="firstSlide" class="section <?php if(spainIsDay()) { echo "bgDay"; } else { echo "bgNight"; } ?>">
			<div class="container">
				<div id="weatherIcon">
					<i class="wi <?php echo $weatherIcon; ?>"></i>
				</div>
				<div>
					<?php echo $weatherCondition; ?>
				</div>
			</div>
		</div>
		<div id="secondSlide" class="section">
			<div class="container">
				<div id="weatherIcon">
					hello
				</div>
			</div>
		</div>
		<div id="thirdSlide" class="section">
			<div class="container">
				<div id="weatherIcon">
					fatty
				</div>
			</div>
		</div>
	</div>
	
	<script src="/assets/js/scripts.js"></script>
    </body>
</html>
