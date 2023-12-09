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
    Discord_Name VARCHAR(255),
    Account_Active BOOLEAN
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

-- Mario View 1 (Document Upload and Management)
CREATE VIEW doc_uploads_view AS
SELECT d.Doc_Num, d.App_Num, d.Link, d.Doc_Type, a.UIN
FROM Document d
JOIN Applications a ON d.App_Num = a.app_num;

-- Mario Index 1 (Document Upload and Management)
CREATE INDEX idx_UIN ON applications (UIN);

-- Mario View 2 (Event Management)
CREATE VIEW EventDetails AS
SELECT Event.Event_ID, Programs.Name AS Program_Name, 
       Event.Start_Date, Event.Start_Time, Event.Location, 
       Event.End_Date, Event.End_Time, Event.Event_Type,
       CONCAT(Users.First_Name, ' ', Users.Last_Name, ' (', Users.UIN, ')') AS Creator_Info
FROM Event 
LEFT JOIN Programs ON Event.Program_Num = Programs.Program_Num
LEFT JOIN Users ON Event.UIN = Users.UIN;

-- Mario View 3 (Event Management)
CREATE VIEW EventTrackingUsers AS
SELECT ET.Event_ID, ET.UIN AS UIN, U.First_Name, U.Last_Name, U.Email
FROM Event_Tracking ET
JOIN Users U ON ET.UIN = U.UIN;

-- Mario Index 2 (Event Management)
CREATE INDEX idx_programs_name ON Programs (Name);

-- Jacob View 1 
CREATE VIEW users_and_college_students AS
SELECT U.UIN, U.First_Name, U.M_Initial, U.Last_Name, U.Username, U.Passwords,
       U.User_Type, U.Email, U.Discord_Name, U.Account_Active,
       CS.Gender, CS.Hispanic_Latino, CS.Race, CS.US_Citizen,
       CS.First_Generation, CS.DoB, CS.GPA, CS.Major, CS.Minor_1,
       CS.Minor_2, CS.Expected_Graduation, CS.School, CS.Classification,
       CS.Phone AS Student_Phone, CS.Student_Type
FROM Users U
LEFT JOIN College_Student CS ON U.UIN = CS.UIN;


-- Jacob Index 1
CREATE INDEX idx_users_uin ON Users(UIN);

-- Jacob View 2
CREATE VIEW users_index_display AS
SELECT U.UIN, U.First_Name, U.Last_Name, U.User_Type, U.Account_Active
FROM Users U;

-- Jacob Index 2
CREATE INDEX idx_college_students_uin ON College_Student(UIN);

-- Anoop View 1

CREATE VIEW your_classes AS
SELECT CE_NUM, Class_ID, Status, Semester, Year
FROM class_enrollment
WHERE UIN = '$UIN';

-- Anoop View 2
CREATE VIEW your_internships AS
SELECT IA_Num, Intern_ID, Status, Year
FROM intern_app
WHERE UIN = '$UIN';

-- Anoop View 3
CREATE VIEW your_certifications AS
SELECT CertE_Num, Cert_ID, Status, Training_Status, Program_Num, Semester, Year
FROM cert_enrollment
WHERE UIN = '$UIN';


-- Anoop Index 1
CREATE INDEX program_num_idx ON cert_enrollment(Program_Num); 
