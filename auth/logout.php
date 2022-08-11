<?php
include "../base.php";

unset(
  $_SESSION['user_id'],
  $_SESSION['user_name'],
  $_SESSION['user_email']
);

redirect_to("auth/login.php");
