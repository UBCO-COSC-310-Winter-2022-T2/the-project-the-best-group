<?php
    session_start();
    $pageTitle = "Register";
    require_once('../scripts/config.php');

    if($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        // Retrieve user's credentials from the POST request
        $permission = $_POST['permission'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Insert user's information into the account table
        $sql = "INSERT INTO accounts (permission, fname, lname, email, password) VALUES ({$permission}, '{$fname}', '{$lname}', '{$email}', '{$password}')";
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
        <title>InstaQuiz</title>
        <link rel="stylesheet" href="../css/body.css">
        <style>
            body 
            {
                text-align: center;
            }
            #register-form 
            {
                display: inline-block;
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
        </style>
    </head>
    <body>
        <?php include_once('../header.php'); ?>
        <div id="register-form">
            <form action="register.php" method="POST">
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
                <button onclick="window.location.href = '../index.php';">Home</button>
            </form>
        </div>
    </body>
</html>
