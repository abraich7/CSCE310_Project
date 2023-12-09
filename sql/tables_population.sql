-- Script for universal database setup
-- File Completed By: Group 9

-- Users Table
INSERT INTO Users (UIN, First_Name, M_Initial, Last_Name, Username, Passwords, User_Type, Email, Discord_Name)
VALUES (1, 'John', 'D', 'Doe', 'johndoe', 'password123', 'admin', 'john@example.com', 'JohnDoe#123'),
       (2, 'Jane', 'M', 'Smith', 'janesmith', 'password456', 'student', 'jane@example.com', 'JaneSmith#456'),
       (3, 'Alice', 'K', 'Johnson', 'alicejohn', 'password789', 'student', 'alice@example.com', 'AliceJohnson#789'),
       (4, 'Kenny', 'B', 'Rome', 'kennyrome', 'password101112', 'k-12', 'kenny@example.com', 'KennyRome#101112');

-- Programs Table
INSERT INTO Programs (Name, Description)
VALUES ('Program 1', 'Description for Program 1'),
       ('Program 2', 'Description for Program 2'),
       ('Program 3', 'Description for Program 3'),
       ('Program 4', 'Description for Program 4'),
       ('Program 5', 'Description for Program 5');

-- Certification Table
INSERT INTO Certification (Level, Name, Description)
VALUES ('Level 1', 'A+ CE', 'Description for Certification 1'),
       ('Level 1', 'CND', 'Description for Certification 2'),
       ('Level 2', 'GICSP', 'Description for Certification 3'),
       ('Level 2', 'GSEC', 'Description for Certification 4'),
       ('Level 3', 'CISA', 'Description for Certification 5'),
       ('Level 3', 'GCIH', 'Description for Certification 6');

-- Internship Table
INSERT INTO Internship (Name, Description, Is_Gov, Location)
VALUES ('Internship 1', 'Description for Internship 1', 1, 'Texas'),
       ('Internship 2', 'Description for Internship 2', 0, 'California'),
       ('Internship 3', 'Description for Internship 3', 0, 'Alaska'),
       ('Internship 4', 'Description for Internship 4', 1, 'California'),
       ('Internship 5', 'Description for Internship 5', 1, 'New Mexico'),
       ('Internship 6', 'Description for Internship 6', 0, 'Nebraska');

-- Classes Table
INSERT INTO Classes (Name, Description, Type)
VALUES ('Class 1', 'Description for Class 1', 'Cryptography'),
       ('Class 2', 'Description for Class 2', 'Foreign Language'),
       ('Class 3', 'Description for Class 3', 'Cryptography Mathmatics'),
       ('Class 4', 'Description for Class 4', 'Data Science'),
       ('Class 5', 'Description for Class 5', 'Foreign Language'),
       ('Class 6', 'Description for Class 6', 'Cryptography Mathmatics'),
       ('Class 7', 'Description for Class 7', 'Foreign Language'),
       ('Class 8', 'Description for Class 8', 'Data Scince');

-- College_Student Table
INSERT INTO College_Student (UIN, Gender, Hispanic_Latino, Race, US_Citizen, First_Generation, DoB, GPA, Major, Minor_1, Minor_2, Expected_Graduation, School, Classification, Phone, Student_Type)
VALUES (1, 'Male', 0, 'Asian', 1, 1, '1990-05-15', 3.5, 'Computer Science', 'Mathematics', 'Statistics', 2024, 'ABC University', 'Junior', 1234567890, 'Full-time'),
       (2, 'Female', 1, 'Hispanic', 0, 0, '1992-09-20', 3.8, 'Biology', 'Chemistry', NULL, 2023, 'XYZ College', 'Senior', 9876543210, 'Part-time'),
       (3, 'Female', 0, 'African American', 1, 0, '1995-02-10', 3.2, 'Engineering', 'Physics', NULL, 2025, 'DEF University', 'Sophomore', 5555555555, 'Full-time'),
       (4, 'Male', 1, 'White', 1, 0, '1992-09-20', 3.8, 'Computer Enginering', 'Chemistry', 'Mathmatics', 2023, 'XYZ College', 'Junior', 999999999, 'Part-time');

-- Class_Enrollment Table
INSERT INTO Class_Enrollment (UIN, Class_ID, Status, Semester, Year)
VALUES (1, 1, 'Enrolled', 'Spring', 2023),
       (2, 2, 'Enrolled', 'Fall', 2022),
       (3, 6, 'Enrolled', 'Summer', 2023),
       (4, 8, 'Enrolled', 'Fall', 2023);

-- Intern_App Table
INSERT INTO Intern_App (UIN, Intern_ID, Status, Year)
VALUES (1, 1, 'Applied', 2023),
       (2, 2, 'Accepted', 2022),
       (3, 3, 'Rejected', 2022),
       (2, 4, 'Taken', 2022),
       (3, 5, 'Accepted', 2022),
       (3, 6, 'Rejected', 2022),
       (1, 5, 'Taken', 2022),
       (3, 2, 'Applied', 2024);

-- Cert_Enrollment Table
INSERT INTO Cert_Enrollment (UIN, Cert_ID, Status, Training_Status, Program_Num, Semester, Year)
VALUES (1, 1, 'Enrolled', 'Completed', 1, 'Fall', 2023),
       (2, 2, 'Enrolled', 'Enrolled', 2, 'Spring', 2022),
       (3, 3, 'Enrolled', 'Certified', 3, 'Summer', 2024);

-- Track Table
INSERT INTO Track (Program_Num, UIN)
VALUES (1, 1),
       (2, 2),
       (3, 3),
       (4, 4);

-- Applications Table
INSERT INTO Applications (Program_Num, UIN, Uncom_Cert, Com_Cert, Purpose_Statement)
VALUES (1, 1, 'Certification 1', 'Certification 2', 'Purpose statement for Application 1'),
       (2, 2, 'Certification 2', 'Certification 3', 'Purpose statement for Application 2'),
       (3, 3, 'Certification 3', 'Certification 1', 'Purpose statement for Application 3'),
       (4, 4, 'Certification 4', 'Certification 2', 'Purpose statement for Application 2');

-- Document Table
-- This must be populated manually

-- Event Table
INSERT INTO Event (UIN, Program_Num, Start_Date, Start_Time, Location, End_Date, End_Time, Event_Type)
VALUES (1, 1, '2023-05-10', '08:00:00', 'Location for Event 1', '2023-05-12', '18:00:00', 'Type A'),
       (2, 2, '2022-10-15', '10:00:00', 'Location for Event 2', '2022-10-18', '15:00:00', 'Type B'),
       (3, 3, '2024-07-20', '09:30:00', 'Location for Event 3', '2024-07-25', '12:00:00', 'Type C');

-- Event_Tracking Table
INSERT INTO Event_Tracking (Event_ID, UIN)
VALUES (1, 1),
       (2, 2),
       (3, 3);
