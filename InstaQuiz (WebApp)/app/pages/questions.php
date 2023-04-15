<?php
    session_start();
    $pageTitle = "Instructor Courses: Questions";
    require_once('../scripts/config.php');
    $userId = $_SESSION['user_id'];
    $cid = $_SESSION['cid'];
    $searchResult = '';
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    $sql = "SELECT qid, prompt, a, b, c, d, answer
            FROM questions 
            WHERE cid = $cid AND prompt LIKE '%$search%'";
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
                <hr width='100%' color='#061A2D' style='border: 2px solid #061A2D;'>
                <div class='question-button'>
                    <form action='question_edit.php' method='POST'>
                        <input type='hidden' name='cid' value='{$row['cid']}'>
                        <input type='hidden' name='qid' value='{$row['qid']}'>
                        <button class='green-button' type='submit'>Edit Question</button>
                    </form>
                    <form action='question_deleteConf.php' method='POST'>
                        <input type='hidden' name='cid' value='{$row['cid']}'>
                        <input type='hidden' name='qid' value='{$row['qid']}'>
                        <input type='hidden' name='prompt' value='{$row['prompt']}'>
                        <button class='red-button' type='submit'>Delete Question</button>
                    </form>
                </div>    
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
        <link rel="icon" type="image/png" href="../images/instaquiz_favicon.png">
        <link rel="stylesheet" href="../css/pages_twoColumns.css">
        <link rel="stylesheet" href="../css/create.css">
        <style>
            .search-container 
            {
                display: flex;
                flex-direction: row;
                justify-items: center;
                align-items: center;
                column-gap: 0.2em;
                padding: 0.2em;
                background-color: #07223E;
                border-radius: 15px;
                border: 5px solid #061A2D;
            }
            .search-container input[type="text"] 
            {
                display: flex;
                width: 100%;
                font-size: 18px;
                padding: 0.3em;
                font-family: 'Courier New', Courier, monospace;
                border-radius: 10px;
            }
            .search-container button
            {
                font-size: 24px;
                padding: 0.3em;
            }
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
                margin-top: 0.5em;
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
                <form method="get">
                    <div class="search-container">
                        <input type="text" name="search" placeholder=" Question prompt...">
                        <button class='pink-button' type="submit">Search</button>
                    </div>
                </form>
            </div>
            <div class='container-right-header'>
                <h1>Create a Question:</h1>
            </div>
            <div class='container-left-body'>
                <?php echo $searchResult ?>
            </div>
            <div class='container-right-body'>
                <?php echo $_SESSION['result_message']; unset($_SESSION['result_message']); ?>
                <div class='question-item'>
                    <form method="POST" action="../scripts/question_add.php">
                        <div class='container-create-row-left'>
                            <label for="prompt">Q:</label>
                            <input type="text" id="prompt" name="prompt" placeholder="Question prompt goes here...">
                        </div>
                        <br><br>
                        <div class='container-create-row-left'>
                            <label for="a">A:</label>
                            <input type="text" id="a" name="a" placeholder="Choice A goes here...">
                        </div>
                        <div class='container-create-row-left'>
                            <label for="b">B:</label>
                            <input type="text" id="b" name="b" placeholder="Choice B goes here...">
                        </div>
                        <div class='container-create-row-left'>
                            <label for="c">C:</label>
                            <input type="text" id="c" name="c" placeholder="Choice C goes here...">
                        </div>
                        <div class='container-create-row-left'>
                            <label for="d">D:</label>
                            <input type="text" id="d" name="d" placeholder="Choice D goes here...">
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
                            <button class='green-button' type='submit'>Create</button>
                        </div>
                    </form>
                </div>
                <div class='container-create-row'>
                    <button class='red-button' onclick="window.location.href='../courses.php'">Back</button>
                </div>
            </div>
        </div>
    </body>
</html>