<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = "Create New Page" ?>
<?php require_once(SHARED_PATH . '/admin_header.php'); ?>

<?php

// Handle form values sent by new.php
if (is_post_request()){
  $page = [];
  $page['title'] = $_POST['title'] ? $_POST['title'] : '';
  $page['visible'] = $_POST['visible'] ? $_POST['visible']: '';
  $page['content'] = $_POST['content'] ? $_POST['content'] : '';
  $page['img_path'] = $_POST['img_path'] ? $_POST['img_path'] : '';
  $page['pubdate'] = $_POST['pubdate'] ? $_POST['pubdate']: '';
  $page['tag_ids'] = $_POST['tag_ids'] ? $_POST['tag_ids'] : '';
  
  $new_id = create_page($page);

  if ($new_id){
    redirect_to("show.php?id=" . $new_id . "&msg=Page+Successfully+Created+with+ID+" . $new_id);
  }
} 
?>

    <form action="new.php" method="post">
      <dl>
        <dt>Title</dt>
        <dd><input type="text" name="title" value="" /></dd>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd>
          <textarea name="content" cols="100" rows="25"></textarea>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" />
        </dd>
      </dl>
      <dl>
        <dt>Image</dt>
        <dd><input type="text" name="img_path" value="" /></dd>
      </dl>
      <dl>
        <dt>Publication Date</dt>
        <dd><input type="text" name="pubdate" value="<?php echo date('Y-m-d h:i:s'); ?>" /></dd>
      </dl>
      <dl>
        <dt>Tags</dt>
        <dd><input type="text" name="tag_ids" value="" /></dd>
      </dl>
      <div id="operations">
        <input type="submit" class="action" value="Create Page" />
      </div>
    </form>

<?php include_once(SHARED_PATH . '/admin_footer.php'); ?>