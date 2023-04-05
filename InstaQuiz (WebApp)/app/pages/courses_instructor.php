<?php
    session_start();
    $pageTitle = "Instructor Courses";
    require_once('scripts/config.php');
    $userId = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $courseId = $_POST['cid'];
        $sql = "SELECT C.cid, C.cname, A.fname, A.lname FROM courses C JOIN accounts A ON C.Iid = A.id WHERE C.cid = ".$courseId." AND A.id = ".$userId; 
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $editResult .= "
                <a href='../courses.php'>- Clear Course</a> 
                <div class='course-item'>
                  <h2>{$row['cname']}</h2>
                  <p>Instructor: {$row['fname']} {$row['lname']}</p>
                  <form action='../pages/' method='POST'>
                      <input type='hidden' name='cid' value='{$row['cid']}'>
                      <button class='good-button' type='submit'>??? Start Class ???</button>
                  </form>
                  <form action='../pages/question_create.php' method='POST'>
                      <input type='hidden' name='cid' value='{$row['cid']}'>
                      <button type='submit'>Questions</button>
                  </form>
                  <form action='../pages/' method='POST'>
                      <input type='hidden' name='cid' value='{$row['cid']}'>
                      <button type='submit'>??? Students ???</button>
                  </form>
                </div>";
            }
        } 
        else 
        {
            $editResult = "<div class='success-message'>Error gathering course details, course may no longer exist.</div>";
        }
    } 
    else
    {
        $editResult = "<h3>Course options will appear here when you press edit:</h3>";
    }
?>
<?php
  session_start();
  $userId = $_SESSION['user_id'];

  $sql = "SELECT C.cid, C.cname, A.fname, A.lname FROM courses C JOIN accounts A ON C.Iid = A.id WHERE A.id = '$userId'";
  $result = mysqli_query($conn, $sql);

  if ($result->num_rows > 0) 
  {
    while($row = $result->fetch_assoc()) 
    {
      $enrolledResult .= "
      <div class='course-item'>
        <h2>{$row['cname']}</h2>
        <p>Instructor: {$row['fname']} {$row['lname']}</p>
        <form action='../courses.php' method='POST'>
          <input type='hidden' name='cid' value='{$row['cid']}'>
          <button class='good-button' type='submit'>Edit</button>
        </form>
        <form action='../pages/courses_deleteConf.php' method='POST'>
          <input type='hidden' name='cid' value='{$row['cid']}'>
          <input type='hidden' name='cname' value='{$row['cname']}'>
          <button class='bad-button' type='submit'>Delete</button>
        </form>
      </div>";
    }
  } 
  else 
  {
    $enrolledResult .= "
    <div class='error-message'>
      Oh no! You have not created any courses yet!<br>
      <div class='success-message'>
        Click the 'Create Course' button below to get started!
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
    a
    {
      background-color: #05386B;
      font-size: 28px;
      font-weight: bold;
      font-family: 'Courier New', Courier, monospace;
      text-align: center;
      text-shadow: 0px 3px 3px rgba(0, 0, 0, 0.6);
      text-decoration: none;
      color: #CCCCCC;
      padding: 0.5em;
      border-radius: 15px;
      border-style: solid;
      border-color: #061A2D;
      border-width: 5px;
      transition: background-color 0.3s ease;
    }
    a:hover 
    {
      background-color: red;
    }
    .new-course-button
    {
      background-color: #05386B;
      font-size: 28px;
      font-weight: bold;
      font-family: 'Courier New', Courier, monospace;
      text-align: center;
      text-shadow: 0px 3px 3px rgba(0, 0, 0, 0.6);
      padding: 0.5em;
      border-radius: 15px;
      border-style: solid;
      border-color: #061A2D;
      border-width: 5px;
      transition: background-color 0.3s ease;
    }
    .new-course-button:hover 
    {
      background-color: green;
      color: #CCCCCC;
    }
  </style>
</head>
<body>
  <?php include_once('header.php'); ?>
    <div class="container">
        <div class="left-form-top">
            <h2>Your Courses:</h2>
        </div>
        <div class="right-form-top">
            <h2>Edit Course:</h2>
        </div>
        <div class='left-form-bottom'>
          <form action='pages/courses_create.php' method='POST'>
            <input type='hidden' name='cid' value='{$row['cid']}'>
            <button class='new-course-button' type='submit'>+ New Course</button>
          </form>
          <?php echo $enrolledResult; ?>
        </div>
        <div class='right-form-bottom'>
            <?php 
                if (isset($_SESSION['result_message'])) 
                {
                    echo $_SESSION['result_message'];
                    unset($_SESSION['result_message']);
                } 
                echo $editResult; 
            ?>
        </div>
    </div>
</body>
</html>

