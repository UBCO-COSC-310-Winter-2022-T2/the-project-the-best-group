package InstaQuiz;

import java.lang.Math;
import java.util.ArrayList;

import static org.junit.Assert.assertArrayEquals;
import static org.junit.Assert.assertEquals;
import static org.junit.Assert.assertFalse;
import static org.junit.Assert.assertTrue;

import org.junit.Test;

public class Testing {
    
    // Unit Test(s) for functional requirement 1.1:
    // Users can create an InstaQuiz account with instructor, or student privileges using their email address and a custom password.
    @Test
    public void testCreateStudentAccount() {
    	
    	String fullname = "first last";
        String email = "student@mail.com";
        String password = "pw";
        char userType = 'S'; // must be 'S' or 'I'

        Account.createAccount(fullname, email, password, userType);
        
        assertTrue(Account.exists(email, password, userType));
    }
    
    @Test
    public void testCreateInstructorAccount() {
    	
    	String fullname = "first last";
        String email = "instructor@mail.com";
        String password = "pw";
        char userType = 'I'; // must be 'S' or 'I'
    
        Account.createAccount(fullname, email, password, userType);

        assertTrue(Account.exists(email, password, userType));
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
        char userType = 'S';

        assertTrue(Account.login(email, password, userType));
    }

    @Test
    public void instructorLogin()
    {
        String email = "instructor@mail.com";
        String password = "pw";
        char userType = 'I';

        assertTrue(Account.login(email, password, userType));
    }
    // End of 1.2 Unit Tests

    // Unit Test(s) for functional requirement 1.3:
    // Users can logout by clicking a constantly displayed button in the top right of the web-page.
    @Test
    public void testStudentLogout()
    {
        String email = "student@mail.com";
        String password = "password";
        char userType = 'S';
        
        Account.login(email, password, userType);

        assertTrue(Account.logout());
    }

    @Test
    public void testInstructorLogout()
    {
        String email = "instructor@mail.com";
        String password = "password";
        char userType = 'I';

        Account.login(email, password, userType);
        
        assertTrue(Account.logout());
    }
    // End of 1.3 Unit Tests

    // Unit Test(s) for functional requirement 1.4:
    // Instructors can create a new course module, this automatically enrolls them in the course, as the instructor.
    @Test
    public void testInstructorCanCreateCourse() 
    {
        Instructor instructor1 = new Instructor("fullname", "mail@mail.com", "pw");
        instructor1.createCourse("course1", instructor1); // instructor must provide their name when they create a course

        // check if the course is in the database and ensure it is under the creating instructors name (i.e. they are enrolled as the instructor)
        assertTrue(Course.searchCourse("course1", "fullname")!=null);
    }
    // End of 1.4 Unit Tests

    // Unit Test(s) for functional requirement 1.5:
    // Instructors can delete any course module they have personally created.
    @Test
    public void testInstructorCanDeleteCourse() {
        
        Instructor instructor1 = new Instructor("fullname", "mail@mail.com", "pw");
        Course c1 = new Course("course title", instructor1, null, 123);
        
        // instructor must provide their name when they call deleteCourse (to ensure they are deleting their own course)
        instructor1.deleteCourse(c1, instructor1.getName());

        //check if the course they tried to delete still exists. It shouldn't exist therefore getCourse should return null 
        assertTrue(instructor1.getCourse("Java Programming", "fullname") == null);
    }
    // End of 1.5 Unit Tests
    
    // Unit Test(s) for functional requirement 1.6:
    // Users can search for a course module by title or instructor
    @Test
    public void searchCourseByTitle()
    {
    	Instructor in = new Instructor("John Doe", "jdoe@mail.com", "pw");
        in.createCourse("courseName", in);

        // checks to make sure searching by title doesn't return null
        assertTrue(Course.searchTitle("courseName") != null);
    }

    // 1.6 continued - test for searching by instructor:
    @Test
    public void searchCourseByInstructor()
    {
        Instructor in = new Instructor("John Doe", "jdoe@mail.com", "pw");
        in.createCourse("courseName", in);

     // checks to make sure searching by instructor name doesn't return null
        assertTrue(Course.searchInstructor("John Doe") != null);
    }
    // End of 1.6 Unit Tests
	
    // Unit Test(s) for Functional Requirement 1.7:
    // Students can enroll in any course module that they are not currently enrolled in.
    public void joinCourseStudent()
    {
    	 Instructor in1 = new Instructor("John Doe", "jdoe@mail.com", "pw1");
    	Course course1 = new Course("intro to intros", in1, null, 123);
        Student st = new Student("sName", "st@mail.com", "pw");
  
        course1.enroll(st);
        
        boolean isInClass = false;
        for(Student stud : course1.getStudents()){
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
    	
    	Instructor in1 = new Instructor("John Doe", "jdoe@mail.com", "pw1");
    	Course course1 = new Course("intro to intros", in1, null, 123);
        Student st = new Student("sName", "st@mail.com", "pw");
  
        course1.enroll(st);
        course1.unenroll(st);
        
        boolean isNotInClass = true;
        for(Student stud : course1.getStudents()){
            if (st == stud)
            {
                isNotInClass = false;
                break;
            }
        }
        
        assertTrue(isNotInClass);
    }
    
    // End of 1.8 Unit Tests

    // Unit Test(s) for Functional Requirement 1.9:
    // Instructors can start a live course session in any courses they have created.
    @Test
    public void instructorStartLiveSession()
    {
        Instructor in1 = new Instructor("John Doe", "jdoe@mail.com", "pw1");
        Instructor in2 = new Instructor("Jane Doe", "janedoe@mail.com", "pw2");
        Course course1 = new Course("Introduction to Software Engineering", in1, null, 111);
        Course course2 = new Course("Introduction to Calculus", in2, null, 333);


        // instructors must provide their name when they start a live session, this will be checked against the course's actual instructor 
        assertTrue(course1.startLiveSession("John Doe")); 
        assertFalse(course2.startLiveSession("John Doe"));
    }
    // End of 1.9 Unit Tests
	
    // Unit Test(s) for Functional Requirement 1.10:
    // If an instructor has any ongoing live sessions, they can end them whenever, as long as no polling windows are active.
    @Test 
    public void testEndLiveSession() {
    	
    	Instructor instructor1 = new Instructor("profname", "mail@mail.com", "pw");
    	Course course1 = new Course("course title", instructor1, null, 234);
    	
        course1.startLiveSession("profname");
        
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
        Instructor in = new Instructor("John Doe", "jdoe@mail.com", "pw");
        Course c = new Course("Introduction to Software Engineering", in, null, 246);

        Student s = new Student("James Doe", "jdoe@mail.com", "pw");
        c.enroll(s);
        
        c.startLiveSession(in.getName());
        
        assertTrue(c.joinLiveSession(s));
        c.endLiveSession();
    }
    // End of 1.11 Unit Tests
    
    
    //**********NEED FIX
    // Unit Test(s) for Functional Requirement 1.12: 
    // Instructors can create a storage bank of custom questions with corresponding multiple choice answer sets
    @Test
    public void testQuestionBank() {
    // Create a new question bank
    Question bank1 = new Question(null, null);
 

    // Create a sample question
    String prompt = "What is the capital of Canada?";
    ArrayList<String> answerOptions = new ArrayList<String>();
    answerOptions.add("Ottawa");
    answerOptions.add("Kelowna");
    answerOptions.add("Edmonton");
    answerOptions.add("Toronto");
    answerOptions.add("Quebec City");
    //Question question = new Question(prompt, answerOptions);


    // bank1.addQuestion(question);
    //Question retrievedQuestion = bank1.addQuestion("2+2");


   //assertEquals(question.getPrompt(), retrievedQuestion.getPrompt());
   //assertEquals(question.getAnswerOptions(),   retrievedQuestion.getAnswerOptions());
   
   }
   // End of 1.12 Unit Tests

   // Unit Test(s) for Functional Requirement 1.13: 
   // Instructors can start a polling window during a live session as long as no other polls are already in progress
   @Test 
   public void testStartPoll () {
    	
	   Instructor instructor1 = new Instructor("profname lastname", "mail@mail.com", "pw");
	   Course course1 = new Course("211", instructor1, null, 404);
    	
	   course1.startLiveSession(instructor1.getName());

       course1.startPoll();
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
        Instructor in = new Instructor("John Doe", "jdoe@mail.com", "pw");
        Course co = new Course("CourseName", in, null, 444);

        co.startLiveSession(in.getName());
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
    	
    	Instructor instructor1 = new Instructor("profname lastname", "mail@mail.com", "pw");
    	Course course1 = new Course("211", instructor1, null, 121);
    	Student s1 = new Student("fname lastname", "mail@mail.com", "pw");
    	
    	Session ses1 = new Session(course1);
    	Poll p1 = new Poll (course1);

        Question question1 = new Question("2+2?", null);
        Response A = new Response("5", p1, null);
        Response B = new Response("4", p1, null);
        
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
        Instructor in = new Instructor("John Doe", "jdoe@mail.com", "pw");
        Course c = new Course("Introduction to Software Engineering", in, null, 212);

        c.startLiveSession(in.getName());
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
     
        Instructor in = new Instructor("John Doe", "jdoe@mail.com", "pw");
        Course co = new Course("courseName", in, null, 321);
        Student st = new Student("John Doe", "jdoe@mail.com", "pw");
     
        co.startLiveSession(in.getName());

        String prompt1 = null;
		Poll p1 = null;
		Response A = new Response("5", p1, prompt1);
        Response B = new Response("4", p1, prompt1);
        Question question1 = new Question("2+2?", B.toString());

        question1.addResponses(new Response[]{A, B});
        p1.addQuestion(question1);

        co.startPoll();
     
        st.selectAnswer(B, p1, question1);

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
    	Instructor in = new Instructor("John Doe", "jdoe@mail.com", "pw");
        Course course1 = new Course("Introduction to Software Engineering", in, null, 222 );
        Student student1 = new Student("sName Doe", "student1@mail.com", "pw");

        course1.enroll(student1);

        Session session1 = new Session(course1);
    	String ask = null;

        Question question1 = new Question("2+2?", ask);
        Poll p1 = null;
		Response A = new Response("5", p1 , ask);
        Response B = new Response("4", p1, ask);

        course1.startLiveSession(in.getName()); //creates a session object: Session session1 = new Session(course1);???
        course1.joinLiveSession(student1);

        session1.startPoll(question1); //creates a poll object: Poll poll1 = new Poll(session1);???

        //Adds two student objects to session1.presentStudents ArrayList
        student1.selectAnswer(A, p1, question1);

        session1.endPoll(p1);

        assertTrue(student1.getSummary(course1)); //this might get called, but this test does not check for the visual interface summary.

        course1.endLiveSession();
    }
    // End of 1.18 Unit Tests

    // Unit Test(s) for Functional Requirement 1.19: 
    // For each course they have created, instructors will have access to their students grades, attendance records, and response history.
    @Test
    public void testInstructorViewGrades()
    {
        Instructor i1 = new Instructor("iName lname", "instructor1@mail.com", "pw");
        Course course1 = new Course("Introduction to Software Engineering", i1, null, 111);
        Student student1 = new Student("sName Doe", "student1@mail.com", "pw1");
        Student student2 = new Student("sName Smith", "student2@mail.com", "pw2");

        course1.enroll(student1);
        course1.enroll(student2);

        Session session1 = new Session(course1);
    	Poll p1 = new Poll (course1);

        Question question1 = new Question("2+2?", "4");
        Response A = new Response("5", p1, null);
        Response B = new Response("4", p1, null);

        course1.startLiveSession(i1.getName()); //creates a session object: Session session1 = new Session(course1);???
        course1.joinLiveSession(student1);
        course1.joinLiveSession(student2);

        course1.startPoll(); //creates a poll object: Poll poll1 = new Poll(session1);???

        //Adds two student objects to session1.presentStudents ArrayList
        student1.selectAnswer(A, p1, question1);
        student2.selectAnswer(B, p1, question1);

        session1.endPoll(p1);

        assertTrue(course1.studentSummary()); //this might get called, but this test does not check for the visual interface summary.

        course1.endLiveSession();
    }
    // End of 1.19 Unit Tests
    
    // Unit Test(s) for Functional Requirement 1.20: 
    // Students and instructors can view the InstaQuiz history for a course which will show all past
    // questions with the corresponding correct answers.
    @Test
    public void viewingHistoryOfCourse() 
    {
     
        Instructor in = new Instructor("John Doe", "jdoe@mail.com", "pw");
        Course co = new Course("courseName", in, null, 122);
        Student st = new Student("John Doe", "jdoe@mail.com", "pw");
        
        co.enroll(st);

        co.startLiveSession(in.getName());

        Poll p1 = null;
		Response A = new Response("5", p1, null);
        Response B = new Response("4", p1, null);
        Question question1 = new Question("2+2?", null);

        question1.addResponses(new Response[]{A, B});
        p1.addQuestion(question1);

        co.startPoll();
     
        st.selectAnswer(B, p1, question1);

        co.endPoll();

        co.endLiveSession();

        //stores all previous questions with their answers as an attribute of the Question object
        Question[] summary = p1.getQuestions();

        //checks that answers and questions are the same as the poll that was just running
        assertEquals(1, summary.length);
        assertEquals(question1, summary[0]);
        assertEquals(B,summary[0].answer);
    }
    // End of 1.20 Unit Tests
   
}
