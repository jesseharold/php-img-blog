
<?php if($page['visible']){ ?>
    <div class="one-post-teaser">
        <a href="page.php?id=<?php echo h($page['id']); ?>">
        <h4><?php echo h($page['title']); ?></h4>
        </a>

        <div class="metadata">
        <?php echo h($page['pubdate']); ?>
        </div>

        <p><?php echo h(substr($page['content'], 0, 140)); ?></p>
        <img src="<?php echo h($page['img_path']); ?>">

        <?php include(SHARED_PATH . '/list_tags.php'); ?>
        
    </div>
<?php } ?>