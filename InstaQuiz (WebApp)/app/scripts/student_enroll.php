<?php
    session_start();
    require_once('config.php');
    $userId = $_SESSION['user_id'];
    unset($_SESSION['result_message']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $courseId = $_POST['cid'];
        $sql = "INSERT INTO enrollment (cid, sid) VALUES (".$courseId.", ".$userId.")";

        if (mysqli_query($conn, $sql)) 
        {
            $_SESSION['result_message'] = "<div class='success-message'>Successfully enrolled in course! Good luck!</div>";
            mysqli_close($conn);
            header('Location: ../courses.php');
            exit();
        } 
        else 
        {
            $_SESSION['result_message'] = "<div class='error-message'>Error enrolling in course. Please try again:</div>";
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