<?php
    session_start();
    include_once __DIR__ . '/../scripts/header.php';
    require_once __DIR__ . '/../scripts/config.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>InstaQuiz Homepage</title>
        <style>
            body 
            {
                color: #CCCCCC;
                background-color: #05386B;
                background-image: url("https://www.transparenttextures.com/patterns/dark-mosaic.png");
                font-family: "cambria", serif;
                text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.6);
            }
        </style>
    </head>
    <body>
        <p>This is the dashboard for default users.</p>
    </body>
</html>
