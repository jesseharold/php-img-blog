
<?php if($page['visible']){ ?>
    <div class="one-post-teaser">
        <a href="page.php?id=<?php echo h($page['id']); ?>">
        <h4><?php echo h($page['title']); ?></h4>
        </a>

        <div class="metadata">
        <?php echo h(substr($page['pubdate'], 0, 10)); ?>
        </div>

        <p><?php 
            echo h(substr($page['content'], 0, 140)); 
            if (strlen($page['content']) > 100){
                echo '... <a href="page.php?id=' 
                . h($page['id']) .'">Read More &raquo;</a>';
            }
        ?></p>

        <?php if($page['img_path']){ ?>
            <img class="post-thumb" src="<?php echo h($page['img_path']); ?>">
        <?php } ?>

        <?php include(SHARED_PATH . '/list_tags.php'); ?>
        
    </div>
<?php } ?>