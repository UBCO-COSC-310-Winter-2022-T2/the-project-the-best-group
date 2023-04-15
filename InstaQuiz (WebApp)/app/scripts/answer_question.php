<?php

session_start();

if (!isset($_SESSION['user_id']) || !isset($_POST['qid']))
    exit();

$qid = $_POST['qid'];
$answer = $_POST['question'.$qid];
if ($answer == '') {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

// check if question active
require_once('config.php');

$sql = "SELECT qid FROM questions WHERE qid = ".$qid." AND live = 1";
$result = mysqli_query($conn, $sql);
if ($result->num_rows == 0) 
    exit();


// if an answer already recorded update it, otherwise insert into db
$sid = $_SESSION['user_id'];
$sql = "SELECT sid FROM answers WHERE sid = ".$sid." AND qid = ".$qid;
$result = mysqli_query($conn, $sql);
if ($result -> num_rows == 0) 
    $sql_answer = "INSERT INTO answers (sid, qid, answer) VALUES (".$sid.", ".$qid.",'".$answer."')";
else
    $sql_answer = "UPDATE answers SET answer = '".$answer."' WHERE sid = ".$sid." AND qid = ".$qid;

if (!mysqli_query($conn, $sql_answer))
    exit("<p>Error recording answer</p>");

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>