<?php
    session_start();
    include_once __DIR__ . '/../scripts/header.php';
    require_once __DIR__ . '/../scripts/config.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>InstaQuiz Enroll Course</title>
        <style>
            body 
            {
                color: #CCCCCC;
                background-color: #05386B;
                background-image: url("https://www.transparenttextures.com/patterns/dark-mosaic.png");
                font-family: "cambria", serif;
                text-align: center;
                text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.6);
            }
            button
            {
                background-color: transparent;
                text-decoration: none;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 18px;
                font-weight: bold;
                color: #CCCCCC;
                transition: background-color 0.3s ease;
            }
            button:hover 
            {
                background-color: #F64C72;
                color: #CCCCCC;
            }
            #enroll-course
            {
                display: inline-block;
                width: 60%;
                margin: auto;
                margin-top: 100px;
                padding: 20px;
                background-color: #07223E;
                background-image: url("https://www.transparenttextures.com/patterns/dark-mosaic.png");
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            }
            #search input {
                float: top;
                width: 70%;
                height: 30px;
            }
            #search button {
                float: top;
                width: 40px;
                height: 40px;
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div id="enroll-course">

            <form id='search' action="enroll_course.php" method="get">
                <input type="text" placeholder="Search" name="search">
                <button type='submit'><i class="fa fa-search"></i></button>
            </form>

            <div class='search-result'>
            <?php
            
            if ($_SERVER['REQUEST_METHOD'] == "GET") {
                
                if ($_GET['msg'] == 'exists') { // message from student_enroll script if already enrolled
                    echo "<p>You are already enrolled in this course.</p>";
                }  
                if ($_GET['msg'] == 'fail') { // message from student_enroll script if enrollment otherwise failed
                    echo "<p>Error enrolling in course. Please try again.</p>";
                } 

                $search = $_GET['search'];
                
                $sql = "SELECT C.cid, C.cname, A.fname, A.lname FROM courses C INNER JOIN accounts A ON C.Iid = A.id WHERE C.cname LIKE '%".$search."%'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) == 0) { 
                    echo "<p>No courses found</p>";
                    exit();
                } else {
                    while ($course_info = mysqli_fetch_assoc($result)) {
                        echo 
                        "<form class='course-item' action='../scripts/student_enroll.php' method='post'>
                            <h1>".$course_info['cname']."</h1>
                            <p>Instructor: ".$course_info['fname']." ".$course_info['lname']."</p>
                            <input type='hidden' name='cid' value=".$course_info['cid'].">
                            <button type='submit'>Enroll</button>
                        </div>";
                    }
                }

            }
            ?>
            </div>
        </div>
    </body>
</html>
