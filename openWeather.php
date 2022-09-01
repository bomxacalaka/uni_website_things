<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Le Weada</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .bg-1 {
      background: #e9ebee;
      color: #1c1e21;
    }

    .bg-2 {
      background: white;
    }

    .navbar {
      padding-top: 0px;
      padding-bottom: 0px;
      border: 0;
      border-radius: 0;
      margin-bottom: 10;
      font-size: 12px;
      letter-spacing: 8px;
    }
  </style>
</head>

<body class="bg-1">
  <?php
  $colors = array("red", "green", "blue", "yellow");

  foreach ($colors as $value) {
    echo "$value <br>";
  } ?>

  <nav class="navbar navbar-default">
    <div class="container-fluid bg-2">
      <div class="navbar-header">
        <h1 class="navbar-b
        rand" href="#">Weather in Wolverhampton</h1>
      </div>
    </div>
  </nav>
  <p id="geo"></p>
  <p id="temperature"></p>
  <p id="humidity"></p>
  <img id="myImage" src="" style="width: 100px" />
  <script>
    var x = 0;

    var geo = document.getElementById("geo");

    var lat = 0;
    var lng = 0;

    navigator.geolocation.getCurrentPosition(showPosition);

    function showPosition(position) {
      lat = position.coords.latitude;
      lng = position.coords.longitude;
    }
  </script>
</body>

</html>