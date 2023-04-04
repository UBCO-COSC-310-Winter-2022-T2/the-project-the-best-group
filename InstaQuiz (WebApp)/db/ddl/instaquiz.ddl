/*-----------------------INSTAQUIZ DATABASE STARTER CODE-----------------------------------*/

-- added starter values for each table so we won't need to manually register or add courses
-- when we want to demonstate the system, can add more if we want for final demo video

USE instaquiz; -- our database

/*------------------------------ ACCOUNTS -------------------------------------------------*/

CREATE TABLE accounts (
    id INT AUTO_INCREMENT,
    permission BIT(1) NOT NULL, -- 0 = student, 1 = instructor
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rtoken CHAR(8) DEFAULT (UUID()), -- generates a random 8 char token (for forgot password recovery)
    PRIMARY KEY (id)
);

-- John Doe is a student (id auto set to 1)
INSERT INTO accounts (permission, fname, lname, email, password) 
VALUES (0, 'John', 'Doe', 'johndoe@mail.com', 'johnpw');

-- Jane Doe is a instructor (id auto set to 2)
INSERT INTO accounts (permission, fname, lname, email, password) 
VALUES (1, 'Jane', 'Doe', 'janedoe@mail.com', 'janepw');

-- Henry Smith is a student (id auto set to 3)
INSERT INTO accounts (permission, fname, lname, email, password) 
VALUES (0, 'Henry', 'Smith', 'hsmith@mail.com', 'henrypw');

-- Harold Smith is an instructor (id auto set to 4)
INSERT INTO accounts (permission, fname, lname, email, password) 
VALUES (1, 'Harold', 'Smith', 'haroldsmith@mail.com', 'haroldpw');

-- Greg Green is an student (id auto set to 5)
INSERT INTO accounts (permission, fname, lname, email, password) 
VALUES (0, 'Greg', 'Green', 'greggreen@mail.com', 'gregpw');

-- Al Anderson is an instructor (id auto set to 6)
INSERT INTO accounts (permission, fname, lname, email, password) 
VALUES (1, 'Al', 'Anderson', 'alanderson@mail.com', 'alpw');

/*------------------------------ COURSES -------------------------------------------------*/

CREATE TABLE courses (
    cid INT AUTO_INCREMENT PRIMARY KEY,
    cname VARCHAR(255) NOT NULL,
    Iid int NOT NULL -- id of instructor
);

-- course (id auto set to 1) is "Computer Human Interaction", it is taught by instructor Al Anderson (account id 6)
INSERT INTO courses (cname, Iid)
VALUES ('Computer Human Interaction', 6);

-- course (id auto set to 2) is "Machine Architecture", it is taught by instructor Harold Smith (account id 4)
INSERT INTO courses (cname, Iid)
VALUES ('Machine Architecture', 4);

-- course (id auto set to 3) is "Data Structures", it is taught by instructor Jane Doe (account id 2)
INSERT INTO courses (cname, Iid)
VALUES ('Data Structures', 4);

-- course (id auto set to 4) is "Intro To Database Systems", it is taught by instructor Harold Smith (account id 4)
INSERT INTO courses (cname, Iid)
VALUES ('Intro To Database Systems', 4);

-- course (id auto set to 5) is "Software Engineering", it is taught by instructor Jane Doe (account id 2)
INSERT INTO courses (cname, Iid)
VALUES ('Software Engineering', 2);

/*------------------------------ QUESTIONS -------------------------------------------------*/

CREATE TABLE questions (
  qid INT AUTO_INCREMENT PRIMARY KEY,
  cid INT NOT NULL,
  prompt VARCHAR(255), -- prompt string includes answer options ex: ('Capital of BC? A=Vancouver, B=Victoria,')
  answer CHAR(1)
);

-- starter code questions are just for example, not actually relavent to the course topics

-- 4 questions in course 1
INSERT INTO questions (cid, prompt, answer)
VALUES 
(1, 'Whats 8-3? A=3, B=4, C=5, D=6', 'C'),
(1, 'What province is Vancouver in? A=British Columbia, B=Alberta, C=Ontario, D=Manitoba', 'A'),
(1, 'Whats 3 times 2? A=3, B=4, C=5, D=6', 'D'),
(1, 'How many continents are there? A=7, B=40, C=12', 'A');

-- 2 questions in course 2
INSERT INTO questions (cid, prompt, answer)
VALUES 
(2, 'Whats 2.5 doubled? A=3, B=4, C=5, D=6', 'C'),
(2, 'What province is the furthest east? A=British Columbia, B=Alberta, C=Ontario, D=Manitoba', 'C');

-- 4 questions in course 3
INSERT INTO questions (cid, prompt, answer)
VALUES 
(3, 'What color is a banana? A=Red, B=Orange, C=Yellow, D=Green', 'C'),
(3, 'What province is Calgary in? A=British Columbia, B=Alberta, C=Ontario, D=Manitoba', 'B'),
(3, 'Whats 5+1? A=3, B=4, C=5, D=6', 'D');

-- 4 questions in course 4
INSERT INTO questions (cid, prompt, answer)
VALUES 
(4, 'How sides does a stop sign have? A=3, B=4, C=5, D=8', 'D'),
(4, 'What province is Toronto in? A=British Columbia, B=Alberta, C=Ontario, D=Manitoba', 'C'),
(4, 'Whats 3 times 1? A=3, B=4, C=5, D=6', 'A');

-- 4 questions in course 5
INSERT INTO questions (cid, prompt, answer)
VALUES
(5, 'Whats 2+2? A=3, B=4, C=5, D=6', 'B'),
(5, 'What province is Kelowna in? A=British Columbia, B=Alberta, C=Ontario, D=Manitoba', 'A'),
(5, 'Whats 4 divided by 1? A=3, B=4, C=5, D=6', 'B'),
(5, 'How many states are there in the USA? A=50, B=40, C=30', 'A');

/*------------------------------------ ENROLLMENT -------------------------------------------*/

CREATE TABLE enrollment (
  cid INT NOT NULL,
  sid INT NOT NULL,
  PRIMARY KEY (cid, sid),
  FOREIGN KEY (cid) REFERENCES courses(cid),
  FOREIGN KEY (sid) REFERENCES accounts(id)
);

-- student 1 (John Doe) is enrolled in course 1 and 2
INSERT INTO enrollment (sid, cid)
VALUES (1,1), (1,2);

-- student 3 (Henry Smith) is enrolled in course 2 and 4
INSERT INTO enrollment (sid, cid)
VALUES (3,2), (3,4);

-- student 5 (Greg Green) is enrolled in course 3 4 and 5
INSERT INTO enrollment (sid, cid)
VALUES (5,3), (5,4), (5,5);

/*-------------------------- SCORES -----------------------------------------------*/

CREATE TABLE scores (
  scoreid INT AUTO_INCREMENT PRIMARY KEY, -- unique identifier for score entries so that we can delete rows and edit this table
  sid INT,
  cid INT,
  totalCorrect INT, -- need a method to incremented everytime a student answers a question correctly (use sid)
  totalAsked INT -- need a method to increment everytime a course posts a question (use cid)
);

-- John Doe has answered 2 questions correct out of 4 in course 1 and is 1 for 2 in course 2
INSERT INTO scores (sid, cid, totalCorrect, totalAsked)
VALUES (1, 1, 2, 4), (1, 2, 1, 2);

-- Greg Green has answered all 3 questions correct for course 3 and 4 and all 4 correct for course 5
INSERT INTO scores (sid, cid, totalCorrect, totalAsked)
VALUES (5, 3, 3, 3), (5, 4, 3, 3), (5, 5, 4, 4);

-- Henry Smith has answered all 3 questions correct in course 4 and 1 out of 2 correct in course 2.
INSERT INTO scores (sid, cid, totalCorrect, totalAsked)
VALUES (3, 4, 3, 3), (3, 2, 1, 2);
