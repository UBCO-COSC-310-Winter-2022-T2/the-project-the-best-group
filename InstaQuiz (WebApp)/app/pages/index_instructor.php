<?php
    session_start();
    require_once('scripts/config.php');
    include_once('header.php');
?>

<!DOCTYPE html>
<html>
    <head>
    <title>InstaQuiz Student Dashboard</title>
    <link rel="stylesheet" href="../css/body.css">
    <style>
        button
        {
            font-size: 28px;
            margin-top: 105px;
            margin-bottom: 105px;
        }
        .main-column-form
        {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 15%;
            height: 100%;
            margin-top: 10px;
            margin-left: auto;
            margin-right: auto;
            background-color: #07223E;
            border-radius: 15px;
            border-style: outset;
            border-color: #061A2D;
            border-width: 5px;
            border-radius: 10px;
            border-radius: 15px;
        }
        .main-column
        {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 15%;
            height: 100%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
    </head>
    <body>
        <div class="main-column-form">
            <div class='main-column'>
                <button onclick="window.location.href = '../account.php';">Account</button>
                <button onclick="window.location.href = '../courses.php';">Courses</button>
            </div>
        </div>
    </body>
</html>

>