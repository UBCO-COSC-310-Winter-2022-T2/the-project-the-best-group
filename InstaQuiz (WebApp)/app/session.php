<?php
    session_start();
    
    if (!isset($_GET['cid'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
    $cid = $_GET['cid'];

    // TODO: get permission to load different instructor or student page

?>

<!DOCTYPE html>
<html>
<head>
    <title>InstaQuiz</title>
    <link rel="stylesheet" href="../css/body.css">
    <style>
        #end-container {
            margin-top: 2em;
            margin-left: auto;
            margin-right: auto;
            padding: 1em;
            width: 80%;
            height: auto;
            background-color: #07223E;
            border-radius: 15px;
            border: 5px solid #061A2D;
        }
        #end-container button {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <?php include_once('header.php'); ?>
    <div id='end-container'>
        <form action='scripts/end_class.php' method='POST'>
            <?php echo "<input type='hidden' name='cid' value='{$cid}'>"; ?>
            <button type='submit' class='bad-button'>End Class</button>
        </form>
    </div>


</body>
</html>