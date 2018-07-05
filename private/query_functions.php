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
        $chars = str_split($string);
        $result = array();

        foreach ($chars as $char) {
            $tag = get_tag_by_id($char);
            array_push($result, $tag['display_name']);
        }

        return $result;
    }

    function create_tag($tag){
        global $db;

        if ($tag['visible'] == ''){
            $tag['visible'] = 0;
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

        if (result){
            return true;
        } else {
            echo "Query Failed: " . $sql;
            db_disconnect($db);
            exit; 
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

?>