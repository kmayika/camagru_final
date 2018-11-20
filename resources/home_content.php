<?php
session_start();
require_once('config/database.php');
$i = 0;

$database = db_camagru();
$user_id = $_SESSION['id'];
$query = $database->prepare("SELECT * FROM db_camagru.images");
// $query->bindParam(":user_id",$user_id, PDO::PARAM_STR);
$query->execute();

while ($row = $query->fetch(PDO::FETCH_ASSOC))
{
  if ($i%3 == 0)
  {
    echo "<tr>";
  }
  $_SESSION['image'] = $row['image'];
  // $comm = $_SESSION['comments'];
  echo"<td><form  action='resources/comment_like.php' method='get'><img src='upload/{$row['image']}' class='gallery'><p>Likes : ".$row['likes']."</p><p>Id : ".$row['id']."</p><p id='comment'>Comments : ".$row['comment']."</p><input type='text' name='comment' placeholder='write comment'/><input type='submit' name=btn/ value='comment'></form></td>";
  print_r($_SESSION['image']);
  if ($i%3 == 2)
  {
    echo "</tr>";
  }
  $i++;
}
?>
