<?php
    session_start();
    $pageTitle = 'Welcome Page';
    require_once('scripts/config.php');
?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="../css/body.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    </head>
    <body>
        <?php include_once('header.php'); ?>
        <div class='container'>
            <div class='container-nav-form'>
                <button onclick="window.location.href = '../pages/login.php';">Login</button>
            </div>
            <div class='container-nav-form'>
                <button onclick="window.location.href = '../pages/register.php';">Register</button>
            </div>
        </div>
    </body>
</html>