<?php 
include('server.php'); 
?>

<style>
    body {
        font-size: 20px; 
    }
</style>

<form action="" method="post">
    <label for="StudentId">Re-enter student ID that you want to delete:</label>
    <input type="text" name="StudentId" id="StudentId"><br><br>
    <input type="submit" value="Delete">
    <a href="dashboard.php">Go Back to Dashboard</a>
</form>

<?php
if (isset($_POST["StudentId"])) {
    $studentId = $_POST["StudentId"];
    
    // Prepare a statement for deletion
    $query = "DELETE FROM users WHERE studentid = ?";
    $stmt = mysqli_prepare($db, $query);

    // Bind the student ID to the statement
    mysqli_stmt_bind_param($stmt, 's', $studentId);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_stmt_error($stmt);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($db);
?>
