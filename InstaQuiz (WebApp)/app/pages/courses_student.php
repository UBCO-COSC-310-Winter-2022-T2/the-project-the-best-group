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
      <div class='course-title'>
        {$row['cname']}
      </div>
        <hr width='100%' color='#061A2D' style='border: 2px solid #061A2D;'>
        <p>Instructor: {$row['fname']} {$row['lname']}</p>
        <hr width='100%' color='#061A2D' style='border: 2px solid #061A2D;'>
        <form action='../scripts/student_enroll.php' method='POST'>
          <input type='hidden' name='cid' value='{$row['cid']}'>
          <button class='green-button' type='submit'>Enroll</button>
        </form>
      </div>"; 
    }
  } 
  else 
  {
    $searchResult = '<div class="red-message">There are no available courses.</div>';
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
        <div class='course-title'>
          <a href='course_view.php?cid={$row['cid']}'><h2>{$row['cname']}</h2></a>
        </div>
        <hr width='100%' color='#061A2D' style='border: 2px solid #061A2D;'>
        <p>Instructor: {$row['fname']} {$row['lname']}</p>
        <hr width='100%' color='#061A2D' style='border: 2px solid #061A2D;'>
        <form action='courses_unenrollConf.php' method='POST'>
          <input type='hidden' name='cid' value='{$row['cid']}'>
          <input type='hidden' name='cname' value='{$row['cname']}'>
          <button class='red-button' type='submit'>Unenroll</button>
        </form>
      </div>";
    }
  } 
  else 
  {
    $enrolledResult .= "
    <div class='red-message'>
      You are not currently enrolled in any courses.<br>
      <div class='green-message'>
        Search for a course on the left to get started!
      </div>
    </div>";
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>InstaQuiz</title>
  <link rel="icon" type="image/png" href="../images/instaquiz_favicon.png">
  <link rel="icon" type="image/png" href="../images/instaquiz_favicon.png">
  <link rel="stylesheet" href="../css/pages_twoColumns.css">
  <style>
    .search-container 
    {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
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
        width: 100%;
        font-size: 18px;
        padding: 0.3em;
        font-family: 'Courier New', Courier, monospace;
        border-radius: 10px;
    }
    .search-container button
    {
        font-size: 24px;
        padding: 0.3em;
    }
    .course-item
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
    .course-title
    {
      display: flex;
      flex-direction: column;
      justify-self: center;
      align-self: center;
      font-size: 24px;
      font-weight: bold;
    }
    .course-item button
    {
        font-size: 24px;
    }
    a 
    {
      color: white;
      background-color: #07223E;
      cursor: pointer;
      outline: none;
      padding: 0.5em;
      font-size: 28px;
      font-family: 'Courier New', Courier, monospace;
      font-weight: bold;
      text-decoration: none;
      border: #061A2D;
      border-style: solid;
      border-radius: 15px;
      transition: background-color 0.3s ease;
    }
    a:hover 
    {
      background-color: #F64C72;
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
        <h1>Enrolled Courses:</h1>
    </div>
    <div class='container-left-body'>
        <h3>Search for courses by title, or instructor's name:<br>(Courses you are already enrolled in have been filtered out.)</h3>
        <?php 
        echo $searchResult; 
        ?>
    </div>
    <div class='container-right-body'>
      <?php 
        if (isset($_SESSION['result_message'])) 
        {
            echo $_SESSION['result_message'];
            unset($_SESSION['result_message']);
        } 
      ?>
      <h3>These are courses you are currently enrolled in:<br>Search for new courses to join on the left!<br>(Click course title to visit course page.)</h3>
      <?php echo $enrolledResult; ?>
    </div>
  </div>
</body>
</html>