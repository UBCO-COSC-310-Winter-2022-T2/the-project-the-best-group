<?php
    session_start();
    require_once('scripts/config.php');

    $user_id = $_SESSION['user_id'];
    $user_permission = $_SESSION['user_permission'];

    if($user_permission == "0")
    {
        $pageTitle = "Student Courses";
        include_once('pages/courses_student.php');
    }
    else if ($user_permission == "1")
    {
        $pageTitle = "Instructor Courses";
        include_once('pages/courses_instructor.php');
    }

    include_once('header.php');
?>
