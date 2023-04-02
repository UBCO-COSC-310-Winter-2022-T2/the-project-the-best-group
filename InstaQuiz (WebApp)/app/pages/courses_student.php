<?php
    session_start();
    include_once('header.php');
    require_once('scripts/config.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>InstaQuiz Courses</title>
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
        <p>This is the dashboard for student courses.</p>
        <button onclick="window.location.href = 'pages/courses_enroll.php';">Enroll</button>
    </body>
</html>
