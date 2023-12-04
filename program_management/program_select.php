<?php
    include_once "../includes/dbh.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Admin Program Manager </title>
    </head>
    <body>
        <div> <!-- Admin: delete -->
            <h1> Generate Program report </h1>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <label for="Pnum"> Program Number: </label><br>
                <input type="text" id="Pnum" name="Pnum"><br>

                <button type="submit"> Submit </button>
            </form>

            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $Pnum = $_POST["Pnum"];

                    // number of total [Progam] students
                    echo "Number of students enrolled in this program: ";
                    $sql = "SELECT * FROM track WHERE Program_Num = '$Pnum'";
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                    echo "<br>";

                    // number of students to complete all course and certification opportunities.
                    echo "Number of students working on certifactions: ";
                    $sql = "SELECT * FROM cert_enrollment WHERE Program_Num = '$Pnum'";
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                    echo "<br>";

                    // number of students electing to take additional strategic foreign language courses.

                    // the number of students electing to take other cryptography and cryptographic mathematics courses.

                    // number of students electing to carry additional data science and related courses.

                    // number of students to enroll in DoD 8570.01M preparation training courses.

                    // number of students to complete DoD 8570.01M preparation training courses.

                    // number of students to complete a DoD 8570.01M certification examination.

                    // minority participation 

                    // the number of K-12 students enrolled in summer camps; each program has summer camps. The students are applying to be a part of the summer camps.

                    // number of students pursuing federal internships; the tracking system tracks what internships students have applied to, which ones they were accepted to, which ones they did not get accepted to, and which ones they took. This is supposed to be tracked yearly.

                    // student majors 

                    // student internship locations
                }
            ?>
            <br>
            <button onclick="window.location.href = 'program_manage.php';"> Back </button>
        </div>
    </body>
</html>