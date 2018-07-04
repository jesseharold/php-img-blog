<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = "Create New Page" ?>
<?php require_once(SHARED_PATH . '/admin_header.php'); ?>

<?php

// Handle form values sent by new.php
if (is_post_request()){
  $title = $_POST['title'] ? $_POST['title'] : '';
  $visible = $_POST['visible'] ? $_POST['visible']: '';
  $content = $_POST['content'] ? $_POST['content'] : '';
  $img_path = $_POST['img_path'] ? $_POST['img_path'] : '';
  $pubdate = $_POST['pubdate'] ? $_POST['pubdate']: '';
  $tag_ids = $_POST['tag_ids'] ? $_POST['tag_ids'] : '';
  
  if ($visible == ''){
    $visible = 0;
  }

  $sql = "INSERT INTO pages (title, visible, content, img_path, pubdate, tag_ids) VALUES (";
  $sql .= "'" . quotes($title) . "', ";
  $sql .= "'" . $visible . "', ";
  $sql .= "'" . quotes($content) . "', ";
  $sql .= "'" . $img_path . "', ";
  $sql .= "'" . $pubdate . "', ";
  $sql .= "'" . $tag_ids . "');";

  $result = mysqli_query($db, $sql);

  if ($result){
    $id = mysqli_insert_id($db); // gets the ID of the record just created
    redirect_to("show.php?id=" . $id . "&msg=Page+Successfully+Created+with+ID+" . $id);
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
        <dt>Title</dt>
        <dd><input type="text" name="title" value="" /></dd>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd>
          <textarea name="content"></textarea>
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
        <input type="submit" value="Create Page" />
      </div>
    </form>

<?php include_once(SHARED_PATH . '/admin_footer.php'); ?>