<?php
$citysd = $_GET['city'];
$citycode = isset($_GET['country']) ? $_GET['country'] : 'GB';

// Connect to database
$mysqli = new mysqli(IP, ID, PASS, DBNAME);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Execute SQL query

$sql = "SELECT *
	FROM weather
    WHERE city = '{$citysd}'
    AND datew >= DATE_SUB(NOW(), INTERVAL 3600 SECOND)
	ORDER BY datew DESC limit 1";

$result = $mysqli->query($sql);

//   '{$_GET['ALTER TABLE weather ADD COLUMN lol VARCHAR(10) AFTER descr;}']}'
//   ';--

if ($result == false) {
    echo ("<h4>SQL error description: " . $mysqli->error . "</h4>");
}
if ($result->num_rows == 0) {
    include('baguette-import.php');
    $result = $mysqli->query($sql);
}


$row = $result->fetch_assoc();
print json_encode($row, JSON_UNESCAPED_SLASHES);
$result->free_result();
$mysqli->close();
