<?php 

class Test extends PHPUnit\Framework\TestCase
{
  public function testRegister()
  {
    # including the required mysql connection
    $conn = mysqli_connect('db', 'admin', '310adminpw', 'instaquiz');

    # deleting any preexisting users under these credentials before running
    $sql_1 = "DELETE FROM accounts WHERE email='testregister@mail.com'";
    mysqli_query($conn,$sql_1);

    # stock user information for a new account
    $test_first_name = "Test";
    $test_last_name = "Register";
    $test_email = "testregister@mail.com";
    $test_password = "testregister";

    # query the database the same way as the register page
    $sql_2 = "INSERT INTO accounts (permission, fname, lname, email, password) VALUES (1, '{$test_first_name}', '{$test_last_name}', '{$test_email}', '{$test_password}');";
    $result = mysqli_query($conn, $sql_2);

    mysqli_close($conn);

    $this->assertEquals(true, $result);
  }
}