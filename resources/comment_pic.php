<?php
  session_start();
  require_once("../config/database.php");
  if (!isset($_SESSION['id']))
  {
    echo "<script> alert ('Please login')</script>";
    header("refresh:0.01; url=../login.php");
  }
  else if (isset($_GET['id']) && !empty($_GET['id']) AND isset($_GET['comment']) && !empty($_GET['comment']))
  {
      $comment = strip_tags(trim($_GET['comment']));
      $post_id = $_GET['id'];
      $database = db_camagru();
      $query = $database->prepare("INSERT INTO db_camagru.comment (post_id,comment) VALUES (:post_id, :comment)");
      $query->bindValue(":post_id",$post_id);
      $query->bindParam(":comment",$comment, PDO::PARAM_STR);
      $query->execute();
      $user = $_GET['user_id'];
      $query = $database->prepare("SELECT email FROM db_camagru.users WHERE id=:user");
      $query->bindParam(":user", $user, PDO::PARAM_STR);
      $query->execute();
      if ($email = $query->fetchColumn())
      {
        $subject = "Comments";
        $message = "Someone commented on your picture";
        $headers = "From: Camagru\r\n";
        if ($_SESSION['notification'] == 1)
        {
          if (mail($email,$subject,$message,$headers))
          {
            header ("location: ../template.php");
          }
          else
          {
            echo "error";
          }
        }
        else
        {
          header ("location: ../template.php");
        }
      }
      else
      {
        echo "error with email";
      }
  }
  else {
    echo "<script> alert ('comment field is empty') </script>";
    header("refresh:0.01; url=../template.php");
  }
 ?>
