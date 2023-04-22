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
Index page

<div>
    Store
    <div>
        <form action="/posts" method="post">
            <input type="text" placeholder="value" name="title">
            <input type="submit">
        </form>
        <div>
            <?php
            if (isset($_SESSION['message'])){
                echo  'value is ' . $_SESSION['message'];
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>