<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = "Edit Tag" ?>
<?php require_once(SHARED_PATH . '/admin_header.php'); ?>

<?php

  if (is_post_request()){
    // send new data to db
    $sql = "UPDATE tags SET ";
    $sql .= "display_name='" . $_POST['display_name'] . "', ";
    $sql .= "position='" . $_POST['position'] . "', ";
    $sql .= "visible='" . $_POST['visible'] . "' ";
    $sql .= "WHERE id='" . $_GET['id'] . "' LIMIT 1;";

    $result = mysqli_query($db, $sql);

    if (result){
      redirect_to("show.php?id=" . $_GET['id'] . "&msg=Tag+updated+successfully.");
    } else {
      echo "Query Failed: " . $sql;
      db_disconnect($db);
      exit; 
    }

  } else {
    // show page
    if (isset($_GET['id'])){
      $id = $_GET['id'];
    } else {
      redirect_to('index.php');
    }
  
    $tag = get_tag_by_id($id);
  }
?>

  <?php echo show_flash($_GET, 'msg'); ?>

    <form action="edit.php?id=<?php echo $id ?>" method="post">
      <dl>
        <dt>Display Name</dt>
        <dd><input type="text" name="display_name" value="<?php echo h($tag['display_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <option value="1" <?php if($tag['position'] == "1"){ echo "SELECTED"; } ?>>1</option>
            <option value="2" <?php if($tag['position'] == "2"){ echo "SELECTED"; } ?>>2</option>
            <option value="3" <?php if($tag['position'] == "3"){ echo "SELECTED"; } ?>>3</option>
            <option value="4" <?php if($tag['position'] == "4"){ echo "SELECTED"; } ?>>4</option>
            <option value="5" <?php if($tag['position'] == "5"){ echo "SELECTED"; } ?>>5</option>
            <option value="6" <?php if($tag['position'] == "6"){ echo "SELECTED"; } ?>>6</option>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" <?php if($tag['visible'] == "1"){ echo "CHECKED"; } ?> value="1" />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" class="action" value="Save Changes" />
      </div>
    </form>

<?php include_once(SHARED_PATH . '/admin_footer.php'); ?>