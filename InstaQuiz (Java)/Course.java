package InstaQuiz;

import java.util.ArrayList;

public class Course {
	
	static int counter = 0;
	
	private String courseName;
	private Instructor instructor;
	private ArrayList<Student> students;
	private int courseID;

	Course(String courseName, Instructor instructor, ArrayList<Student> students, int courseID) {
		this.courseName = courseName;
		this.instructor = instructor;
		this.students = students;
		this.courseID = counter++;
	}
	
	public String getCourseName() {
		return courseName;
	}
	
	public Instructor getInstructor() {
		return instructor;
	}
	
	public ArrayList<Student> getStudents() {
		return students;
	}
	
	public int getCourseID() {
		return courseID;
	}
	

	public static Object[] searchCourse(String courseName, String instructorName) {
		
		// TODO: checks if course is in courses table in database, returns course object if found, otherwise returns null
		
		return null;
	}
	
	public static Object[] searchTitle(String courseName) {
		
		// TODO: checks if course is in courses table in database, returns course object if found, otherwise returns null
		
		return null;
	}
	
	public static String searchInstructor(String instructorName) {
		
		// TODO: returns a list of all courses with matching instructorName, if there are none returns null
		
		return null;
	}
	
	public void enroll(Student student) {
	    this.students.add(student);
	  }
	
	public void unenroll(Student student) {
	    this.students.remove(student);
	  }

	public boolean startLiveSession(String instructorName) {
		// this method will be allowed/restricted based on who is logged in therefore always returns true and passes test
		if (instructorName == this.getInstructor().toString()) {
			Session.newSession(courseName, instructorName);
			return true;
		} else {
			System.out.println("Not your course, cannot start session.");
			return false;
		}
	}
	
	public void endLiveSession() {
		// TODO end live session, aka assign it to null??
		
	}
	
	public boolean isActive() {
		// TODO check if session is live for this course
		return false;
	}

	public boolean activePoll() {
		// TODO check if there is an active poll in this course, if yes return true
		return false;
	}

	public boolean joinLiveSession(Student s) {
		// TODO check if course is live, if it is add student to live session and set to true
		return false;
	}

	public void startPoll() {
		// TODO start a poll for this course, set isActive to true
		
	}

	public void endPoll() {
		// TODO find current poll and set to null, set isActive to false
		
	}

	public boolean displayPollSummary() {
		// TODO
		return false;
	}

	public boolean studentSummary() {
		// TODO Auto-generated method stub
		return false;
	}

	
    
}
