<?php

include "manager/session.php";
include "manager/db_connection.php";

if(!isset($_SESSION['user_email']))
	header("location: auth/login.php");
