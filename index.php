<?php
include "base.php";
include "./task/manager.php";

$todos = $database->query("SELECT * FROM tasks WHERE user_id=?", $_SESSION['user_id'])->fetchAll();

if (isset($_POST['delete'])) {
  handle_delete();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | ToDo app</title>
  <style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }
  </style>
</head>

<body>
  <div>
    <div style="width: 80%;float: left;">
      Welcome, <strong><?= $_SESSION['user_name'] ?></strong>
    </div>
    <div style="width: 20%;float: right;text-align: right;">
      <a href="auth/logout.php">Logout</a>
    </div>
  </div>
  <hr>
  <a href="./task/add.php">Add To do</a>
  <h2>To do list</h2>
  <table>
    <tr>
      <th>S.N.</th>
      <th>Title</th>
      <th>Description</th>
      <th>Image</th>
      <th>Due Date</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
    <?php foreach($todos as $index => $todo): ?>
      <tr>
        <td><?=($index+1) ?></td>
        <td><?=$todo['title'] ?></td>
        <td><?=$todo['description'] ?></td>
        <td>
          <?php if ($todo['image']): ?>
          <a href="<?="./uploads/{$todo['image']}" ?>" target="_blank">
            <img src="<?="./uploads/{$todo['image']}" ?>" height="50" width="50" alt="<?=$todo['title'] ?>">
          </a>
          <?php endif ?>
        </td>
        <td><?=$todo['due_date'] ?></td>
        <td><?=ucfirst($todo['status']) ?></td>
        <td>
          <a href="./task/edit.php?id=<?=$todo['id'] ?>">Edit</a>
          <form method="post">
            <input type="hidden" name="id" value="<?=$todo['id'] ?>">
            <button type="submit" name="delete">Delete</button>
          </form>
        </td>
      </tr>
    <?php endforeach ?>
  </table>
</body>

</html>