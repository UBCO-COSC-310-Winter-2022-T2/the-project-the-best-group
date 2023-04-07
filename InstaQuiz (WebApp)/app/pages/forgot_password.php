<?php
    session_start();
    $pageTitle = 'Forgot Password';
    echo $_SESSION['result_message'];
    unset($_SESSION['result_message']);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>InstaQuiz</title>
        <link rel="stylesheet" href="../css/body.css">
        <style>
            body
            {
                text-align: center;
            }
            #forgot-password-form 
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
        <div id="forgot-password-form">
            <form action="forgot_password_script.php" method="POST">
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" required>

                <label for="rtoken"><b>Recovery Token</b></label>
                <input type="text" placeholder="Enter Recovery Token" name="rtoken" required>

                <label for="newpassword"><b>New Password</b></label>
                <input type="password" placeholder="Enter New Password (Max 255 Characters)" name = "newpassword" required>

                <button type="submit">Recover</button>
                <button onclick="window.location.href = 'login.php';">Back to Login</button>
            </form>
        </div>
    </body>
</html>