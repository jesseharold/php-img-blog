
<?php if(!isset($page_title)){ $page_title = ""; } ?>

<!doctype html>
<html lang="en">
  <head>
    <title>Admin Area - <?php echo $page_title; ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/stylesheets/admin_style.css">
  </head>

  <body>
    <header class="container">
        <h1><a href="/admin/">Administer Your Site</a></h1>    
    </header>

    <navigation class="container">
        <ul>
            <li><a href="/admin/pages">Admin Pages</a></li>
            <li><a href="/admin/tags">Admin Tags</a></li>
            <li><a href="/" target="_blank">View Site &raquo;</a></li>
        </ul>
    </navigation>

    <section id="content" class="container">
    
        <?php echo show_flash($_GET, 'msg'); ?>
        
        <h2><?php echo h($page_title); ?></h2>