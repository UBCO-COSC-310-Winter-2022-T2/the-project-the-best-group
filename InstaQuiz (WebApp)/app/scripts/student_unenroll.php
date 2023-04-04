<?php
    session_start();
    $userId = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        require_once('config.php');
        $courseId = $_POST['cid'];

        $sql_select = "SELECT cid FROM enrollment WHERE cid = ".$courseId." AND sid = ".$userId;
        $result = mysqli_query($conn, $sql_select);

        if (mysqli_num_rows($result) == 0) 
        { 
            header('Location: ../courses.php?msg=exists');
            exit();
        }

        $sql_delete = "DELETE FROM enrollment WHERE cid = ".$courseId." AND sid = ".$userId;
        if (mysqli_query($conn, $sql_delete)) 
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