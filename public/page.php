<?php require_once('../private/initialize.php'); ?>

<?php
    if (isset($_GET['id'])){
        $id = $_GET['id'];
    } else {
        redirect_to('index.php');
    }
    
    $page = get_page_by_id($id);
?>

<?php $page_title =  h($page['title']); ?>
<?php require_once(SHARED_PATH . '/header.php'); ?>

<?php if($page['visible']){ ?>

        <div class="metadata">
            <?php echo h($page['pubdate']); ?>
        </div>

        <p><?php echo h($page['content']); ?></p>
        <img src="<?php echo h($page['img_path']); ?>">

        <?php include(SHARED_PATH . '/list_tags.php');?>
        
<?php } ?>

<?php include_once(SHARED_PATH . '/admin_footer.php'); ?>