<?php
    session_start();
    $pageTitle = "Add Question";
    $userId = $_SESSION['user_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $cid = $_POST['cid'];
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title> Add Question </title>
    <link rel="stylesheet" href="../css/body.css">
    <style>
        label 
        {
            display: flex;
            text-align: left;
            margin-right: 10px;
        }
        input[type="text"]
        {
            display: flex;
            width: 50em;
            height: 1.5em;
            margin-bottom: 10px;
        }
        input[id="prompt"] 
        {
            display: flex;
            width: 44.4em;
            height: 1.5em;
            margin-bottom: 10px;
        }
        select[name="answer"]
        {
            font-family: 'Courier New', Courier, monospace;
            display: flex;
            align-self: center;
            margin-left: 10px;
            width: 20em;
            height: 2em;
        }
        button
        {
            margin-top: 20px;
        }
        h1
        {
            font-size: 28px;
            margin-top: 1em;
            margin-bottom: 1em;
        }
        .container
        {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            justify-items: center;
            align-content: flex-start;
            justify-content: center;
        }
        .question-form
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
        .row-answer
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
        .row-create
        {
            display: flex;
            flex-direction: row;
            justify-self: center;
            align-self: center;
            justify-items: center;
            align-items: center;
            justify-content: center;
            align-content: center;
        }
    </style>
</head>
<body>
    <?php include_once('../header.php'); ?>
    <div class='container'>
        <div class='question-form'>
            <h1>Create a Question</h1>
            <form method="POST" action="../scripts/question_add.php" id="question-form">
                <div class='row-answer'>
                    <label for="prompt">Question:</label>
                    <input type="text" id="prompt" name="prompt"><br>
                </div>
                <div class='row-answer'>
                    <label for="a">A:</label>
                    <input type="text" id="a" name="a">
                </div>
                <div class='row-answer'>
                    <label for="b">B:</label>
                    <input type="text" id="b" name="b">
                </div>
                <div class='row-answer'>
                    <label for="c">C:</label>
                    <input type="text" id="c" name="c">
                </div>
                <div class='row-answer'>
                    <label for="d">D:</label>
                    <input type="text" id="d" name="d">
                </div>
                <div class='row-create'>
                    <select name="answer">
                        <option value='' selected disabled>Declare correct answer...</option>
                        <option value='A'>A</option>
                        <option value='B'>B</option>
                        <option value='C'>C</option>
                        <option value='D'>D</option>
                    </select>
                </div>
                <div class='row-create'>
                    <input type='hidden' name='cid' value='<?= $cid ?>'>
                    <button type='submit'>Create</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>