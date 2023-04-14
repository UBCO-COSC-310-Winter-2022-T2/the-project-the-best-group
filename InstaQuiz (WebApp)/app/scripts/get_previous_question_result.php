<?php

//*** $cid must be set or passed via GET when including or calling this script ***
    if (isset($_GET['cid']))
        $cid = $_GET['cid'];
    
    if (!isset($cid))
        exit();

    // validate user is logged in
    session_start();
    if (!isset($_SESSION['user_id']))
        exit();

    require_once('config.php');

    // get counts for each answer
    $answer_counts = [];
    $answer_count_student = '';
    foreach (['A', 'B', 'C', 'D'] as $ans) {
        $sql = "SELECT A.qid FROM answers A INNER JOIN questions Q ON A.qid = Q.qid WHERE A.answer ='".$ans."' AND live=2 AND cid=".$cid;
        $result = mysqli_query($conn, $sql);
        $answer_counts[] = $result->num_rows; // for use in instructor graph
        $answer_count_student .= $result->num_rows; // for use in student graph
        mysqli_free_result($result);
    }
    
    // get question prompt
    $sql_prompt = "SELECT prompt FROM questions WHERE live = 2 AND cid = ".$cid;
    $result_prompt = mysqli_query($conn, $sql_prompt);
    $row = mysqli_fetch_assoc($result_prompt);
    $question_prompt = $row['prompt'];

    mysqli_free_result($result_prompt);
    mysqli_close($conn);

    // return for student graph
    if ($_SESSION['user_permission'] == 0)
        echo $answer_count_student;

?>