<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students</title>
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
    $sqlAdd = "insert into student (student_name) value (?)";
    $stmtAdd = $conn->prepare($sqlAdd);
    $stmtAdd->bind_param("s", $_POST['sName']);
    $stmtAdd->execute();
    echo '<div class="alert alert-success" role="alert">New student added.</div>';
    break;
    case 'Edit':
    $sqlEdit = "update student set student_name=? where student_id=?";
    $stmtEdit = $conn->prepare($sqlEdit);
    $stmtEdit->bind_param("si", $_POST['sName'], $_POST['sid']);
    $stmtEdit->execute();
    echo '<div class="alert alert-success" role="alert">Edited student.</div>';
    break;
    case 'Delete':
    $sqlDelete = "delete from student where student_id=?";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bind_param("i", $_POST['sid']);
    $stmtDelete->execute();
    echo '<div class="alert alert-success" role="alert">Student Deleted.</div>';
    break;
  }
}    
?>
    <h1>Students</h1>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th></th>
          <th></th>
         </tr>
        </thead>
        </tbody>
        
<?php

$sql = "SELECT student_id, student_name from student";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
          
          <tr>
            <td><?=$row["student_id"]?></td>
            <td><?=$row["student_name"]?></td>
            <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editStudent<?=$row["student_id"]?>">
                Edit
              </button>
              <div class="modal fade" id="editStudent<?=$row["student_id"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editStudent<?=$row["student_id"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editStudent<?=$row["student_id"]?>Label">Edit Student</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editStudent<?=$row["student_id"]?>Student" class="form-label">Student</label>
                          <input type="text" class="form-control" id="editStudent<?=$row["student_id"]?>Student" aria-describedby="editStudent<?=$row["student_id"]?>Help" name="sName" value="<?=$row['student_name']?>">
                          <div id="editStudent<?=$row["student_id"]?>Help" class="form-text">Enter the student.</div>
                        </div>
                        <input type="hidden" name="sid" value="<?=$row['student_id']?>">
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
                <input type="hidden" name="eid" value="<?=$row["student_id"]?>" />
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
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudent">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addStudent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addStudentLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addStudentLabel">Add Student</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="enrollmentStudent" class="form-label">Student</label>
                  <input type="text" class="form-control" id="enrollmentStudent" aria-describedby="studentHelp" name="sName">
                  <div id="studentHelp" class="form-text">Enter the student.</div>
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
