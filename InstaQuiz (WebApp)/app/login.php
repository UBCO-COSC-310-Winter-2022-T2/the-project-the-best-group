<?php
    require_once 'config.php';

    if($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        // Retrieve user's credentials from the POST request
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Retrieve user's information from the account table
        $sql = "SELECT * FROM account WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        // Check if user's credentials are correct
        if (mysqli_num_rows($result) == 1) 
        {
            if ($row["permission"] == 1) 
            {
                // Redirect to instructor.php if user has permission value 1
                header("Location: instructor.php");
                exit;
            } 
            else 
            {
                // Redirect to student.php if user has permission value 0
                header("Location: student.php");
                exit;
            }
        } 
        else 
        {
            // Display an error message if user's credentials are incorrect
            echo '<div class="error-message">Invalid email or password.</div>';
        }

        mysqli_close($conn);
    }
    
    include_once 'header.php';
?>
        
<!DOCTYPE html>
<html>
    <head>
        <title>InstaQuiz Login</title>
        <style>
            body 
            {
                color: #CCCCCC;
                background-color: #313357;
                font-family: "monospace";
                text-align: center;
            }
            #login-form
            {
                display: inline-block;
                margin-top: 50px;
                padding: 20px;
                background-color: #07223E;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            }
            input[type=text], input[type=password] 
            {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            button 
            {
                background-color: transparent;
                text-decoration: none;
                border: none;
                border-radius: 5px;
                outline: none;
                cursor: pointer;
                padding: 10px;
                margin: 0;
                font-size: 18px;
                font-weight: bold;
                color: #CCCCCC;
                transition: background-color 0.3s ease;
            }
            button:hover 
            {
                background-color: #313357;
                color: #CCCCCC;
            }
            .error-message
            {
                color: #FF0000;
                font-size: 14px;
                margin-top: 10px;
            }
            .success-message
            {
                color: #00FF00;
                font-size: 14px;
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
        
        <div id="login-form">
            <form action="login.php" method="POST">
                <h1>Login to InstaQuiz</h1>
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" required>

                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <button type="submit">Login</button>
                <button onclick="window.location.href = 'index.php';">Home</button>
            </form>
        </div>
    </body>
</html>
