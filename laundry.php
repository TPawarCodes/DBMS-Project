<html>

<h1>Laundry Status</h1>

<?php

session_start();
  $username = $_SESSION['username'];

$servername = "localhost";
$user = "root";
$password = "";
$dbname = "hostel";


$conn = new mysqli($servername, $user, $password, $dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM USER";
$result = $conn->query($sql);
$userlist = array();

if ($result->num_rows > 0) {
  
  while($row = $result->fetch_assoc()) {

    $use = $row["USERNAME"];

    if ($use === $username){

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

$sql = "SELECT * FROM laundry";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  
  while($row = $result->fetch_assoc()) {

    $wm = $row["WM_ID"];
    $status = $row["STATUS"];
    $hostel1 = $row["HOSTEL"];

    if ($hostel1==$hostel){
      echo "$wm : $status <br>";
    }


}
}

echo"<br><br>";
echo "<a href=student.php>Go to Home Page</a>";
$conn->close();


    
    ?>
</html>