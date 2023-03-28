package InstaQuiz;

import java.util.ArrayList;

public class Instructor extends Account
{

	Instructor(String fullname, String email, String password)
    {
    	this.fullname = fullname;
        this.email = email;
        this.password = password;
    }
	
	public String getName() {
		return fullname;
	}
	

	public static Course createCourse(String courseName, Instructor instructor) {
		ArrayList<Student> s = new ArrayList<>();
		int c = Course.counter;
		return new Course(courseName, instructor, s, c);
		// TODO: add course to courses table in database, include courseName and instructorName as attributes
		
	}
	
	public Object[] getCourse(String course1, String instructorName) {
		
		// TODO: check if course exists in database, if it does return the course object, otherwise method returns null
		
		return null;
	}


	public void deleteCourse(Course course1, String myName) {

		course1 = null;
		// TODO: search database for course, ensure the myName provided matches the instructorName attribute, then remove from database
		
	}

	public static Instructor newInstructor(String fullname, String email, String password) {
		return new Instructor(fullname, email, password);
		
	}
}