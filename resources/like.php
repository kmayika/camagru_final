<?php
  session_start();
  require ("../config/database.php");

  // $comment = "This is a test";
  $likes = '2';
  if (!isset($_POST['like']))
  {
    $database = db_camagru();
    $user_id = $_SESSION['id'];

    $query = $database->prepare("UPDATE db_camagru.like SET like=:likes )");
    // $query->bindParam(":user_id", $user_id, PDO::PARAM_STR);
    $query->bindParam(":likes", $likes, PDO::PARAM_STR);
    $query->execute();
    header("location: ../template.php");
  }
  // $query = $database->prepare("SELECT * FROM db_camagru.comment_like WHERE user_id=:user_id");
  // $query->execute();
  // $row = $query->fetch(PDO::FETCH_ASSOC);
  // $n = $row['like'];





 ?>
