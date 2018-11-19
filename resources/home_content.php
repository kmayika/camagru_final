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
  $query2 = $database->prepare("SELECT * FROM db_camagru.comment_like");
  $query2->bindValue(":user_id", $user_id);
  $query2->execute();
  $row2 = $query2->fetch(PDO::FETCH_ASSOC);

  // $result = $query2->fetchAll();
  // print_r($result);
  if ($i%3 == 0)
  {
    echo "<tr>";
  }
  echo"<td><form  action='resources/comment_like.php' method='post'><img src='upload/{$row['image']}' class='gallery'><p>".$row2['comment']."</p><input type='text' name='comment'  placeholder='write comment'/><input type='submit' name=btn/ value='comment'><a href='resources/like.php' name='like'>Like</a><p>likes :".$row2['like']."</p></form></td>";
  //
  if ($i%3 == 2)
  {
    echo "</tr>";
  }
  $i++;


}
?>
