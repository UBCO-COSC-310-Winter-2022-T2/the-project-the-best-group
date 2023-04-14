<?php
    session_start();
    
    // logged in student made request
    if ($_SESSION['user_permission'] != 0) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // POST request
    if ($_SERVER['REQUEST_METHOD'] != 'POST')  {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    require_once('config.php');
    unset($_SESSION['result_message']);

    // validate course has live session
    $cid = $_POST['cid'];
    $sql = "SELECT live FROM courses WHERE cid = ".$cid;
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['live'] == 1) {

        // update attendance if not already taken
        if (!$_SESSION['attendance_taken'] = $cid) {
            $sid = $_SESSION['user_id'];
            $sql_attendance = "UPDATE enrollment SET student_attendance = student_attendance + 1 WHERE cid = ".$cid." AND sid = ".$sid;
            mysqli_query($conn, $sql_attendance);
            $_SESSION['attendance_taken'] = $cid;
        }

        mysqli_close($conn);
        header('Location: ../session.php?cid='.$cid);
        exit();
    } else {
        $_SESSION['result_message'] = "<div class='error-message'>Class does not have live session active.</div>";
        mysqli_close($conn);
        header('Location: ../courses.php');
        exit();
    }

?>