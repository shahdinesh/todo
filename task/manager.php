<?php

$statuses = ['open', 'progress', 'completed'];

function validate_task_form($title, $description, $due_date, $status, $image, $is_add = TRUE) {
  $todo_errors = [];

  if ($title == '')
    $todo_errors['title'] = 'Title cannot be blank';
  elseif (!preg_match("/^[a-zA-Z-' ]*$/", $title))
    $todo_errors['title'] = "Only letters and white space allowed";

  if ($description == '')
    $todo_errors['description'] = 'Description cannot be blank';
  elseif (!preg_match("/^[a-zA-Z-' ]*$/", $description))
    $todo_errors['description'] = "Only letters and white space allowed";

  if ($due_date == '')
    $todo_errors['due_date'] = 'Due date cannot be blank';
  elseif ($due_date !== date("Y-m-d", strtotime($due_date)))
    $todo_errors['due_date'] = 'Due date is not in valid format. Please enter in MM/DD/YYYY';

  if ($status == '')
    $todo_errors['status'] = 'Status cannot be blank';
  elseif (!in_array($status, $GLOBALS['statuses']))
    $todo_errors['status'] = 'Invalid status selected.';

  if ($is_add) {
    $check = getimagesize($image["tmp_name"]);
    if ($image['name'] == '')
      $todo_errors['image'] = 'Image cannot be blank';
    elseif ($check === FALSE)
      $todo_errors['image'] = 'Please select valid image file.';
    elseif ($image["size"] > 1000000)
      $todo_errors['image'] = 'Image size too large. Please select image less than 1MB';
  }  

  return $todo_errors;
}

function move_image($image) {
  $filename = date("YmdHis") . "_" . basename($image["name"]);
  $target_file = "../uploads/{$filename}";

  return move_uploaded_file($image["tmp_name"], $target_file) ? $filename : "";
}

function handle_delete() {
  $id = $_POST['id'];
  $task = get_task($id);

  if ($task) {
    $GLOBALS['database']->query(
      "DELETE FROM tasks WHERE id=?",
      $id
    );
  
    redirect_to();
  }
}

function get_task($id) {
  $current_user = get_current_user_id();
  $task = $GLOBALS['database']->query(
    "SELECT * FROM tasks WHERE id=?",
    $id
  )->fetch();

  if ($task['user_id'] !== $current_user) {
    return NULL;
  }
  
  return $task;
}
