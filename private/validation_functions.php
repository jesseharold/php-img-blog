<?php

  // is_blank('abcd')
  // * validate data presence
  // * uses trim() so empty spaces don't count
  // * uses === to avoid false positives
  // * better than empty() which considers "0" to be empty
  function is_blank($value) {
    return !isset($value) || trim($value) === '';
  }

  // has_presence('abcd')
  // * validate data presence
  // * reverse of is_blank()
  // * I prefer validation names with "has_"
  function has_presence($value) {
    return !is_blank($value);
  }

  // has_length_greater_than('abcd', 3)
  // * validate string length
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length_greater_than($value, $min) {
    $length = strlen($value);
    return $length > $min;
  }

  // has_length_less_than('abcd', 5)
  // * validate string length
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length_less_than($value, $max) {
    $length = strlen($value);
    return $length < $max;
  }

  // has_length_exactly('abcd', 4)
  // * validate string length
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length_exactly($value, $exact) {
    $length = strlen($value);
    return $length == $exact;
  }

  // has_inclusion_of( 5, [1,3,5,7,9] )
  // * validate inclusion in a set
  function has_inclusion_of($value, $set) {
  	return in_array($value, $set);
  }

  // has_exclusion_of( 5, [1,3,5,7,9] )
  // * validate exclusion from a set
  function has_exclusion_of($value, $set) {
    return !in_array($value, $set);
  }

  // has_string('nobody@nowhere.com', '.com')
  // * validate inclusion of character(s)
  // * strpos returns string start position or false
  // * uses !== to prevent position 0 from being considered false
  // * strpos is faster than preg_match()
  function has_string($value, $required_string) {
    return strpos($value, $required_string) !== false;
  }

  // has_valid_email_format('nobody@nowhere.com')
  // * validate correct format for email addresses
  // * format: [chars]@[chars].[2+ letters]
  // * preg_match is helpful, uses a regular expression
  //    returns 1 for a match, 0 for no match
  //    http://php.net/manual/en/function.preg-match.php
  function has_valid_email_format($value) {
    $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
    return preg_match($email_regex, $value) === 1;
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
