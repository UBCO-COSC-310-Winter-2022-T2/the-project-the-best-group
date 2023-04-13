<?php
    session_start();
    $pageTitle = "Database";
    require_once('../scripts/config.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>InstaQuiz</title>
        <link rel="icon" type="image/png" href="../images/instaquiz_favicon.png">
        <link rel="stylesheet" href="../css/body.css">
        <style>
            table 
            {
                justify-self: flex-start;
                align-self: center;
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
                display: flex;
                flex-direction: column;
                justify-self: flex-start;
                align-self: center;
                justify-items: flex-start;
                align-items: center;
                justify-content: flex-start;
                align-content: center;
            }
        </style>
    </head>
    <body>
        <?php include_once('../header.php'); ?>
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
                        <th>RECOVERY TOKEN</th>
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
                                echo "<td>" . $row["rtoken"] . "</td>";
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
                        <th>COURSE ID</th>
                        <th>COURSE NAME</th>
                        <th>INSTRUCTOR ID</th>
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
                                echo "<td>" . $row["Iid"] . "</td>";
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
                        <th>COURSE ID</th>
                        <th>STUDENT ID</th>
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
                        <th>QUESTION ID</th>
                        <th>COURSE ID</th>
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
                        <th>STUDENT ID</th>
                        <th>COURSE ID</th>
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
