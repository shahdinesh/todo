<?php
include "./base.php";

$_SESSION['message'] = "";
$_SESSION['type'] = "";

header("location: {$_SERVER['HTTP_REFERER']}");
