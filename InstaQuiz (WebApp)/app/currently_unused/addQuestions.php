<?php
    // Include the database credentials
    include __DIR__ . '/../scripts/config.php';
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    } catch (PDOException $e) {
        die("Error connecting to the database: " . $e->getMessage());
    }
    
    // Prepare and execute the SQL query to fetch the correct answers
    $sql = "SELECT answer FROM questions WHERE is_correct = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    // Display the correct answers on the screen
    echo "<h1>Correct Answers:</h1>";
    echo "<ul>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<li>" . $row['answer'] . "</li>";
    }
    echo "</ul>";
    
    ?>