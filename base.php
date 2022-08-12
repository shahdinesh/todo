<?php

include "manager/session.php";
include "manager/db_connection.php";
include "manager/redirect.php";

if(!isset($_SESSION['user_email']))
	redirect_to("auth/login.php");

function get_current_user_id() {
	return $_SESSION['user_id'];
}

function set_flash_message($message, $type = "success") {
	$_SESSION['message'] = $message;
	$_SESSION['type'] = $type;
}

function get_flash_message() {
	$flash_message = [
		'message' => $_SESSION['message'],
		'type' => $_SESSION['type'],
	];

	return $flash_message;
}
