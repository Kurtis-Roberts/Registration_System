/*sql file*/
/*don't run this without reading and understanding the first few lines*/

DROP DATABASE IF EXISTS group2;
CREATE DATABASE IF NOT EXISTS group2;
USE group2;

DROP TABLE IF EXISTS Student;
CREATE TABLE Student
	(Student_ID		SMALLINT UNSIGNED NOT NULL,
	 Fname			VARCHAR(25),
	 Lname			VARCHAR(25),
	 Email			VARCHAR(64),
	 Address		VARCHAR(128),
	 City			Varchar(25),
	 Addr_State 	VARCHAR(2),
	 ZIP			VARCHAR(5),
	 Advisor_ID		SMALLINT UNSIGNED,
	 Program_ID		TINYINT UNSIGNED,
	 CONSTRAINT PK_Students_StudentID PRIMARY KEY (Student_ID)
	 );
	 
DROP TABLE IF EXISTS Course;	 
CREATE TABLE Course
	(Course_ID		SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
	Course_NUM		VARCHAR(10),
	Course_Title	VARCHAR(40),
	Credits			TINYINT UNSIGNED,
	Semester		VARCHAR(10) default 'Fall',
	Course_Year		YEAR default 2020,
	IS_Open			Binary default 1,
	Day_Time		VARCHAR(25),
	Room			VARCHAR(20),
	Faculty_ID		SMALLINT UNSIGNED,
	Prereq			SMALLINT UNSIGNED,
	Program_ID		SMALLINT UNSIGNED,
	CONSTRAINT PK_Course_CourseID PRIMARY KEY (Course_ID)
	);
	
DROP TABLE IF EXISTS Enrollment;
CREATE TABLE Enrollment
	(Enroll_ID		INT UNSIGNED AUTO_INCREMENT NOT NULL,
	Student_ID		SMALLINT UNSIGNED NOT NULL,
	Course_ID		SMALLINT UNSIGNED NOT NULL,
	Grade			VARCHAR(2),
	Date_Enrolled	DATE,
	Date_Dropped	DATE,
	Status			VARCHAR(10) Default 'ENROLLED',
	CONSTRAINT PK_Enrollment_Enroll_ID PRIMARY KEY (Enroll_ID)
	);
	
DROP TABLE IF EXISTS Faculty;
CREATE TABLE Faculty
	(Faculty_ID		SMALLINT UNSIGNED NOT NULL,
	Lname			VARCHAR(25),
	Fname			VARCHAR(25),
	Title			Varchar(25),
	Program_ID		SMALLINT UNSIGNED,
	CONSTRAINT PK_Faculty_Faculty_ID PRIMARY KEY (Faculty_ID)
	);
	

DROP TABLE IF EXISTS Advisor;
CREATE TABLE Advisor
	(Advisor_ID		SMALLINT UNSIGNED NOT NULL,
	Lname			VARCHAR(25),
	Fname			VARCHAR(25),
	CONSTRAINT PK_Advisor_AdvisorID PRIMARY KEY (Advisor_ID)
	);
	
DROP TABLE IF EXISTS Program;
CREATE TABLE Program
	(Program_ID		SMALLINT UNSIGNED NOT NULL,
	Name			VARCHAR(25),
	CONSTRAINT PRIMARY KEY (Program_ID)
	);
	
DROP TABLE IF EXISTS Login;
CREATE TABLE Login
	(User_ID		SMALLINT UNSIGNED NOT NULL,
	Roles			VARCHAR(8) NOT NULL,
	Password		VARCHAR(255) NOT NULL,
	CONSTRAINT PRIMARY KEY (User_ID)
	);
	
INSERT INTO Advisor
	Values	(1275, 'Doe', 'John'),
			(1460, 'Streep', 'Meryl'),
			(3333, 'Bio', 'Heather');
			
INSERT INTO Program
	Values	(1, 'IS'),
			(2, 'BME');
INSERT INTO Student
	Values	(5976, 'Chris', 'Robinson', 'u0597604@utah.edu', '123 Fake St', 'Holladay', 'UT', '84111', 1275, 1),
			(1666, 'Kurtis', 'Roberts', 'u1166615@utah.edu', '124 Fake St', 'Holladay', 'UT', '84111', 1460, 1),
			(9472, 'Cristian', 'Cortes', 'u0947219@utah.edu', '125 Fake St', 'Holladay', 'UT', '84111', 1275, 1),
			(2664, 'Savanna', 'Montgomery', 'u1266415@utah.edu', '126 Fake St', 'Holladay', 'UT', '84111', 1275, 1),
			(2222, 'Paula', 'Jones', 'u2222@utah.edu', '567 Faker Rd', 'Layton', 'UT', '84848', 1460, 1),
			(8074, 'Shaylah', 'Sells', '8074@utah.edu', '0107 Grim Hill', 'Salt Lake City', 'UT', '84120', 3, 2),
			(8491, 'Feodora', 'Robjant', '8491@utah.edu', '76732 Bartelt Drive', 'Salt Lake City', 'UT', '84142', 3, 2),
			(8226, 'Sigfried', 'O Doohaine', '8226@utah.edu', '27963 Maryland Drive', 'Salt Lake City', 'UT', '84193', 3, 2),
			(9014, 'Maxy', 'Klimes', '9014@utah.edu', '5 Blaine Crossing', 'Salt Lake City', 'UT', '84176', 3, 2),
			(9121, 'Myrwyn', 'Farmar', '9121@utah.edu', '72419 1st Way', 'Salt Lake City', 'UT', '84199', 2, 1),
			(9305, 'Denny', 'Haps', '9305@utah.edu', '44327 Reindahl Court', 'Salt Lake City', 'UT', '84125', 3, 2),
			(8513, 'Roseanna', 'MacEllen', '8513@utah.edu', '22 Di Loreto Lane', 'Salt Lake City', 'UT', '84180', 2, 1),
			(8933, 'Roosevelt', 'Burnand', '8933@utah.edu', '77 Harbort Avenue', 'Salt Lake City', 'UT', '84153', 3, 2),
			(9370, 'Dulcy', 'Christofol', '9370@utah.edu', '9312 Carioca Hill', 'Salt Lake City', 'UT', '84108', 3, 2),
			(9005, 'Kenna', 'Beards', '9005@utah.edu', '91 Fulton Road', 'Salt Lake City', 'UT', '84171', 2, 1);
			
INSERT INTO Faculty
	Values 	(7492, 'Case', 'Jacob', 'Professor', 1),
			(5783, 'Oh', 'Chong', 'Director', 1),
			(8466, 'Repak', 'Ben', 'Professor', 1),
			(3773, 'Cook', 'Jared', 'Professor', 1),
			(1192, 'Dixon', 'Aaron', 'Professor', 1),
			(0878, 'Frisbee', 'Adam', 'Professor', 1),
			(1010, 'Christensen', 'Ben', 'Research Associate', 2),
			(3070, 'Joshi', 'Sarang', 'Adjunct', 2),
			(3301, 'Ellis', 'Bejnamin', 'Research Associate', 2),
			(4001, 'Rabbitt', 'Richard', 'Professor', 2),
			(4301, 'Tresco', 'P.A.', 'Professor', 2);
			
INSERT INTO Course (Course_NUM, Course_Title, Credits, Semester, Course_Year, IS_Open, Day_Time, Room, Faculty_ID, Prereq, Program_ID)
	Values 	('IS 4410', 'Information Systems', 3, 'Spring', 2019, 1, 'MW 9:00-11:00', 'SFEBB 110', '5783', NULL, 1),
			('IS 4415', 'Data Structure and Java', 3, 'Fall', 2019, 1, 'M 6:00-9:00', 'SFEBB 520', '8466', NULL, 1),
			('IS 4420', 'Database Fundamentals', 3, 'Fall', 2019, 1, 'MW 9:00-11:00', 'SFEBB 110', '5783', NULL, 1),
			('IS 4430', 'System Analysis and Design', 3, 'Fall', 2019, 1, 'MW 9:00-11:00', 'SFEBB 110', '8466', NULL, 1),
			('IS 4440', 'Networking and Servers', 3, 'Fall', 2019, 1, 'TH 6:00-9:00', 'SFEBB 510', '8466', NULL, 1),
			('IS 4460', 'Web Based Applications', 3, 'Fall', 2019, 1, 'T 5:00-9:00', 'SFEBB 112', '5783', NULL, 1),
			('IS 4470', 'Telecom and Security', 3, 'Fall', 2019, 1, 'MW 9:45-11:00', 'SFEBB 110', '5783', NULL, 1),
			('IS 4482', 'Business Data Mining', 3, 'Fall', 2019, 1, 'W 10:00-12:15', 'CRCC 110', '5783', NULL, 1),
			('IS 4485', 'Python', 3, 'Fall', 2019, 1, 'MW 11:00-1:15', 'CRCC 110', '8466', NULL, 1),
			('IS 4410', 'Information Systems', 3, 'Spring', 2021, 1, 'MW 9:00-11:00', 'SFEBB 110', '5783', NULL, 1),
			('IS 4415', 'Data Structure and Java', 3, 'Fall', 2020, 1, 'M 6:00-9:00', 'SFEBB 520', '8466', NULL, 1),
			('IS 4420', 'Database Fundamentals', 3, 'Fall', 2020, 1, 'MW 9:00-11:00', 'SFEBB 110', '5783', NULL, 1),
			('IS 4430', 'System Analysis and Design', 3, 'Fall', 2020, 1, 'MW 9:00-11:00', 'SFEBB 110', '8466', NULL, 1),
			('IS 4440', 'Networking and Servers', 3, 'Fall', 2020, 1, 'TH 6:00-9:00', 'SFEBB 510', '8466', NULL, 1),
			('IS 4460', 'Web Based Applications', 3, 'Fall', 2020, 1, 'T 5:00-9:00', 'SFEBB 112', '5783', NULL, 1),
			('IS 4470', 'Telecom and Security', 3, 'Fall', 2020, 1, 'MW 9:45-11:00', 'SFEBB 110', '1192', NULL, 1),
			('IS 4482', 'Business Data Mining', 3, 'Fall', 2020, 1, 'W 10:00-12:15', 'CRCC 110', '5783', NULL, 1),
			('IS 4485', 'Python', 3, 'Fall', 2020, 1, 'MW 11:00-1:15', 'CRCC 110', '8466', NULL, 1),
			('BME 1010', 'Fundamentals of BME', 3, 'Spring', 2018, 1, 'TH 11:50-12:40', 'MEB 1234', '1010', NULL, 2),
			('BME 1010', 'Fundamentals of BME', 3, 'Spring', 2021, 1, 'TH 11:50-12:40', 'MEB 1234', '1010', NULL, 2),
			('BME 3070', 'BME Statistics', 3, 'Spring', 2018, 1, 'TH 12:25-1:45', 'WEB 1234', '3070', NULL, 2),
			('BME 3070', 'BME Statistics', 3, 'Spring', 2021, 1, 'TH 12:25-1:45', 'WEB 1234', '3070', NULL, 2),
			('BME 3301', 'Bioen Computing Methods', 3, 'Spring', 2018, 1, 'MW 11:50-1:10', 'MEB 3555', '3301', NULL, 2),
			('BME 3301', 'Bioen Computing Methods', 3, 'Spring', 2021, 1, 'MW 11:50-1:10', 'MEB 3555', '3301', NULL, 2),
			('BME 4001', 'Biotransport', 4, 'Spring', 2018, 1, 'Hybrid', 'ONLINE', '4001', NULL, 2),
			('BME 4001', 'Biotransport', 4, 'Spring', 2021, 1, 'Hybrid', 'ONLINE', '4001', NULL, 2),
			('BME 4301', 'Modern Biomaterial', 4, 'Spring', 2018, 1, 'Hybrid', 'ONLINE', '4301', NULL, 2),
			('BME 4301', 'Modern Biomaterial', 4, 'Spring', 2021, 1, 'Hybrid', 'ONLINE', '4301', NULL, 2);
			
INSERT INTO Login /*all passwords are same as username except pjones/acrobat (2222) and bsmith/mysecret (1111) */
	Values  (1275, 'Advisor', '2e5f88ee2282c9df62607fbda1a894fc'),
			(1460, 'Advisor', 'dbc9fdb82021342fde259eb3127432d0'),
			(5976, 'Student', 'ceaad5fd8c0635cbdccd7ea2546af524'),
			(1666, 'Student', 'd38eba68e4a76aae81dfded148415b91'),
			(9472, 'Student', 'bbf2d0ea255e064f30a4a9c10ba97b03'),
			(2664, 'Student', '731250d8800dcebf3796b4c6ef2f82d9'),
			(7492, 'Faculty', 'b7b84c9fe644eac2775d07c31f44b393'),
			(5783, 'Faculty', 'f84eeb609f1afdbbe78b2adcb936c024'),
			(8466, 'Faculty', 'a00d3132988172c6e8cc8e0eae2a80c0'),
			(2222, 'Student', 'dd0025fdf81e0fff19e29f6a4c01bd0d'),
			(1111, 'Admin', '1548033ab8e12573cf5e62eb835b9473');
			
INSERT INTO Enrollment (Student_ID, Course_ID, Grade, Date_Enrolled, Date_Dropped, Status)
	Values 	(5976, 1, 'B', '2018-11-11', NULL, 'PASS'),
			(5976, 3, 'A', '2018-11-11', NULL, 'PASS'),
			(5976, 2, 'F', '2018-11-11', NULL, 'FAIL'),
			(5976, 5, 'C', '2018-11-11', NULL, 'PASS'),
			(5976, 6, 'A', '2018-11-11', NULL, 'PASS'),
			(5976, 2, NULL, '2018-11-11', '2018-12-12', 'DROP'),
			(1666, 1, 'B', '2018-11-11', NULL, 'PASS'),
			(1666, 3, 'A', '2018-11-11', NULL, 'PASS'),
			(1666, 2, 'F', '2018-11-11', NULL, 'FAIL'),
			(1666, 5, 'C', '2018-11-11', NULL, 'PASS'),
			(1666, 6, 'A', '2018-11-11', NULL, 'PASS'),
			(1666, 2, NULL, '2018-11-11', '2018-12-12', 'DROP'),
			(9472, 1, 'B', '2018-11-11', NULL, 'PASS'),
			(9472, 3, 'A', '2018-11-11', NULL, 'PASS'),
			(9472, 2, 'F', '2018-11-11', NULL, 'FAIL'),
			(9472, 5, 'C', '2018-11-11', NULL, 'PASS'),
			(9472, 6, 'A', '2018-11-11', NULL, 'PASS'),
			(9472, 2, NULL, '2018-11-11', '2018-12-12', 'DROP'),
			(2664, 1, 'B', '2018-11-11', NULL, 'PASS'),
			(2664, 3, 'A', '2018-11-11', NULL, 'PASS'),
			(2664, 2, 'F', '2018-11-11', NULL, 'FAIL'),
			(2664, 5, 'C', '2018-11-11', NULL, 'PASS'),
			(2664, 6, 'A', '2018-11-11', NULL, 'PASS'),
			(2664, 2, NULL, '2018-11-11', '2018-12-12', 'DROP'),
			(2222, 1, 'B', '2018-11-11', NULL, 'PASS'),
			(2222, 3, 'A', '2018-11-11', NULL, 'PASS'),
			(2222, 2, 'F', '2018-11-11', NULL, 'FAIL'),
			(2222, 5, 'C', '2018-11-11', NULL, 'PASS'),
			(2222, 6, 'A', '2018-11-11', NULL, 'PASS'),
			(2222, 2, NULL, '2018-11-11', '2018-12-12', 'DROP'),
			(8074, 19, 'A', '2017-10-10', NULL, 'PASS'),
			(8074, 21, 'B', '2017-10-10', NULL, 'PASS'),
			(8074, 23, 'B', '2017-10-10', NULL, 'PASS'),
			(8074, 25, 'A', '2017-10-10', NULL, 'PASS'),
			(8074, 27, 'D', '2017-10-10', NULL, 'FAIL'),
			(8491, 19, 'A', '2017-10-10', NULL, 'PASS'),
			(8491, 21, 'B', '2017-10-10', NULL, 'PASS'),
			(8491, 23, 'B', '2017-10-10', NULL, 'PASS'),
			(8491, 25, 'A', '2017-10-10', NULL, 'PASS'),
			(8491, 27, 'D', '2017-10-10', NULL, 'FAIL'),
			(8226, 19, 'A', '2017-10-10', NULL, 'PASS'),
			(8226, 21, 'B', '2017-10-10', NULL, 'PASS'),
			(8226, 23, 'B', '2017-10-10', NULL, 'PASS'),
			(8226, 25, 'A', '2017-10-10', NULL, 'PASS'),
			(8226, 27, 'D', '2017-10-10', NULL, 'FAIL'),
			(9014, 19, 'A', '2017-10-10', NULL, 'PASS'),
			(9014, 21, 'B', '2017-10-10', NULL, 'PASS'),
			(9014, 23, 'B', '2017-10-10', NULL, 'PASS'),
			(9014, 25, 'A', '2017-10-10', NULL, 'PASS'),
			(9014, 27, 'D', '2017-10-10', NULL, 'FAIL'),
			(8074, 19, 'A', '2017-10-10', NULL, 'PASS'),
			(8074, 21, 'B', '2017-10-10', NULL, 'PASS'),
			(8074, 23, 'B', '2017-10-10', NULL, 'PASS'),
			(8074, 25, 'A', '2017-10-10', NULL, 'PASS'),
			(8074, 27, 'D', '2017-10-10', NULL, 'FAIL'); 
	
