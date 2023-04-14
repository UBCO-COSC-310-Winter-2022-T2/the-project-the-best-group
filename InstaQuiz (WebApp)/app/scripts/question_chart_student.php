<?php

    // cid must be passed via GET
    if (!isset($_GET['cid']))
        exit();
    $cid = $_GET['cid'];

    // validate user is logged in
    session_start();
    if (!isset($_SESSION['user_id']))
        exit();

    require_once('config.php');

    $cid = $_GET['cid'];
    $sql = "SELECT qid FROM questions WHERE live=2 AND cid=".$cid;
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows == 0)  
        echo 0;
    
    mysqli_free_result($result);

    echo 1;
?>