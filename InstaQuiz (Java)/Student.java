package InstaQuiz;

public class Student extends Account
{
	
    Student(String fullname, String email, String password)
    {
    	this.fullname = fullname;
        this.email = email;
        this.password = password;
    }

	public static void enroll(String courseName, String instructorName, String studentName) {
		// TODO: 
		
	}


	public static Student newStudent(String fullname, String email, String password) {
		return new Student(fullname, email, password);
	}

	public void selectAnswer(Response a, Poll p1, Question question1) {
		// TODO Auto-generated method stub
		
	}

	public Object getAnswer(Poll p1, Question question1) {
		// TODO Auto-generated method stub
		return null;
	}

	public double getGrade(Course co) {
		// TODO Auto-generated method stub
		return 0;
	}

	public boolean getSummary(Course course1) {
		// TODO Auto-generated method stub
		return false;
	}

	
}
