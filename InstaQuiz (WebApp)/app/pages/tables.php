<?php
    session_start();
<<<<<<< HEAD:InstaQuiz (WebApp)/app/tables.php
    $pageTitle = "Database";
    include_once 'header.php';
    require_once 'config.php';
=======
    include_once __DIR__ . '/../scripts/header.php';
    require_once __DIR__ . '/../scripts/config.php';
>>>>>>> e7c0cf58cb454d041fc475df91444c07c27148a8:InstaQuiz (WebApp)/app/pages/tables.php
?>

<!DOCTYPE html>
<html>
    <head>
        <title>InstaQuiz Database</title>
        <style>
            body 
            {
                color: #CCCCCC;
                background-color: #05386B;
                background-image: url("https://www.transparenttextures.com/patterns/dark-mosaic.png");
                font-family: "cambria", serif;
                text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.6);
            }
            table 
            {
                border-collapse: collapse;
                border: 3px solid #061A2D;
                width: 100%;
                color: #CCCCCC;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            }
            th, td 
            {
                padding: 8px;
                text-align: left;
                font-weight: bold;
                border-bottom: 3px solid #061A2D;
            }
            th 
            {
                background-color: #061A2D;
            }
            tr:nth-child(even) 
            {
                background-color: #07223E;
            }
            .container 
            {
                text-align: center;
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Accounts:</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>PERMISSION</th>
                        <th>FIRST NAME</th>
                        <th>LAST NAME</th>
                        <th>EMAIL</th>
                        <th>PASSWORD</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM accounts";
                        $result = mysqli_query($conn, $sql);

                        if ($result->num_rows > 0) 
                        {
                            while($row = $result->fetch_assoc()) 
                            {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["permission"] . "</td>";
                                echo "<td>" . $row["fname"] . "</td>";
                                echo "<td>" . $row["lname"] . "</td>";
                                echo "<td>" . $row["email"] . "</td>";
                                echo "<td>" . $row["password"] . "</td>";
                                echo "</tr>";
                            }
                        } 
                        else 
                        {
                            echo "<tr><td colspan='6'>No entries in 'accounts' table.</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
            <h2>Courses:</h2>
            <table>
                <thead>
                    <tr>
                        <th>CID</th>
                        <th>CNAME</th>
                        <th>LID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM courses";
                        $result = mysqli_query($conn, $sql);

                        if ($result->num_rows > 0) 
                        {
                            while($row = $result->fetch_assoc()) 
                            {
                                echo "<tr>";
                                echo "<td>" . $row["cid"] . "</td>";
                                echo "<td>" . $row["cname"] . "</td>";
                                echo "<td>" . $row["lid"] . "</td>";
                                echo "</tr>";
                            }
                        } 
                        else 
                        {
                            echo "<tr><td colspan='6'>No entries in 'courses' table.</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
            <h2>Enrollment:</h2>
            <table>
                <thead>
                    <tr>
                        <th>CID</th>
                        <th>SID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM enrollment";
                        $result = mysqli_query($conn, $sql);

                        if ($result->num_rows > 0) 
                        {
                            while($row = $result->fetch_assoc()) 
                            {
                                echo "<tr>";
                                echo "<td>" . $row["cid"] . "</td>";
                                echo "<td>" . $row["sid"] . "</td>";
                                echo "</tr>";
                            }
                        } 
                        else 
                        {
                            echo "<tr><td colspan='6'>No entries in 'enrollment' table.</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
            <h2>Questions:</h2>
            <table>
                <thead>
                    <tr>
                        <th>QID</th>
                        <th>CID</th>
                        <th>PROMPT</th>
                        <th>ANSWER</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM questions";
                        $result = mysqli_query($conn, $sql);

                        if ($result->num_rows > 0) 
                        {
                            while($row = $result->fetch_assoc()) 
                            {
                                echo "<tr>";
                                echo "<td>" . $row["qid"] . "</td>";
                                echo "<td>" . $row["cid"] . "</td>";
                                echo "<td>" . $row["prompt"] . "</td>";
                                echo "<td>" . $row["answer"] . "</td>";
                                echo "</tr>";
                            }
                        } 
                        else 
                        {
                            echo "<tr><td colspan='6'>No entries in 'questions' table.</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
            <h2>Scores:</h2>
            <table>
                <thead>
                    <tr>
                        <th>SID</th>
                        <th>CID</th>
                        <th>TOTAL CORRECT</th>
                        <th>TOTAL ASKED</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM scores";
                        $result = mysqli_query($conn, $sql);

                        if ($result->num_rows > 0) 
                        {
                            while($row = $result->fetch_assoc()) 
                            {
                                echo "<tr>";
                                echo "<td>" . $row["sid"] . "</td>";
                                echo "<td>" . $row["cid"] . "</td>";
                                echo "<td>" . $row["totalCorrect"] . "</td>";
                                echo "<td>" . $row["totalAsked"] . "</td>";
                                echo "</tr>";
                            }
                        } 
                        else 
                        {
                            echo "<tr><td colspan='6'>No entries in 'scores' table.</td></tr>";
                        }

                        mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
