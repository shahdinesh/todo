<?php
session_start();
include "../manager/db_connection.php";
include "../manager/redirect.php";

if (isset($_SESSION['user_email']))
  redirect_to();

$login_error = "";
if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $user = $database->query("SELECT * FROM users WHERE email=?", $email)->fetch();

  if (password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_email'] = $email;

    redirect_to("index.php");
  } else
    $login_error = "Email and/or password didnot match our record.";  
}

$register_errors = [];
if (isset($_POST['register'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  if ($name == '')
    $register_errors['name'] = 'Name cannot be blank';
  elseif (!preg_match("/^[a-zA-Z-' ]*$/", $name))
    $register_errors['name'] = "Only letters and white space allowed";
  
  if ($email == '')
    $register_errors['email'] = 'Email cannot be blank';
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
    $register_errors['email'] = "Invalid email format";

  if ($password == '')
    $register_errors['password'] = 'Password cannot be blank';
  elseif ($password != $confirm_password)
    $register_errors['password'] = 'Password did not match with confirm password';

  if (empty($register_errors)) {
    $insert = $database->query(
      "INSERT INTO users (name, email, password) VALUES (?,?,?)",
      $name,
      $email,
      password_hash($password, PASSWORD_DEFAULT)
    );
    $_SESSION['user_id'] = $database->lastInsertID();
    $_SESSION['user_name'] = $name;
    $_SESSION['user_email'] = $email;

    redirect_to("index.php");
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | ToDo app</title>
  <link rel="stylesheet" href="<?=$base_url ?>/css/todo.css">
  <link rel="stylesheet" href="<?=$base_url ?>/css/login.css">
</head>
<body>
  <div class="container">
    <div class="login">
      <?php if ($login_error) : ?>
      <h4 style="color: red;"><?=$login_error ?></h4>
      <?php endif ?>
      <h3>Please, login into system</h3>
      <form class="form" method="post">
        <div class="form-control">
          <label for="email">Email</label>
          <input type="email" name="email" id="email">
        </div>
        <div class="form-control">
          <label for="password">Password</label>
          <input type="password" name="password" id="password">
        </div>
        <div class="form-control">
          <button type="submit" name="login">Login</button>
        </div>
      </form>
    </div>
    <div class="register">
      <h3>Resister into system</h3>
      <form class="form" method="post">
        <div class="form-control">
          <label for="name">Name</label>
          <input type="name" name="name" id="name" value="<?=$_POST['name'] ?>">
          <div class="error-message"><?= (isset($register_errors['name']) && $register_errors['name']) ? $register_errors['name'] : "" ?></div>
        </div>
        <div class="form-control">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" value="<?=$_POST['email'] ?>">
          <div class="error-message"><?= (isset($register_errors['email']) && $register_errors['email']) ? $register_errors['email'] : "" ?></div>
        </div>
        <div class="form-control">
          <label for="password">Password</label>
          <input type="password" name="password" id="password">
          <div class="error-message"><?= (isset($register_errors['password']) && $register_errors['password']) ? $register_errors['password'] : "" ?></div>
        </div>
        <div class="form-control">
          <label for="confirm_password">Confirm Password</label>
          <input type="password" name="confirm_password" id="confirm_password">
        </div>
        <div class="form-control">
          <button type="submit" name="register">Register</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>