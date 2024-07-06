<html>

<h1>Suggestion Box</h1>
    <p>Please provide your valuable Suggestion</p>
    <br>
    <br>
    

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

        <br>
        Suugestion <textarea name="suggest" id="" cols="30" rows="10"></textarea>
            <br><br>


        <input type="submit" name="submit" id="">

</form>

<?php


if (isset($_POST['submit'])){

  session_start();
  $username = $_SESSION['username'];

  
$suggest = $_POST["suggest"];


$servername = "localhost";
$user = "root";
$password = "";
$dbname = "hostel";


$conn = new mysqli($servername, $user, $password, $dbname);

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

$sql = "SELECT COUNT(*) as count FROM suggestions";
$result1 = $conn->query($sql);

if ($result1->num_rows > 0) {

    $row = $result1->fetch_assoc();

    $Count = $row['count'];
}

$Count++;




$sql = "INSERT INTO suggestions VALUES('$Count','$username','$hostel','$suggest')";
$conn->query($sql);

echo "Thank You for your valuable suggestion.<br>";
echo "<a href=Raman/student.php>Go to Home Page</a>";
$conn->close();

}

    
    ?>
</html>