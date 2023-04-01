<!DOCTYPE html>
<html>
    <head>
        <title>InstaQuiz Accounts</title>
    </head>
    <body>
        <?php
            $host = 'db';
            $user = 'admin';
            $password = '310adminpw';
            $database = 'instaquiz';

            $conn = new mysqli($host, $user, $password, $database);

            if ($conn->connect_error) 
            {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM account";
            $result = $conn->query($sql);

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
                    #use separate .php  for header bar and use <?php include_once 'app/???.php'; ?>.
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
