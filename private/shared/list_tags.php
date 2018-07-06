<div class="list-tags">
    <?php 
        $all_tags = get_tags_from_id_string($page['tag_ids']);
        $tag_ids = explode(',', $page['tag_ids']);
        for($i = 0; $i < count($all_tags); $i++){
            echo '<a href="tag.php?id=' 
            . $tag_ids[$i] . 
            '" class="one-tag">' 
            . $all_tags[$i] . '</a>';
        } 
    ?>
</div>