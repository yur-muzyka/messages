<?
    $table1 = "
        CREATE TABLE IF NOT EXISTS `messages`.`users` (
            id int NOT NULL AUTO_INCREMENT, 
            `login` VARCHAR(50) NOT NULL,
            `password` VARCHAR(50) NOT NULL,
            `location` INT,
            PRIMARY KEY (id)
        )";

    $table2 = "
        CREATE TABLE IF NOT EXISTS `messages`.`messages` (
            id INT NOT NULL AUTO_INCREMENT, 
            `text` TEXT NOT NULL,
            `author_id` INT,
            `recipient_id` INT,
            PRIMARY KEY (id)
        )";

    mysql_query($table1);
    mysql_query($table2);

?>
