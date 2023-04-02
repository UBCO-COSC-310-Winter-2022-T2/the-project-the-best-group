<?php
    session_start();

    if (!isset($_SESSION['user_permission'])) 
    {
        header('Location: ../pages/login.php');
        exit();
    }

    $student_id = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        require_once('config.php');
        $course_id = $_POST['cid'];

        // check student not already enrolled in that course
        $sql_select = "SELECT cid FROM enrollment WHERE cid = ".$course_id." AND sid = ".$student_id;
        $result = mysqli_query($conn, $sql_select);

        if (mysqli_num_rows($result) > 0) 
        { 
            // course already exists: exit
            header('Location: ' . $_SERVER['HTTP_REFERER'] . '?msg=exists');
            exit();
        }

        // add enrollment to database
        $sql_insert = "INSERT INTO enrollment (cid, sid) VALUES (".$course_id.", ".$student_id.")";
        if (mysqli_query($conn, $sql_insert)) 
        {
            header('Location: ' . $_SERVER['HTTP_REFERER'] . '?msg=success');
            exit();
        } 
        else 
        {
            header('Location: ' . $_SERVER['HTTP_REFERER'] . '?msg=fail');
            exit();
        }
    } 
    else 
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
?>