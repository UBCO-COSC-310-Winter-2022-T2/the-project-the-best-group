<?php
    session_start();
    require_once('scripts/config.php');

    $user_id = $_SESSION['user_id'];
    $user_permission = $_SESSION['user_permission'];

    if($user_permission == "0")
    {
        $pageTitle = "Student Dashboard";
        include_once('pages/index_student.php');
    }
    else if ($user_permission == "1")
    {
        $pageTitle = "Instructor Dashboard";
        include_once('pages/index_instructor.php');
    }
    else
    {
        $pageTitle = "Welcome Page";
        include_once('pages/index_default.php');
    }
    include_once('header.php');
?>
