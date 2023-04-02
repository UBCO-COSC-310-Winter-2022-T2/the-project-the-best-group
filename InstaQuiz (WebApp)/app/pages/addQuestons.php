<?php
    // Include the database credentials
    include __DIR__ . '/../scripts/config.php';

    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Get the values of the form fields
        $question = $_POST["question-text"];
        $answer1 = $_POST["answer-1"];
        $answer2 = $_POST["answer-2"];
        $answer3 = $_POST["answer-3"];
        $answer4 = $_POST["answer-4"];
        $correct_answer = $_POST["correct-answer"];
        
        // Insert the values into the database
        $sql = "INSERT INTO questions (cid, prompt, answer)
                VALUES (1, '$question A=$answer1 B=$answer2, C=$answer3, D=$answer4', '$correct_answer')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title> Add Question </title>
    <style>
        body {
            background-color: #313357;
            color: #CCCCCC;
            font-family: "monospace";
            text-align: center;
            margin: 200px;
        }
        
        label {
            display: inline-block;
            width: 100px;
            text-align: right;
            margin-right: 10px;
            vertical-align: top;
        }

        label[for="question-text"] {
            display: inline-block;
            width: 76px; 
            text-align: right;
            margin-right: 10px;
        }

        input[type="text"], input[type="checkbox"] {
            display: inline-block;
            margin-bottom: 10px;
        }
        
        input[type="submit"] {
             margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>InstaQuiz</h1>
    <ul id="question-list"></ul>

    <h2>Create a Question</h2>
    <form method="post" action="addQuestion.php" id="question-form">
        <label for="question-text">Question:</label>
        <input type="text" id="question-text" name="question-text"><br>
    
        <label for="answer-1">Answer 1:</label>
        <input type="text" id="answer-1" name="answer-1">
        <input type="checkbox" id="correct-answer-1" name="correct-answer" value="1"><br>
        
        <label for="answer-2">Answer 2:</label>
        <input type="text" id="answer-2" name="answer-2">
        <input type="checkbox" id="correct-answer-2" name="correct-answer" value="2"><br>
    
        <label for="answer-3">Answer 3:</label>
        <input type="text" id="answer-3" name="answer-3">
        <input type="checkbox" id="correct-answer-3" name="correct-answer" value="3"><br>
    
        <label for="answer-4">Answer 4:</label>
        <input type="text" id="answer-4" name="answer-4">
        <input type="checkbox" id="correct-answer-4" name="correct-answer" value="4"><br>
    
        <input type="submit" value="Create Question">
    </form>
</body>
</html>