<?php require_once('../private/initialize.php'); ?>
<?php $page_title = "Blog Home Page" ?>
<?php require_once(SHARED_PATH . '/header.php'); ?>

<?php
    $pages = get_all_pages();
?>


<?php while($page = mysqli_fetch_assoc($pages)) { ?>
  <?php if( $page['visible'] == 1){ ?>
  <div class="one-post-teaser">
    <a href="page.php?id=<?php echo h($page['id']); ?>">
      <h4><?php echo h($page['title']); ?></h4>
    </a>

    <div class="metadata">
      <?php echo h($page['pubdate']); ?>
    </div>

    <p><?php echo h($page['content']); ?></p>
    <img src="<?php echo h($page['img_path']); ?>">

    <div class="list-tags">
      <?php 
          $all_tags = get_tags_from_id_string($page['tag_ids']);
          echo implode(", ", $all_tags); 
      ?>
    </div>
  </div>
  <?php } ?>
<?php } ?>

<?php include_once(SHARED_PATH . '/admin_footer.php'); ?>