<html>

<h1>Complaints List</h1>

<?php
session_start();
$user = $_SESSION['username'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostel";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM User";
$result = $conn->query($sql);

$userlist = array();

if ($result->num_rows > 0) {
  
  while($row = $result->fetch_assoc()) {

    $use = $row["USERNAME"];

    if ($use === $user){

    $password = $row["PASSWORD"];
    $type = $row["TYPE"];
    $hostel = $row["HOSTEL"];
    $name = $row["NAME"];
    $room = $row["ROOM"];
    $phone = $row["PHONE"];

    $userlist[$use] = array($type,$hostel,$name,$room,$phone);
    break;
    }

}
}

$sql = "SELECT * FROM complain";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  
  while($row = $result->fetch_assoc()) {


    $id = $row["C_ID"];
    $stu_id = $row["S_ID"];
    $room = $row["ROOM"];
    $hostel1 = $row["HOSTEL"];
    $title = $row["TITLE"];
    $details = $row["DETAILS"];
    $phone = $row["PHONE"];

    if($hostel===$hostel1){

    echo "Complain ID : $id<br>"."Student ID : $stu_id <br>"."Room : $room <br>"."Phone : $phone <br>"."Title : $title <br>"."Details : $details <br>";
    echo "<br><br>";

    }
}
}


echo"<br><br>";
echo "<a href=admin.html>Go to Home Page</a>";
$conn->close();


    
    ?>
</html>