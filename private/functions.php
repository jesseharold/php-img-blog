<?php
    function url_for($script_path) {
        // add the leading '/' if not present
        if($script_path[0] != '/') {
            $script_path = "/" . $script_path;
        }
        return WWW_ROOT . $script_path;
    }

    function u($str=""){
        return urlencode($str);
    }

    function h($str=""){
        return htmlspecialchars($str);
    }

    function redirect_to($location){
        header("Location: " . $location);
        exit;
    }

    function is_post_request() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }
    
    function is_get_request() {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    function show_flash($query_string, $key){
        // show flash messaging
        $val = isset($query_string[$key]) ? $query_string[$key] : false;
        if (!$val){
            return false;
        } else {
            $flash = '<div class="flash">' . $val . '</div>';
            return $flash;
        }
    }

    function show_errors($errors){
        // show flash messaging
        for($i = 0; $i < count($errors); $i++) {
            echo '<div class="flash">' . $errors[$i] . '</div>';
        }
    }


    function quotes($str){
        $clean = str_replace("'", "&apos;", $str);
        $clean = str_replace('"', "&quot;", $clean);
        return $clean;
    }

    function unquotes($str){
        $quoted = str_replace("&apos;", "'", $str);
        $clean = str_replace("&quot;", '"', $quoted);
        return $quoted;
    }
?>
