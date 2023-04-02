<?php
    session_start();
    include_once 'header.php';
    require_once 'config.php';

    $user_id = $_SESSION['user_id'];
    $user_permission = $_SESSION['user_permission'];

    if($user_permission == "0")
    {
        include_once 'header_student.php';
    }
    else if ($user_permission == "1")
    {
        include_once 'header_instructor.php';
    }
    else
    {
        include_once 'header_default.php';
    }
?>
