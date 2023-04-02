<?php
    session_start();
    include_once('header.php');
    require_once('scripts/config.php');
?>

<!DOCTYPE html>
<html>
    <head>
    <title>InstaQuiz Instructor Dashboard</title>
    <link rel="stylesheet" href="css/body.css">
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
        <p>This is the dashboard for instructors.</p>
        <button onclick="window.location.href = '../account.php';">Account</button>
        <button onclick="window.location.href = '../courses.php';">Courses</button>
    </body>
</html>
