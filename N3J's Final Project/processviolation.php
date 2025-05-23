<?php
include('server.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['selected_policies'])) {
        foreach ($_POST['selected_policies'] as $studentID => $policyNum) {
    // Assuming the violation count starts at 1 when the violation is first submitted
 $insertQuery = "
     INSERT INTO violations (studentid, policynum, violationcount)
     VALUES ('$studentID', '$policyNum', 1)
     ON DUPLICATE KEY UPDATE violationcount = violationcount + 1";
mysqli_query($db, $insertQuery);

}


        // Display a JavaScript alert and redirect
        echo '<script>';
        echo 'alert("Submitted Successfully!");';
        echo 'window.location.href = "indexfaculty.php";';
        echo '</script>';
    }
} else {
    header("Location: indexfaculty.php"); 
}
?>
