<?php

    session_start();
    if (!isset($_SESSION['user_id']) || !isset($_GET['id']))
        exit();

    require_once('config.php');

    $cid = $_GET['id'];
    $sql = "SELECT live FROM courses WHERE cid=".$cid;
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows == 1) {

        $row = $result->fetch_assoc();
    }

    mysqli_free_result($result);
    mysqli_close($conn);

    echo $row['live'];
?>
