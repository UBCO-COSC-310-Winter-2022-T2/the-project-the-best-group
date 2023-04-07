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
            <div class='student-item'>
                <h1>{$row['fname']} {$row['lname']}</h1>
                <hr width='100%' color='#061A2D' style='border: 2px solid #061A2D;'>
                <h2 class='$colorA'>Student ID: {$row['id']}</h2>
                <h2 class='$colorB'>Email Address: {$row['email']}</h2>
                <div class='question-button'>
                    <form action=''>
                        <button class='green-button' type='submit'>??? View Details ???</button>
                    </form>
                </div>    
            </div>";
        }
    } 
    else 
    {
        $searchResult = '<div class="error-message">There are no available students.</div>';
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>InstaQuiz</title>
        <link rel="stylesheet" href="../css/pages_twoColumns.css">
        <link rel="stylesheet" href="../css/create.css">
        <style>
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
            .student-item
            {
                margin: 1em;
                padding: 1em;
                display: flex;
                flex-direction: column;
                row-gap: 0.5em;
                justify-content: flex-start;
                align-content: flex-start;
                background-color: #05386B;
                border-radius: 15px;
                border: 5px solid #061A2D;
                word-wrap: break-word;
            }
            .student-item button
            {
                font-size: 24px;
            }
            .answer
            {
                color: green;
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
                <h2>Select a student to see their details below:</h2>
            </div>
        </div>
    </body>
</html>