<?php
  session_start();
  $pageTitle = "Student Courses";
  require_once 'scripts/config.php';
  include_once 'header.php';
  $userId = $_SESSION['userId'];

  $searchResult = '';
  $search = isset($_GET['search']) ? $_GET['search'] : '';

  $sql = "SELECT C.cid, C.cname, A.fname, A.lname FROM courses C INNER JOIN accounts A ON C.Iid = A.id WHERE C.cname LIKE '%$search%'";
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
    $searchResult = '<div class="error-message">There are no courses by that name.</div>';
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
        <h2>{$row['cname']}</h2>
        <p>Instructor: {$row['fname']} {$row['lname']}</p>
        <button class='good-button' type='submit'>Join???</button>
        <form action='../scripts/student_unenroll.php' method='POST'>
          <input type='hidden' name='cid' value='{$row['cid']}'>
          <button class='bad-button' type='submit'>Drop Course</button>
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
  <title>InstaQuiz Student Courses</title>
  <link rel="stylesheet" href="../css/body.css">
  <link rel="stylesheet" href="../css/courses_student.css">
</head>
<body>
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
            Currently Enrolled In:
        </div>
        <div class='left-form-bottom'>
            <?php echo $searchResult; ?>
        </div>
        <div class='right-form-bottom'>
            <?php echo $enrolledResult; ?>
        </div>
    </div>
</body>
</html>

