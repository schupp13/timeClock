<? session_start();?>

<?

  include 'config.php';
  if(isset($_POST['deleteEmployee'])){
    // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      // sql to delete a record
      $sql = "DELETE FROM io_employees WHERE userid={$_POST['userid']}";

      if ($conn->query($sql) === TRUE) {

          $_SESSION['deletesuccess'] = "Record deleted successfully";

          header('Location: http://hello.schupp.webfactional.com/timeClock/admin.php');

      } else {
          echo "Error deleting record: " . $conn->error;
      }

      $conn->close();
  }
?>
