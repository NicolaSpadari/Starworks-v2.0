<?php
    session_start();
    include_once 'functions-panel.php';
    include_once 'functions-album.php';
    if (!isset($_SESSION['admin'])) {
        header("Location: login.php");
        die();
    }
    if (count($_GET) === 0) {
        header("Location: edit-gallery.php");
    }
    $_SESSION['album'] = substr($_SERVER['QUERY_STRING'], -1);
    
    if (isset($_POST['btnsave'])) {
        clickedSave();
    }
    if(isset($_GET['delete_id'])){
        clickedDelete();
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
            <h1 class="title text-center spaced-bottom">
                <a class="btn btn-outline-warning btn-back" href="edit-gallery.php" role="button">
                    <i class="fa fa-2x fa-chevron-circle-left" aria-hidden="true" style="vertical-align: middle;"></i> Back
                </a>
                Edit Albums
            </h1>
        </section>
        <section id="edit-slideshow">
            <div class="container">
                <form method="post" enctype="multipart/form-data" class="form-horizontal">
                    <table class="table table-bordered table-responsive">   
                        <tr>
                            <td><label class="control-label">Photo (one or multiple)</label></td>
                            <td><input class="input-group" type="file" name="photo_image[]" accept="image/*" multiple="multiple"/></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button class="btn upload" type="submit" name="btnsave">
                                    <i class="fa fa-upload" aria-hidden="true"></i> Upload
                                </button>
                            </td>
                        </tr>
                    </table>
                </form>
                <div class="row justify-content-md-center text-center">
                    <?php getPhotosEdit($_SESSION['album']);?>
                </div>
            </div>
        </section>
    </body>

    <script src="../Javascript/jquery.min.js"></script>
    <script src="../Javascript/bootstrap.min.js"></script>
    <script src="panel-js.js"></script>
</html>