<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = "View Page" ?>
<?php require_once(SHARED_PATH . '/admin_header.php'); ?>

<?php
    if (isset($_GET['id'])){
        $id = $_GET['id'];
    } else {
        redirect_to('index.php');
    }
    
    $page = get_page_by_id($id);
?>

    <dl>
        <dt>ID</dt>
        <dd><?php echo h($page['id']); ?></dd>
        <dt>Title</dt>
        <dd><?php echo h($page['title']); ?></dd>
        <dt>Visible</dt>
        <dd><?php echo $page['visible'] == 1 ? 'true' : 'false'; ?></dd>
        <dt>Content</dt>
        <dd><?php echo h($page['content']); ?></dd>
        <dt>Image</dt>
        <dd><?php echo h($page['img_path']); ?></dd>
        <dt>Tags</dt>
        <dd><?php 
                $all_tags = get_tags_from_id_string($page['tag_ids']);
                echo implode(", ", $all_tags); 
            ?></dd>
        <dt>Published</dt>
        <dd><?php echo h($page['pubdate']); ?></dd>
        <dt>Modified</dt>
        <dd><?php echo h($page['moddate']); ?></dd>
    </dl>

    <a class="action" href="/admin/pages/edit.php?id=<?php echo h(u($page['id'])) ?>">Edit</a>
    <a class="action" href="/admin/pages/delete.php?id=<?php echo h(u($page['id'])) ?>">Delete</a>

<?php include_once(SHARED_PATH . '/admin_footer.php'); ?>