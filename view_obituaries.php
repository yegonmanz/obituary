<?php
// Connect to the database
$servername = "localhost";
$username = "root"; // default XAMPP MySQL username
$password = ""; // default XAMPP MySQL password
$dbname = "obituary_platform";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the database
$sql = "SELECT * FROM obituaries";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obituaries</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Obituaries</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>Date of Death</th>
                <th>Content</th>
                <th>Author</th>
                <th>Submission Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["date_of_birth"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["date_of_death"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["content"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["author"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["submission_date"]) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No obituaries found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    $conn->close();
    ?>
</body>
</html>
