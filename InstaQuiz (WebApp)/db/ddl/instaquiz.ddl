/*
This can be our simple first iteration of the database schema. We can slowly add 
more tables, attributes, etc to support more features but this should support 
basics like checking who is in a class, who the instructor is, creating/asking questions, 
checking if a response is correct, and checking grades. Hopefully we can use this outline to 
start writing queries and making our pages functional
*/

USE instaquiz; -- our database

/*------------------------------ ACCOUNTS -------------------------------------------------*/

CREATE TABLE accounts (
    id INT AUTO_INCREMENT,
    permission BIT(1) NOT NULL, -- 0 = student, 1 = instructor
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    -- rtoken VARCHAR(36) DEFAULT UUID() UNIQUE, -- generates a random token (for forgot password recovery). Default keyword means we dont need to assign a value, system will do automatically
    PRIMARY KEY (id)
);

-- John Doe is a student (id auto set to 1)
INSERT INTO accounts (permission, fname, lname, email, password) 
VALUES (0, 'John', 'Doe', 'johndoe@mail.com', 'johndoepw');


-- Jane Doe is a instructor (id auto set to 2)
INSERT INTO accounts (permission, fname, lname, email, password) 
VALUES (1, 'Jane', 'Doe', 'janedoe@mail.com', 'janedoepw');

-- Henry Smith is a student (id auto set to 3)
INSERT INTO accounts (permission, fname, lname, email, password) 
VALUES (0, 'Henry', 'Smith', 'hsmith@mail.com', 'henrypw');

/*------------------------------ COURSES -------------------------------------------------*/


CREATE TABLE courses (
    cid INT AUTO_INCREMENT PRIMARY KEY,
    cname VARCHAR(255) NOT NULL,
    Iid int NOT NULL -- id of instructor
);

-- to check if a student is in a class write query returning students string for that course and then see if it contains the sid

-- course 5 is "Software Engineering", it is taught by instructor Jane Doe (account id 2)
INSERT INTO courses (cid, cname, Iid)
VALUES (5, 'Software Engineering', 2);


/*------------------------------ QUESTIONS -------------------------------------------------*/

CREATE TABLE questions (
  qid int AUTO_INCREMENT PRIMARY KEY,
  cid int NOT NULL,
  prompt VARCHAR(255), -- prompt string includes answer options ex: ('Capital of BC? A=Vancouver, B=Victoria,')
  answer CHAR(1)
);

-- question 1 in course 5 (Software Engineering) is 'What is 2+2?', correct answer is B
INSERT INTO questions (qid, cid, prompt, answer)
VALUES (1, 5, 'What 2+2? A=3, B=4, C=5, D=6', 'B');

-- question 2 in course 5 (Software Engineering) is 'What province is Kelowna in?', correct answer is A
INSERT INTO questions (qid, cid, prompt, answer)
VALUES (2, 5, 'What province is Kelowna in? A=British Columbia, B=Alberta, C=Ontario, D=Manitoba', 'A');


/*------------------------------------ ENROLLMENT -------------------------------------------*/

CREATE TABLE enrollment (
  cid INT NOT NULL,
  sid INT NOT NULL,
  PRIMARY KEY (cid, sid),
  FOREIGN KEY (cid) REFERENCES courses(cid),
  FOREIGN KEY (sid) REFERENCES accounts(id)
);

-- student 1 (John Doe) is enrolled in course 5
INSERT INTO enrollment (sid, cid)
VALUES (1,5);

-- Simple table to keep track of enrollment. Query SELECT * FROM enrollment WHERE sid = _____ 
-- to get a list of courses a particular student is enrolled in. 

/*-------------------------- SCORES -----------------------------------------------*/

CREATE TABLE scores (
  sid int,
  cid int,
  totalCorrect int, -- need a method to incremented everytime a student answers a question correctly (use sid)
  totalAsked int -- need a method to increment everytime a course posts a question (use cid)
);
/*
This system would mean that students have a table row for each course they are in. Grades can be
checked using a query based on student id and course id, can return score as a fraction 
Basically, the return score string would be in the format: totalCorrect + "/" + total asked 
although we could probably easliy write code to do the math for them too if we want
*/

-- John Doe has answered 3 questions correct in course 5 (Software Engineering) 
-- and there have been a total int4 questions for that class
INSERT INTO scores (sid, cid, totalCorrect, totalAsked)
VALUES (1, 5, 3, 4);
