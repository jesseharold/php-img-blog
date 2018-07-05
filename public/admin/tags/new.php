<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = "Create New Tag" ?>
<?php require_once(SHARED_PATH . '/admin_header.php'); ?>

<?php

// Handle form values sent by new.php
if (is_post_request()){
  $tag = [];
  $tag['display_name'] = $_POST['display_name'] ? $_POST['display_name'] : '';
  $tag['position'] = $_POST['position'] ? $_POST['position'] : '';
  $tag['visible'] = $_POST['visible'] ? $_POST['visible']: '';
  
  $new_id = create_tag($tag);

  if ($new_id){
    redirect_to("show.php?id=" . $new_id . "&msg=Tag+Successfully+Created+with+ID+" . $new_id);
  }
} else {
  // get current number of tags for position
  $all_tags = get_all_tags();
  $tag_count = mysqli_num_rows($all_tags) +1;
  mysqli_free_result($all_tags);
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
          <?php 
              for ($i = 1; $i <= $tag_count; $i++){
                echo '<option value="' . $i . '" ';
                if ($tag_count == $i){
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
          <input type="checkbox" name="visible" value="1" />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" class="action" value="Create Tag" />
      </div>
    </form>

<?php include_once(SHARED_PATH . '/admin_footer.php'); ?>