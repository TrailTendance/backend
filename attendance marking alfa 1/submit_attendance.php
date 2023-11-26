<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a MySQL database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "attendance_system";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if attendance data is submitted
    if (isset($_POST['attendance'])) {
        // Get the current date
        $currentDate = date('Y-m-d');

        // Loop through the submitted attendance data
        foreach ($_POST['attendance'] as $rollno) {
            // Update or insert attendance record for each student
            $sql = "INSERT INTO attendance (rollno, attendance_date, status) VALUES ('$rollno', '$currentDate', 'present') 
                    ON DUPLICATE KEY UPDATE status = 'present'";
            $conn->query($sql);
        }

        echo "Attendance submitted successfully.";
    } else {
        echo "No attendance data submitted.";
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
