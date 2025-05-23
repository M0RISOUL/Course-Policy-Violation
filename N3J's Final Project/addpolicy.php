<?php include ('server.php') ;


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $policyName = $_POST["policyName"];
    $contentType = $_POST["contentType"];
    $maxCount = $_POST["maxCount"];

    // Insert data into the database
    $sql = "INSERT INTO policy (policyname, response, count) VALUES ('$policyName', '$contentType', '$maxCount')";

    if ($db->query($sql) === TRUE) {
        $message = "Policy added successfully!";
        
    } else {
        $message = "Error: " . $sql . "<br>" . $db->error;
    }
}

// Close the database connection
$db->close();
?>

<!DOCTYPE html>
<html >
<head>
 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Policy</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-bottom: 8px;
        }

        input, select {
            padding: 8px;
            margin-bottom: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        .message {
            text-align: center;
            color: #4caf50;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Add Policy</h2>

    <?php
    if (isset($message)) {
        echo '<p class="message">' . $message . '</p>';
       
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
       Policy Name:
        <input type="text" name="policyName" required>

        Submission Type:
        <select name="contentType">
            <option value="Construct Explanatory Letter">Construct Explanatory Letter</option>
            <option value="Upload JPG File">Upload JPG file</option>
        </select>

        Maximum Count:
        <input type="number" name="maxCount" required>

        <button type="submit">Submit</button>
        <a href='indexfaculty.php'>Go back to Faculty Dashboard</a>
    </form>
</div>

</body>
</html>
