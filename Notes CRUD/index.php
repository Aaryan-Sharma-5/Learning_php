<?php
$insert = false;
$update = false;
$delete = false;

//Connecting to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";

// Creating a connection
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Deleting a note
if (isset($_GET['delete'])) {
  $Sno = $_GET['delete'];
  $sql = "DELETE FROM `notes` WHERE `Sno` = $Sno";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    $delete = true;
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['SnoEdit'])) {
    // Updating a note
    $Sno = $_POST['SnoEdit'];
    $Title = $_POST['TitleEdit'];
    $Description = $_POST['DescriptionEdit'];

    $sql = "UPDATE `notes` SET `Title` = '$Title', `Description` = '$Description' WHERE `notes`.`Sno` = $Sno";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $update = true;
    } else {
      echo "Record NOT updated successfully";
    }
  } else {
    $Title = $_POST['Title'];
    $Description = $_POST['Description'];

    $sql = "INSERT INTO `notes` (`Title`, `Description`) VALUES ('$Title', '$Description')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      $insert = true;
    } else {
      echo "The record was not inserted successfully because of this error ---> " . mysqli_error($conn);
    }
  }
}
?>

<!Doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
  <title>PHP Notes CRUD</title>
</head>

<body>
  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="index.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="SnoEdit" id="SnoEdit">
            <div class="form-group">
              <label for="title">Note Title</label>
              <input type="text" class="form-control" id="TitleEdit" name="TitleEdit" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="desc">Note Description</label>
              <textarea class="form-control" id="DescriptionEdit" name="DescriptionEdit" rows="3"></textarea>
            </div>
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="php_logo.svg" height="30px" alt="PHP"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <?php
  if ($insert) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been added successfully!
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  }

  if ($delete) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been deleted successfully!
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  }

  if ($update) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been updated successfully!
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
  ?>

  <div class="container my-4">
    <h2>Add a Note</h2>
    <form action="index.php" method="POST">
      <div class="mb-3">
        <label for="title" class="form-label">Note Title</label>
        <input type="text" class="form-control" id="Title" name="Title" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="desc">Note Description</label>
        <textarea class="form-control" id="Description" name="Description" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary my-3">Add Note</button>
    </form>
  </div>

  <div class="container my-4">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Sno</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($conn, $sql);
        $Sno = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $Sno += 1;
          echo "<tr>
          <th scope='row'>" . $Sno . "</th>
          <td>" . $row['Title'] . "</td>
          <td>" . $row['Description'] . "</td>
          <td> <button class='edit btn btn-sm btn-primary' id=" . $row['Sno'] . ">Edit</button> <button class='delete btn btn-sm btn-primary' id=d" . $row['Sno'] . ">Delete</button></td>
          </tr> ";
        }
        ?>
      </tbody>
    </table>
  </div>
  <hr>

  <footer class="container">
    <p style="text-align: center;">&copy; PHP Notes CRUD, 2025</p>
  </footer>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#myTable').DataTable();
      });

      edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
          console.log("Edit button clicked");
          tr = e.target.parentNode.parentNode;
          Title = tr.getElementsByTagName("td")[0].innerText;
          Description = tr.getElementsByTagName("td")[1].innerText;
          document.getElementById('TitleEdit').value = Title;
          document.getElementById('DescriptionEdit').value = Description;
          document.getElementById('SnoEdit').value = e.target.id;

          $('#editModal').modal('toggle');
        })
      })

      deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
          Sno = e.target.id.substr(1);

          if (confirm("Are you sure you want to delete this note!")) {
            console.log("yes");
            window.location = `index.php?delete=${Sno}`;
          } else {
            console.log("no");
          }
        })
      })
    </script>

</body>
</html>