<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = "Create New Tag" ?>
<?php require_once(SHARED_PATH . '/admin_header.php'); ?>

<?php

// Handle form values sent by new.php
if (is_post_request()){
  $display_name = $_POST['display_name'] ? $_POST['display_name'] : '';
  $position = $_POST['position'] ? $_POST['position'] : '';
  $visible = $_POST['visible'] ? $_POST['visible']: '';
  
  if ($visible == ''){
    $visible = 0;
  }

  $sql = "INSERT INTO tags (display_name, position, visible) VALUES (";
  $sql .= "'" . $display_name . "', ";
  $sql .= "'" . $position . "', ";
  $sql .= "'" . $visible . "');";

  $result = mysqli_query($db, $sql);

  if ($result){
    $id = mysqli_insert_id($db); // gets the ID of the record just created
    redirect_to("show.php?id=" . $id . "&msg=Tag+Successfully+Created+with+ID+" . $id);
  } else {
    echo "Query Failed: " . $sql;
    db_disconnect($db);
    exit; 
  }

  mysqli_free_result($result);
} 
?>

    <form action="new.php" method="post">
      <dl>
        <dt>Display Name</dt>
        <dd><input type="text" name="display_name" value="" /></dd>
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
        <input type="submit" class="action" value="Create Tag" />
      </div>
    </form>

<?php include_once(SHARED_PATH . '/admin_footer.php'); ?>