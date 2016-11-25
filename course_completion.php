<?php
// Config info
$hash = 'yourpassword'; 
$dbhost='yourhostname';
$dbname='yourdbname';
$dbuser='yourdbuser';
$dbpass='yourpassword';

if (isset($_POST['data'])) {
    // Extract data from encypted string 
    $decrypted_data = openssl_decrypt($_POST['data'], 'aes-256-ctr', $hash);
    $array = explode(",", $decrypted_data);
    $user = $array[0];
    $course = $array[1];
    
    // Have db connection info on this side
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass)
        or die("Unable to connect to MySQL server");

    $selected = mysqli_select_db($conn, $dbname)
        or die("Could not select LearningHub db");
    
    $q = "
    UPDATE tblRegisterlist
    SET Status=6
    WHERE RegisterID = (
        SELECT *
        FROM (
            SELECT MAX(RegisterID)
            FROM tblRegisterlist
            WHERE UserID=$user AND CourseID=$course
        )
        AS T
    )";

    mysqli_query($conn, $q);
} else {
    echo "No data supplied";
}
