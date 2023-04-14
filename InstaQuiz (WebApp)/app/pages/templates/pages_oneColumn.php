<?php
    session_start();
    $pageTitle = "DEFAULT_ONE_TONE";
    $userId = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>InstaQuiz</title>
  <link rel="icon" type="image/png" href="../images/instaquiz_favicon.png">
  <link rel="stylesheet" href="../css/pages_oneColumn.css">
</head>
<body>
    <?php include_once('../header.php'); ?>
    <div class='container-page'>
        <div class='container-header'>
            <h1>Header:</h1>
        </div>
        <div class='container-body'>
            <h2>Body:</h2>
        </div>
    </div>
</body>
</html>