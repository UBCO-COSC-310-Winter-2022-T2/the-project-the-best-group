<?php
    session_start();
    
    if (!isset($_GET['cid'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
    $cid = $_GET['cid'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>InstaQuiz</title>
    <link rel="stylesheet" href="../css/body.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src='../scripts/get_active_question.js'></script>
    <style>
        #question-container {
            margin-top: 2em;
            margin-left: auto;
            margin-right: auto;
            padding: 1em;
            width: 80%;
            background-color: #07223E;
            border-radius: 15px;
            border: 5px solid #061A2D;
            text-align: center;
        }
        .question-item {
            width: 70%;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 1em;
            padding: 1em;
            border: 5px solid #061A2D;
            background-color: #05386B;
            border-radius: 15px;
        }
        .question-item h2 {
            text-shadow: 0px 5px 5px rgba(0, 0, 0, 0.6); 
            margin-bottom: 1em;
        }
        .question-item p {
            width: 60%;
            margin-left: auto;
            margin-right: auto;
            text-align: left;
            padding: .5em;
            border: 1px solid white;
        }
        .question-item button {
            margin: 1em;
        }
        .chart-container {
            width: 400px;
            height: 200px;
            background-color: #07223E;
            border-radius: 15px;
            border: 5px solid #061A2D;
            margin-top: 2em;
            margin-left: auto;
            margin-right: auto;
            padding: 1em 1em 5em 1em;
            text-align: center;
        }
        #end-container {
            margin-top: 2em;
            margin-left: auto;
            margin-right: auto;
            padding: 1em;
            width: 80%;
            background-color: #07223E;
            border-radius: 15px;
            border: 5px solid #061A2D;
        }
        #end-container button {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

    </style>
</head>
<body>
    <?php include_once('../header.php'); ?>
    <div id='question-container'>
        
    </div>
    <div class='chart-container'>
        <h3>Previous Question Results:</h3>
        <canvas id='result-bar-chart'></canvas>
    </div>
    <div id='end-container'>
        // leave class button
    </div>
</body>
</html>