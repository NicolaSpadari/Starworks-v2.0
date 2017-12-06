<?php
    /* INCLUDE CONNECTION */
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Starworks2017/Include/connect.php";
    include_once($path);
    global $key;

    /* EDIT GENERIC FUNCTIONS */
    function emptyDiv(){
        echo "<div class='col-10 text-center'>
                <div class='alert alert-warning'>
                    <i class='fa fa-exclamation-circle' aria-hidden='true'></i> No data found
                </div>
             </div>";
    }
    function getAdminButtons(){
        echo "<div class='row justify-content-between'>
                <div class='col'>
                    <a href='logout.php' class='col-12 btn btn-lg btn-outline-primary' role='button'>Logout</a>
                </div>
                <div class='col-7 d-none d-md-block'></div>
                <div class='col'>
                    <a href='panel.php' class='col-12 btn btn-lg btn-outline-primary' role='button'>Home</a>
                </div>
            </div>";
    }
    function login($username, $password) {
        connection();
        global $connect;
        $logged = false;
        
        $result = mysqli_query($connect, "SELECT username, password FROM login");
        if (!$result) {
            die(mysql_error());
        }
        while ($row = mysqli_fetch_array($result)) {
            if ($row['username'] == $username && $row['password'] == $password) {
                $logged = true;
                session_start();
                $_SESSION['admin'] = 1;
            }
        }
        if (!$logged) {
            echo "<script> alert('Incorrect login'); </script>";
        }else{
            header('Location: panel.php');
        }
        
        mysqli_close($connect);
    }
?>