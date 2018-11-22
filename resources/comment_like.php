<?php
  session_start();
  require ("../config/database.php");
  $database = db_camagru();
  $user_id = $_SESSION['id'];
  $post_id = $_SESSION['post_id'];
  $comment = $_GET['comment'];
  $id = 40;
  // echo $comment;
  if (!empty($comment))
  {

  $like = "1";
  // $query = $database->prepare("SELECT * FROM db_camagru.comment_like WHERE user_id=:user_id");
  // $query->execute();
  // $row = $query->fetch(PDO::FETCH_ASSOC);
  // $n = $row['like'];
  $query = $database->prepare("UPDATE db_camagru.images SET comment=:comment WHERE id= :id ");
  // $query->bindParam(":user_id", $user_id, PDO::PARAM_STR);
  $query->bindParam(":comment", $comment, PDO::PARAM_STR);
  // $query->bindParam(":like", $like, PDO::PARAM_STR);
  // $query->bindParam(":post_id", $post_id, PDO::PARAM_STR);
  $query->bindValue(":id", $id);
  $query->execute();

  header("location: ../template.php");

  }
  else {
    echo "no";
  }



 ?>
