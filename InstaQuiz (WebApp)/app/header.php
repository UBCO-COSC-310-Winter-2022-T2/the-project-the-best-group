<?php
    session_start();
    include_once('header.php');
    require_once('scripts/config.php');

    $user_id = $_SESSION['user_id'];
    $user_permission = $_SESSION['user_permission'];

    if($user_permission == "0")
    {
        include_once('component/header_student.php');
    }
    else if ($user_permission == "1")
    {
        include_once('component/header_instructor.php');
    }
    else
    {
        include_once('component/header_default.php');
    }
?>
