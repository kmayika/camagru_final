<?php
  session_start();
  require_once("../config/database.php");
  if (isset($_GET['id']) && !empty($_GET['id']) AND isset($_GET['comment']) && !empty($_GET['comment']))
  {
      $comment = strip_tags(trim($_GET['comment']));
      $post_id = $_GET['id'];
      $database = db_camagru();
      $query = $database->prepare("INSERT INTO db_camagru.comment (post_id,comment) VALUES (:post_id, :comment)");
      $query->bindValue(":post_id",$post_id);
      $query->bindParam(":comment",$comment, PDO::PARAM_STR);
      $query->execute();
      header ("location: ../template.php");
  }
  else {
    echo "<script> alert ('comment field is empty') </script>";
  }
 ?>
