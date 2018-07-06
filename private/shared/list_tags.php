<div class="list-tags">
    <?php 
        $all_tags = get_tags_from_id_string($page['tag_ids']);
        $all_tags_ids = explode(',', $page['tag_ids']);

        for($j = 0; $j < count($all_tags); $j++){
            echo '<a href="tag.php?id=' 
            . h($all_tags_ids[$j]) . 
            '" class="one-tag">' 
            . h($all_tags[$j]) . '</a>';
        } 
    ?>
</div>