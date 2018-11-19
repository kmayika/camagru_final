<?php
  session_start();
  require ("../config/database.php");
  $database = db_camagru();
  $user_id = $_SESSION['id'];
  $post_id = $_SESSION['post_id'];
  $comment = $_POST['comment'];
  if (!empty($comment))
  {

  $like = "1";
  // $query = $database->prepare("SELECT * FROM db_camagru.comment_like WHERE user_id=:user_id");
  // $query->execute();
  // $row = $query->fetch(PDO::FETCH_ASSOC);
  // $n = $row['like'];
  $query = $database->prepare("INSERT INTO db_camagru.comment_like (post_id,user_id,comment,`like`) VALUES (:post_id,:user_id,:comment,:like)");
  $query->bindParam(":user_id", $user_id, PDO::PARAM_STR);
  $query->bindParam(":comment", $comment, PDO::PARAM_STR);
  $query->bindParam(":like", $like, PDO::PARAM_STR);
  $query->bindParam(":post_id", $post_id, PDO::PARAM_STR);
  $query->execute();

  header("location: ../template.php");

  }
  else {
    echo "no";
  }



 ?>
