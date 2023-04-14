<?php
    session_start();
    $pageTitle = "Login";
?>
        
<!DOCTYPE html>
<html>
    <head>
        <title>InstaQuiz</title>
        <link rel="icon" type="image/png" href="../images/instaquiz_favicon.png">
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
        <?php include_once('../header.php'); ?>
        <div id="login-form">
            <?php 
                echo $_SESSION['result-message']; 
                unset($_SESSION['result-message']);
            ?>
            <form action="../scripts/login_script.php" method="POST">
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
