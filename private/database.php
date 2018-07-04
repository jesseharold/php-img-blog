<?php
    require_once('db_credentials.php');
    // above file excluded from git repo, defines the constants in the next line

    function db_connect(){
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

        // Test if connection succeeded
        if(mysqli_connect_errno()) {
          $msg = "Database connection failed: ";
          $msg .= mysqli_connect_error();
          $msg .= " (" . mysqli_connect_errno() . ")";
          exit($msg);
        }
        
        return $conn;
    }

    function db_disconnect($connection){
        if (isset($connection)){
            mysqli_close($connection);
        }
    }
?>