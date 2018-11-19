<?php
include ("database.php");

try
{
    $database = db_camagru();
    $query = $database->prepare("CREATE DATABASE IF NOT EXISTS db_camagru");
    $query->execute();
    $query = $database->prepare("USE db_camagru;
                                CREATE TABLE IF NOT EXISTS users(
                                    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                    `username` VARCHAR(255) NOT NULL,
                                    `email` VARCHAR(255) NOT NULL,
                                    `password` VARCHAR(255) NOT NULL,
                                    `password_confirm` VARCHAR(255) NOT NULL);

                                CREATE TABLE IF NOT EXISTS images(
                                  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                  `user_id` INT(11) NOT NULL,
                                  `image` VARCHAR(255) NOT NULL);

                                CREATE TABLE IF NOT EXISTS comment_like(
                                  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                  `user_id` INT(11) NOT NULL,
                                  `comment` VARCHAR(255) NOT NULL,
                                  `like` VARCHAR(255) NOT NULL);");
      $query->execute();

}
catch (PDOException $e)
{
    echo $e->getMessage();
}

?>
