<?php
    /* INCLUDE CONNECTION */
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Starworks2017/Include/connect.php";
    include_once($path);
    
    /* SLIDESHOW EDIT FUNCTIONS */
    function getThumbnailGallery() {
        connection();
        global $connect;
        $result = mysqli_query($connect, "SELECT * FROM slideshow");
        if (!$result) {
            echo "<script>location.href = 'edit-slideshow.php';</script>";
        }
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                populateImageDiv($row['id'], $row['img'], $row['caption']);
            }
        }else{
            emptyDiv();
        }

        mysqli_close($connect);
    }
    function populateImageDiv($id, $img, $caption){
        echo "<div id='$id' class='col-6 col-md-3 text-center spaced-bottom'>
                <img src='../$img' class='img-fluid rounded' />
                <p class='page-header'>$caption</p>
                <a class='btn btn-info editSlide' href='?edit_id=$id'>Edit</a>
                <a class='btn btn-danger deleteSlide' href='?delete_id=$id'>Delete</a>
             </div>";
    }
    function getImgNumber() {
        $img = glob("../Images/Slideshow/*.*");
        return (count($img)) + 1;
    }
    function clickedSave(){
        $caption = $_POST['caption'];
        $imgFile = $_FILES['slide_image']['name'];
        $tmp_dir = $_FILES['slide_image']['tmp_name'];
        $err = false;

        if (empty($imgFile)) {
            $err = true;
            echo "<script>alert('The image field cannot be empty')</script>";
        } else if (empty($caption)) {
            $err = true;
            echo "<script>alert('The caption text cannot be empty')</script>";
        } else {
            $upload_dir = '../Images/Slideshow/';
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
            $path = "Images/Slideshow/";
            $image = "".$path.$picName;
            $result = mysqli_query($connect, "INSERT INTO slideshow (img, caption) VALUES ('$image', '$caption')");

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
        $resultImg = mysqli_query($connect, "SELECT img FROM slideshow WHERE id = '$id'");
        if (!$resultImg) {
            die(mysql_error());
        }
        while ($row = mysqli_fetch_array($resultImg)) {
            $image = $row['img'];
            unlink("../".$image);
        }

        $resultDelete = mysqli_query($connect, "DELETE FROM slideshow WHERE id = '$id'");
        if (!$resultDelete) {
            die(mysql_error());
        }

        mysqli_close($connect);
        echo "<script>window.location.href = window.location.href.split('?')[0];</script>";
    }
    function saveChanges($id, $caption){
        connection();
        global $connect;

        $result = mysqli_query($connect, "UPDATE slideshow SET caption = '$caption' WHERE id = '$id'");
        if (!$result) {
            die(mysql_error());
        }

        mysqli_close($connect);
        echo "<script>window.location.href = window.location.href.split('?')[0];</script>";
    }    
    
    /* CALL FUNCTION THROUGH AJAX */
    if(isset($_POST['function']) == 'saveChanges'){
        saveChanges($_POST['id'], $_POST['caption']);
    }
?>