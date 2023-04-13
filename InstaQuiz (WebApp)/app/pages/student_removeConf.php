<?php
    session_start();
    $pageTitle = "Instructor Courses: Remove Student Confirmation";

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $cid = $_POST['cid'];
        $sid = $_POST['sid'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>InstaQuiz</title>
    <link rel="stylesheet" href="../css/body.css">
    <style>
        .container
        {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            justify-items: center;
            align-content: flex-start;
            justify-content: center;
        }
        .container-form
        {
            display: flex;
            flex-direction: column;
            justify-self: flex-start;
            align-self: center;
            justify-items: center;
            align-items: center;
            justify-content: center;
            align-content: center;
            margin-top: 1em;
            padding-bottom: 1em;
            padding-left: 1em;
            padding-right: 1em;
            background-color: #07223E;
            font-size: 18px;
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;
            color: #CCCCCC;
            border-style: solid;
            border-color: #061A2D;
            border-width: 5px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        .container-form-row
        {
            display: flex;
            flex-direction: row;
            justify-self: center;
            align-self: center;
            justify-items: flex-start;
            align-items: center;
            justify-content: flex-start;
            align-content: center;
        }
        h1
        {   
            font-size: 28px;
            color: red;
            margin: 0.3em;
        }
        h2
        {
            font-size: 28px;
            color: green;
            margin: 0.3em;
        }
        .bad-button
        {
            font-size: 28px;
            padding: 1em;
        }
    </style>
</head>
<body>
    <?php include_once('../header.php'); ?>
    <div class='container'>
        <div class='container-form'>
            <div class='container-form-row'>
                <h1>Remove Student <h2><?php echo $fname." ".$lname."?" ?></h2></h1>
            </div>
            <form action='../scripts/student_unenroll.php' method='POST'>
                <input type='hidden' name='cid' value='<?= $cid ?>'>
                <input type='hidden' name='sid' value='<?= $sid ?>'>
                <button class='bad-button' type='submit'>I want to remove this student from my course.</button>
            </form>
            <button onclick="window.location.href = 'students.php';" class='good-button'>I have changed my mind, take me back!</button>
        </div>
    </div>
</body>
</html>