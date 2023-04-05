<?php
    session_start();
    $pageTitle = "Create a Question";
    $userId = $_SESSION['user_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $cid = $_POST['cid'];
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>InstaQuiz</title>
    <link rel="stylesheet" href="../css/body.css">
    <link rel="stylesheet" href="../css/create.css">
</head>
<body>
    <?php include_once('../header.php'); ?>
    <div class='container'>
        <div class='container-form'>
            <div class='container-row'>
                <h1>Question Information:</h1>
            </div>
            <form method="POST" action="../scripts/question_add.php" id="container-form">
                <div class='container-row-left'>
                    <label for="prompt">Q:</label>
                    <input type="text" id="prompt" name="prompt">
                </div>
                <br><br>
                <div class='container-row-left'>
                    <label for="a">A:</label>
                    <input type="text" id="a" name="a">
                </div>
                <div class='container-row-left'>
                    <label for="b">B:</label>
                    <input type="text" id="b" name="b">
                </div>
                <div class='container-row-left'>
                    <label for="c">C:</label>
                    <input type="text" id="c" name="c">
                </div>
                <div class='container-row-left'>
                    <label for="d">D:</label>
                    <input type="text" id="d" name="d">
                </div>
                <div class='container-row'>
                    <select name="answer">
                        <option value='' selected disabled>Declare correct answer...</option>
                        <option value='A'>A</option>
                        <option value='B'>B</option>
                        <option value='C'>C</option>
                        <option value='D'>D</option>
                    </select>
                </div>
                <div class='container-row'>
                    <input type='hidden' name='cid' value='<?= $cid ?>'>
                    <button class='good-button' type='submit'>Create</button>
                </div>
            </form>
            <div class='container-row'>
                <button class='bad-button' onclick="window.location.href='../courses.php'">Back</button>
            </div>
        </div>
    </div>
</body>
</html>