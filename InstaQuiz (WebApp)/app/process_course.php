<?php

    session_start();

    if ($_SESSION['user_permission'] != 1)
        header('Location: login.php');

    $instructor_id = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        include "config.php";
        $name = $_POST['coursename'];

        // check if course already exists
        $sql = "SELECT cname FROM courses WHERE cname = '".$name."' AND Iid = ".$instructor_id;
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) { 
            // course already exists: exit
            header('Location: createcourse.php?msg=exists');
            exit();
        }

        // 
        $sql_insert = "INSERT INTO course (cname, Iid) VALUES ('".$name."', ".$instructor_id.")";
        if (mysqli_query($conn, $sql_insert)) {
            header('Location: index_instructor.php');
            exit();
        } else {
            header('Location: createcourse.php?msg=fail');
            exit();
        }
    } else {
        header('Location: createcourse.php');
    }
?>