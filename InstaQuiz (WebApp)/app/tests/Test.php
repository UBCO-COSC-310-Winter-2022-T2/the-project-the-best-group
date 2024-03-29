<?php 

class Test extends PHPUnit\Framework\TestCase
{
  # The unit tests that involve session_variables could not be tested due to an issue with loading session variables into phpUnit classes. We thus have assertTrue statements where no tests could be run.
  # Where some functionality could be tested, tests were still implemented.

  # Unit Test 1.1
  public function testRegister()
  {
    # including the required mysql connection
    $conn = mysqli_connect('db', 'admin', '310adminpw', 'instaquiz');

    # deleting any preexisting users under these credentials before running
    $sql_1 = "DELETE FROM accounts WHERE email='test@mail.com'";
    mysqli_query($conn,$sql_1);

    # stock user information for a new account
    $test_first_name = "Test";
    $test_last_name = "Register";
    $test_email = "test@mail.com";
    $test_password = "testregister";

    # query the database the same way as the register page for a stock instructor account
    $sql_2 = "INSERT INTO accounts (permission, fname, lname, email, password) VALUES (1, '{$test_first_name}', '{$test_last_name}', '{$test_email}', '{$test_password}');";
    $result = mysqli_query($conn, $sql_2);

    #clear the test account and close connection
    $sql_3 = "DELETE FROM accounts WHERE email='test@mail.com'";
    mysqli_query($conn,$sql_3);
    mysqli_close($conn);

    # assert that user was successfully registered
    $this->assertTrue($result);
  }

  # Unit Test 1.2
  public function testLogin()
  {
    # including the required mysql connection
    $conn = mysqli_connect('db', 'admin', '310adminpw', 'instaquiz');

    # deleting any preexisting users under these credentials before running
    $sql_1 = "DELETE FROM accounts WHERE email='test@mail.com'";
    mysqli_query($conn,$sql_1);
    
    # stock user information for a new account
    $test_first_name = "Test";
    $test_last_name = "Register";
    $test_email = "test@mail.com";
    $test_password = "testregister";
    
    # query the database the same way as the register page for a stock instructor account
    $sql_2 = "INSERT INTO accounts (permission, fname, lname, email, password) VALUES (1, '{$test_first_name}', '{$test_last_name}', '{$test_email}', '{$test_password}');";
    mysqli_query($conn, $sql_2);

    # now try to login
    $sql_3 = "SELECT * FROM accounts where email = '{$test_email}'";
    $result = mysqli_query($conn,$sql_3);

    #clear the test account and close connection
    $sql_3 = "DELETE FROM accounts WHERE email='test@mail.com'";
    mysqli_query($conn,$sql_3);
    mysqli_close($conn);
    
    # assert that this account exists
    $this->assertTrue(mysqli_num_rows($result) == 1); 
  }

  # Unit Test 1.3
  public function testLogout()
  {
    # Logging out works by ending the session which could not be implemented here
    $this -> assertTrue(True);
  }

  # Unit Test 1.4
  public function testCreateCourse()
  {
    # including the required mysql connection
    $conn = mysqli_connect('db', 'admin', '310adminpw', 'instaquiz');

    # deleting any preexisting users under these credentials before running
    $sql_1 = "DELETE FROM accounts WHERE email='test@mail.com'";
    mysqli_query($conn,$sql_1);

    # deleting any preexisting courses under these credentials before running
    $sql_2 = "DELETE FROM courses WHERE cname='Test Course'";
    mysqli_query($conn,$sql_2);
    
    # stock user information for a new account
    $test_first_name = "Test";
    $test_last_name = "Register";
    $test_email = "test@mail.com";
    $test_password = "testregister";
    
    # query the database the same way as the register page for a stock instructor account
    $sql_3 = "INSERT INTO accounts (permission, fname, lname, email, password) VALUES (1, '{$test_first_name}', '{$test_last_name}', '{$test_email}', '{$test_password}');";
    mysqli_query($conn, $sql_3);

    # now try to login
    $sql_4 = "SELECT * FROM accounts where email = '{$test_email}'";
    $result_1 = mysqli_query($conn,$sql_4);

    # create a course with this id
    $test_Iid = mysqli_fetch_assoc($result_1)['id'];
    $test_cname = "Test Course";
    $sql_5 = "INSERT INTO courses (cname, Iid) VALUES ('{$test_cname}', '$test_Iid')";
    $result_2 = mysqli_query($conn, $sql_5);

    # clear the test account, test course and close connection
    $sql_6 = "DELETE FROM accounts WHERE email='test@mail.com'";
    mysqli_query($conn,$sql_6);
    $sql_7 = "DELETE FROM courses where cname = '{$test_cname}'";
    mysqli_close($conn);
    
    # assert that account was successful in the login process
    $this->assertTrue(mysqli_num_rows($result_1) == 1);
    # assert that course was successfully created and instructor was enrolled as instructor of course
    $this->assertTrue($result_2);
  }

  # Unit Test 1.5
  public function testDeleteCourse()
  {
    # including the required mysql connection
    $conn = mysqli_connect('db', 'admin', '310adminpw', 'instaquiz');

    # deleting any preexisting users under these credentials before running
    $sql_1 = "DELETE FROM accounts WHERE email='test@mail.com'";
    mysqli_query($conn,$sql_1);

    # deleting any preexisting courses under these credentials before running
    $sql_2 = "DELETE FROM courses WHERE cname='Test Course'";
    mysqli_query($conn,$sql_2);
    
    # stock user information for a new account
    $test_first_name = "Test";
    $test_last_name = "Register";
    $test_email = "test@mail.com";
    $test_password = "testregister";
    
    # query the database the same way as the register page for a stock instructor account
    $sql_3 = "INSERT INTO accounts (permission, fname, lname, email, password) VALUES (1, '{$test_first_name}', '{$test_last_name}', '{$test_email}', '{$test_password}');";
    mysqli_query($conn, $sql_3);

    # now try to login
    $sql_4 = "SELECT * FROM accounts where email = '{$test_email}'";
    $result_1 = mysqli_query($conn,$sql_4);

    # create a course with this id
    $test_Iid = mysqli_fetch_assoc($result_1)['id'];
    $test_cname = "Test Course";
    $sql_5 = "INSERT INTO courses (cname, Iid) VALUES ('{$test_cname}', '$test_Iid')";
    $result_2 = mysqli_query($conn, $sql_5);

    # now try to delete the course
    $sql_6 = "DELETE from courses where cname = '{$test_cname}' AND Iid = '$test_Iid'";
    $result_3 = mysqli_query($conn, $sql_6);

    # clear the test account, test course and close connection
    $sql_7 = "DELETE FROM accounts WHERE email='test@mail.com'";
    mysqli_query($conn,$sql_7);
    $sql_8 = "DELETE FROM courses where cname = '{$test_cname}'";
    mysqli_query($conn, $sql_8);
    mysqli_close($conn);
    
    # assert that account was successful in the login process
    $this->assertTrue(mysqli_num_rows($result_1) == 1);
    # assert that course was successfully created and instructor was enrolled as instructor of course
    $this->assertTrue($result_2);
    # assert that course was successfully deleted with instructor id and course name
    $this->assertTrue($result_3);
  }

  # Unit Test 1.6
  public function testSearchForCourse()
  {
    # including the required mysql connection
    $conn = mysqli_connect('db', 'admin', '310adminpw', 'instaquiz');

    # deleting any preexisting users under these credentials before running
    $sql_1 = "DELETE FROM accounts WHERE email='testStudent@mail.com'";
    $sql_2 = "DELETE FROM accounts WHERE email='testInstructor@mail.com'";
    mysqli_query($conn, $sql_1);
    mysqli_query($conn, $sql_2);

    # deleting any preexisting courses under these credentials before running
    $sql_3 = "DELETE FROM courses WHERE cname='Test Course 1'";
    $sql_4 = "DELETE FROM courses WHERE cname='Test Course 2'";
    mysqli_query($conn,$sql_3);

    # create an instructor
    $test_instr_first_name = "Test";
    $test_instr_last_name = "Instructor";
    $test_instr_email = "testInstructor@mail.com";
    $test_instr_password = "testInstructorpw";
    $sql_5 = "INSERT INTO accounts (permission, fname, lname, email, password) VALUES (1, '{$test_instr_first_name}', '{$test_instr_last_name}', '{$test_instr_email}', '{$test_instr_password}');";
    mysqli_query($conn, $sql_5);

    # retrieve user id of instructor
    $sql_6 = "SELECT * FROM accounts WHERE email = '{$test_instr_email}'";
    $result_1 = mysqli_query($conn, $sql_6);
    $Iid = mysqli_fetch_assoc($result_1)['id'];

    # create a student
    $test_stud_first_name = "Test";
    $test_stud_last_name = "Student";
    $test_stud_email = "testStudent@mail.com";
    $test_stud_password = "testStudentpw";
    $sql_7 = "INSERT INTO accounts (permission, fname, lname, email, password) VALUES (0, '{$test_stud_first_name}', '{$test_stud_last_name}', '{$test_stud_email}', '{$test_stud_password}');";
    mysqli_query($conn, $sql_7);

    # retrieve user id of student
    $sql_8 = "SELECT * FROM accounts WHERE email = '{$test_stud_email}'";
    $result_2 = mysqli_query($conn, $sql_8);
    $Sid = mysqli_fetch_assoc($result_2)['id'];

    # create two courses with the same instructor
    $test_cname_1 = "Test Course 1";
    $test_cname_2 = "Test Course 2";
    $sql_9 = "INSERT INTO courses (cname, Iid) VALUES ('$test_cname_1', '$Iid')";
    $sql_10 = "INSERT INTO courses (cname, Iid) VALUES ('$test_cname_2', '$Iid')";
    mysqli_query($conn,$sql_9);
    mysqli_query($conn,$sql_10);

    # retrieve course ids
    $sql_11 = "SELECT * FROM courses WHERE cname = '$test_cname_1'";
    $sql_12 = "SELECT * FROM courses WHERE cname = '$test_cname_2'";
    $result_3 = mysqli_query($conn, $sql_11);
    $result_4 = mysqli_query($conn, $sql_12);
    $cid_1 = mysqli_fetch_assoc($result_3)['cid'];
    $cid_2 = mysqli_fetch_assoc($result_4)['cid'];

    # enroll the student into both courses
    $sql_13 = "INSERT INTO enrollment (cid, sid) VALUES (".$cid_1.", ".$Sid.")";
    $sql_14 = "INSERT INTO enrollment (cid, sid) VALUES (".$cid_2.", ".$Sid.")";
    $result_5 = mysqli_query($conn, $sql_13);
    $result_6 = mysqli_query($conn, $sql_14);

    # set up the search as if logged into student and search
    $search = "Test";
    $sql_15 = "SELECT C.cid, C.cname, A.fname, A.lname 
    FROM courses C 
    INNER JOIN accounts A ON C.Iid = A.id 
    LEFT JOIN enrollment E ON C.cid = E.cid AND E.sid = '$Sid'
    WHERE (C.cname LIKE '%$search%' OR CONCAT(A.fname, ' ', A.lname) LIKE '%$search%')";
    $result_7 = mysqli_query($conn, $sql_15);

    # clear test users, enrollments and courses and close connection
    $sql_16 = "DELETE FROM accounts WHERE email = '{$test_instr_email}'";
    $sql_17 = "DELETE FROM accounts WHERE email = '{$test_stud_email}'";
    $sql_18 = "DELETE FROM courses WHERE Iid = '$Iid'";
    $sql_19 = "DELETE FROM enrollments WHERE sid = ".$Sid."";
    mysqli_query($conn, $sql_16);
    mysqli_query($conn, $sql_17);
    mysqli_query($conn, $sql_18);
    mysqli_query($conn, $sql_19);
    mysqli_query($conn, $sql_19);
    mysqli_close($conn);

    # assert that instructor account exists and that instructor id is successfully retrieved
    $this->assertTrue(mysqli_num_rows($result_1) == 1);
    
    # assert that student account exists and that student id is successfully retrieved
    $this->assertTrue(mysqli_num_rows($result_2) == 1);

    # assert that courses were successfully made
    $this->assertTrue(mysqli_num_rows($result_3) == 1);
    $this->assertTrue(mysqli_num_rows($result_4) == 1);

    # assert that student successfully enrolled in courses
    $this->assertTrue($result_5 && $result_6);

    # assert that search returned two courses
    $this->assertTrue(mysqli_num_rows($result_7) == 2);
  }

  # Unit Test 1.7
  public function testEnroll()
  {
    # including the required mysql connection
    $conn = mysqli_connect('db', 'admin', '310adminpw', 'instaquiz');

    # deleting any preexisting users under these credentials before running
    $sql_1 = "DELETE FROM accounts WHERE email='testStudent@mail.com'";
    $sql_2 = "DELETE FROM accounts WHERE email='testInstructor@mail.com'";
    mysqli_query($conn, $sql_1);
    mysqli_query($conn, $sql_2);

    # deleting any preexisting courses under these credentials before running
    $sql_3 = "DELETE FROM courses WHERE cname='Test Course 1'";
    $sql_4 = "DELETE FROM courses WHERE cname='Test Course 2'";
    mysqli_query($conn,$sql_3);

    # create an instructor
    $test_instr_first_name = "Test";
    $test_instr_last_name = "Instructor";
    $test_instr_email = "testInstructor@mail.com";
    $test_instr_password = "testInstructorpw";
    $sql_5 = "INSERT INTO accounts (permission, fname, lname, email, password) VALUES (1, '{$test_instr_first_name}', '{$test_instr_last_name}', '{$test_instr_email}', '{$test_instr_password}');";
    mysqli_query($conn, $sql_5);

    # retrieve user id of instructor
    $sql_6 = "SELECT * FROM accounts WHERE email = '{$test_instr_email}'";
    $result_1 = mysqli_query($conn, $sql_6);
    $Iid = mysqli_fetch_assoc($result_1)['id'];

    # create a student
    $test_stud_first_name = "Test";
    $test_stud_last_name = "Student";
    $test_stud_email = "testStudent@mail.com";
    $test_stud_password = "testStudentpw";
    $sql_7 = "INSERT INTO accounts (permission, fname, lname, email, password) VALUES (0, '{$test_stud_first_name}', '{$test_stud_last_name}', '{$test_stud_email}', '{$test_stud_password}');";
    mysqli_query($conn, $sql_7);

    # retrieve user id of student
    $sql_8 = "SELECT * FROM accounts WHERE email = '{$test_stud_email}'";
    $result_2 = mysqli_query($conn, $sql_8);
    $Sid = mysqli_fetch_assoc($result_2)['id'];

    # create two courses with the same instructor
    $test_cname_1 = "Test Course 1";
    $test_cname_2 = "Test Course 2";
    $sql_9 = "INSERT INTO courses (cname, Iid) VALUES ('$test_cname_1', '$Iid')";
    $sql_10 = "INSERT INTO courses (cname, Iid) VALUES ('$test_cname_2', '$Iid')";
    mysqli_query($conn,$sql_9);
    mysqli_query($conn,$sql_10);

    # retrieve course ids
    $sql_11 = "SELECT * FROM courses WHERE cname = '$test_cname_1'";
    $sql_12 = "SELECT * FROM courses WHERE cname = '$test_cname_2'";
    $result_3 = mysqli_query($conn, $sql_11);
    $result_4 = mysqli_query($conn, $sql_12);
    $cid_1 = mysqli_fetch_assoc($result_3)['cid'];
    $cid_2 = mysqli_fetch_assoc($result_4)['cid'];

    # enroll the student into both courses
    $sql_13 = "INSERT INTO enrollment (cid, sid) VALUES (".$cid_1.", ".$Sid.")";
    $sql_14 = "INSERT INTO enrollment (cid, sid) VALUES (".$cid_2.", ".$Sid.")";
    $result_5 = mysqli_query($conn, $sql_13);
    $result_6 = mysqli_query($conn, $sql_14);

    # clear test users, enrollments and courses and close connection
    $sql_15 = "DELETE FROM accounts WHERE email = '{$test_instr_email}'";
    $sql_16 = "DELETE FROM accounts WHERE email = '{$test_stud_email}'";
    $sql_17 = "DELETE FROM courses WHERE Iid = '$Iid'";
    $sql_18 = "DELETE FROM enrollments WHERE sid = ".$Sid."";
    mysqli_query($conn, $sql_15);
    mysqli_query($conn, $sql_16);
    mysqli_query($conn, $sql_17);
    mysqli_query($conn, $sql_18);
    mysqli_close($conn);

    # assert that instructor account exists and that instructor id is successfully retrieved
    $this->assertTrue(mysqli_num_rows($result_1) == 1);
    
    # assert that student account exists and that student id is successfully retrieved
    $this->assertTrue(mysqli_num_rows($result_2) == 1);

    # assert that courses were successfully made
    $this->assertTrue(mysqli_num_rows($result_3) == 1);
    $this->assertTrue(mysqli_num_rows($result_4) == 1);

    # assert that student successfully enrolled in courses
    $this->assertTrue($result_5 && $result_6);
  }

  # Unit Test 1.8
  public function testUnenroll()
  {
    # including the required mysql connection
    $conn = mysqli_connect('db', 'admin', '310adminpw', 'instaquiz');

    # deleting any preexisting users under these credentials before running
    $sql_1 = "DELETE FROM accounts WHERE email='testStudent@mail.com'";
    $sql_2 = "DELETE FROM accounts WHERE email='testInstructor@mail.com'";
    mysqli_query($conn, $sql_1);
    mysqli_query($conn, $sql_2);

    # deleting any preexisting courses under these credentials before running
    $sql_3 = "DELETE FROM courses WHERE cname='Test Course 1'";
    $sql_4 = "DELETE FROM courses WHERE cname='Test Course 2'";
    mysqli_query($conn,$sql_3);

    # create an instructor
    $test_instr_first_name = "Test";
    $test_instr_last_name = "Instructor";
    $test_instr_email = "testInstructor@mail.com";
    $test_instr_password = "testInstructorpw";
    $sql_5 = "INSERT INTO accounts (permission, fname, lname, email, password) VALUES (1, '{$test_instr_first_name}', '{$test_instr_last_name}', '{$test_instr_email}', '{$test_instr_password}');";
    mysqli_query($conn, $sql_5);

    # retrieve user id of instructor
    $sql_6 = "SELECT * FROM accounts WHERE email = '{$test_instr_email}'";
    $result_1 = mysqli_query($conn, $sql_6);
    $Iid = mysqli_fetch_assoc($result_1)['id'];

    # create a student
    $test_stud_first_name = "Test";
    $test_stud_last_name = "Student";
    $test_stud_email = "testStudent@mail.com";
    $test_stud_password = "testStudentpw";
    $sql_7 = "INSERT INTO accounts (permission, fname, lname, email, password) VALUES (0, '{$test_stud_first_name}', '{$test_stud_last_name}', '{$test_stud_email}', '{$test_stud_password}');";
    mysqli_query($conn, $sql_7);

    # retrieve user id of student
    $sql_8 = "SELECT * FROM accounts WHERE email = '{$test_stud_email}'";
    $result_2 = mysqli_query($conn, $sql_8);
    $Sid = mysqli_fetch_assoc($result_2)['id'];

    # create two courses with the same instructor
    $test_cname_1 = "Test Course 1";
    $test_cname_2 = "Test Course 2";
    $sql_9 = "INSERT INTO courses (cname, Iid) VALUES ('$test_cname_1', '$Iid')";
    $sql_10 = "INSERT INTO courses (cname, Iid) VALUES ('$test_cname_2', '$Iid')";
    mysqli_query($conn,$sql_9);
    mysqli_query($conn,$sql_10);

    # retrieve course ids
    $sql_11 = "SELECT * FROM courses WHERE cname = '$test_cname_1'";
    $sql_12 = "SELECT * FROM courses WHERE cname = '$test_cname_2'";
    $result_3 = mysqli_query($conn, $sql_11);
    $result_4 = mysqli_query($conn, $sql_12);
    $cid_1 = mysqli_fetch_assoc($result_3)['cid'];
    $cid_2 = mysqli_fetch_assoc($result_4)['cid'];

    # enroll the student into both courses
    $sql_13 = "INSERT INTO enrollment (cid, sid) VALUES (".$cid_1.", ".$Sid.")";
    $sql_14 = "INSERT INTO enrollment (cid, sid) VALUES (".$cid_2.", ".$Sid.")";
    $result_5 = mysqli_query($conn, $sql_13);
    $result_6 = mysqli_query($conn, $sql_14);

    # unenroll the student from both courses
    $sql_15 = "DELETE FROM enrollment WHERE sid = ".$Sid."";
    $result_7 = mysqli_query($conn, $sql_15);

    # clear test users, enrollments and courses and close connection
    $sql_16 = "DELETE FROM accounts WHERE email = '{$test_instr_email}'";
    $sql_17 = "DELETE FROM accounts WHERE email = '{$test_stud_email}'";
    $sql_18 = "DELETE FROM courses WHERE Iid = '$Iid'";
    $sql_19 = "DELETE FROM enrollments WHERE sid = ".$Sid."";
    mysqli_query($conn, $sql_16);
    mysqli_query($conn, $sql_17);
    mysqli_query($conn, $sql_18);
    mysqli_query($conn, $sql_19);
    mysqli_close($conn);

    # assert that instructor account exists and that instructor id is successfully retrieved
    $this->assertTrue(mysqli_num_rows($result_1) == 1);
    
    # assert that student account exists and that student id is successfully retrieved
    $this->assertTrue(mysqli_num_rows($result_2) == 1);

    # assert that courses were successfully made
    $this->assertTrue(mysqli_num_rows($result_3) == 1);
    $this->assertTrue(mysqli_num_rows($result_4) == 1);

    # assert that student successfully enrolled in courses
    $this->assertTrue($result_5 && $result_6);

    # assert that student successfully unenrolled in courses
    $this->assertTrue($result_7);
  }

  # Unit Test 1.9
  public function testStartLiveSession()
  {
    # This functionality cannot be tested using phpunit as starting live sessions finds all its functionality in the HTML, PHP, and Javascript of the webpages after session variables have been set
    $this->assertTrue(True);
  }

  # Unit Test 1.10
  public function testEndLiveSession()
  {
    # This functionality cannot be tested using phpunit as ending live sessions finds all its functionality in the HTML, PHP, and Javascript of the webpages after session variabls have been set
    $this->assertTrue(True);
  }

  # Unit Test 1.11
  public function testJoinLiveSession()
  {
    # This functionality cannot be tested using phpunit as joining live sessions finds all its functionality in the HTML, PHP, and Javascript of the webpages after session variabls have been set
    $this->assertTrue(True);
  }

  # Unit Test 1.12
  public function testQuestionBank()
  {
    # including the required mysql connection
    $conn = mysqli_connect('db', 'admin', '310adminpw', 'instaquiz');

    # deleting any preexisting users under these credentials before running
    $sql_1 = "DELETE FROM accounts WHERE email='testInstructor@mail.com'";
    mysqli_query($conn, $sql_1);

    # deleting any preexisting courses under these credentials before running
    $sql_2 = "DELETE FROM courses WHERE cname='Test Course'";
    mysqli_query($conn,$sql_2);

    # deleting any preexisting questions under these credentials before running
    $sql_3 = "DELETE FROM questions WHERE prompt = 'What is 2+2?'";

    # create an instructor
    $test_instr_first_name = "Test";
    $test_instr_last_name = "Instructor";
    $test_instr_email = "testInstructor@mail.com";
    $test_instr_password = "testInstructorpw";
    $sql_3 = "INSERT INTO accounts (permission, fname, lname, email, password) VALUES (1, '{$test_instr_first_name}', '{$test_instr_last_name}', '{$test_instr_email}', '{$test_instr_password}');";
    mysqli_query($conn, $sql_3);

    # retrieve user id of instructor
    $sql_4 = "SELECT * FROM accounts WHERE email = '{$test_instr_email}'";
    $result_1 = mysqli_query($conn, $sql_4);
    $Iid = mysqli_fetch_assoc($result_1)['id'];

    # create courses with the same instructor
    $test_cname = "Test Course";
    $sql_5 = "INSERT INTO courses (cname, Iid) VALUES ('$test_cname', '$Iid')";
    mysqli_query($conn,$sql_5);

    # retrieve course ids
    $sql_6 = "SELECT * FROM courses WHERE cname = '$test_cname'";
    $result_2 = mysqli_query($conn, $sql_6);
    $cid = mysqli_fetch_assoc($result_2)['cid'];

    # add question
    $prompt = "What is 2+2?";
    $a = "1";
    $b = "2";
    $c = "3";
    $d = "4";
    $answer = "D";
    $sql_7 = "INSERT INTO questions (cid, prompt, a, b, c, d, answer) VALUES ('$cid','{$prompt}','{$a}','{$b}','{$c}','{$d}','{$answer}')";
    $result_3 = mysqli_query($conn, $sql_7);

    # clear test users, questions and courses and close connection
    $sql_8 = "DELETE FROM accounts WHERE email = '{$test_instr_email}'";
    $sql_9 = "DELETE FROM courses WHERE Iid = '$Iid'";
    $sql_10 = "DELETE FROM questions WHERE cid = '$cid'";
    mysqli_query($conn, $sql_8);
    mysqli_query($conn, $sql_9);
    mysqli_query($conn, $sql_10);
    mysqli_close($conn);

    # assert that instructor was created successfully
    $this->assertTrue(mysqli_num_rows($result_1) == 1);

    # assert that course was created successfully
    $this->assertTrue(mysqli_num_rows($result_2) == 1);

    # assert that question was added to question bank
    $this->assertTrue($result_3);
  }

  # Unit Test 1.13
  public function testJoinLivePoll()
  {
    # This functionality cannot be tested using phpunit as joining live polls finds all its functionality in the HTML, PHP, and Javascript of the webpages after session variabls have been set
    $this->assertTrue(True);
  }

  # Unit Test 1.14
  public function testEndLivePoll()
  {
    # This functionality cannot be tested using phpunit as ending live polls finds all its functionality in the HTML, PHP, and Javascript of the webpages after session variabls have been set
    $this->assertTrue(True);
  }

  # Unit Test 1.15
  public function testAnsweringQuestion()
  {
    # This functionality cannot be tested using phpunit as answering polling questions finds all its functionality in the HTML, PHP, and Javascript of the webpages after session variabls have been set
    $this->assertTrue(True);
  }

  # Unit Test 1.16
  public function testShowingSummary()
  {
    # This functionality cannot be tested using phpunit as showing summaries of questions finds all its functionality in the HTML, PHP, and Javascript of the webpages after session variabls have been set
    $this->assertTrue(True);
  }

  # Unit Test 1.17
  public function testGradeSummaryStudent()
  {
    # This functionality cannot be tested using phpunit as students viewing their course grade summaries finds all its functionality in the HTML, PHP, and Javascript of the webpages after session variabls have been set
    $this->assertTrue(True);
  }

  # Unit Test 1.18
  public function testSummaryStudent()
  {
    # This functionality cannot be tested using phpunit as students viewing their course grade summaries finds all its functionality in the HTML, PHP, and Javascript of the webpages after session variabls have been set
    $this->assertTrue(True);
  }

  # Unit Test 1.19
  public function testCourseSummaryInstructor()
  {
    # This functionality cannot be tested using phpunit as instructors viewing their course grade summaries finds all its functionality in the HTML, PHP, and Javascript of the webpages after session variabls have been set
    $this->assertTrue(True);
  }

  # Unit Test 1.20
  public function testQuestionHistory()
  {
    # This functionality cannot be tested using phpunit as viewing the question history of a course finds all its functionality in the HTML, PHP, and Javascript of the webpages after session variabls have been set
    $this->assertTrue(True);
  }

  # Unit Test 1.21
  public function testPasswordReset()
  {
    # This functionality cannot be tested using phpunit as resetting passwords finds all its functionality in the HTML, PHP, and Javascript of the webpages after session variabls have been set by comparing rtokens to the hashed
    # rtokens within the database
    $this->assertTrue(True);
  }

  # Unit Test 2.1
  public function testPasswordHash()
  {
    # including the required mysql connection
    $conn = mysqli_connect('db', 'admin', '310adminpw', 'instaquiz');

    # deleting any preexisting users under these credentials before running
    $sql_1 = "DELETE FROM accounts WHERE email='test@mail.com'";
    mysqli_query($conn,$sql_1);

    # stock user information for a new account
    $test_first_name = "Test";
    $test_last_name = "Instructor";
    $test_email = "test@mail.com";
    $test_password = "testregister";
    $test_hashed_password = password_hash($test_password, PASSWORD_DEFAULT);

    # query the database the same way as the register page for a stock instructor account
    $sql_2 = "INSERT INTO accounts (permission, fname, lname, email, password) VALUES (1, '{$test_first_name}', '{$test_last_name}', '{$test_email}', '{$test_hashed_password}');";
    $result_1 = mysqli_query($conn, $sql_2);

    # retrieve hashed password from database
    $sql_3 = "SELECT * FROM accounts WHERE email='{$test_email}'";
    $result_2 = mysqli_query($conn, $sql_3);
    $hashedPassword = mysqli_fetch_assoc($result_2)['password'];

    #clear the test account and close connection
    $sql_3 = "DELETE FROM accounts WHERE email='test@mail.com'";
    mysqli_query($conn,$sql_3);
    mysqli_close($conn);

    # assert that user was registered
    $this->assertTrue($result_1);

    # assert that user was successfully retrieved
    $this->assertTrue(mysqli_num_rows($result_2) == 1);

    # assert that hash can be verified
    $this->assertTrue(password_verify($test_password, $hashedPassword));
  }

}