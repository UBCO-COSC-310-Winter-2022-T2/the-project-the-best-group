<?php

    //$sid and $cid must be set before including this script on a page
    if (!isset($sid) || !isset($cid)) {
        exit();
    }

    require_once('config.php');

    // get total number of course sessions
    $sql = "SELECT sessions_held FROM courses WHERE cid=".$cid;
    $result_sessions = mysqli_query($conn, $sql);
    $row_sessions = mysqli_fetch_assoc($result_sessions);
    $num_sessions = $row_sessions['sessions_held'];

    mysqli_free_result($result_sessions);

    // get total number of sessions attended
    $sql = "SELECT student_attendance FROM enrollment WHERE cid=".$cid." AND sid=".$sid;
    $result_attendance = mysqli_query($conn, $sql);
    $row_attendance = mysqli_fetch_assoc($result_attendance);
    $num_attendance = $row_attendance['student_attendance'];

    mysqli_free_result($result_attendance);

    $attendance = [$num_attendance, $num_sessions];

?>
