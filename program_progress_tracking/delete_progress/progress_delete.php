

<!-- Admin Program Progress Functionality: Delete
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
        <title> Program Progress: Delete </title>
    </head>
    <body>
        <div> 
            <h1> Delete a Student's Progress Record  </h1>


            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">



                <label for = "Program"> Select the type of program you wish to delete: </label><br>
                <select id = "Program" name = "Program">
                        <option value = "Class">Class</option>
                        <option value = "Internship">Internship</option>
                        <option value = "Certification">Certification</option>

                </select>

                <br>
                <br> 

                <label for = "PK"> Enter the unique number associated with record you want to delete (primary key): </label><br>
                <input type = "text" id="PK" name="PK"><br>
                <br>

                <br>

                <button type="Delete"> Delete </button>

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

                        $CE_NUM_del = $_POST["PK"];

                        $sql = "DELETE FROM class_enrollment WHERE CE_NUM = '$CE_NUM_del'";
                    
                        $conn->query($sql);


                        // display table associated with given student and program after deletion
                        // $n_sql = "SELECT * FROM class_enrollment WHERE UIN = '$UIN'";
                        // $result = $conn->query($n_sql);


                    }


                    if ($Program == 'Internship')
                    {

                        //echo "Chosen program is Internship.";

                        $IA_num_del = $_POST["PK"];

                        $sql = "DELETE FROM intern_app WHERE IA_Num = '$IA_num_del'";
                    
                        $conn->query($sql);



                    }


                    else if ($Program == 'Certification')
                    {

                        //echo "Chosen program is Certification.";

                        $CertE_num_del = $_POST["PK"];

                        $sql = "DELETE FROM cert_enrollment WHERE CertE_Num = '$CertE_num_del'";
                    
                        $conn->query($sql);


                    }

                }

            ?>



            <br>
            <br>

            <button onclick="window.location.href = '../index.php';"> Back </button> <!-- back to insert page -->
        </div>
    </body>
</html>