USE instaquiz;

CREATE TABLE account (
    id INT AUTO_INCREMENT PRIMARY KEY,
    permission BIT(1) NOT NULL,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO account (permission, fname, lname, email, password) VALUES (0, 'John', 'Doe', 'johndoe@mail.com', 'johndoepw');
INSERT INTO account (permission, fname, lname, email, password) VALUES (1, 'Jane', 'Doe', 'janedoe@mail.com', 'janedoepw');
