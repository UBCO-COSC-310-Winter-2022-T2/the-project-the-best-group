<!DOCTYPE html>
<html>
    <head>
        <title>InstaQuiz Database</title>
        <style>
            body 
            {
                color: #CCCCCC;
                background-color: #313357;
                font-family: "monospace";
            }
        </style>
    </head>
    <body>
        <?php include_once 'header.php'; ?>
        <?php
            require_once 'config.php';

            $sql = "SELECT * FROM account";
            $result = mysqli_query($conn, $sql);

            if ($result->num_rows > 0) 
            {
                while($row = $result->fetch_assoc()) 
                {
                    echo "ID: " . $row["id"]."</br>";
                    echo "Permission: " . $row["permission"]."</br>"; 
                    echo "First Name: " . $row["fname"]."</br>"; 
                    echo "Last Name: " . $row["lname"]."</br>"; 
                    echo "Email: " . $row["email"]."</br>"; 
                    echo "Password: " . $row["password"]."</br>";
                    #use vardump for object passing.
                    #use separate .php for header bar and use <?php include_once 'app/???.php';
                }
            } 
            else 
            {
                echo "No entries in 'account' table.";
            }

            $conn->close();
        ?>
    </body>
</html>
