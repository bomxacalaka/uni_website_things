<?php

$citysd = $_GET['city'];

/*if country is empty we grab all the possible cities with $citysd and return all the 
countries possible with that city name.
This isnt needed for the website I have running on the link but before when I had an
autocomplete I needed this so that it would recommend all possible cities from
the planet on a dropdown.
*/
if (empty($_GET['country'])) {

    $url2 = API LINK . $citysd;

    $data2 = file_get_contents($url2);
    $json2 = json_decode($data2, true);
    $coords = '&lat=' . $json2[0]['lat'] . '&lon=' . $json2[0]['lon'];
    $citycode = $json2[0]['country'];
} else {
    $citycode = $_GET['country'];
    $url2 = API LINK . $citysd . ',' . $citycode;

    $data2 = file_get_contents($url2);
    $json2 = json_decode($data2, true);
    $coords = '&lat=' . $json2[0]['lat'] . '&lon=' . $json2[0]['lon'];
}


//header("refresh: 1");

//$htmlSection = "its raining baguettes";

$url = API LINK . $coords;

// Get data from openweathermap and store in JSON object
$data = file_get_contents($url);
$json = json_decode($data, true);

// Fetch required fields
$desc = $json['weather'][0]['description'];
$temp = $json['main']['temp'];

$date = date("Y-m-d H:i:s"); // now
$city = $citysd; // name of city   
$state = $json2[0]['state'];
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

$searchdata = '';
$search_code = '';
$search_state = '';
foreach ($json2 as $a) {
    $searchdata .= $a['name'] . ' ' . $a['state'] . ' ' . $a['country'] . ',';
    //$searchdata .= $a['name'] . ',';
    //$search_code .= $a['country'] . ',';
    //$search_state .= $a['state'] . ',';
}

//$citysd = ucwords($citysd);

try {
    $nospacecity = str_replace(' ', '_', $cityName);
    $html = file_get_contents('https://en.wikipedia.org/wiki/' . $nospacecity);
    $start = stripos($html, '<p>');
    $end = stripos($html, '</p>', $offset = $start);
    $length = $end - $start;
    $htmlSection = substr($html, $start, $length);
    $htmlSection = preg_replace("#<a.*?>(.*?)</a>#i", '\1', $htmlSection);
    $htmlSection = str_replace("()", '', $htmlSection);
    $htmlSection = strip_tags($htmlSection);
    //$htmlSection = pg_prepare($mysqli, $htmlSection);
    $htmlSection = str_replace("'", '', $htmlSection);

    $html2 = file_get_contents('https://www.google.com/search?tbm=isch&q=' . $nospacecity);
    preg_match_all('|<img.*?src=[\'"](.*?)[\'"].*?>|i', $html2, $matches);
    $htmlSection2 = $matches[1][1];
} catch (Exception $e) {
    $htmlSection = null;
    $htmlSection2 = null;
}





// Build INSERT SQL statement
$sql_insert = "INSERT INTO weather (search_code, search_state, search,img, meaning, descr, temp, windS, windD, datew, city,country,icon,minT,maxT,pressure,humidity,cityName,feels,statee)
    VALUES('{$search_code}','{$search_state}','{$searchdata}','{$htmlSection2}','{$htmlSection}', '{$desc}', {$temp}, {$windS}, {$windD}, '{$date}', '{$city}','{$country}','{$icon}',{$minT},{$maxT},{$pressure},{$humidity},'{$cityName}',{$feels},'{$state}')";

// Run SQL statement and report errors
if (!$mysqli->query($sql_insert)) {
    echo ("<h4>SQL error description: " . $mysqli->error . "</h4>");
}
