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
        $hash_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user's information into the account table
        $sql_1 = "INSERT INTO accounts (permission, fname, lname, email, password) VALUES ({$permission}, '{$fname}', '{$lname}', '{$email}', '{$hash_password}');";
        $result = mysqli_query($conn, $sql_1);

        if ($result) 
        {
            //store rtoken
            $sql_2 = "SELECT rtoken FROM accounts WHERE fname = '$fname' AND lname = '$lname' AND email = '$email' AND password = '$hash_password';";
            $second_result = mysqli_query($conn,$sql_2);

            // Display a success message if user was added to the account table
            $_SESSION['result_message_0'] = '<div class="success-message">Account created successfully.</div>';
            if ($second_result) 
            {
                $row = mysqli_fetch_assoc($second_result);
                $rtoken = $row["rtoken"];
                $hash_rtoken = password_hash($rtoken, PASSWORD_DEFAULT);
                $sql_3 = "UPDATE accounts SET rtoken = '$hash_rtoken' WHERE email = '$email'";
                $third_result = mysqli_query($conn,$sql_3);

                if($third_result)
                {
                    $_SESSION['result_message_1'] = "<h3>Here is your Recovery Token!</h3><h3>Keep it written down in case you forget your password:</h3><h3>$rtoken</h3>";
                }
                else
                {
                    $_SESSION['result_message_1'] = '<div class="error-message">Sorry, error occurred while hashing your recovery token.</div>';
                }

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