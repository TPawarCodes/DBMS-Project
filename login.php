<html>

<?php

$user  = $_POST["username"];
$pass = $_POST["password"];
$found = false;

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

    if ($username===$user){
        $found=true;

        if($password!==$pass){
            $found=false;
        }
        break;
    }
}
}

if (!$found){
    echo "Invalid Credentials";
}
else{
    
    echo "ID Number : ".$username."<br>";
    echo "Name : ".$userlist[$username][2]."<br>";
    echo "Account type : ".$userlist[$username][0]."<br>";
    echo "Hostel : ".$userlist[$username][1]."<br>";
    echo "Room : ".$userlist[$username][3]."<br>";
    echo "Phone : ".$userlist[$username][4]."<br>";
    
    

    if ($userlist[$username][0] === 'Student') {
        session_start();

    $username = $user; // Replace with the actual username


    $_SESSION['username'] = $username;

    echo "<a href='student.php?data=$username'>Continue</a><br>";
    echo '<a href="logout.php">Logout</a>';

    exit();
        
    }
    
    elseif ($userlist[$username][0] === 'Staff-Admin') {
        session_start();

    $username = $user; // Replace with the actual username


    $_SESSION['username'] = $username;
        header("Location: admin.html");
        exit;
    }

    elseif ($userlist[$username][0] === 'Staff-Housekeeping/Maintenance') {
        session_start();

    $username = $user; // Replace with the actual username


    $_SESSION['username'] = $username;
        header("Location: staffhm.html");
        exit;
    }
    
}

$conn->close();

?>

</html>