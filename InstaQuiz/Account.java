package InstaQuiz;

public abstract class Account {

	String fullname;
	String email;
	String password;
	char userType;
	
    
	public static void createAccount(String fullname, String email, String password, char userType) {
		if (userType == 'S') {
			Student.newStudent(fullname, email, password);
		} else if (userType == 'I') {
			Instructor.newInstructor(fullname, email, password);
		} else {
			System.out.println("Invalid userType, please provide 'S' for student and 'I' for instructor");
		}
		
		// TODO: add account to database with all details as attributes
	}
	
	public static boolean login(String email, String password, char userType) {
		// TODO: verifies that there is an account in database with that email, password and user type, if match is found return true
		return false;
	}

	public static boolean logout() {
		// TODO: what are we testing here ?!?!?
		return false;
	}


	public static boolean exists(String email, String password, char userType) {
		// TODO: checks if account is in the database, if it is returns true, otherwise returns false
		return false;
	}

	
}
