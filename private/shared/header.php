
<?php 
    if(!isset($page_title)){ 
        $page_title = ""; 
    }
    
    $nav_tags = get_all_tags();
?>

<!doctype html>
<html lang="en">
  <head>
    <title>PHP Blog - <?php echo $page_title; ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/stylesheets/style.css">
  </head>

  <body>
    <header class="container">
        <h1><a href="/">Image Blog</a></h1>    
    </header>

    <navigation class="container">
        <ul>
        <?php while($tag = mysqli_fetch_assoc($nav_tags)) { ?>
            <?php if($tag['visible']){ ?>
                <li>
                    <a href="tag.php?id=<?php echo h(u($tag['id']))?>">
                        <?php echo h($tag['display_name']); ?>
                    </a>
                </li>
            <?php } ?>
        <?php } ?>
        </ul>
    </navigation>

    <section id="content" class="container">
    
        <?php echo show_flash($_GET, 'msg'); ?>
        
        <h2><?php echo h($page_title); ?></h2>