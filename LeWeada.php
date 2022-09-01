<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <input type="text" id=sb>
    <p id=a></p>

    <script>
        const searchBar = document.getElementById("sb");
        searchBar.addEventListener("keyup", (e) => {
            search = e.target.value;
            fetch(
                API LINK + search


            ).then((response) => {
                document.getElementById("a").innerHTML =
                    response.body.text();
            });
        });
    </script>
</body>

</html>