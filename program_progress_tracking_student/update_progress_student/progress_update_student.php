

<!-- Student Program Progress Functionality: Update
File Completed By: Anoop Braich -->


<?php
    # linking to database
    include_once '../../includes/dbh.inc.php';
    session_start();

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Student Program Progress: Update </title>
    </head>
    <body>
        <div> 
            <h1> Update Your Progress Records  </h1>


            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">


                <label for = "Program"> Select the type of program you wish to update </label><br>
                <select id = "Program" name = "Program">
                        <option value = "Class">Class</option>
                        <option value = "Internship">Internship</option>
                        <option value = "Certification">Certification</option>

                </select>

                <br>
                <br> 

                <label for = "PK"> Enter the unique number associated with your record that you want to update (primary key): </label><br>
                <input type = "text" id="PK" name="PK"><br>
                <br>


                <label for = "Status"> Update to: </label><br>
                <select id = "Status" name = "Status">
                        <option value = "Enrolled">Enrolled</option>
                        <option value = "Completed">Completed</option>
                        <option value = "Dropped">Dropped</option>

                </select>

                <br>
                <br>


                <button type="Update"> Update </button>

            </form>

            <?php

                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                { 
                    // retrieve user entered UIN
                    // $UIN = $_POST["UIN"];

                    // stores the value of the program admin is interested in: class, internship, or certification
                    $Program = $_POST["Program"];


                    // if user selects class as the program

                    if ($Program == 'Class')
                    {

                        //echo "Chosen program is Class.";

                        $CE_NUM = $_POST["PK"];

                        $Stat_update = $_POST["Status"];

                        $sql = "UPDATE class_enrollment SET Status = '$Stat_update' WHERE CE_NUM = '$CE_NUM'";
                    
                        $conn->query($sql);


                        // display table associated with given student and program after deletion
                        // $n_sql = "SELECT * FROM class_enrollment WHERE UIN = '$UIN'";
                        // $result = $conn->query($n_sql);


                    }


                    if ($Program == 'Internship')
                    {

                        //echo "Chosen program is Internship.";

                        $IA_NUM = $_POST["PK"];

                        $Stat_update = $_POST["Status"];

                        $sql = "UPDATE intern_app SET Status = '$Stat_update' WHERE IA_Num = '$IA_NUM'";
                    
                        $conn->query($sql);



                    }


                    else if ($Program == 'Certification')
                    {

                        //echo "Chosen program is Certification.";

                        // Certified means completion of program that contains certificates
                        // Completion means you finished a certificate
                        // Students do not have the ability to update training status to certified, that is reserved for admin

                        $CertE_num = $_POST["PK"];

                        $Stat_update = $_POST["Status"];


                        $sql = "UPDATE cert_enrollment SET Status = '$Stat_update' WHERE CertE_Num = '$CertE_num'";
                        
                    
                        $conn->query($sql);


                    }

                }

            ?>



            <br>
            <br>

            <button onclick="window.location.href = '../index_s.php';"> Back </button> <!-- back to insert page -->
        </div>
    </body>
</html>




