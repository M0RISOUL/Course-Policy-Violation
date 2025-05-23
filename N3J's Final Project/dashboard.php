<?php include('server.php') ; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <form method="get" action="index.php"><button type="submit" name="logout" style="color: red;">Logout</button></form>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            overflow: hidden;
        }
        .dashboard-box {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
        }
        .dashboard-box h3 {
            margin-top: 0;
        }
        .student-list {
            margin-top: 20px;
        }
        .student-record {
            background-color: #eee;
            padding: 10px;
            margin-bottom: 10px;
        }
        .student-record a {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Admin Dashboard</h1>
    </div>

    <div class="container"> 
    <?php
        echo "<div class='dashboard-box'>";
        echo "<h3>Number of Violations</h3>";
        $query = $db->query("SELECT DISTINCT policynum, policyname FROM policy");
        $totalpolicies = mysqli_num_rows($query) ;
        
        while ($row = mysqli_fetch_assoc($query)) {
            $violationName = $row['policyname'];
            $count = mysqli_fetch_assoc($db->query("SELECT COUNT(*) as count FROM policy WHERE policyname = '$violationName'"))['count'];
            echo "<p>$violationName</p>";
        }
        echo "<h2>Policies available:" . $totalpolicies . "</h2> " ;
        echo "</div>";
    ?>

        <div class="dashboard-box student-list">
            <h3>Students</h3>
           <?php
                $sql = "SELECT * FROM users WHERE restriction <> 0 AND restriction <> 1";
                $result = $db->query($sql);
                $totalstudents = mysqli_num_rows($result);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='student-record'>";
                        echo "Student ID: " . $row["studentid"] . "<br>";
                        echo "Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
                        echo "Email: " . $row["email"] . "<br>";
                
                        echo "<a href='update.php?id=" . $row["studentid"] . "'>Update</a>";
                        echo "<a href='delete.php?id=" . $row["studentid"] . "'>Delete</a>";
                
                        echo "</div>";
                    }
                } else {
                    echo "0 results";
                }
                echo "<h2>Total Students:" . $totalstudents . "</h2> ";
                
                $db->close();
            ?>

          
        </div>
    </div>
</body>
</html>
