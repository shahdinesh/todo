<?php
include "../base.php";
include "manager.php";

if (isset($_POST['save'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $due_date = $_POST['due_date'];
  $status = $_POST['status'];
  $image = $_FILES['image'];
  $todo_errors = validate_task_form($title, $description, $due_date, $status, $image);

  if (empty($todo_errors)) {
    // handle file upload
    $filename = move_image($image);

    // save task
    $insert = $database->query(
      "INSERT INTO tasks (user_id, title, description, image, due_date, status) VALUES (?,?,?,?,?,?)",
      $_SESSION['user_id'],
      $title,
      $description,
      $filename,
      $due_date,
      $status
    );

    redirect_to();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add | ToDo app</title>

  <style>
    .error-message {
      background-color: #d92929;
      color: white;
    }
  </style>
</head>

<body>
  <div>
    <div style="width: 80%;float: left;">
      Welcome, <strong><?= $_SESSION['user_name'] ?></strong>
    </div>
    <div style="width: 20%;float: right;text-align: right;">
      <a href="../auth/logout.php">Logout</a>
    </div>
  </div>
  <hr>
  <h2>Add To do</h2>
  <?php include "./form.php"; ?>

</body>

</html>