<?php

    session_start();
    if (!isset($_SESSION['user_permission'])) {
        header('Location: pages/login.php');
        exit();
    }

    $student_id = $_SESSION['user_id'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        include __DIR__ . '/../scripts/config.php';
        $course_id = $_POST['cid'];

        // check student not already enrolled in that course
        $sql_select = "SELECT cid FROM enrollment WHERE cid = ".$course_id." AND sid = ".$student_id;
        $result = mysqli_query($conn, $sql_select);
        if (mysqli_num_rows($result) == 0) { 
            // course not found: redirect to courses
            header('Location: ../courses.php');
            exit();
        }

        // delete student and course from enrollment table
        $sql_delete = "DELETE FROM enrollment WHERE cid = ".$course_id." AND sid = ".$student_id;
        if (mysqli_query($conn, $sql_delete)) {
            header('Location: ../courses.php');
            exit();
        } else {
            // if error running query return to refering page
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
?>