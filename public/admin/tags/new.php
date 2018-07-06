<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = "Create New Tag" ?>
<?php require_once(SHARED_PATH . '/admin_header.php'); ?>

<?php
$errors = [];

$tag = [];
$tag['display_name'] = isset($_POST['display_name']) ? $_POST['display_name'] : '';
$tag['position'] = isset($_POST['position']) ? $_POST['position'] : '';
$tag['visible'] = isset($_POST['visible']) ? $_POST['visible']: '';

// get current number of tags for position
$all_tags = get_all_tags();
$tag_count = mysqli_num_rows($all_tags) +1;
mysqli_free_result($all_tags);

// Handle form values sent by new.php
if (is_post_request()){
  $new_id = create_tag($tag);

  if (is_array($new_id)){
    $errors = $new_id;

  } else {
    redirect_to("show.php?id=" . $new_id . "&msg=Tag+successfully+created+with+ID+" . $new_id);
  }
}
?>

    <?php show_errors($errors); ?>
    <form action="new.php" method="post">
      <dl>
        <dt>Display Name</dt>
        <dd><input type="text" name="display_name" value="<?php h($tag['display_name']) ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
          <?php 
              $match_position = $tag['position'] ? $tag['position'] : $tag_count;
              for ($i = 1; $i <= $tag_count; $i++){
                echo '<option value="' . $i . '" ';
                if ($match_position == $i){
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
          <input type="checkbox" name="visible" value="1" <?php if($tag['visible'] == "1"){ echo "CHECKED"; } ?> />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" class="action" value="Create Tag" />
      </div>
    </form>

<?php include_once(SHARED_PATH . '/admin_footer.php'); ?>