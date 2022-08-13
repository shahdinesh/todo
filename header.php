<?php
$message = get_flash_message();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($title) ? $title : "Home" ?> | ToDo app</title>

  <link rel="stylesheet" href="<?=$base_url ?>/css/todo.css">
</head>

<body>
  <div class="header">
    <div>
      Welcome, <strong><?= $_SESSION['user_name'] ?></strong>
      <span class="item">
        <a href="<?=$base_url ?>">Tasks</a>
      </span>
      <span class="logout">
        <a class="btn" href="<?=$base_url ?>auth/logout.php">Logout</a>
      </span>
    </div>
  </div>
  <?php if ($message['message']): ?>
  <div class="alert alert-<?=$message['type'] ?>">
    <div style="width: 90%;float: left;">
      <?=$message['message'] ?>
    </div>
    <div style="width: 10%;float: right;text-align: right;">
      <a href="<?=$base_url?>clear_flash.php">x</a>
    </div>
  </div>
  <?php endif ?>