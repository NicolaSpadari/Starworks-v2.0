<?php
    session_start();
    include_once 'functions-panel.php';
    include_once 'functions-gallery.php';
    if (!isset($_SESSION['admin'])) {
        header("Location: login.php");
        die();
    }
    
    if (isset($_POST['btnsave'])) {
        clickedSave();
    }
    if (isset($_POST['edit_id'])) {
        clickedEdit();
    }
    if(isset($_GET['delete_id'])){
        clickedDelete();
    }
    if (isset($_POST['saveEvent'])){
        saveChanges();
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
            <h1 class="title text-center">Edit gallery</h1>
            <p class="text-center spaced-bottom">(click on album to edit its photos)</p>
        </section>
        <section id="edit-slideshow">
            <div class="container">
                <form method="post" enctype="multipart/form-data" class="form-horizontal">
                    <table class="table table-bordered table-responsive">   
                        <tr>
                            <td><label class="control-label">Cover</label></td>
                            <td><input class="input-group" type="file" name="event_image" accept="image/*" /></td>
                        </tr>
                        <tr>
                            <td><label class="control-label">Event name</label></td>
                            <td><input class="form-control" type="text" name="event_name" placeholder="Write the name of the event" autocomplete="off" value="<?php $event_name ?>"/></td>
                        </tr>                      
                        <tr>
                            <td><label class="control-label">Date</label></td>
                            <td><input class="form-control" type="date" name="event_date" placeholder="Write the date of the event" autocomplete="off" value="<?php $event_date ?>"/></td>
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
                    <?php getGalleryEdit(); ?>
                </div>
            </div>
        </section>
    </body>

    <script src="../Javascript/jquery.min.js"></script>
    <script src="../Javascript/bootstrap.min.js"></script>
    <script src="panel-js.js"></script>
</html>