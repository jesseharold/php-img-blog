<?php require_once('../../../private/initialize.php'); 
$id = isset($_GET['id']) ? $_GET['id'] : 'none';
if ($id == "redirect"){
    redirect_to('/index.php');
}

?>
<?php $page_title = "View Tag" ?>
<?php require_once(SHARED_PATH . '/admin_header.php'); ?>

<?php $tag = get_tag_by_id($id); ?>


<?php echo show_flash($_GET, 'msg'); ?>

<dl>
    <dt>ID</dt>
    <dd><?php echo h($tag['id']); ?></dd>
    <dt>Display Name</dt>
    <dd><?php echo h($tag['display_name']); ?></dd>
    <dt>Visible</dt>
    <dd><?php echo $tag['visible'] == 1 ? 'true' : 'false'; ?></dd>
    <dt>Position</dt>
    <dd><?php echo h($tag['position']); ?></dd>
</dl>

<a class="action" href="/admin/tags/edit.php?id=<?php echo h(u($tag['id'])) ?>">Edit</a>
<a class="action" href="/admin/tags/delete.php?id=<?php echo h(u($tag['id'])) ?>">Delete</a>


<?php include_once(SHARED_PATH . '/admin_footer.php'); ?>