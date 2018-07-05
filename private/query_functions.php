<?php

    function get_all_tags(){
        // in php you have to declare any vars from the 
        // global scope that you want to use in a function
        global $db;    

        $query = "SELECT * FROM tags ";
        $query .= "ORDER BY position ASC";
        $result = mysqli_query($db, $query);

        // Test if query succeeded
        if (!$result) {
            exit("Database query failed: " . $query);
        }

        return $result;
    }

    function get_tag_by_id($id){
        global $db;    

        $query = "SELECT * FROM tags ";
        $query .= "WHERE id = '" . $id . "'";
        $result = mysqli_query($db, $query);

        // Test if query succeeded
        if (!$result) {
            exit("Database query failed: " . $query);
        }

        $array = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $array;
    }

    function get_tags_from_id_string($string){
        $tags = explode(",", $string);
        $result = [];

        foreach ($tags as $tag) {
            $tag_name = get_tag_by_id($tag);
            $result[] = $tag_name['display_name'];
        }

        return $result;
    }

    function create_tag($tag){
        global $db;

        if ($tag['visible'] == ''){
            $tag['visible'] = 0;
        }
    
        $errors = validate_tag($tag);
        if (!empty($errors)){
            return($errors);
        }
    
        $sql = "INSERT INTO tags (display_name, position, visible) VALUES (";
        $sql .= "'" . $tag['display_name'] . "', ";
        $sql .= "'" . $tag['position'] . "', ";
        $sql .= "'" . $tag['visible'] . "');";
    
        $result = mysqli_query($db, $sql);
    
        if ($result){
            return mysqli_insert_id($db); // gets the ID of the record just created
        } else {
            echo "Query Failed: " . $sql;
            db_disconnect($db);
            exit; 
        }
        
    }

    function update_tag($tag){
        global $db;

        if ($tag['visible'] == ''){
            $tag['visible'] = 0;
        }
    
        $errors = validate_tag($tag);
        if (!empty($errors)){
            return($errors);
        }

        $sql = "UPDATE tags SET ";
        $sql .= "display_name='" . $tag['display_name'] . "', ";
        $sql .= "position='" . $tag['position'] . "', ";
        $sql .= "visible='" . $tag['visible'] . "' ";
        $sql .= "WHERE id='" . $tag['id'] . "' LIMIT 1;";
    
        $result = mysqli_query($db, $sql);
    
        if ($result){
            return true;
        } else {
            echo "Query Failed: " . $sql;
            db_disconnect($db);
            exit; 
        }
    }

    function delete_tag($id){
        global $db; 

        $sql = "DELETE FROM tags ";
        $sql .= "WHERE id='" . $id . "' LIMIT 1;";

        $result = mysqli_query($db, $sql);

        remove_tag_from_pages($id);

        if (result){
            return true;
        } else {
            echo "Query Failed: " . $sql;
            db_disconnect($db);
            exit; 
        }
    }

    function validate_tag($tag){
        $errors = [];

        if (has_length_less_than($tag['display_name'], 2)){
            $errors[] = "Display name has to be at least 2 characters.";
        }
        
        if (has_length_greater_than($tag['display_name'], 100)){
            $errors[] = "Display name has to be fewer than 100 characters.";
        }

        if (!has_inclusion_of($tag['visible'], ["0", "1"])){
            $errors[] = "Visible must be either 0 or 1";
        }

        if ($tag['position'] < 1 || $tag['position'] > 999){
            $errors[] = "Position must be between 1 and 999";
        }
        
        return $errors;
    }

    function remove_tag_from_pages($id){
        $tagged_pages = get_pages_by_tag($id);
        for($i = 0; $i < count($tagged_pages); $i++){
            $page = $tagged_pages[$i];
            $tag_ids = explode(",", $page['tag_ids']);
            $new_tags = "";

            for ($j = 0; $j < count($tag_ids); $j++){
                if($tag_ids[$j] != $id){
                    $new_tags .= $tag_ids[$j] . ",";
                }
            }
            $page['tag_ids'] = chop($new_tags, ",");
            update_page($page);
        }
    }

    function get_all_pages(){
        // in php you have to declare any vars from the 
        // global scope that you want to use in a function
        global $db;    

        $query = "SELECT * FROM pages ";
        $query .= "ORDER BY pubdate ASC";
        $result = mysqli_query($db, $query);

        // Test if query succeeded
        if (!$result) {
            exit("Database query failed: " . $query);
        }

        return $result;
    }

    function get_pages_by_tag($tag_id){
        $check_pages = get_all_pages();
        $tagged_pages = [];
        while($page = mysqli_fetch_assoc($check_pages)) {
            $tag_ids = explode(",", $page['tag_ids']);
            if (in_array($tag_id, $tag_ids)){
                $tagged_pages[] = $page;
            }
        }

        return $tagged_pages;
    }

    function get_page_by_id($id){
        global $db;    

        $query = "SELECT * FROM pages ";
        $query .= "WHERE id = '" . $id . "'";
        $result = mysqli_query($db, $query);

        // Test if query succeeded
        if (!$result) {
            exit("Database query failed: " . $query);
        }

        $array = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $array;
    }

    function create_page($page){
        global $db;
                
        if ($page['visible'] == ''){
            $page['visible'] = 0;
        }

        $errors = validate_page($page);
        if (!empty($errors)){
            return($errors);
        }

        $sql = "INSERT INTO pages (title, visible, content, img_path, pubdate, tag_ids) VALUES (";
        $sql .= "'" . quotes($page['title']) . "', ";
        $sql .= "'" . $page['visible'] . "', ";
        $sql .= "'" . quotes($page['content']) . "', ";
        $sql .= "'" . $page['img_path'] . "', ";
        $sql .= "'" . $page['pubdate'] . "', ";
        $sql .= "'" . $page['tag_ids'] . "');";

        $result = mysqli_query($db, $sql);

        if ($result){
            return mysqli_insert_id($db); // gets the ID of the record just created
        } else {
            echo "Query Failed: " . $sql;
            db_disconnect($db);
            exit; 
        }
    }

    function update_page($page){
        global $db;
                
        if ($page['visible'] == ''){
            $page['visible'] = 0;
        }

        $errors = validate_page($page);
        if (!empty($errors)){
            return($errors);
        }

        $sql = "UPDATE pages SET ";
        $sql .= "title='" . quotes($page['title']) . "', ";
        $sql .= "visible='" . $page['visible'] . "', ";
        $sql .= "content='" . quotes($page['content']) . "', ";
        $sql .= "img_path='" . $page['img_path'] . "', ";
        $sql .= "pubdate='" . $page['pubdate'] . "', ";
        $sql .= "tag_ids='" . $page['tag_ids'] . "' ";
        $sql .= "WHERE id= '" . $page['id'] . "' LIMIT 1;";

        $result = mysqli_query($db, $sql);

        if ($result){
            return true;
        } else {
            echo "Query Failed: " . $sql;
            db_disconnect($db);
            exit; 
        }
    }

    function delete_page($id){
        global $db; 

        $sql = "DELETE FROM pages ";
        $sql .= "WHERE id='" . $id . "' LIMIT 1;";

        $result = mysqli_query($db, $sql);

        if (result){
            return true;
        } else {
            echo "Query Failed: " . $sql;
            db_disconnect($db);
            exit; 
        }
    }

    function validate_page($page){
        $errors = [];

        if (has_length_less_than($page['title'], 2)){
            $errors[] = "Title has to be at least 2 characters.";
        }
        
        if (!has_inclusion_of($page['visible'], ["0", "1"])){
            $errors[] = "Visible must be either 0 or 1";
        }

        if (!validate_datetime($page['pubdate'])){
            $errors[] = "Publish date must be a valid date in the format Y-m-d h:i:s";
        }

        $tags = explode(",", $page['tag_ids']);
        if ($tags){
            $valid = true;
            for($i = 0; $i < count($tags); $i++){
                if(!is_numeric($tags[$i]) || 
                    (int)$tags[$i] > 999 ||  
                    (int)$tags[$i] < 1){
                    $valid = false;
                }
            }
            if(!$valid){
                $errors[] = "Tags must be stored as comma separated ids.";
            }
        }
        
        return $errors;   
    }

    function validate_datetime($str){
        return (DateTime::createFromFormat('Y-m-d h:i:s', $str) !== false);
    }

?>