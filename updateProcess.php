<?
include 'config.php';

if(isset($_POST['updateEmployee'])){
        // Create connection

  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql = "UPDATE io_employees SET user='{$_POST['updateUser']}',io='{$_POST['updateIO']}',message='{$_POST['updateMessage']}' WHERE userid='{$_POST['userid']}'";

  if ($conn->query($sql) === TRUE) {
    header('Location: http://hello.schupp.webfactional.com/timeClock/admin.php');
  } else {
      echo "Error updating record: " . $conn->error;
  }

  $conn->close();
}



?>
