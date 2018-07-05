<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = "Delete Tag" ?>
<?php require_once(SHARED_PATH . '/admin_header.php'); ?>

<?php

  if (is_post_request()){
    // send new data to db
    $done = delete_tag($_GET['id']);
    if (done){
        redirect_to("index.php?msg=Tag+deleted+successfully.");
    }
  } else {
    // show page
    if (isset($_GET['id'])){
      $id = $_GET['id'];
    }
  
    $tag = get_tag_by_id($id);
  }
?>

    <form action="delete.php?id=<?php echo $id ?>" method="post">
      <dl>
        <dt>Display Name</dt>
        <dd><?php echo h($tag['display_name']); ?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
            <?php echo $tag['position']; ?>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
            <?php if($tag['visible'] == "1"){ echo "true"; } else { echo "false"; } ?>
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" class="action" value="Delete Tag" />
      </div>
    </form>

<?php include_once(SHARED_PATH . '/admin_footer.php'); ?>