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

    // set course as live
    $cid = $_POST['cid'];
    $sql = "UPDATE courses SET live = 1 WHERE cid = ".$cid;

    if (mysqli_query($conn, $sql))  {

        // update sessions held count
        $sql_count = "UPDATE courses SET sessions_held = sessions_held + 1 WHERE cid = ".$cid;
        mysqli_query($conn, $sql_count);

        mysqli_close($conn);
        header('Location: ../session.php?cid='.$cid);
        exit();
    } else {
        $_SESSION['result_message'] = "<div class='error-message'>Error starting class. Please try again</div>";
        mysqli_close($conn);
        header('Location: ../courses.php');
        exit();
    }
        
?>