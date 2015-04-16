<?php
//init
require '../wunderground/Wunderground.php';
require '../functions.php';

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

mapForecastToIcon($weatherForecast->forecast->simpleforecast->forecastday['0']->icon);

//forecast for later
$laterForecast = $weatherForecast->forecast->simpleforecast->forecastday['0'];
//tomorrow's forecast
$tomorrowForecast = $weatherForecast->forecast->simpleforecast->forecastday['1'];
//the day after tomorrow forecast
$dayTwoForecast = $weatherForecast->forecast->simpleforecast->forecastday['2'];
//the day after the day after...
$dayThreeForecast = $weatherForecast->forecast->simpleforecast->forecastday['3'];

//var_dump($laterForecast);

//temperature
$currentTemperature = $weatherCurrent->current_observation->temp_c;

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
		<link rel="stylesheet" href="assets/css/style.css">
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
			  <a class="navbar-brand" href="http://marbellaweather.com/">Marbella Weather</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
			  <ul class="nav navbar-nav">
				<li class="active"><a href="#">Home</a></li>
				<li><a href="#about" data-toggle="modal" data-target="#aboutModal">About</a></li>
			  </ul>
			</div><!--/.nav-collapse -->
		  </div>
		</nav>
		<div id="weather" class="pane">
			<div id="now" class="section <?php if(spainIsDay()) { echo "bgDay"; } else { echo "bgNight"; } ?> <?php echo weatherGeneral($weatherIcon); ?> ">
				<div class="container weatherWrap">
					<div class="row">
						<div class="center-block col-md-8">
							<div class="forecastContent">
								<div class="weatherIcon">
									<i class="wi <?php echo $weatherIcon; ?>"></i>
								</div>
								<div class="weatherCondition">
									<?php echo $weatherCondition; ?>
								</div>
								<div class="currentTemperature">
									<?php echo $currentTemperature . "°C"; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="later" class="section bgNight <?php echo weatherGeneral(mapForecastToIcon($laterForecast->icon)); ?>">
				<div class="container weatherWrap">
					<div class="center-block col-md-8">
							<div class="forecastContent">
								<?php outputForecast($laterForecast, $night = true); ?>
							</div>
					</div>
				</div>
				<div class="timeLabel">Later</div>
			</div>
			<div id="tomorrow" class="section <?php echo weatherGeneral(mapForecastToIcon($tomorrowForecast->icon)); ?>">
				<div class="container weatherWrap">
					<div class="center-block col-md-8">
						<div class="forecastContent">
								<?php outputForecast($tomorrowForecast); ?>
						</div>
					</div>
				</div>
				<div class="timeLabel">Tomorrow</div>
			</div>
			<div id="dayTwo" class="section <?php echo weatherGeneral(mapForecastToIcon($dayTwoForecast->icon)); ?>" style="background-color:#666;">
				<div class="container weatherWrap">
					<div class="center-block col-md-8">
						<div class="forecastContent">
							<?php outputForecast($dayTwoForecast); ?>
						</div>
					</div>
				</div>
				<div class="timeLabel"><?php echo $dayTwoForecast->date->weekday; ?></div>
			</div>
			<div id="dayThree" class="section <?php echo weatherGeneral(mapForecastToIcon($dayThreeForecast->icon)); ?>" style="background-color:#888;">
				<div class="container weatherWrap">
					<div class="center-block col-md-8">
						<div class="forecastContent">
							<?php outputForecast($dayThreeForecast); ?>
						</div>
					</div>
				</div>
				<div class="timeLabel"><?php echo $dayThreeForecast->date->weekday; ?></div>
			</div>
			<footer class="footer">
				<div class="nav">
					<ul class="slideNav center-block">
						<li><a href="#now" class="btn btn-default">Now</a></li>
						<li><a href="#later" class="btn btn-default">later</a></li>
						<li><a href="#tomorrow" class="btn btn-default">tomorrow</a></li>
						<li><a href="#dayTwo" class="btn btn-default"><?php echo $dayTwoForecast->date->weekday; ?></a></li>
						<li><a href="#dayThree" class="btn btn-default"><?php echo $dayThreeForecast->date->weekday; ?></a></li>
					</ul>
				</div>
			</footer>
		</div>
	</div>
	<div id="aboutModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
					<h1>About Marbella Weather</h1>
				</div>
				<div class="modal-body">
					<h3>Modal Body</h3>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<script src="assets/js/scripts.js"></script>
    </body>
</html>