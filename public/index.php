<?php require_once('../private/initialize.php'); ?>
<?php $page_title = "Blog Home Page" ?>
<?php require_once(SHARED_PATH . '/header.php'); ?>

<?php
    $pages = get_all_pages();
?>


<?php while($page = mysqli_fetch_assoc($pages)) { ?>
  <?php include(SHARED_PATH . '/page_teaser.php');?>
<?php } ?>

<?php include_once(SHARED_PATH . '/admin_footer.php'); ?>