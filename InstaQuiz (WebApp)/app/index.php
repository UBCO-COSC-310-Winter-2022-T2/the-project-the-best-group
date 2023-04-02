<?php
    session_start();
    include_once __DIR__ . '/scripts/header.php';
    require_once __DIR__ . '/scripts/config.php';

    $user_id = $_SESSION['user_id'];
    $user_permission = $_SESSION['user_permission'];

    if($user_permission == "0")
    {
        include_once __DIR__ . '/pages/index_student.php';
    }
    else if ($user_permission == "1")
    {
        include_once __DIR__ . '/pages/index_instructor.php';
    }
    else
    {
        include_once __DIR__ . '/pages/index_default.php';
    }
?>
