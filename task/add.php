<?php
include "../base.php";
include "manager.php";
$title = "Add";

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
  <?php include "../header.php"; ?>
  <h2>Add To do</h2>
  <?php include "./form.php"; ?>

</body>

</html>