<?php
    session_start();
    include_once 'header.php';
    require_once 'config.php';

    $user_id = $_SESSION['user_id'];
    $user_permission = $_SESSION['user_permission'];

    if($user_permission == "0")
    {
        include_once 'index_student.php';
    }
    else if ($user_permission == "1")
    {
        include_once 'index_instructor.php';
    }
    else
    {
        include_once 'index_default.php';
    }
?>
