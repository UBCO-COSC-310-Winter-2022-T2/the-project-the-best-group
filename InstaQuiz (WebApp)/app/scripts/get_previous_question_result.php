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

    $sql = "SELECT A.qid, Q.prompt, A.answer, count(A.qid) AS answer_counts FROM answers A INNER JOIN questions Q ON A.qid = Q.qid WHERE live=2 AND cid=".$cid." GROUP BY A.qid, A.answer, Q.prompt ORDER BY A.answer ASC";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows == 0)  
        exit();

    $answer_counts = [];
    $answer_count_student = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $answer_counts[] = $row['answer_counts'];
        $answer_count_student .= $row['answer_counts'];
        $question_prompt = $row['prompt'];
    }

    mysqli_free_result($result);
    mysqli_close($conn);

    if ($_SESSION['user_permission'] == 0)
        echo $answer_count_student;

?>