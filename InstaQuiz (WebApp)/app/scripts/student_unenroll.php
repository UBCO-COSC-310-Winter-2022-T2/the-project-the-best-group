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

        if (mysqli_num_rows($result) == 0) 
        { 
            header('Location: ../courses.php?msg=exists');
            exit();
        }

        $sql_delete = "DELETE FROM enrollment WHERE cid = ".$courseId." AND sid = ".$userId;
        if (mysqli_query($conn, $sql_delete)) 
        {
            $_SESSION['result_message'] = "<div class='success-message'>Successfully unenrolled from course. We are sad to see you go!</div>";
            mysqli_close($conn);
            header('Location: ../courses.php?msg=success');
            exit();
        } 
        else 
        {
            $_SESSION['result_message'] = "<div class='error-message'>Error unenrolling you from course. Please try again:</div>";
            mysqli_close($conn);
            header('Location: ../courses.php?msg=fail');
            exit();
        }
    } 
    else 
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
?>