<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raman | Staff Details</title>
</head>
<body>

    <?php

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
    $comm = $row["COMMENT"];

    $userlist[$username] = array($type,$hostel,$name,$room,$phone,$comm);

    if (($type == "Staff-Admin" || $type == "Staff-Housekeeping/Maintenance") && $hostel=="Raman") {

        echo "Name : ".$name."<br>";
        echo "Room : ".$room."<br>";
        echo "Phone : ".$phone."<br><br><br>";

}
}
}

?>
    
</body>
</html>