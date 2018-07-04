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

?>