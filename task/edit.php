<?php
include "../base.php";
include "manager.php";
$id = $_GET['id'];
$todo = get_task($id);
if ($todo === NULL)
  redirect_to();

if (isset($_POST['save'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $due_date = $_POST['due_date'];
  $status = $_POST['status'];
  $image = $_FILES['image'];
  $todo_errors = validate_task_form($title, $description, $due_date, $status, $image, FALSE);

  if (empty($todo_errors)) {
    // handle file upload
    $filename = move_image($image);

    // update task
    $image = $filename ? "image=?, " : "";
    $sql = "UPDATE tasks SET title=?, description=?, {$image}due_date=?, status=? WHERE id=?";

    if ($filename) {
      $database->query(
        $sql,
        $title,
        $description,
        $filename,
        $due_date,
        $status,
        $id
      );
    } else {
      $database->query(
        $sql,
        $title,
        $description,
        $due_date,
        $status,
        $id
      );
    }

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
  <h2>Update To do</h2>
  <?php include "./form.php"; ?>

</body>

</html>