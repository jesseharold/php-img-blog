# php-img-blog
A simple image blogging web app using PHP and MySQL

Reviewing PHP and MySQL by writing a web app for a single author that publishes images and uses a tagging system. 

based on this tutorial:
https://www.lynda.com/PHP-tutorials/PHP-MySQL-Essential-Training-1-Basics/

Two DB tables are pages and tags, which are using a many-to-many relationship.
Since there will be a small number of tags and they won't change often, I'm using a string of ids too associate the tables. 
If the site grows, a mapping table will be necessary.
http://www.joinfu.com/2005/12/managing-many-to-many-relationships-in-mysql-part-1/

pages:

        +---------+--------------+------+-----+-------------------+----------------+
        | Field   | Type         | Null | Key | Default           | Extra          |
        +---------+--------------+------+-----+-------------------+----------------+
        | id      | int(11)      | NO   | PRI | NULL              | auto_increment |
        | title   | varchar(255) | YES  |     | NULL              |                |
        | visible | tinyint(1)   | YES  |     | NULL              |                |
        | content | mediumtext   | YES  |     | NULL              |                |
        | pubdate | datetime     | YES  |     | NULL              |                |
        | tag_ids | varchar(255) | YES  |     | NULL              |                |
        | moddate | datetime     | YES  |     | CURRENT_TIMESTAMP |                |
        +---------+--------------+------+-----+-------------------+----------------+

tags:

        +--------------+--------------+------+-----+---------+----------------+
        | Field        | Type         | Null | Key | Default | Extra          |
        +--------------+--------------+------+-----+---------+----------------+
        | id           | int(11)      | NO   | PRI | NULL    | auto_increment |
        | display_name | varchar(255) | YES  |     | NULL    |                |
        | position     | int(3)       | YES  |     | NULL    |                |
        | visible      | tinyint(1)   | YES  |     | NULL    |                |
        +--------------+--------------+------+-----+---------+----------------+

To Do:
 - add validation to new and edit pages

 - make edit and new page show checkboxes and tag names, not just numbers
 - ability to drag tags to change position?
 - a way to have tags get their positions auto-sorted so tehy're all unique?
 
 - file upload, add path to img_path field
 - auto resize images to a particular size(s) thats configurable
 
 - figure out how to stop h function from replacing quotes and apos - double encoding ampersands?

 - add public display pages