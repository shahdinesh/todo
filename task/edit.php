<?php
include "../base.php";
include "manager.php";
$id = $_GET['id'];
$todo = get_task($id);
$title = "Edit";

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
  <?php include "../header.php"; ?>
  <h2>Update To do</h2>
  <?php include "./form.php"; ?>

</body>

</html>