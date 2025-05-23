<?php include 'server.php'; ?>

<html>

<head>
    <title>Admin Summary View</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <h2>SUMMARY REPORT</h2>
    <?php
    $query = "SELECT * FROM policy";
    $result = $db->query($query);

    echo "<table>";
    echo "<caption>VIOLATION LIST</caption>";
    echo "<tr><th>Policy Number</th> <th>Policy Name</th> <th>Maximum Count</th> <th>Response Required</th> <th>Number of Students Violated</th></tr>";

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Access individual fields using column names
            $policyid = $row['policynum'];
            $policyname = $row['policyname'];
            $count = $row['count'];
            $response = $row['response'];
            $totalStudent = $row['totalStudent'];

            echo "<tr>";
            // Display the record
            echo "<td>" . $policyid . "</td>";
            echo "<td>" . $policyname . "</td>";
            echo "<td>" . $count . "</td>";
            echo "<td>" . $response . "</td>";
            echo "<td>" . $totalStudent . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No records found</td></tr>";
    }
    echo "</table>";
    mysqli_close($db);
    ?>
    <p><a href="index.php?logout='1'" style="color: red;">logout</a></p>
</body>

</html>
