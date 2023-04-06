<?php
    session_start();
    require_once('config.php');
    $userId = $_SESSION['user_id'];
    unset($_SESSION['result_message']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $cid = $_POST['cid'];
        $prompt = mysqli_real_escape_string($conn, $_POST["prompt"]);
        $a = mysqli_real_escape_string($conn, $_POST["a"]);
        $b = mysqli_real_escape_string($conn, $_POST["b"]);
        $c = mysqli_real_escape_string($conn, $_POST["c"]);
        $d = mysqli_real_escape_string($conn, $_POST["d"]);
        $answer = mysqli_real_escape_string($conn, $_POST["answer"]);
        
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