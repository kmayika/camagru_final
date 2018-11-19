<?php
require_once('../config/database.php');
session_start();
$user_id = $_SESSION['id'];
$database = db_camagru();

$query = $database->prepare("SELECT * FROM db_camagru.images WHERE user_id = :user_id")
$query->execute();

$row = $query->fetch(PDO::FETCH_ASSOC);

$_SESSION['post'] = $row['id'];
echo $_SESSION['post'];
?>
