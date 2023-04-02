<?php
    session_start();
<<<<<<< HEAD
    require_once 'config.php';
=======
    include_once __DIR__ . '/scripts/header.php';
    require_once __DIR__ . '/scripts/config.php';
>>>>>>> e7c0cf58cb454d041fc475df91444c07c27148a8

    $user_id = $_SESSION['user_id'];
    $user_permission = $_SESSION['user_permission'];

    if($user_permission == "0")
    {
<<<<<<< HEAD
        $pageTitle = "Student Dashboard";
        include_once 'index_student.php';
    }
    else if ($user_permission == "1")
    {
        $pageTitle = "Instructor Dashboard";
        include_once 'index_instructor.php';
    }
    else
    {
        $pageTitle = "Welcome Page";
        include_once 'index_default.php';
=======
        include_once __DIR__ . '/pages/index_student.php';
    }
    else if ($user_permission == "1")
    {
        include_once __DIR__ . '/pages/index_instructor.php';
    }
    else
    {
        include_once __DIR__ . '/pages/index_default.php';
>>>>>>> e7c0cf58cb454d041fc475df91444c07c27148a8
    }
    include_once 'header.php';
?>
