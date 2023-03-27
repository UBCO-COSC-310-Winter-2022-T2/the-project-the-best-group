package InstaQuiz;

import static org.junit.Assert.assertEquals;
import static org.junit.Assert.assertFalse;
import static org.junit.Assert.assertTrue;

import org.junit.Test;

public class Testing {
    
    // Tests for functional requirement 1.1
	/*
	The createAccount method will attempt to add a row to the accounts table in our database.
    	If it succeeds it will return true, otherwise the method defaults to false as no account has been created.
   	Method will also call Student() or Instructor() depending on the userType parameter passed to it when call
	*/
    @Test
    public void testCreateStudentAccount() {
    	
        String email = "student@mail.com";
        String password = "pw";
        String userType = "student";

        boolean createAccountResult = Account.createAccount(email, password, userType);
        
        assertTrue(createAccountResult);
    }
    
    @Test
    public void testCreateInstructorAccount() {
    	
        String email = "instructor@mail.com";
        String password = "pw";
        String userType = "instructor";
    
        boolean createAccountResult = Account.createAccount(email, password, userType);

        assertTrue(createAccountResult);
    }
    // end of 1.1

    // Tests for functional requirement 1.2
    @Test
    public void studentLogin()
    {
        String email = "student@mail.com";
        String password = "pw";

        assertTrue(Account.login(email, password));
    }

    @Test
    public void instructorLogin()
    {
        String email = "instructor@mail.com";
        String password = "pw";

        assertTrue(Account.login(email, password));
    }
    // End of 1.2 Tests

    // Tests for functional requirement 1.3
    @Test
    public void testStudentLogout()
    {
        String email = "student@mail.com";
        String password = "password";

        assertTrue(Account.logout(email,password));
    }

    @Test
    public void testInstructorLogout()
    {
        String email = "instructor@mail.com";
        String password = "password";

        assertTrue(Account.logout(email,password));
    }
    //end of 1.3 Tests
    
    // 1.5 test
    
    @Test
    public void testInstructorCanDeleteCourse() {
        
        Instructor instructor = new Instructor("prof", "lastname", "mail@mail.com", "pw");
        Course course = new Course("Java Programming", instructor);
        
        instructor.deleteCourse(course);

        //check if the course they tried to delete still exists. It shouldn't exist therefore getCourse should return null 
        assertEquals(null, instructor.getCourse(course));
    }
    
    // end of 1.5 test
    
    
}
