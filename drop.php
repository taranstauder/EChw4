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
    <h1>Enrollments</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Name</th>
      <th>Description</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
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
    case 'Edit':
      $sqlEdit = "update enrollment set student_id=? where course_id=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("si", $_POST['eName'], $_POST['eid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">edited.</div>';
      break;
  }

$sql = "select s.student_id, student_name, c.description from enrollment e join student s on s.student_id = e.student_id join course c on c.course_id = e.course_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit">
        Edit
      </button>
     
      <!-- Modal -->
      <div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="editLabel">Edit the record</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <form method="post" action="">
              <div class="mb-3">
                 <label for="editrecord" class="form-label">Pick the Student</label>
                <select class="form-select" aria-label="Select Student" id="editrecord" name="editrecord">
                   <?php
                    $editSql = "select * from student where student_id=?";
                    $editResult = $conn->query($editSql);
                    while($editRow = $editResult->fetch_assoc()) {
     
                   ?>
                    <option value="<?=$editRow['student_id']?>"><?=$instructorRow['student_name']?></option>
                  <?php
                     }
                  ?>
                 </select>
               </div>
               <div class="mb-3">
                 <label for="cname" class="form-label">Pick the Course</label>
                 <select class="form-select" aria-label="Select Course" id="cname" name="cname">
                    <?php
                      $courseSql = "select * from course order by description";
                      $courseResult = $conn->query($courseSql);
                      while($courseRow = $courseResult->fetch_assoc()) {
     
                   ?>
                      <option value="<?=$courseRow['course_id']?>"><?=$courseRow['description']?></option>
                    <?php
                   }
                  $conn->close();
                   ?>
                </select>
                </div>
                 <input type="hidden" name="saveType" value="Add">
                 <button type="submit" class="btn btn-primary">Submit</button>
           </form>
            </div>
          </div>
          </div>
          </div>
  </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>