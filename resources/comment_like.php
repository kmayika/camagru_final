<?php
  session_start();
  require ("../config/database.php");
  $database = db_camagru();
  $user_id = $_SESSION['id'];
  // $post_id = $_SESSION['post_id'];
  $comment = $_GET['comment'];

  $id = $_SESSION['post_id'];
  if (!empty($comment))
  {
  $query = $database->prepare("UPDATE db_camagru.images SET comment=:comment WHERE id=:id");
  $query->bindParam(":id", $id, PDO::PARAM_STR);
  $query->bindParam(":comment", $comment, PDO::PARAM_STR);
  $query->execute();

  header("location: ../template.php");

  }
  else {
    echo "no comment";
  }



 ?>
