<?php
    session_start();
    require_once('config.php');
    unset($_SESSION['result_message']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $cid = $_POST['cid'];
        $sid = $_POST['sid'];
        $sql = "DELETE FROM enrollment WHERE cid = ".$cid." AND sid = ".$sid;

        if (mysqli_query($conn, $sql)) 
        {
            $_SESSION['result_message'] = "<div class='green-message'>Successfully unenrolled from course. We are sad to see you go!</div>";
            mysqli_close($conn);
            header('Location: ../courses.php');
            exit();
        } 
        else 
        {
            $_SESSION['result_message'] = "<div class='red-message'>Error unenrolling you from course. Please try again:</div>";
            mysqli_close($conn);
            header('Location: ../courses.php');
            exit();
        }
    } 
    else 
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
?>