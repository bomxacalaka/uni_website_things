<?php
$citysd = $_GET['city'];

// Connect to database
$mysqli = new mysqli(IP, ID, PASS, DBNAME);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Execute SQL query


$sql = "SELECT *
	FROM `joe mama lol`
	WHERE DIESTADT = N'SÃ£o Paulo'
	ORDER BY DASDATUM DESC limit 1";



$result = $mysqli->query($sql);

// Error ?
if ($result == false) {
    echo ("<h4>SQL error description: " . $mysqli->error . "</h4>");
}

if ($result->num_rows == 0) {
    include('proto_import.php');
    $result = $mysqli->query($sql); // Run query again after import
}


// Get data, convert to JSON and print
$row = $result->fetch_assoc();
print json_encode($row);

// Free result set and close connection
$result->free_result();
$mysqli->close();
