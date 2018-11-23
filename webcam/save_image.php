<?php
require_once('../config/database.php');
session_start();
$user_id = $_SESSION['id'];
include ("store_pic.php");

?>
