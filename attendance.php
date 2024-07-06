<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST["status"];
    session_start();
    $student_id = $_SESSION['username'];

    $date = date("Y-m-d");


    $check_query = "SELECT * FROM attendance WHERE id = '$student_id' AND date = '$date'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        echo "Attendance already marked for today.";
    } else {
        // Insert new attendance record
        $insert_query = "INSERT INTO attendance VALUES ('$student_id', '$date', '$status')";
        
        if ($conn->query($insert_query) === TRUE) {
            echo "Attendance marked successfully.";
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }
    echo "<a href=student.php>Go to Home Page</a>";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Attendance</title>
</head>
<body>
    <h2>Mark Attendance</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        Status : <select name="status" id="">
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
        </select>
        <input type="submit" value="Mark Attendance">
    </form>
</body>
</html>
