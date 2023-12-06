-- Script for universal database setup
-- File Completed By: Group 9

CREATE TABLE Users (
    UIN INT PRIMARY KEY,
    First_Name VARCHAR(255),
    M_Initial CHAR,
    Last_Name VARCHAR(255),
    Username VARCHAR(255),
    Passwords VARCHAR(255),
    User_Type VARCHAR(255),
    Email VARCHAR(255),
    Discord_Name VARCHAR(255)
);

CREATE TABLE Programs (
    Program_Num INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(255),
    Description VARCHAR(255)
);

CREATE TABLE Certification (
    Cert_ID INT PRIMARY KEY AUTO_INCREMENT,
    Level VARCHAR(255),
    Name VARCHAR(255),
    Description VARCHAR(255)
);

CREATE TABLE Internship (
    Intern_ID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(255),
    Description VARCHAR(255),
    Is_Gov BINARY,
    Location VARCHAR(255)
);

CREATE TABLE Classes (
    Class_ID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(255),
    Description VARCHAR(255),
    Type VARCHAR(255)
);

CREATE TABLE College_Student (
    UIN INT PRIMARY KEY,
    Gender VARCHAR(255),
    Hispanic_Latino BINARY,
    Race VARCHAR(255),
    US_Citizen BINARY,
    First_Generation BINARY,
    DoB DATE,
    GPA FLOAT,
    Major VARCHAR(255),
    Minor_1 VARCHAR(255),
    Minor_2 VARCHAR(255),
    Expected_Graduation SMALLINT,
    School VARCHAR(255),
    Classification VARCHAR(255),
    Phone VARCHAR(255),
    Student_Type VARCHAR(255),
    FOREIGN KEY (UIN) REFERENCES Users(UIN) ON DELETE CASCADE
);

CREATE TABLE Class_Enrollment (
    CE_NUM INT PRIMARY KEY AUTO_INCREMENT,
    UIN INT,
    Class_ID INT,
    Status VARCHAR(255),
    Semester VARCHAR(255),
    Year YEAR,
    FOREIGN KEY (UIN) REFERENCES College_Student(UIN) ON DELETE CASCADE,
    FOREIGN KEY (Class_ID) REFERENCES Classes(Class_ID) ON DELETE CASCADE
);

CREATE TABLE Intern_App (
    IA_Num INT PRIMARY KEY AUTO_INCREMENT,
    UIN INT,
    Intern_ID INT,
    Status VARCHAR(255),
    Year YEAR,
    FOREIGN KEY (UIN) REFERENCES College_Student(UIN) ON DELETE CASCADE,
    FOREIGN KEY (Intern_ID) REFERENCES Internship(Intern_ID) ON DELETE CASCADE
);

CREATE TABLE Cert_Enrollment (
    CertE_Num INT PRIMARY KEY AUTO_INCREMENT,
    UIN INT,
    Cert_ID INT,
    Status VARCHAR(255),
    Training_Status VARCHAR(255),
    Program_Num INT,
    Semester VARCHAR(255),
    Year YEAR,
    FOREIGN KEY (UIN) REFERENCES College_Student(UIN) ON DELETE CASCADE,
    FOREIGN KEY (Cert_ID) REFERENCES Certification(Cert_ID) ON DELETE CASCADE,
    FOREIGN KEY (Program_Num) REFERENCES Programs(Program_Num) ON DELETE CASCADE
);

CREATE TABLE Track (
    Tracking_Num INT PRIMARY KEY AUTO_INCREMENT,
    Program_Num INT,
    UIN INT,
    FOREIGN KEY (Program_Num) REFERENCES Programs(Program_Num) ON DELETE CASCADE,
    FOREIGN KEY (UIN) REFERENCES College_Student(UIN) ON DELETE CASCADE
);

CREATE TABLE Applications (
    App_Num INT PRIMARY KEY AUTO_INCREMENT,
    Program_Num INT,
    UIN INT,
    Uncom_Cert VARCHAR(255),
    Com_Cert VARCHAR(255),
    Purpose_Statement LONGTEXT,
    FOREIGN KEY (Program_Num) REFERENCES Programs(Program_Num) ON DELETE CASCADE,
    FOREIGN KEY (UIN) REFERENCES College_Student(UIN) ON DELETE CASCADE
);

CREATE TABLE Document (
    Doc_Num INT PRIMARY KEY AUTO_INCREMENT,
    App_Num INT,
    Link VARCHAR(255),
    Doc_Type VARCHAR(255),
    FOREIGN KEY (App_Num) REFERENCES Applications(App_Num) ON DELETE CASCADE
);

CREATE TABLE Event (
    Event_ID INT PRIMARY KEY AUTO_INCREMENT,
    UIN INT,
    Program_Num INT,
    Start_Date DATE,
    Start_Time TIME,
    Location VARCHAR(255),
    End_Date DATE,
    End_Time TIME,
    Event_Type VARCHAR(255),
    FOREIGN KEY (UIN) REFERENCES Users(UIN) ON DELETE CASCADE,
    FOREIGN KEY (Program_Num) REFERENCES Programs(Program_Num) ON DELETE CASCADE
);

CREATE TABLE Event_Tracking (
    ET_Num INT PRIMARY KEY AUTO_INCREMENT,
    Event_ID INT,
    UIN INT,
    FOREIGN KEY (Event_ID) REFERENCES Event(Event_ID) ON DELETE CASCADE,
    FOREIGN KEY (UIN) REFERENCES Users(UIN) ON DELETE CASCADE
);

-- Jake View1
CREATE VIEW track_to_classes AS SELECT 
        t.Program_Num, t.UIN,
        ce.Class_ID,
        c.Type
    FROM
        Track t
    JOIN
        Class_Enrollment ce ON t.UIN = ce.UIN
    JOIN
        Classes c ON ce.Class_ID = c.Class_ID;

-- Jake View 2
CREATE VIEW uin_to_loaction_taken AS SELECT 
        ia.UIN,
        i.Location
    FROM
        Intern_App ia
    JOIN
        Internship i ON ia.Intern_ID = i.Intern_ID
    WHERE
        ia.Status = 'Taken';

-- Jake index 1
CREATE INDEX easy_cert ON cert_enrollment (UIN, Training_Status);
