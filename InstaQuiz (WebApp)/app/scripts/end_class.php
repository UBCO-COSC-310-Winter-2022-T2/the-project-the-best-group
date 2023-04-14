<?php
    session_start();
    
    // logged in instructor made request
    if ($_SESSION['user_permission'] != 1) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // POST request
    if ($_SERVER['REQUEST_METHOD'] != 'POST')  {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    require_once('config.php');
    unset($_SESSION['result_message']);

    // set course not live
    $cid = $_POST['cid'];
    $sql = "UPDATE courses SET live = 0 WHERE cid = ".$cid;

    if (mysqli_query($conn, $sql))  {

        // set any open questions not live
        $sql_q = "UPDATE questions SET live = 0 WHERE cid = ".$cid;
        mysqli_query($conn, $sql_q);

        mysqli_close($conn);
        header('Location: ../courses.php');
        exit();
    } else {
        $_SESSION['result_message'] = "<div class='error-message'>Error ending class. Please try again</div>";
        mysqli_close($conn);
        header('Location: ../courses.php');
        exit();
    }
        
?>