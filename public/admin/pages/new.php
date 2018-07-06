<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = "Create New Page" ?>
<?php require_once(SHARED_PATH . '/admin_header.php'); ?>

<?php
$errors = [];

$page = [];
$page['title'] = isset($_POST['title']) ? $_POST['title'] : '';
$page['visible'] = isset($_POST['visible']) ? $_POST['visible']: '';
$page['content'] = isset($_POST['content']) ? $_POST['content'] : '';
$page['img_path'] = isset($_POST['img_path']) ? $_POST['img_path'] : '';
$page['pubdate'] = isset($_POST['pubdate']) ? $_POST['pubdate']: '';
$page['tag_ids'] = isset($_POST['tag_ids']) ? join(",", $_POST['tag_ids']) : '';

// Handle form values sent by new.php
if (is_post_request()){
  
  $new_id = create_page($page);

  if (is_array($new_id)){
    $errors = $new_id;
  } elseif ($new_id){
    redirect_to("show.php?id=" . $new_id . "&msg=Page+Successfully+Created+with+ID+" . $new_id);
  }
} 
?>
    <?php show_errors($errors); ?>
    <form action="new.php" method="post" enctype="multipart/form-data">
      <dl>
        <dt>Title</dt>
        <dd><input type="text" name="title" value="<?php echo h($page['title']) ?>" /></dd>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd>
          <textarea name="content" cols="100" rows="25"><?php echo h($page['content']) ?></textarea>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" <?php if($page['visible'] == "1"){ echo "CHECKED"; } ?> />
        </dd>
      </dl>
      <dl>
        <dt>Image</dt>
        <dd>
          <input type="file" name="img_path" value="<?php echo $page['img_path'] ?>" />
        </dd>
      </dl>
      <dl>
        <dt>Publication Date</dt>
        <dd><input type="text" name="pubdate" value="<?php echo date('Y-m-d h:i:s'); ?>" /></dd>
      </dl>
      <dl>
        <dt>Tags</dt>
        <dd>
          <select multiple name="tag_ids[]" size="10">
          <?php
            $all_tags = get_all_tags();
            while($tag = mysqli_fetch_assoc($all_tags)){
              if ($tag['visible']){
                echo '<option ';
                echo ' value="' . $tag['id'] . '" ';
                if (in_array($tag['id'], explode(',', $page['tag_ids']))){
                  echo 'SELECTED';
                }
                echo '>' . $tag['display_name'] . '</div>';
              }
            } 
          ?>
          </select>
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" class="action" value="Create Page" />
      </div>
    </form>

<?php include_once(SHARED_PATH . '/admin_footer.php'); ?>