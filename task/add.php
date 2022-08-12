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
  <form method="post" enctype="multipart/form-data">
    <div>
      <div>
        <label for="title">Title</label>
        <input type="title" name="title" id="title" value="<?= $_POST['title'] ?>">
        <div class="error-message"><?= (isset($todo_errors['title']) && $todo_errors['title']) ? $todo_errors['title'] : "" ?></div>
      </div>
      <div>
        <label for="description">Description</label>
        <input type="description" name="description" id="description" value="<?= $_POST['description'] ?>">
        <div class="error-message"><?= (isset($todo_errors['description']) && $todo_errors['description']) ? $todo_errors['description'] : "" ?></div>
      </div>
      <div>
        <label for="due_date">Due Date</label>
        <input type="date" name="due_date" id="due_date" value="<?= $_POST['due_date'] ?>">
        <div class="error-message"><?= (isset($todo_errors['due_date']) && $todo_errors['due_date']) ? $todo_errors['due_date'] : "" ?></div>
      </div>
      <div>
        <label for="status">Status</label>
        <select name="status" id="status">
          <option value="">-- Select --</option>
          <?php foreach ($statuses as $option_status) : ?>
            <option value="<?= $option_status ?>" <?= ($option_status == $_POST['status']) ? "selected" : "" ?>><?= ucfirst($option_status) ?></option>
          <?php endforeach ?>
        </select>
        <div class="error-message"><?= (isset($todo_errors['status']) && $todo_errors['status']) ? $todo_errors['status'] : "" ?></div>
      </div>
      <div>
        <label for="image">Image</label>
        <input type="file" name="image" id="image" accept="image/*">
        <div class="error-message"><?= (isset($todo_errors['image']) && $todo_errors['image']) ? $todo_errors['image'] : "" ?></div>
      </div>
      <div>
        <button type="submit" name="save">Save</button>
      </div>
    </div>
  </form>
</body>

</html>