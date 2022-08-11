<?php

include "manager/session.php";
include "manager/db_connection.php";
include "manager/redirect.php";

if(!isset($_SESSION['user_email']))
	redirect_to("auth/login.php");

