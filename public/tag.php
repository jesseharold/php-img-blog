<?php require_once('../private/initialize.php'); ?>

<?php
    if (isset($_GET['id'])){
        $id = $_GET['id'];
    } else {
        redirect_to('index.php');
    }
    $tag = get_tag_by_id($id);

    if($tag['visible']){ 
        $pages = get_pages_by_tag($id);
    }else {
        redirect_to('index.php');
    }
?>

<?php $page_title =  h($tag['display_name']); ?>
<?php require_once(SHARED_PATH . '/header.php'); ?>

    <?php for($i = 0; $i < count($pages); $i++) { ?>
        <?php
        $page = $pages[$i]; 
        include(SHARED_PATH . '/page_teaser.php');
        ?>
    <?php } ?>

<?php include_once(SHARED_PATH . '/admin_footer.php'); ?>