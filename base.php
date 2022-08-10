<?php

include "manager/session.php";
include "manager/db_connection.php";

if(!isset($_SESSION['username']))
	header("location: auth/login.php");
