<?php
    
    session_start();
    if ($_SESSION['user_permission'] != 1 || !isset($_GET['cid'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $pageTitle = "Course Grade Report";
    $userId = $_SESSION['user_id'];
    $cid= $_GET['cid'];

    // get course name
    require_once('../scripts/config.php');
    $sql = "SELECT cname FROM courses WHERE cid = ".$cid;
    $result = mysqli_query($conn, $sql);
    $cname = mysqli_fetch_assoc($result)['cname'];

    mysqli_free_result($result);

    // get student list for course
    $sql = "SELECT sid FROM enrollment WHERE cid = ".$cid;
    $result_students = mysqli_query($conn, $sql);  
    
    // for each student get name, attendance, and grade
    $names = [];
    $attendances = [];
    $grades = [];
    while ($row = mysqli_fetch_assoc($result_students)) {

        // get student name
        $sid = $row['sid'];
        $sql = "SELECT fname, lname FROM accounts WHERE id = ".$sid;
        $result = mysqli_query($conn, $sql);
        $name = mysqli_fetch_assoc($result);
        $names[] = $name['fname']." ".$name['lname'];
        

        // get attendance
        include "../scripts/get_student_attendance.php";
        $attendances[] = $attendance;

        //get grade
        include "../scripts/get_student_grade.php";
        $grades[] = $grade;

        mysqli_free_result($result);
    }
    mysqli_free_result($result_students);

    // generate table html
    $table = "";
    for ($i = 0; $i < count($names); $i++) {
        
        // compute grade and attendance %s accounting for div by 0
        if ($attendances[$i][1] == 0)   
            $attendance_percent = '-';
        else
            $attendance_percent = Round($attendances[$i][0] / $attendances[$i][1] * 100, 1);

        if ($grades[$i][1] == 0)
            $grade_percent = '-';
        else
            $grade_percent = Round($grades[$i][0] / $grades[$i][1] * 100, 1);
        
        $table .= "<tr>";
        $table .= "<td>".$names[$i]."</td>";
        $table .= "<td>".$attendances[$i][0]."</td>";
        $table .= "<td>".$attendances[$i][1]."</td>";
        $table .= "<td>".$attendance_percent."%</td>";
        $table .= "<td>".$grades[$i][0]."</td>";
        $table .= "<td>".$grades[$i][1]."</td>";
        $table .= "<td>".$grade_percent."%</td>";
        $table .= "</tr>";
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>InstaQuiz</title>
    <link rel="icon" type="image/png" href="../images/instaquiz_favicon.png">
    <link rel="stylesheet" href="../css/pages_oneColumn.css">
    <style>
        .container-header {
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }
        .container-body{
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }
        #back-button {
            width: 30%;
            margin-left: auto;
            margin-right: auto;
        }
        table {
            border-collapse: collapse;
        }
        table th {
            border: 1px solid black;
            padding: .5em;
        }
        table td {
            border: 1px solid black;
            padding: .5em;
        }
    </style>
</head>
<body>
    <?php include_once('../header.php'); ?>
    <div class='container-page'>
        <div class='container-header'>
            <h1>Grades and Attendance Report:</h1>
        </div>
        <div class='container-body'>
            <table>
                <tr>
                    <th>Student Name</th>
                    <th>Attended Count</th>
                    <th>Sessions Count</th>
                    <th>Attendance %</th>
                    <th>Correct Answer Count</th>
                    <th>Question Count</th>
                    <th>Grade %</th>
                <tr>
            <?php
                echo $table;
            ?>  
            </table>
        </div>
        <div class='container-body' style='width: 30%'>
            <button id='back-button' class='pink-button' onclick="window.location.replace('../courses.php')">Back</button>
        </div>
    </div>
</body>
</html>