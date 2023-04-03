<?php
    session_start();
    include_once('header.php');
    require_once('scripts/config.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>InstaQuiz Courses</title>
        <link rel="stylesheet" href="css/body.css">
        <style>
            button 
            {
                display: block;
                margin: 0 auto;
                font-size: 20;
                padding: 10px;
            }
            #course-list
            {
                display: inline-block;
                width: 60%;
                margin-left: 20%;
                margin-top: 100px;
                padding: 20px;
                background-color: #07223E;
                background-image: url("https://www.transparenttextures.com/patterns/dark-mosaic.png");
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            }
            .course-item {
                float: top;
                width: 80%;
                margin: auto;
                margin-top: 20px;
                padding: 5px;
                border: 1px solid #05386B;
            }
        </style>
    </head>
    <body>
        <p>This is the dashboard for student courses.</p>
        <div id='course-list'>
        <?php

            $sid = $_SESSION['user_id'];
            'SELECT cid FROM enrollment WHERE sid = ".$sid';

            $sql = "SELECT E.sid, C.cid, C.cname, A.fname, A.lname FROM (SELECT sid, cid FROM enrollment WHERE sid = ".$sid.") AS E INNER JOIN courses C ON E.cid = C.cid INNER JOIN accounts A ON C.Iid = A.id";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 0) { 
                echo "<p>No courses found</p>";
            } else {
                while ($course_info = mysqli_fetch_assoc($result)) {                                                                                                                                                                                                                                                                                                                                                                                                            
                    echo 
                    "<form class='course-item' action='../scripts/student_unenroll.php' method='post'>
                        <h1>".$course_info['cname']."</h1>
                        <p>Instructor: ".$course_info['fname']." ".$course_info['lname']."</p>
                        <input type='hidden' name='cid' value=".$course_info['cid'].">
                        <button type='submit'>Unenroll</button>
                    </div>";
                }
            }
        ?>
        <button onclick="window.location.href = 'pages/courses_enroll.php';">Enroll</button>
        </div>
    </body>
</html>
