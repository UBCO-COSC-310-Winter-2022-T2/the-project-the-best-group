<!DOCTYPE html>
<html>
  <head>
    <title>Account Table</title>
    <style>
      /* Define some basic CSS styles for the page */
      body {
        background-color: navy;
        color: white;
        font-family: Arial, sans-serif;
      }
      #container {
        margin: 0 auto;
        max-width: 800px;
        text-align: center;
        padding: 20px;
      }
      h1 {
        margin-top: 0;
      }
      table {
        border-collapse: collapse;
        margin: 20px 0;
        width: 100%;
      }
      th,
      td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
      }
      th {
        background-color: navy;
      }
      button {
        background-color: white;
        border: none;w
        border-radius: 4px;
        color: navy;
        font-size: 16px;
        margin: 10px;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
      }
      button:hover {
        background-color: #f2f2f2;
        color: navy;
      }
    </style>
  </head>

  <body>
    <div id="container">
      <h1>InstaQuiz</h1>
      <button>Login</button>
      <button>Register</button>

      <?php
      $service = "db";             // service name
      $username = "admin";         // username
      $password = "310adminpw";    // password
      $database = "instaquiz";     // database name
      $table = "account";          // table name
      $port = 3306;                // port number

      $connect = mysqli_connect($service, $username, $password, $database, $port);
      $query = "SELECT * FROM $table";
      $response = mysqli_query($connect, $query);

      echo "<h2>$table:</h2>";
      echo "<table>";
      echo "<tr><th>Account ID</th><th>Permission</th><th>First Name</th><th>Last Name</th><th>E-mail</th><th>Password</th></tr>";

      while ($i = mysqli_fetch_assoc($response)) {
          echo "<tr>";
          echo "<td>".$i['id']."</td>";
          echo "<td>".$i['permission']."</td>";
          echo "<td>".$i['fname']."</td>";
          echo "<td>".$i['lname']."</td>";
          echo "<td>".$i['email']."</td>";
          echo "<td>".$i['password']."</td>";
          echo "</tr>";
      }

      echo "</table>";
      ?>
    </div>
  </body>
</html>
