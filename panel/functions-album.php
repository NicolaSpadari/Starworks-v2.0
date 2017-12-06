<?php
    /* INCLUDE CONNECTION */
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Starworks2017/Include/connect.php";
    include_once($path);
    
    /* PHOTOS EDIT FUNCTIONS */
    function getPhotosEdit($idAlbum){
        connection();
        global $connect;
        $result = mysqli_query($connect, "SELECT * FROM photo where albumId = '$idAlbum'");
        if (!$result) {
            echo "<script>location.href = 'edit-album.php?edit-album=$idAlbum';</script>";
        }
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                populatePhotosDiv($idAlbum, $row['id'], $row['link']);
            }
        }else{
            emptyDiv();
        }

        mysqli_close($connect);
    }
    function populatePhotosDiv($idAlbum, $id, $img){
        $img = "../".$img;
        echo "<div id='$id' class='col-6 col-md-3 text-center spaced-bottom'>
                <img src='$img' class='img-fluid rounded' data-action='zoom'/>
                <a class='btn btn-danger removePhoto' href='?delete_id=$id&edit-album=$idAlbum'>Delete</a>
            </div>";
    }
    function getImgNumber() {
        $img = glob("../Images/Albums/*.*");
        return (count($img)) + 1;
    }
    function clickedSave(){
        $err = false;
        $folder = $_SESSION['album'];
        foreach($_FILES['photo_image']['tmp_name'] as $i => $tmp_dir){
            $tmp_dir = $_FILES['photo_image']['tmp_name'][$i];
            $imgFile = $_FILES['photo_image']['name'][$i];
            if (empty($imgFile)) {
                $err = true;
                echo "<script>alert('The image field cannot be empty')</script>";
            }else {
                $upload_dir = '../Images/Photos/' . $folder . '/';
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
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
                $path = "Images/Photos/" . $folder . "/";
                $link = "".$path.$picName;
                $result = mysqli_query($connect, "INSERT INTO photo (albumId, link) VALUES ('$folder', '$link')");

                if (!$result) {
                    die(mysql_error());
                }

                mysqli_close($connect);
            }
        }
    }
    function clickedDelete(){
        $id = $_GET['delete_id'];
        $album = $_SESSION['album'];
        connection();
        global $connect;
        $resultImg = mysqli_query($connect, "SELECT link FROM photo WHERE id = '$id'");
        if (!$resultImg) {
            die(mysql_error());
        }
        while ($row = mysqli_fetch_array($resultImg)) {
            $image = $row['link'];
            unlink("../".$image);
        }

        $resultDelete = mysqli_query($connect, "DELETE FROM photo WHERE id = '$id'");
        if (!$resultDelete) {
            die(mysql_error());
        }
        echo "<script>location.href = 'edit-album.php?album=$album';</script>";
        
        mysqli_close($connect);
    }
?>