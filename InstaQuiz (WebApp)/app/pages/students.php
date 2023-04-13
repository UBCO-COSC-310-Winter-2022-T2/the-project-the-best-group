<?php
    session_start();
    $pageTitle = "Instructor Courses: Students";
    require_once('../scripts/config.php');
    $userId = $_SESSION['user_id'];
    $cid = $_SESSION['cid'];
    $searchResult = '';
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    $sql = "SELECT A.id, A.fname, A.lname, A.email
            FROM accounts A
            JOIN enrollment E ON A.id = E.sid
            WHERE E.cid = $cid AND CONCAT(A.fname, ' ', A.lname) LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc()) 
        {
            $searchResult .= "
            <div class='student-listed'>
                <h1>{$row['fname']} {$row['lname']}</h1>
                <div class='student-button'>
                    <form action='students.php' method='POST'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button class='pink-button' type='submit'>View Details</button>
                    </form>
                </div>    
            </div>";
        }
    } 
    else 
    {
        $searchResult = '<div class="error-message">There are no available students.</div>';
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $sid = $_POST['id'];
        $sql = "SELECT A.id, A.fname, A.lname, A.email
                FROM accounts A
                JOIN enrollment E ON A.id = E.sid
                WHERE E.cid = $cid AND A.id = $sid";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $editResult .= "
                <div class='big-button'>
                    <a href='students.php'>- Clear Student</a> 
                </div>
                <div class='student-item'>
                    <h1>{$row['fname']} {$row['lname']}</h1>
                    <hr width='100%' color='#061A2D' style='border: 2px solid #061A2D;'>
                    <h2>PERMISSION:</h2><h3>Student</h3>
                    <h2>STUDENT ID:</h2><h3>{$row['id']}</h3>
                    <h2>EMAIL ADRESS:</h2><h3>{$row['email']}</h3>
                    <div class='student-button'>
                        <form action='student_removeConf.php' method='POST'>
                            <input type='hidden' name='cid' value='$cid'>
                            <input type='hidden' name='sid' value='$sid'>
                            <input type='hidden' name='fname' value='{$row['fname']}'>
                            <input type='hidden' name='lname' value='{$row['lname']}'>
                            <button class='red-button' type='submit'>Remove Student</button>
                        </form>
                    </div>     
                </div>";
            }
        } 
        else 
        {
            $editResult = "<div class='red-message'>Error gathering student details. Please try again:</div>";
        }
    } 
    else
    {
        $editResult = "<h2>Student details will appear here when you press edit:</h2>";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>InstaQuiz</title>
        <link rel="stylesheet" href="../css/pages_twoColumns.css">
        <style>
            .big-button
            {
                display: flex;
                flex-direction: column;
                justify-self: center;
                align-self: center;
                font-size: 24px;
                font-weight: bold;
            }
            .search-container 
            {
                display: flex;
                flex-direction: row;
                justify-items: center;
                align-items: center;
                column-gap: 0.2em;
                padding: 0.2em;
                background-color: #07223E;
                border-radius: 15px;
                border: 5px solid #061A2D;
            }
            .search-container input[type="text"] 
            {
                display: flex;
                width: 100%;
                font-size: 18px;
                padding: 0.2em;
                font-family: 'Courier New', Courier, monospace;
                border-radius: 10px;
            }
            .search-container button
            {
                font-size: 24px;
                padding: 0.3em;
            }
            .student-listed
            {
                margin: 1em;
                padding: 1em;
                display: flex;  
                flex-direction: row;
                justify-content: space-between;
                align-content: baseline;
                background-color: #05386B;
                border-radius: 15px;
                border: 5px solid #061A2D;
                word-wrap: break-word;
            }
            .student-item
            {
                margin: 1em;
                padding: 1em;
                display: flex;  
                flex-direction: column;
                justify-content: flex-start;
                row-gap: 1em;
                align-content: center;
                background-color: #05386B;
                border-radius: 15px;
                border: 5px solid #061A2D;
                word-wrap: break-word;
            }
            .student-listed h1
            {
                margin: 0.5em;
            }
            .student-item h1
            {
                margin-top: 0.5em;
            }
            .student-item h2
            {  
                font-size: 18px;
                text-decoration: underline;
                margin: 0;
            }
            .student-item h3
            {   
                font-size: 18px;
                text-decoration: none;
                margin: 0;
            }
            .student-listed button
            {
                font-size: 24px;
            }
            .student-item button
            {
                font-size: 24px;
            }
            a
            {
                background-color: #05386B;
                font-size: 28px;
                font-weight: bold;
                font-family: 'Courier New', Courier, monospace;
                text-align: center;
                text-shadow: 0px 3px 3px rgba(0, 0, 0, 0.6);
                text-decoration: none;
                color: #CCCCCC;
                padding: 0.5em;
                border-radius: 15px;
                border-style: solid;
                border-color: #061A2D;
                border-width: 5px;
                transition: background-color 0.3s ease;
            }
            a:hover 
            {
                background-color: red;
            }
        </style>
    </head>
    <body>
        <?php include_once('../header.php'); ?>
        <div class='container-page'>
            <div class='container-left-header'>
                <form method="get">
                    <div class="search-container">
                        <input type="text" name="search" placeholder=" Question prompt...">
                        <button class='pink-button' type="submit">Search</button>
                    </div>
                </form>
            </div>
            <div class='container-right-header'>
                <h1>Student Details:</h1>
            </div>
            <div class='container-left-body'>
                <?php echo $searchResult ?>
            </div>
            <div class='container-right-body'>
                <?php 
                    if (isset($_SESSION['result_message'])) 
                    {
                        echo $_SESSION['result_message'];
                        unset($_SESSION['result_message']);
                    } 
                    echo $editResult; 
                ?>
                <div class='container-create-row'>
                    <br>
                    <button class='red-button' onclick="window.location.href='../courses.php'">Back</button>
                </div>
            </div>
        </div>
    </body>
</html>