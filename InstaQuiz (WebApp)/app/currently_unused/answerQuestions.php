<?php
include __DIR__ . '/../scripts/config.php';

$sql = "SELECT * FROM questions";

$result = $conn->query($sql);

if ($result === false) {
    #echo "Error: " . $sql . "<br>" . $conn->error;
} else {
    $total_asked = 0;
    echo "<form method='POST'>";
    while ($row = $result->fetch_assoc()) {
        echo "<p>" . $row['prompt'] . "</p>";
        echo "<label><input type='radio' name='answer[".$row['qid']."]' value='A'>" . $row['choice_1'] . "</label><br>";
        echo "<label><input type='radio' name='answer[".$row['qid']."]' value='B'>" . $row['choice_2'] . "</label><br>";
        echo "<label><input type='radio' name='answer[".$row['qid']."]' value='C'>" . $row['choice_3'] . "</label><br>";
        echo "<label><input type='radio' name='answer[".$row['qid']."]' value='D'>" . $row['choice_4'] . "</label><br>";
       
        echo "<br>";
        $total_asked++;
    }
    echo "<input type='submit' name='submit' value='Submit'>";
    echo "</form>";
    if (isset($_POST['submit'])) {
        $score = 0;
        $answers = $_POST['answer'];
        foreach ($answers as $qid => $user_answer) {
            $sql = "SELECT answer FROM questions WHERE qid=" . $qid;
            $result = $conn->query($sql);
            if ($result === false) {
                #echo "Error: " . $sql . "<br>" . $conn->error;
            } else {
                $row = $result->fetch_assoc();
                $correct_answer = $row['answer'];
                if ($user_answer == $correct_answer) {
                    $score++;
                }
            }
        }
        $sql = "INSERT INTO scores (sid, cid, totalCorrect, totalAsked) VALUES (1, 1, $score, $total_asked)";
        if ($conn->query($sql) === FALSE) {
            #echo "Error inserting score: " . $conn->error;
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            body 
            {
                color: #CCCCCC;
                background-color: #05386B;
                background-image: url("https://www.transparenttextures.com/patterns/dark-mosaic.png");
                font-family: "cambria", serif;
                font-size: 20px;
                font-weight: bold;
                margin-bottom: 10px;
                text-align: center;
                text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.6);
            }
            input[type=submit]
            {
                background-color: #F64C72;
                color: #CCCCCC;
                padding: 10px;
                margin-top: 10px;
                border: none;
                border-radius: 5px;
                font-size: 18px;
                font-weight: bold;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }
            label
            {
                display: block;
                margin-top: 10px;
                margin-bottom: 10px;
                font-size: 18px;
            }
        </style>
    </head>
    <body>
        <div id="quiz-form">
    </body>
</html>