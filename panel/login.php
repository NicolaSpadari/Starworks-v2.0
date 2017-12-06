<?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Starworks2017/Include/connect.php";
    include_once($path);
    include_once('functions-panel.php');

    if (isset($_REQUEST["sendLogin"])) {
        login($_REQUEST["username"], hash('sha512', $_REQUEST["password"]));
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Panel</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="theme-color" content="#fafafa" />
        <link href="../Images/favicon.png" rel="shortcut icon" type="image/png" sizes="72x72"/>
        <link href="panel-style.css" rel="stylesheet">
        <link href="../CSS/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <section class="login-form">
            <div class="container">
                <form method="post" action="" role="login">
                    <img src="../Images/logo-desktop.png" class="img-responsive"/>
                    <input type="text" name="username" placeholder="Username" required class="form-control input-lg" autofocus autocomplete="off"/>
                    <input type="password" name="password" placeholder="Password" required class="form-control input-lg" autocomplete="off"/>
                    <button type="submit" name="sendLogin" class="btn btn-lg btn-primary btn-block">Login</button>
                </form>
                <br>
                <div class='row'>
                    <a href='../index.php' class='col-12 btn btn-outline-secondary' role='button'>Back to Starworks</a>
                </div>
            </div>
        </section>
    </body>
    <script src="../Javascript/jquery.min.js"></script>
    <script src="../Javascript/bootstrap.min.js"></script>
    <script src="panel-js.js"></script>
</html>