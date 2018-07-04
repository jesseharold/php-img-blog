<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = "Edit Page" ?>
<?php require_once(SHARED_PATH . '/admin_header.php'); ?>

<?php
if (isset($_GET['id'])){
  $id = $_GET['id'];
} else {
  redirect_to('index.php');
}

$menu_name = '';
$position = '';
$visible = '';

if (is_post_request()){
  $menu_name = $_POST['menu_name'];
  $position = $_POST['position'];
  $visible = $_POST['visible'];

  echo "<h4>Page Edited</h4>";
  echo "Menu name: " . $menu_name . "<br />";
  echo "Position: " . $position . "<br />";
  echo "Visible: " . $visible . "<br />";
}

?>

    <form action="edit.php?id=<?php echo $id ?>" method="post">
      <dl>
        <dt>Display Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($menu_name); ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <option value="1" <?php if($position == "1"){ echo "SELECTED"; } ?>>1</option>
            <option value="2" <?php if($position == "2"){ echo "SELECTED"; } ?>>2</option>
            <option value="3" <?php if($position == "3"){ echo "SELECTED"; } ?>>3</option>
            <option value="4" <?php if($position == "4"){ echo "SELECTED"; } ?>>4</option>
            <option value="5" <?php if($position == "5"){ echo "SELECTED"; } ?>>5</option>
            <option value="6" <?php if($position == "6"){ echo "SELECTED"; } ?>>6</option>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" <?php if($visible == "1"){ echo "CHECKED"; } ?> value="1" />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Save Changes" />
      </div>
    </form>

<?php include_once(SHARED_PATH . '/admin_footer.php'); ?>