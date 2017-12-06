<?php
    function connection()
    {
        global $connect;
        $dbHost = "localhost";
        $dbName = "starworks";
        $dbUser = "root";
        $dbPass = "";
        $connect = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName, "3306");
        if(!$connect){ 
            die('Connection failed: ' . mysql_error());               
        } 
        mysqli_select_db($connect, $dbName)
            or die("Can't connect to the database.");
    }
?>