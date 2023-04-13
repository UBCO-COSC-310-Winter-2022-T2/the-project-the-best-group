<?php
    session_start();
    $pageTitle = 'Student Dashboard';
    require_once('../scripts/config.php');
?>

<!DOCTYPE html>
<html>
    <head>
    <title>InstaQuiz</title>
    <link rel="stylesheet" href="../css/pages_dashboard.css">
    <style>
        img 
        {
            padding: 0px;
            margin: 0px;
            width: 75em;
            height: 150em;
        }
    </style>
    </head>
    <body>
        <?php include_once('../header.php'); ?>
        <div class='container-page'>
            <div class='container-logo'>
                <img src="..\images\instaquiz_logo_colour.png" alt="Instaquiz Logo">
            </div>
            <div class='container-buttons'>
                <div class='container-button-form'>
                    <button class='pink-button' onclick="window.location.href = '../courses.php';">Courses</button>
                </div>
            </div>
        </div>
    </body>
</html>