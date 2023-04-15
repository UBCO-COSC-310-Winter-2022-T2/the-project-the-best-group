<?php
    session_start();
    $pageTitle = "Instructor Courses: Create a Course";
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
    <link rel="icon" type="image/png" href="../images/instaquiz_favicon.png">
    <link rel="stylesheet" href="../css/pages_oneColumn.css">
    <link rel="stylesheet" href="../css/create.css">
    <style>
        .course-create-form
        {
            justify-self: flex-start;
            align-self: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-content: center;
            background-color: #07223E;
            padding: 1em;
            margin: 1.5em;
            border: 5px solid #061A2D;
            border-radius: 15px;
            width: 33%;
        }
        .course-create
        {
            justify-self: flex-start;
            align-self: center;
            margin: 1em;
            padding: 1em;
            display: flex;
            flex-direction: column;
            row-gap: 0.5em;
            justify-content: flex-start;
            align-content: flex-start;
            background-color: #05386B;
            border-radius: 15px;
            border: 5px solid #061A2D;
            word-wrap: break-word;
            width: 85%;
        }
        .course-create button
        {
            font-size: 24px;
            border: 3px solid #061A2D;
        }
    </style>
</head>
<body>
    <?php include_once('../header.php'); ?>
    <div class='container-page'>
        <div class='course-create-form'>
           <div class='course-create'>
                <div class='container-create-row'>
                    <h1>Course Information:</h1>
                </div>
                <form method="POST" action="../scripts/courses_add.php" id="container-create-form">
                    <div class='container-create-row'>
                        <label for="cname">Course Name:</label>
                        <input type="text" id="cname" name="cname" placeholder='Course name goes here...'>
                    </div>
                    <div class='container-create-row'>
                        <input type='hidden' name='cid' value='<?= $cid ?>'>
                        <button class='green-button' type='submit'>Create</button>
                    </div>
                </form>
                <div class='container-create-row'>
                    <button class='red-button' onclick="window.location.href='../courses.php'">Back</button>
                </div>
            </div> 
        </div>
        
    </div>
</body>
</html>