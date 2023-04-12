<?php 

class CoursesCreateTest extends PHPUnit\Framework\TestCase
{
  
  public function testCreateCourse()
  {
    require_once realpath(dirname(__FILE__) . '/../../../InstaQuiz (WebApp)/app/pages/courses_create.php');

        // simulate a form submission with a course name
        $_POST['cid'] = 'Test Course';

        // set the request method to POST
        $_SERVER["REQUEST_METHOD"] = "POST";

        // set the user id session variable
        $_SESSION['user_id'] = 1;

        // check if the course name was properly submitted
        $this->assertEquals('Test Course', $_POST['cid']);
    }
}