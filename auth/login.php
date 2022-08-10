<?php
session_start();
include "../manager/db_connection.php";

if (isset($_SESSION['username']))
	header("location: ../index.php");

$login_error = "";
if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $user = $database->query("SELECT * FROM users WHERE email=?", $email)->fetch();

  if (password_verify($password, $user['password'])) {
    $_SESSION['username'] = $email;

    header("location: ../index.php");
  } else
    $login_error = "Email and/or password didnot match our record.";  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | ToDo app</title>
</head>
<body>
  <div>
    <?php if ($login_error) : ?>
    <h4 style="color: red;"><?=$login_error ?></h4>
    <?php endif ?>
    <h3>Please, login into system</h3>
    <form method="post">
      <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
      </div>
      <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
      </div>
      <div>
        <button type="submit" name="login">Login</button>
      </div>
    </form>
  </div>
</body>
</html>