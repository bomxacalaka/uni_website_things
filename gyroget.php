<?php
$mysqli = new mysqli(IP, ID, PASS, DBNAME);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Execute SQL query

$sql = "SELECT *
	FROM gyro
	ORDER BY timew DESC limit 1";

$result = $mysqli->query($sql);

//   '{$_GET['ALTER TABLE weather ADD COLUMN lol VARCHAR(10) AFTER descr;}']}'


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
