<?php
    session_start();
    $pageTitle = 'Forgot Password';
    require_once('../scripts/config.php');

    if($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        // Retrieve user's credentials from the POST request
        $email = $_POST['email'];
        $rtoken = $_POST['rtoken'];
        $newpassword = $_POST['newpassword'];

        // Retrieve user's information from the account table
        $sql = "SELECT * FROM accounts WHERE email = '$email' AND rtoken = '$rtoken'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        // Check if user's credentials are correct
        if (mysqli_num_rows($result) == 1) 
        {
            $sqlresetpassword = "UPDATE accounts SET password = 'new_password' WHERE email = '$email'";
            $result = mysqli_query($conn,$sqlresetpassword);
            
            //message if password has been successfully reset and error message if not
            if($result)
            {
                echo '<div class="success-message">Password Reset Successfully.</div>';
            }
            else
            {
                echo '<div class-"error-message">Password Reset Unsuccessful.</div>';
            }
        } 
        else 
        {
            // Display an error message if user's credentials are incorrect
            echo '<div class="error-message">Email or Recovery Token Invalid</div>';
        }
        mysqli_close($conn);
    }
    include_once('../header.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Forgot Password | InstaQuiz</title>
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
                background-image: url("https://www.transparenttextures.com/patterns/dark-mosaic.png");
                border-radius: 10px;
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
        <div id="forgot-password-form">
            <form action="forgot_password.php" method="POST">
                <h1>Login to InstaQuiz</h1>
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" required>

                <label for="rtoken"><b>Recovery Token</b></label>
                <input type="text" placeholder="Enter Recovery Token" name="rtoken" required>

                <label for="newpassword"><b>New Password</b></label>
                <input type="password" placeholder="Enter New Password (Max 255 Characters)" name = "newpassword" required>

                <button type="submit">Recover</button>
                <button onclick="window.location.href = '../index.php';">Home</button>
            </form>
        </div>
    </body>
</html>