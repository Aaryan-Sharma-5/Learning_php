<?php

//File Handling
$file = 'file.txt';
if (file_exists($file)) {
  $file_handle = fopen($file, 'r');
  $file_content = fread($file_handle, filesize($file));
  fclose($file_handle);
  echo $file_content;
} else {
  echo 'File does not exist';
  $file_handle = fopen($file, 'w');
  fwrite($file_handle, 'Hello World');
  fclose($file_handle);
}

//File Uploading
if (isset($_POST['submit'])) {
  $file = $_FILES['file'];
  $file_name = $file['name'];
  $file_tmp_name = $file['tmp_name'];
  $file_size = $file['size'];
  $file_error = $file['error'];
  $file_ext = explode('.', $file_name);
  $file_actual_ext = strtolower(end($file_ext));
  $allowed = ['jpg', 'jpeg', 'png', 'pdf'];

  if (in_array($file_actual_ext, $allowed)) {
    if ($file_error === 0) {
      if ($file_size < 1000000) {
        $file_name_new = uniqid('', true) . '.' . $file_actual_ext;
        if (!is_dir('uploads')) {
          mkdir('uploads', 0777, true);
        }
        $file_destination = 'uploads/' . $file_name_new;
        move_uploaded_file($file_tmp_name, $file_destination);
        echo 'File uploaded successfully';
      } else {
        echo 'File is too big';
      }
    } else {
      echo 'There was an error uploading the file';
    }
  } else {
    echo 'You cannot upload files of this type';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
    <label for="file">File</label>
    <input type="file" name="file">
    <button type="submit" name="submit">Submit</button>
  </form>
</body>
</html>