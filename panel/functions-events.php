<?php
    /* INCLUDE CONNECTION */
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Starworks2017/Include/connect.php";
    include_once($path);
    
    /* EVENT EDIT FUNCTIONS */
    function getEventsEdit() {
        connection();
        global $connect;
        $result = mysqli_query($connect, "SELECT * FROM events");
        if (!$result) {
            echo "<script>location.href = 'edit-events.php';</script>";
        }
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                populateEventsDiv($row['id'], $row['cover'], $row['title'], $row['date'], $row['time']);
            }
        }else{
            emptyDiv();
        }

        mysqli_close($connect);
    }
    function populateEventsDiv($id, $cover, $title, $date, $time){
        $timeClean = date('g:ia', strtotime($time));
        echo "<div class='col-xs-12 col-md-6 col-lg-4'>
                <div class='event' id='$id'>
                    <h3 class='eventTitle'>$title</h3>
                    <img class='img-fluid img-thumbnail ticketImage' src='../$cover'>
                    <div class='ticketTime'>
                        <p>Date of the event: <b>$date</b><br>Time of the event: <b>$timeClean</b></p>
                    </div>
                    <a class='btn btn-danger deleteEvent' href='?delete_id=$id'>Delete</a>
                </div>
            </div>";
    }
    function getImgNumber() {
        $img = glob("../Images/Events/*.*");
        return (count($img)) + 1;
    }
    function clickedSave(){
        $title = $_POST['event-title'];
        $code = $_POST['event-code'];
        $date = $_POST['event-date'];
        $time = $_POST['event-time'];
        $expiration = $_POST['expiration-date'];
        $imgFile = $_FILES['event-image']['name'];
        $tmp_dir = $_FILES['event-image']['tmp_name'];
        $err = false;

        if (empty($imgFile)) {
            $err = true;
            echo "<script>alert('The image field cannot be empty')</script>";
        } else if (empty($title)) {
            $err = true;
            echo "<script>alert('The title text cannot be empty')</script>";
        } else if (empty($code)) {
            $err = true;
            echo "<script>alert('The code text cannot be empty')</script>";
        } else if (empty($date)) {
            $err = true;
            echo "<script>alert('The date field cannot be empty')</script>";
        } else if (empty($time)) {
            $err = true;
            echo "<script>alert('The time field cannot be empty')</script>";
        } else {
            $upload_dir = '../Images/Events/';
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
            $path = "Images/Events/";
            $image = "".$path.$picName;
            $result = mysqli_query($connect, "INSERT INTO events (code, cover, title, date, time) VALUES ('$code', '$image', '$title', '$date', '$time')");

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
        $resultImg = mysqli_query($connect, "SELECT cover FROM events WHERE id = '$id'");
        if (!$resultImg) {
            die(mysql_error());
        }
        while ($row = mysqli_fetch_array($resultImg)) {
            $image = $row['cover'];
            unlink("../".$image);
        }

        $resultDelete = mysqli_query($connect, "DELETE FROM events WHERE id = '$id'");
        if (!$resultDelete) {
            die(mysql_error());
        }

        mysqli_close($connect);
        echo "<script>window.location.href = window.location.href.split('?')[0];</script>";
    }
?>