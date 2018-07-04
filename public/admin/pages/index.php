<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = "Manage Pages" ?>
<?php require_once(SHARED_PATH . '/admin_header.php'); ?>


<?php
  $result_set = get_all_pages();
?>

  
<div class="subjects listing">
    <div class="actions">
      <a class="action" href="new.php">Create New Page</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>Title</th>
        <th>Visible</th>
  	    <th>Image</th>
  	    <th>Tags</th>
  	    <th>Published</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while($page = mysqli_fetch_assoc($result_set)) { ?>
        <tr>
          <td><?php echo h($page['title']); ?></td>
          <td><?php echo $page['visible'] == 1 ? 'true' : 'false'; ?></td>
    	    <td><?php echo h($page['img_path']); ?></td>
    	    <td><?php 
                $all_tags = get_tags_from_id_string($page['tag_ids']);
                echo implode(", ", $all_tags); 
            ?></td>
    	    <td><?php echo h($page['pubdate']); ?></td>
          <td><a class="action" href="/admin/pages/show.php?id=<?php echo h(u($page['id'])) ?>">View</a></td>
          <td><a class="action" href="/admin/pages/edit.php?id=<?php echo h(u($page['id'])) ?>">Edit</a></td>
          <td><a class="action" href="/admin/pages/delete.php?id=<?php echo h(u($page['id'])) ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

  </div>

<?php 
  // free up memory used by this query
  mysqli_free_result($result_set);
?>

<?php include_once(SHARED_PATH . '/admin_footer.php'); ?>
