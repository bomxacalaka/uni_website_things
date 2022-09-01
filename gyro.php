<?php
//API LINK

$velX = test_input($_GET["velX"]);
$velY = test_input($_GET["velY"]);
$velZ = test_input($_GET["velZ"]);
$gyrX = test_input($_GET["gyrX"]);
$gyrY = test_input($_GET["gyrY"]);
$gyrZ = test_input($_GET["gyrZ"]);
$temp = test_input($_GET["temp"]);

// Connect to database
$mysqli = new mysqli(IP, ID, PASS, DBNAME);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}


$date = date("Y-m-d H:i:s");
$sql_insert = "INSERT INTO gyro (velX,velY,velZ,gyrX,gyrY,gyrZ,temp,timew)
VALUES('{$velX}','{$velY}','{$velZ}','{$gyrX}','{$gyrY}','{$gyrZ}','{$temp}','{$date}')";

if (!$mysqli->query($sql_insert)) {
    echo ("<h4>SQL error description: " . $mysqli->error . "</h4>");
}


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
