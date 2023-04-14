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

    // set any questions set to chart (2) to not active (0)
    $sql = "UPDATE questions SET live = 0 WHERE live=2";
    mysqli_query($conn, $sql);

    // set closed question to chart (2)
    $qid = $_POST['qid'];
    $sql_chart = "UPDATE questions SET live = 2 WHERE qid = ".$qid;
    if (!mysqli_query($conn, $sql_chart))  
        $_SESSION['result_message'] = "<div class='error-message'>Error closing question.</div>";

    mysqli_close($conn);
    header('Location: ../session.php');
    exit();
        
?>