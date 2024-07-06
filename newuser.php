<html>

<?php

$use = $_POST["id"];
$passwd = $_POST["passwd"];
$type = $_POST["type"];
$hostel = $_POST["hostel"];
$name = $_POST["name"];
$room = $_POST["room"];
$phone = $_POST["number"];
$comment = "";


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostel";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO USER values('$use','$type','$hostel','$name','$room','$phone','$passwd','$comment')";
$conn->query($sql);

$conn->close();

echo "User Added Successfully"

?>

<a href="Login.html">Return to Login Page</a>
</html>