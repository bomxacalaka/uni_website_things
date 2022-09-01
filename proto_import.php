<?php

$url = 'https://api.openweathermap.org/data/2.5/weather?q=' . $_GET['city'] . '&appid=API KEY&units=metric';

// Get data from openweathermap and store in JSON object
$data = file_get_contents($url);
$json = json_decode($data, true);
function clean($string)
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
// Fetch required fields
$weather_description = $json['weather'][0]['description'];
$weather_temperature = $json['main']['temp'];
$weather_wind = $json['wind']['speed'];
$datew = date("Y-m-d H:i:s"); // now
$city = $json['name']; // name of city     
// Build INSERT SQL statement
$sql_insert = "INSERT INTO `joe mama lol` (LEWETTA, DIEGRAD, DIEWIND, DASDATUM, DIESTADT)
    VALUES('{$weather_description}', {$weather_temperature}, {$weather_wind}, '{$datew}', '{$city}')";

// Run SQL statement and report errors
if (!$mysqli->query($sql_insert)) {
    echo ("<h4>SQL error description: " . $mysqli->error . "</h4>");
}
