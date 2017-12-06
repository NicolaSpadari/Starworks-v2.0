<?php
    /* INCLUDE CONNECTION */
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Starworks2017/Include/connect.php";
    include_once($path);
    
    /* FAQS EDIT FUNCTIONS */
    function getFaqsEdit(){
        connection();
        global $connect;
        $result = mysqli_query($connect, "SELECT * FROM faq ORDER BY id DESC");
        if (!$result) {
            echo "<script>location.href = 'edit-faqs.php';</script>";
        }
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                populateFaqDiv($row['id'], $row['question'], $row['answer']);
            }
        }else{
            emptyDiv();
        }

        mysqli_close($connect);
    }
    function populateFaqDiv($id, $question, $answer){
        echo "<div class='col-12 col-md-6 py-2'>";
            echo "<div id='$id' class='mb-1 bordered'>";
                echo "<div class='col-12 bg-dark text-white py-2 px-4 mb-1 faqQuestion'>". 
                        "$question". 
                     "</div>";
                echo "<div class='col-12'><p class='m-0'>$answer</p></div>"; 
                echo "<a class='btn btn-info edit' href='?edit_id=$id'>Edit</a>";  
                echo "<a class='btn btn-danger remove' href='?delete_id=$id'>Delete</a>";  
            echo "</div>";
        echo "</div>";
    }
    function clickedSave(){
        $err = false;
        $question = $_POST['question'];
        $answer = $_POST['answer'];

        if (empty($question)) {
            $err = true;
            echo "<script>alert('The question cannot be empty')</script>";
        } else if (empty($answer)) {
            $err = true;
            echo "<script>alert('The answer cannot be empty')</script>";
        }
        
        if (!$err) {
            connection();
            global $connect;
            $result = mysqli_query($connect, "INSERT INTO faq (answer, question) VALUES ('$answer', '$question')");

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

        $result = mysqli_query($connect, "DELETE FROM faq WHERE id = '$id'");
        if (!$result) {
            die(mysql_error());
        }

        mysqli_close($connect);
        echo "<script>window.location.href = window.location.href.split('?')[0];</script>";
    }
    function saveChanges($id, $question, $answer){
        connection();
        global $connect;

        $result = mysqli_query($connect, "UPDATE faq SET question = '$question', answer = '$answer' WHERE id = '$id'");
        if (!$result) {
            die(mysql_error());
        }

        mysqli_close($connect);
        echo "<script>window.location.href = window.location.href.split('?')[0];</script>";
    }
    
    /* CALL FUNCTION THROUGH AJAX */
    if(isset($_POST['function']) == 'saveChanges'){
        saveChanges($_POST['id'], $_POST['var1'], $_POST['var2']);
    }
?>