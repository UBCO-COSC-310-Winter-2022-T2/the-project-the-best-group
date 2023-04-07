<?php
    session_start();
    require_once('../scripts/config.php');

    $_SESSION['result-message'] = ''; 


    if($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        // Retrieve user's credentials from the POST request
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Retrieve user's information from the account table
        $sql = "SELECT id, permission, password FROM accounts WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result) == 1 && password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_permission'] = $row['permission'];
            header("Location: ../index.php");
            exit;
        } 
        else 
        {
            // Display an error message if user's credentials are incorrect

            $_SESSION['result-message'] = '<div class="error-message">Invalid email or password.</div><br>';
            header("Location: ../pages/login.php");

        }

        mysqli_close($conn);
    }
?>