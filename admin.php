<? session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inout</title>
          <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

      <!-- Popper JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

      <link rel="stylesheet" href="css/inout.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

    <?php include 'config.php';?>
  </head>
  <body>
    <nav>
      <ul class="nav nav-pills">
        <li class="nav-item">
          <a class="nav-link " href="index.php">Inout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="admin.php">Admin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin.php">Refresh</a>
        </li>
      </ul>
    </nav>
    <div class="container">
    <header>
      <h1 class="heading">Administrator</h1>
    </header>
    </div>

    <section class="input-section">
      <?php
        if(isset($_POST['newEmployee'])){

          $_POST['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
          // Create connection
          $conn = mysqli_connect($servername, $username, $password, $dbname);
          // Check connection
          if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
          }
          $sql = "INSERT INTO io_employees(user)
          VALUES ('{$_POST["name"]}')";

          if (mysqli_query($conn, $sql)) {
              echo "New record created successfully";
          } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
          mysqli_close($conn);
        }


      ?>
      <?

if(isset($_SESSION['deletesuccess'])) {
  echo $_SESSION['deletesuccess'];
  $_SESSION['deletesuccess'] = '';
}

      ?>
        <div class="container form-group">
          <form class="form-inline inputEmployee" action="admin.php" method="post" >
            <div class="form-group">
              <input class="form-control form-control-md mr-sm-2" type="text" name="name" placeholder="Enter in a new Employee" style="width: 500px;">
              <button class="btn btn-primary" type="submit"  name="newEmployee"><i class="fas fa-user-plus"></i></button>
            </div>
          </form>
        </div>
    </section>

    <section class="table-section">
      <?

      ?>


      <div class="container">
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <td>User ID</td>
            <td>Employee</td>
            <td>Status</td>
            <td>Message</td>
            <td>Update</td>
            <td>Delete</td>
          </tr>
        </thead>
        <tbody>
            <?php
              // Create connection
              $conn = mysqli_connect($servername, $username, $password, $dbname);
              // Check connection
              if (!$conn) {
                  die("Connection failed: " . mysqli_connect_error());
              }

              $sql = "SELECT * FROM io_employees";
              $result = mysqli_query($conn, $sql);

              if (mysqli_num_rows($result) > 0) {
                  // output data of each row
                  while($row = mysqli_fetch_assoc($result)) {

                    if($row['userid'] == $_POST['userid']) {

                    ?>
                    <tr>
                      <td>
                        <form action="updateProcess.php" method="post">
                          <input type="hidden" name="userid" value="<?=$row["userid"]?>">
                          <?=$row["userid"]?>
                      </td>
                      <td>
                        <input type="text" name="updateUser" value="<?=$row["user"]?>">
                      </td>
                      <td>
                        <select class="text" name="updateIO">
                          <option value=1>In</option>
                          <option value=0>Out</option>
                        </select>
                      </td>
                      <td>
                        <textarea name="updateMessage" rows="8" cols="20" value=""><?=$row["message"]?></textarea>
                      </td>
                      <td class="d-flex justify-content-around ">
                        <button class="btn btn-info" name="updateEmployee"><i class="fas fa-pencil-alt"></i></button>
                      </form>
                        <form class="" action="admin.php" method="post">
                          <button class="btn btn-warning" name="cancel">Cancel</button>
                        </form>
                      </td>
                      <td>
                        <form class="" action="deleteProcess.php" method="post">
                          <input type="hidden" name="userid" value="<?=$row['userid']?>">
                          <button class="btn btn-danger" name="deleteEmployee" type="submit"><i class="fas fa-trash-alt"></i>
                        </form>
                      </td>

                    </tr>
                    <?
                  } else {
                    ?>
                    <tr>
                      <td><?=$row['userid']?></td>
                      <td><?=$row['user']?></td>
                      <td><?=$row['io']?></td>
                      <td><?=$row['message']?></td>
                      <td>
                        <form  action="admin.php" method="post">
                          <input type="hidden" name="userid" value="<?=$row['userid']?>">
                          <input type="hidden" name="user" value="<?=$row['user']?>">
                          <input type="hidden" name="io" value="<?=$row['io']?>">
                          <input type="hidden" name="message" value="<?=$row['message']?>">
                          <button class="btn btn-info" name=""><i class="fas fa-pencil-alt"></i></button>
                        </form>
                      </td>
                      <td>
                      <form class="" action="deleteProcess.php" method="post">
                        <input type="hidden" name="userid" value="<?=$row['userid']?>">
                        <button class="btn btn-danger" name="deleteEmployee" type="submit"><i class="fas fa-trash-alt"></i>
                      </form>
                      <?

                      if(isset($_POST['replace'])) {
                      $replaceid = $_POST['userid'];
                      }


                      ?>
                    </td>
                    </td>
                    </tr>
                    <?
                  }
              }
            }
              mysqli_close($conn);
              ?>
        </tbody>
        </table>
      </div>
    </section>
  </body>
</html>
