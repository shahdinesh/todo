<form method="post" enctype="multipart/form-data">
  <div>
    <div>
      <label for="title">Title</label>
      <input type="title" name="title" id="title" value="<?= $_POST['title'] ?: ( isset($todo['title']) ? $todo['title'] : "") ?>">
      <div class="error-message"><?= (isset($todo_errors['title']) && $todo_errors['title']) ? $todo_errors['title'] : "" ?></div>
    </div>
    <div>
      <label for="description">Description</label>
      <input type="description" name="description" id="description" value="<?= $_POST['description'] ?: ( isset($todo['description']) ? $todo['description'] : "") ?>">
      <div class="error-message"><?= (isset($todo_errors['description']) && $todo_errors['description']) ? $todo_errors['description'] : "" ?></div>
    </div>
    <div>
      <label for="due_date">Due Date</label>
      <input type="date" name="due_date" id="due_date" value="<?= $_POST['due_date'] ?: ( isset($todo['due_date']) ? $todo['due_date'] : "") ?>">
      <div class="error-message"><?= (isset($todo_errors['due_date']) && $todo_errors['due_date']) ? $todo_errors['due_date'] : "" ?></div>
    </div>
    <div>
      <label for="status">Status</label>
      <select name="status" id="status">
        <option value="">-- Select --</option>
        <?php foreach ($statuses as $option_status) : ?>
          <option value="<?= $option_status ?>" <?= ($option_status == $_POST['status']) ? "selected" : ( (isset($todo['status']) && $todo['status'] == $option_status ) ? "selected" : "") ?>><?= ucfirst($option_status) ?></option>
        <?php endforeach ?>
      </select>
      <div class="error-message"><?= (isset($todo_errors['status']) && $todo_errors['status']) ? $todo_errors['status'] : "" ?></div>
    </div>
    <div>
      <label for="image">Image</label>
      <input type="file" name="image" id="image" accept="image/*">
      <div class="error-message"><?= (isset($todo_errors['image']) && $todo_errors['image']) ? $todo_errors['image'] : "" ?></div>
    </div>
    <div>
      <button type="submit" name="save">Save</button>
    </div>
  </div>
</form>