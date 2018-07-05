<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = "Delete Page" ?>
<?php require_once(SHARED_PATH . '/admin_header.php'); ?>

<?php

  if (is_post_request()){
    // send new data to db
    $done = delete_page($_GET['id']);
    if (done){
        redirect_to("index.php?msg=Page+deleted+successfully.");
    }
  } else {
    // show page
    if (isset($_GET['id'])){
      $id = $_GET['id'];
    }
  
    $page = get_page_by_id($id);
  }
?>

    <form action="delete.php?id=<?php echo $id ?>" method="post">
    <dl>
        <dt>Title</dt>
        <dd><?php echo h($page['title']); ?></dd>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd>
          <?php echo h($page['content']); ?>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
         <?php if ($page['visible'] == 1){ echo 'true'; } else { echo "false"; } ?>
        </dd>
      </dl>
      <dl>
        <dt>Image</dt>
        <dd><?php echo $page['img_path']; ?></dd>
      </dl>
      <dl>
        <dt>Publication Date</dt>
        <dd><?php echo $page['pubdate']; ?></dd>
      </dl>
      <dl>
        <dt>Last Modified Date</dt>
        <dd><?php echo $page['moddate']; ?></dd>
      </dl>
      <dl>
        <dt>Tags</dt>
        <dd><?php echo $page['tag_ids']; ?></dd>
      </dl>
      <div id="operations">
        <input type="submit" class="action" value="Delete Page" />
      </div>
    </form>

<?php include_once(SHARED_PATH . '/admin_footer.php'); ?>