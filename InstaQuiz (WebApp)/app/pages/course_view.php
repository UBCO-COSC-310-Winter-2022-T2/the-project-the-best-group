<?php
    session_start();

    if (!isset($_GET['cid']) || $_SESSION['user_permission'] != 0) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
    
    $pageTitle = "Course";
    $cid = $_GET['cid'];
    $sid = $_SESSION['user_id']
?>

<!DOCTYPE html>
<html>
<head>
    <title>InstaQuiz</title>
    <link rel="stylesheet" href="../css/pages_twoColumns.css">
    <link rel="stylesheet" href="../css/body.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="../scripts/get_session_active.js"></script>
    <style>
        .hidden {
            display: none;
        }
        #join-container {
            margin-top: 2em;
            margin-left: auto;
            margin-right: auto;
            width: 80%;
            height: auto;
            background-color: #07223E;
            border-radius: 15px;
            border: 5px solid #061A2D;
        }
        #join-button {
            margin: .5em;
        }
    </style>
</head>
<body>
    <?php include_once('../header.php'); ?>
    <div id='join-container' class='hidden'>
        <form action='../scripts/join_class.php' method='POST'>
            <?php echo "<input type='hidden' name='cid' value=".$cid.">"; ?>
            <button id='join-button' class='good-button' type='submit'>Join Session</button>
        <form>
    </div>
    <div class='container-page'>
        <div class='container-left-header'>
            <h1>Attendance:</h1>
        </div>
        <div class='container-right-header'>
            <h1>Grade:</h1>
        </div>
        <div class='container-left-body'>
            <h2>Pie chart here</h2>
        </div>
        <div class='container-right-body'>
            <?php include "../scripts/student_grade_chart.php";?>
        </div>
    </div>
</body>
</html>