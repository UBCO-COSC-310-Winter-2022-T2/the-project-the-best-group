<?php
    session_start();
    require_once 'config.php';

    $user_id = $_SESSION['user_id'];
    $user_permission = $_SESSION['user_permission'];

    if($user_permission == "0")
    {
        $pageTitle = "Student Account";
        include_once 'account_student.php';
    }
    else if ($user_permission == "1")
    {
        $pageTitle = "Instructor Account";
        include_once 'account_instructor.php';
    }

    include_once 'header.php';
?>
