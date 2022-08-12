<?php
$base_url = "http://localhost/todo-app/";

function redirect_to($path = "")
{
	$url = "{$GLOBALS['base_url']}{$path}";
	header("location: {$url}");
}
