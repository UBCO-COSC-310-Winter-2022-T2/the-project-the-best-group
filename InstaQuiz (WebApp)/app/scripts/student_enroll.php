<?php
    session_start();
    $userId = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        require_once('config.php');
        $courseId = $_POST['cid'];

        // check student not already enrolled in that course
        $sql_select = "SELECT cid FROM enrollment WHERE cid = ".$courseId." AND sid = ".$userId;
        $result = mysqli_query($conn, $sql_select);

        if (mysqli_num_rows($result) > 0) 
        { 
            // course already exists: exit
            header('Location: ../courses.php?msg=exists');
            exit();
        }

        // add enrollment to database
        $sql_insert = "INSERT INTO enrollment (cid, sid) VALUES (".$courseId.", ".$userId.")";
        if (mysqli_query($conn, $sql_insert)) 
        {
            header('Location: ../courses.php?msg=success');
            exit();
        } 
        else 
        {
            header('Location: ../courses.php?msg=fail');
            exit();
        }
    } 
    else 
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
?>