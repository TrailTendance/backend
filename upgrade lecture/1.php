<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Form</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Attendance Form</h2>

    <?php
    // Assuming you have a MySQL database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "your_database";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM students";
    $result = $conn->query($sql);
    ?>

    <form action="submit_attendance.php" method="post">

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>Roll Number</th>
                    <th>Attendance</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td><img src='" . $row["photo"] . "' alt='" . $row["name"] . " Photo' width='50'></td>";
                        echo "<td>" . $row["rollno"] . "</td>";
                        echo "<td><input type='checkbox' name='attendance[]' value='" . $row["rollno"] . "'></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <br>

        <input type="submit" value="Submit Attendance">
    </form>

    <?php
    $conn->close();
    ?>

</body>
</html>
