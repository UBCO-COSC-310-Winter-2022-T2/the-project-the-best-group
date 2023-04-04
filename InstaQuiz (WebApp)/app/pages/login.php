<?php
    session_start();
    $pageTitle = "Login";
    require_once('../scripts/config.php');

    if($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        // Retrieve user's credentials from the POST request
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Retrieve user's information from the account table
        $sql = "SELECT id, permission FROM accounts WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        // Check if user's credentials are correct
        if (mysqli_num_rows($result) == 1) 
        {
            $_SESSION['user_id'] = $row["id"];
            $_SESSION['user_permission'] = $row["permission"];

            header("Location: ../index.php");
            exit;
        } 
        else 
        {
            // Display an error message if user's credentials are incorrect
            echo '<div class="error-message">Invalid email or password.</div>';
        }

        mysqli_close($conn);
    }
    include_once('../header.php');
?>
        
<!DOCTYPE html>
<html>
    <head>
        <title>InstaQuiz Login</title>
        <link rel="stylesheet" href="../css/body.css">
        <style>
            body
            {
                text-align: center;
            }
            #login-form 
            {
                display: block;
                margin-top: 50px;
                margin-left: auto;
                margin-right: auto;
                width: 60%;
                padding: 20px;
                background-color: #07223E;
                border-radius: 15px;
                border-style: solid;
                border-color: #061A2D;
                border-width: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            }
            input[type=text], input[type=password] 
            {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: none;
                border-radius: 5px;
                box-sizing: border-box;
            }
        </style>
    </head>
    <body>
        
        <div id="login-form">
            <form action="login.php" method="POST">
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" required>

                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <button type="submit">Login</button>
                <button class="button" onclick="window.location.href = 'forgot_password.php';">Forgot Password?</button>
                <button class="button" onclick="window.location.href = '../index.php';">Home</button>
            </form>
        </div>
    </body>
</html>
