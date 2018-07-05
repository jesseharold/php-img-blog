<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = "Edit Tag" ?>
<?php require_once(SHARED_PATH . '/admin_header.php'); ?>

<?php

  if (is_post_request()){
    // send new data to db
    $new_tag = [];
    $new_tag["display_name"] = $_POST['display_name'];
    $new_tag["position"] = $_POST['position'];
    $new_tag["visible"] = $_POST['visible'];
    $new_tag['id'] = $_GET['id'];

    if (update_tag($new_tag)){
      redirect_to("show.php?id=" . $new_tag['id'] . "&msg=Tag+updated+successfully.");
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

    // get current number of tags for position
    $all_tags = get_all_tags();
    $tag_count = mysqli_num_rows($all_tags);
    mysqli_free_result($all_tags);
  }
?>

    <form action="edit.php?id=<?php echo $id ?>" method="post">
      <dl>
        <dt>Display Name</dt>
        <dd><input type="text" name="display_name" value="<?php echo h($tag['display_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php 
              for ($i = 1; $i <= $tag_count; $i++){
                echo '<option value="' . $i . '" ';
                if ($tag['position'] == $i){
                  echo "SELECTED"; 
                }
                echo '>' . $i . '</option>';
              }
            ?>
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