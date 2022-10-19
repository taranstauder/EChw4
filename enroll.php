<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enrollment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <?php include("includes/design-top.php");?>
    <?php include("includes/navigation.php");?>
    <div class="container">
    
    <?php
$servername = "localhost";
$username = "tstauouc_suser";
$password = "{kmXl,4Kf[Ea";
$dbname = "tstauouc_hw4";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
    case 'Add':
    $sqlAdd = "insert into enrollment (enrollmentStatus) value (?)";
    $stmtAdd = $conn->prepare($sqlAdd);
    $stmtAdd->bind_param("s", $_POST['eStatus']);
    $stmtAdd->execute();
    echo '<div class="alert alert-success" role="alert">New status added.</div>';
    break;
    case 'Edit':
    $sqlEdit = "update enrollment set enrollmentStatus=? where enrollment_id=?";
    $stmtEdit = $conn->prepare($sqlEdit);
    $stmtEdit->bind_param("si", $_POST['eStatus'], $_POST['eid']);
    $stmtEdit->execute();
    echo '<div class="alert alert-success" role="alert">Edited status.</div>';
    break;
    case 'Delete':
    $sqlDelete = "delete from enrollment where enrollment_id=?";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bind_param("i", $_POST['eid']);
    $stmtDelete->execute();
    echo '<div class="alert alert-success" role="alert">Status Deleted.</div>';
    break;
  }
}    
?>
    <h1>Enrollment</h1>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Status</th>
          <th></th>
          <th></th>
         </tr>
        </thead>
        </tbody>
        
<?php

$sql = "SELECT enrollment_id, enrollmentStatus from enrollment";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
          
          <tr>
            <td><?=$row["enrollment_id"]?></td>
            <td><?=$row["enrollmentStatus"]?></td>
            <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editEnrollment<?=$row["enrollment_id"]?>">
                Edit
              </button>
              <div class="modal fade" id="editEnrollment<?=$row["enrollment_id"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editEnrollment<?=$row["enrollment_id"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editEnrollment<?=$row["enrollment_id"]?>Label">Edit Status</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editEnrollment<?=$row["enrollment_id"]?>Status" class="form-label">Status</label>
                          <input type="text" class="form-control" id="editEnrollment<?=$row["enrollment_id"]?>Status" aria-describedby="editEnrollment<?=$row["enrollment_id"]?>Help" name="eStatus" value="<?=$row['enrollmentStatus']?>">
                          <div id="editEnrollment<?=$row["enrollment_id"]?>Help" class="form-text">Enter the status.</div>
                        </div>
                        <input type="hidden" name="eid" value="<?=$row['enrollment_id']?>">
                        <input type="hidden" name="saveType" value="Edit">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <form method="post" action="">
                <input type="hidden" name="eid" value="<?=$row["enrollment_id"]?>" />
                <input type="hidden" name="saveType" value="Delete">
                <button type="submit" class="btn" onclick="return confirm('Are you sure?')">Delete</button>
              </form>
            </td>
          </tr>
          
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>
          
        </tbody>
      </table>
      <br />
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStatus">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addStatus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addStatusLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addStatusLabel">Add Status</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="enrollmentStatus" class="form-label">Status</label>
                  <input type="text" class="form-control" id="enrollmentStatus" aria-describedby="statusHelp" name="eStatus">
                  <div id="statusHelp" class="form-text">Enter the status.</div>
                </div>
                <input type="hidden" name="saveType" value="Add">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
