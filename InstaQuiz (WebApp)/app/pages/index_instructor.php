<?php
    session_start();
    $pageTitle = 'Instructor Dashboard';
    require_once('scripts/config.php');
?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="../css/body.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    </style>
    </head>
    <body>
        <?php include_once('header.php'); ?>
        <div class='container'>
            <div class='container-nav-form'>
                <button onclick="window.location.href = '../courses.php';">Courses</button>
            </div>
        </div>
    </body>
</html>

>