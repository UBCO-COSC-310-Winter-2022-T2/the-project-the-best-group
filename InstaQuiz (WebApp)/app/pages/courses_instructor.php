<?php
    session_start();
    $pageTitle = "Instructor Courses";
    require_once('scripts/config.php');
    include_once('header.php');
    $userId = $_SESSION['user_id'];
    $editResult = '';
    $courseId = '0';

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
                <div class='course-item'>
                    <h2>{$row['cname']}</h2>
                    <p>Instructor: {$row['fname']} {$row['lname']}</p>
                    <form action='../pages/question_create.php' method='POST'>
                        <input type='hidden' name='cid' value='{$row['cid']}'>
                        <button class='good-button' type='submit'>Add Question</button>
                    </form>
                </div>
                <a href='../courses.php'>Clear Selected Course</a>"; 
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
  $enrolledResult = '';

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
        <form action='../courses.php' method='POST'>
          <input type='hidden' name='cid' value='{$row['cid']}'>
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
  <title>InstaQuiz Instructor Courses</title>
  <link rel="stylesheet" href="../css/body.css">
  <link rel="stylesheet" href="../css/courses_student.css">
  <style>
    .right-form-top
    {
        grid-area: "c";
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-items: center;
        background-color: transparent;
    }
    a 
    {
        font-family: 'Courier New', Courier, monospace;
        background-color: transparent;
        text-decoration: none;
        border: none;
        border-radius: 7px;
        outline: none;
        cursor: pointer;
        padding: 10px;
        margin: 0;
        font-size: 18px;
        font-weight: bold;
        color: #CCCCCC;
        transition: background-color 0.3s ease;
        text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.6);
    }
    a:hover 
    {
        background-color: #F64C72;
        color: #CCCCCC;
    }
  </style>
</head>
<body>
    <div class="container">
        <div class="left-form-top">
            <h2>Your Courses:</h2>
        </div>
        <div class="right-form-top">
            <h2>Edit Course:</h2>
        </div>
        <div class='left-form-bottom'>
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

