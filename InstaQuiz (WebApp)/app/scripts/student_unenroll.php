<?php
    session_start();
    require_once('config.php');
    $userId = $_SESSION['user_id'];
    unset($_SESSION['result_message']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $courseId = $_POST['cid'];
        $sql = "DELETE FROM enrollment WHERE cid = ".$courseId." AND sid = ".$userId;

        if (mysqli_query($conn, $sql)) 
        {
            $_SESSION['result_message'] = "<div class='success-message'>Successfully unenrolled from course. We are sad to see you go!</div>";
            mysqli_close($conn);
            header('Location: ../courses.php');
            exit();
        } 
        else 
        {
            $_SESSION['result_message'] = "<div class='error-message'>Error unenrolling you from course. Please try again:</div>";
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