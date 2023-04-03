<?php
  session_start();
  $pageTitle = "Student Courses";
  require_once 'scripts/config.php';
  include_once 'header.php';
  $userId = $_SESSION['userId'];

  $searchResult = '';

  if ($_SERVER['REQUEST_METHOD'] == "GET") 
  {
    if (isset($_GET['msg'])) 
    {
      $message = $_GET['msg'];

      if ($message == 'exists') {
        $searchResult = '<div class="error-message">You are already enrolled in this course!</div>';
      } else if ($message == 'fail') {
        $searchResult = '<div class="error-message">Error enrolling in course. Please try again.</div>';
      } else if ($message == 'success') {
        $searchResult = '<div class="success-message">Successfully enrolled, good luck!.</div>';
      }
    }

    $search = isset($_GET['search']) ? $_GET['search'] : '';

    $sql = "SELECT C.cid, C.cname, A.fname, A.lname FROM courses C INNER JOIN accounts A ON C.Iid = A.id WHERE C.cname LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc()) 
        {
          $searchResult .=
          "<form class='course-item' method='post'>
          <h1>{$row['cname']}</h1>
          <p>Instructor: {$row['fname']} {$row['lname']}</p>
          <input type='hidden' name='cid' value='{$row['cid']}'>
          <button class='good-button' type='submit'>Enroll</button>
          </form>"; 
        }
    } 
    else 
    {
      $searchResult = '<div class="error-message">There are no courses by that name.</div>';
    }
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
        $enrolledResult .=
        "<form class='course-item' method='post'>
        <h1>{$row['cname']}</h1>
        <p>Instructor: {$row['fname']} {$row['lname']}</p>
        <input type='hidden' name='cid' value='{$row['cid']}'>
        <button class='good-button' type='submit'>Join Class</button>
        <button class='bad-button' type='submit'>Unenroll</button>
        </form>"; 
      }
    } 
    else 
    {
      echo '<div class="error-message">You are not currently enrolled in any courses<br></div>';
      echo '<div class="success-message">Search for a course on the left to get started!</div>';
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
  <section class="container">
    <div class="left">
      <div class='container-form-top'>
        <form method="get">
          <div class="search-container">
            <input type="text" name="search" placeholder="Search for a course...">
            <button type="submit">Search</button>
          </div>
        </form>
      </div>
      <div class='container-form-bottom'>
        <?php echo $searchResult; ?>
      </div>
    </div>
    <div class="right">
      <div class="container-form-top">
        <h1>YOUR COURSES:</h1>
      </div>  
      <div class="container-form-bottom">     
        <?php echo $enrolledResult ?>
      </div>
    </div>
  </section>
</body>
</html>

