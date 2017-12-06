<?php
    session_start();
    include_once 'functions-panel.php';
    if (!isset($_SESSION['admin'])) {
        header("Location: login.php");
        die();
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
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="admin-buttons container-fluid">
            <?php getAdminButtons(); ?>
        </div>
        <section id="heading">
            <h1 class="title spaced-bottom text-center">Admin panel</h1>
        </section>        
        <section id="links text-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-7">
                        <a href="edit-slideshow.php" class="btn btn-primary btn-lg btn-block" role="button">Edit slideshow</a>
                        <br>
                        <a href="edit-events.php" class="btn btn-primary btn-lg btn-block" role="button">Edit events</a>
                        <br>
                        <a href="edit-faqs.php" class="btn btn-primary btn-lg btn-block" role="button">Edit faqs</a>
                        <br>
                        <a href="edit-gallery.php" class="btn btn-primary btn-lg btn-block" role="button">Edit gallery</a>
                    </div>
                </div>
            </div>
        </section>
    </body>
    
    <script src="../Javascript/jquery.min.js"></script>
    <script src="../Javascript/bootstrap.min.js"></script>
    <script src="panel-js.js"></script>
</html>