package InstaQuiz;

import org.junit.Test;

public class Testing {
    
	// Tests for functional requirement 1.1
    @Test
    public void testCreateStudentAccount() {
    	
        String email = "student@mail.com";
        String password = "pw";
        String userType = "student";

        boolean createAccountResult = Account.createAccount(email, password, userType);
        
        assert(createAccountResult);
    }
    
    @Test
    public void testCreateInstructorAccount() {
    	
        String email = "instructor@mail.com";
        String password = "pw";
        String userType = "instructor";
    
        boolean createAccountResult = Account.createAccount(email, password, userType);

        assert(createAccountResult);
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
}
