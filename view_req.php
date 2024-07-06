<html>

<h1>Request List</h1>

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

$sql = "SELECT * FROM request";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  
  while($row = $result->fetch_assoc()) {


    $id = $row["R_ID"];
    $stu_id = $row["S_ID"];
    $type1 = $row["TYPE"];
    $room = $row["ROOM"];
    $hostel1 = $row["HOSTEL"];
    $details = $row["DETAILS"];
    $phone = $row["S_PHONE"];

    if($hostel===$hostel1){

    echo "Request ID : $id<br>"."Student ID : $stu_id <br>"."Room : $room <br>"."Phone : $phone <br>"."Details : $details <br>";
    echo "<br><br>";

    }
}
}




echo"<br><br>";
if ($type=='Staff-Admin'){
echo "<a href=admin.html>Go to Home Page</a>";
}
else if($type=='Staff-Housekeeping/Maintenance'){
  echo "<a href=staffhm.html>Go to Home Page</a>";

}
$conn->close();


    
    ?>
</html>