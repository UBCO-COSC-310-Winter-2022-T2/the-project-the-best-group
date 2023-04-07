<?php
    session_start();
    require_once('../scripts/config.php');
    unset($_SESSION['result_message']);

    if($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        // Retrieve user's credentials from the POST request
        $email = $_POST['email'];
        $rtoken = $_POST['rtoken'];
        $newpassword = $_POST['newpassword'];
        $hash = password_hash($newpassword,PASSWORD_DEFAULT);

        // Retrieve user's information from the account table
        $sql = "SELECT * FROM accounts WHERE email = '$email' AND rtoken = '$rtoken'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        // Check if user's credentials are correct
        if (mysqli_num_rows($result) == 1) 
        {
            $sqlresetpassword = "UPDATE accounts SET password = '$hash' WHERE email = '$email'";
            $result = mysqli_query($conn,$sqlresetpassword);

            //message if password has been successfully reset and error message if not
            if($result)
            {
                $_SESSION['result_message'] = '<div class="success-message">Password Reset Successfully.</div>';
            }
            else
            {
                $_SESSION['result_message'] = '<div class-"error-message">Password Reset Unsuccessful.</div>';
            }
        } 
        else 
        {
            // Display an error message if user's credentials are incorrect
            $_SESSION['result_message'] = '<div class="error-message">Email or Recovery Token Invalid</div>';
        }
        mysqli_close($conn);
        header("Location: ../pages/forgot_password.php");
    }
?>