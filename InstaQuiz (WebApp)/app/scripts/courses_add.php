<?php
    session_start();
    require_once('config.php');
    $userId = (int)$_SESSION['user_id'];
    unset($_SESSION['result_message']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $cname = mysqli_real_escape_string($conn, $_POST["cname"]);
        $sql = "INSERT INTO courses (cname, Iid) VALUES ('$cname', '$userId')";

        if (mysqli_query($conn, $sql)) 
        {
            $_SESSION['result_message'] = "<div class='green-message'>Successfully created the course! Good luck!</div>";
            mysqli_close($conn);
            header('Location: ../courses.php');
            exit();
        } 
        else 
        {
            $_SESSION['result_message'] = "<div class='red-message'>Error creating the course. Please try again:</div>";
            mysqli_close($conn);
            header('Location: ../courses.php');
            exit();
        }
    } 
    else 
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
?>