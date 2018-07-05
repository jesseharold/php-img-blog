<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = "Edit Page" ?>
<?php require_once(SHARED_PATH . '/admin_header.php'); ?>

<?php
   


  if (is_post_request()){
    // send new data to db
    $new_page = [];
    $new_page["title"] = quotes($_POST['title']);
    $new_page["content"] = quotes($_POST['content']);
    $new_page["visible"] = $_POST['visible'];
    $new_page["img_path"] = $_POST['img_path'];
    $new_page["pubdate"] = $_POST['pubdate'];
    $new_page["tag_ids"] = $_POST['tag_ids'];
    $new_page['id'] = $_GET['id'];

    if (update_page($new_page)){
      redirect_to("show.php?id=" . $new_page['id'] . "&msg=Page+updated+successfully.");
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
    
    $page = get_page_by_id($id);
  }

?>

    <form action="edit.php?id=<?php echo $id ?>" method="post">
      <dl>
        <dt>Title</dt>
        <dd><input type="text" name="title" value="<?php echo h($page['title']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd>
          <textarea name="content" cols="100" rows="25"><?php echo h($page['content']); ?></textarea>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" <?php if ($page['visible'] == 1){ echo 'CHECKED'; } ?>/>
        </dd>
      </dl>
      <dl>
        <dt>Image</dt>
        <dd><input type="text" name="img_path" value="<?php echo $page['img_path']; ?>" /></dd>
      </dl>
      <dl>
        <dt>Publication Date</dt>
        <dd><input type="text" name="pubdate" value="<?php echo $page['pubdate']; ?>" /></dd>
      </dl>
      <dl>
        <dt>Tags</dt>
        <dd><input type="text" name="tag_ids" value="<?php echo $page['tag_ids']; ?>" /></dd>
      </dl>
      <div id="operations">
        <input type="submit" class="action" value="Save Changes" />
      </div>
    </form>


<?php include_once(SHARED_PATH . '/admin_footer.php'); ?>