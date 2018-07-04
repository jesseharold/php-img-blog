<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = "Manage Pages" ?>
<?php require_once(SHARED_PATH . '/admin_header.php'); ?>


<?php
  // dummy data until db is set up
  $pages = [
    ['id' => '1', 'position' => '1', 'visible' => '1', 'menu_name' => 'About Globe Bank'],
    ['id' => '2', 'position' => '2', 'visible' => '1', 'menu_name' => 'Consumer'],
    ['id' => '3', 'position' => '3', 'visible' => '1', 'menu_name' => 'Small Business'],
    ['id' => '4', 'position' => '4', 'visible' => '1', 'menu_name' => 'Commercial'],
  ];
?>

  
<div class="subjects listing">
    <div class="actions">
      <a class="action" href="new.php">Create New Page</a>
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

      <?php foreach($pages as $page) { ?>
        <tr>
          <td><?php echo h($page['id']); ?></td>
          <td><?php echo h($page['position']); ?></td>
          <td><?php echo $page['visible'] == 1 ? 'true' : 'false'; ?></td>
    	    <td><?php echo h($page['menu_name']); ?></td>
          <td><a class="action" href="/admin/pages/show.php?id=<?php echo h(u($page['id'])) ?>">View</a></td>
          <td><a class="action" href="/admin/pages/edit.php?id=<?php echo h(u($page['id'])) ?>">Edit</a></td>
          <td><a class="action" href="/admin/pages/delete.php?id=<?php echo h(u($page['id'])) ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

  </div>

<?php include_once(SHARED_PATH . '/admin_footer.php'); ?>
