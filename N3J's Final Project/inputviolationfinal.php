<?php
include('server.php');

// The student ID is stored in the session
$studentID = $_SESSION['studentid'];

// Fetch violations and response count for the logged-in student
$violationsQuery = "SELECT violations.violation_id,violations.violationcount, policy.policyname, policy.policynum FROM violations
                    INNER JOIN policy ON violations.policynum = policy.policynum
                    WHERE studentid = '$studentID'";

$violationsResult = $db->query($violationsQuery);

if ($violationsResult) {
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Student Violations</title>
</head>
<body>
    <table>
        <th colspan="3" style="text-align: center; background-color: #ff4d4d">VIOLATIONS</th>
<?php
    if ($violationsResult->num_rows > 0) {
        echo "<tr>
                <th>Policy Name</th>
                <th>Violation Count</th>
                <th>Response</th>
              </tr>";

        while ($violation = $violationsResult->fetch_assoc()) {
            // Fetch the max count and response type for each violation policy
            $maxCountQuery = "SELECT count, response FROM policy WHERE policynum = '" . $violation['policynum'] . "'";
            $maxCountResult = $db->query($maxCountQuery);
            $maxCountRow = $maxCountResult->fetch_assoc();
            $maxCount = $maxCountRow ? $maxCountRow["count"] : 0;
            $typeofresponse = $maxCountRow ? $maxCountRow["response"] : '';

            echo "<tr>";
            echo "<td>" . $violation["policyname"] . "</td>";
            echo "<td>" . $violation["violationcount"] . "</td>";

            if ($violation["violationcount"] >= $maxCount) {
                if($typeofresponse == "Upload JPG File") {
                    echo "<td>";
                    echo '<form action="uploadresponse.php" method="post" enctype="multipart/form-data">';
                    echo '  Upload JPG File: ';
                    echo '  <input type="file" name="jpgfile" required>';
                    echo '  <input type="hidden" name="violation_id" value="' . $violation["violation_id"] . '">';
                    echo '  <button type="submit" name="submitjpg">Upload</button>';
                    echo '</form>';
                    echo "</td>";
                } elseif ($typeofresponse == "Construct Explanatory Letter") {
                    echo "<td>";
                    echo '<p>Create an explanatory letter:</p>';
                    echo '<form action="uploadresponse.php" method="post" enctype="multipart/form-data">';
                    echo '    <textarea name="paragraph" required></textarea>';
                    echo '  <input type="hidden" name="violation_id" value="' . $violation["violation_id"] . '">';
                    echo '    <button type="submit" name="submittext">Send</button>';
                    echo '</form>';
                    echo "</td>";
                }
            } else {
                echo "<td>No response needed</td>";
            }

            echo "</tr>";
        }
    } else {
        echo '<tr><td colspan="3"><p>No violations found for the student.</p></td></tr>';
    }
}
?>
    </table>
    <br><a href='indexstudent.php'>Back to Student Dashboard</a>
</body>
</html>
<style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f0f0f0;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                margin: 0;
            }

            table {
                border-collapse: collapse;
                width: 80%;
                max-width: 600px;
                margin: 20px;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
                overflow: hidden;
            }

            th, td {
                padding: 15px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            th {
                background-color: #4CAF50;
                color: white;
            }

            tr:hover {
                background-color: #f5f5f5;
            }

            h2 {
                text-align: center;
                color: #333;
            }
        </style>
<?php
// Close the database connection
$db->close();
?>