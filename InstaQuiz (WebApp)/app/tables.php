<!DOCTYPE html>
<html>
    <head>
        <title>InstaQuiz Database</title>
        <style>
            body 
            {
                color: #CCCCCC;
                background-color: #05386B;
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
        <?php include_once 'header.php'; ?>
        <?php require_once 'config.php'; ?>

        <div class="container">
            <h2>Account:</h2>
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
                        $sql = "SELECT * FROM account";
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
                            echo "<tr><td colspan='6'>No entries in 'account' table.</td></tr>";
                        }

                        $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
