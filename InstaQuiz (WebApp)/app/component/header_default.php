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
                <a href="../pages/login.php">Login</a>
                <a href="../pages/register.php">Register</a>
            </nav>
        </header>
    </body>
</html>
