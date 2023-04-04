<?php
    session_start();
    require_once('config.php');
    $userId = $_SESSION['user_id'];
    unset($_SESSION['result_message']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $cid = $_POST['cid'];
        $prompt = $_POST["prompt"];
        $a = $_POST["a"];
        $b = $_POST["b"];
        $c = $_POST["c"];
        $d = $_POST["d"];
        $answer = $_POST["answer"];
        
        $sql = "INSERT INTO questions (cid, prompt, a, b, c, d, answer) VALUES ('$cid', '$prompt', '$a', '$b', '$c', '$d', '$answer')";
        if (mysqli_query($conn, $sql)) 
        {
            $_SESSION['result_message'] = "<div class='success-message'>Question added successfully! Add another:</div>";
            mysqli_close($conn);
            header('Location: ../courses.php');
            exit();
        } 
        else 
        {
            $_SESSION['result_message'] = "<div class='error-message'>Error adding question. Try again:</div>";
            mysqli_close($conn);
            header('Location: ../courses.php');
            exit();
        }
    } 
    else 
    {
        mysqli_close($conn);
        header('Location: ../courses.php');
        exit();
    }
?>