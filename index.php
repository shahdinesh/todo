<?php
include "base.php";
include "./task/manager.php";

$status = "%{$_GET['status']}%";
$todos = $database->query("SELECT * FROM tasks WHERE user_id=? AND status LIKE ?", $_SESSION['user_id'], $status)->fetchAll();

if (isset($_POST['delete'])) {
  handle_delete();
}

if (isset($_POST['status'])) {
  update_status();
}
?>

  <?php include "./header.php"; ?>
  <a href="<?=$base_url ?>/task/add.php">Add To do</a>
  <h2>To do list</h2>
  <table>
    <tr>
      <td colspan="7" style="text-align: right;">
        <form method="get">
          <select name="status">
            <option value="">-- Select --</option>
            <?php foreach ($statuses as $option_status) : ?>
              <option value="<?= $option_status ?>" <?= ($option_status == $_GET['status']) ? "selected" : "" ?>><?= ucfirst($option_status) ?></option>
            <?php endforeach ?>
          </select>
          <button type="submit">Search</button>
        </form>
      </td>
    </tr>
    <tr>
      <th>S.N.</th>
      <th>Title</th>
      <th>Description</th>
      <th>Image</th>
      <th>Due Date</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
    <?php foreach($todos as $index => $todo): ?>
      <tr>
        <td><?=($index+1) ?></td>
        <td><?=$todo['title'] ?></td>
        <td><?=$todo['description'] ?></td>
        <td>
          <?php if ($todo['image']): ?>
          <a href="<?="{$base_url}/uploads/{$todo['image']}" ?>" target="_blank">
            <img src="<?="{$base_url}/uploads/{$todo['image']}" ?>" height="50" width="50" alt="<?=$todo['title'] ?>">
          </a>
          <?php endif ?>
        </td>
        <td><?=$todo['due_date'] ?></td>
        <td>
          <?php if ($todo['status'] === 'completed'): ?>
            Completed
          <?php else: ?>
            <form method="post">
              <input type="hidden" name="id" value="<?=$todo['id'] ?>">
              <select name="status" onchange="this.form.submit()">
                <option value="">-- Select --</option>
                <?php foreach ($statuses as $option_status): ?>
                  <option value="<?= $option_status ?>" <?= ($option_status == $todo['status']) ? "selected" : "" ?>><?= ucfirst($option_status) ?></option>
                <?php endforeach ?>
              </select>
            </form>
          <?php endif ?>
        </td>
        <td>
          <a href="<?=$base_url ?>/task/edit.php?id=<?=$todo['id'] ?>">Edit</a>
          <form method="post">
            <input type="hidden" name="id" value="<?=$todo['id'] ?>">
            <button type="submit" name="delete">Delete</button>
          </form>
        </td>
      </tr>
    <?php endforeach ?>
  </table>

  <script>

  </script>
</body>

</html>