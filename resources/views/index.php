<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Index page</h1>
<ul>
    <?php
    if (isset($routes)){
        echo "<h3>Available routes</h3>";
        foreach ($routes as $route){
            echo "<li>
                <ul>
                    <li><p>Route - <b>$route->route</b></p></li>
                    <li>Method - <b>$route->action</b></li>
                    <li>Controller - <b>$route->controller</b></li>
                    <li>Name - <b>$route->name</b></li>
                    <li>Middleware - <b>$route->middleware</b></li>
                </ul>
                <hr>
                </li>";
        }
    }
    ?>
</ul>

</body>
</html>