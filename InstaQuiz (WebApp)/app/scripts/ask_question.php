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

    $qid = $_POST['qid'];
    $sql = "UPDATE questions SET live = 1, was_asked = 1 WHERE qid = ".$qid;

    if (!mysqli_query($conn, $sql))  
        $_SESSION['result_message'] = "<div class='error-message'>Error asking question.</div>";

    mysqli_close($conn);
    header('Location: ../session.php');
    exit();

        
?>