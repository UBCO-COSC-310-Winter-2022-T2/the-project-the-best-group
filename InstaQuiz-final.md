# COSC 310 Final Project Report (The InstaQuiz Iclicker Clone)

The Best Group: (Gus Goerzen, Tanner Dyck, Sten Korver, Patrick Ma, Kiyoon Kim)

**Video Walkthrough: (insert link here)**


# General Development:

### 1. What did your team build? Is it feature complete and running? 

Our team built a web-based system that enables instructors to engage with students through interactive quizzes. It is feature complete and running. Instructors have the ability to create course modules, which serve as virtual meeting spaces for their class. Instructors are also able to display custom questions to their students, pulled from a bank of premade questions, and receive their students' responses in real time. Students can easily search for courses by course or instructor name and can enroll themselves in these courses online. They are also able to unenroll from courses. For each course a student is enrolled in, they can see if a session is live and if it is the student can join and answer live questions. Students have access to their individual performance metrics (attendance, grades), while instructors can see metrics for their entire class. The whole system operates on a live webpage, reinforced by a secure login system that implements hashing algorithms and features a forgotten password system using a random recovery token that is auto-generated for every new account as it is registered.
<br>

### 2. How many of your initial requirements that your team set out to deliver did you actually deliver (a checklist/table would help to summarize)?  Were you able to deliver everything or are there things missing?  Did your initial requirements sufficiently capture the details needed for the project?

| Initial Requirements | Complete (C) / Incomplete (I) / Modified (M) |
|----------------------|-------------------------------|
| **User:**|
| 1. Users can create an InstaQuiz account with instructor, or student privileges using their email address and a custom password. | C |
| 2. Users can login to their InstaQuiz accounts using their email address and password. | C |
| 3. Users can logout by clicking a constantly displayed button in the top right of the web-page. | C |
| 4. Instructors can create a new course module, this automatically enrolls them in the course, as the instructor. | C |
| 5. Instructors can delete any course module they have personally created. | C |
| 6. Users can search for a course module by title or instructor.  | C |
| 7. Users can enroll in any course module that they are not currently enrolled in. | C |
| 8. Instructors and students can unenroll from a course they are currently enrolled in. | C |
| 9. Instructors can start a live course session in any courses they have created. | C |
| 10. If an instructor has any ongoing live sessions, they can end them whenever, as long as no polling windows are active. | M |
| 11. Users can join a live course session, provided that the instructor has started it already. | C |
| 12. Instructors can create a storage bank of custom questions with corresponding multiple choice answer sets. | C |
| 13. Instructors can start a polling window during a live session as long as no other polls are already in progress. | M |
| 14. Instructors can end their live polling window and declare the correct answer to the question. | M |
| 15. Users can answer a question by clicking on the corresponding answer listed beneath the question text. A user can change their answer during the polling window. | C |
| 16. Instructors can choose to display a summary of the question, (correct answer, how many votes each answer got, how many total responses, etc.) or to keep it hidden from the class. Instructors will be able to see this summary regardless after they end a polling window. | I |
| 17. For each course they are enrolled in, students will be able to see their current score, attendance record, and response history throughout previously attended live sessions. | M |
| 18. For each course they have created, instructors will have access to their student’s grades, attendance records, and response history. | C |
| &nbsp; |
| **Interface:** |
| 1. Students have an overview page which displays each course they are enrolled in, and gives them the option to join a class, or unenroll from one. | C |
| 2. Students can access course pages from the overview page where they will then be able to view their course statistics and join live sessions that are currently running. | C |
| 3. During a polling window, the question statistics are displayed and updated in real-time. (How many students have answered/ not answered) | C |
| &nbsp; |
| **Functional:** |
| 1. InstaQuiz will keep record of all the courses that have been created by instructors and store data about them such as their title, name of instructor, and course code made up of the faculty abbreviations and course number (ex COSC 310). | M | 
| 2. InstaQuiz will allow the creation of student and instructor accounts using email/password combinations. | C |
| 3. InstaQuiz will allow student accounts to search for courses by course title and enroll in the courses they search for and select. The system will also display a menu of the courses that a student has enrolled in and offer the ability to edit the courses they are currently enrolled in. | C |
| 4. InstaQuiz will allow the creation of a new live session to all instructors. Students who have enrolled in a course can join the session provided their instructor has started an InsatQuiz session (i.e. class is live). | C |
| 5. For instructor accounts, InstaQuiz will support the creation of custom questions with multiple choice answers and the ability to poll the class with the questions that were created. | C |
| 6. While the poll is live, the system will allow students to choose and change their answer an unlimited amount of times. IQ will also display the number of students that have submitted an answer. | C |
| 7. The system will allow instructors to end the poll at any time and select a correct multiple choice option which will be displayed on screen to the entire class. The system will then display to the students whether they answered correctly or not. | M |
| 8. The system will allow instructors to view the history on how students have answered their questions and the specific distribution of answers. The distribution of answers for a question will also be displayed at the end of each poll for all users to see. | C |
| 9. The system will also store and allow students to access the number of questions they have answered right for a particular course. The total questions asked for the course will also be shown so the student will see a comprehensive score, something like 16/21. | C |
| 10. InstaQuiz will store a comprehensive history for a course which will show all past polls and questions with the corresponding correct answers. | I |
| &nbsp; | 
| **Non-Functional:** |
| 1. Web services must update in real-time, users are given varying time windows to submit responses. We must minimize response times to and from the main client. | C |
| 2. Web service must be able to handle large amounts of traffic. As an international education tool, thousands of academics may be on the site at one time. Live sessions must be able to support over 300 connected clients at a time. | C |
<br>

MODIFICATION NOTES: A few of the initial requirements were modified as the system was developed, however, this was expected as we took an agile approach to software development. User requirement #13 was modified to allow for multiple polls to be open at one time. User requirement #14 was modified to allow for instructors to declare the correct answer during the creation of the question rather than during the closing of a poll. User requirement #16 and function requirement #10 was our only miss as we did not end up implementing a live poll summary or include a history as comprehensive as originally planned. Besides these minor subtractions and a few modifications, most of which we see as improvements, our team was able to deliver everything that was outlined in the initial requirements. Our requirements sufficiently captured all of the necessary details and the result is a feature complete system that operates as expected. 
<br>

### 3. What is the architecture of the system?  What are the key components?   What design patterns did you use in the implementation?  This needs to be sufficiently detailed so that the reader will have an understanding of what was built and what components were used/created.  You will need to reflect on what you planned to build vs what you built.

The InstaQuiz system uses a client-server architecture for easy management and scalability. The system was built with a combination HTML, CSS, JavaScript, and PHP. Live sessions are implemented with AJAX, which enables real-time communication between the client and server. The system is containerized using Docker which allows the app to run consistently across different environments. The key components are defined below:
<br>

- Client: The client-side InstaQuiz application runs in a web browser and is responsible for providing an interactive interface for both instructors and students. The instructor UI includes various tools for managing quizzes, such as setting up courses, creating questions, starting live sessions, and retrieving quiz metrics. On the other hand, the student UI allows students to join live sessions, participate in the quizzes, and view their grades. The client-side of the system is also responsible for communicating with the server in order to operate all of the interactive features.
<br>

- Server: The server-side application interacts with the database and sends updates to the client-side application in response to requests from the client-side application. The server handles user requests for registration, login, password reset, course creation/deletion, course enrollment/unenrollment, session start/end, question start/end, etc.
<br>

- Database: A database is used to store relevant information for user accounts, courses, questions, and scores, which is accessed by the server-side application. Hashing functions are in place where necessary, to achieve security for sensitive data, and the overall schema is streamline to ensure minimal storage is used.
<br>

Upon reflection, we built almost exactly what we planned to. The interactions are as expected, every function and feature is working smoothly, and the appearance and aesthetics are consistent and attractive. We feel InstaQuiz is a comprehensive and easy-to-use iclicker clone system and that was our vision for this project.
<br>

### 4. What degree and level of reuse was the team able to achieve and why? 
Many components were reused across both student and instructor accounts as they have similar requirements. Database connections, authentication processes, and form validation functions, to name a few. We also reused plenty of HTML code for front end things like headers, fonts, colors, Throughout our development process, we kept our basic templates in a folder made available to all so that consistent software development was easy. We were able to achieve this high level of re-use by standardizing our site's processes as much as possible, frequently sharing our latest work with the rest of our team, and communicating constantly.
<br
    
### 5. How many tasks are left in the backlog?: 
There is only 1 task left in the backlog (implement live poll summary feature for user requirement #16). 
<br>



# CI/CD:

### 1. What testing strategies did you implement?  Comment on their degree of automation and the tools used.  Would you (as a team) deal with testing differently in the future?  Make sure to ensure that your testing report is updated to reflect what's actually been done. 

Throughout this project, we utilized test driven development strategies to plan and frame our system structure, guide our logic as we implemented new features, and verify the functionality of our code. After creating diagrams, writing up requirements, and completing the formal analysis of our project, we were ready to code. The first step we took was writing java unit tests for all our functional requirements. We chose to start in java as it was the language most common to all team members and we all felt confident in our ability to accurately draft what our system would look like and how different entities would interact. After completing these unit tests using Junit (fully automated), we completed our corresponding classes and methods. Next, we began researching web development more deeply, and found we would probably need to write code in a scripting language to develop a live and interactive iclicker clone website. Realizing we would undoubtedly need to pivot and implement some different programming languages, we decided to use the tests and classes/objects we had coded in java as a framework for our overall system and began learning PHP as a team. This was a new language to all five of us, but as we experimented and learned more we felt confident that PHP was the best way to implement our vision for the InstaQuiz system. Through our exploration of PHP we simultaneously had team members working on HTML for the front end design of our different site pages. This stage of the project consisted of some team members writing experimental PHP code to implement functionality between our pages and working that code into our HTML pages as HTML allows you to embed PHP in the same file. We had great success in this stage as we found we were able to navigate between pages, include clickable buttons, and much more. Now that we had a more comprehensive understanding of both the PHP language and the exact features we were going to include in the InstaQuiz size, we began researching unit testing in PHP as we understood test driven development was a major requirement for this project. Our next step was implementing PHPunit (similar to Junit, also fully automatic) and finding ways to test the site functionalities we planned on demonstrating in our final product video. Once we had these in place, we were able to go back through our site, modify and update the experimental PHP we already had in place, and verify our InstaQuiz website was working as expected. Our final product is an incredible functional and extensive iclicker clone website. Reflecting on our project process, we realized that during our transition from Java to PHP, we may have over eagerly started coding in PHP without  implementing unit tests first. While this is something we would definitely adjust in a future software engineering project, we utilized test driven development regularly and repeatedly throughout this project and feel we achieved all the objectives of a great test driven development software engineering project. 
<br>

### 2. How did your branching workflow work for the team?  Were you successful in properly reviewing the code before merging as a team?

The branching workflow worked great for our team. Every large component of the system was completed in a separate branch e.g. PHP files, live sessions, CICD, and testing. As a team we always worked on a couple different branches at a time and had verification every time code was ready to be merged. 
<br>

### 3. How would your project be deployed?  Is it docker ready and tested?  Provide a brief description of the level of dockerization you have implemented and what would be required to deploy.

Our project is fully docker ready and tested. Our code includes a docker-compose.yml file that builds containers for our database, auto imports our sql ddl, and sets up ports to host the website on the local machine. All that is required to deploy InstaQuiz is a computer with internet access, docker desktop installed, and an IDE to run the docker-compose up -d (we recommend VS Code as that is what we used throughout this project).
<br>



# Reflections:

### 1. How did your project management work for the team?  What was the hardest thing and what would you do the same/differently the next time you plan to complete a project like this?

As a team we feel we did a great job managing this project, however, there were definitely some challenges. The hardest thing was probably estimating the time it would take for each task. As a majority of the project work was new to us, we found some things took much longer than expected. Getting the live session to support multiple users from different machines and having our docker-compose file auto import our sql ddl were a few examples of this. In future, we would spend slightly more time researching all components before giving a clear framework of what our system would look like.
<br>

### 2. Do you feel that your initial requirements were sufficiently detailed for this project?  Which requirements did you miss or overlook?

Absolutely. We had a very comprehensive idea of what we wanted our site to do and by completing our requirements we created an operational online quiz system that met our high expectations and even implemented features we didn't originally plan on like the forgotten password recovery feature.
<br>

### 3. What did you miss in your initial planning for the project (beyond just the requirements)?

One thing we did not account for was troubleshooting the live session feature. Having multiple users on different computers accessing the site at once is the backbone of an iclicker clone system but this turned out to be an extremely challenging part of this project and we did not fully anticipate the work it took to make this happen. We also did not plan to learn a new language (PHP) but deemed this necessary once we learned more about web page development and scripting languages. These unexpected workloads could potentially have been planned for with some more in-depth research during the early stages of the project.
<br>

### 4. What process did you use (ie Scrum, Kanban..), how was it managed, and what was observed?

The Kanban process was used for our project. It was managed using a project table in GitHub. Large features were broken into smaller tasks and each team member self assigned themselves to tasks as they took them on. We divided tasks into three sprint cycles (1, 2, and Final) and made sure every task had a brief description in language that any stakeholder could understand (i.e. no computer science lingo). We also categorized each task as either Student, Instructor, Both, or N/A. The Kanban board was consistently updated throughout the development process. We also had frequent meetings to discuss new tasks and solutions, as well as meetings where we coded together. Our approach to the project evolved several times but the Kanban process kept every team member up to date and helped maintain a clear vision for the InstaQuiz system we wanted to build. 
<br> 

### 5. As a team, did you encounter issues with different team members developing with different IDEs?  In the future, would the team change anything in regard to the uniformity of development environments?

As a team we all agreed to develop in VS Code as we were all familiar with it and found that it collaborated with GitHub nicely. This made our process smooth as we could help each other as we ran into error messages, screen sharing demos were easily understood, and the push pull process was the same for all team members. We would not change anything in regards to the uniformity of the development environment.
<br>

### 6. If you were to estimate the efforts required for this project again, what would you consider?  (Really I am asking the team to reflect on the difference between what you thought it would take to complete the project vs what it actually took to deliver it).  

This project required more effort than any of us imagined. For all five of us, this was the first software engineering project of this magnitude we had been a part of. There were many unexpected setbacks, including having to learn a whole new programming language (PHP) and implement it as the backbone of our system's functionality. But we navigated all of these hiccups well and were able to stay more or less on track. Overall, it was a great deal of work and yet an even more robust learning experience.                                                                                                                                                     7. 
<br>

### 7. What did your team do that you feel is unique or something that the team is especially proud of (was there a big learning moment that the team had in terms of gaining knowledge of a new concept/process that was implemented).

Our team's greatest strength was without a doubt communication. After a somewhat quiet start, we expanded our communication protocols to include live voice channel meetings with shared screens, regular updates with every push/pull, and an incredibly active discord chat. Without knowing the exact strategy of other teams, we feel we were unique in our choice to divide work among team members based on ability and experience. Some of us were more familiar with web development and docker, some have taken multiple database courses, some were better report writers, and others had great creative abilities for our front end design. To summarize, we were able to have all team members contribute to and learn about every aspect of the project, while also making sure everyone was confident in the work they were doing and that helped us produce a final product we are all very proud of.
<br>

