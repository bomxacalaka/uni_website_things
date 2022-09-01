<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <p id=a></p>

    <script>
        fetch(API LINK)
            //http://api.openweathermap.org/geo/1.0/direct?q={city name},{state code},{country code}&limit=100&appid=API KEY
            // Convert response string to json object
            .then(response => response.json())
            .then(response => {

                // Display whole API response in browser console (take a look at it!)
                //console.log(response.feels_like);

                // Copy one element of response to our HTML paragraph
                document.getElementById("a").innerHTML = response;

            })
            .catch(err => {

                // Display errors in console
                console.log(err);
            });
    </script>

</body>

</html>