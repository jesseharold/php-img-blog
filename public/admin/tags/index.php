<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = "Manage Tags" ?>
<?php require_once(SHARED_PATH . '/admin_header.php'); ?>


<?php

  $result_set = get_all_tags();

?>

  
<div class="subjects listing">
    <div class="actions">
      <a class="action" href="new.php">Create New Tag</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Position</th>
        <th>Visible</th>
  	    <th>Name</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while($tag = mysqli_fetch_assoc($result_set)) { ?>
        <tr>
          <td><?php echo h($tag['id']); ?></td>
          <td><?php echo h($tag['position']); ?></td>
          <td><?php echo $tag['visible'] == 1 ? 'true' : 'false'; ?></td>
    	    <td><?php echo h($tag['display_name']); ?></td>
          <td><a class="action" href="/admin/tags/show.php?id=<?php echo h(u($tag['id']))?>">View</a></td>
          <td><a class="action" href="/admin/tags/edit.php?id=<?php echo h(u($tag['id'])) ?>">Edit</a></td>
          <td><a class="action" href="/admin/tags/delete.php?id=<?php echo h(u($tag['id'])) ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

  </div>

<?php 
  // free up memory used by this query
  mysqli_free_result($result_set);
?>

<?php include_once(SHARED_PATH . '/admin_footer.php'); ?>
