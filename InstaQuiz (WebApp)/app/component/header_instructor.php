<!DOCTYPE html>
<html>
    <head>
        <title>InstaQuiz</title>
        <link rel="stylesheet" href="../css/header.css">
    </head>
    <body>
        <header>
            <button class="logo" onclick="location.href='../index.php'">InstaQuiz</button>
            <div class="title">
                <?php 
                    echo $pageTitle;
                ?>
            </div>
            <nav>
                <a href="../scripts/logout.php">Logout</a>
            </nav>
        </header>
    </body>
</html>
