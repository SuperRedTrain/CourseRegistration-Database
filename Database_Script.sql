CREATE DATABASE course_registration;

CREATE TABLE STUDENT
(Student_ID Int(20),
 Password Int(20),
 Major Varchar(20),
 Name Varchar(50),
 Address Varchar(100),
 Email Varchar(100),
 Phone_number Varchar(15),
 College Varchar(50),
 Admit_term Varchar(20),
 Current_program Varchar(30)   
); 

CREATE TABLE COURSE
(Course_number Int(9),
 Course_name Varchar(30),
 Department Varchar(30),
 Credit_hours Int(5)  
); 

CREATE TABLE SECTION
(Section_identifier Int(9),
 Course_number Int(9),
 Year Int(9),
 Semester Varchar(15),
 Instructor Varchar(25),
 Schedule_time Varchar(50)
); 


CREATE TABLE GRADE
(Student_ID Int(20),
 Section_identifier Int(9),
 Grade Varchar(5)
); 


CREATE TABLE PREREQUISITE
(Course_number Int(9),
 Prerequisite_number Int(9)
);

CREATE TABLE REGISTERED
(Student_ID Int(20),
 Section_identifier Int(9)
);
