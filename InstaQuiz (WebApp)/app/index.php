<?php
    session_start();
    require_once('scripts/config.php');
    $user_id = $_SESSION['user_id'];
    $user_permission = $_SESSION['user_permission'];

    if($user_permission == "0")
    {
        header('Location: pages/index_student.php');
    }
    else if ($user_permission == "1")
    {
        header('Location: pages/index_instructor.php');
    }
    else
    {
        header('Location: pages/index_default.php');
    }
?>
