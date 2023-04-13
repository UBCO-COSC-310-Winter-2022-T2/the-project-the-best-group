<?php
    session_start();
    $pageTitle = "Instructor Courses";
    require_once('../scripts/config.php');
    $userId = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $_SESSION['cid'] = $_POST['cid'];
        $cid = $_SESSION['cid'];
        $sql = "SELECT C.cid, C.cname, A.fname, A.lname FROM courses C JOIN accounts A ON C.Iid = A.id WHERE C.cid = ".$cid." AND A.id = ".$userId; 
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) 
        {
          while($row = $result->fetch_assoc()) 
          {
            $editResult .= "
            <div class='big-button'>
              <a href='../courses.php'>- Clear Course</a> 
            </div>
            <div class='course-item'>
              <div class='course-title'>
                {$row['cname']}
              </div>
              <hr width='100%' color='#061A2D' style='border: 2px solid #061A2D;'>
              <p>Instructor: {$row['fname']} {$row['lname']}</p>
              <form action='questions.php'>
                  <button class='pink-button'>Questions</button>
              </form>
              <form action='students.php'>
                  <button class='pink-button'>Students</button>
              </form>
            </div>";
          }
        } 
        else 
        {
            $editResult = "<div class='red-message'>Error gathering course details, course may no longer exist.</div>";
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
        <div class='course-title'>
          {$row['cname']}
        </div>
        <hr width='100%' color='#061A2D' style='border: 2px solid #061A2D;'>
        <p>Instructor: {$row['fname']} {$row['lname']}</p>
        <form action='../scripts/start_class.php' method='POST'>
          <input type='hidden' name='cid' value='{$row['cid']}'>
          <button class='green-button' >Start Class</button>
        </form>
        <form action='courses_instructor.php' method='POST'>
          <input type='hidden' name='cid' value='{$row['cid']}'>
          <button class='pink-button' type='submit'>View Options</button>
        </form>
        <form action='courses_deleteConf.php' method='POST'>
          <input type='hidden' name='cid' value='{$row['cid']}'>
          <input type='hidden' name='cname' value='{$row['cname']}'>
          <button class='red-button' type='submit'>Delete Course</button>
        </form>
      </div>";
    }
  } 
  else 
  {
    $enrolledResult .= "
    <div class='red-message'>
      Oh no! You have not created any courses yet!<br>
      <div class='green-message'>
        Click the 'Create Course' button below to get started!
      </div>
    </div>";
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>InstaQuiz</title>
  <link rel="icon" type="image/png" href="../images/instaquiz_favicon.png">
  <link rel="stylesheet" href="../css/pages_twoColumns.css">
  <style>
    .big-button
    {
      display: flex;
      flex-direction: column;
      justify-self: center;
      align-self: center;
      font-size: 24px;
      font-weight: bold;
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
    button
    {
      font-size: 28px;
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
  <?php include_once('../header.php'); ?>
    <div class="container-page">
        <div class="container-left-header">
            <h1>Your Courses:</h1>
        </div>
        <div class="container-right-header">
            <h1>Edit Course:</h1>
        </div>
        <div class='container-left-body'>
          <form action='courses_create.php' method='POST'>
            <input type='hidden' name='cid' value='{$row['cid']}'>
            <button class='new-course-button' type='submit'>+ New Course</button>
          </form>
          <?php echo $enrolledResult; ?>
        </div>
        <div class='container-right-body'>
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

