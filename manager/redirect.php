<?php

function redirect_to($path = "")
{
	$url = "http://localhost/todo-app/{$path}";
	header("location: {$url}");
}
