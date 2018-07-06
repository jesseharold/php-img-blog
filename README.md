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

BUGS:
 - tag positions not getting saved properly
 - page edit not working - test w/o quotes
 
 MUST HAVE:
 - file upload, add path to img_path field
 
 NICE TO HAVE:
 - auto resize images to a particular size(s) thats configurable
 - ability to drag tags to change position?
 - add calendar widget to select pub date 