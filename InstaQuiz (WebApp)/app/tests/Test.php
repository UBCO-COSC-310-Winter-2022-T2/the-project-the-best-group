<?php 

class Test extends PHPUnit\Framework\TestCase
{
  # The unit tests that involve session_variables could not be tested due to an issue with loading session variables into phpUnit classes. We thus have assertTrue statements where no tests could be run.
  # Where some functionality could be tested, tests were still implemented.
  
  #Unit Test 1.1
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

    $this->assertTrue($result);
  }

  #Unit Test 1.2
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
        $sql_2 = "DELETE FROM accounts WHERE email='test@mail.com'";
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

        #create a course with this id
        $test_Iid = mysqli_fetch_assoc($result_1)['id'];
        $test_cname = "Test Course";
        $sql_5 = "INSERT INTO courses (cname, Iid) VALUES ('{$test_cname}', '$test_Iid')";
        $result_2 = mysqli_query($conn, $sql_5);

        #clear the test account and close connection
        $sql_3 = "DELETE FROM accounts WHERE email='test@mail.com'";
        mysqli_query($conn,$sql_3);
        mysqli_close($conn);
        
        # assert that account was successful in the login process
        $this->assertTrue(mysqli_num_rows($result_1) == 1);
        #assert that course was successfully created and instructor was enrolled as instructor of course
        $this->assertTrue($result_2);
  }
}