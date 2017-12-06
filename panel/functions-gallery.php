<?php
    /* INCLUDE CONNECTION */
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Starworks2017/Include/connect.php";
    include_once($path);
    
    /* FAQS EDIT FUNCTIONS */
    function getGalleryEdit(){
        connection();
        global $connect;
        $result = mysqli_query($connect, "SELECT * FROM gallery");
        if (!$result) {
            echo "<script>location.href = 'edit-gallery.php';</script>";
        }
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                populateGalleryDiv($row['id'], $row['title'], $row['cover'], $row['date']);
            }
        }else{
            emptyDiv();
        }

        mysqli_close($connect);
    }
    function populateGalleryDiv($id, $title, $img, $date){
        $img = "../".$img;
        echo "<div id='$id' class='col-6 col-md-3 text-center spaced-bottom'>
                <a href='edit-album.php?edit-album=$id'>
                    <img src='$img' class='img-fluid rounded' />
                </a>
                <p class='page-header'>$title</p>
                <p class='text-muted'>$date</p>
                <a class='btn btn-info editEvent' href='?edit_id=$id'>Edit</a>
                <a class='btn btn-danger removeEvent' href='?delete_id=$id'>Delete</a>
            </div>";
    }
    function getImgNumber() {
        $img = glob("../Images/Albums/*.*");
        return (count($img)) + 1;
    }
    function clickedSave(){
        $err = false;
        $title = $_POST['event_name'];
        $date = $_POST['event_date'];
        $imgFile = $_FILES['event_image']['name'];
        $tmp_dir = $_FILES['event_image']['tmp_name'];

        if (empty($imgFile)) {
            $err = true;
            echo "<script>alert('The image field cannot be empty')</script>";
        } else if (empty($title)) {
            $err = true;
            echo "<script>alert('The title field cannot be empty')</script>";
        } else if (empty($date)) {
            $err = true;
            echo "<script>alert('The date field cannot be empty')</script>";
        } else {
            $upload_dir = '../Images/Albums/';
            $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
            $valid_extensions = array('jpeg', 'jpg', 'png', 'bmp');
            $picName = getImgNumber() . "." . $imgExt;

            if (in_array($imgExt, $valid_extensions)) {
                move_uploaded_file($tmp_dir, $upload_dir . $picName);
            } else {
                $err = true;
                echo "<script>alert('Only JPG, JPEG, PNG & BMP files are allowed')</script>";
            }
        }
        if (!$err) {
            connection();
            global $connect;
            $path = "Images/Albums/";
            $cover = "".$path.$picName;
            $result = mysqli_query($connect, "INSERT INTO gallery (title, cover, date) VALUES ('$title', '$cover', '$date')");

            if (!$result) {
                die(mysql_error());
            }

            mysqli_close($connect);
        }
        echo "<script>window.location.href = window.location.href.split('?')[0];</script>";
    }
    function clickedDelete(){
        $id = $_GET['delete_id'];
        connection();
        global $connect;
        $resultImg = mysqli_query($connect, "SELECT cover FROM gallery WHERE id = '$id'");
        if (!$resultImg) {
            die(mysql_error());
        }
        while ($row = mysqli_fetch_array($resultImg)) {
            $image = $row['cover'];
            unlink("../".$image);
        }

        $resultDelete = mysqli_query($connect, "DELETE FROM gallery WHERE id = '$id'");
        if (!$resultDelete) {
            die(mysql_error());
        }
        
        array_map('unlink', glob("../Images/Photos/$id/*.*"));
        rmdir("../Images/Photos/".$id);

        mysqli_close($connect);
        echo "<script>window.location.href = window.location.href.split('?')[0];</script>";
    }
    function saveChanges(){
        if (!empty($_FILES['event_image']['name'])) {
            saveWithImage($_POST['id'], $_POST['editedTitle'], $_POST['editedDate'], $_FILES['event_image']['name'], $_FILES['event_image']['tmp_name']);
        }else{
            saveWithoutImage($_POST['id'], $_POST['editedTitle'], $_POST['editedDate']);
        }
        echo "<script>window.location.href = window.location.href.split('?')[0];</script>";
    }
    function saveWithImage($id, $title, $date, $imgFile, $tmp_dir){
        $upload_dir = '../Images/Albums/';
        $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
        $valid_extensions = array('jpeg', 'jpg', 'png', 'bmp');

        if (in_array($imgExt, $valid_extensions)) {
            connection();
            global $connect;
            $resultCover = mysqli_query($connect, "SELECT cover FROM gallery WHERE id = '$id'");
            if (!$resultCover) {
                die(mysql_error());
            }
            while ($row = mysqli_fetch_array($resultCover)) {
                $image = $row['cover'];
                unlink("../".$image);
            }
            $picName = getImgNumber() . "." . $imgExt;
            move_uploaded_file($tmp_dir, $upload_dir . $picName);
            $path = "Images/Albums/";
            $cover = "".$path.$picName;
            $result = mysqli_query($connect, "UPDATE gallery SET title = '$title', date = '$date', cover = '$cover' WHERE id = '$id'");
            
            if (!$result) {
                die(mysql_error());
            }

            mysqli_close($connect);
        } else {
            echo "<script>alert('Only JPG, JPEG, PNG & BMP files are allowed')</script>";
        }
    }
    function saveWithoutImage($id, $title, $date){
        connection();
        global $connect;
        $result = mysqli_query($connect, "UPDATE gallery SET title = '$title', date = '$date' WHERE id = '$id'");

        if (!$result) {
            die(mysql_error());
        }

        mysqli_close($connect);
    }
?>