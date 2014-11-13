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

//var_dump($weatherForecast->forecast->simpleforecast->forecastday['1']);

//forecast for later
$laterForecast = $weatherForecast->forecast->simpleforecast->forecastday['0'];
//tomorrow's forecast
$dayOneForecast = $weatherForecast->forecast->simpleforecast->forecastday['1'];
//the day after tomorrow forecast
$dayTwoForecast = $weatherForecast->forecast->simpleforecast->forecastday['2'];
//the day after the day after...
$dayThreeForecast = $weatherForecast->forecast->simpleforecast->forecastday['3'];

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
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		  <div class="container">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="#">Marbella Weather</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
			  <ul class="nav navbar-nav">
				<li class="active"><a href="#">Home</a></li>
				<li><a href="#about">About</a></li>
				<li><a href="#contact">Contact</a></li>
			  </ul>
			</div><!--/.nav-collapse -->
		  </div>
		</nav>
		<div id="now" class="section <?php if(spainIsDay()) { echo "bgDay"; } else { echo "bgNight"; } ?>">
			<div class="container">
				<div class="weatherIcon">
					<i class="wi <?php echo $weatherIcon; ?>"></i>
				</div>
				<div>
					<?php echo $weatherCondition; ?>
				</div>
				<div class="nav">
					<ul class="slideNav">
						<li><a href="#later">later</a></li>
						<li><a href="#tomorrow">tomorrow</a></li>
						            <a href="javascript:void(0)" class="btn btn-default">Default</a>
            <a href="javascript:void(0)" class="btn btn-primary">Primary</a>

					</ul>
				</div>
			</div>
		</div>
		<div id="later" class="section">
			<div class="container">
				<div class="weatherIcon">
					hello
				</div>
			</div>
		</div>
		<div id="tomorrow" class="section">
			<div class="container">
				<div class="weatherIcon">
					fatty
				</div>
			</div>
		</div>
	</div>
	
	<script src="/assets/js/scripts.js"></script>
    </body>
</html>
