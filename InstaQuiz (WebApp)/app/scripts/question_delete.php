<?php
    session_start();
    require_once('config.php');
    $userId = $_SESSION['user_id'];
    unset($_SESSION['result_message']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $qid = $_POST['qid'];
        $sql = "DELETE FROM questions WHERE qid = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $qid);

        if (mysqli_stmt_execute($stmt)) 
        {
            $_SESSION['result_message'] = "<div class='green-message'>Question deleted successfully!</div>";
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header('Location: ../pages/questions.php');
            exit();
        } 
        else 
        {
            $_SESSION['result_message'] = "<div class='red-message'>Error deleting question. Try again:</div>";
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header('Location: ../pages/questions.php');
            exit();
        }
    } 
    else 
    {
        header('Location: ../pages/questions.php');
        exit();
    }
?>