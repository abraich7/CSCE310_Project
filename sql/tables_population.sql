-- Users Table
INSERT INTO Users (UIN, First_Name, M_Initial, Last_Name, Username, Passwords, User_Type, Email, Discord_Name)
VALUES (1, 'John', 'D', 'Doe', 'johndoe', 'password123', 'Admin', 'john@example.com', 'JohnDoe#123'),
       (2, 'Jane', 'M', 'Smith', 'janesmith', 'password456', 'User', 'jane@example.com', 'JaneSmith#456'),
       (3, 'Alice', 'K', 'Johnson', 'alicejohn', 'password789', 'User', 'alice@example.com', 'AliceJohnson#789');

-- Programs Table
INSERT INTO Programs (Name, Description)
VALUES ('Program 1', 'Description for Program 1'),
       ('Program 2', 'Description for Program 2'),
       ('Program 3', 'Description for Program 3');

-- Certification Table
INSERT INTO Certification (Level, Name, Description)
VALUES ('Level 1', 'Certification 1', 'Description for Certification 1'),
       ('Level 2', 'Certification 2', 'Description for Certification 2'),
       ('Level 3', 'Certification 3', 'Description for Certification 3');

-- Internship Table
INSERT INTO Internship (Name, Description, Is_Gov)
VALUES ('Internship 1', 'Description for Internship 1', 1),
       ('Internship 2', 'Description for Internship 2', 0),
       ('Internship 3', 'Description for Internship 3', 1);

-- Classes Table
INSERT INTO Classes (Name, Description, Type)
VALUES ('Class 1', 'Description for Class 1', 'Type A'),
       ('Class 2', 'Description for Class 2', 'Type B'),
       ('Class 3', 'Description for Class 3', 'Type C');

-- College_Student Table
INSERT INTO College_Student (UIN, Gender, Hispanic_Latino, Race, US_Citizen, First_Generation, DoB, GPA, Major, Minor_1, Minor_2, Expected_Graduation, School, Classification, Phone, Student_Type)
VALUES (1, 'Male', 0, 'Asian', 1, 1, '1990-05-15', 3.5, 'Computer Science', 'Mathematics', 'Statistics', 2024, 'ABC University', 'Junior', 1234567890, 'Full-time'),
       (2, 'Female', 1, 'Hispanic', 0, 0, '1992-09-20', 3.8, 'Biology', 'Chemistry', NULL, 2023, 'XYZ College', 'Senior', 9876543210, 'Part-time'),
       (3, 'Male', 0, 'African American', 1, 0, '1995-02-10', 3.2, 'Engineering', 'Physics', NULL, 2025, 'DEF University', 'Sophomore', 5555555555, 'Full-time');

-- Class_Enrollment Table
INSERT INTO Class_Enrollment (UIN, Class_ID, Status, Semester, Year)
VALUES (1, 1, 'Enrolled', 'Spring', 2023),
       (2, 2, 'Enrolled', 'Fall', 2022),
       (3, 3, 'Enrolled', 'Summer', 2023);

-- Intern_App Table
INSERT INTO Intern_App (UIN, Intern_ID, Status, Year)
VALUES (1, 1, 'Applied', 2023),
       (2, 2, 'Accepted', 2022),
       (3, 3, 'Applied', 2024);

-- Cert_Enrollment Table
INSERT INTO Cert_Enrollment (UIN, Cert_ID, Status, Training_Status, Program_Num, Semester, Year)
VALUES (1, 1, 'Enrolled', 'Completed', 1, 'Fall', 2023),
       (2, 2, 'Enrolled', 'In Progress', 2, 'Spring', 2022),
       (3, 3, 'Enrolled', 'Not Started', 3, 'Summer', 2024);

-- Track Table
INSERT INTO Track (Program_Num, Student_Num)
VALUES (1, 1),
       (2, 2),
       (3, 3);

-- Applications Table
INSERT INTO Applications (Program_Num, UIN, Uncom_Cert, Com_Cert, Purpose_Statement)
VALUES (1, 1, 'Certification 1', 'Certification 2', 'Purpose statement for Application 1'),
       (2, 2, 'Certification 2', 'Certification 3', 'Purpose statement for Application 2'),
       (3, 3, 'Certification 3', 'Certification 1', 'Purpose statement for Application 3');

-- Document Table
INSERT INTO Document (App_Num, Link, Doc_Type)
VALUES (1, 'https://link-to-document-1.com', 'Type A'),
       (2, 'https://link-to-document-2.com', 'Type B'),
       (3, 'https://link-to-document-3.com', 'Type C');

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
