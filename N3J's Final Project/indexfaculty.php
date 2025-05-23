<?php
include('server.php');
//session_start();

$mainuser = $_SESSION['studentid'];

if (!isset($_SESSION['studentid'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['studentid']);
    header("location: login.php");
}

if (isset($_POST['submit'])) {
    $studentID = '';
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
 
   <form method="get" action="index.php">
       <button type="submit" name="logout" style="color: red;">Logout</button>
    </form>
    
     <form method="get" action="addpolicy.php">
    <button type="submit" name="addpolicy" id="addpolicy" style="color: blue;">Add Policy</button>
    </form>
    
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="header">
        <h2>FACULTY</h2><br>
    </div>
   

    <div class="content">
       
        <?php if (isset($_SESSION['studentid'])) : ?>
            <div class="error success">
                <h3 align='center'>
                    <?php
                    $query1 = "SELECT * FROM users where studentid = $mainuser  ";
                    $result1 = mysqli_query($db, $query1);
                    $row = mysqli_fetch_assoc($result1);
                    $specificValue = $row['firstname'] . " " . $row['lastname'];
                    ?>
                    <p>Welcome <strong><?php echo $specificValue; ?></strong></p>
                </h3>
            </div>
        <?php endif ?>
        
        
            <form action='indexfaculty.php' method='post'>
            Student ID: <input type="text" name="studentid" size=20 maxlength=40 />
            <input type='submit' name='search' value='Search' />
            </form> <br>
               
                <?php
                    if (isset($_POST['studentid'])) {
                    $id = $_POST['studentid'];
                    $query = "Select studentid, firstname, lastname FROM users WHERE studentid='$id' ";
                    $result = @mysqli_query($db, $query);
                    $row = mysqli_fetch_array($result);
                    if ($row) {
                    echo "Student ID : " . $row[0] . "<br>";
                    echo "Name : " . $row[1] . " " . $row[2] . "<br>";
                    
                    }else if (!isset($_POST['studentid'])) {
                    
                    echo "No value";
                    }
                    else{
                    echo "No record found...";
                    }
                    }
                ?>
        
        <br>
        
        <?php
        
    $studentsQuery = "SELECT * FROM users WHERE restriction >= 2";
    $studentsResult = $db->query($studentsQuery);

if ($studentsResult->num_rows > 0) {
    echo <<<HTML
    <table border='1' style='margin: 0 auto;'>
        <tr>
            <th>Student Number</th>
            <th>Student Name</th>
            <th>Policies</th>
         
        </tr>
HTML;

    while ($student = $studentsResult->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$student["studentid"]}</td>";
        echo "<td>{$student["lastname"]}, {$student["firstname"]}</td>";

        $policiesQuery = "SELECT * FROM policy";
        $policiesResult = $db->query($policiesQuery);

        echo "<td>";

        if ($policiesResult->num_rows > 0) {
            echo "<form method='post' action='processviolation.php'>";
            echo "<input type='hidden' name='studentid' value='{$student["studentid"]}'>";
            echo "<select name='selected_policies[{$student["studentid"]}]'>";

            while ($policy = $policiesResult->fetch_assoc()) {
                echo "<option value='{$policy["policynum"]}'>{$policy["policyname"]}</option>";
            }

            echo "</select>";
            echo "<input type='submit' name='submit' value='Submit'>";
            echo "</form>";
        } else {
            echo "No policies found.";
        }

        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<div style='margin: 0 auto;'>No students found in the database.</div>";
}


        
    // Close the database connection
    $db->close();
?>
    </div>
</body>

</html>
