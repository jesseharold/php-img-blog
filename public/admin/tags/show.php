<?php require_once('../../../private/initialize.php'); 
$id = isset($_GET['id']) ? $_GET['id'] : 'none';
if ($id == "redirect"){
    redirect_to('/index.php');
}
?>
<?php $page_title = "View Tag" ?>
<?php require_once(SHARED_PATH . '/admin_header.php'); ?>

    <?php echo h($id); ?>

<?php include_once(SHARED_PATH . '/admin_footer.php'); ?>