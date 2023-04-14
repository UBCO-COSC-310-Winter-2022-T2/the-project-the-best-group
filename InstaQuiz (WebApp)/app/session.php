<?php
    session_start();
    require_once('scripts/config.php');
    $user_id = $_SESSION['user_id'];
    $user_permission = $_SESSION['user_permission'];

    if (!isset($_GET['cid'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
    $cid = $_GET['cid'];

    if($user_permission == "0")
    {
        header('Location: pages/session_student.php?cid='.$cid);
    }
    else if ($user_permission == "1")
    {
        header('Location: pages/session_instructor.php?cid='.$cid);
    }
?>