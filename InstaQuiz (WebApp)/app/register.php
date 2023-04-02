<?php
    session_start();
    include_once 'header.php';
    require_once 'config.php';

    if($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        // Retrieve user's credentials from the POST request
        $permission = $_POST['permission'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Insert user's information into the account table
        $sql = "INSERT INTO account (permission, fname, lname, email, password) VALUES ({$permission}, '{$fname}', '{$lname}', '{$email}', '{$password}')";
        $result = mysqli_query($conn, $sql);

        if ($result) 
        {
            // Display a success message if user was added to the account table
            echo '<div class="success-message">Account created successfully.</div>';
        } 
        else 
        {
            // Display an error message if there was an error adding user to the account table
            echo '<div class="error-message">Error creating account.</div>';
        }

        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>InstaQuiz Registration</title>
        <style>
            body 
            {
                color: #CCCCCC;
                background-color: #05386B;
                background-image: url("https://www.transparenttextures.com/patterns/dark-mosaic.png");
                font-family: "cambria", serif;
                text-align: center;
                text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.6);
            }
            #register-form
            {
                display: inline-block;
                margin-top: 50px;
                padding: 20px;
                background-color: #07223E;
                background-image: url("https://www.transparenttextures.com/patterns/dark-mosaic.png");
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            }
            input[type=text], input[type=password], select 
            {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: none;
                border-radius: 5px;
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
                background-color: #F64C72;
                color: #CCCCCC;
            }
            .error-message
            {
                color: #FF0000;
                font-size: 18px;
                margin-top: 10px;
            }
            .success-message
            {
                color: #00FF00;
                font-size: 18px;
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
        <div id="register-form">
            <form action="register.php" method="POST">
                <h1>Register for InstaQuiz</h1>

                <label for="permission"><b>Permissions</b></label>
                <select name="permission">
                    <option value="" selected disabled>Select Permission Level (Student or Instructor)</option>
                    <option value="0">Student (Can enroll in classes and provide responses to questions.)</option>
                    <option value="1">Instructor (Can create/manage classes and provide questions to their students.)</option>
                </select>

                <label for="fname"><b>First Name</b></label>
                <input type="text" placeholder="Enter First Name (Max 255 Characters)" name="fname" required>

                <label for="lname"><b>Last Name</b></label>
                <input type="text" placeholder="Enter Last Name (Max 255 Characters)" name="lname" required>

                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email (Max 255 Characters)" name="email" required>

                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password (Max 255 Characters)" name="password" required>

                <button type="submit">Register</button>
                <button onclick="window.location.href = 'index.php';">Home</button>
            </form>
        </div>
    </body>
</html>
