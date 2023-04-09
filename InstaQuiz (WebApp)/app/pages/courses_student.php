<?php
  session_start();
  $pageTitle = "Student Courses";
  require_once('../scripts/config.php');
  $userId = $_SESSION['user_id'];

  $searchResult = '';
  $search = isset($_GET['search']) ? $_GET['search'] : '';

  $sql = "SELECT C.cid, C.cname, A.fname, A.lname 
          FROM courses C 
          INNER JOIN accounts A ON C.Iid = A.id 
          LEFT JOIN enrollment E ON C.cid = E.cid AND E.sid = '$userId'
          WHERE (C.cname LIKE '%$search%' OR CONCAT(A.fname, ' ', A.lname) LIKE '%$search%')
          AND E.sid IS NULL";

  $result = mysqli_query($conn, $sql);

  if ($result->num_rows > 0) 
  {
    while($row = $result->fetch_assoc()) 
    {
      $searchResult .= "
      <div class='course-item'>
        <h2>{$row['cname']}</h2>
        <p>Instructor: {$row['fname']} {$row['lname']}</p>
        <form action='../scripts/student_enroll.php' method='POST'>
          <input type='hidden' name='cid' value='{$row['cid']}'>
          <button class='good-button' type='submit'>Enroll</button>
        </form>
      </div>"; 
    }
  } 
  else 
  {
    $searchResult = '<div class="error-message">There are no available courses.</div>';
  }
?>
<?php
  session_start();
  $userId = $_SESSION['user_id'];
  $enrolledResult = '';

  $sql = "SELECT C.cid, C.cname, A.fname, A.lname FROM courses C JOIN accounts A ON C.Iid = A.id JOIN enrollment E ON C.cid = E.cid WHERE E.sid = '$userId'";
  $result = mysqli_query($conn, $sql);

  if ($result->num_rows > 0) 
  {
    while($row = $result->fetch_assoc()) 
    {
      $enrolledResult .= "
      <div class='course-item'>
        <a href='course_view.php?cid={$row['cid']}'><h2>{$row['cname']}</h2></a>
        <p>Instructor: {$row['fname']} {$row['lname']}</p>
        <button class='good-button' type='submit'>Join???</button>

        <form action='courses_unenrollConf.php' method='POST'>

          <input type='hidden' name='cid' value='{$row['cid']}'>
          <input type='hidden' name='cname' value='{$row['cname']}'>
          <button class='bad-button' type='submit'>Unenroll</button>
        </form>
      </div>";
    }
  } 
  else 
  {
    $enrolledResult .= "
    <div class='error-message'>
      You are not currently enrolled in any courses.<br>
      <div class='success-message'>
        Search for a course on the left to get started!
      </div>
    </div>";
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>InstaQuiz</title>
  <link rel="stylesheet" href="../css/body.css">
  <link rel="stylesheet" href="../css/courses_student.css">
  
  <style>
    a:link {
      color: white;
    }
    a:visited {
      color: white;
    }
    .success-message, .error-message
    {
      text-align: center;
      margin-bottom: 1em;
    }
    .right-form-bottom
    {
      grid-area: "d";
      align-self: flex-start;
      justify-self: stretch;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-items: flex-start;
      align-content: center;
      justify-content: flex-start;
      padding: 1em;
      background-color: #07223E;
      border-radius: 15px;
      border-style: solid;
      border-color: #061A2D;
      border-width: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }
    h3
    {
      font-size: 18px;
      font-weight: lighter;
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-self: flex-start;
      align-self: center;
    }
  </style>
</head>
<body>
    <?php include_once('../header.php'); ?>
    <div class="container">
        <div class="left-form-top">
            <form method="get">
                <div class="search-container">
                    <input type="text" name="search" placeholder="Search for a course...">
                    <button type="submit">Search</button>
                </div>
            </form>
        </div>
        <div class="right-form-top">
            <h2>Enrolled Courses:</h2>
        </div>
        <div class='left-form-bottom'>
          <h3>Search for courses by title, or instructor's name:<br>(Courses you are already enrolled in have been filtered out.)</h3>
          <?php 
            echo $searchResult; 
          ?>
        </div>
        <div class='right-form-bottom'>
          <h3>These are courses you are currently enrolled in:<br>Search for new courses to join on the left!</h3>
          <?php 
            if (isset($_SESSION['result_message'])) 
            {
                echo $_SESSION['result_message'];
                unset($_SESSION['result_message']);
            }
            echo $enrolledResult; 
          ?>
        </div>
    </div>
</body>
</html>

