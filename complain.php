<html>

<h1>Register Your Complain</h1>
    <p>Place your Complain here and give elaborate details.</p>
    <br>
    <br>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

        <br>
        Title : <input type="text" name="title"><br>

        Details : <input type="text" name="details" id=""><br><br>

        <input type="submit" name="submit" id="">

</form>

<?php 


if (isset($_POST['submit'])){

  session_start();
  $username = $_SESSION['username'];

  
$Title = $_POST["title"];
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


$sql = "SELECT * FROM USER";
$result = $conn->query($sql);


$userlist = array();

$sql = "SELECT COUNT(*) as count FROM complain";
$result1 = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result1->fetch_assoc();

    // Get the count from the associative array
    $Count = $row['count'];
}

$Count++;

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



$sql = "INSERT INTO Complain VALUES('$Count','$use','$room','$hostel','$Title','$Detail','$phone','')";
$conn->query($sql);

echo "Complain placed Successfully<br>";
echo "<a href=student.php>Go to Home Page</a>";
$conn->close();

}
    
    ?>
</html>