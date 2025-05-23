<?php include('server.php') ?>

<form action="" method="post">
    <?php
    // Retrieve studentid from the dashboard.php 
    $studentId = isset($_GET['id']) ? $_GET['id'] : '';
    echo "Student ID: <input type='text' name='StudentId' value='$studentId' readonly><br>";
    ?>
    Last Name: <input type="text" name="LastName"><br>
    First Name: <input type="text" name="FirstName"><br>
    email: <input type="text" name="email"><br>

    <input type="submit" value="Update">
    <a href="dashboard.php">Go Back to Dashboard</a>
</form>

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentId = $_POST["StudentId"];
    $lastName = $_POST["LastName"];
    $firstName = $_POST["FirstName"];
    $email = $_POST["email"];

if (!is_string($firstname)) {
    array_push($errors, "String value is required in firstname");
  }

  if (!is_string($lastname)) {
    array_push($errors, "String value is required in lastname");
  }

  if (!is_numeric($studentId)) {
    array_push($errors, "Student ID must be numeric value only");
  }

  if (!preg_match("/^[A-Z0-9._-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i",$email)) {
       array_push($errors, "Invalid Email Format");
  }

if (count($errors) == 0) {
    $query = "UPDATE users SET lastname='$lastName', firstname='$firstName', email='$email' WHERE studentid='$studentId'";
    if (mysqli_query($db, $query)) {
        echo "Record updated successfully";
        
    } else {
        echo "Error updating record: " . mysqli_error($db);
    }
    
}else {
    echo "error occured. Information not updated";
}
}
mysqli_close($db);
?>