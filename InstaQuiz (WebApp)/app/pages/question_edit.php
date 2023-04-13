<?php
    session_start();
    $pageTitle = "Instructor Courses: Edit Question";
    require_once('../scripts/config.php');
    $userId = $_SESSION['user_id'];
    $cid = $_SESSION['cid'];
    $qid = $_POST['qid'];

    $sql = "SELECT prompt, a, b, c, d, answer
            FROM questions 
            WHERE qid = $qid";
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

            $searchResult .= "
            <div class='question-item'>
                <h1>{$row['prompt']}</h1>
                <hr width='100%' color='#061A2D' style='border: 2px solid #061A2D;'>
                <h2 class='$colorA'>A: {$row['a']}</h2>
                <h2 class='$colorB'>B: {$row['b']}</h2>
                <h2 class='$colorC'>C: {$row['c']}</h2>
                <h2 class='$colorD'>D: {$row['d']}</h2>
            </div>";
        }
        mysqli_close($conn);
    } 
    else 
    {
        $searchResult = '<div class="error-message">There are no available questions.</div>';
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>InstaQuiz</title>
        <link rel="stylesheet" href="../css/pages_twoColumns.css">
        <link rel="stylesheet" href="../css/create.css">
        <style>
            .question-item
            {
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
            }
            .question-item button
            {
                font-size: 24px;
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
                <h1>Current Question:</h1>
            </div>
            <div class='container-right-header'>
                <h1>Overwrite Question:</h1>
            </div>
            <div class='container-left-body'>
                <?php echo $searchResult ?>
            </div>
            <div class='container-right-body'>
                <?php echo $_SESSION['result_message']; unset($_SESSION['result_message']); ?>
                <div class='question-item'>
                    <form method="POST" action="../scripts/question_update.php">
                        <div class='container-create-row-left'>
                            <label for="prompt">Q:</label>
                            <input type="text" id="prompt" name="prompt" placeholder="Update question prompt here...">
                        </div>
                        <br><br>
                        <div class='container-create-row-left'>
                            <label for="a">A:</label>
                            <input type="text" id="a" name="a" placeholder="Update choice A here...">
                        </div>
                        <div class='container-create-row-left'>
                            <label for="b">B:</label>
                            <input type="text" id="b" name="b" placeholder="Update choice B here...">
                        </div>
                        <div class='container-create-row-left'>
                            <label for="c">C:</label>
                            <input type="text" id="c" name="c" placeholder="Update choice C here...">
                        </div>
                        <div class='container-create-row-left'>
                            <label for="d">D:</label>
                            <input type="text" id="d" name="d" placeholder="Update choice D here...">
                        </div>
                        <div class='container-create-row'>
                            <select name="answer">
                                <option value='' selected disabled>Declare correct answer...</option>
                                <option value='A'>A</option>
                                <option value='B'>B</option>
                                <option value='C'>C</option>
                                <option value='D'>D</option>
                            </select>
                        </div>
                        <div class='container-create-row'>
                            <input type='hidden' name='cid' value='<?= $cid ?>'>
                            <input type='hidden' name='qid' value='<?= $qid ?>'>
                            <button class='pink-button' type='submit'>Update</button>
                        </div>
                    </form>
                </div>
                <div class='container-create-row'>
                    <button class='red-button' onclick="window.location.href='questions.php'">Back</button>
                </div>
            </div>
        </div>
    </body>
</html>