<?php

    session_start();
    if (!isset($_SESSION['user_id']) || !isset($_GET['cid']))
        exit();

    require_once('config.php');

    // get active question(s)
    $sid = $_SESSION['user_id'];
    $cid = $_GET['cid'];
    $sql = "SELECT qid, prompt, a, b, c, d, answer FROM questions WHERE live=1 AND cid=".$cid;
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows == 0) 
        exit('<p>Welcome to class! Currently there are no active polls<p>');

    while($row = $result->fetch_assoc()) {
        
        // get current answer
        $qid = $row['qid'];
        $sql_answer = 'SELECT answer FROM answers WHERE qid = '.$qid.' AND sid = '.$sid;
        $result_answer = mysqli_query($conn, $sql_answer);

        $cur_answer = '';
        if ($result_answer->num_rows == 1) {
            $result_row = mysqli_fetch_assoc($result_answer);
            $cur_answer = "<p style='text-align: center;'><b>Current answer: ".$result_row['answer']."</b></p>";
        } 
        
        $output .= "
            <div class='question-item'>
                <form action='../scripts/answer_question.php' method='POST'>
                <h2>{$row['prompt']}</h2>
                    <p><input type='radio' name='question{$row['qid']}' value='A' ><label>A) {$row['a']}</label></p>
                    <p><input type='radio' name='question{$row['qid']}' value='B' ><label>B) {$row['b']}</label></p>
                    <p><input type='radio' name='question{$row['qid']}' value='C' ><label>C) {$row['c']}</label></p>
                    <p><input type='radio' name='question{$row['qid']}' value='D' ><label>D) {$row['d']}</label></p>
                    <input type='hidden' name='qid' value='{$row['qid']}'>
                    <button class='good-button' type='submit'>Submit Answer</button>
                </form>".
                $cur_answer."
            </div>";
    }
    mysqli_free_result($result);
    mysqli_close($conn);
    echo $output;
?>
