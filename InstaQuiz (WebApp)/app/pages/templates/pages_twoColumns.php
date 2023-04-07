<?php
    session_start();
    $pageTitle = "DEFAULT_TWO_TONE";
    $userId = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>InstaQuiz</title>
  <link rel="stylesheet" href="../css/pages_twoColumns.css">
</head>
<body>
  <?php include_once('../header.php'); ?>
  <div class='container-page'>
    <div class='container-left-header'>
        <h1>Left Header:</h1>
    </div>
    <div class='container-right-header'>
        <h1>Right Header:</h1>
    </div>
    <div class='container-left-body'>
        <h2>Left Body:</h2>
    </div>
    <div class='container-right-body'>
        <h2>Right Body:</h2>
    </div>
  </div>
</body>
</html>