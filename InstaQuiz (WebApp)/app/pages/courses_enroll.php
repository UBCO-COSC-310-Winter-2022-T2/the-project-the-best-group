<?php
    session_start();
    $pageTitle = "Search InstaQuiz Courses";
    require_once('../scripts/config.php');
    include_once('../header.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>InstaQuiz Enroll Course</title>
    <link rel="stylesheet" href="css/body.css">
    <style>
        #enroll-course
        {
            display: block;
            margin-top: 50px;
            margin-left: auto;
            margin-right: auto;
            width: 60%;
            padding: 20px;
            background-color: #07223E;
            background-image: url("https://www.transparenttextures.com/patterns/dark-mosaic.png");
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        #search input {
            float: top;
            width: 95%;
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

        <form id='search' action="courses_enroll.php" method="get">
            <input type="text" placeholder="Search" name="search">
            <button type='submit'><i class="fa fa-search"></i></button>
        </form>

        <div class='search-result'>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == "GET") 
            {
                if ($_GET['msg'] == 'exists') 
                { 
                    echo '<div class="error-message">$msg</div>';
                }  
                if ($_GET['msg'] == 'fail') 
                { 
                    echo '<div class="error-message">Error enrolling in course. Please try again.</div>';
                } 
                if ($_GET['msg'] == 'success') 
                { 
                    echo '<div class="success-message">Successfully enrolled, good luck!.</div>';
                }
                
                $search = $_GET['search'];
                
                $sql = "SELECT C.cid, C.cname, A.fname, A.lname FROM courses C INNER JOIN accounts A ON C.Iid = A.id WHERE C.cname LIKE '%".$search."%'";
                $result = mysqli_query($conn, $sql);

                while ($course_info = mysqli_fetch_assoc($result)) 
                {
                    echo 
                    "<form class='course-item' action='../scripts/student_enroll.php' method='post'>
                        <h1>".$course_info['cname']."</h1>
                        <p>Instructor: ".$course_info['fname']." ".$course_info['lname']."</p>
                        <input type='hidden' name='cid' value=".$course_info['cid'].">
                        <button type='submit'>Enroll</button>
                    </form>"; 
                }
            }
        ?>
        </div>
    </div>
</body>
</html>
