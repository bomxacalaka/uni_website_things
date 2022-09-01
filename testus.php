<?php
$citysd = $_GET['city'];
$url2 = 'https://api.openweathermap.org/geo/1.0/direct?limit=10&appid=API KEY&q=' . $citysd;
$countries = array();
$data2 = file_get_contents($url2);
$json2 = json_decode($data2, true);
$coords = '&lat=' . $json2[0]['lat'] . '&lon=' . $json2[0]['lon'];

$searchdata = '';
foreach ($json2 as $a) {
    $searchdata .= $a['name'] . ' ' . $a['state'] . ' ' . $a['country'] . ',';
}

echo $searchdata;
