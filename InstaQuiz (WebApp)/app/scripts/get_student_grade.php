<?php

    //$sid and $cid must be set before including this script on a page ***
    if (!isset($sid) || !isset($cid)) {
        exit();
    }

    require_once('config.php');

    // echo "<script>alert('SID: ".$sid." CID: ".$cid."');</script>";

    // get total number of questions asked in course
    $sql = "SELECT qid FROM questions WHERE cid=".$cid;
    $result_questions = mysqli_query($conn, $sql);
    $num_questions = $result_questions -> num_rows;

    mysqli_free_result($result_questions);

    // get total number of correct answers for student in course
    $sql = "SELECT A.qid FROM answers A INNER JOIN questions Q ON A.qid = Q.qid AND A.answer = Q.answer WHERE Q.cid = ".$cid." AND A.sid=".$sid;
    $result_answers = mysqli_query($conn, $sql);
    $num_correct = $result_answers -> num_rows;

    mysqli_free_result($result_answers);
    mysqli_close($conn);

    $grade = round($num_correct / $num_questions * 100, 0);
?>
