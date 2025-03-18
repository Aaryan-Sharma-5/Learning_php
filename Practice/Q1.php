<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "student_db";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$showAlert = false;
$showError = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['delete_student'])) {
    $rollNo = $_POST['roll_no'];
    $sql = "DELETE FROM `student_info` WHERE `Roll_no` = $rollNo";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $showAlert = "Record deleted successfully!";
    } else {
      $showError = "Error deleting record!";
    }
  } else {
    $rollNo = $_POST['rollNo'];
    $name = $_POST['name'];
    $class = $_POST['class'];
    $c1marks = $_POST['c1marks'];
    $c2marks = $_POST['c2marks'];
    $c3marks = $_POST['c3marks'];

    $existSql = "SELECT * FROM `student_info` WHERE Roll_no = '$rollNo'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if ($numExistRows > 0) {
      $showError = "Roll number already exists!";
    } else {
      $sql = "INSERT INTO `student_info` (`Roll_no`, `Name`, `Class`, `course1_marks`, `course2_marks`, `course3_marks`) VALUES ('$rollNo', '$name', '$class', '$c1marks', '$c2marks', '$c3marks')";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $showAlert = "Data entered successfully!";
      } else {
        $showError = "Error inserting record!";
      }
    }
  }
}

// Fetch student records
$order = isset($_GET['order']) ? $_GET['order'] : 'asc';
$orderSql = $order === 'desc' ? 'DESC' : 'ASC';
$studentsSql = "SELECT * FROM `student_info` ORDER BY `Roll_no` $orderSql";
$students = mysqli_query($conn, $studentsSql);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Q1</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <h1 class="text-center">Student Info</h1>

  <?php
  if ($showAlert) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> ' . $showAlert . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }

  if ($showError) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> ' . $showError . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  ?>

  <form action="index.php" method="POST">
    <div class="mb-3">
      <label for="rollNo" class="form-label">Roll no</label>
      <input type="number" class="form-control" id="rollNo" name="rollNo" placeholder="Roll no" required>
    </div>
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
    </div>
    <div class="mb-3">
      <label for="class" class="form-label">Class</label>
      <input type="text" class="form-control" id="class" name="class" placeholder="Class" required>
    </div>
    <div class="mb-3">
      <label for="c1marks" class="form-label">Course1 Marks</label>
      <input type="number" class="form-control" id="c1marks" name="c1marks" placeholder="Course1 Marks" required>
    </div>
    <div class="mb-3">
      <label for="c2marks" class="form-label">Course2 Marks</label>
      <input type="number" class="form-control" id="c2marks" name="c2marks" placeholder="Course2 Marks" required>
    </div>
    <div class="mb-3">
      <label for="c3marks" class="form-label">Course3 Marks</label>
      <input type="number" class="form-control" id="c3marks" name="c3marks" placeholder="Course3 Marks" required>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>


  <h3>Student Records</h3>
  <a href="?order=asc">Sort Ascending</a> | <a href="?order=desc">Sort Descending</a> | <a href="?json=true">View JSON</a>
  <table class="table table-striped">
    <tr>
      <th>Roll No</th>
      <th>Name</th>
      <th>Class</th>
      <th>Course1 Marks</th>
      <th>Course2 Marks</th>
      <th>Course3 Marks</th>
      <th>Action</th>
    </tr>
    <?php while ($row = $students->fetch_assoc()): ?>
      <tr>
        <td><?= $row['Roll_no'] ?></td>
        <td><?= $row['Name'] ?></td>
        <td><?= $row['Class'] ?></td>
        <td><?= $row['course1_marks'] ?></td>
        <td><?= $row['course2_marks'] ?></td>
        <td><?= $row['course3_marks'] ?></td>
        <td>
          <form method="POST" style="display:inline;">
            <input type="hidden" name="roll_no" value="<?= $row['Roll_no'] ?>">
            <button type="submit" name="delete_student">Delete</button>
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>