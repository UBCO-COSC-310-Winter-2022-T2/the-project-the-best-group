<?php
    session_start();
    require_once('config.php');
    $userId = $_SESSION['user_id'];
    unset($_SESSION['result_message']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $courseId = $_POST['cid'];
        $sql_select = "SELECT cid FROM enrollment WHERE cid = ".$courseId." AND sid = ".$userId;
        $result = mysqli_query($conn, $sql_select);

        if (mysqli_num_rows($result) > 0) 
        { 
            header('Location: ../courses.php');
            exit();
        }

        $sql_insert = "INSERT INTO enrollment (cid, sid) VALUES (".$courseId.", ".$userId.")";
        if (mysqli_query($conn, $sql_insert)) 
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
    }
?>