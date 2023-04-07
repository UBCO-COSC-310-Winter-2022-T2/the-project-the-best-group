<?php
    session_start();
    $pageTitle = "Create a Course";
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
    <div class='container-create'>
        <div class='container-create-form'>
            <div class='container-create-row'>
                <h1>Course Information:</h1>
            </div>
            <form method="POST" action="../scripts/courses_add.php" id="container-create-form">
                <div class='containe-creater-row'>
                    <label for="cname">Course Name:</label>
                    <input type="text" id="cname" name="cname">
                </div>
                <div class='container-create-row'>
                    <input type='hidden' name='cid' value='<?= $cid ?>'>
                    <button class='good-button' type='submit'>Create</button>
                </div>
            </form>
            <div class='container-create-row'>
                <button onclick="window.location.href='../courses.php'">Back</button>
            </div>
        </div>
    </div>
</body>
</html>