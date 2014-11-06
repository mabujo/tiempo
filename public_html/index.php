<?php

require '../vendor/autoload.php';
require '../wunderground/Wunderground.php';

$weather = new Wunderground("bdff1e0a39d8035f", $lang);

// cache dir
$weather->setCacheDir(MY_PATH . 'tmp/');
$weather->setCacheExpiry(3600);

$city = "Malaga";
$country = "Spain";

// get current weather
var_dump($weather->getCurrentWeather($city, $country));

// get forecast
$weather->getForecast($city, $country);


?>

