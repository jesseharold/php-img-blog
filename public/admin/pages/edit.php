<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = "Edit Page" ?>
<?php require_once(SHARED_PATH . '/admin_header.php'); ?>

<?php
   


  if (is_post_request()){
    // send new data to db
    $sql = "UPDATE pages SET ";
    $sql .= "title='" . quotes($_POST['title']) . "', ";
    $sql .= "content='" . quotes($_POST['content']) . "', ";
    $sql .= "visible='" . $_POST['visible'] . "', ";
    $sql .= "img_path='" . $_POST['img_path'] . "', ";
    $sql .= "pubdate='" . $_POST['pubdate'] . "', ";
    $sql .= "tag_ids='" . $_POST['tag_ids'] . "' ";
    $sql .= "WHERE id='" . $_GET['id'] . "' LIMIT 1;";

    $result = mysqli_query($db, $sql);

    if (result){
      redirect_to("show.php?id=" . $_GET['id'] . "&msg=Page+updated+successfully.");
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