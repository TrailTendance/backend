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
    if (isset($_POST['attendance']) && isset($_POST['lecture']) && isset($_POST['attendance_date'])) {
        $lecture = $_POST['lecture'];
        $attendanceDate = $_POST['attendance_date'];
    
        // Get the current date
        $currentDate = date('Y-m-d');

        // Loop through the submitted attendance data
        foreach ($_POST['attendance'] as $rollno) {
            // Update or insert attendance record for each student
            $sql = "INSERT INTO attendance (rollno, attendance_date, lecture, status) 
                VALUES ('$rollno', '$attendanceDate', '$lecture', 'present') 
                ON DUPLICATE KEY UPDATE status = 'present'";
        $conn->query($sql);
    }

    echo "Attendance submitted successfully.";
} else {
    echo "Invalid attendance data.";
}

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
