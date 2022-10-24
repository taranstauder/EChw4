<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Enrollment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
        <?php include("includes/design-top.php");?>
    <?php include("includes/navigation.php");?>
    <h1>Edit Enrollment</h1>
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
$sql = "SELECT * from enrollment where student_name=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_POST['id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
<form method="post" action="cards-edit-save.php">
  <div class="mb-3">
    <label for="eNumber" class="form-label">Enrollment number</label>
    <input type="text" class="form-control" id="eNumber" aria-describedby="eHelp" name="eNumber" value="<?=$row['enrollmentStatus']?>">
    <div id="eHelp" class="form-text">Enter the enrollment status.</div>
  </div>
  <div class="mb-3">
  <label for="courseList" class="form-label">Course</label>
<select class="form-select" aria-label="Select course" id="courseList" name="cid">
<?php
    $courseSql = "select * from course order by description";
    $courseResult = $conn->query($courseSql);
    while($courseRow = $couresResult->fetch_assoc()) {
      if ($courseRow['course_id'] == $row['course_id']) {
        $selText = " selected";
      } else {
        $selText = "";
      }
?>
  <option value="<?=$courseRow['course_id']?>"<?=$selText?>><?=$courseRow['description']?></option>
<?php
    }
?>
</select>
  </div>
  <input type="hidden" name="id" value="<?=$row['enrollment_id']?>">
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
