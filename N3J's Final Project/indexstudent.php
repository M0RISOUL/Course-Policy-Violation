<?php
include('server.php');
$mainuser = $_SESSION['studentid'];

if (!isset($_SESSION['studentid'])) {
    $_SESSION['msg'] = "You must log in first";
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['studentid']);
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <form method="get" action="index.php"><button type="submit" name="logout" style="color: red;">Logout</button></form>
</head>

<body>

    <div class="header">
        <h2>STUDENT</h2>
    </div>

    <div class="content">
        <!-- notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="error success">
                <h3 align='center'>
                    <?php
                    $query1 = "SELECT * FROM users where studentid = $mainuser";
                    $result1 = mysqli_query($db, $query1);
                    $row = mysqli_fetch_assoc($result1);
                    $specificValue = $row['firstname'] . " " . $row['lastname'];
                    ?>
                    <p>Welcome <strong><?php echo $specificValue; ?></strong></p>
                </h3>
            </div>
        <?php endif ?>

        <!-- logged in user information -->

    </div>

    <div class="button-container">
        <form method="post" action="inputviolationfinal.php">
            <button type="submit" name="option" value="Violation">View Violations</button>
        </form>

        <form method="post" action="indexstudent.php">
            <button type="submit" name="option2" value="Edit">Edit Profile</button>
        </form>

        <form method="post" action="indexstudent.php">
            <!-- Replace 'others.php' with the actual script -->
            <button type="submit" name="option3" value="Click Here">View Profile</button>
        </form>
    </div>

    <br>

   

<div class='studentoption' style='background-color: beige; padding: 20px; margin: -10px; font-family: "Lobster", cursive; font-size: 30px; color: #333; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);'>
    <?php
    if (isset($_POST['option2'])) {
        include('server.php');
        $query = "SELECT studentid, firstname, lastname, email FROM users WHERE studentid='$mainuser' ";
        $result = @mysqli_query($db, $query);
        $row = mysqli_fetch_array($result);
        if ($row) {
            echo "<h2 align='center'>UPDATE INFORMATION</h2>";
            echo "<form action='updatestudent.php' method='post'>";
            echo "StudentId: " . "<input type=hidden name=user_id value='$row[0]'>$row[0]" . "<br>";
            echo "First Name : " . "<input type=text name=fn value='$row[1]' style='font-size: 20px; padding: 10px;'> <br>";
            echo "Last Name : " . "<input type=text name=ln value='$row[2]' style='font-size: 20px; padding: 10px;'> <br>";
            echo "Email Address : " . "<input type=text name=em value='$row[3]' style='font-size: 20px; padding: 10px;'> <br>";
            echo "<p><input type='submit' name='update' value='Update' style='font-size: 20px; padding: 10px; font-weight: bold; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;'></p></form>";
            }
         else {
            echo "No record found...";
        }
         
    } elseif (isset($_POST['option3'])) {
        include('server.php');
        $query = "SELECT studentid, firstname, lastname, email FROM users WHERE studentid='$mainuser' ";
        $result = @mysqli_query($db, $query);
        $row = mysqli_fetch_array($result);
        if ($row) {
            echo "<h2 align='center'>VIEW PROFILE</h2>";
            echo "<form action='indexstudent.php' method='post'>";
            echo "StudentId: " . "$row[0]" . "<br>";
            echo "First Name : " . "$row[1]. <br>";
            echo "Last Name : " . "$row[2]. <br>";
            echo "Email Address : " . "$row[3].<br>";
        } else {
            echo "No record found...";
        }
    }
    ?>
</div>

</body>

</html>
