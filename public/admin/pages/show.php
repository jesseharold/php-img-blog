<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = "View Page" ?>
<?php require_once(SHARED_PATH . '/admin_header.php'); ?>

<?php
$id = isset($_GET['id']) ? $_GET['id'] : 'none';
?>

    <?php echo h($id); ?>

<?php include_once(SHARED_PATH . '/admin_footer.php'); ?>