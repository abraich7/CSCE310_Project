<!-- Admin Program Select Functionality-->
<!--File Completed By: Jake Rounds-->

<?php
    session_start();
    include_once "../includes/dbh.inc.php";
    include_once '../includes/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Program Manager </title>
    </head>
    <body>
        <div> <!-- Admin: select -->
            <h1> Generate Programs report </h1>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <label for="columns"> Please select a program: </label>
                <select name="column" id="columns">
                    <?php
                    // Get column names from the table
                    $query = "SELECT Name FROM Programs";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {    // build drop down menu of programs
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=\"" . $row['Name'] . "\">" . $row['Name'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <button type="submit"> Gnerate </button> <!-- recongized by the query function to save useable data -->
            </form>

            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $Pname = $_POST["column"];

                    // save program number for future refrence, easier than name
                    $sql = "SELECT Program_Num FROM Programs WHERE Name = '$Pname'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $Pnum = $row['Program_Num']; 

                    // number of total [Progam] students
                    echo "Number of students enrolled in $Pname : ";
                    $sql = "SELECT * FROM track WHERE Program_Num = '$Pnum'";
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                    echo "<br><br>";

                    // number of students to complete all course and certification opportunities.
                    echo "Number of students to compelte all course and certifcation oppounities within this porgram: ";
                    $sql = "SELECT Cert_Enrollment.status 
                    FROM Cert_Enrollment
                    LEFT JOIN Track ON Cert_Enrollment.UIN = Track.UIN
                    WHERE Cert_Enrollment.status = 'Complete' AND Track.Program_Num = '$Pnum'";
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                    echo "<br><br>";

                    // create 3 table join view to consildate program and class data into one table - easier to query
                    //$sql = "CREATE VIEW track_to_classes AS 
                    //SELECT 
                    //    t.Program_Num, t.UIN,
                    //    ce.Class_ID,
                    //    c.Type
                    //FROM
                    //    Track t
                    //JOIN
                    //    Class_Enrollment ce ON t.UIN = ce.UIN
                    //JOIN
                    //    Classes c ON ce.Class_ID = c.Class_ID
                    //";
                    //$conn->query($sql);
                    // only run once
   
                    // number of students electing to take additional strategic foreign language courses.
                    echo "Number of students opting to take additional foreign langauge courses: ";
                    $sql = "SELECT * FROM track_to_classes WHERE Program_Num = '$Pnum' AND Type = 'Foreign Language'";
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                    echo "<br><br>";

                    // the number of students electing to take other cryptography and cryptographic mathematics courses.
                    echo "Number of students opting to take additional crpytography and cryptographic mathematics courses: ";
                    $sql = "SELECT * FROM track_to_classes WHERE Program_Num = '$Pnum' AND Type = 'Cryptography' OR Type = 'Cryptographic Mathematics'";
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                    echo "<br><br>";

                    // number of students electing to carry additional data science and related courses.
                    echo "Number of students opting to take additional data science courses: ";
                    $sql = "SELECT * FROM track_to_classes WHERE Program_Num = '$Pnum' AND Type = 'Data Science'";
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                    echo "<br><br>";

                    // number of students to enrolled in DoD 8570.01M preparation training courses.
                    echo "Number of students to enroll in DoD 8570.01M trainging courses: ";
                    $sql = "SELECT Cert_Enrollment.training_status 
                    FROM Cert_Enrollment
                    LEFT JOIN Track ON Cert_Enrollment.UIN = Track.UIN
                    WHERE Cert_Enrollment.training_status = 'Enrolled' AND Track.Program_Num = '$Pnum'";
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                    echo "<br><br>";

                    // number of students to complete DoD 8570.01M preparation training courses.
                    echo "Number of students to complete DoD 8570.01M trainging courses: ";
                    $sql = "SELECT Cert_Enrollment.training_status 
                    FROM Cert_Enrollment
                    LEFT JOIN Track ON Cert_Enrollment.UIN = Track.UIN
                    WHERE Cert_Enrollment.training_status = 'Completed' AND Track.Program_Num = '$Pnum'";
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                    echo "<br><br>";

                    // number of students to complete a DoD 8570.01M certification examination.
                    echo "Number of students to complete in DoD 8570.01M trainging examination: ";
                    $sql = "SELECT Cert_Enrollment.training_status 
                    FROM Cert_Enrollment
                    LEFT JOIN Track ON Cert_Enrollment.UIN = Track.UIN
                    WHERE Cert_Enrollment.training_status = 'Certified' AND Track.Program_Num = '$Pnum'";
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                    echo "<br><br>";

                    // minority participation 
                    echo "Minority participation percentage: ";
                    $sql = "SELECT Race FROM Track LEFT JOIN College_Student ON Track.UIN = College_Student.UIN WHERE Race = 'White' AND Track.Program_Num = '$Pnum'";
                    $result = $conn->query($sql);
                    $num_white_people = $result->num_rows;

                    $sql = "SELECT Race FROM Track LEFT JOIN College_Student ON Track.UIN = College_Student.UIN WHERE Track.Program_Num = '$Pnum'";
                    $result = $conn->query($sql);
                    $total_people = $result->num_rows;
                    echo (1-$num_white_people/$total_people)*100, "%";
                    echo "<br><br>";

                    // the number of K-12 students enrolled in summer camps; each program has summer camps. The students are applying to be a part of the summer camps.
                    echo "Number of K-12 students enrolled in summer camps: ";
                    $sql = "SELECT Track.UIN 
                    FROM Track
                    LEFT JOIN Event_Tracking ON Event_Tracking.UIN = Track.UIN
                    WHERE Track.Program_Num = '$Pnum'";
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                    echo "<br><br>";

                    // number of students with submitted internship application
                    echo "Number of students with submitted internship applications: ";
                    $sql = "SELECT Intern_App.Status 
                    FROM Intern_App
                    LEFT JOIN Track ON Intern_App.UIN = Track.UIN
                    WHERE Intern_App.Status = 'Applied' AND Track.Program_Num = '$Pnum'";
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                    echo "<br><br>";
                    
                    // number of students with accepted internship applications
                    echo "Number of students with accepted internship applications: ";
                    $sql = "SELECT Intern_App.Status 
                    FROM Intern_App
                    LEFT JOIN Track ON Intern_App.UIN = Track.UIN
                    WHERE Intern_App.Status = 'Accepted' AND Track.Program_Num = '$Pnum'";
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                    echo "<br><br>";

                    // number of students with rejected internship applications
                    echo "Number of students with with rejected internship applications: ";
                    $sql = "SELECT Intern_App.Status 
                    FROM Intern_App
                    LEFT JOIN Track ON Intern_App.UIN = Track.UIN
                    WHERE Intern_App.Status = 'Rejected' AND Track.Program_Num = '$Pnum'";
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                    echo "<br><br>";

                    // number of students who took an internship
                    echo "Number of students who took an internship: ";
                    $sql = "SELECT Intern_App.Status 
                    FROM Intern_App
                    LEFT JOIN Track ON Intern_App.UIN = Track.UIN
                    WHERE Intern_App.Status = 'Taken' AND Track.Program_Num = '$Pnum'";
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                    echo "<br><br>";

                    // student majors
                    echo "List of student majors [in format UIN -- Major]: ";
                    $sql = "SELECT cs.Major, cs.UIN FROM College_Student cs LEFT JOIN Track t ON t.UIN = cs.UIN WHERE t.Program_Num = '$Pnum'";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row['UIN'] . $row['Major'] . "\">" . $row['UIN'] . " -- " . $row['Major'] . "</option>";
                    }
                    echo "<br>";

                    // create 2 table join view to consildate uin and location data - easier to query
                    //$sql = "CREATE VIEW uin_to_loaction_taken AS 
                    //SELECT 
                    //    ia.UIN,
                    //    i.Location
                    //FROM
                    //    Intern_App ia
                    //JOIN
                    //    Internship i ON ia.Intern_ID = i.Intern_ID
                    //WHERE
                    //    ia.Status = 'Taken'
                    //";
                    //$conn->query($sql);
                    // only run once

                    // student internship locations
                    echo "List of taken student internship locations [in format UIN -- Location]: ";
                    $sql = "SELECT uin_to_loaction_taken.UIN, uin_to_loaction_taken.Location 
                    FROM uin_to_loaction_taken
                    LEFT JOIN Track ON uin_to_loaction_taken.UIN = Track.UIN
                    WHERE Track.Program_Num = '$Pnum'";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row['UIN'] . $row['Location'] . "\">" . $row['UIN'] . " -- " . $row['Location'] . "</option>";
                    }
                }
            ?>
            <br>
        </div>
    </body>
</html>