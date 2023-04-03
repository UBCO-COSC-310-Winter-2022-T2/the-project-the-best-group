<?php
    session_start();
    require_once('scripts/config.php');
    include_once('header.php');
?>

<!DOCTYPE html>
<html>
    <head>
    <title>InstaQuiz Instructor Dashboard</title>
    <link rel="stylesheet" href="../css/body.css">
    <style>
        button 
        {
            display: block;
            margin: 0 auto;
            font-size: 2em;
            padding: 20px 40px;
        }
    </style>
    </head>
    <body>
        <button onclick="window.location.href = '../account.php';">Account</button>
        <button onclick="window.location.href = '../courses.php';">Courses</button>
    </body>
</html>
