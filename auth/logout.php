<?php
include "../base.php";

unset($_SESSION['username']);
header("location: login.php");