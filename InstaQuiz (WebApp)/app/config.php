<?php
    define('SERVERNAME', 'db');
    define('USERNAME', 'admin');
    define('PASSWORD', '310adminpw');
    define('DBNAME', 'instaquiz');


    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);

    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
?>