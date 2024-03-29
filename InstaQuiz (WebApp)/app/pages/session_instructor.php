<?php

session_start();

if (!isset($_GET['cid'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

$questionResult = '';
$cid = $_GET['cid'];

include "../scripts/config.php";
$sql = "SELECT qid, prompt, a, b, c, d, answer, live FROM questions WHERE cid = ".$cid;
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc())  
    {
        $colorA = '';
        $colorB = '';
        $colorC = '';
        $colorD = '';
        switch ($row['answer']) 
        {
            case 'A':
                $colorA = 'answer';
                break;
            case 'B':
                $colorB = 'answer';
                break;
            case 'C':
                $colorC = 'answer';
                break;
            case 'D':
                $colorD = 'answer';
                break;
        }

        if ($row['live'] == 1) 
        { 
            $questionResult .= "
            <div class='question-item question-active'>
                <h2>{$row['prompt']}</h2>
                <h2 class='$colorA'>A: {$row['a']}</h2>
                <h2 class='$colorB'>B: {$row['b']}</h2>
                <h2 class='$colorC'>C: {$row['c']}</h2>
                <h2 class='$colorD'>D: {$row['d']}</h2>
                <form action='../scripts/end_question.php' method='POST'>
                    <input type='hidden' name='qid' value='{$row['qid']}'>
                    <button class='bad-button' type='submit'>End Question</button>
                </form>
            </div>";
        } 
        else 
        {
            $questionResult .= "
            <div class='question-item'>
                <h2>{$row['prompt']}</h2>
                <h2 class='$colorA'>A: {$row['a']}</h2>
                <h2 class='$colorB'>B: {$row['b']}</h2>
                <h2 class='$colorC'>C: {$row['c']}</h2>
                <h2 class='$colorD'>D: {$row['d']}</h2>
                <form action='../scripts/ask_question.php' method='POST'>
                    <input type='hidden' name='qid' value='{$row['qid']}'>
                    <button class='good-button' type='submit'>Ask Question</button>
                </form>
            </div>";
        }
    }
} else {
    $questionResult .= "
    <div class='error-message'>
    You have not entered any questions for this course!<br>
    <div class='success-message'>
    You can enter questions to use in a live session under course options.
    </div>
    </div>";
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>InstaQuiz</title>
    <link rel="stylesheet" href="../css/body.css">
    <link rel="stylesheet" href="../css/pages_twoColumns.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <style>
        .question-item {
            width: 70%;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 1em;
            padding: .5em;
            border: 5px solid #061A2D;
            background-color: #05386B;
            border-radius: 15px;
        }
        .question-active {
            background-color: #267334;
        }
        .question-item h2 {
            margin-bottom: .5em;
        }
        .question-item p {
            margin: 0;
        }
        .question-item button {
            margin-top: .5em;
        }

        #end-container {
            width: 50%;
            margin-top: 2em;
            margin-left: auto;
            margin-right: auto;
            padding: 1em;
            height: auto;
            background-color: #07223E;
            border-radius: 15px;
            border: 5px solid #061A2D;
        }
        #end-container button {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .answer
        {
            color: green;
        }
    </style>
</head>
<body>
    <?php include_once('../header.php'); ?>
    <div class='container-page'>
        <div class='container-left-header'>
            <h1>Ask question:</h1>
        </div>
        <div class='container-right-header'>
        <h1>Previous Question Results:</h1>
        </div>
        <div class='container-left-body'>
            <?php 
                echo $questionResult; 
                if (isset($_SESSION['result_message'])) 
                {
                    echo $_SESSION['result_message'];
                    unset($_SESSION['result_message']);
                } 
                echo $editResult; 
            ?>
        </div>
        <div class='container-right-body'>
            <?php include "../scripts/question_chart_instructor.php"; ?>
        </div>

    </div>
    <div id='end-container'>
        <form action='../scripts/end_class.php' method='POST'>
            <?php echo "<input type='hidden' name='cid' value='{$cid}'>"; ?>
            <button type='submit' class='bad-button'>End Class</button>
        </form>
    </div>
    
</body>
</html>