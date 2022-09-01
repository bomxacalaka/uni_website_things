<?php

$citysd = $_GET['city'];
//$citycode = isset($_GET['country']) ? $_GET['country'] : 'GB';
if (!empty($_GET['country'])) {
    $country = $_GET['country'];
    $url2 = 'https://api.openweathermap.org/geo/1.0/direct?limit=10&appid=API KEY&q=' . $citysd . ',' . $country;
} else {
    $url2 = 'https://api.openweathermap.org/geo/1.0/direct?limit=10&appid=API KEY&q=' . $citysd;
}
$data2 = file_get_contents($url2);
$json2 = json_decode($data2, true);
$coords = '&lat=' . $json2[0]['lat'] . '&lon=' . $json2[0]['lon'];


//header("refresh: 1");

//$htmlSection = "its raining baguettes";

$url = 'https://api.openweathermap.org/data/2.5/weather?appid=API KEY&units=metric' . $coords;

// Get data from openweathermap and store in JSON object
$data = file_get_contents($url);
$json = json_decode($data, true);

// Fetch required fields
$desc = $json['weather'][0]['description'];
$temp = $json['main']['temp'];

$date = date("Y-m-d H:i:s"); // now
$city = $json['name']; // name of city   

$cityName = $json['name'];
$feels = $json['main']['feels_like'];

$country = $json['sys']['country'];
$icon  = $json['weather'][0]['icon'];
$minT = $json['main']['temp_min'];

$maxT = $json['main']['temp_max'];
$pressure = $json['main']['pressure'];
$humidity = $json['main']['humidity'];

$windS = $json['wind']['speed'];
$windD = $json['wind']['deg'];

$nospacecity = str_replace(' ', '_', $citysd);

/*
$html = file_get_contents('https://en.wikipedia.org/wiki/' . $nospacecity);
$start = stripos($html, '<p>');
$end = stripos($html, '</p>', $offset = $start);
$length = $end - $start;
$htmlSection = substr($html, $start, $length);
$htmlSection = preg_replace('#<a.*?>(.*?)</a>#i', '\1', $htmlSection);
$htmlSection = str_replace("()", '', $htmlSection);
$htmlSection = addslashes($htmlSection);
//s$htmlSection = str_replace(' ', '"', $htmlSection);

echo $htmlSection;
//mysqli_real_escape_string
*/
$htmlSection = "lol";

$html2 = file_get_contents('https://www.google.com/search?tbm=isch&q=' . $nospacecity);
preg_match_all('|<img.*?src=[\'"](.*?)[\'"].*?>|i', $html2, $matches);
$htmlSection2 = $matches[1][1];


// Build INSERT SQL statement
$sql_insert = "INSERT INTO weather (img, meaning, descr, temp, windS, windD, datew, city,country,icon,minT,maxT,pressure,humidity,cityName,feels)
    VALUES('{$htmlSection2}','{$htmlSection}', '{$desc}', {$temp}, {$windS}, {$windD}, '{$date}', '{$city}','{$country}','{$icon}',{$minT},{$maxT},{$pressure},{$humidity},'{$cityName}',{$feels})";

// Run SQL statement and report errors
if (!$mysqli->query($sql_insert)) {
    echo ("<h4>SQL error description: " . $mysqli->error . "</h4>");
}
