<?php

    function get_all_tags(){
        // in php you have to declare any vars from the 
        // global scope that you want to use in a function
        global $db;    

        $query = "SELECT * FROM tags ";
        $query .= "ORDER BY position ASC, display_name";
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
        $query .= "WHERE id = '" . db_escape($db, $id) . "'";
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
        $sql .= "'" . db_escape($db, $tag['display_name']) . "', ";
        $sql .= "'" . db_escape($db, $tag['position']) . "', ";
        $sql .= "'" . db_escape($db, $tag['visible']) . "');";
    
        $result = mysqli_query($db, $sql);
    
        if ($result){
            $new_id = mysqli_insert_id($db); // gets the ID of the record just created
            reposition_tags();
            return $new_id; 
        } else {
            echo "Query Failed: " . $sql;
            db_disconnect($db);
            exit; 
        }
        
    }

    function update_tag($tag){
        global $db;

        if ($tag['visible'] == ''){
            $tag['visible'] = '0';
        }
    
        $errors = validate_tag($tag);
        if (!empty($errors)){
            return($errors);
        }

        $sql = "UPDATE tags SET ";
        $sql .= "display_name='" . db_escape($db, $tag['display_name']) . "', ";
        $sql .= "position='" . db_escape($db, $tag['position']) . "', ";
        $sql .= "visible='" . db_escape($db, $tag['visible']) . "' ";
        $sql .= "WHERE id='" . db_escape($db, $tag['id']) . "' LIMIT 1;";
    
        $result = mysqli_query($db, $sql);
    
        if ($result){
            //reposition_tags();
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
        $sql .= "WHERE id='" . db_escape($db, $id) . "' LIMIT 1;";

        $result = mysqli_query($db, $sql);

        remove_tag_from_pages($id);

        if (result){
            reposition_tags();
            return true;
        } else {
            echo "Query Failed: " . $sql;
            db_disconnect($db);
            exit; 
        }
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

    function reposition_tags(){
        $all_tags = get_all_tags();
        $counter = 1;
        while($tag = mysqli_fetch_assoc($all_tags)){
            if($tag['position'] != $counter){
                $tag['position'] = $counter;
                update_tag($tag);
            }
            
            $counter++;
        }
    }

    function get_all_pages(){
        // in php you have to declare any vars from the 
        // global scope that you want to use in a function
        global $db;    

        $query = "SELECT * FROM pages ";
        $query .= "ORDER BY pubdate DESC";
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
        $query .= "WHERE id = '" . db_escape($db, $id) . "'";
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
        $sql .= "'" . db_escape($db, $page['title']) . "', ";
        $sql .= "'" . db_escape($db, $page['visible']) . "', ";
        $sql .= "'" . db_escape($db, $page['content']) . "', ";
        $sql .= "'" . db_escape($db, $page['img_path']) . "', ";
        $sql .= "'" . db_escape($db, $page['pubdate']) . "', ";
        $sql .= "'" . db_escape($db, $page['tag_ids']) . "');";

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
            $page['visible'] = '0';
        }

        $errors = validate_page($page);
        if (!empty($errors)){
            return($errors);
        }

        $sql = "UPDATE pages SET ";
        $sql .= "title='" . db_escape($db, $page['title']) . "', ";
        $sql .= "visible='" . db_escape($db, $page['visible']) . "', ";
        $sql .= "content='" . db_escape($db, $page['content']) . "', ";
        $sql .= "img_path='" . db_escape($db, $page['img_path']) . "', ";
        $sql .= "pubdate='" . db_escape($db, $page['pubdate']) . "', ";
        $sql .= "tag_ids='" . db_escape($db, $page['tag_ids']) . "' ";
        $sql .= "WHERE id= '" . db_escape($db, $page['id']) . "' LIMIT 1;";

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
        $sql .= "WHERE id='" . db_escape($db, $id) . "' LIMIT 1;";

        $result = mysqli_query($db, $sql);

        if (result){
            return true;
        } else {
            echo "Query Failed: " . $sql;
            db_disconnect($db);
            exit; 
        }
    }

?>