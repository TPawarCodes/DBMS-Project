<html>

<h1>Mark your Mess Absence</h1>
    <p>Inorder to avoid food wastage,If you have planned to not eat in the mess, kindly fill this confirmation so that less food will be prepared. </p>
    <br>
    <br>
    

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

        <br>
        Date : <input type="date" name="date"><br>

        Meal Type : <select name="type" id="">
            <option value="BreakFast">Breakfast</option>
            <option value="Lunch">Lunch</option>
            <option value="Evening Snack">Evening Snacks</option>
            <option value="Dinner">Dinner</option>
        </select>
            <br><br>

            <p>I hereby confirm that I will not be present in the mess for the given period</p>
            <br><br>

        <input type="submit" name="submit" id="">

</form>

<?php


if (isset($_POST['submit'])){

  session_start();
  $username = $_SESSION['username'];

  
$Date = $_POST["date"];
$Meal = $_POST["type"];


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

$sql = "SELECT COUNT(*) as count FROM mess_absence";
$result1 = $conn->query($sql);

if ($result1->num_rows > 0) {

    $row = $result1->fetch_assoc();

    $Count = $row['count'];
}

$Count++;



$sql = "INSERT INTO mess_absence VALUES('$Count','$username','$Meal','$Date','$hostel')";
$conn->query($sql);

echo "Thank You for Choosing to Save Food.<br>";
echo "<a href=student.php>Go to Home Page</a>";
$conn->close();

}
    
    ?>
</html>