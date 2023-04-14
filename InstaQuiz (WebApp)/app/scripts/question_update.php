<?php
    session_start();
    require_once('config.php');
    $userId = $_SESSION['user_id'];
    unset($_SESSION['result_message']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $cid = $_POST['cid'];
        $qid = $_POST['qid'];
        $prompt = mysqli_real_escape_string($conn, $_POST["prompt"]);
        $a = mysqli_real_escape_string($conn, $_POST["a"]);
        $b = mysqli_real_escape_string($conn, $_POST["b"]);
        $c = mysqli_real_escape_string($conn, $_POST["c"]);
        $d = mysqli_real_escape_string($conn, $_POST["d"]);
        $answer = mysqli_real_escape_string($conn, $_POST["answer"]);
        
        $sql = "UPDATE questions SET cid = '$cid', prompt = '$prompt', a = '$a', b = '$b', c = '$c', d = '$d', answer = '$answer' WHERE qid = '$qid'";
        if (mysqli_query($conn, $sql)) 
        {
            $_SESSION['result_message'] = "<div class='green-message'>Question updated successfully!</div>";
            mysqli_close($conn);
            header('Location: ../pages/questions.php');
            exit();
        } 
        else 
        {
            $_SESSION['result_message'] = "<div class='red-message'>Error updating question. Try again:</div>";
            mysqli_close($conn);
            header('Location: ../pages/questions.php');
            exit();
        }
    } 
    else 
    {
        mysqli_close($conn);
        header('Location: ../pages/questions.php');
        exit();
    }
?>