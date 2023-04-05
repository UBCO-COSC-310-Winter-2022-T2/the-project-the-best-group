<?php
    session_start();
    require_once('config.php');
    $userId = (int)$_SESSION['user_id'];
    unset($_SESSION['result_message']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $cid = (int)$_POST['cid'];
        $sql = "DELETE FROM courses WHERE cid = ? AND Iid = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $cid, $userId);

        if (mysqli_stmt_execute($stmt)) 
        {
            $_SESSION['result_message'] = "<div class='success-message'>Successfully deleted your course!</div>";
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header('Location: ../courses.php');
            exit();
        } 
        else 
        {
            $_SESSION['result_message'] = "<div class='error-message'>Error deleting your course. Please try again:</div>";
            mysqli_stmt_close($stmt);
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