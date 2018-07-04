<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = "Create New Page" ?>
<?php require_once(SHARED_PATH . '/admin_header.php'); ?>

<?php
$id = isset($_GET['id']) ? $_GET['id'] : 'none';

// Handle form values sent by new.php
if (is_post_request()){
  $menu_name = $_POST['menu_name'] ? $_POST['menu_name'] : '';
  $position = $_POST['position'] ? $_POST['position'] : '';
  $visible = $_POST['visible'] ? $_POST['visible']: '';

  echo "<h4>Page Created</h4>";
  echo "Menu name: " . $menu_name . "<br />";
  echo "Position: " . $position . "<br />";
  echo "Visible: " . $visible . "<br />";
} 
?>

    <form action="new.php" method="post">
      <dl>
        <dt>Display Name</dt>
        <dd><input type="text" name="menu_name" value="" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <option value="1">1</option>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Page" />
      </div>
    </form>

<?php include_once(SHARED_PATH . '/admin_footer.php'); ?>