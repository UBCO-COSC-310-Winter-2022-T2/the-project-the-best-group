package InstaQuiz;

import java.lang.Math;

import static org.junit.Assert.assertEquals;
import static org.junit.Assert.assertFalse;
import static org.junit.Assert.assertTrue;

import org.junit.Test;

public class Testing {
    
    // Unit Test(s) for functional requirement 1.1:
    // Users can create an InstaQuiz account with instructor, or student privileges using their email address and a custom password.

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
    // End of 1.1 Unit Tests

    // Unit Test(s) for functional requirement 1.2:
    // Users can login to their InstaQuiz accounts using their email address and password.

    // Test for student login, provided String values for an email and password, the Account.login function should query the database and return true if the email and password match a student account
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
    // End of 1.2 Unit Tests

    // Unit Test(s) for functional requirement 1.3:
    // Users can logout by clicking a constantly displayed button in the top right of the web-page.
    @Test
    public void testStudentLogout()
    {
        String email = "student@mail.com";
        String password = "password";

        assertTrue(Account.logout(email, password));
    }

    @Test
    public void testInstructorLogout()
    {
        String email = "instructor@mail.com";
        String password = "password";

        assertTrue(Account.logout(email, password));
    }
    // End of 1.3 Unit Tests

    // Unit Test(s) for functional requirement 1.4:
    // Instructors can create a new course module, this automatically enrolls them in the course, as the instructor.
    @Test
    public void testInstructorCanCreateCourse() 
    {
        Instructor instructor = new Instructor("prof", "lastname", "mail@mail.com", "pw");
        instructor.createCourse("course");

        assertEquals(Course.searchTitle(courseName), instructor.getCourse(course));
    }
    // End of 1.4 Unit Tests

    // Unit Test(s) for functional requirement 1.5:
    // Instructors can delete any course module they have personally created.
    @Test
    public void testInstructorCanDeleteCourse() {
        
        Instructor instructor = new Instructor("prof", "lastname", "mail@mail.com", "pw");
        Course course = new Course("Java Programming", instructor);
        
        instructor.deleteCourse(course);

        //check if the course they tried to delete still exists. It shouldn't exist therefore getCourse should return null 
        assertEquals(null, instructor.getCourse(course));
    }
    // End of 1.5 Unit Tests
    
    // Unit Test(s) for functional requirement 1.6:
    // Users can search for a course module by title or instructor
    @Test
    public void searchCourseByTitle()
    {
        String courseName = "Introduction to Software Engineering";

        assertTrue(Course.searchTitle(courseName));
    }

    @Test
    public void searchCourseByInstructor()
    {
        Instructor in = new Instructor("John", "Doe", "jdoe@mail.com", "pw");

        assertTrue(Course.searchInstructor(in.getFirstName() + " " + in.getLastName()));
    }
    // End of 1.6 Unit Tests
	
    // Unit Test(s) for Functional Requirement 1.7:
    // Students can enroll in any course module that they are not currently enrolled in.
    public void joinCourseStudent()
    {
        Student st = new Student("John", "Doe", "jd@mail.com", "pw");
        Instructor in = new Instructor("John", "Doe", "jdoe@mail.com", "pw");
        Course co = new Course("Course Name", in);
        
        co.addStudent(st);
        
        Student[] students = co.getStudents();
        boolean isInClass = false;
        for(Student stud : students){
            if (st == stud)
            {
                isInClass = true;
                break;
            }
        }
        
        assertTrue(isInClass);
    }
    // End of 1.7 Unit Tests

    // Unit Test(s) for Functional Requirement 1.8:
    // Students can unenroll from a course they are currently enrolled in.
    @Test
    public void testUnenrollFromCourse() {
    	
        Student student = new Student("student_name", "lastname", "mail@mail.com", "pw");
        Course course = new Course("211", null);
        course.enroll(student);
  
        course.unenroll(student);
  
        // check to make sure student is not enrolled in course hence the assertFalse
        assertFalse(course.isEnrolled(student));
    }
    
    // End of 1.8 Unit Tests

    // Unit Test(s) for Functional Requirement 1.9:
    // Instructors can start a live course session in any courses they have created.
    @Test
    public void instructorStartLiveSession()
    {
        Instructor in1 = new Instructor("John", "Doe", "jdoe@mail.com", "pw1");
        Instructor in2 = new Instructor("Jane", "Doe", "jdoe@mail.com", "pw2");

        Course course1 = new Course("Introduction to Software Engineering", in1);
        Course course2 = new Course("Introduction to Engineering Software", in2);

        assertTrue(course1.startLiveSession()); //Don't want to pass in objects, this method will be allowed/restricted based on who is logged in, and trying to call it. (should be void, with no parameters)
        assertTrue(course2.startLiveSession());

        assertFalse(course1.startLiveSession());
        assertFalse(course2.startLiveSession());
    }
    // End of 1.9 Unit Tests
	
    // Unit Test(s) for Functional Requirement 1.10:
    // If an instructor has any ongoing live sessions, they can end them whenever, as long as no polling windows are active.
    @Test 
    public void testEndLiveSession() {
    	
    	Instructor instructor1 = new Instructor("profname", "lastname", "mail@mail.com", "pw");
    	Course course1 = new Course("211", instructor1);
    	
        course1.startLiveSession();
        
        boolean activePoll = course1.activePoll();
        
        if (!activePoll) {
        	course1.endLiveSession();
        } else {
        	System.out.println("Cannot end a session while a poll is active");
        }
        // sessions will have a isActive boolean method
        assertFalse(course1.isActive());
    }
    // End of 1.10 Unit Tests

    // Unit Test(s) for Functional Requirement 1.11:
    // Users can join a live course session, provided that the instructor has started it already
    @Test
    public void testJoinLiveSession()
    {
        Instructor in = new Instructor("John", "Doe", "jdoe@mail.com", "pw");
        Course c = new Course("Introduction to Software Engineering", i);

        Student s = new Student("James", "Doe", "jdoe@mail.com", "pw");
        s.joinCourse(c);
        
        c.startLiveSession();
        assertTrue(s.joinLiveSession(c));
        c.endLiveSession();
    }
    // End of 1.11 Unit Tests
    
    // Unit Test(s) for Functional Requirement 1.12: 
    // Instructors can create a storage bank of custom questions with corresponding multiple choice answer sets
    @Test
    public void testQuestionBank() {
    // Create a new question bank
    bank1 Question = new Question();
 

    // Create a sample question
    String prompt = "What is the capital of Canada?";
    ArrayList<String> answerOptions = new ArrayList<String>();
    answerOptions.add("Ottawa");
    answerOptions.add("Kelowna");
    answerOptions.add("Edmonton");
    answerOptions.add("Toronto");
    answerOptions.add("Quebec City");
    Question question = new Question(prompt, answerOptions);


    bank1.addQuestion(question);
    Question retrievedQuestion = questionBank.getQuestion(0);


   assertEquals(question.getPrompt(), retrievedQuestion.getPrompt());
   assertEquals(question.getAnswerOptions(),   retrievedQuestion.getAnswerOptions());
   
   }
   // End of 1.12 Unit Tests

   // Unit Test(s) for Functional Requirement 1.13: 
   // Instructors can start a polling window during a live session as long as no other polls are already in progress
   @Test 
   public void testStartPoll () {
    	
	   Instructor instructor1 = new Instructor("profname", "lastname", "mail@mail.com", "pw");
	   Course course1 = new Course("211", instructor1);
    	
	   course1.startLiveSession();

       // variable for whether we successful started a new poll
       boolean newPollStarted = false;
        
       if (!course1.activePoll()) {
        	course1.startPoll();
        	newPollStarted = true;
       } else {
    	   System.out.println("A poll is already active");
       }

       assertTrue(newPollStarted);
   	}
    // End of 1.13 Unit Tests

    // Unit Test(s) for Functional Requirement 1.14: 
    // Instructors can end their live polling window and declare the correct answer to the question.
    @Test
    public void testEndPoll()
    {
        Instructor in = new Instructor("John", "Doe", "jdoe@mail.com", "pw");
        Course co = new Course("CourseName", in);

        co.startLiveSession();
        co.startPoll();
        boolean pollStarted = co.activePoll();
        co.endPoll();
        boolean pollEnded = co.activePoll();

        //tests if poll started successfully before testing if it ended successfully
        assertTrue(pollStarted);
        assertTrue(pollEnded);
    }
    // End of 1.14 Unit Tests

    // Unit Test(s) for Functional Requirement 1.15: 
    // Users can answer a question by clicking on the corresponding answer listed beneath the question text. A
    // user can change their answer during the polling window.
    @Test
    public void testChangeAnswer() {
    	
    	Instructor instructor1 = new Instructor("profname", "lastname", "mail@mail.com", "pw");
    	Course course1 = new Course("211", instructor1);
    	Student s1 = new Student("fname", "lastname", "mail@mail.com", "pw");
    	
    	Session ses1 = new Session(course1);
    	Poll p1 = new Poll (course1);

        Question question1 = new Question("2+2?", p1);
        Response A = new Response("5", p1, question1);
        Response B = new Response("4", p1, question1);
        
        s1.selectAnswer(A, p1, question1);
        s1.selectAnswer(B, p1, question1);
        
        assertEquals("4",s1.getAnswer(p1, question1));
        
    }
    // End of 1.15 Unit Tests

    // Unit Test(s) for Functional Requirement 1.16: 
    // Instructors can choose to display a summary of the question, (correct answer, how many votes each answer
    // got, how many total responses, etc.) or to keep it hidden from the class. Instructors will be able to see this
    // summary regardless after they end a polling window
    @Test
    public void testPollSummary()
    {
        Instructor in = new Instructor("John", "Doe", "jdoe@mail.com", "pw");
        Course c = new Course("Introduction to Software Engineering", i);

        c.startLiveSession();
        c.startPoll();
        c.endPoll(); //calls c.pollSummary() to show the instructor

        assertTrue(c.displayPollSummary()); //displays summary to the entire class
    }
    // End of 1.16 Unit Tests

    // Unit Test(s) for Functional Requirement 1.17: 
    // Students can see how many questions they have answered right for a particular course. The total questions
    //asked for the course will also be shown so the student will see a comprehensive score, something like 16/21.
    @Test
    public void testCheckCourseScore() 
    {
     
        Instructor in = new Instructor("John", "Doe", "jdoe@mail.com", "pw");
        Course co = new Course("courseName", in);
        Student st = new Student("John", "Doe", "jdoe@mail.com", "pw");
     
        co.startLiveSession();

        Response A = new Response("5", p1, question1);
        Response B = new Response("4", p1, question1);
        Question question1 = new Question("2+2?", B);

        question1.addResponses(new Response[]{A, B});
        co.addQuestion(question1);

        co.startPoll();
     
        st.selectAnswer(B);

        co.endPoll();

        double grade = st.getGrade(co);
     
        int gradeInt = (int)Math.floor(grade);

        assertEquals(1, gradeInt);
    }
    // End of 1.17 Unit Tests

    // Unit Test(s) for Functional Requirement 1.18:
    // For each course they are enrolled in, students will be able to see their current score, attendance record, and
    // response history throughout previously attended live sessions
    @Test
    public void testStudentViewHistory()
    {
        Course course1 = new Course("Introduction to Software Engineering", i);
        Student student1 = new Student("sName", "Doe", "student1@mail.com", "pw");

        student1.joinCourse(course1);

        Session session1 = new Session(course1);
    	Poll poll1 = new Poll (course1);

        Question question1 = new Question("2+2?", poll1);
        Response A = new Response("5", p1, question1);
        Response B = new Response("4", p1, question1);

        course1.startLiveSession(); //creates a session object: Session session1 = new Session(course1);???
        student1.joinLiveSession(session1);

        session1.startPoll(question1); //creates a poll object: Poll poll1 = new Poll(session1);???

        //Adds two student objects to session1.presentStudents ArrayList
        student1.selectAnswer(A);

        session1.endPoll(poll1);

        assertTrue(student.getSummary(course1)); //this might get called, but this test does not check for the visual interface summary.

        course1.endLiveSession();
    }
    // End of 1.18 Unit Tests

    // Unit Test(s) for Functional Requirement 1.19: 
    // For each course they have created, instructors will have access to their students grades, attendance records, and response history.
    @Test
    public void testInstructorViewGrades()
    {
        Instructor instructor1 = new Instructor("iName", "lname", "instructor1@mail.com", "pw");
        Course course1 = new Course("Introduction to Software Engineering", i);
        Student student1 = new Student("sName", "Doe", "student1@mail.com", "pw");
        Student student2 = new Student("sName", "Doe", "student1@mail.com", "pw");

        student1.joinCourse(course1);
        student2.joinCourse(course1);

        Session session1 = new Session(course1);
    	Poll poll1 = new Poll (course1);

        Question question1 = new Question("2+2?", poll1);
        Response A = new Response("5", p1, question1);
        Response B = new Response("4", p1, question1);

        course1.startLiveSession(); //creates a session object: Session session1 = new Session(course1);???
        student1.joinLiveSession(session1);
        student2.joinLiveSession(session1);

        session1.startPoll(question1); //creates a poll object: Poll poll1 = new Poll(session1);???

        //Adds two student objects to session1.presentStudents ArrayList
        student1.selectAnswer(A);
        student2.selectAnswer(B);

        session1.endPoll(poll1);

        assertTrue(course1.studentSummary()); //this might get called, but this test does not check for the visual interface summary.

        course1.endLiveSession();
    }
    // End of 1.19 Unit Tests
    
    //Tests for Functional Requirement 1.20: 
    //Students and instructors can view the InstaQuiz history for a course which will show all past
    //questions with the corresponding correct answers.
    @Test
    public void viewingHistoryOfCourse() 
    {
     
        Instructor in = new Instructor("John", "Doe", "jdoe@mail.com", "pw");
        Course co = new Course("courseName", in);
        Student st = new Student("John", "Doe", "jdoe@mail.com", "pw");
        
        co.addStudent(st);

        co.startLiveSession();

        Response A = new Response("5", p1, question1);
        Response B = new Response("4", p1, question1);
        Question question1 = new Question("2+2?", B);

        question1.addResponses(new Response[]{A, B});
        co.addQuestion(question1);

        co.startPoll();
     
        st.selectAnswer(B);

        co.endPoll();

        co.endLiveSession();

        //stores all previous questions with their answers as an attribute of the Question object
        Question[] summary = co.getQuestions();

        //checks that answers and questions are the same as the poll that was just running
        assertEquals(1, summary.length);
        assertEquals(question1, summary[0]);
        assertEquals(B,summary[0].answer);
    }
    // End of 1.20 Unit Tests
}