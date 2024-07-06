<html>

<h1>Request Service</h1>
    <p>Place your request here and give elaborate details.</p>
    <p>Housekeeping requests will be serviced on the same/next day.</p>
    <p>Maintenance Requests will be serviced within 3 working days.</p>
    <br>
    <br>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

        Request type : <select name="Reqtype" id="">
            <option value="Housekeeping">Housekeeping</option>
            <option value="Maintenance">Maintenance</option>
        </select>
        <br>

        Details : <input type="text" name="details" id=""><br><br>

        <input type="submit" name="submit" id="">

</form>

<?php


if (isset($_POST['submit'])){

  session_start();
  $username = $_SESSION['username'];

  

$ReqType = $_POST["Reqtype"];
$Detail = $_POST["details"];


$servername = "localhost";
$user = "root";
$password = "";
$dbname = "hostel";

// Create connection
$conn = new mysqli($servername, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}







$sql = "SELECT COUNT(*) as count FROM request";
$result1 = $conn->query($sql);

if ($result1->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result1->fetch_assoc();

    // Get the count from the associative array
    $Count = $row['count'];
}

$Count++;
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
$room=$userlist[$use][3];
$hostel=$userlist[$use][1];
$phone=$userlist[$use][4];



$sql = "INSERT INTO Request VALUES('$Count','$use','$ReqType','$room','$hostel','$Detail','$phone','')";
$conn->query($sql);

echo "Request placed Successfully<br>";
echo "<a href=student.php>Go to Home Page</a>";
$conn->close();

}
    
    ?>
</html>