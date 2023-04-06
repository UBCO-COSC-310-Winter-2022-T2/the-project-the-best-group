<?php
    session_start();
    require_once('../scripts/config.php');
    unset($_SESSION['result_message_0']);
    unset($_SESSION['result_message_1']);

    if($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        // Retrieve user's credentials from the POST request
        $permission = $_POST['permission'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Insert user's information into the account table
        $sql = "INSERT INTO accounts (permission, fname, lname, email, password) VALUES ({$permission}, '{$fname}', '{$lname}', '{$email}', '{$hash}');
                SELECT rtoken FROM accounts WHERE fname = '$fname' AND lname = '$lname' AND email = '$email' AND password = '$hash'";
        $result = mysqli_multi_query($conn, $sql);

        if ($result) 
        {
            //store rtoken
            mysqli_next_result($conn);
            $second_result = mysqli_use_result($conn);

            // Display a success message if user was added to the account table
            $_SESSION['result_message_0'] = '<div class="success-message">Account created successfully.</div>';
            if ($second_result) 
            {
                $row = mysqli_fetch_assoc($second_result);
                $rtoken = $row["rtoken"];
                $_SESSION['result_message_1'] = "<h3>Here is your Recovery Token!</h3><h3>Keep it written down in case you forget your password:</h3><h3>$rtoken</h3>";
            }
            else
            {
                $_SESSION['result_message_1'] = '<div class="error-message">Sorry, error occurred while creating recovery token.</div>';
            }
        } 
        else 
        {
            // Display an error message if there was an error adding user to the account table
            $_SESSION['result_message_0'] = '<div class="error-message">Error creating account.</div>';
        }
        mysqli_close($conn);
        header("Location: ../pages/register.php");
    }
?>