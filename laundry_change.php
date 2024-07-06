<html>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

        Choose Machine : <select name="machine" id="">
            <option value="WM001">WM001</option>
            <option value="WM002">WM002</option>
            <option value="WM003">WM003</option>
        </select>
        <br>

        Status : <select name="status" id="">
            <option value="FREE">FREE</option>
            <option value="FULL">FULL</option>
        </select>

        <input type="submit" name="submit" id="">

</form>

<?php


if (isset($_POST['submit'])){

  session_start();
  $username = $_SESSION['username'];

  

$machine = $_POST["machine"];
$status = $_POST["status"];


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

$sql = "SELECT * FROM laundry";
$result1 = $conn->query($sql);


if ($result1->num_rows > 0) {
  
  while($row = $result1->fetch_assoc()) {


    $id = $row["WM_ID"];
    $hostel1 = $row["HOSTEL"];


    if($hostel===$hostel1 && $id===$machine){
        $sql = "UPDATE laundry SET STATUS='$status' WHERE WM_ID='$id' AND HOSTEL='$hostel'";
        $result = $conn->query($sql);



    }
}
}

echo "Status Changed Successfully<br>";
echo "<a href=admin.html>Go to Home Page</a>";
$conn->close();

}

    
    ?>
</html>