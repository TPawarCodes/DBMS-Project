<html>

<h1>Mess Absence</h1>

<?php
session_start();
$user = $_SESSION['username'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostel";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM User";
$result = $conn->query($sql);

$userlist = array();

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $username = $row["USERNAME"];
    $password = $row["PASSWORD"];
    $type = $row["TYPE"];
    $hostel = $row["HOSTEL"];
    $name = $row["NAME"];
    $room = $row["ROOM"];
    $phone = $row["PHONE"];

    $userlist[$username] = array($type,$hostel,$name,$room,$phone);
}

$sql = "SELECT * FROM mess_absence";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  
  while($row = $result->fetch_assoc()) {


    $id = $row["A_ID"];
    $stu_id = $row["S_ID"];
    $mealtype = $row["MEAL_TYPE"];
    $date = $row["DATE"];
    $hostel1 = $row["HOSTEL"];


    if($hostel===$hostel1){

    echo "ID : $id<br>"."Student ID : $stu_id <br>"."Meal : $mealtype <br>"."Date : $date<br>";
    echo "<br><br>";

    }
}
}



}


echo"<br><br>";
echo "<a href=admin.html>Go to Home Page</a>";
$conn->close();


    
    ?>
</html>