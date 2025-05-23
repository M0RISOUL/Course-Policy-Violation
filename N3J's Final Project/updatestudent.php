<?php
include('server.php');

if (isset($_POST['update'])) {
    // Get data from the form
    $fn = $_POST['fn'];
    $ln = $_POST['ln'];
    $em = $_POST['em'];
    $mainuser = $_POST['user_id'];

    // Update the record in the users table
    $query = "UPDATE users SET firstname = '$fn', lastname = '$ln', email = '$em' WHERE studentid = '$mainuser'";
    
    if (!preg_match("/^[A-Z0-9._-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i", $em)) {
        echo '<script>alert("Invalid email format. Please enter a valid email address.");</script>';
       
        echo '<script>window.location.href = "indexstudent.php";</script>';
        exit; 
    }
    
    if (mysqli_query($db, $query)) {
        // Prompt a success message using JavaScript
        echo '<script>alert("Record updated successfully");</script>';

        // Redirect to indexstudent.php after a successful update
        echo '<script>window.location.href = "indexstudent.php";</script>';
    } else {
        echo "Error updating record: " . mysqli_error($db);
    }

    mysqli_close($db);
}
?>